<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $sessnama = session()->get('nama'); ?>
<?php
$api = 'https://api.pertanian.go.id/api/simantap/dashboard/list?&api-key=f13914d292b53b10936b7a7d1d6f2406&kode=' . $kode_kec;
$result = file_get_contents($api, false);
$json = json_decode($result, true);
$data = $json[0];
?>
<div class="container-fluid py-4">
    <div class="row">
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
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swatahuna</p>
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


        </div>

        <div class="row">

            <nav class="col-lg-12">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
                    <button class="nav-link" id="nav-penyuluh-tab" data-bs-toggle="tab" data-bs-target="#nav-penyuluh" type="button" role="tab" aria-controls="nav-penyuluh" aria-selected="false">Daftar Penyuluh</button>
                    <button class="nav-link" id="nav-foto-tab" data-bs-toggle="tab" data-bs-target="#nav-foto" type="button" role="tab" aria-controls="nav-foto" aria-selected="false">Foto Bangunan</button>
                    <button class="nav-link" id="nav-wilkec-tab" data-bs-toggle="tab" data-bs-target="#nav-wilkec" type="button" role="tab" aria-controls="nav-wilkec" aria-selected="false">Wilayah Kecamatan</button>
                    <button class="nav-link" id="nav-klas-tab" data-bs-toggle="tab" data-bs-target="#nav-klas" type="button" role="tab" aria-controls="nav-klas" aria-selected="false">Klasifikasi BPP</button>
                    <button class="nav-link" id="nav-kegiatan-tab" data-bs-toggle="tab" data-bs-target="#nav-kegiatan" type="button" role="tab" aria-controls="nav-kegiatan" aria-selected="false">Kegiatan</button>
                    <button class="nav-link" id="nav-penghargaan-tab" data-bs-toggle="tab" data-bs-target="#nav-penghargaan" type="button" role="tab" aria-controls="nav-penghargaan" aria-selected="false">Penghargaan</button>
                    <button class="nav-link" id="nav-dana-tab" data-bs-toggle="tab" data-bs-target="#nav-dana" type="button" role="tab" aria-controls="nav-dana" aria-selected="false">Dana Alokasi Khusus</button>
                    <button class="nav-link" id="nav-powil-tab" data-bs-toggle="tab" data-bs-target="#nav-powil" type="button" role="tab" aria-controls="nav-powil" aria-selected="false">Potensi Wilayah</button>
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
                                        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></a></h1>
                                        <div class="col-lg-12">

                                            <table class="table">

                                                <tbody>
                                                    <input type="hidden" name="id" value="<?= $dt['id']; ?>">
                                                    <tr>
                                                        <td>Nama Kelembagaan</td>
                                                        <td>:</td>
                                                        <td><?= $dt['nama_bpp']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Klasifikasi BP3K</td>
                                                        <td>:</td>
                                                        <td><?= $dt['klasifikasi']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td> <?= $dt['alamat']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan</td>
                                                        <td>:</td>
                                                        <td><?= $dt['deskripsi']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kabupaten/Kota</td>
                                                        <td>:</td>
                                                        <td><?= $dt['namakab']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi</td>
                                                        <td>:</td>
                                                        <td><?= $dt['namaprov']; ?></td>
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
                                                        <td>Nama Kepala / Koordinator</td>
                                                        <td>:</td>
                                                        <td><?= $dt['ketua']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No HP Pimpinan</td>
                                                        <td>:</td>
                                                        <td><?= $dt['telp_hp']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>:</td>
                                                        <td><?= $dt['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan wilayah Kerja</td>
                                                        <td>:</td>
                                                        <td>- <?= $dt['deskripsi'];  ?></td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-lg-0 mb-4 text-center">
                            <div class="card">
                                <div class="card-body p-3 ">
                                    <img src="<?= base_url('assets/img/' . $dt['foto']) ?>" width="150px" class="img-thumbnail" alt="profil">
                                </div>
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
                                        <h4 class="h3 mb-4 text-gray-800">Data Ketenagaan Penyuluhan</h4>
                                        <div class="col-sm-4">
                                            <h5><span>Penyuluh PNS</span></h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <table class="table align-items-center mb-0">
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($pns_kec as $row => $pns) {
                                                        ?>
                                                            <tr>
                                                                <td class="align-middle text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                </td>
                                                                <td class="align-middle text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluh/detail/' . $pns['nip']) ?>" style="color: blue;"><?= $pns['nama'] ?></p>
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
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5><span>THL-TB PP</span></h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($thl_kec as $row => $thl) {
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
                                                <h5><span>Penyuluh Swadaya</span></h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($swa_kec as $row => $swa) {
                                                            ?>
                                                                <tr>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                    </td>
                                                                    <td class="align-middle text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $swa['nama'] ?></p>
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
                                                <h5><span>Penyuluh Swasta</span></h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($swasta_kec as $row => $swasta) {
                                                            ?>
                                                                <tr>
                                                                    <td class="align-middle text-center text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                    </td>
                                                                    <td class="align-middle text-sm">
                                                                        <p class="text-xs font-weight-bold mb-0"><?= $swasta['nama'] ?></p>
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
                                                <h5><span>PPPk</span></h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach ($p3k_kec as $row => $p3k) {
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
                <div class="tab-pane fade" id="nav-foto" role="tabpanel" aria-labelledby="nav-foto-tab">
                    <div class="row">

                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h4 class="h3 mb-4 text-gray-800">Foto Bangunan<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-foto" id="btn-edit" data-id="<?= $dt['id']; ?>"></i></a></h4>
                                        <div class="col">
                                            <label>Foto BPP</label><br>
                                            <img src="<?= base_url('assets/img/' . $dt['foto']) ?>" width="150px" height="150px" class="img-thumbnail" alt="profil">
                                        </div>
                                        <div class="col">
                                            <label>Foto Tampak Depan BPP</label><br>
                                            <img src="<?= base_url('assets/img/' . $dt['foto_depan']) ?>" width="150px" height="150px" class="img-thumbnail" alt="profil">
                                        </div>
                                        <div class="col">
                                            <label>Foto Tampak Belakang BPP</label><br>
                                            <img src="<?= base_url('assets/img/' . $dt['foto_belakang']) ?>" width="150px" height="150px" class="img-thumbnail" alt="profil">
                                        </div>

                                        <div class="col">
                                            <label>Foto Tampak Samping BPP</label><br>
                                            <img src="<?= base_url('assets/img/' . $dt['foto_samping']) ?>" width="150px" height="150px" class="img-thumbnail" alt="profil">
                                        </div>

                                        <div class="col">
                                            <label>Foto Tampak Dalam BPP</label><br>
                                            <img src="<?= base_url('assets/img/' . $dt['foto_dalam']) ?>" width="150px" height="150px" class="img-thumbnail" alt="profil">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="nav-wilkec" role="tabpanel" aria-labelledby="nav-wilkec-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Wilayah Kecamatan</a></h1>
                                        <div class="col-lg-12">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Kecamatan</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah Petani</td>
                                                        <td width="100" class="text-secondary opacity-7"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($wilkec as $row => $val_wk) {
                                                    ?>
                                                        <tr>
                                                            <td width="50">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $val_wk['nama_kec'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $val_wk['jum_petani'] ?></p>
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
                <div class="tab-pane fade" id="nav-klas" role="tabpanel" aria-labelledby="nav-klas-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Klasifikasi BPP</a></h1>
                                        <div class="col-lg-12">


                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">Tahun</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Klasifikasi</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Skor</td>
                                                        <td width="100" class="text-secondary opacity-7"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($klas as $row => $val_klas) {
                                                    ?>
                                                        <tr>
                                                            <td width="50">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $val_klas['tahun'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $val_klas['klasifikasi'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $val_klas['skor'] ?></p>
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
                <div class="tab-pane fade" id="nav-kegiatan" role="tabpanel" aria-labelledby="nav-kegiatan-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Kegiatan yang dilaksanakan oleh BPP</a></h1>
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

                <div class="tab-pane fade" id="nav-penghargaan" role="tabpanel" aria-labelledby="nav-penghargaan-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Penghargaan yang pernah diterima</a></h1>
                                        <div class="col-lg-12">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Penghargaan</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Peringkat</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Tingkat</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Tahun</td>
                                                        <td width="100" class="text-secondary opacity-7"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($penghargaan as $row => $award) {
                                                    ?>
                                                        <tr>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $award['nama_penghargaan'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $award['peringkat'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $award['tingkat'] ?></p>
                                                            </td>
                                                            <td width="50">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $award['tahun'] ?></p>
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
                <div class="tab-pane fade" id="nav-dana" role="tabpanel" aria-labelledby="nav-dana-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Mendapatkan Dana Alokasi Khusus (DAK)</a></h1>
                                        <div class="col-lg-12">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">Tahun</td>
                                                        <td width="100" class="text-secondary opacity-7"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($dana as $row => $dak) {
                                                    ?>
                                                        <tr>
                                                            <td width="50">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $dak['tahun_dak'] ?></p>
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


                <div class="tab-pane fade" id="nav-powil" role="tabpanel" aria-labelledby="nav-powil-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Potensi Wilayah</a></h1>
                                        <div class="col-lg-12">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">Komoditas</td>
                                                        <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Luas Lahan</td>
                                                        <td width="100" class="text-secondary opacity-7"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($potensi as $row => $powil) {
                                                    ?>
                                                        <tr>
                                                            <td width="50">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $powil['nama_subsektor'] . ' - ' . $powil['nama_komoditas'] ?></p>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <p class="text-xs font-weight-bold mb-0"><?= $powil['luas_lhn'] ?></p>
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


    </div>

</div>
<?php echo view('layout/footer'); ?>

</div>
</div>

<?= $this->endSection() ?>