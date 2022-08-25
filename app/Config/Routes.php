<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'WebHomeController::indexmitra', ['filter' => 'authmitra']);

// Login Administrator
$routes->get('/admin/login', 'WebLoginController::indexadministrator');
$routes->post('/admin/login/ceklogin', 'WebLoginController::cekloginadministrator');
$routes->get('/logout', 'WebLoginController::logoutadministrator', ['filter' => 'auth']);
// Login Mitra
$routes->get('/mitra/login', 'WebLoginController::indexMitra');
$routes->post('/mitra/login/ceklogin', 'WebLoginController::cekloginmitra');
$routes->get('/mitra/logout', 'WebLoginController::logoutmitra', ['filter' => 'authmitra']);

$routes->get('/admin', 'WebHomeController::indexadmin', ['filter' => 'auth']);
$routes->get('/mitra/mitra', 'WebHomeController::indexmitra', ['filter' => 'authmitra']);

// Mitra 
$routes->get('/mitra', 'AdminMitraController::index', ['filter' => 'auth']);
$routes->post('/mitra/save', 'AdminMitraController::save');
$routes->post('/mitra/edit', 'AdminMitraController::edit');
$routes->post('/mitra/delete', 'AdminMitraController::delete');
$routes->get('/mitra/report', 'AdminMitraController::report');
$routes->post('/mitra/tambah', 'AdminMitraController::tambah');

// Nasabah Administrator
$routes->get('/nasabah', 'AdminNasabahController::index', ['filter' => 'auth']);
$routes->post('/nasabah/save', 'AdminNasabahController::save');
$routes->post('/nasabah/edit', 'AdminNasabahController::edit');
$routes->post('/nasabah/delete', 'AdminNasabahController::delete');
$routes->get('/nasabah/report', 'AdminNasabahController::report');
$routes->get('/tambah-data-nasabah', 'AdminNasabahController::tambah');
$routes->post('/nasabah/reset', 'AdminNasabahController::reset');

// Nasabah Mitra
$routes->get('/mitra/nasabah', 'WebNasabahController::indexmitra', ['filter' => 'authmitra']);
$routes->post('/mitra/nasabah/save', 'WebNasabahController::savemitra', ['filter' => 'authmitra']);
$routes->post('/mitra/nasabah/edit', 'WebNasabahController::editmitra', ['filter' => 'authmitra']);
$routes->post('/mitra/nasabah/delete', 'WebNasabahController::deletemitra', ['filter' => 'authmitra']);
$routes->get('/mitra/nasabah/report', 'WebNasabahController::reportmitra', ['filter' => 'authmitra']);
$routes->post('/mitra/nasabah/reset', 'WebNasabahController::resetmitra', ['filter' => 'authmitra']);

// Administrator
$routes->get('/administrator', 'AdminAdministratorController::index');
$routes->post('/administrator/save', 'AdminAdministratorController::save');
$routes->post('/administrator/edit', 'AdminAdministratorController::edit');
$routes->post('/administrator/delete', 'AdminAdministratorController::delete');
$routes->post('/administrator/reset', 'AdminAdministratorController::reset');
$routes->get('/administrator/report', 'AdminAdministratorController::report');

// Kategori
$routes->get('/kategori', 'AdminKategoriController::index');
$routes->post('/kategori/save', 'AdminKategoriController::save');
$routes->post('/kategori/edit', 'AdminKategoriController::edit');
$routes->post('/kategori/delete', 'AdminKategoriController::delete');
$routes->get('/kategori/report', 'AdminKategoriController::report');

// Mitra
$routes->get('/mitra/mitra', 'AdminMitraController::index');
$routes->post('/mitra/mitra/save', 'AdminMitraController::save');
$routes->post('/mitra/mitra/edit', 'AdminMitraController::edit');
$routes->post('/mitra/mitra/delete', 'AdminMitraController::delete');
$routes->get('/mitra/mitra/report', 'AdminMitraController::report');
$routes->post('/mitra/mitra/tambah', 'AdminMitraController::tambah');
$routes->get('/tambah_data_mitra', 'AdminMitraController::tambah');
$routes->post('/mitra/mitra/reset', 'AdminMitraController::reset');

// Sampah Administrator
$routes->get('/sampah', 'AdminSampahController::index');
$routes->post('/sampah/save', 'AdminSampahController::save');
$routes->post('/sampah/edit', 'AdminSampahController::edit');
$routes->post('/sampah/delete', 'AdminSampahController::delete');
$routes->get('/sampah/report', 'AdminSampahController::report');
$routes->post('/sampah/tambah', 'AdminSampahController::tambah');
$routes->get('/tambah_data_sampah', 'AdminSampahController::tambah');
$routes->get('/update-sampah', 'AdminSampahController::update');

// Sampah Mitra
$routes->get('/mitra/sampah', 'WebSampahController::index', ['filter' => 'authmitra']);
$routes->post('/mitra/sampah/save', 'WebSampahController::save', ['filter' => 'authmitra']);
$routes->post('/mitra/sampah/edit', 'AdminSampahController::edit', ['filter' => 'authmitra']);
$routes->post('/mitra/sampah/delete', 'WebSampahController::delete', ['filter' => 'authmitra']);
$routes->get('/mitra/sampah/report', 'WebSampahController::report', ['filter' => 'authmitra']);

// Penjualan Mitra
$routes->get('/mitra/penjualan', 'WebPenjualanController::index', ['filter' => 'authmitra']);
$routes->get('/mitra/penjualan/detail/(:segment)', 'WebPenjualanController::detailmitra/$1', ['filter' => 'authmitra']);
$routes->post('/mitra/penjualan/edit', 'WebPenjualanController::editmitra', ['filter' => 'authmitra']);
$routes->get('/mitra/penjualan/report', 'WebPenjualanController::reportmitra', ['filter' => 'authmitra']);
$routes->get('/laporan-mitra-transaksi-penjualan', 'WebPenjualanController::nasabahperbulan', ['filter' => 'authmitra']);

// Penjualan Admin
$routes->get('/penjualan', 'AdminPenjualanController::index');
$routes->post('/penjualan/save', 'AdminPenjualanController::save');
$routes->post('/penjualan/edit', 'AdminPenjualanController::edit');
$routes->post('/penjualan/delete', 'AdminPenjualanController::delete');
$routes->get('/tambah_data_penjualan', 'AdminPenjualanController::tambah');
$routes->get('/penjualan/report', 'AdminPenjualanController::report');
$routes->get('/penjualan/detail/', 'AdminPenjualanController::detail');


// Penarikan Mitra
$routes->get('/mitra/penarikan', 'WebPenarikanController::index', ['filter' => 'authmitra']);
$routes->post('/mitra/penarikan/edit', 'WebPenarikanController::editmitra', ['filter' => 'authmitra']);
$routes->get('/mitra/penarikan/report', 'WebPenarikanController::reportmitra', ['filter' => 'authmitra']);
$routes->get('/laporan-mitra-transaksi-penarikan', 'WebPenarikanController::penarikanperbulan', ['filter' => 'authmitra']);

//Penarikan Admin
$routes->get('/penarikan', 'AdminPenarikanController::index');
$routes->post('/penarikan/save', 'AdminPenarikanController::save');
$routes->post('/penarikan/edit', 'AdminPenarikanController::edit');
$routes->post('/penarikan/delete', 'AdminPenarikanController::delete');
$routes->get('/penarikan/report', 'AdminPenarikanController::report');

//Laporan
$routes->get('/laporan', 'LaporanController::index');
$routes->post('nasabahperbulan', 'LaporanController::nasabahperbulan');
$routes->post('/mitraperbulan', 'LaporanController::mitraperbulan');
$routes->post('/sampahperbulan', 'LaporanController::sampahperbulan');
$routes->get('laporan-transaksi', 'LaporanController::indextransaksi');
$routes->post('/laporan-transaksi-penjualan', 'LaporanController::penjualan');
$routes->post('/laporan-transaksi-penarikan', 'LaporanController::penarikan');

//Laporan Mitra
$routes->get('/mitra/laporan-master', 'LaporanMitraController::mitraindex', ['filter' => 'authmitra']);
$routes->get('/mitra/laporan-transaksi', 'LaporanMitraController::mitraindextransaksi', ['filter' => 'authmitra']);
$routes->get('/mitra/nasabahperbulan', 'LaporanMitraController::mitranasabahperbulan', ['filter' => 'authmitra']);

// Profile
$routes->get('/mitra/profil', 'ProfileController::index', ['filter' => 'auth']);
$routes->post('/profil/edit', 'ProfileController::edit', ['filter' => 'auth']);

// Route API
$routes->post('/api/login', 'NasabahController::login');
$routes->post('/api/register', 'NasabahController::register');
$routes->post('/api/edit-password', 'NasabahController::editpassword');
$routes->post('/api/edit-nama', 'NasabahController::editnama');

$routes->get('/api/nasabah/saldo/(:segment)', 'NasabahController::saldo/$1');

$routes->get('/api/sampah/list/(:segment)', 'SampahController::list/$1');
$routes->get('/api/sampah/pencarian/(:segment)/(:segment)', 'SampahController::pencarian/$1/$2');
$routes->get('/api/sampah/detail/(:segment)', 'SampahController::detail/$1');
$routes->get('/api/sampah/filter/kategori/(:segment)', 'SampahController::filterCategory/$1');

$routes->get('/api/kategori', 'KategoriController::list');

$routes->post('/api/penarikan/save', 'PenarikanController::save');
$routes->get('/api/penarikan/riwayat/(:segment)', 'PenarikanController::riwayat/$1');
$routes->get('/api/penarikan/riwayat/detail/(:segment)', 'PenarikanController::riwayatdetail/$1');

$routes->post('/api/penjualan/save', 'PenjualanController::savelangsung');
$routes->post('/api/penjualan/change-status', 'PenjualanController::changestatus');
$routes->post('/api/penjualan/save-banyak', 'PenjualanController::savebanyak');
$routes->get('/api/penjualan/riwayat/(:segment)', 'PenjualanController::riwayat/$1');
$routes->get('/api/penjualan/riwayat/detail/(:segment)', 'PenjualanController::riwayatdetail/$1');
$routes->get('/api/penjualan/riwayat/detail/penjualan/(:segment)', 'PenjualanController::riwayatdetailpenjualan/$1');

$routes->get('/api/keranjang/list/(:segment)', 'KeranjangController::list/$1');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}