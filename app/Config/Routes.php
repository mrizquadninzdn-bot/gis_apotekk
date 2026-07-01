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
$routes->get('Apotek/Edit/(:num)', 'Apotek::Edit/$1');
$routes->post('Apotek/UpdateData/(:num)', 'Apotek::UpdateData/$1');

// Rute Setting
$routes->get('admin/setting', 'Admin::Setting');
$routes->get('Admin/Setting', 'Admin::Setting');
// Rute untuk menampilkan halaman
$routes->get('Admin/Setting', 'Admin::Setting');

// Tambahkan baris ini untuk memproses simpan data (POST)
$routes->post('Admin/UpdateSetting', 'Admin::UpdateSetting');
$routes->get('apotek', 'Apotek::index');

$routes->get('Apotek', 'Apotek::index');
$routes->get('Apotek/Input', 'Apotek::Input');
$routes->post('Apotek/Kabupaten', 'Apotek::Kabupaten');
$routes->post('Apotek/Kecamatan', 'Apotek::Kecamatan');
$routes->post('Apotek/InsertData', 'Apotek::InsertData');
$routes->get('Apotek/Edit/(:num)', 'Apotek::Edit');
$routes->post('Apotek/UpdateData/(:num)', 'Apotek::UpdateData');
$routes->get('Apotek/Delete/(:num)', 'Apotek::DeleteData/$1');
// TAMBAHKAN BARIS INI DI SEKITAR RUTE APOTEK LAINNYA
$routes->get('Apotek/Detail/(:num)', 'Apotek::DetailData/$1');

$routes->get('User', 'User::index');
$routes->get('User/Input', 'User::input'); // <-- TAMBAHKAN BARIS INI
$routes->post('User/InsertData', 'User::InsertData');
$routes->get('User/Edit/(:any)', 'User::Edit/$1');
$routes->post('User/UpdateData/(:any)', 'User::UpdateData/$1');

