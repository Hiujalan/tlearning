<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Aplikasi');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// routes app
$routes->get('/', 'Aplikasi::index');
$routes->post('/proses_login', 'Aplikasi::proseslogin');
$routes->get('/logout', 'Aplikasi::logout');
$routes->post('/saveimage', 'Aplikasi::saveimage');
$routes->get('/login/google', 'Aplikasi::google');
$routes->get('/login/google_telp', 'Aplikasi::googletelp');
$routes->post('/login/proses_google_telp', 'Aplikasi::prosesgoogletelp');

$routes->post('/proses_upgrade_user(:any)', 'Aplikasi::prosesupgradeuser');
$routes->post('/proses_downgrade_user(:any)', 'Aplikasi::prosesdowngradeuser');
$routes->get('/upgrade_user', 'Aplikasi::upgradeuser');

$routes->get('/register', 'Aplikasi::register');
$routes->post('/proses_register', 'Aplikasi::prosesregister');
$routes->get('/verifikasi', 'Aplikasi::verifikasi');
$routes->post('/proses_verifikasi', 'Aplikasi::prosesverifikasi');

$routes->get('/home', 'Aplikasi::home');
$routes->get('/cari', 'Aplikasi::cari');
$routes->get('/ajax_cari', 'Aplikasi::ajaxcari');
$routes->post('/proses_tambah_sub(:any)', 'Aplikasi::prosestambahsub/$1');
$routes->get('/edit_sub(:any)', 'Aplikasi::editsub');
$routes->get('/hapus_sub(:any)', 'Aplikasi::hapussub/$1');
$routes->post('/proses_edit_sub(:any)', 'Aplikasi::proseseditsub/$1');

$routes->get('/temapelajaran(:any)', 'Aplikasi::subtema/$1');
$routes->get('/edit_tema(:any)', 'Aplikasi::edittema/$1');
$routes->get('/hapus_tema(:any)', 'Aplikasi::hapustema/$1');
$routes->post('/proses_edit_tema(:any)', 'Aplikasi::prosesedittema/$1');
$routes->post('/proses_tambah_tema', 'Aplikasi::prosestambahtema/$1');
$routes->get('/tema(:any)', 'Aplikasi::tema');

$routes->get('/hapus_pembelajaran(:any)', 'Aplikasi::hapuspembelajaran/$1');
$routes->get('/tambah_pembelajaran(:any)', 'Aplikasi::tambahpembelajaran/$1');
$routes->get('/edit_pembelajaran(:any)', 'Aplikasi::editpembelajaran/$1');
$routes->get('/edit(:any)', 'Aplikasi::editpembelajarandata/$1');

$routes->post('/proses_tambah_pemebelajaran(:any)', 'Aplikasi::prosestambahpembelajaran');
$routes->post('/proses_edit_pembelajaran_data(:any)', 'Aplikasi::proseseditpembelajarandata');
$routes->get('/pembelajaran(:any)', 'Aplikasi::pembelajaran/$1');
$routes->get('/download_file(:any)', 'Aplikasi::downloadfile/$1');
$routes->get('/quiz_data(:any)', 'Aplikasi::quizdata/$1');
$routes->get('/quiz_end(:any)download_image', 'Aplikasi::downloadimage/$1');
$routes->post('/quiz_end(:any)screenshot', 'Aplikasi::saveimage/$1');

$routes->get('/quiz_end(:any)sharefacebook', 'Aplikasi::sharefacebook/$1');
$routes->post('/quiz_end(:any)facebookLogin', 'Aplikasi::facebookLogin/$1');

$routes->get('/quiz_end(:any)', 'Aplikasi::quizend/$1');
$routes->get('/quiz(:any)', 'Aplikasi::quiz/$1');
$routes->post('/quiz_selanjutnya(:any)', 'Aplikasi::quizselanjutnya/$1');
$routes->get('/create_quiz(:any)', 'Aplikasi::createquiz/$1');
$routes->post('/proses_create_quiz(:any)', 'Aplikasi::prosescreatequiz/$1');
$routes->get('/soal_end(:any)', 'Aplikasi::soalend/$1');
$routes->post('/proses_soal_end(:any)', 'Aplikasi::prosessoalend/$1');
$routes->get('/soal(:any)', 'Aplikasi::soal/$1');
$routes->get('/create_soal(:any)', 'Aplikasi::createsoal/$1');
$routes->post('/proses_create_soal(:any)', 'Aplikasi::prosescreatesoal/$1');
$routes->post('/save_soal(:any)', 'Aplikasi::savesoal/$1');

$routes->get('/diskusi(:any)', 'Aplikasi::diskusi/$1');
$routes->post('/proses_diskusi(:any)', 'Aplikasi::prosesdiskusi/$1');

$routes->post('/test(:any)', 'Aplikasi::test/$1');

$routes->get('/user(:any)', 'Aplikasi::user/$1');
$routes->post('/update_user(:any)', 'Aplikasi::updateuser');

// routes backend
$routes->get('/login', 'Backend::index');
$routes->post('/proses_login_be', 'Backend::prosesloginbe');
$routes->get('/home_be', 'Backend::home');

$routes->get('/be_tema', 'Backend::tema');
$routes->post('/be_proses_tambah_tema', 'Backend::prosestambahtema');
$routes->get('/be_edit_tema(:any)', 'Backend::edittema');
$routes->post('/be_proses_edit_tema(:any)', 'Backend::prosesedittema');
$routes->get('/be_hapus_tema(:any)', 'Backend::hapustema');

$routes->get('/be_subtema', 'Backend::subtema');
$routes->post('/be_proses_tambah_sub', 'Backend::prosestambahsub');
$routes->get('/be_edit_sub(:any)', 'Backend::editsub');
$routes->post('/be_proses_edit_sub(:any)', 'Backend::proseseditsub');
$routes->get('/be_hapus_sub(:any)', 'Backend::hapussub');

$routes->get('/be_pembelajaran', 'Backend::pembelajaran');
$routes->get('/be_tambah_pembelajaran', 'Backend::tambahpembelajaran');
$routes->post('/be_proses_tambah_pemebelajaran', 'Backend::prosestambahpembelajaran');
$routes->get('/be_edit_pembelajaran(:any)', 'Backend::editpembelajarandata');
$routes->post('/be_proses_edit_pembelajaran_data(:any)', 'Backend::proseseditpembelajarandata');
$routes->get('/be_hapus_pembelajaran_data(:any)', 'Backend::hapuspembelajarandata');

$routes->get('/be_quiz(:any)', 'Backend::quiz');
$routes->get('/be_create_quiz(:any)', 'Backend::createquiz');
$routes->post('/be_proses_create_quiz(:any)', 'Backend::prosescreatequiz');
$routes->get('/be_edit_quiz(:any)', 'Backend::editquiz');
$routes->post('/be_proses_edit_quiz(:any)', 'Backend::proseseditquiz');
$routes->get('/be_hapus_quiz(:any)', 'Backend::hapusquiz');

$routes->get('/be_soal(:any)', 'Backend::soal');
$routes->get('/be_create_soal(:any)', 'Backend::createsoal');
$routes->post('/be_proses_create_soal(:any)', 'Backend::prosescreatesoal');
$routes->get('/be_edit_soal(:any)', 'Backend::editsoal');
$routes->post('/be_proses_edit_soal(:any)', 'Backend::proseseditsoal');
$routes->get('/be_hapus_soal(:any)', 'Backend::hapussoal');

$routes->get('/nilai_soal', 'Backend::nilaisoal');
$routes->get('/be_nilai_soal_data(:any)', 'Backend::nilaisoaldata');

$routes->get('/nilai_quiz', 'Backend::nilaiquiz');
$routes->get('/be_daftar_nilai_quiz_data(:any)', 'Backend::daftarnilaiquiz');
$routes->get('/be_nilai_quiz_data(:any)', 'Backend::nilaiquizdata');

$routes->get('/guru', 'Backend::guru');
$routes->post('/be_proses_guru', 'Backend::prosesguru');
$routes->get('/be_edit_guru(:any)', 'Backend::editguru');
$routes->post('/be_proses_edit_guru(:any)', 'Backend::proseseditguru');
$routes->get('/be_hapus_guru(:any)', 'Backend::hapusguru');

$routes->get('/murid', 'Backend::murid');
$routes->post('/be_proses_murid', 'Backend::prosesmurid');
$routes->get('/be_edit_murid(:any)', 'Backend::editmurid');
$routes->post('/be_proses_edit_murid(:any)', 'Backend::proseseditmurid');
$routes->get('/be_hapus_murid(:any)', 'Backend::hapusmurid');

$routes->get('/email', 'Backend::email');
$routes->post('/email', 'Backend::editemail');

$routes->get('/admin', 'Backend::admin');
$routes->post('/be_proses_admin', 'Backend::prosesadmin');
$routes->get('/be_edit_admin(:any)', 'Backend::editadmin');
$routes->post('/be_proses_edit_admin(:any)', 'Backend::proseseditadmin');
$routes->get('/be_hapus_admin(:any)', 'Backend::hapusadmin');

$routes->get('/logout_be', 'Backend::logout');

$routes->get('/be_ekspor_excel_quiz(:any)', 'Backend::eksporexcelquiz');
$routes->get('/be_ekspor_excel_soal(:any)', 'Backend::eksporexcelsoal');
$routes->get('/be_ekspor_excel_nilai_soal(:any)', 'Backend::eksporexcelnilaisoal');
$routes->get('/be_ekspor_excel_nilai_quiz(:any)', 'Backend::eksporexcelnilaiquiz');

$routes->get('/be_ekspor_pdf_soal(:any)', 'Backend::eksporpdfsoal');
$routes->get('/be_ekspor_pdf_quiz(:any)', 'Backend::eksporpdfquiz');
$routes->get('/be_ekspor_pdf_nilaisoal(:any)', 'Backend::eksporpdfnilaisoal');
$routes->get('/be_ekspor_pdf_nilaiquiz(:any)', 'Backend::eksporpdfnilaiquiz');

$routes->post('/importQuiz(:any)', 'Backend::importquiz');
$routes->post('/importSoal(:any)', 'Backend::importsoal');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
