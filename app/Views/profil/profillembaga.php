<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $sessnama = session()->get('nama'); ?>
<?php
if (empty(session()->get('status_user')) || session()->get('status_user') == '2') {
    $kode = '00';
} elseif (session()->get('status_user') == '1') {
    $kode = session()->get('kodebakor');
} elseif (session()->get('status_user') == '200') {
    $kode = session()->get('kodebapel');
} elseif (session()->get('status_user') == '300') {
    $kode = session()->get('kodebpp');
}

$api = 'https://api.pertanian.go.id/api/simantap/dashboard/list?&api-key=f13914d292b53b10936b7a7d1d6f2406&kode=' . $kode;
$result = file_get_contents($api, false);
$json = json_decode($result, true);
$data = $json[0];
?>
<div class="container-fluid py-4">
    <div class="row">
        <?= $validation->getError(); ?>
        <!-- Page Heading -->
        <div class="row mt-3 mb-4">

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah BPP</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumbpp']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="far fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Poktan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpoktan']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Gapoktan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumgapoktan']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh PNS</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhpns']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBN</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhthlapbn']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBD</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhthlapbd']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swadaya</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhswadaya']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swasta</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhswasta']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh P3K</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhp3k']); ?>
                                    </h5>
                                </div>
                            </div> 
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah KEP</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumkep']); ?>
                                    </h5>
                                </div>
                            </div> 
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Gapoktan Bersama</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumgapoktanbersama']); ?>
                                    </h5>
                                </div>
                            </div> 
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Kelembagaan Lainnya</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhswasta']); ?>
                                    </h5>
                                </div>
                            </div> 
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah P2L</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpoktanp2l']); ?>
                                    </h5>
                                </div>
                            </div> 
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div class="row">

            <nav class="col-lg-12">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
                    <button class="nav-link" id="nav-penyuluh-tab" data-bs-toggle="tab" data-bs-target="#nav-penyuluh" type="button" role="tab" aria-controls="nav-penyuluh" aria-selected="false">Daftar Penyuluh</button>
                    <button class="nav-link" id="nav-lahancth-tab" data-bs-toggle="tab" data-bs-target="#nav-kegiatan" type="button" role="tab" aria-controls="nav-kegiatan" aria-selected="false">Kegiatan</button>
                    <!-- <button class="nav-link" id="nav-sarpras-tab" data-bs-toggle="tab" data-bs-target="#nav-sarpras" type="button" role="tab" aria-controls="nav-sarpras" aria-selected="false">Sarana & Prasarana</button>
                    <button class="nav-link" id="nav-pokom-tab" data-bs-toggle="tab" data-bs-target="#nav-pokom" type="button" role="tab" aria-controls="nav-pokom" aria-selected="false">Potensi Ekonomi</button>
                    <button class="nav-link" id="nav-powil-tab" data-bs-toggle="tab" data-bs-target="#nav-powil" type="button" role="tab" aria-controls="nav-powil" aria-selected="false">Potensi Wilayah</button> -->
                </div>
            </nav>
            <div class="tab-content " id="nav-tabContent">
                <div class="tab-pane  fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-lg-9 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">



                                        <h1 class="h3 mb-4 text-gray-800">
											<?= $title; ?>
											<div style="float:right">
												<a data-bs-toggle="modal" data-bs-target="#modal-form" id="btn-edit" data-id_gapoktan="<?= $dt['id_gapoktan']; ?>"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;
												<a href="<?php echo site_url('/profil/cetaklembaga'); ?>" target="_blank" id="btn-edit"><i class="fas fa-file-pdf"></i></a>
											</div>
											
										</h1>
																			
																			

                                        <div class="col-lg-12">
                                            <?php if (session()->get('status_user') == '1') { ?>
											<!--
                                                <table class="table">

                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Kelembagaan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['deskripsi_lembaga_lain']; ?> <?= $sessnama; ?></td>
                                                        </tr>
                                                         <tr>
                                                            <td>Tanggal Pembentukan</td>
                                                            <td>:</td>
                                                            <td><?= format_date($dt['thn_berdiri'] . '-' . $dt['bln_berdiri'] . '-' . $dt['tgl_berdiri'], 2).' ('.$dt['dasar_hukum'].' '.(($dt['no_peraturan'] <> '') ? ' No. '.$dt['no_peraturan']: '').')'; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td> <?= $dt['alamat']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Provinsi</td>
                                                            <td>:</td>
                                                            <td><?= $dt['kode_prop']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>No Telepon</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_kantor']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat Email</td>
                                                            <td>:</td>
                                                            <td><?= $dt['email']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat Website</td>
                                                            <td>:</td>
                                                            <td><?= $dt['website']; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Instagram Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['instagram'] <> '') ? '<a href="http://instagram.com/'.$dt['instagram'].'" target="_blank"><i class="fab fa-instagram"></i> '.$dt['instagram'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Facebook Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['facebook'] <> '') ? '<a href="http://facebook.com/'.$dt['facebook'].'" target="_blank"><i class="fab fa-facebook"></i> '.$dt['facebook'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Twitter Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['twitter'] <> '') ? '<a href="http://twitter.com/'.$dt['twitter'].'" target="_blank"><i class="fab fa-twitter"></i> '.$dt['twitter'].'</a>' : '' ; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Pimpinan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['ketua']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>No HP Pimpinan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_hp']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Koordinator PP</td>
                                                            <td>:</td>

                                                            <td><?php if ($dt['kode_koord_penyuluh'] == "1") {
                                                                    echo $dt['nama_koord_penyuluh'];
                                                                } elseif ($dt['kode_koord_penyuluh'] == "2") {
                                                                    echo $dt['nama_koord_penyuluh_thl'];
                                                                } elseif ($dt['kode_koord_penyuluh'] == "3") {
                                                                    echo $dt['koord_lainya_nama'];
                                                                } ?></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
												-->
                                            <?php } elseif (session()->get('status_user') == '200') { 
														$bidang = array();
														if ($dt['jenis_pertanian'] == '1')
															$bidang[] = "Pertanian";
														if ($dt['jenis_tp'] == '2')
															$bidang[] = "Tanaman Pangan";
														if ($dt['jenis_hor'] == '3')
															$bidang[] = "Hortikultura";
														if ($dt['jenis_bun'] == '4')
															$bidang[] = "Perkebunan";
														if ($dt['jenis_nak'] == '5')
															$bidang[] = "Peternakan";
														if ($dt['jenis_pkh'] == '6')
															$bidang[] = "Kesehatan Hewan";
														if ($dt['jenis_ketahanan_pangan'] == '7')
															$bidang[] = "Ketahanan Pangan";
														if ($dt['jenis_pangan'] == '8')
															$bidang[] = "Pangan";
														$dtbidang = (count($bidang) > 0) ? implode(", ",$bidang) : "";
												
											?>
                                                <table class="table">

                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Kelembagaan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['deskripsi_lembaga_lain']; ?> <?= $sessnama; ?></td>
                                                        </tr>
														 <tr>
                                                            <td>Bidang Kelembagaan (Sesuai Nomenklatur)</td>
                                                            <td>:</td>
                                                            <td><?= $dtbidang; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Pembentukan</td>
                                                            <td>:</td>
                                                            <td><?= format_date($dt['thn_berdiri'] . '-' . $dt['bln_berdiri'] . '-' . $dt['tgl_berdiri'], 2).' ('.$dt['dasar_hukum'].' '.(($dt['no_peraturan'] <> '') ? ' No. '.$dt['no_peraturan']: '').')'; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td> <?= $dt['alamat']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Provinsi</td>
                                                            <td>:</td>
                                                            <td><?= $namaprov; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Titik Koordinat Lembaga</td>
                                                            <td>:</td>
                                                            <td>
															<?php echo ($dt['koord'] <> '') ? '<a href="https://www.google.com/maps/?q='.$dt['koord'].'" target="_blank"><i class="fas fa-map-marker-alt"></i> '.$dt['koord'].'</a>' : '' ; ?>
															</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Pimpinan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['ketua']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>No HP Pimpinan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_hp']; ?></td>
                                                        </tr>
														
														<tr>
                                                            <td>Nama Kepala Bidang yang Menangani Penyuluhan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['nama_kabid'].(($dt['bidang_luh'] <> '') ? ' (Kepala '.$dt['bidang_luh'].')' : ''); ?></td>
                                                        </tr>
														<tr>
                                                            <td>No HP Kepala Bidang </td>
                                                            <td>:</td>
                                                            <td><?= $dt['hp_kabid']; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Nama Kepala Seksi yang Menangani Penyuluhan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['nama_kasie'].(($dt['seksi_luh'] <> '') ? ' (Kepala '.$dt['seksi_luh'].')' : ''); ?></td>
                                                        </tr>
														
														<tr>
                                                            <td>No HP Kepala Seksi </td>
                                                            <td>:</td>
                                                            <td><?= $dt['hp_kasie']; ?></td>
                                                        </tr>
														
                                                        <tr>
                                                            <td>Nama Koordinator PP</td>
                                                            <td>:</td>
                                                            <td><?php if ($dt['kode_koord_penyuluh'] == "1") {
                                                                    echo $dt['namapns'];
                                                                } elseif ($dt['kode_koord_penyuluh'] == "2") {
                                                                    echo $dt['namathl'];
                                                                } elseif ($dt['kode_koord_penyuluh'] == "3") {
                                                                    echo $dt['koord_lainya_nama'];
                                                                } ?></td>
                                                        </tr>
														<tr>
                                                            <td>No Telepon</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_kantor']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat Email</td>
                                                            <td>:</td>
                                                            <td><?= $dt['email']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat Website</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['website'] <> '') ? '<a href="'.$dt['website'].'" target="_blank"><i class="fas fa-globe"></i> '.$dt['website'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Instagram Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['instagram'] <> '') ? '<a href="http://instagram.com/'.$dt['instagram'].'" target="_blank"><i class="fab fa-instagram"></i> '.$dt['instagram'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Facebook Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['facebook'] <> '') ? '<a href="http://facebook.com/'.$dt['facebook'].'" target="_blank"><i class="fab fa-facebook"></i> '.$dt['facebook'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Twitter Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['twitter'] <> '') ? '<a href="http://twitter.com/'.$dt['twitter'].'" target="_blank"><i class="fab fa-twitter"></i> '.$dt['twitter'].'</a>' : '' ; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <?php } elseif (session()->get('status_user') == '300') { ?>
<!--
                                                <table class="table">

                                                    <tbody>
                                                        <tr>
                                                            <td>Nama BPP</td>
                                                            <td>:</td>
                                                            <td><?= $dt['nama_bpp']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Klasifikasi BPP</td>
                                                            <td>:</td>
                                                            <td><?= $dt['klasifikasi']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td> <?= $dt['alamat']; ?>, Kec: , Kab/Kota: , Provinsi: </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Pembentukan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['tgl_berdiri'] . '-' . $dt['bln_berdiri'] . '-' . $dt['thn_berdiri']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Bangunan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['status_gedung']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kondisi Bangunan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['kondisi_bangunan']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Kepala/Koordinator</td>
                                                            <td>:</td>
                                                            <td><?= $dt['ketua']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nomor HP</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_hp']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>:</td>
                                                            <td><?= $dt['email']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
												-->
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-lg-0 mb-4 text-center">
                            <div class="card">
                                <div class="card-body p-3 ">

                                    <img src="<?php if ($fotoprofil == '') {
                                                    echo base_url('assets/img/logo.png');
                                                } else {
                                                    echo base_url('assets/img/' . $fotoprofil);
                                                }  ?>" width="150px" class="img-thumbnail" alt="profil">

                                </div>
                                <!-- <a href="<?= base_url('profil/lembaga/editfoto') ?>" class="btn btn-primary btn-lg w-100 btn-sm">Upload</a> -->
                                <button type="button" class="btn btn-primary btn-lg w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto" id="uploadbtn">Change Picture</button>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="nav-penyuluh" role="tabpanel" aria-labelledby="nav-penyuluh-tab">
                    <div class="row">

                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h4 class="h3 mb-4 text-gray-800">Daftar Penyuluh Yang Bertugas di Kabupaten/Kota</h4>
                                        <div class="col-sm-4">
                                            <h5><span>Jumlah Penyuluh PNS</span></h5>
                                        </div>
                                        <div class="col-sm-4"><span>(<?= $jum_pns; ?> Orang)</span></div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <table class="table align-items-center mb-0">
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($datapns as $row => $pns) {
                                                        ?>
                                                            <tr>
                                                                <td class="align-middle text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                </td>
                                                                <td class="align-middle text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluh/detail/' . $pns['nip']) ?>" style="color: blue;"><?= $pns['nip'].' - '.$pns['nama'] ?></p>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
										<br>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5><span>THL-TB PP (APBN)</span></h5>
                                            </div>
                                            <div class="col-sm-4"><span>(<?= $jum_thl; ?> Orang)</span></div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($datathl as $row => $thl) {
                                                            ?>
                                                                <tr>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                    </td>
                                                                    <td class="align-middle text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $thl['nama'] ?></p>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5><span>THL-TB PP (APBD)</span></h5>
                                            </div>
                                            <div class="col-sm-4"><span>(<?= $jum_thl_apbd; ?> Orang)</span></div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($datathl_apbd as $row => $thl_apbd) {
                                                            ?>
                                                                <tr>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                    </td>
                                                                    <td class="align-middle text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $thl_apbd['nama'] ?></p>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-sm-4">
                                                <h5><span>Penyuluh PPPK</span></h5>
                                            </div>
                                            <div class="col-sm-4"><span>(<?= $jum_p3k; ?> Orang)</span></div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($datap3k as $row => $p3k) {
                                                            ?>
                                                                <tr>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                    </td>
                                                                    <td class="align-middle text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $p3k['nama'] ?></p>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>


                <div class="tab-pane fade" id="nav-kegiatan" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-lg-9 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Kegiatan yang dilakukan <i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-fk" id="btn-add-fas"></i></h1>
                                        <div class="col-lg-12">


                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">Tahun</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Fasilitasi</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Kegiatan</td>
                                                        <td width="100" class="text-secondary opacity-7"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($fasdata as $row => $value) {
                                                    ?>
                                                        <tr>
                                                            <td width="50">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $value['tahun'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $value['nama_fasilitasi'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $value['kegiatan'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <a href="#">
                                                                    <button type="button" id="btn-edit-fas" class="btn bg-gradient-warning btn-sm" data-id="<?= $value['id'] ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus" data-id="<?= $value['id'] ?>" class="btn bg-gradient-danger btn-sm">
                                                                    <i class="fas fa-trash"></i> Hapus
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


            </div>

        </div>




        <?php
        $i = 1;
        foreach ($tabel_data as $row => $item)
            foreach ($bapel as $row => $val) {
        ?>
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Edit Data</h4>
                                </div>
                                <div class="card-body">

                                    <form method="POST" role="form text-left">
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" name="id_gapoktan" id="id_gapoktan">
                                                <label for="prov">Propinsi</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="prov" value="<?= $item['nama_prop']; ?>" disabled>
                                                </div>
                                                <label for="prov">Kabupaten</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="kab" value="<?= $item['nama_dati2']; ?>" disabled>
                                                </div>
                                                <label for="kode_desa">Jenis Kelembagaan</label>
                                                <div class="input-group mb-3">
                                                    <select name="nama_bapel" id="nama_bapel" class="form-control input-lg" required>
                                                        <option value=""></option>
                                                        <OPTION value="31">Badan<BR>
                                                        <OPTION value="32">Dinas<BR>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label style="margin-top: 10px;">Nomenklatur </label>
													<div class="input-group mb-3">
                                                        <input type="text" class="form-control  input-lg" id="deskripsi_lembaga_lain" placeholder="" name="deskripsi_lembaga_lain">
													</div>
													<label>Pilih Sesuai nomenklatur :</label><br />
													<div style="clear:both"></div>
													<div class="form-check">
														<input class="form-check-input jenis_pertanian" type="checkbox" id="jenis_pertanian" name="jenis_pertanian" value="1">
														<label class="form-check-label" for="flexCheckDefault">
															Pertanian
														</label>
														<br />
														<input class="form-check-input jenis_tp" type="checkbox" id="jenis_tp" name="jenis_tp" value="2" required>
														<label class="form-check-label" for="flexCheckDefault">
															Tanaman Pangan
														</label>
														<br />
														<input class="form-check-input jenis_hor" type="checkbox" id="jenis_hor" name="jenis_hor" value="3">
														<label class="form-check-label" for="flexCheckDefault">
															Hortikultura
														</label>
														<br />
														<input class="form-check-input jenis_bun" type="checkbox" id="jenis_bun" name="jenis_bun" value="4">
														<label class="form-check-label" for="flexCheckDefault">
															Perkebunan
														</label>
														<br />
														<input class="form-check-input jenis_nak" type="checkbox" id="jenis_nak" name="jenis_nak" value="5">
														<label class="form-check-label" for="flexCheckDefault">
															Peternakan
														</label>
														<br />
														<input class="form-check-input jenis_ketahanan_pangan" type="checkbox" id="jenis_ketahanan_pangan" name="jenis_ketahanan_pangan" value="6">
														<label class="form-check-label" for="flexCheckDefault">
															Ketahanan Pangan
														</label>
														<br />
														<input class="form-check-input jenis_pkh" type="checkbox" id="jenis_pkh" name="jenis_pkh" value="7">
														<label class="form-check-label" for="flexCheckDefault">
															Kesehatan Hewan
														</label>
														<br />
														<input class="form-check-input jenis_pangan" type="checkbox" id="jenis_pangan" name="jenis_pangan" value="8">
														<label class="form-check-label" for="flexCheckDefault">
															Pangan
														</label>
													</div>
													
													
                                                    
                                                </div>
                                                <label for="alamat">Dasar Hukum Pembentukan</label>
                                                <select name="dasar_hukum" id="dasar_hukum" class="form-control input-lg" required>
                                                    <option value=""></option>
                                                    <option value="Perda">Perda</option>
                                                </select>
                                                <label for="ketua">No Peraturan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="no_peraturan" placeholder="Nomor Peraturan" name="no_peraturan" required>
                                                </div>
                                                <label for="ketua">Tanggal Pembentukan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="tglpembentukan" placeholder="Tanggal Pembentukan" name="tglpembentukan" required>
                                                </div>
                                                <label for="bendahara">Nama Pimpinan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ketua" placeholder="Nama Pimpinan" name="ketua" required>
                                                    <label style="margin-top: 10px;">No.HP</label>
                                                    <input type="text" style="margin-left: 5px;" class="form-control" id="telp_hp" placeholder="No. HP" name="telp_hp" onkeypress="return Angka(event)">
                                                </div>
                                                <label> Nama Koordinator Penyuluh</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio1" value="1" <?php echo ($val["kode_koord_penyuluh"] == "1" ? 'checked="checked"' : '') ?>>
                                                        <label class="form-check-label" for="inlineRadio1">PNS</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio2" value="2" <?php echo ($val["kode_koord_penyuluh"] == "2" ? 'checked="checked"' : '') ?>>
                                                        <label class="form-check-label" for="inlineRadio2">THL</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio3" value="3" <?php echo ($val["kode_koord_penyuluh"] == "3" ? 'checked="checked"' : '') ?>>
                                                        <label class="form-check-label" for="inlineRadio2">Struktural</label>
                                                    </div><br>
                                                </div>
                                                <div class="input-group mb-3" id="divPNS">
                                                    <label style="margin-top: 10px;">PNS:</label>
                                                    <select name="nama_koord_penyuluh pen" id="nama_koord_penyuluh" class="form-control input-lg" style="margin-left: 15px;">

                                                        <option value="<?= $val['nama_koord_penyuluh']; ?>"><?= $val['nip']; ?> - <?= $val['nama']; ?></option>

                                                        <option value="<?= $val['jenis_penyuluh']; ?>"><?= $val['nip']; ?> - <?= $val['nama']; ?></option>

                                                        <?php
                                                        foreach ($penyuluhPNS as $row) {
                                                            echo '<option value="' . $row["nip"] . '">' . $row["nip"] . '-' . $row["nama"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3" id="divTHL">
                                                    <label>THL:</label>
                                                    <select name="nama_koord_penyuluh_thl" id="nama_koord_penyuluh_thl" class="form-control input-lg" style="margin-left: 5px;">

                                                        <option value="<?= $val['nama_koord_penyuluh_thl']; ?>"><?= $val['noktp']; ?> - <?= $val['namathl']; ?></option>

                                                        <option value="<?= $val['jenis_pen_thl']; ?>"><?= $val['noktp']; ?> - <?= $val['namathl']; ?></option>

                                                        <?php
                                                        foreach ($penyuluhTHL as $row2) {
                                                            echo '<option value="' . $row2["noktp"] . '">' . $row2["noktp"] . '-' . $row2["nama"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3" id="divST">
                                                    <label style="margin-top: 10px;">NIP:</label>
                                                    <input type="text" class="form-control" style="margin-left: 10px;" id="koord_lainya_nip" placeholder="ketua" name="koord_lainya_nip" onkeypress="return Angka(event)">
                                                    <label style="margin-top: 10px;">Nama</label>
                                                    <input type="text" class="form-control" style="margin-left: 10px;" id="koord_lainya_nama" placeholder="ketua" name="koord_lainya_nama">

                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="ketua">Bidang yang menangani fungsi penyuluhan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="bidang_luh" placeholder="Bidang" name="bidang_luh" required>
                                                </div>
                                                <label for="ketua">Nama kepala bidang</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="nama_kabid" placeholder="Nama Kabid" name="nama_kabid" required>
                                                    <label style="margin-top: 10px;">No.HP</label>
                                                    <input type="text" style="margin-left: 5px;" class="form-control" id="hp_kabid" placeholder="No. HP" name="hp_kabid" onkeypress="return Angka(event)" required>
                                                </div>
                                                <label for="ketua">Seksi yang menangani penyuluhan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="seksi_luh" placeholder="Seksi" name="seksi_luh" required>
                                                </div>
                                                <label for=" ketua">Nama kepala seksi</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="nama_kasie" name="nama_kasie" placeholder="Nama Kepala Seksi" required>
                                                    <label style="margin-top: 10px;">No.HP</label>
                                                    <input type="text" style="margin-left: 5px;" class="form-control" id="hp_kasie" name="hp_kasie" placeholder="No. HP" onkeypress="return Angka(event)" required>
                                                </div>
                                                <label for="ketua">UPTD yang menangani fungsi penyuluhan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="uptd_luh" placeholder="UPTD" name="uptd_luh" required>
                                                </div>

                                                <label for="ketua">Nama kepala UPTD</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="nama_kauptd" name="nama_kauptd" placeholder="Nama Kepala UPTD">
                                                    <label style="margin-top: 10px;">No.HP</label>
                                                    <input type="text" style="margin-left: 5px;" class="form-control" id="hp_kauptd" name="hp_kauptd" placeholder="No. HP" onkeypress="return Angka(event)" required>
                                                </div>
                                                <label for="alamat">Alamat Kantor</label>
                                                <div class="input-group mb-3">
                                                    <textarea type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" required></textarea>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label for="jum_anggota">Titik koordinat (GPS POint)
                                                        <input type="text" class="form-control" id="koord" name="koord" required><br>
                                                        <label style="font-weight: normal">Format titik koordinat adalah Decimal Degree, contoh : <b>-6.2924034, 106.820540</b>
                                                            <br>Tutorial mendapatkan titik koordinat dapat melihat <a href="<?= base_url('assets/Panduan%20Decimal%20Degree%20Google%20Maps.pptx') ?>"><b>panduan berikut</b></a>.
                                                        </label>
                                                    </label>
                                                </div>
                                                <label for="ketua">No.Telepon</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="telp_kantor" placeholder="No Telp Kantor" name="telp_kantor" onkeypress="return Angka(event)" required>
                                                </div>
                                                <label for="ketua">Alamat Email</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="email" placeholder="email" name="email" required>
                                                </div>
                                                <label for="ketua">Alamat Website/Blog</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="website" placeholder="Alamat website" name="website">
                                                </div>
												<label for="ketua">Akun Instagram Lembaga</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="instagram" placeholder="Akun Instagram" name="instagram">
                                                </div>
												<label for="ketua">Akun Facebook Lembaga</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="facebook" placeholder="Akun Facebook" name="facebook">
                                                </div>
												<label for="ketua">Akun Twitter Lembaga</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="twitter" placeholder="Akun Twitter" name="twitter">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" onclick="submitform()" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            } ?>


        <div class="modal fade" id="modal-fk" tabindex="-1" role="dialog" aria-labelledby="modal-fk" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-l" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Tambah Data</h4>
                            </div>
                            <div class="card-body">

                                <form role="form text-left" action="<?= base_url('profil/Lembaga/save'); ?>">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="id_bapel" id="id_bapel" value="<?= $idgap; ?>">
                                            <label for="tahun_beridiri">Tahun</label>
                                            <div class="input-group mb-3">
                                                <select id="tahun" name="tahun" class="form-select tahun" aria-label="Default select example">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <label for="penyuluh_swadaya">Fasilitasi</label>
                                            <div class="input-group mb-3">
                                                <select name="fasilitasi" id="fasilitasi" class="form-control input-lg">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($fasilitasi as $row3) {
                                                        echo '<option value="' . $row3["idfasilitasi"] . '">' . $row3["fasilitasi"] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <label for="alamat">Kegiatan</label>
                                            <div class="input-group mb-3">
                                                <textarea type="text" class="form-control" id="kegiatan" placeholder="kegiatan" name="kegiatan"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="btnSimpan" class="btn bg-gradient-info">Simpan Data</button>
                                    </div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFoto" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('profil/lembaga/saveProfil'); ?>">


                            <div class="col-lg-3 mb-lg-0 text-center">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <img src="<?php if ($fotoprofil == '') {
                                                        echo base_url('assets/img/logo.png');
                                                    } else {
                                                        echo base_url('assets/img/' . $fotoprofil);
                                                    }  ?>" width="150px" class="img-thumbnail" alt="profil">
                                    </div>
                                </div>


                            </div>


                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="foto" name="foto">
                                <label class="input-group-text" for="foto">Pilih Foto</label>

                                <br>
                                <label for="infosize" class="input-group-text"  style="text-align: right;  font-size: 8pt; font-style: italic;">Max Size 2 Mb </label>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnSave" class="btn bg-gradient-primary">Simpan</button>
                    </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <?php echo view('layout/footer'); ?>

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script type="text/javascript">
    $(function() {
        $('input[name="tglpembentukan"]').daterangepicker({
            format: 'dd/MM/YYYY',
            indonesianDate: true,
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1950
        });
    });

    function submitform() {
        var f = document.getElementsByTagName('form')[0];
        if (f.checkValidity()) {
            f.submit();
        } else {
            alert(document.getElementById('example').validationMessage);
        }
    }

    function Angka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    function loadNamaKoordinator() {
        if ($('#inlineRadio1').is(':checked')) {
            $("#divPNS").show();
        } else {
            $("#divPNS").hide();
        }
        if ($('#inlineRadio2').is(':checked')) {
            $("#divTHL").show();
        } else {
            $("#divTHL").hide();
        }
        if ($('#inlineRadio3').is(':checked')) {
            $("#divST").show();
        } else {
            $("#divST").hide();
        }
    }

    $(document).ready(function() {
        loadNamaKoordinator();

        $(document).delegate('#inlineRadio1', 'click', function() {
            loadNamaKoordinator();
        });
        $(document).delegate('#inlineRadio2', 'click', function() {
            loadNamaKoordinator();
        });
        $(document).delegate('#inlineRadio3', 'click', function() {
            loadNamaKoordinator();
        });
    });

    var min = 2010,
        max = 2030,
        select = document.getElementById('tahun');

    for (var i = min; i <= max; i++) {
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }

    select.value = new Date().getFullYear();


    $(document).ready(function() {
        $(document).delegate('#btn-edit', 'click', function() {
            //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
            // alert(id);
            $.ajax({
                url: '<?= base_url() ?>/profil/Lembaga/detailKab/' + $(this).data('id_gapoktan'),
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    // $(".daftpos").html(res)
                    //console.log(res);
                    //res = JSON.parse(res);

                    $('#id_gapoktan').val(res[0].id_gapoktan);
                    $('#nama_bapel').val(res[0].nama_bapel);
                    $('#dasar_hukum').val(res[0].dasar_hukum);
                    $('#no_peraturan').val(res[0].no_peraturan);
                    $('#tglpembentukan').val(res[0].tgl_berdiri + '/' + res[0].bln_berdiri + '/' + res[0].thn_berdiri);
                    $('#alamat').val(res[0].alamat);
                    $('#deskripsi_lembaga_lain').val(res[0].deskripsi_lembaga_lain);
                    $('#telp_kantor').val(res[0].telp_kantor);
                    $('#email').val(res[0].email);
                    $('#website').val(res[0].website);
					$('#instagram').val(res[0].instagram);
					$('#twitter').val(res[0].twitter);
					$('#facebook').val(res[0].facebook);
                    $('#ketua').val(res[0].ketua);
                    $('#koord').val(res[0].koord);
                    $('#telp_hp').val(res[0].telp_hp);
                    $('#telp_hp_koord').val(res[0].telp_hp_koord);
                    $('#email_koord').val(res[0].email_koord);
                    if (res[0].jenis_pertanian == "1") {
                        $("#jenis_pertanian").prop("checked", true);
                    } else {
                        $("#jenis_pertanian").prop("checked", false);
                    }
                    if (res[0].jenis_tp == "2") {
                        $("#jenis_tp").prop("checked", true);
                    } else {
                        $("#jenis_tp").prop("checked", false);
                    }
                    if (res[0].jenis_hor == "3") {
                        $("#jenis_hor").prop("checked", true);
                    } else {
                        $("#jenis_hor").prop("checked", false);
                    }
                    if (res[0].jenis_bun == "4") {
                        $("#jenis_bun").prop("checked", true);
                    } else {
                        $("#jenis_bun").prop("checked", false);
                    }
                    if (res[0].jenis_nak == "5") {
                        $("#jenis_nak").prop("checked", true);
                    } else {
                        $("#jenis_nak").prop("checked", false);
                    }
                    if (res[0].jenis_ketahanan_pangan == "6") {
                        $("#jenis_ketahanan_pangan").prop("checked", true);
                    } else {
                        $("#jenis_ketahanan_pangan").prop("checked", false);
                    }
                    if (res[0].jenis_pkh == "7") {
                        $("#jenis_pkh").prop("checked", true);
                    } else {
                        $("#jenis_pkh").prop("checked", false);
                    }
                    if (res[0].jenis_pangan == "8") {
                        $("#jenis_pangan").prop("checked", true);
                    } else {
                        $("#jenis_pangan").prop("checked", false);
                    }

                    $('#bidang_luh').val(res[0].bidang_luh);
                    $('#nama_kabid').val(res[0].nama_kabid);
                    $('#hp_kabid').val(res[0].hp_kabid);
                    $('#seksi_luh').val(res[0].seksi_luh);
                    $('#nama_kasie').val(res[0].nama_kasie);
                    $('#hp_kasie').val(res[0].hp_kasie);
                    $('#uptd_luh').val(res[0].uptd_luh);
                    $('#nama_kauptd').val(res[0].nama_kauptd);
                    $('#hp_kauptd').val(res[0].hp_kauptd);
                    $('#nama_koord_penyuluh').val(res[0].nama_koord_penyuluh);
                    $('#nama_koord_penyuluh_thl').val(res[0].nama_koord_penyuluh_thl);
                    $('#koord_lainya_nip').val(res[0].koord_lainya_nip);
                    $('#koord_lainya_nama').val(res[0].koord_lainya_nama);
                    $('#kode_koord_penyuluh').val(res[0].kode_koord_penyuluh);
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        // console.log('ok');
                        tglpembentukan = $('#tglpembentukan').val();
                        bln = tglpembentukan.substr(0, 2);
                        tgl = tglpembentukan.substr(3, 2);
                        thn = tglpembentukan.substr(6, 4);


                        var id_gapoktan = $('#id_gapoktan').val();
                        var deskripsi_lembaga_lain = $('#deskripsi_lembaga_lain').val();
                        var nama_bapel = $('#nama_bapel').val();
                        var dasar_hukum = $('#dasar_hukum').val();
                        var no_peraturan = $('#no_peraturan').val();
                        var tgl_berdiri = tgl;
                        var bln_berdiri = bln;
                        var thn_berdiri = thn;
                        var alamat = $('#alamat').val();
                        var telp_kantor = $('#telp_kantor').val();
                        var email = $('#email').val();
                        var website = $('#website').val();
						var instagram = $('#instagram').val();
						var facebook = $('#facebook').val();
						var twitter = $('#twitter').val();
                        var ketua = $('#ketua').val();
                        var telp_hp = $('#telp_hp').val();
                        var koord = $('#koord').val();

                        var telp_hp_koord = $('#telp_hp_koord').val();
                        var email_koord = $('#email_koord').val();
                        var jenis_pertanian = $(".jenis_pertanian")[0].checked ? $(".jenis_pertanian").val() : "";
                        var jenis_tp = $(".jenis_tp")[0].checked ? $(".jenis_tp").val() : "";
                        var jenis_hor = $(".jenis_hor")[0].checked ? $(".jenis_hor").val() : "";
                        var jenis_bun = $(".jenis_bun")[0].checked ? $(".jenis_bun").val() : "";
                        var jenis_nak = $(".jenis_nak")[0].checked ? $(".jenis_nak").val() : "";
                        var jenis_pkh = $(".jenis_pkh")[0].checked ? $(".jenis_pkh").val() : "";
                        var jenis_ketahanan_pangan = $(".jenis_ketahanan_pangan")[0].checked ? $(".jenis_ketahanan_pangan").val() : "";
                        var jenis_pangan = $(".jenis_pangan")[0].checked ? $(".jenis_pangan").val() : "";
                        var bidang_luh = $('#bidang_luh').val();
                        var nama_kabid = $('#nama_kabid').val();
                        var hp_kabid = $('#hp_kabid').val();
                        var seksi_luh = $('#seksi_luh').val();
                        var nama_kasie = $('#nama_kasie').val();
                        var hp_kasie = $('#hp_kasie').val();
                        var uptd_luh = $('#uptd_luh').val();
                        var nama_kauptd = $('#nama_kauptd').val();
                        var hp_kauptd = $('#hp_kauptd').val();
                        var nama_koord_penyuluh = $('#nama_koord_penyuluh').val();
                        var nama_koord_penyuluh_thl = $('#nama_koord_penyuluh_thl').val();
                        var koord_lainya_nip = $('#koord_lainya_nip').val();
                        var koord_lainya_nama = $('#koord_lainya_nama').val();
                        var kode_koord_penyuluh = $('.pen:checked').val();

  
                        if (nama_bapel == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Jenis Kelembagaan Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (deskripsi_lembaga_lain.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomenklatur Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        const fields = $("input[type='checkbox']").serializeArray();
                        if (fields.length === 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Pilih Bidang Minimal 1",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (dasar_hukum == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Dasar Hukum Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (tglpembentukan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Tanggal Pembentukan Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (no_peraturan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor Peraturan Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (ketua.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Ketua Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (telp_hp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor HP Ketua Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (no_peraturan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor Peraturan Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        const fields2 = $("input[type='radio']").serializeArray();
                        if (fields2.length === 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Koordinator Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (koord_lainya_nip.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "NIP Koordinator Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        } else if (koord_lainya_nip.length < 18 || koord_lainya_nip.length > 18) {
                            Swal.fire({
                                title: 'Error',
                                text: "NIP Harus 16 Digit",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;

                        }

                        if (koord_lainya_nama.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Koordinator Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (bidang_luh.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Bidang Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (nama_kabid.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Kepala Bidang Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (hp_kabid.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor HP Kepala Bidang Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (seksi_luh.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Seksi Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (nama_kasie.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Kepala Seksi Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (hp_kasie.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "NOmor HP Kepala Seksi Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (uptd_luh.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "UPTD Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (nama_kauptd.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Kepala UPTD Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (hp_kauptd.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor HP Kepala UPTD Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (alamat.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Alamat Kantor Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (koord.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Titik Koordinat Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }else {
                            var koord_array = koord.split(",");
                            if(koord_array.length!=2 || !(validateLatLng(koord_array[0].trim(), koord_array[1].trim()))){
                                Swal.fire({
                                    title: 'Error',
                                    text: "Titik Koordinat Harus format Decimal Degree, contoh : -6.2924034, 106.820540",
                                    type: 'error',
                                }).then((result) => {
                                    if (result.value) {
                                        return false;
                                    }
                                });
                                return false;
                            }
                        }

                        if (telp_kantor.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Telepon Kantor Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (email.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Email Kantor Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        let formData = new FormData();
                        formData.append('id_gapoktan', id_gapoktan);
                        formData.append('nama_bapel', nama_bapel);
                        formData.append('deskripsi_lembaga_lain', deskripsi_lembaga_lain);
                        formData.append('dasar_hukum', dasar_hukum);
                        formData.append('no_peraturan', no_peraturan);
                        formData.append('tgl_berdiri', tgl_berdiri);
                        formData.append('bln_berdiri', bln_berdiri);
                        formData.append('thn_berdiri', thn_berdiri);
                        formData.append('alamat', alamat);
                        formData.append('telp_kantor', telp_kantor);
                        formData.append('email', email);
                        formData.append('website', website);
						formData.append('twitter', twitter);
						formData.append('facebook', facebook);
						formData.append('instagram', instagram);
                        formData.append('ketua', ketua);
                        formData.append('koord', koord);
                        formData.append('telp_hp', telp_hp);
                        formData.append('telp_hp_koord', telp_hp_koord);
                        formData.append('email_koord', email_koord);
                        formData.append('jenis_pertanian', jenis_pertanian);
                        formData.append('jenis_tp', jenis_tp);
                        formData.append('jenis_hor', jenis_hor);
                        formData.append('jenis_bun', jenis_bun);
                        formData.append('jenis_nak', jenis_nak);
                        formData.append('jenis_pkh', jenis_pkh);
                        formData.append('jenis_ketahanan_pangan', jenis_ketahanan_pangan);
                        formData.append('jenis_pangan', jenis_pangan);
                        formData.append('bidang_luh', bidang_luh);
                        formData.append('nama_kabid', nama_kabid);
                        formData.append('hp_kabid', hp_kabid);
                        formData.append('seksi_luh', seksi_luh);
                        formData.append('nama_kasie', nama_kasie);
                        formData.append('hp_kasie', hp_kasie);
                        formData.append('uptd_luh', uptd_luh);
                        formData.append('nama_kauptd', nama_kauptd);
                        formData.append('hp_kauptd', hp_kauptd);
                        formData.append('nama_koord_penyuluh', nama_koord_penyuluh);
                        formData.append('nama_koord_penyuluh_thl', nama_koord_penyuluh_thl);
                        formData.append('koord_lainya_nip', koord_lainya_nip);
                        formData.append('koord_lainya_nama', koord_lainya_nama);
                        formData.append('kode_koord_penyuluh', kode_koord_penyuluh);

                        $.ajax({
                            url: '<?= base_url() ?>/profil/Lembaga/update/' + id_gapoktan,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modal-form').modal('hide');
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses edit data",
                                    type: 'success',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });

                            },
                            error: function(jqxhr, status, exception) {

                                Swal.fire({
                                    title: 'Error',
                                    text: "Gagal edit data",
                                    type: 'Error',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });

                            }
                        });
                    });

                }
            });

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

        });


        $(document).delegate('#btnSimpan', 'click', function() {
            var id_bapel = $('#id_bapel').val();
            var tahun = $('#tahun').val();
            var fasilitasi = $('#fasilitasi').val();
            var kegiatan = $('#kegiatan').val();

            $.ajax({
                url: '<?= base_url('/profil/Lembaga/save/') ?>',
                type: 'POST',
                data: {
                    'id_bapel': id_bapel,
                    'tahun': tahun,
                    'fasilitasi': fasilitasi,
                    'kegiatan': kegiatan,
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.value) {
                        Swal.fire({
                            title: 'Sukses',
                            text: "Sukses tambah data",
                            type: 'success',
                        }).then((result) => {

                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: "Gagal tambah data. " + result.message,
                            type: 'error',
                        }).then((result) => {

                        });
                    }
                },
                error: function(jqxhr, status, exception) {
                    Swal.fire({
                        title: 'Error',
                        text: "Gagal tambah data",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }
            });
        });


        $(document).delegate('#btn-edit-fas', 'click', function() {
            //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
            // alert(id);
            $.ajax({
                url: '<?= base_url() ?>/profil/Lembaga/fasilitas/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    // $(".daftpos").html(res)
                    //console.log(res);
                    //res = JSON.parse(res);

                    $('#id').val(res[0].id);
                    $('#id_bapel').val(res[0].id_bapel);
                    $('#fasilitasi').val(res[0].fasilitasi);
                    $('#kegiatan').val(res[0].kegiatan);
                    $('#tahun').val(res[0].tahun);
                    $('#judul-form').text('Edit Data');
                    $('#modal-fk').modal("show");
                    $("#btnSimpan").attr("id", "btnUbah");

                    $(document).delegate('#btnUbah', 'click', function() {
                        console.log('ok');

                        var id = $('#id').val();
                        var id_bapel = $('#id_bapel').val();
                        var fasilitasi = $('#fasilitasi').val();
                        var kegiatan = $('#kegiatan').val();
                        var tahun = $('#tahun').val();

                        let formData = new FormData();
                        formData.append('id', id);
                        formData.append('fasilitasi', fasilitasi);
                        formData.append('id_bapel', id_bapel);
                        formData.append('kegiatan', kegiatan);
                        formData.append('tahun', tahun);
                        $.ajax({
                            url: '<?= base_url() ?>/profil/Lembaga/updatefas/' + id,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modal-form').modal('hide');
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses edit data",
                                    type: 'success',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });

                            },
                            error: function(jqxhr, status, exception) {

                                Swal.fire({
                                    title: 'Error',
                                    text: "Gagal edit data",
                                    type: 'Error',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });

                            }
                        });
                    });

                }
            });

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

        });

        $(document).delegate('#btn-hapus', 'click', function() {
            Swal.fire({
                title: 'Apakah anda yakin',
                text: "Data akan dihapus ?",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data!'
            }).then((result) => {
                if (result.value) {
                    var id = $(this).data('id');

                    $.ajax({
                        url: '<?= base_url() ?>/profil/Lembaga/delete/' + id,
                        type: 'POST',

                        success: function(result) {
                            Swal.fire({
                                title: 'Sukses',
                                text: "Sukses hapus data",
                                type: 'success',
                            }).then((result) => {

                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(jqxhr, status, exception) {
                            Swal.fire({
                                title: 'Error',
                                text: "Gagal hapus data",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>




<script type="text/javascript">
    function loadingproses() {
        $('.backDrop').show();
        $('.backDrop_content').fadeIn('slow');
    }

    function loadingproses_close() {
        $('.backDrop').hide();
        $('.backDrop_content').fadeOut('slow');
    }

    $('#prov').on('change', function() {
        $('#kec').html('');
        $('#desa').html('');
        const id = $('#prov').val();
        var kdprov = id.substring(0, 2);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showKab/" + kdprov + "",
            success: function(response) {
                console.log(response);
                $("#kab").html(response);
            },
            dataType: "html"
        });
        return false;
    });


    $('#kab').on('change', function() {
        $('#desa').html('');
        const id = $('#kab').val();
        var kdkab = id.substring(0, 4);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showKec/" + kdkab + "",
            success: function(response) {
                console.log(response);
                $("#kec").html(response);
            },
            dataType: "html"
        });
        return false;
    });

    $('#kec').on('change', function() {

        const id = $('#kec').val();
        var kdkec = id.substring(0, 6);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showDesa/" + kdkec + "",
            success: function(response) {
                $("#desa").html(response);
            },
            dataType: "html"
        });
        return false;
    });
</script>

<?= $this->endSection() ?>