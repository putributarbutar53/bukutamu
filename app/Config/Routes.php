<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');

$routes->add('admin0503/logout', 'Admin0503\Login::logout');

$routes->group('admin0503', ['filter' => 'noadmin'], function ($routes) {
    $routes->add('', 'Admin0503\Login::login');
    $routes->add('login', 'Admin0503\Login::login');
    $routes->add('lupapassword', 'Admin0503\Login::lupapassword');
    $routes->add('resetpassword', 'Admin0503\Login::resetpassword');

    // Tambahkan rute untuk hapus pengunjung
    $routes->delete('pengunjung/delete/(:num)', 'Home::delete/$1'); // Rute untuk menghapus pengunjung berdasarkan ID
});
