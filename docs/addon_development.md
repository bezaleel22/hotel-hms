# Addon Development Guide

This document explains how to create addons/modules for the Hotel HMS application, using the ordermanage module as a reference implementation.

## Module Structure

A typical module should have the following structure:

```
application/modules/your_module/
├── assets/                 # Module-specific assets
│   ├── index.html         # Directory protection
│   ├── css/               # CSS files
│   │   └── index.html     # Directory protection
│   ├── js/                # JavaScript files
│   │   └── index.html     # Directory protection
│   ├── images/            # Image assets
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

This file serves as a security measure to prevent directory listing/browsing. The content must be identical in all index.html files, including:
- Root module directory (index.html)
- All asset directories (assets/index.html)
- All subdirectories (css/index.html, js/index.html, etc.)
- All component directories (config/index.html, controllers/index.html, etc.)

No variations or modifications to this content are allowed.

## Database Integration

Each module requires three SQL files in the `assets/data/` directory:

1. **database.sql**: Contains complete table schema definitions

```sql
-- Example from ordermanage module
CREATE TABLE `item_category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `CategoryImage` varchar(255) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL,
  `CategoryIsActive` int(11) DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `item_foods` (
  `ProductsID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductImage` varchar(200) DEFAULT NULL,
  `component` text DEFAULT NULL,
  `descrip` text DEFAULT NULL,
  PRIMARY KEY (`ProductsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

2. **install.sql**: Handles system integration and initial data

```sql
-- Add language strings
INSERT INTO `language` (`phrase`, `english`) VALUES
('ordermanage', 'Restaurant'),
('manage_category', 'Manage Category'),
('category_list', 'Category List');

-- Add menu items
INSERT INTO `sec_menu_item` (`menu_title`, `page_url`, `module`)
VALUES ('ordermanage', '', 'ordermanage');

-- Add initial configuration data
INSERT INTO `customer_type` (`customer_type`, `ordering`)
VALUES ('Walk In Customer', 1),
      ('Online Customer', 1);
```

3. **uninstall.sql**: Cleanup script for module removal

```sql
-- Remove language strings
DELETE FROM `language` WHERE `phrase` IN (
    'ordermanage',
    'manage_category',
    'category_list'
);

-- Remove menu items
DELETE FROM `sec_menu_item` WHERE `module` = 'ordermanage';

-- Remove module data
DROP TABLE IF EXISTS `item_category`;
DROP TABLE IF EXISTS `item_foods`;
```

4. **env**: Installation marker file

- Created automatically during module installation
- Contains installation date
- Used to verify module installation status
- Required for proper module detection
- Used for determining if extra queries should run
- Removed during module uninstallation

## Required Files

### 1. Config Files

#### config.php

```php
// Module basic information
$HmvcConfig['your_module']["_title"] = "Module Name";
$HmvcConfig['your_module']["_description"] = "Module description";
$HmvcConfig['your_module']["_version"] = 1.0;

// Database configuration
$HmvcConfig['your_module']['_database'] = true;
$HmvcConfig['your_module']["_tables"] = array(
    'item_category',
    'item_foods',
    'customer_type'
);
```

#### menu.php

```php
$HmvcMenu["your_module"] = array(
    "icon" => "<i class='your-icon-class'></i>",

    // Direct menu items
    "menu_item" => array(
        "controller" => "controller_name",
        "method" => "method_name",
        "url" => "your_module/url-slug",
        "permission" => "read"
    )
);
```

### 2. Controllers

Controllers should extend `MX_Controller`:

```php
class Your_controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['your_model']);
    }

    public function index() {
        $this->permission->method('your_module','read')->redirect();

        $data['title'] = display('your_title');
        $data['module'] = "your_module";
        $data['page'] = "your_view";
        echo Modules::run('template/layout', $data);
    }
}
```

### 3. Models

Models should extend `CI_Model`:

```php
class Your_model extends CI_Model {
    private $table = 'your_table';

    public function create($data = array()) {
        return $this->db->insert($this->table, $data);
    }

    public function read($limit = null, $offset = null) {
        return $this->db->select("*")
            ->from($this->table)
            ->limit($limit, $offset)
            ->get()
            ->result();
    }
}
```

## Best Practices

1. **Database Management**

   - Use database.sql for complete schema definitions
   - Use install.sql for system integration and initial data
   - Use uninstall.sql for complete cleanup
   - Follow table naming conventions
   - Include proper foreign key constraints
   - Use consistent character sets (utf8)
   - Installation markers:
     - env file created automatically on install
     - Contains installation date
     - Used to verify module installation
     - Required for proper module detection
     - Used for extra query execution checks
     - Removed during uninstallation

2. **Asset Organization**

   - Keep module-specific assets in module directory
   - Use appropriate subdirectories (css, js, images)
   - Follow naming conventions
   - Include version numbers where appropriate

3. **Integration**
   - Register all language strings
   - Set up proper menu structure
   - Handle permissions correctly
   - Clean up all data during uninstallation

## Testing

1. **Installation Testing**

   - Test schema creation
   - Verify initial data
   - Check menu integration
   - Validate language strings
   - Verify env file creation

2. **Uninstallation Testing**

   - Verify complete data cleanup
   - Check menu item removal
   - Validate language string removal
   - Test foreign key constraints
   - Confirm env file removal

3. **Functional Testing**
   - Test all CRUD operations
   - Verify permission checks
   - Test file operations
   - Validate form submissions

## Documentation

1. **Module Documentation**

   - List dependencies
   - Document configuration options
   - Provide installation instructions
   - Include upgrade procedures

2. **Code Documentation**
   - Document complex functions
   - Explain configuration options
   - Detail security measures
   - Include usage examples

Remember to follow HMS coding standards and use the ordermanage module as a reference implementation.
