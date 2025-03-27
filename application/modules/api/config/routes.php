<?php
defined('BASEPATH') or exit('No direct script access allowed');

// API documentation
$route['api/v1']['GET'] = 'api/docs/index';
$route['api/v1/docs/spec']['GET'] = 'api/docs/spec';
$route['api/v1/docs/swagger']['GET'] = 'api/docs/swagger';
$route['api/v1/docs']['GET'] = 'api/docs/api';
$route['api/v1/docs/(:any)']['GET'] = 'api/docs/api/$1';

// Authentication management routes
$route['api/v1/auth/signup']['POST'] = 'api/auth/signup';
$route['api/v1/auth/login']['POST'] = 'api/auth/login';
$route['api/v1/auth/refresh']['POST'] = 'api/auth/refresh';
$route['api/v1/auth/logout']['POST'] = 'api/auth/logout';
$route['api/v1/auth/change-password']['POST'] = 'api/auth/change_password';
$route['api/v1/auth/forgot-password']['POST'] = 'api/auth/forgot_password';
$route['api/v1/auth/reset-password']['POST'] = 'api/auth/reset_password';
$route['api/v1/auth/verify-reset-token']['GET'] = 'api/auth/verify_reset_token';

// Content management routes
$route['api/v1/content/home']['GET'] = 'api/content/home';
$route['api/v1/content/about']['GET'] = 'api/content/about';
$route['api/v1/content/gallery']['GET'] = 'api/content/gallery';
$route['api/v1/content/pages/(:any)']['GET'] = 'api/content/page/$1';
$route['api/v1/content/privacy']['GET'] = 'api/content/privacy';
$route['api/v1/content/terms']['GET'] = 'api/content/terms';
$route['api/v1/content/contact']['POST'] = 'api/content/contact';
$route['api/v1/content/subscribe']['POST'] = 'api/content/subscribe';

// Room management routes
$route['api/v1/rooms/list']['GET'] = 'api/room/list';
$route['api/v1/rooms/availability']['GET'] = 'api/room/availability';
$route['api/v1/rooms/details/(:num)']['GET'] = 'api/room/details/$1';
$route['api/v1/rooms/book']['POST'] = 'api/room/book';
$route['api/v1/rooms/verify-promocode']['POST'] = 'api/room/promocode';

// Booking management routes
$route['api/v1/bookings/checkout']['POST'] = 'api/booking/create';
$route['api/v1/bookings/details/(:num)']['GET'] = 'api/booking/details/$1';
$route['api/v1/bookings/cancel/(:num)']['DELETE'] = 'api/booking/cancel/$1';
$route['api/v1/bookings/history']['GET'] = 'api/booking/history';
$route['api/v1/bookings/verify-payment/(:num)']['GET'] = 'api/booking/verify_payment/$1';
$route['api/v1/bookings/payment-webhook']['POST'] = 'api/booking/payment_webhook';

// Customer management routes
$route['api/v1/customer']['GET'] = 'api/customer/details';
$route['api/v1/customer']['PUT'] = 'api/customer/update';
$route['api/v1/customer/bookings']['GET'] = 'api/customer/bookings';

// Configuration management routes
// $route['api/v1/config/settings']['GET'] = 'api/config/settings';
// $route['api/v1/config/languages']['GET'] = 'api/config/languages';
// $route['api/v1/config/currency']['GET'] = 'api/config/currency';