<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #007bff;
            --code-bg: #f8f9fa;
            --border-color: #e9ecef;
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: var(--sidebar-width);
            background: #fff;
            border-right: 1px solid var(--border-color);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 40px;
            overflow-x: hidden;
        }
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 100px;
        }
        .nav-list {
            list-style: none;
            padding: 0;
        }
        .nav-item {
            margin: 8px 0;
        }
        .nav-link {
            color: #666;
            text-decoration: none;
            display: block;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .nav-link:hover {
            background: var(--code-bg);
            color: var(--primary-color);
        }
        .nav-link.active {
            background: var(--primary-color);
            color: white;
        }
        .endpoint {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }
        .method {
            font-weight: bold;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            margin-right: 10px;
            display: inline-block;
            min-width: 60px;
            text-align: center;
        }
        .get { background: #28a745; }
        .post { background: #007bff; }
        .delete { background: #dc3545; }
        .put { background: #ffc107; }
        .url {
            font-family: monospace;
            background: var(--code-bg);
            padding: 4px 8px;
            border-radius: 4px;
        }
        .code-block {
            background: var(--code-bg);
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
            font-family: monospace;
            white-space: pre;
        }
        .code-tabs {
            display: flex;
            margin-bottom: 10px;
        }
        .code-tab {
            padding: 8px 16px;
            cursor: pointer;
            border: 1px solid var(--border-color);
            border-bottom: none;
            border-radius: 4px 4px 0 0;
            margin-right: 4px;
        }
        .code-tab.active {
            background: var(--code-bg);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid var(--border-color);
        }
        th {
            background: var(--code-bg);
        }
        .section {
            margin: 40px 0;
        }
        .required {
            color: #dc3545;
            font-weight: bold;
        }
        .optional {
            color: #6c757d;
        }
        .sub-nav {
            padding-left: 20px;
        }
        .javascript-code {
            display: none;
        }
        .curl-code {
            display: block;
        }
        .nav-divider {
            height: 1px;
            background: var(--border-color);
            margin: 25px 0;
            opacity: 0.5;
        }
        .nav-heading {
            font-weight: bold;
            color: #333;
            margin: 15px 0 10px;
            padding: 5px 10px;
            text-transform: uppercase;
            font-size: 0.75em;
            letter-spacing: 1px;
            color: #666;
            font-weight: 600;
        }
    </style>
    <?php
    function getApiUrl($path) {
        return rtrim(base_url(), '/') . '/api/v1/' . ltrim($path, '/');
    }
    ?>
    <script>
        window.apiBaseUrl = '<?= rtrim(base_url(), '/') ?>/api/v1';
        document.addEventListener('DOMContentLoaded', function() {
            // Handle code tab switching
            document.querySelectorAll('.code-tabs').forEach(function(tabGroup) {
                tabGroup.querySelectorAll('.code-tab').forEach(function(tab) {
                    tab.addEventListener('click', function() {
                        // Update active tab
                        tabGroup.querySelectorAll('.code-tab').forEach(t => t.classList.remove('active'));
                        this.classList.add('active');
                        
                        // Show corresponding code block
                        const isJavaScript = this.textContent === 'JavaScript';
                        const codeBlocks = tabGroup.nextElementSibling.querySelectorAll('.code-content');
                        codeBlocks.forEach(block => {
                            if (block.classList.contains('javascript-code')) {
                                block.style.display = isJavaScript ? 'block' : 'none';
                            } else {
                                block.style.display = isJavaScript ? 'none' : 'block';
                            }
                        });
                    });
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>API Documentation</h2>
            <nav>
                <ul class="nav-list">
                    <!-- API Reference -->
                    <div class="nav-heading">API Reference</div>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/introduction') ?>" class="nav-link <?= $page === 'introduction' ? 'active' : '' ?>">Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/authentication') ?>" class="nav-link <?= $page === 'authentication' ? 'active' : '' ?>">Authentication</a>
                        <?php if ($page === 'authentication'): ?>
                        <ul class="sub-nav">
                            <li><a href="#signup" class="nav-link">Sign Up</a></li>
                            <li><a href="#login" class="nav-link">Login</a></li>
                            <li><a href="#forgot-password" class="nav-link">Forgot Password</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/rooms') ?>" class="nav-link <?= $page === 'rooms' ? 'active' : '' ?>">Rooms</a>
                        <?php if ($page === 'rooms'): ?>
                        <ul class="sub-nav">
                            <li><a href="#list" class="nav-link">List Rooms</a></li>
                            <li><a href="#details" class="nav-link">Room Details</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/bookings') ?>" class="nav-link <?= $page === 'bookings' ? 'active' : '' ?>">Bookings</a>
                        <?php if ($page === 'bookings'): ?>
                        <ul class="sub-nav">
                            <li><a href="#create" class="nav-link">Create Booking</a></li>
                            <li><a href="#verify-payment" class="nav-link">Verify Payment</a></li>
                            <li><a href="#history" class="nav-link">Booking History</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/content') ?>" class="nav-link <?= $page === 'content' ? 'active' : '' ?>">Content</a>
                        <?php if ($page === 'content'): ?>
                        <ul class="sub-nav">
                            <li><a href="#home" class="nav-link">Home Content</a></li>
                            <li><a href="#about" class="nav-link">About Content</a></li>
                            <li><a href="#gallery" class="nav-link">Gallery</a></li>
                            <li><a href="#privacy" class="nav-link">Privacy Policy</a></li>
                            <li><a href="#terms" class="nav-link">Terms & Conditions</a></li>
                            <li><a href="#contact" class="nav-link">Contact Form</a></li>
                            <li><a href="#subscribe" class="nav-link">Newsletter Subscribe</a></li>
                        </ul>
                        <?php endif; ?>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/guide') ?>" class="nav-link <?= $page === 'guide' ? 'active' : '' ?>">Integration Guide</a>
                    </li>

                    <!-- Documentation Tools -->
                    <div class="nav-divider"></div>
                    <div class="nav-heading">Documentation Tools</div>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/swagger') ?>" class="nav-link">
                            Swagger UI Documentation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('api/v1/docs/spec') ?>" class="nav-link">
                            OpenAPI Specification
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="main-content">
            <?php $this->load->view($content_view); ?>
        </div>
    </div>
</body>
</html>