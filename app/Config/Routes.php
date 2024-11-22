<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'LoginController::login'); 
// Halaman login default
$routes->get('/login', 'LoginController::login'); // Halaman login
$routes->post('/login', 'LoginController::loginProcess'); // Proses login
$routes->get('/logout', 'AuthController::logout'); // Logout

// Rute untuk Admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    // Halaman dashboard admin
    $routes->get('', 'Home::index');
    
    // Rute untuk data pasien
    $routes->group('pasien', function ($routes) {
        $routes->get('', 'PasienController::index'); // Tampilkan semua data pasien
        $routes->post('save', 'PasienController::savePasien'); // Tambah data pasien
        $routes->get('edit/(:num)', 'PasienController::edit/$1'); // Edit data pasien
        $routes->post('update/(:num)', 'PasienController::update/$1'); // Update data pasien
        $routes->get('delete/(:num)', 'PasienController::delete/$1'); // Hapus data pasien
    });

    // Rute untuk data dokter
    $routes->group('dokter', function ($routes) {
        $routes->get('', 'DokterController::index'); // Tampilkan semua data dokter
        $routes->post('save', 'DokterController::saveDokter'); // Tambah data dokter
        $routes->get('edit/(:num)', 'DokterController::edit/$1'); // Edit data dokter
        $routes->post('update/(:num)', 'DokterController::update/$1'); // Update data dokter
        $routes->get('delete/(:num)', 'DokterController::delete/$1'); // Hapus data dokter
    });

    // Rute untuk data pemeriksaan
    $routes->group('periksa', function ($routes) {
        $routes->get('', 'PeriksaController::index'); // Tampilkan semua data periksa
        $routes->post('save', 'PeriksaController::savePeriksa'); // Tambah data periksa
        $routes->get('edit/(:num)', 'PeriksaController::edit/$1'); // Edit data periksa
        $routes->post('update/(:num)', 'PeriksaController::update/$1'); // Update data periksa
        $routes->get('delete/(:num)', 'PeriksaController::delete/$1'); // Hapus data periksa
    });
});

// Rute untuk Guest/Patient
$routes->group('pasien', ['filter' => 'role:guest'], function ($routes) {
    $routes->get('periksa', 'PeriksaController::index'); // Hanya untuk pemeriksaan
});

