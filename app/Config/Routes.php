<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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
$routes->get('/', 'Auth/Login::index');
$routes->get('/login', 'Auth/Login::index');
$routes->get('/logout', 'Auth/Login::logout');
$routes->get('/dashboard', 'Page::dashboard');
$routes->get('/lembaga', 'Profil/Lembaga::index');
$routes->get('/index', 'Manage/Rolemenu::index');

$routes->get('/daftarkelembagaan', 'Profil/Guest::daftarkelembagaan');
$routes->get('/dl_kab', 'Profil/Guest::daftarkelembagaankab');
$routes->get('/dl_kec', 'Profil/Guest::daftarkelembagaankec');
$routes->get('/profilbpp', 'Profil/Guest::profilbpp');
$routes->get('/rekap_keluh', 'Profil/Guest::rekapkeluh');
$routes->get('/rekapkec', 'Profil/Guest::rekapkeluhkec');
$routes->get('/Profil_bpp', 'Profil/Guest::rekapkelembagaan');
$routes->get('/rkp_bpp', 'Profil/Guest::rekapbpp');
$routes->get('/rekap_profbpp', 'Profil/Guest::rekapprofbpp');
$routes->get('/rekap_bpp', 'Profil/Guest::rekapexcbpp');
$routes->get('/daftarketenagaan', 'Profil/Guest::daftarketenagaan');
$routes->get('/dk_prop', 'Profil/Guest::daftarketenagaankab');
$routes->get('/BppsdmpAktif', 'Profil/Guest::bppsdmpaktif');
$routes->get('/Bp2tpAktif', 'Profil/Guest::bp2tpaktif');
$routes->get('/BptpAktif', 'Profil/Guest::bptpaktif');
$routes->get('/PnsAktif', 'Profil/Guest::pnsaktif');
$routes->get('/PnsKabAktif', 'Profil/Guest::pnsaktifkab');
$routes->get('/ThlApbn', 'Profil/Guest::thlapbn');
$routes->get('/ThlApbn1', 'Profil/Guest::thlapbn1');
$routes->get('/ThlApbn2', 'Profil/Guest::thlapbn2');
$routes->get('/ThlApbn3', 'Profil/Guest::thlapbn3');
$routes->get('/ThlApbnslta', 'Profil/Guest::thlapbnslta');
$routes->get('/ThlApbnd3', 'Profil/Guest::thlapbnd3');
$routes->get('/ThlApbnd4', 'Profil/Guest::thlapbnd4');
$routes->get('/ThlApbns1', 'Profil/Guest::thlapbns1');
$routes->get('/ThlApbns2', 'Profil/Guest::thlapbns2');
$routes->get('/ThlApbnl35', 'Profil/Guest::thlapbnl35');
$routes->get('/ThlApbnk35', 'Profil/Guest::thlapbnk35');
$routes->get('/ThlApbd', 'Profil/Guest::thlapbd');
$routes->get('/Swadaya', 'Profil/Guest::swadaya');
$routes->get('/dk_kab', 'Profil/Guest::daftarketenagaankec');
$routes->get('/dk_kec', 'Profil/Guest::daftarpenyuluh');
$routes->get('/rk_umur', 'Profil/Guest::rekaptngumur');
$routes->get('/rekaptngumur_pst', 'Profil/Guest::rktenagapusat');
$routes->get('/rekaptngumur_prov', 'Profil/Guest::rktenagaprov');
$routes->get('/dk_thl_pend', 'Profil/Guest::thlpend');
$routes->get('/dk_thl_apbn', 'Profil/Guest::thlang');
$routes->get('/rekapthlang_kab', 'Profil/Guest::thlangkab');
$routes->get('/sarpras', 'Profil/Guest::sarpras');
$routes->get('/sarpras_kab', 'Profil/Guest::sarpraskab');
$routes->get('/sarpras_kec', 'Profil/Guest::sarpraskec');
$routes->get('/data_audit2012', 'Profil/Guest::audlhn');
$routes->get('/data_audit2012_kab', 'Profil/Guest::audlhnkab');
$routes->get('/data_audit2012_kec', 'Profil/Guest::audlhnkec');
$routes->get('/data_layanan', 'Profil/Guest::datadukung');
$routes->get('/data_layanan_kab', 'Profil/Guest::datadukungkab');
$routes->get('/data_layanan_kec', 'Profil/Guest::datadukungkec');
$routes->get('/powil_luaslahan', 'Profil/Guest::rekappowil');

//KelembagaanPelakuUtama
$routes->get('/daftarkelpenerimabantuan', 'profil/Guest::rekapkelpenbanprov');
$routes->get('/daftarkelpenerimabantuankab', 'profil/Guest::rekapkelpenbankab');

$routes->get('/daftarkelpenerimabantuankegiatan', 'profil/Guest::rekapkelpenbankegiatanProv');
$routes->get('/daftarkelpenerimabantuankegiatankab', 'profil/Guest::rekapkelpenbankegiatanKab');
$routes->get('/daftarkelpenerimabantuankegiatan11', 'profil/Guest::rekapkelpenbankegiatan11');
$routes->get('/daftarkelpenerimabantuankegiatan12', 'profil/Guest::rekapkelpenbankegiatan12');
$routes->get('/daftarkelpenerimabantuankegiatan13', 'profil/Guest::rekapkelpenbankegiatan13');
$routes->get('/daftarkelpenerimabantuankegiatan14', 'profil/Guest::rekapkelpenbankegiatan14');
$routes->get('/daftarkelpenerimabantuankegiatan15', 'profil/Guest::rekapkelpenbankegiatan15');
$routes->get('/daftarkelpenerimabantuankegiatan16', 'profil/Guest::rekapkelpenbankegiatan16');
$routes->get('/daftarkelpenerimabantuankegiatan17', 'profil/Guest::rekapkelpenbankegiatan17');
$routes->get('/daftarkelpenerimabantuankegiatan18', 'profil/Guest::rekapkelpenbankegiatan18');
$routes->get('/daftarkelpenerimabantuankegiatan21', 'profil/Guest::rekapkelpenbankegiatan21');
$routes->get('/daftarkelpenerimabantuankegiatan22', 'profil/Guest::rekapkelpenbankegiatan22');
$routes->get('/daftarkelpenerimabantuankegiatan23', 'profil/Guest::rekapkelpenbankegiatan23');
$routes->get('/daftarkelpenerimabantuankegiatan31', 'profil/Guest::rekapkelpenbankegiatan31');
$routes->get('/daftarkelpenerimabantuankegiatan32', 'profil/Guest::rekapkelpenbankegiatan32');
$routes->get('/daftarkelpenerimabantuankegiatan33', 'profil/Guest::rekapkelpenbankegiatan33');
$routes->get('/daftarkelpenerimabantuankegiatan34', 'profil/Guest::rekapkelpenbankegiatan34');
$routes->get('/daftarkelpenerimabantuankegiatan35', 'profil/Guest::rekapkelpenbankegiatan35');
$routes->get('/daftarkelpenerimabantuankegiatan36', 'profil/Guest::rekapkelpenbankegiatan36');
$routes->get('/daftarkelpenerimabantuankegiatan37', 'profil/Guest::rekapkelpenbankegiatan37');
$routes->get('/daftarkelpenerimabantuankegiatan61', 'profil/Guest::rekapkelpenbankegiatan61');
$routes->get('/daftarkelpenerimabantuankegiatan71', 'profil/Guest::rekapkelpenbankegiatan71');
$routes->get('/daftarkelpenerimabantuankegiatan72', 'profil/Guest::rekapkelpenbankegiatan72');

$routes->get('/daftarrekapkelembagaanpelakuutama', 'profil/Guest::rekapkelembagaanpelakuutamaProv');
$routes->get('/daftarrekapkelembagaanpelakuutamakab', 'profil/Guest::rekapkelembagaanpelakuutamaKab');
$routes->get('/daftarrekapkelembagaanpelakuutamakec', 'profil/Guest::rekapkelembagaanpelakuutamaKec');

$routes->get('/rekap_genluh', 'profil/Guest::rekappoktangenluh');
$routes->get('/rekap_genprov', 'profil/Guest::rekappoktangenprov');
$routes->get('/rekap_genprovdetail', 'profil/Guest::rekappoktangenprovdetail');
$routes->get('/rekap_genprovdetailkec', 'profil/Guest::rekappoktangenprovdetailkec');
$routes->get('/rekap_genprovdetaildesa', 'profil/Guest::rekappoktangenprovdetaildesa');
$routes->get('/rekap_genprovdetaildesalist', 'profil/Guest::rekappoktangenprovdetaildesalist');
$routes->get('/rekap_genprovanggota', 'profil/Guest::rekappoktangenprovanggota');
$routes->get('/rekap_kelaspoktan', 'profil/Guest::rekapkelaspoktan');
$routes->get('/rekap_kelaspoktankab', 'profil/Guest::rekapkelaspoktankab');
$routes->get('/rekap_kelaspoktankec', 'profil/Guest::rekapkelaspoktankec');
$routes->get('/rekap_kelaspoktandesa', 'profil/Guest::rekapkelaspoktandesa');
$routes->get('/rekap_kelaspoktandesa', 'profil/Guest::rekapkelaspoktandesa');
$routes->get('/rekap_jenispoktan', 'profil/Guest::rekapjenispoktan');
$routes->get('/rekap_jenispoktanexcel', 'profil/Guest::rekapjenispoktanexcel');
$routes->get('/rekap_jenispoktanexcelnak', 'profil/Guest::rekapjenispoktanexcelnak');
$routes->get('/rekap_jenispoktankab', 'profil/Guest::rekapjenispoktankab');
$routes->get('/rekap_jenispoktankec', 'profil/Guest::rekapjenispoktankec');
$routes->get('/rekap_jenispoktandesa', 'profil/Guest::rekapjenispoktandesa');
$routes->get('/rekap_jumlahanggotapoktan', 'profil/Guest::rekapjumlahanggotapoktan');
$routes->get('/rekap_jumlahanggotapoktankab', 'profil/Guest::rekapjumlahanggotapoktankab');
$routes->get('/rekap_jumlahanggotapoktankec', 'profil/Guest::rekapjumlahanggotapoktankec');
$routes->get('/rekap_jumlahanggotapoktandesa', 'profil/Guest::rekapjumlahanggotapoktandesa');
$routes->get('/rekap_jumlahanggotapoktandesalist', 'profil/Guest::rekapjumlahanggotapoktandesalist');



$routes->get('/penyuluhpns', 'Penyuluh/PenyuluhPns::penyuluhpns');
$routes->post('/penyuluhpns/showdesaadv', 'Penyuluh/PenyuluhPns::showDesaAdv');
$routes->get('/penyuluhcpns', 'Penyuluh/PenyuluhCpns::penyuluhcpns');
$routes->get('/penyuluhthlapbn', 'Penyuluh/PenyuluhTHLAPBN::penyuluhthlAPBN');
$routes->get('/penyuluhthlapbd', 'Penyuluh/PenyuluhTHLAPBD::penyuluhthlAPBD');
$routes->get('/penyuluhswadaya', 'Penyuluh/PenyuluhSwadaya::penyuluhswadaya');
$routes->get('/penyuluhswasta', 'Penyuluh/PenyuluhSwasta::penyuluhswasta');
$routes->get('/penyuluhpppk', 'Penyuluh/PenyuluhPPPK::penyuluhpppk');
$routes->get('/penyuluhswadayakec', 'Penyuluh/PenyuluhSwadayaKec::penyuluhswadayakec');
$routes->get('/penyuluhthlapbnkec', 'Penyuluh/PenyuluhTHLAPBNKec::penyuluhthlAPBNkec');
$routes->get('/penyuluhthlapbdkec', 'Penyuluh/PenyuluhTHLAPBDKec::penyuluhthlAPBDkec');
$routes->get('/penyuluhswastakec', 'Penyuluh/PenyuluhSwastaKec::penyuluhswastakec');
$routes->get('/penyuluhpnskec', 'Penyuluh/PenyuluhPNSKec::penyuluhpnskec');
$routes->get('/penyuluhpppkkec', 'Penyuluh/PenyuluhPPPKKec::penyuluhpppkkec');
$routes->get('/pendidikaninformalpns', 'Penyuluh/PendInFormalPns::detail');
$routes->get('/pakpns', 'Penyuluh/PakPNS::detail');
$routes->get('/penyuluhpnsprovinsi', 'Penyuluh/PenyuluhPnsProvinsi::penyuluhpns');
$routes->get('/penyuluhpppkprovinsi', 'Penyuluh/PenyuluhPppkProvinsi::penyuluhpppk');
$routes->get('/penyuluhnonaktifprovinsi', 'Penyuluh/PenyuluhPnsProvinsi::penyuluhnonaktif');
//$routes->get('profil/penyuluh/detail/(:any)', 'penyuluh::detail/$1');

//KelembagaanPelakuUtamaRoutes

$routes->get('/gapoktan', 'KelembagaanPelakuUtama/Gapoktan/Gapoktan::gapoktan');
$routes->get('/listgapoktan', 'KelembagaanPelakuUtama/Gapoktan/Gapoktan::listgapoktan');
$routes->get('/listgapoktandesa', 'KelembagaanPelakuUtama/Gapoktan/ListGapoktanDesa::listgapoktandesa');
$routes->post('/listgapoktan/save', 'KelembagaanPelakuUtama/Gapoktan/ListGapoktan::save');
$routes->get('/gapoktankec', 'KelembagaanPelakuUtama/Gapoktan/GapoktanKec::gapoktankec');

$routes->get('/gapoktanbersama', 'KelembagaanPelakuUtama/GapoktanBersama/GapoktanBersama::gapoktanbersama');

$routes->get('/kelembagaanekonomipetani', 'KelembagaanPelakuUtama/KelembagaanEkonomiPetani\KelembagaanEkonomiPetani::kelembagaanekonomipetani');
$routes->get('/listkep', 'KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KelembagaanEkonomiPetani::listkep');
$routes->get('/kepkec', 'KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KepKec::kepkec');
$routes->get('/kegiatanbun', 'KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KegiatanUsaha::kegiatanbun');

$routes->get('/kelompoktani', 'KelembagaanPelakuUtama/KelompokTani/KelompokTani::kelompoktani');
$routes->get('/kelompoktanikec', 'KelembagaanPelakuUtama/KelompokTani/KelompokTaniKec::kelompoktanikec');
$routes->get('/listpoktan', 'KelembagaanPelakuUtama/KelompokTani/KelompokTani::listpoktan');
$routes->get('/listpoktananggota', 'KelembagaanPelakuUtama/KelompokTani/ListPoktanAnggota::listpoktananggota');
$routes->get('/listbantu', 'KelembagaanPelakuUtama/KelompokTani/ListBantu::listbantu');
$routes->post('/listpoktan/save', 'KelembagaanPelakuUtama/Gapoktan/ListGapoktan::save');
$routes->get('/komoditasbun', 'KelembagaanPelakuUtama/KelompokTani/JenisKomoditasDiusahakan::komoditasbun');


$routes->get('/kelembagaanpetanilainnya', 'KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya::kelembagaanpetanilainnya');
$routes->get('/listkep2l', 'KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya::listkep2l');
$routes->get('/kep2lkec', 'KelembagaanPelakuUtama/KelembagaanPetaniLainnya/Kep2lKec::kep2lkec');

$routes->get('/desa', 'KelembagaanPenyuluhan/Desa/Desa::desa');
$routes->get('/daftar_posluhdes', 'KelembagaanPenyuluhan/Desa/Desa::listdesa');
$routes->get('/kabupaten_kota', 'KelembagaanPenyuluhan/Kabupaten/Kabupaten::kab');
$routes->get('/kecamatan', 'KelembagaanPenyuluhan/Kecamatan/Kecamatan::kecamatan');
$routes->get('/provinsi', 'KelembagaanPenyuluhan/Provinsi/Provinsi::prov');
$routes->get('/kecamatankec', 'KelembagaanPenyuluhan/Kecamatan/KecamatanKec::kecamatan');
$routes->get('/detail_kecamatan', 'KelembagaanPenyuluhan/Kecamatan/Kecamatan::profilkec');
$routes->get('/desakec', 'KelembagaanPenyuluhan/Desa/DesaKec::Desa');
$routes->get('/daftar_posluhdes_kec', 'KelembagaanPenyuluhan/Desa/DesaKec::listdesa');
//$routes->get('/add_pos', 'KelembagaanPenyuluhan/Desa/Desa::add_pos');
$routes->delete('/daftar_posluhdes/(:num)', 'KelembagaanPenyuluhan/Desa/Desa::delete/$1');
$routes->delete('/kecamatan/(:num)', 'KelembagaanPenyuluhan/Kecamatan/Kecamatan::delete/$1');

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
