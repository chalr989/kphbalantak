<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth
$routes->get('login', 'Auth::login');
$routes->post('auth/processLogin', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Semua route di bawah ini wajib login
$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->get('/', 'Home::index');

  // Surat
  $routes->group('surat', function ($routes) {
    $routes->get('/', 'Surat::index');
    $routes->get('create', 'Surat::create');
    $routes->post('store', 'Surat::store');
    $routes->get('edit/(:num)', 'Surat::edit/$1');
    $routes->post('update/(:num)', 'Surat::update/$1');
    $routes->get('delete/(:num)', 'Surat::delete/$1');
    $routes->get('download/(:num)', 'Surat::download/$1');
    $routes->get('export-pdf', 'Surat::exportPdf');
    $routes->get('export-excel', 'Surat::exportExcel');
  });

  // Kwitansi
  $routes->group('kwitansi', function ($routes) {
    $routes->get('/', 'Kwitansi::index');
    $routes->get('create', 'Kwitansi::create');
    $routes->post('store', 'Kwitansi::store');
    $routes->get('edit/(:num)', 'Kwitansi::edit/$1');
    $routes->post('update/(:num)', 'Kwitansi::update/$1');
    $routes->get('delete/(:num)', 'Kwitansi::delete/$1');
    $routes->get('cetak/(:num)', 'Kwitansi::cetak/$1');
  });

  // SPPD
  $routes->group('sppd', function ($routes) {
    $routes->get('/', 'Sppd::index');
    $routes->get('create', 'Sppd::create');
    $routes->post('store', 'Sppd::store');
    $routes->get('edit/(:num)', 'Sppd::edit/$1');
    $routes->post('update/(:num)', 'Sppd::update/$1');
    $routes->get('delete/(:num)', 'Sppd::delete/$1');
    $routes->get('cetak/(:num)', 'Sppd::cetak/$1');
  });

  // Kwitansi LS
  $routes->group('kwitansi_ls', function ($routes) {
    $routes->get('/', 'KwitansiLs::index');
    $routes->get('create', 'KwitansiLs::create');
    $routes->post('store', 'KwitansiLs::store');
    $routes->get('edit/(:num)', 'KwitansiLs::edit/$1');
    $routes->post('update/(:num)', 'KwitansiLs::update/$1');
    $routes->get('delete/(:num)', 'KwitansiLs::delete/$1');
  });
});
