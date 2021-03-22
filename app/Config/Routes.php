<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Usuarios');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Usuarios::login', ['as' => 'login']);

$routes->group('productos', function($routes){//RUTAS DE PRODUCTOS
	
    $routes->get('', 'Productos::index', ['as' => 'productos.inicio']);
	$routes->get('crear', 'Productos::crear', ['as' => 'productos.crear']);
	$routes->post('insertar', 'Productos::insertar', ['as' => 'productos.insertar']);
	$routes->get('editar/(:num)', 'Productos::editar/$1', ['as' => 'productos.editar']);
	$routes->post('actualizar', 'Productos::actualizar', ['as' => 'productos.actualizar']);
	$routes->get('eliminar/(:num)', 'Productos::eliminar/$1', ['as' => 'productos.eliminar']);
	$routes->get('eliminados', 'Productos::eliminados', ['as' => 'productos.eliminados']);
	$routes->get('reingresar/(:num)', 'Productos::reingresar/$1', ['as' => 'productos.reingresar']);

	$routes->get('verCodigosBarrasPdf', 'Productos::verCodigosBarrasPdf', ['as' => 'productos.verCodigosBarras']);
	$routes->get('generarCodigosBarrasPdf', 'Productos::generarCodigosBarrasPdf', ['as' => 'productos.generarCodigosBarras']);

	$routes->get('verCodigosBarrasEliminadosPdf', 'Productos::verCodigosBarrasEliminadosPdf', ['as' => 'productos.verCodigosBarrasEliminados']);
	$routes->get('generarCodigosBarrasEliminadosPdf', 'Productos::generarCodigosBarrasEliminadosPdf', ['as' => 'productos.generarCodigosBarrasEliminados']);	
});

$routes->group('unidades', function($routes){//RUTAS DE UNIDADES
	
    $routes->get('', 'Unidades::index', ['as' => 'unidades.inicio']);
	$routes->get('crear', 'Unidades::crear', ['as' => 'unidades.crear']);
	$routes->post('insertar', 'Unidades::insertar', ['as' => 'unidades.insertar']);
	$routes->get('editar/(:num)', 'Unidades::editar/$1', ['as' => 'unidades.editar']);
	$routes->post('actualizar', 'Unidades::actualizar', ['as' => 'unidades.actualizar']);
	$routes->get('eliminar/(:num)', 'Unidades::eliminar/$1', ['as' => 'unidades.eliminar']);
	$routes->get('eliminados', 'Unidades::eliminados', ['as' => 'unidades.eliminados']);
	$routes->get('reingresar/(:num)', 'Unidades::reingresar/$1', ['as' => 'unidades.reingresar']);	
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
