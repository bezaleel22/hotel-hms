<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$https = false;
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

$dirname = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/').'/';
$root=$protocol.$_SERVER['HTTP_HOST'].$dirname;
$config["base_url"] = $root;  

$config['index_page'] = '';
$config['uri_protocol']= 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language']= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = TRUE;
$config['subclass_prefix'] = 'MY_';

// Update composer autoload path to point to root vendor directory
$config['composer_autoload'] = FCPATH . 'vendor/autoload.php';

$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-,\=';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 4;
$config['log_path'] = APPPATH . 'logs/';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = 'TubaHotelMGT@1!KEY2019';

// Session settings
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = APPPATH . 'cache/temp/';
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Cookie settings
$config['cookie_prefix']= '';
$config['cookie_domain']= '';
$config['cookie_path']= '/';
$config['cookie_secure']= FALSE;
$config['cookie_httponly'] = FALSE;

$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = TRUE;

// CSRF settings
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = false;
$config['csrf_exclude_uris'] = array('accounts/accounts/insert_coa','dashboard/autoupdate/update', 'dashboard/autoupdate/updatenow','hotel/successful/[0-9]+/[0-9]+','hotel/fail/[0-9]+','hotel/cancilorder/[0-9]+');

if (isset($_SERVER["REQUEST_URI"])) {
    if((stripos($_SERVER["REQUEST_URI"],'/app') === FALSE) && (stripos($_SERVER["REQUEST_URI"],'/api_handler_v2') === FALSE) && (stripos($_SERVER["REQUEST_URI"],'/dashboard/setting/create') === FALSE)) {
        $config['csrf_protection'] = TRUE;
    }
    else {
        $config['csrf_protection'] = FALSE;
    } 
} else {
    $config['csrf_protection'] = TRUE;
}

$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
