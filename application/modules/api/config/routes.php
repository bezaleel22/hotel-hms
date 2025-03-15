<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Root API endpoint
$route['api/v1'] = 'api/welcome/index'; // GET request for API information

// Content routes
$route['api/v1/content/home']['GET'] = 'api/content/home';
$route['api/v1/content/about']['GET'] = 'api/content/about';
$route['api/v1/content/gallery']['GET'] = 'api/content/gallery';
$route['api/v1/content/pages/(:any)']['GET'] = 'api/content/page/$1';

// Room routes
$route['api/v1/rooms']['GET'] = 'api/room/list';
$route['api/v1/rooms/(:num)']['GET'] = 'api/room/details/$1';
$route['api/v1/rooms/availability']['GET'] = 'api/room/check_availability';
$route['api/v1/rooms/types']['GET'] = 'api/room/types';
$route['api/v1/rooms/facilities']['GET'] = 'api/room/facilities';

// Authentication routes
$route['api/v1/auth/signup']['POST'] = 'api/auth/signup';
$route['api/v1/auth/login']['POST'] = 'api/auth/login';
$route['api/v1/auth/logout']['POST'] = 'api/auth/logout';
$route['api/v1/auth/forgot-password']['POST'] = 'api/auth/forgot_password';
$route['api/v1/auth/reset-password']['POST'] = 'api/auth/reset_password';

// Customer management routes
$route['api/v1/customer/(:num)']['GET'] = 'api/customer/details/$1';
$route['api/v1/customer/(:num)']['PUT'] = 'api/customer/update/$1';
$route['api/v1/customer/(:num)/bookings']['GET'] = 'api/customer/bookings/$1';
$route['api/v1/customer/(:num)/change-password']['POST'] = 'api/customer/change_password/$1';

// Booking routes
$route['api/v1/booking/create']['POST'] = 'api/booking/create';
$route['api/v1/booking/details/(:num)']['GET'] = 'api/booking/details/$1';
$route['api/v1/booking/update/(:num)']['PUT'] = 'api/booking/update/$1';
$route['api/v1/booking/cancel/(:num)']['POST'] = 'api/booking/cancel/$1';
$route['api/v1/booking/payment']['POST'] = 'api/booking/process_payment';
$route['api/v1/booking/history']['GET'] = 'api/booking/history';
$route['api/v1/booking/stats']['GET'] = 'api/booking/stats';

// Contact routes
$route['api/v1/contact']['POST'] = 'api/contact/submit';
$route['api/v1/subscribe']['POST'] = 'api/contact/subscribe';
$route['api/v1/subscribe/verify/(:any)']['GET'] = 'api/contact/verify/$1';

// Payment routes
$route['api/v1/payments/methods']['GET'] = 'api/payment/methods';
$route['api/v1/payments/process']['POST'] = 'api/payment/process';
$route['api/v1/payments/verify/(:num)']['POST'] = 'api/payment/verify/$1';

// Configuration routes
$route['api/v1/config/settings']['GET'] = 'api/config/settings';
$route['api/v1/config/languages']['GET'] = 'api/config/languages';
$route['api/v1/config/currency']['GET'] = 'api/config/currency';

// Promo code routes
$route['api/v1/promocodes/validate']['POST'] = 'api/promocode/validate';
$route['api/v1/promocodes']['GET'] = 'api/promocode/list';
$route['api/v1/promocodes/history']['GET'] = 'api/promocode/history';

// API Documentation routes
$route['api/v1/docs']['GET'] = 'api/documentation/index';
$route['api/v1/docs/ui']['GET'] = 'api/documentation/ui';
