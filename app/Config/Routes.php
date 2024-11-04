<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


 //Tempat rute auth nya
$routes->get('/login','AuthController::viewLogin');
$routes->post('/login', 'AuthController::checkLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register','AuthController::viewRegister');
$routes->post('/register','AuthController::save');


//Homepage dkk
$routes->get('/', 'HomeController::index');

//Item katalog dan smua barang
$routes->get('/catalog','CatalogController::viewCatalog');
$routes->get('/rent','CatalogController::viewRent');
$routes->post('/rent','CatalogController::saveRent');
$routes->get('/cart','CatalogController::viewCart');
$routes->get('/history','CatalogController::viewHistory');

//dashboard
$routes->get('/dashboard','DashboardController::viewDashboard');
$routes->post('/order_process','DashboardController::deletePesanan');
$routes->post('/product_process','DashboardController::deleteitem');
$routes->post('/product_process/add','DashboardController::addItem');

///product_process/add

