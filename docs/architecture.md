## Introduction

### HMVC Architecture
The Hotel Management System uses a Hierarchical Model-View-Controller (HMVC) pattern where functionality is organized into modules under `application/modules/`. Each module is self-contained with its own:

- Controllers (handling requests)
- Models (database interactions)
- Views (response formatting)
- Config (module-specific configuration)

### Module Structure
```
application/
└── modules/
    ├── dashboard/         # Core module example
    │   ├── controllers/
    │   │   └── Dashboard.php
    │   ├── models/
    │   │   └── Dashboard_model.php
    │   ├── views/
    │   │   └── index.php
    │   └── config/
    │       ├── config.php
    │       └── routes.php
    │
    ├── user/             # User management module
    │   ├── controllers/
    │   ├── models/
    │   ├── views/
    │   └── config/
    │
    └── reports/          # Reporting module
        ├── controllers/
        ├── models/
        ├── views/
        └── config/
```

### Module Creation Process
New modules in the system require specific files and configuration:

1. Module Registration
```php
// application/modules/example/config/config.php
$HmvcConfig['example'] = [
    'packageName' => 'Example',
    '_title' => 'Example Module',
    '_description' => 'Example module description',
    '_version' => '1.0',
    'directory' => 'example',
    'routePrefix' => 'example'
];
```

2. Module Initialization
```php
// application/modules/example/config/module.php
class Module {
    public function __construct() {
        // Load core dependencies
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'database']);
    }

    public function init() {
        // Check requirements
        if (!$this->_check_dependencies()) {
            return false;
        }

        // Initialize module
        $this->_setup_database();
        $this->_register_hooks();
        
        return true;
    }

    private function _check_dependencies() {
        // Verify required modules
        // Check database tables
        // Validate configurations
        return true;
    }

    private function _setup_database() {
        // Run migrations if needed
        // Initialize default data
    }

    private function _register_hooks() {
        // Register module hooks
        // Set up event listeners
    }
}
```

3. Module Integration
```php
// application/config/autoload.php
$autoload['modules'] = ['example'];  // Auto-load module

// application/config/routes.php
$route['example/(:any)'] = 'example/$1';  // Module routing
$route['example'] = 'example/index';      // Default route
```

4. Module Permissions
```php
// application/modules/example/config/permission.php
$permission = [
    'example' => [
        'create' => ['admin'],
        'read' => ['admin', 'user'],
        'update' => ['admin'],
        'delete' => ['admin']
    ]
];

// Role-based access control example
class Module_auth {
    public function check_access($permission) {
        // Check user session
        // Verify user role
        // Validate permission
    }
}
```

5. Module Assets & Dependencies
```php
// application/modules/example/config/assets.php
$assets = [
    'css' => [
        'module-style.css',
        'custom-theme.css'
    ],
    'js' => [
        'module-core.js',
        'module-ui.js'
    ]
];

// Define module dependencies
$dependencies = [
    'modules' => ['user'],
    'libraries' => ['form_validation', 'session'],
    'helpers' => ['url', 'form']
];
```

### Benefits of HMVC Architecture
This modular architecture provides:

1. Code Organization
   - Logical grouping of related features
   - Self-contained modules
   - Clear separation of concerns

2. Maintainability
   - Isolated module development
   - Easy updates and modifications
   - Reduced code conflicts

3. Reusability
   - Portable modules
   - Shared components
   - Consistent patterns

4. Scalability
   - Easy to add new modules
   - Simple dependency management
   - Flexible routing options