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
$routes->get('/cart','CatalogController::viewCart');
$routes->get('/history','CatalogController::viewHistory');
