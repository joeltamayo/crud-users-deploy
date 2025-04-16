<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->GET('publication', 'Publication::index');
//$routes->POST('/publication/add', 'Publication::add');
//$routes->match(['GET', 'POST'], 'publication/edit/(:segment)', 'Publication::edit/$1');
//$routes->GET('/publication/delete/(:segment)', 'Publication::delete/$1');

$routes->get('/', 'Home::index');

$routes->get('/user/create', 'User::create'); // Ruta para el formulario de creación de usuario
$routes->get('/user/list', 'User::list'); // Ruta para el listado de usuarios
$routes->get('/user/edit/(:num)', 'User::edit/$1'); // Ruta para editar un usuario, pasando el ID
$routes->get('/user/delete/(:num)', 'User::delete/$1'); // Ruta para eliminar un usuario, pasando el ID
$routes->post('/user/create', 'User::create'); // Ruta para enviar los datos del formulario de creación
$routes->post('/user/edit/(:num)', 'User::edit/$1'); // Ruta para enviar los datos del formulario de edición

$routes->get('/user/details/(:num)', 'User::details/$1'); // Ruta para enviar los datos del formulario de edición

