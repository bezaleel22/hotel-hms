#!/bin/bash

# Check if running as root
if [ "$EUID" -ne 0 ]; then 
    echo "Please run as root"
    exit 1
fi

# Get the absolute path to the CodeIgniter installation
CI_PATH=$(pwd)
while [ ! -f "$CI_PATH/index.php" ] && [ "$CI_PATH" != "/" ]; do
    CI_PATH=$(dirname "$CI_PATH")
done

if [ ! -f "$CI_PATH/index.php" ]; then
    echo "Could not find CodeIgniter installation"
    exit 1
fi

# Create the systemd service file
cat > /etc/systemd/system/hotel-jobs.service << EOL
[Unit]
Description=Hotel HMS Job Queue Worker
After=network.target mysql.service

[Service]
Type=simple
User=www-data
Group=www-data
WorkingDirectory=${CI_PATH}
ExecStart=/usr/bin/php index.php jobs worker start
Restart=always
RestartSec=3

# Limit resource usage
CPUQuota=25%
MemoryLimit=256M

# Security
ProtectSystem=full
PrivateTmp=true
NoNewPrivileges=true

[Install]
WantedBy=multi-user.target
EOL

# Reload systemd
systemctl daemon-reload

# Enable and start the service
systemctl enable hotel-jobs
systemctl start hotel-jobs

echo "Job queue worker service has been installed and started"
echo "To check status: systemctl status hotel-jobs"
echo "To view logs: journalctl -u hotel-jobs"
echo ""
echo "You can also process jobs via cron by adding this to crontab:"
echo "* * * * * cd ${CI_PATH} && php index.php jobs worker work > /dev/null 2>&1"