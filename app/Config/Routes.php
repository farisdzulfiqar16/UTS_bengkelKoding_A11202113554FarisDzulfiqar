<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute halaman utama
 $routes->get('/', 'Home::index');            

// Rute untuk halaman data
 $routes->get('/pasien', 'PasienController::index');
 $routes->get('/dokter', 'DokterController::index');
 $routes->get('/periksa', 'PeriksaController::index');

// Rute untuk menyimpan atau memperbarui data
 $routes->post('/pasien/save', 'PasienController::savePasien');
 $routes->post('/dokter/save', 'DokterController::saveDokter');
 $routes->post('/periksa/save', 'PeriksaController::savePeriksa');

 
