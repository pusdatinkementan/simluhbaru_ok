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
                                        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?><i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-form" id="btn-edit" data-id="<?= $dt['id']; ?>"></i></a></h1>
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
                                                        <td>Klasifikasi BPP</td>
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
                                                        <td><?= $namakab; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi</td>
                                                        <td>:</td>
                                                        <td><?= $namaprov; ?></td>
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
                                    <label>Foto BPP</label>
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
                                                                    <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluh/detail/' . $pns['nip']) ?>"><?= $pns['nama'] ?></p>
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
                                        <h1 class="h3 mb-4 text-gray-800">Wilayah Kecamatan<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-wilkec"></i></a></h1>
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
                                                            <td class="align-middle text-center text-sm">
                                                                <a href="#">
                                                                    <button type="button" id="btn-edit-wilkec" class="btn bg-gradient-warning btn-sm" data-id="<?= $val_wk['id'] ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus-wilkec" data-id="<?= $val_wk['id'] ?>" class="btn bg-gradient-danger btn-sm">
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
                <div class="tab-pane fade" id="nav-klas" role="tabpanel" aria-labelledby="nav-klas-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Klasifikasi BPP<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-klas"></i></a></h1>
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
                                                            <td class="align-middle text-center text-sm">
                                                                <a href="#">
                                                                    <button type="button" id="btn-edit-klas" class="btn bg-gradient-warning btn-sm" data-id="<?= $val_klas['id'] ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus-klas" data-id="<?= $val_klas['id'] ?>" class="btn bg-gradient-danger btn-sm">
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
                <div class="tab-pane fade" id="nav-kegiatan" role="tabpanel" aria-labelledby="nav-kegiatan-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Kegiatan yang dilaksanakan oleh BPP<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-fk"></i></a></h1>
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
                                                                    <button type="button" id="btn-edit-fas" class="btn bg-gradient-warning btn-sm" data-id="<?= $value['id']; ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus-fas" data-id="<?= $value['id'] ?>" class="btn bg-gradient-danger btn-sm">
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

                <div class="tab-pane fade" id="nav-penghargaan" role="tabpanel" aria-labelledby="nav-penghargaan-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Penghargaan yang pernah diterima<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-award"></i></a></h1>
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
                                                            <td class="align-middle text-center text-sm">
                                                                <a href="#">
                                                                    <button type="button" id="btn-edit-aw" class="btn bg-gradient-warning btn-sm" data-id="<?= $award['id']; ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus-aw" data-id="<?= $award['id'] ?>" class="btn bg-gradient-danger btn-sm">
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
                <div class="tab-pane fade" id="nav-dana" role="tabpanel" aria-labelledby="nav-dana-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Mendapatkan Dana Alokasi Khusus (DAK)<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-dak"></i></a></h1>
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
                                                            <td class="align-middle text-center text-sm">
                                                                <a href="#">
                                                                    <button type="button" id="btn-edit-dak" class="btn bg-gradient-warning btn-sm" data-id="<?= $dak['id'] ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus-dak" data-id="<?= $dak['id'] ?>" class="btn bg-gradient-danger btn-sm">
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


                <div class="tab-pane fade" id="nav-powil" role="tabpanel" aria-labelledby="nav-powil-tab">
                    <div class="row">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800">Potensi Wilayah<i class="fas fa-edit" style="float: right;" data-bs-toggle="modal" data-bs-target="#modal-powil" id="btn-edit"></i></a></h1>
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
                                                            <td class="align-middle text-center text-sm">
                                                                <a href="#">
                                                                    <button type="button" id="btn-edit-kom" class="btn bg-gradient-warning btn-sm" data-id_potensi="<?= $powil['id_potensi']; ?>">
                                                                        <i class="fas fa-edit"></i> Ubah
                                                                    </button>
                                                                </a>
                                                                <button type="button" id="btn-hapus-kom" data-id_potensi="<?= $powil['id_potensi'] ?>" class="btn bg-gradient-danger btn-sm">
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


        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h4 class="font-weight-bolder text-warning text-gradient">Edit Data</h4>
                            </div>
                            <div class="card-body">
                                <form id="form_bpp" role="form text-left" action="<?= base_url('KelembagaanPenyuluhan/Kecamatan/Kecamatan/update/' . $dt['id']) ?>" method="post" enctype="multipart/form-data">
                                    <? csrf_field(); ?>
                                    <div class=" row">
                                        <div class="col">
                                            <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                            <input type="hidden" name="satminkal" id="satminkal" value="<?= $kode_kab; ?>">
                                            <input type="hidden" name="id" value="<?= $dt['id']; ?>">
                                            <input type="hidden" name="urut" id="urut" value="<?= $dt['urut']; ?>">
                                            <input type="hidden" name="kode_bp3k" id="kode_bp3k" value="<?= $bp; ?>">

                                            <label>Bentuk Kelembagaan</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="bentuk_lembaga" id="bentuk_lembaga" aria-label="Default select example">
                                                    <option selected value="<?= $dt['bentuk_lembaga']; ?>"><?php if ($dt['bentuk_lembaga'] == "20") {
                                                                                                                echo "Balai Penyuluhan Pertanian";
                                                                                                            } elseif ($dt['bentuk_lembaga'] == "40") {
                                                                                                                echo "UPTD";
                                                                                                            } ?></option>
                                                    <option value="20">Balai Penyuluhan Pertanian</option>
                                                    <option value="40">UPTD</option>
                                                </select>
                                            </div>
                                            <label>Nama Kelembagaan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Nama Kelembagaan" name="nama_bpp" id="nama_bpp" value="<?= $dt['nama_bpp']; ?>">
                                            </div>
                                            <label>Alamat Kantor</label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" placeholder="Alamat Kantor" id="alamat" name="alamat"><?= $dt['alamat']; ?></textarea>
                                            </div>
                                            <label>Kecamatan (lokasi BPP)</label>
                                            <div class="input-group mb-3">
                                                <select name="kecamatan" id="kecamatan" class="form-control input-lg">
                                                    <option value="<?= $dt['kecamatan']; ?>">Kec. <?= $dt['deskripsi']; ?></option>
                                                    <?php
                                                    foreach ($kec as $row) {
                                                        echo '<option value="' . $row["id_daerah"] . '">' . 'Kec. ' . $row["deskripsi"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label for="ketua">Tanggal Pembentukan</label>
                                            <div class="input-group mb-3">
                                                <select id="day" name="tgl_berdiri" class="form-select tgl_berdiri" aria-label="Default select example">
                                                    <option value="<?= $dt['tgl_berdiri']; ?>"><?= $dt['tgl_berdiri']; ?></option>
                                                </select>
                                                <select id="month" name="bln_berdiri" class="form-select bln_berdiri" aria-label="Default select example">
                                                    <option value="<?= $dt['bln_berdiri']; ?>">
                                                        <?php
                                                            if ($dt['bln_berdiri'] == "1") {
                                                                echo "Januari";
                                                            } elseif ($dt['bln_berdiri'] == "2") {
                                                                echo "Pebruari";
                                                            } elseif ($dt['bln_berdiri'] == "3") {
                                                                echo "Maret";
                                                            } elseif ($dt['bln_berdiri'] == "4") {
                                                                echo "April";
                                                            } elseif ($dt['bln_berdiri'] == "5") {
                                                                echo "Mei";
                                                            } elseif ($dt['bln_berdiri'] == "6") {
                                                                echo "Juni";
                                                            } elseif ($dt['bln_berdiri'] == "7") {
                                                                echo "Juli";
                                                            } elseif ($dt['bln_berdiri'] == "8") {
                                                                echo "Agustus";
                                                            } elseif ($dt['bln_berdiri'] == "9") {
                                                                echo "September";
                                                            } elseif ($dt['bln_berdiri'] == "10") {
                                                                echo "Oktober";
                                                            } elseif ($dt['bln_berdiri'] == "11") {
                                                                echo "Nopember";
                                                            } elseif ($dt['bln_berdiri'] == "12") {
                                                                echo "Desember";
                                                            }
                                                        ?>
                                                    </option>
                                                </select>
                                                <select id="year" name="thn_berdiri" class="form-select thn_berdiri" aria-label="Default select example">
                                                    <option value="<?= $dt['thn_berdiri']; ?>"><?= $dt['thn_berdiri']; ?></option>
                                                </select>
                                            </div>
                                            <label>Status Gedung</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="status_gedung" id="status_gedung" aria-label="Default select example">
                                                    <option selected value="<?= $dt['status_gedung']; ?>"><?= $dt['status_gedung']; ?></option>
                                                    <option value="milik sendiri">Milik sendiri</option>
                                                    <option value="sewa/pinjam">Sewa/Pinjam</option>
                                                </select>
                                            </div>
                                            <label>kondisi Bangunan</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="kondisi_bangunan" id="kondisi_bangunan" aria-label="Default select example">
                                                    <option selected value="<?= $dt['kondisi_bangunan']; ?>"><?= $dt['kondisi_bangunan']; ?></option>
                                                    <option value="baik">Baik</option>
                                                    <option value="rusak">Rusak</option>
                                                </select>
                                            </div>
                                            <label>Koordinat BPP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="koordinat_lokasi_bpp" id="koordinat_lokasi_bpp" value="<?= $dt['koordinat_lokasi_bpp']; ?>" >
                                                <br>
                                                <label style="font-weight: normal">Format titik koordinat adalah Decimal Degree, contoh : <b>-6.2924034, 106.820540</b>
                                                    <br>Tutorial mendapatkan titik koordinat dapat melihat <a href="<?= base_url('assets/Panduan%20Decimal%20Degree%20Google%20Maps.pptx') ?>"><b>panduan berikut</b></a>. 
                                                </label>
                                            </div>
                                            <label>No.Telepon/Fax</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="No. Telepon" name="telp_bpp" id="telp_bpp" value="<?= $dt['telp_bpp']; ?>" onkeypress="return Angka(event)">
                                            </div>
                                            <label>Alamat Email</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="<?= $dt['email']; ?>">
                                            </div>
                                            <label>Alamat Website/Blog</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Website" name="website" id="website" value="<?= $dt['website']; ?>">
                                            </div>
                                            <label>Nama Pimpinan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Nama" name="ketua" id="ketua" value="<?= $dt['ketua']; ?>">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">No. HP</label>&nbsp; &nbsp;
                                                <input type="text" class="form-control" name="telp_hp" id="telp_hp" placeholder="No. HP" value="<?= $dt['telp_hp']; ?>" onkeypress="return Angka(event)">
                                            </div>
                                            <label>Koordinator Penyuluh</label>
                                            <div class="input-group mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio1" value="1" <?php echo ($dt["kode_koord_penyuluh"] == "1" ? 'checked="checked"' : '') ?>>
                                                    <label class="form-check-label" for="inlineRadio1">PNS</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio2" value="2" <?php echo ($dt["kode_koord_penyuluh"] == "2" ? 'checked="checked"' : '') ?>>
                                                    <label class="form-check-label" for="inlineRadio2">THL</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio3" value="3" <?php echo ($dt["kode_koord_penyuluh"] == "3" ? 'checked="checked"' : '') ?>>
                                                    <label class="form-check-label" for="inlineRadio2">Struktural</label>
                                                </div><br>
                                            </div>
                                            <div class="input-group mb-3" id="divPNS">
                                                <label style="margin-top: 10px;">PNS:</label>
                                                <select name="nama_koord_penyuluh" id="nama_koord_penyuluh" class="form-control input-lg" style="margin-left: 15px;">
                                                    <option value="<?= $dt['nama_koord_penyuluh']; ?>"><?= $dt['nip']; ?> - <?= $dt['nama']; ?></option>
                                                    <?php
                                                    foreach ($penyuluhPNS as $row) {
                                                        echo '<option value="' . $row["nip"] . '">' . $row["nip"] . ' - ' . $row["nama"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3" id="divTHL">
                                                <label>THL:</label>
                                                <select name="nama_koord_penyuluh_thl" id="nama_koord_penyuluh_thl" class="form-control input-lg" style="margin-left: 5px;">
                                                    <option value="<?= $dt['nama_koord_penyuluh_thl']; ?>"><?= $dt['noktp']; ?> - <?= $dt['nama']; ?></option>
                                                    <?php
                                                    foreach ($penyuluhTHL as $row2) {
                                                        echo '<option value="' . $row2["noktp"] . '">' . $row2["noktp"] . ' - ' . $row2["nama"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3" id="divST">
                                                <label style="margin-top: 10px;">NIP:</label>
                                                <input type="text" class="form-control" style="margin-left: 10px;" id="koord_lainya_nip" placeholder="ketua" name="koord_lainya_nip" value="<?= $dt['koord_lainya_nip']; ?>" onkeypress="return Angka(event)">
                                                <label style="margin-top: 10px;">Nama</label>
                                                <input type="text" class="form-control" style="margin-left: 10px;" id="koord_lainya_nama" placeholder="ketua" name="koord_lainya_nama" value="<?= $dt['koord_lainya_nama']; ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5>Sarana & Prasarana</h5>
                                            <label>Kendaraan Roda 4</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="roda_4_apbn" id="roda_4_apbn" placeholder="" value="<?= $dt['roda_4_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="roda_4_apbd" id="roda_4_apbd" placeholder="" value="<?= $dt['roda_4_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Kendaraan Roda 2</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="roda_2_apbn" id="roda_2_apbn" placeholder="" value="<?= $dt['roda_2_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="roda_2_apbd" id="roda_2_apbd" placeholder="" value="<?= $dt['roda_2_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Alat Pengolah Data (PC)</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="pc_apbn" id="pc_apbn" placeholder="" value="<?= $dt['pc_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="pc_apbd" id="pc_apbd" placeholder="" value="<?= $dt['pc_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Alat Pengolah Data (Laptop)</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="laptop_apbn" id="laptop_apbn" placeholder="" value="<?= $dt['laptop_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="laptop_apbd" id="laptop_apbd" placeholder="" value="<?= $dt['laptop_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Alat Pengolah Data (Printer)</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="printer_apbn" id="printer_apbn" placeholder="" value="<?= $dt['printer_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="printer_apbd" id="printer_apbd" placeholder="" value="<?= $dt['printer_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Alat Pengolah Data (Modem)</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="modem_apbn" id="modem_apbn" placeholder="" value="<?= $dt['modem_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="modem_apbd" id="modem_apbd" placeholder="" value="<?= $dt['modem_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>LCD Proyektor</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="lcd_apbn" id="lcd_apbn" placeholder="" value="<?= $dt['lcd_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="lcd_apbd" id="lcd_apbd" placeholder="" value="<?= $dt['lcd_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Soil Tester</label>
                                            <div class="input-group mb-3">
                                                <label style="margin-top: 10px;">APBN</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="soil_apbn" id="soil_apbn" placeholder="" value="<?= $dt['soil_apbn']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                <label style="margin-top: 10px;">APBD</label>
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="soil_apbd" id="soil_apbd" placeholder="" value="<?= $dt['soil_apbd']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5>Potensi Ekonomi</h5>
                                            <label>Kios saprotan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="kios_saprotan" id="kios_saprotan" placeholder="" value="<?= $dt['kios_saprotan']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Pedagang pengepul</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="pedagang_pengepul" id="pedagang_pengepul" placeholder="" value="<?= $dt['pedagang_pengepul']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Gudang pangan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="gudang_pangan" id="gudang_pangan" placeholder="" value="<?= $dt['gudang_pangan']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Perbankan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="perbankan" id="perbankan" placeholder="" value="<?= $dt['perbankan']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Industri Pertanian</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="industri_penyuluhan" id="industri_penyuluhan" placeholder="" value="<?= $dt['industri_penyuluhan']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                            </div>
                                            <h5>Lahan Percontohan</h5>
                                            <label>Di BPP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="luas_lahan_bp3k" id="luas_lahan_bp3k" placeholder="" value="<?= $dt['luas_lahan_bp3k']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Ha</label>&nbsp; &nbsp;
                                            </div>
                                            <label>Di Petani</label>
                                            <div class="input-group mb-3">
                                                <input type="text" style="margin-left: 10px;" class="form-control rupiah" name="luas_lahan_petani" id="luas_lahan_petani" placeholder="" value="<?= $dt['luas_lahan_petani']; ?>" onkeypress="return Angka(event)">
                                                &nbsp; &nbsp;<label style="margin-top: 10px;">Ha</label>&nbsp; &nbsp;
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="modal-foto" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Tambah Data</h4>
                            </div>
                            <div class="card-body">

                                <form role="form text-left" action="<?= base_url('KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_foto/' . $dt['id']) ?>" method="post" enctype="multipart/form-data">
                                    <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                            <input type="hidden" name="satminkal" id="satminkal" value="<?= $kode_kab; ?>">
                                            <input type="hidden" name="id" value="<?= $dt['id']; ?>">
                                            <input type="hidden" name="kecamatan" value="<?= $dt['kecamatan']; ?>">
                                            <input type="hidden" name="fotolama" value="<?= $dt['foto']; ?>">
                                            <input type="hidden" name="fotolama2" value="<?= $dt['foto_depan']; ?>">
                                            <input type="hidden" name="fotolama3" value="<?= $dt['foto_belakang']; ?>">
                                            <input type="hidden" name="fotolama4" value="<?= $dt['foto_samping']; ?>">
                                            <input type="hidden" name="fotolama5" value="<?= $dt['foto_dalam']; ?>">
                                            <input type="hidden" name="urut" id="urut" value="<?= $dt['urut']; ?>">
                                            <input type="hidden" name="kode_bp3k" id="kode_bp3k" value="<?= $bp; ?>">
                                            <label>Foto BPP (Primary)</label>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-4">
                                                    <img src="<?= base_url('/assets/img/' . $dt['foto']); ?>" class="img-thumbnail img-preview">
                                                </div>
                                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                                <label class="custom-file-label" for="foto"><?= $dt['foto']; ?></label>
                                            </div>
                                            <label>Foto Tampak Depan BPP</label>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-4">
                                                    <img src="<?= base_url('/assets/img/' . $dt['foto_depan']); ?>" class="img-thumbnail img-preview2">
                                                </div>
                                                <input type="file" class="custom-file-input" id="foto_depan" name="foto_depan" onchange="previewImg2()">
                                                <label class="custom-file-label2" for="foto_depan"><?= $dt['foto_depan']; ?></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Foto Tampak Belakang BPP</label>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-4">
                                                    <img src="<?= base_url('/assets/img/' . $dt['foto_belakang']); ?>" class="img-thumbnail img-preview3">
                                                </div>
                                                <input type="file" class="custom-file-input" id="foto_belakang" name="foto_belakang" onchange="previewImg3()">
                                                <label class="custom-file-label3" for="foto_belakang"><?= $dt['foto_belakang']; ?></label>
                                            </div>
                                            <label>Foto Tampak Samping BPP</label>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-4">
                                                    <img src="<?= base_url('/assets/img/' . $dt['foto_samping']); ?>" class="img-thumbnail img-preview4">
                                                </div>
                                                <input type="file" class="custom-file-input" id="foto_samping" name="foto_samping" onchange="previewImg4()">
                                                <label class="custom-file-label4" for="foto_samping"><?= $dt['foto_samping']; ?></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Foto Tampak Dalam BPP</label>
                                            <div class="input-group mb-3">
                                                <div class="col-lg-4">
                                                    <img src="<?= base_url('/assets/img/' . $dt['foto_dalam']); ?>" class="img-thumbnail img-preview5">
                                                </div>
                                                <input type="file" class="custom-file-input" id="foto_dalam" name="foto_dalam" onchange="previewImg5()">
                                                <label class="custom-file-label5" for="foto_dalam"><?= $dt['foto_dalam']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-info">Simpan Data</button>
                                    </div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-wilkec" tabindex="-1" role="dialog" aria-labelledby="modal-wilkec" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Tambah Data</h4>
                        </div>
                        <div class="card-body">

                            <form role="form text-left" action="<?= base_url('KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_wilkec'); ?>">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $dt['kode_prop']; ?>">
                                        <input type="hidden" name="satminkal" id="satminkal" value="<?= $dt['satminkal']; ?>">
                                        <input type="hidden" name="kode_bp3k" id="kode_bp3k" value="<?= $dt['kode_bp3k']; ?>">

                                        <label for="kecamatan">Nama Kecamatan</label>
                                        <div class="input-group mb-3">
                                            <select name="kecamatan" id="kec" class="form-control input-lg">
                                                <option value="">Pilih Kecamatan</option>
                                                <?php
                                                foreach ($kec as $row) {
                                                    echo '<option value="' . $row["id_daerah"] . '">' . 'Kec. ' . $row["deskripsi"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="jum_petani">Jumlah Petani</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" id="jum_petani" placeholder="Jumlah Petani" name="jum_petani">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="btnSaveWilkec" class="btn bg-gradient-info">Simpan Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-klas" tabindex="-1" role="dialog" aria-labelledby="modal-klas" aria-hidden="true">
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
                                        <input type="hidden" name="id_bpp" id="id_bpp" value="<?= $dt['id']; ?>">
                                        <label for="tahun_beridiri">Tahun</label>
                                        <div class="input-group mb-3">
                                            <select id="tahun_klas" name="tahun" class="form-select tahun" aria-label="Default select example">
                                                <option value="">Pilih Tahun</option>
                                            </select>
                                        </div>
                                        <label for="penyuluh_swadaya">Klasifikasi</label>
                                        <div class="input-group mb-3">
                                            <select name="klasifikasi" id="klasifikasi" class="form-control input-lg">
                                                <option value="">Pilih Klasifikasi</option>
                                                <?php
                                                foreach ($klasifikasi as $klas) {
                                                    echo '<option value="' . $klas["klasifikasi"] . '">' . $klas["klasifikasi"] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <label for="alamat">Skor</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control rupiah" id="skor" placeholder="Skor" name="skor" onkeypress="return Angka(event)">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="btnSaveKlas" class="btn bg-gradient-info">Simpan Data</button>
                                </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-fk" tabindex="-1" role="dialog" aria-labelledby="modal-fk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-l" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Tambah Data</h4>
                    </div>
                    <div class="card-body">

                        <form role="form text-left">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="id_bpp" id="id_bpp" value="<?= $dt['id']; ?>">
                                    <label for="tahun_beridiri">Tahun</label>
                                    <div class="input-group mb-3">
                                        <select id="tahun" name="tahun" class="form-select tahun" aria-label="Default select example">
                                            <option value="">Pilih Tahun</option>
                                            <script>
                                                var tahun = 2021;
                                                for (i = 1990; i <= tahun; i++) {
                                                    document.write("<option>" + i + "</option>");
                                                }
                                            </script>
                                        </select>
                                    </div>
                                    <label for="fasilitasi">Fasilitasi</label>
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
                                <button type="button" id="btnSaveFas" class="btn bg-gradient-info">Simpan Data</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-award" tabindex="-1" role="dialog" aria-labelledby="modal-award" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-l" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Edit Data</h4>
                    </div>
                    <div class="card-body">

                        <form role="form text-left" action="<?= base_url('profil/Lembaga/save'); ?>">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $dt['kode_prop']; ?>">
                                    <input type="hidden" name="satminkal" id="satminkal" value="<?= $dt['satminkal']; ?>">
                                    <input type="hidden" name="kode_bp3k" id="kode_bp3k" value="<?= $dt['kode_bp3k']; ?>">
                                    <label for="alamat">Nama Penghargaan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="nama_penghargaan" placeholder="Nama Penghargaan" name="nama_penghargaan">
                                    </div>
                                    <label for="penyuluh_swadaya">Tingkat</label>
                                    <div class="input-group mb-3">
                                        <select name="tingkat" id="tingkat" class="form-control input-lg">
                                            <option value="">Pilih</option>
                                            <option value="Pusat">Pusat</option>
                                            <option value="Daerah">Daerah</option>
                                        </select>
                                    </div>
                                    <label for="penyuluh_swadaya">Peringkat</label>
                                    <div class="input-group mb-3">
                                        <select name="peringkat" id="peringkat" class="form-control input-lg">
                                            <option value="">Pilih</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                        </select>
                                    </div>
                                    <label for="tahun_beridiri">Tahun</label>
                                    <div class="input-group mb-3">
                                        <select id="tahun_aw" name="tahun" class="form-select tahun" aria-label="Default select example">
                                            <option value="">Pilih Tahun</option>
                                            <script>
                                                var tahun = 2021;
                                                for (i = 1990; i <= tahun; i++) {
                                                    document.write("<option>" + i + "</option>");
                                                }
                                            </script>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="btnSaveAw" class="btn bg-gradient-info">Simpan Data</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dak" tabindex="-1" role="dialog" aria-labelledby="modal-dak" aria-hidden="true">
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
                                    <input type="hidden" name="id_bpp" id="id_bpp" value="<?= $dt['id']; ?>">
                                    <input type="hidden" name="id" id="id">
                                    <label for="tahun_beridiri">Tahun</label>
                                    <div class="input-group mb-3">
                                        <select id="tahun_dak" name="tahun_dak" class="form-select tahun">
                                            <option value="">Pilih Tahun</option>
                                            <script>
                                                var tahun = 2021;
                                                for (i = 1990; i <= tahun; i++) {
                                                    document.write("<option>" + i + "</option>");
                                                }
                                            </script>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="btnSaveDak" class="btn bg-gradient-info">Simpan Data</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-powil" tabindex="-1" role="dialog" aria-labelledby="modal-powil" aria-hidden="true">
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
                                    <input type="hidden" name="id_bpp" id="id_bpp" value="<?= $dt['id']; ?>">
                                    <input type="hidden" name="id_potensi" id="id_potensi">
                                    <label for="penyuluh_swadaya">Komoditas</label>
                                    <div class="input-group mb-3">
                                        <select name="kode_komoditas" id="kode_komoditas" class="form-control input-lg">
                                            <option value="">Pilih Komoditas</option>
                                            <?php
                                            foreach ($jenis_komoditas as $jekom) {
                                                echo '<option value="' . $jekom["kode_komoditas"] . '">' . $jekom["nama_subsektor"] . ' - ' . $jekom["nama_komoditas"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label for="tahun_beridiri">Luas Lahan (Ha)</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control rupiah" id="luas_lhn" placeholder="Luas lahan" name="luas_lhn" onkeypress="return Angka(event)">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="btnSaveKom" class="btn bg-gradient-info">Simpan Data</button>
                            </div>
                        </form>
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



<?= $this->section('script') ?>
<script>
    function Angka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    function previewImg() {
        const sampul = document.querySelector('#foto');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        sampulLabel.textContent = foto.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(foto.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg2() {
        const sampul2 = document.querySelector('#foto_depan');
        const sampulLabel2 = document.querySelector('.custom-file-label2');
        const imgPreview2 = document.querySelector('.img-preview2');

        sampulLabel2.textContent = foto_depan.files[0].name;

        const fileSampul2 = new FileReader();
        fileSampul2.readAsDataURL(foto_depan.files[0]);

        fileSampul2.onload = function(e) {
            imgPreview2.src = e.target.result;
        }
    }

    function previewImg3() {
        const sampul3 = document.querySelector('#foto_belakang');
        const sampulLabel3 = document.querySelector('.custom-file-label3');
        const imgPreview3 = document.querySelector('.img-preview3');

        sampulLabel3.textContent = foto_belakang.files[0].name;

        const fileSampul3 = new FileReader();
        fileSampul3.readAsDataURL(foto_belakang.files[0]);

        fileSampul3.onload = function(e) {
            imgPreview3.src = e.target.result;
        }
    }

    function previewImg4() {
        const sampul4 = document.querySelector('#foto_samping');
        const sampulLabel4 = document.querySelector('.custom-file-label4');
        const imgPreview4 = document.querySelector('.img-preview4');

        sampulLabel4.textContent = foto_samping.files[0].name;

        const fileSampul4 = new FileReader();
        fileSampul4.readAsDataURL(foto_samping.files[0]);

        fileSampul4.onload = function(e) {
            imgPreview4.src = e.target.result;
        }
    }

    function previewImg5() {
        const sampul5 = document.querySelector('#foto_dalam');
        const sampulLabel5 = document.querySelector('.custom-file-label5');
        const imgPreview5 = document.querySelector('.img-preview5');

        sampulLabel5.textContent = foto_dalam.files[0].name;

        const fileSampul5 = new FileReader();
        fileSampul5.readAsDataURL(foto_dalam.files[0]);

        fileSampul5.onload = function(e) {
            imgPreview5.src = e.target.result;
        }
    }
</script>
<script>
    var min = 2010,
        max = 2030,
        select = document.getElementById('tahun_klas');

    for (var i = min; i <= max; i++) {
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }
    select.value = new Date().getFullYear();

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
        $('#month').val('<?= $dt["bln_berdiri"]; ?>').change();
        $('#day').val('<?= $dt["tgl_berdiri"]; ?>').change();

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
</script>

<!-- ajax crud wilkec -->
<script>
    $(document).ready(function() {
        $(document).delegate('#btnSave', 'click', function() {
            var valid = true;

            var koordinat_lokasi_bpp = $('#koordinat_lokasi_bpp').val();
            if (koordinat_lokasi_bpp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Titik Koordinat Lahan Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                valid = false;
            }else {
                var koord_array = koordinat_lokasi_bpp.split(",");
                if(koord_array.length!=2 || !(validateLatLng(koord_array[0].trim(), koord_array[1].trim()))){
                    Swal.fire({
                        title: 'Error',
                        text: "Titik Koordinat Lahan harus format Decimal Degree, contoh : -6.2924034, 106.820540",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    valid = false;
                }
            }

            if(valid){
                $("#form_bpp").submit();
            }
        });
    });

</script>

<!-- ajax crud wilkec -->
<script>
    $(document).ready(function() {
        $(document).delegate('#btnSaveWilkec', 'click', function() {
            var kode_bp3k = $('#kode_bp3k').val();
            var kode_prop = $('#kode_prop').val();
            var satminkal = $('#satminkal').val();
            var kecamatan = $('#kec').val();
            var jum_petani = $('#jum_petani').val();

            $.ajax({
                url: '<?= base_url('/KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_wilkec/') ?>',
                type: 'POST',
                data: {
                    'kode_bp3k': kode_bp3k,
                    'kode_prop': kode_prop,
                    'satminkal': satminkal,
                    'kecamatan': kecamatan,
                    'jum_petani': jum_petani,
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


        $(document).delegate('#btn-edit-wilkec', 'click', function() {
            //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
            // alert(id);
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/wilkec/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    // $(".daftpos").html(res)
                    //console.log(res);
                    //res = JSON.parse(res);

                    $('#id').val(res[0].id);
                    $('#kode_bp3k').val(res[0].kode_bp3k);
                    $('#kode_prop').val(res[0].kode_prop);
                    $('#satminkal').val(res[0].satminkal);
                    $('#kec').val(res[0].kecamatan);
                    $('#jum_petani').val(res[0].jum_petani);
                    $('#judul-form').text('Edit Data');
                    $('#modal-wilkec').modal("show");
                    $("#btnSaveWilkec").attr("id", "btnUbahWilkec");

                    $(document).delegate('#btnUbahWilkec', 'click', function() {
                        console.log('ok');

                        var id = $('#id').val();
                        var kode_prop = $('#kode_prop').val();
                        var kode_bp3k = $('#kode_bp3k').val();
                        var satminkal = $('#satminkal').val();
                        var kecamatan = $('#kec').val();
                        var jum_petani = $('#jum_petani').val();

                        let formData = new FormData();
                        formData.append('id', id);
                        formData.append('kode_prop', kode_prop);
                        formData.append('kode_bp3k', kode_bp3k);
                        formData.append('satminkal', satminkal);
                        formData.append('kecamatan', kecamatan);
                        formData.append('jum_petani', jum_petani);
                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_wilkec/' + id,
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

        $(document).delegate('#btn-hapus-wilkec', 'click', function() {
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
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete_wilkec/' + id,
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

<!-- ajax crud klasifikasi -->
<script>
    $(document).ready(function() {
        $(document).delegate('#btnSaveKlas', 'click', function() {
            var id_bpp = $('#id_bpp').val();
            var tahun = $('#tahun_klas').val();
            var klasifikasi = $('#klasifikasi').val();
            var skor = $('#skor').val();
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_klas/',
                type: 'POST',
                data: {
                    'id_bpp': id_bpp,
                    'tahun': tahun,
                    'klasifikasi': klasifikasi,
                    'skor': skor,
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


        $(document).delegate('#btn-edit-klas', 'click', function() {
            //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
            // alert(id);
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/detail_klasifikasi/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    // $(".daftpos").html(res)
                    //console.log(res);
                    //res = JSON.parse(res);

                    $('#id').val(res[0].id);
                    $('#id_bpp').val(res[0].id_bpp);
                    $('#tahun_klas').val(res[0].tahun);
                    $('#klasifikasi').val(res[0].klasifikasi);
                    $('#skor').val(res[0].skor);
                    $('#judul-form').text('Edit Data');
                    $('#modal-klas').modal("show");
                    $("#btnSaveKlas").attr("id", "btnUbahKlas");

                    $(document).delegate('#btnUbahKlas', 'click', function() {
                        console.log('ok');

                        var id = $('#id').val();
                        var id_bpp = $('#id_bpp').val();
                        var tahun = $('#tahun_klas').val();
                        var klasifikasi = $('#klasifikasi').val();
                        var skor = $('#skor').val();

                        let formData = new FormData();
                        formData.append('id', id);
                        formData.append('id_bpp', id_bpp);
                        formData.append('tahun', tahun);
                        formData.append('klasifikasi', klasifikasi);
                        formData.append('skor', skor);
                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_klas/' + id,
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

        $(document).delegate('#btn-hapus-klas', 'click', function() {
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
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete_klas/' + id,
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

<!-- ajax crud fasilitasi -->
<script>
    $(document).delegate('#btnSaveFas', 'click', function() {
        var id_bpp = $('#id_bpp').val();
        var tahun = $('#tahun').val();
        var fasilitasi = $('#fasilitasi').val();
        var kegiatan = $('#kegiatan').val();

        alert(id_bpp);
        alert(tahun);
        alert(fasilitasi);
        alert(kegiatan);


        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_fas/',
            type: 'POST',
            data: {
                'id_bpp': id_bpp,
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
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/fasilitas/' + $(this).data('id'),
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                // $(".daftpos").html(res)
                //console.log(res);
                //res = JSON.parse(res);

                $('#id').val(res[0].id);
                $('#id_bpp').val(res[0].id_bpp);
                $('#fasilitasi').val(res[0].fasilitasi);
                $('#kegiatan').val(res[0].kegiatan);
                $('#tahun').val(res[0].tahun);
                $('#modal-fk').modal("show");
                $('#judul-form').text('Edit Data');
                $("#btnSaveFas").attr("id", "btnUbahFas");

                $(document).delegate('#btnUbahFas', 'click', function() {
                    console.log('ok');

                    var id = $('#id').val();
                    var id_bpp = $('#id_bpp').val();
                    var fasilitasi = $('#fasilitasi').val();
                    var kegiatan = $('#kegiatan').val();
                    var tahun = $('#tahun').val();

                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('fasilitasi', fasilitasi);
                    formData.append('id_bpp', id_bpp);
                    formData.append('kegiatan', kegiatan);
                    formData.append('tahun', tahun);
                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_fas/' + id,
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

    $(document).delegate('#btn-hapus-fas', 'click', function() {
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
                    url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete_fas/' + id,
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
</script>

<!-- ajax crud penghargaan -->
<script>
    $(document).delegate('#btnSaveAw', 'click', function() {
        var kode_bp3k = $('#kode_bp3k').val();
        var kode_prop = $('#kode_prop').val();
        var satminkal = $('#satminkal').val();
        var nama_penghargaan = $('#nama_penghargaan').val();
        var peringkat = $('#peringkat').val();
        var tingkat = $('#tingkat').val();
        var tahun = $('#tahun_aw').val();


        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_award/',
            type: 'POST',
            data: {
                'kode_bp3k': kode_bp3k,
                'kode_prop': kode_prop,
                'satminkal': satminkal,
                'nama_penghargaan': nama_penghargaan,
                'peringkat': peringkat,
                'tingkat': tingkat,
                'tahun': tahun,
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


    $(document).delegate('#btn-edit-aw', 'click', function() {
        //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
        // alert(id);
        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/penghargaan/' + $(this).data('id'),
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                // $(".daftpos").html(res)
                //console.log(res);
                //res = JSON.parse(res);

                $('#id').val(res[0].id);
                $('#kode_bp3k').val(res[0].kode_bp3k);
                $('#kode_prop').val(res[0].kode_prop);
                $('#satminkal').val(res[0].satminkal);
                $('#nama_penghargaan').val(res[0].nama_penghargaan);
                $('#peringkat').val(res[0].peringkat);
                $('#tingkat').val(res[0].tingkat);
                $('#tahun_aw').val(res[0].tahun);
                $('#modal-award').modal("show");
                $('#judul-form').text('Edit Data');
                $("#btnSaveAw").attr("id", "btnUbahAw");

                $(document).delegate('#btnUbahAw', 'click', function() {
                    console.log('ok');

                    var id = $('#id').val();
                    var kode_bp3k = $('#kode_bp3k').val();
                    var kode_prop = $('#kode_prop').val();
                    var satminkal = $('#satminkal').val();
                    var nama_penghargaan = $('#nama_penghargaan').val();
                    var peringkat = $('#peringkat').val();
                    var tingkat = $('#tingkat').val();
                    var tahun = $('#tahun_aw').val();

                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('kode_prop', kode_prop);
                    formData.append('kode_bp3k', kode_bp3k);
                    formData.append('satminkal', satminkal);
                    formData.append('nama_penghargaan', nama_penghargaan);
                    formData.append('peringkat', peringkat);
                    formData.append('tingkat', tingkat);
                    formData.append('tahun', tahun);
                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_award/' + id,
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

    $(document).delegate('#btn-hapus-aw', 'click', function() {
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
                    url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete_award/' + id,
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
</script>

<!-- ajax crud DAK -->
<script>
    $(document).delegate('#btnSaveDak', 'click', function() {
        var id_bpp = $('#id_bpp').val();
        var tahun_dak = $('#tahun_dak').val();


        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_dak/',
            type: 'POST',
            data: {
                'id_bpp': id_bpp,
                'tahun_dak': tahun_dak,
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


    $(document).delegate('#btn-edit-dak', 'click', function() {
        //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
        // alert(id);
        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/dana/' + $(this).data('id'),
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                // $(".daftpos").html(res)
                //console.log(res);
                //res = JSON.parse(res);

                $('#id').val(res[0].id);
                $('#id_bpp').val(res[0].id_bpp);
                $('#tahun_dak').val(res[0].tahun_dak);
                $('#modal-dak').modal("show");
                $('#judul-form').text('Edit Data');
                $("#btnSaveDak").attr("id", "btnUbahDak");

                $(document).delegate('#btnUbahDak', 'click', function() {
                    console.log('ok');

                    var id = $('#id').val();
                    var id_bpp = $('#id_bpp').val();
                    var tahun_dak = $('#tahun_dak').val();

                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('id_bpp', id_bpp);
                    formData.append('tahun_dak', tahun_dak);
                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_dak/' + id,
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

    $(document).delegate('#btn-hapus-dak', 'click', function() {
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
                    url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete_dak/' + id,
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
</script>

<!-- ajax crud Potensi Wilayah -->
<script>
    $(document).delegate('#btnSaveKom', 'click', function() {
        var id_bpp = $('#id_bpp').val();
        var kode_komoditas = $('#kode_komoditas').val();
        var luas_lhn = $('#luas_lhn').val();


        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/save_powil/',
            type: 'POST',
            data: {
                'id_bpp': id_bpp,
                'kode_komoditas': kode_komoditas,
                'luas_lhn': luas_lhn,
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


    $(document).delegate('#btn-edit-kom', 'click', function() {
        //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
        // alert(id);
        $.ajax({
            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/powil/' + $(this).data('id_potensi'),
            type: 'GET',
            dataType: 'JSON',
            success: function(res) {
                // $(".daftpos").html(res)
                //console.log(res);
                //res = JSON.parse(res);

                $('#id_potensi').val(res[0].id_potensi);
                $('#id_bpp').val(res[0].id_bpp);
                $('#kode_komoditas').val(res[0].kode_komoditas);
                $('#luas_lhn').val(res[0].luas_lhn);
                $('#modal-powil').modal("show");
                $('#judul-form').text('Edit Data');
                $("#btnSaveKom").attr("id", "btnUbahKom");

                $(document).delegate('#btnUbahKom', 'click', function() {
                    console.log('ok');

                    var id_potensi = $('#id_potensi').val();
                    var id_bpp = $('#id_bpp').val();
                    var kode_komoditas = $('#kode_komoditas').val();
                    var luas_lhn = $('#luas_lhn').val();

                    let formData = new FormData();
                    formData.append('id_potensi', id_potensi);
                    formData.append('id_bpp', id_bpp);
                    formData.append('kode_komoditas', kode_komoditas);
                    formData.append('luas_lhn', luas_lhn);
                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/update_powil/' + id_potensi,
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

    $(document).delegate('#btn-hapus-kom', 'click', function() {
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
                var id_potensi = $(this).data('id_potensi');

                $.ajax({
                    url: '<?= base_url() ?>/KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete_powil/' + id_potensi,
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
</script>
<?= $this->endSection() ?>