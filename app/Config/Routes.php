<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route diarahkan ke login
$routes->get('/', 'AuthController::login');

// Auth
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attempt');
$routes->get('logout', 'AuthController::logout');

// Protected routes
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Employee
    $routes->get('employees', 'EmployeeController::index');
    $routes->get('employees/create', 'EmployeeController::create');
    $routes->post('employees/store', 'EmployeeController::store');
    $routes->get('employees/(:num)/edit', 'EmployeeController::edit/$1');
    $routes->post('employees/(:num)/update', 'EmployeeController::update/$1');
    $routes->get('employees/(:num)/delete', 'EmployeeController::delete/$1');
    $routes->get('employees/(:num)', 'EmployeeController::show/$1');
    $routes->get('employees/export/csv', 'EmployeeController::exportCsv');

    // Master Cabang
    $routes->get('master/cabang', 'MasterCabang::index');
    $routes->get('master/cabang/create', 'MasterCabang::create');
    $routes->post('master/cabang/store', 'MasterCabang::store');
    $routes->get('master/cabang/(:num)/edit', 'MasterCabang::edit/$1');
    $routes->post('master/cabang/(:num)/update', 'MasterCabang::update/$1');
    $routes->get('master/cabang/(:num)/delete', 'MasterCabang::delete/$1');

    // Master Divisi
    $routes->get('master/divisi', 'MasterDivisi::index');
    $routes->get('master/divisi/create', 'MasterDivisi::create');
    $routes->post('master/divisi/store', 'MasterDivisi::store');
    $routes->get('master/divisi/(:num)/edit', 'MasterDivisi::edit/$1');
    $routes->post('master/divisi/(:num)/update', 'MasterDivisi::update/$1');
    $routes->get('master/divisi/(:num)/delete', 'MasterDivisi::delete/$1');

    // Master Bagian
    $routes->get('master/bagian', 'MasterBagian::index');
    $routes->get('master/bagian/create', 'MasterBagian::create');
    $routes->post('master/bagian/store', 'MasterBagian::store');
    $routes->get('master/bagian/(:num)/edit', 'MasterBagian::edit/$1');
    $routes->post('master/bagian/(:num)/update', 'MasterBagian::update/$1');
    $routes->get('master/bagian/(:num)/delete', 'MasterBagian::delete/$1');
});
