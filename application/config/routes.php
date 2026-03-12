<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = 'custom404';
$route['login'] = "auth/login";
$route['logout'] = "auth/logout";
$route['about'] = "home/about";
$route['gallery'] = "home/gallery";
$route['gallery/(:any)'] = "home/gallery/$1";
$route['contact'] = "home/contact";
$route['translate_uri_dashes'] = FALSE;

// Catch-all: try to load a page by slug. Keep last to avoid overriding other routes.
$route['(:any)'] = 'pages/view/$1';
