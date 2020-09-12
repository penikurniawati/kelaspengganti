<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

//------------- ROUTE UNTUK LOGIN DAN LOGOUT USER ---------
$route['loginUserR'] = 'LoginUserC';
$route['signinUserR'] = 'LoginUserC/signin';
$route['logoutUserR'] = 'LogoutUserC';

//------------- ROUTE UNTUK LOGIN DAN LOGOUT ADMIN ---------
$route['loginAdmin'] = 'LoginC';
$route['signinR'] = 'LoginC/signin';
$route['logoutR'] = 'LogoutC';

$route['noAksesR'] = 'NoAksesC';
$route['noAksesR2'] = 'NoAksesC/cekRole';
//------------- ROUTE ADMIN ----------------
$route['jadwalAdminR'] = 'JadwalAdminC';
$route['matkulAdminR'] = 'MatkulAdminC';
$route['dosenAdminR'] = 'DosenAdminC';
$route['mahasiswaAdminR'] = 'MahasiswaAdminC';
$route['ruangAdminR'] = 'RuangAdminC';
$route['kelasAdminR'] = 'KelasAdminC';
$route['akunAdminR'] = 'AkunAdminC';
$route['waktuAdminR'] = 'WaktuAdminC';
$route['tahunAjaranAdminR'] = 'TahunAjaranAdminC';
$route['dashboardAdminR'] = 'DashboardAdminC';
//ROUTE JADWAL ADMIN
$route['inputJadwal'] = 'JadwalAdminC/inputJadwal';
$route['ubahJadwal'] = 'JadwalAdminC/ubahJadwal';
$route['importJadwal'] = 'JadwalAdminC/uploadJadwal';
$route['hapusJadwal'] = 'JadwalAdminC/hapusJadwal';
// ROUTE MATKUL ADMIN
$route['inputMatkul'] = 'MatkulAdminC/inputMatkul';
$route['editMatkul'] = 'MatkulAdminC/editMatkul';
$route['importMatkul'] = 'MatkulAdminC/uploadMatkul';
$route['hapusMatkul'] = 'MatkulAdminC/hapusMatkul';
// ROUTE AKUN ADMIN
$route['inputAkun'] = 'AkunAdminC/inputAkun';
$route['editAkun'] = 'AkunAdminC/editAkun';
$route['importAkun'] = 'AkunAdminC/UploadAkun';
$route['hapusAkun'] = 'AkunAdminC/hapusAkun';
$route['resetPassword'] = 'AkunAdminC/resetPassword';
// ROUTE KELAS ADMIN
$route['inputKelas'] = 'KelasAdminC/inputKelas';
$route['editKelas'] = 'KelasAdminC/editKelas';
$route['hapusKelas'] = 'KelasAdminC/hapusKelas';
//ROUTE DOSEN ADMIN
$route['inputDosen'] = 'DosenAdminC/inputDosen';
$route['ubahDosen'] = 'DosenAdminC/editDosen';
//ROUTE MAHASISWA ADMIN
$route['inputMahasiswa'] = 'MahasiswaAdminC/inputMahasiswa';
$route['ubahMahasiswa'] = 'MahasiswaAdminC/ubahMahasiswa';
$route['importMahasiswa'] = 'MahasiswaAdminC/uploadMahasiswa';
$route['hapusMahasiswa'] = 'MahasiswaAdminC/hapusMahasiswa';
//ROUTE KELAS ADMIN
$route['inputKelas'] = 'KelasAdminC/inputKelas';
$route['ubahKelas'] = 'KelasAdminC/ubahKelas';
$route['hapusKelas'] = 'KelasAdminC/hapusKelas';
$route['detailKelas/(:num)'] = 'KelasAdminC/detailKelas/$1'; //ini untuk get parameter yaitu parameter 1
$route['inputKelasMhs'] = 'KelasAdminC/inputKelasMahasiswa';
$route['ubahKelasMhs'] = 'KelasAdminC/editKelasMahasiswa';
$route['importKelas'] = 'KelasAdminC/UploadKelas';
$route['importKelasMahasiswa'] = 'KelasAdminC/UploadKelasMahasiswa';
$route['nonaktifKelas'] = 'KelasAdminNonAktifC';
$route['aksiNonaktifKelas'] = 'KelasAdminNonAktifC/nonAktifKelas';
//ROUTE RUANG ADMIN
$route['inputRuang'] = 'RuangAdminC/inputRuang';
$route['ubahRuang'] = 'RuangAdminC/ubahRuang';
$route['importRuang'] = 'RuangAdminC/uploadRuang';
$route['hapusRuang'] = 'RuangAdminC/hapusRuang';
// ROUTE WAKTU ADMIN
$route['inputWaktu'] = 'WaktuAdminC/inputWaktu';
$route['editWaktu'] = 'WaktuAdminC/editWaktu';
$route['hapusWaktu'] = 'WaktuAdminC/hapusWaktu';
// ROUTE TAHUN AJARAN ADMIN
$route['inputTahunAjaran'] = 'TahunAjaranAdminC/inputTahunAjaran';
$route['editTahunAjaran'] = 'TahunAjaranAdminC/editTahunAjaran';
$route['hapusTahunAjaran'] = 'TahunAjaranAdminC/hapusTahunAjaran';
$route['aktifasiTahunAjaran/(:num)'] = 'TahunAjaranAdminC/aktifasiTahunAjaran/$1';
$route['detailTahunAjaran/(:num)'] = 'TahunAjaranAdminC/detailTahunAjaran/$1';

//-------------- ROUTE AKADEMIK ---------------
$route['jadwalAkademikR'] = 'JadwalAkademikC';
$route['matkulAkademikR'] = 'MatkulAkademikC';
$route['dosenAkademikR'] = 'DosenAkademikC';
$route['mahasiswaAkademikR'] = 'MahasiswaAkademikC';
$route['ruangAkademikR'] = 'ruangAkademikC';
$route['penggantiAkademik'] = 'penggantiAkademikC';
$route['penggantiPermanenAkademik'] = 'penggantiPermanenC';
$route['penggantiPermanenDosen'] = 'penggantiPermanenC/penggantiPermanenDosen';
//========================================================================
$route['presensiHadirR/(:num)/(:any)/(:any)'] = 'JadwalAkademikC/hadir/$1/$2/$3';
$route['presensiAbsenR'] = 'JadwalAkademikC/absen';
// $route['kelasPenggantiR'] = 'JadwalAkademikC/kelasPengganti';
$route['kelasPenggantiR/(:num)/(:any)'] = 'JadwalAkademikC/tambahKelasPengganti/$1/$2';
$route['kelasPenggantiPR/(:num)/(:any)/(:num)'] = 'JadwalAkademikC/tambahKelasPenggantiP/$1/$2/$3';
$route['presensiHadirPenggantiR/(:num)/(:any)/(:any)'] = 'JadwalAkademikC/hadirPengganti/$1/$2/$3';
//========================================================================

$route['kelasAkademikR'] = 'kelasAkademikC';
$route['detailKelasAkademik/(:num)'] = 'KelasAkademikC/detailKelas/$1';
$route['kehadiranAkademikR'] = 'kehadiranAkademikC';
$route['penggantiAkademikLR'] = 'penggantiAkademikLC';
//----------------- ROUTE PRESENSI ---------------
$route['presensiHadirR/(:num)'] = 'JadwalAkademikC/hadir/$1';
$route['presensiAbsenR'] = 'JadwalAkademikC/absen';
//-------------- ROUTE KELAS PENGGANTI ---------------
$route['kelaspenggantiR/(:num)/(:any)'] = 'JadwalAkademikC/tambahKelasPengganti/$1/$2';
$route['inputKelasPengganti'] = 'JadwalAkademikC/addKelasPengganti';

// <<<<<<< HEAD
// //---------- ROUTE MATKUL ADMIN ----------
// $route['inputMatkul'] = 'MatkulAdminC/inputMatkul';
// $route['editMatkul'] = 'MatkulAdminC/editMatkul';

// //---------- ROUTE RUANG ADMIN ----------
// $route['inputRuang'] = 'RuangAdminC/inputRuang';
// $route['editRuang'] = 'RuangAdminC/editRuang';
// =======
//-------------- ROUTE DOSEN ---------------
$route['jadwalDosenR'] = 'JadwalDosenC';
$route['matkulDosenR'] = 'MatkulDosenC';
$route['kelasDosenR'] = 'KelasDosenC';
$route['detailKelasDosen/(:num)'] = 'KelasDosenC/detailKelas/$1';
$route['kehadiranDosenR'] = 'KehadiranDosenC';
$route['profilDosenR'] = 'ProfilDosenC';
$route['editProfilDosenR'] = 'ProfilDosenC/editProfilDosen';
$route['editPasswordDosenR'] = 'ProfilDosenC/ubahPassowrdDosen';
$route['ubahPassDosenR'] = 'ProfilDosenC/ubahPasswordDosen';
$route['penggantiDosen'] = 'penggantiDosenC';
// ------------ ROUTE KELAS PENGGANTI DOSEN --------------
$route['kelasPenggantiDosenR/(:num)/(:any)'] = 'JadwalDosenC/tambahKelasPenggantiDosen/$1/$2';
$route['kelasPenggantiDosenPR/(:num)/(:any)/(:num)'] = 'JadwalDosenC/tambahKelasPenggantiDosenP/$1/$2/$3';
$route['inputKelasPenggantiDosen'] = 'JadwalDosenC/addKelasPengganti';