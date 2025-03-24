<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'AuthController::login');

$routes->get('register', 'AuthController::register');
$routes->post('register/store', 'AuthController::store');

$routes->get('login', 'AuthController::login');
$routes->post('login/check', 'AuthController::checkLogin');

// Route for the create user form
$routes->get('/create_user', 'UserController::create');

// Route to store the new user (POST request)
$routes->post('/store_user', 'UserController::store');

$routes->get('/user/profile', 'UserController::edit');

$routes->post('/user/update/(:num)', 'UserController::update/$1');

$routes->get('logout', 'AuthController::logout');

$routes->get('/song_page', 'MetadataController::index');

$routes->post('/filterMetadata', 'MetadataController::filterMetadata'); // Endpoint for AJAX request

$routes->post('exportMetadata', 'MetadataController::exportToExcel');
