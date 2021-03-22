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
	$routes->get('obtenerProductos/(:num)', 'Productos::obtenerProductos/$1', ['as' => 'productos.obtenerProductos']);

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

$routes->group('categorias', function($routes){//RUTAS DE CATEGORIAS
	
    $routes->get('', 'Categorias::index', ['as' => 'categorias.inicio']);
	$routes->get('crear', 'Categorias::crear', ['as' => 'categorias.crear']);
	$routes->post('insertar', 'Categorias::insertar', ['as' => 'categorias.insertar']);
	$routes->get('editar/(:num)', 'Categorias::editar/$1', ['as' => 'categorias.editar']);
	$routes->post('actualizar', 'Categorias::actualizar', ['as' => 'categorias.actualizar']);
	$routes->get('eliminar/(:num)', 'Categorias::eliminar/$1', ['as' => 'categorias.eliminar']);
	$routes->get('eliminados', 'Categorias::eliminados', ['as' => 'categorias.eliminados']);
	$routes->get('reingresar/(:num)', 'Categorias::reingresar/$1', ['as' => 'categorias.reingresar']);	
});

$routes->group('clientes', function($routes){//RUTAS DE CLIENTES
	
    $routes->get('', 'Clientes::index', ['as' => 'clientes.inicio']);
	$routes->get('crear', 'Clientes::crear', ['as' => 'clientes.crear']);
	$routes->post('insertar', 'Clientes::insertar', ['as' => 'clientes.insertar']);
	$routes->get('editar/(:num)', 'Clientes::editar/$1', ['as' => 'clientes.editar']);
	$routes->post('actualizar', 'Clientes::actualizar', ['as' => 'clientes.actualizar']);
	$routes->get('eliminar/(:num)', 'Clientes::eliminar/$1', ['as' => 'clientes.eliminar']);
	$routes->get('eliminados', 'Clientes::eliminados', ['as' => 'clientes.eliminados']);
	$routes->get('reingresar/(:num)', 'Clientes::reingresar/$1', ['as' => 'clientes.reingresar']);

	$routes->get('obtenerClientes/(:num)', 'Clientes::obtenerClientes/$1', ['as' => 'categorias.obtenerClientes']);
});

$routes->group('compras', function($routes){//RUTAS DE COMPRAS
	
    $routes->get('', 'Compras::index', ['as' => 'compras.inicio']);
	$routes->get('crear', 'Compras::crear', ['as' => 'compras.crear']);
	$routes->post('completarCompra', 'Compras::completarCompra', ['as' => 'compras.completarCompra']);
	$routes->get('editar/(:num)', 'Compras::editar/$1', ['as' => 'compras.editar']);
	$routes->post('actualizar', 'Compras::actualizar', ['as' => 'compras.actualizar']);
	$routes->get('cancelar/(:num)', 'Compras::cancelar/$1', ['as' => 'compras.cancelar']);
	$routes->get('canceladas', 'Compras::canceladas', ['as' => 'compras.canceladas']);
	$routes->get('reingresar/(:num)', 'Compras::reingresar/$1', ['as' => 'compras.reingresar']);

	$routes->get('verCompraPdf/(:num)', 'Compras::verCompraPdf/$1', ['as' => 'compras.verCompra']);
	$routes->get('generarCompraPdf/(:num)', 'Compras::generarCompraPdf/$1', ['as' => 'compras.generarCompra']);
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
