<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama
$routes->get('/', 'Home::index');

// Rute Admin (Dibuat dua variasi agar A besar atau a kecil tetap jalan)
$routes->get('admin', 'Admin::index');
$routes->get('Admin', 'Admin::index');
$routes->get('Wilayah', 'Wilayah::index');
$routes->get('wilayah', 'Wilayah::index');

// Rute Setting
$routes->get('admin/setting', 'Admin::Setting');
$routes->get('Admin/Setting', 'Admin::Setting');
// Rute untuk menampilkan halaman
$routes->get('Admin/Setting', 'Admin::Setting');

// Tambahkan baris ini untuk memproses simpan data (POST)
$routes->post('Admin/UpdateSetting', 'Admin::UpdateSetting');
