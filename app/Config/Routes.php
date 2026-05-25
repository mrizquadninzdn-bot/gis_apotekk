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
$routes->get('Wilayah/Input', 'Wilayah::Input');
$routes->post('Wilayah/InsertData', 'Wilayah::InsertData');
$routes->get('Wilayah/Edit/(:num)', 'Wilayah::Edit/$1');
$routes->post('Wilayah/UpdateData/(:num)', 'Wilayah::UpdateData/$1');
$routes->get('Wilayah/Delete/(:num)', 'Wilayah::Delete/$1');
$routes->get('Jenjang', 'Jenjang::index');
$routes->post('Jenjang/UpdateData/(:num)', 'Jenjang::UpdateData/$1');


// Rute Setting
$routes->get('admin/setting', 'Admin::Setting');
$routes->get('Admin/Setting', 'Admin::Setting');
// Rute untuk menampilkan halaman
$routes->get('Admin/Setting', 'Admin::Setting');

// Tambahkan baris ini untuk memproses simpan data (POST)
$routes->post('Admin/UpdateSetting', 'Admin::UpdateSetting');
$routes->get('apotek', 'Apotek::index');$routes->get('Apotek/Input', 'Apotek::Input');
