<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama
$routes->get('/', 'Home::index');

// ==========================================
// RUTE API (HARUS DI TARUH PALING ATAS!)
// ==========================================
$routes->group('api', function ($routes) {
    $routes->get('apotek', 'Api::index');             // semua apotek
    $routes->get('apotek/geojson', 'Api::getApotek'); // GeoJSON untuk Leaflet (sebelum (:num))
    $routes->get('apotek/(:num)', 'Api::show/$1');    // detail 1 apotek
});

// Rute Admin
$routes->get('admin', 'Admin::index');
$routes->get('Admin', 'Admin::index');

// Rute Wilayah
$routes->get('Wilayah', 'Wilayah::index');
$routes->get('Wilayah/Input', 'Wilayah::Input');
$routes->post('Wilayah/InsertData', 'Wilayah::InsertData');
$routes->get('Wilayah/Edit/(:num)', 'Wilayah::Edit/$1');
$routes->post('Wilayah/UpdateData/(:num)', 'Wilayah::UpdateData/$1');
$routes->get('Wilayah/Delete/(:num)', 'Wilayah::Delete/$1');

// Rute Jenjang
$routes->get('Jenjang', 'Jenjang::index');
$routes->post('Jenjang/UpdateData/(:num)', 'Jenjang::UpdateData/$1');

// Rute Setting
$routes->get('admin/setting', 'Admin::Setting');
$routes->get('Admin/Setting', 'Admin::Setting');
$routes->post('Admin/UpdateSetting', 'Admin::UpdateSetting');

// Rute Apotek
$routes->get('apotek', 'Apotek::index');
$routes->get('Apotek', 'Apotek::index');
$routes->get('Apotek/Input', 'Apotek::Input');
$routes->post('Apotek/Kabupaten', 'Apotek::Kabupaten');
$routes->post('Apotek/Kecamatan', 'Apotek::Kecamatan');
$routes->post('Apotek/InsertData', 'Apotek::InsertData');
$routes->get('Apotek/Edit/(:num)', 'Apotek::Edit/$1');
$routes->post('Apotek/UpdateData/(:num)', 'Apotek::UpdateData/$1');
$routes->get('Apotek/Delete/(:num)', 'Apotek::DeleteData/$1');
$routes->get('Apotek/Detail/(:num)', 'Apotek::DetailData/$1');

// Rute User
$routes->get('User', 'User::index');
$routes->get('User/Input', 'User::input');
$routes->post('User/InsertData', 'User::InsertData');
$routes->get('User/Edit/(:any)', 'User::Edit/$1');
$routes->post('User/UpdateData/(:any)', 'User::UpdateData/$1');
$routes->get('User/Delete/(:any)', 'User::Delete/$1');

// Rute Auth / Login
$routes->get('Auth/Login', 'Auth::Login');
$routes->post('Auth/CekLogin', 'Auth::CekLogin');
$routes->get('Auth/Logout', 'Auth::Logout');

// Rute Feedback
$routes->post('home/kirim_feedback', 'Home::kirim_feedback');
