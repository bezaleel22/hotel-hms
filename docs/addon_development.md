# Addon Development Guide

This document explains how to create addons/modules for the Hotel HMS application, using the ordermanage module as a reference implementation.

## Module Structure

A typical module should have the following structure:

```
application/modules/your_module/
├── assets/                 # Module-specific assets
│   ├── index.html         # Directory protection
│   ├── css/               # CSS files
│   │   ├── style.css      # Required: Module default styles
│   │   └── index.html     # Directory protection
│   ├── js/                # JavaScript files
│   │   ├── script.js      # Required: Module default scripts
│   │   └── index.html     # Directory protection
│   ├── images/            # Image assets
│   │   ├── thumbnail.jpg  # Required: Module thumbnail
│   │   └── index.html     # Directory protection
│   └── data/              # SQL files
│       ├── database.sql   # Table schemas
│       ├── install.sql    # Initial data
│       ├── env            # Installation marker (created automatically)
│       ├── uninstall.sql  # Cleanup script
│       └── index.html     # Directory protection
├── config/
│   ├── index.html         # Directory protection
│   ├── config.php         # Module configuration
│   └── menu.php           # Menu configuration
├── controllers/           # Module controllers
│   └── index.html         # Directory protection
├── models/               # Module models
│   └── index.html         # Directory protection
├── views/                # Module views
│   └── index.html         # Directory protection
├── libraries/           # Module-specific libraries (optional)
│   └── index.html         # Directory protection
└── index.html            # Directory protection
```

## Directory Protection (index.html)

Every directory in the module must contain an index.html file with the following exact content:

```html
<!DOCTYPE html>
<html>
  <head>
    <title>403 Forbidden</title>
  </head>
  <body>
    <p>Directory access is forbidden.</p>
  </body>
</html>
```

This file serves as a security measure to prevent directory listing/browsing. The content must be identical in all index.html files.

## Module Registration and Configuration

### 1. config.php

The config.php file must properly register all module tables and configurations:

```php
$HmvcConfig['your_module']["_title"] = "Module Name";
$HmvcConfig['your_module']["_description"] = "Module description";
$HmvcConfig['your_module']["_version"] = 1.0;

// Database configuration - Required for module detection
$HmvcConfig['your_module']['_database'] = true;
$HmvcConfig['your_module']['_extra_query'] = true;  // Required for install.sql and uninstall.sql
$HmvcConfig['your_module']["_tables"] = array(
    'tbl_your_config',     // Module-specific config table
    'your_main_table'      // Module's other tables
);
```

Key points:

- \_database must be true if module uses database
- \_extra_query must be true to execute install.sql/uninstall.sql
- All module tables must be listed in \_tables array
- Follow HMS table naming convention (tbl\_ prefix for config tables)

### 2. menu.php

Menu configuration must follow the HMS menu structure:

```php
$HmvcMenu["your_module"] = array(
    "icon" => "<i class='fa fa-icon-name'></i>",

    // Direct menu items
    "menu_item" => array(
        "controller" => "controller_name",
        "method" => "method_name",
        "url" => "your_module/url-slug",
        "permission" => "read"
    ),

    // Menu group with subitems
    "menu_group" => array(
        "sub_menu_1" => array(
            "controller" => "controller_name",
            "method" => "method_name",
            "url" => "your_module/url-slug",
            "permission" => "read"
        ),
        "sub_menu_2" => array(
            "controller" => "controller_name",
            "method" => "method_name",
            "url" => "your_module/url-slug",
            "permission" => "read"
        )
    )
);
```

Key points:

- Menu items must match controller/method names
- Use proper FontAwesome icons
- Set correct permissions
- Group related items under menu groups

## Database Integration

### 1. database.sql

Create tables following HMS conventions:

```sql
CREATE TABLE IF NOT EXISTS `tbl_your_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) DEFAULT NULL,
  `setting_value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `your_main_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  -- other fields
  PRIMARY KEY (`id`),
  -- indexes and foreign keys
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

Key points:

- Use IF NOT EXISTS
- Always specify ENGINE=InnoDB
- Always use DEFAULT CHARSET=utf8
- Add proper indexes and foreign keys
- Use tbl\_ prefix for config/settings tables

### 2. install.sql

```sql
-- Initialize module config
INSERT INTO `tbl_your_config` (`setting_name`, `setting_value`) VALUES
('setting1', 'default_value'),
('setting2', 'default_value');

-- Add language strings
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES
(NULL, 'module_name', 'Module Name'),
(NULL, 'setting_label', 'Setting Label');

-- Add menu items (parent first)
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`)
VALUES ('parent_menu', '', 'your_module', '0', '0', '1', CURRENT_TIMESTAMP);

-- Add sub-menu items (reference parent)
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`, `parent_menu`, `is_report`, `createby`, `createdate`)
SELECT 'sub_menu', 'your_module/page-url', 'your_module', sec_menu_item.menu_id, '0', '1', CURRENT_TIMESTAMP
FROM sec_menu_item WHERE sec_menu_item.menu_title = 'parent_menu' LIMIT 1;
```

Key points:

- Initialize config tables with default values
- Add ALL language strings used in module
- Add menu items in correct parent-child order
- Use SELECT for submenu parent_menu references

### 3. uninstall.sql

```sql
-- Remove language strings
DELETE FROM `language` WHERE `phrase` IN (
    'module_name',
    'setting_label'
    -- all module phrases
);

-- Remove menu items
DELETE FROM `sec_menu_item`
WHERE module = 'your_module';

-- Remove module data
DROP TABLE IF EXISTS `tbl_your_config`;
DROP TABLE IF EXISTS `your_main_table`;
```

Key points:

- Remove ALL language strings
- Remove ALL menu items
- Drop ALL module tables
- Use IF EXISTS when dropping tables

## Asset Organization

1. Required Base Files:
   - style.css in assets/css/ (Required for module listing)
   - script.js in assets/js/ (Required for module functionality)
   - thumbnail.jpg in assets/images/ (Required for module thumbnail)

2. CSS Files Organization:
   - Must have style.css as base stylesheet
   - Create separate CSS files for each feature
   - Follow naming convention: feature_name.css
   - Use proper CSS namespacing
   - Load only required CSS in views

3. JavaScript Files Organization:
   - Must have script.js as base script
   - Create separate JS files for each feature
   - Follow naming convention: feature_name.js
   - Use strict mode and proper namespacing
   - Load only required JS in views

Example:

```
assets/
├── css/
│   ├── style.css        # Required: Base module styles
│   ├── settings.css     # Feature-specific styles
│   └── dashboard.css    # Feature-specific styles
├── js/
│   ├── script.js        # Required: Base module scripts
│   ├── settings.js      # Feature-specific scripts
│   └── dashboard.js     # Feature-specific scripts
├── images/
│   └── thumbnail.jpg    # Required: Module listing image
```

## View Files

Organize views by feature and follow HMS view patterns:

```php
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('title') ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <!-- Content -->
            </div>
        </div>
    </div>
</div>

<!-- Load feature-specific assets -->
<link href="<?php echo base_url('application/modules/your_module/assets/css/feature.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('application/modules/your_module/assets/js/feature.js'); ?>"></script>
```

## Theming Guidelines

### Admin Dashboard Integration

When developing admin-side interfaces, strictly follow the HMS admin dashboard theme:

1. Color Scheme:
   ```css
   /* Use HMS admin color variables */
   :root {
     --primary-color: #37a000;     /* Main theme color */
     --secondary-color: #2d3e50;   /* Secondary color */
     --success-color: #28a745;     /* Success messages */
     --danger-color: #dc3545;      /* Error messages */
     --warning-color: #ffc107;     /* Warning messages */
     --info-color: #17a2b8;        /* Info messages */
     --light-color: #f8f9fa;       /* Light backgrounds */
     --dark-color: #343a40;        /* Dark text */
   }
   ```

2. Component Styles:
   - Use Bootstrap 3.x classes for consistency
   - Match HMS admin panel layout patterns
   - Use standard HMS form styles
   - Follow HMS table formatting
   - Use HMS panel/card styles

Example admin view:
```php
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">  <!-- HMS standard panel -->
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('title') ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">  <!-- HMS table wrapper -->
                    <table class="table table-bordered table-hover">  <!-- HMS table style -->
                        <!-- Table content -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
```

3. Form Elements:
```html
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Label</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="field">
    </div>
</div>
```

### Customer-Facing Frontend

For customer-facing pages (e.g., payment pages, booking widgets):

1. Flexible Theming:
   - Custom color schemes allowed
   - Modern design patterns encouraged
   - Responsive layouts required
   - Accessibility compliance required

2. Best Practices:
   - Use semantic HTML5
   - Implement responsive design
   - Follow accessibility guidelines
   - Optimize for performance

Example frontend view:
```php
<div class="payment-container">
    <div class="payment-header">
        <h2><?php echo display('make_payment') ?></h2>
    </div>
    <div class="payment-body">
        <!-- Custom styled content -->
    </div>
</div>
```

## Testing

1. Installation Testing:

   - Remove any existing module files
   - Install through addon manager
   - Verify module appears in listing
   - Check all menu items appear
   - Verify language strings load
   - Test all database operations

2. Feature Testing:

   - Test all CRUD operations
   - Verify settings save/load
   - Check all module functions
   - Test integration points
   - Verify file operations

3. Uninstallation Testing:
   - Uninstall through addon manager
   - Verify all files removed
   - Check database cleanup
   - Confirm menu items removed
   - Verify language strings removed

## Common Issues and Solutions

1. Module Not Appearing:

   - Check config.php \_tables includes all tables
   - Verify install.sql adds menu items correctly
   - Ensure database.sql follows HMS conventions

2. Tables Not Created:

   - Set \_database = true in config.php
   - Set \_extra_query = true in config.php
   - List all tables in \_tables array
   - Follow HMS table naming conventions

3. Menu Items Missing:
   - Check menu.php follows HMS structure
   - Verify install.sql adds menu correctly
   - Use proper parent-child relationships
   - Set correct permissions

Remember to follow HMS coding standards and use the ordermanage module as a reference implementation.
