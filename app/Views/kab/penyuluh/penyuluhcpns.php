<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $seskab = session()->get('kodebapel'); ?>
	<center>
    <h3> Daftar CPNS Calon Penyuluh Kab <?= ucwords(strtolower($nama_kabupaten)) ?> </h3>
	 <p> Ditemukan <?= ucwords(strtolower($jml_data)) ?> Data </p>
</center>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">

            <div class="row">
                <div class="col-md-4">
                    <form method="POST" action="<?= base_url('Penyuluh/PenyuluhCpns/viewfilter'); ?>">
                    <label>Provinsi</label>
                    
                    <div class="input-group mb-3">
                            <select name="filter_prov" id="filter_prov" class="form-control">
                                <?php if(count($list_prov) > 1) {?>
                                    <option value="">Pilih Provinsi</option>
                                <?php } ?>
                                <?php foreach($list_prov as $row){
                                    echo '<option value="' . $row["id_prop"] . '">' . $row["nama_prop"] . '</option>';
                                } ?>
                            </select>
                    </div>
                </div>
                <div class="col-md-4">    
                    <label>Kabupaten</label>
                        <div class="input-group mb-3">
                            <select name="filter_kab" id="filter_kab" class="form-control">
                                <?php if(count($list_kab) > 1) {?>
                                    <option value="">Pilih Kabupaten</option>
                                <?php } ?>
                                <?php foreach($list_kab as $row){
                                    echo '<option value="' . $row["id_dati2"] . '">' . $row["nama_dati2"] . '</option>';
                                } ?>
                            </select>
                    </div>
                </div>
                <div class="col-md-4">      
                    <label>Kecamatan</label>
                        <div class="input-group mb-3">
                            <select name="filter_kec" id="filter_kec" class="form-control">
                                <?php if(count($list_kec) > 1) {?>
                                    <option value="">Pilih Kecamatan</option>
                                <?php } ?>
                                <?php foreach($list_kec as $row){
                                    echo '<option value="' . $row["id_daerah"] . '">' . $row["deskripsi"] . '</option>';
                                } ?>
                            </select>
                    </div>
                </div>
            </div>    
            <div class="row">    
                <div class="col-md-2">       
                    <button type="submit" name="filter_submit" class="btn bg-gradient-warning btn-sm">Filter</button>
                    </form>     
               </div>
               <div class="col-md-7">
               </div>    
               <div class="col-md-3">   
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Data</button>
                </div>
            </div>      
	
            <br>
           
            <div class="card">
                <div class="table-responsive">
                    <table id="tblcpns" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <td class="text-uppercase text-secondary text-xxs"></td>
                                <td class="text-uppercase text-secondary text-xxs">NIK</td>
                                <td class="text-uppercase text-secondary text-xxs">NIP</td>
                                <td class="text-uppercase text-secondary text-xxs">Nama</td>
                                <td class="text-uppercase text-secondary text-xxs">UnitKerja</td>
                                <td class="text-uppercase text-secondary text-xxs">TempatTugas</td>
                                <td class="text-uppercase text-secondary text-xxs">Status</td>
                                <td class="text-uppercase text-secondary text-xxs">JabatanTerakhir</td>
                                <td class="text-uppercase text-secondary text-xxs">TerakhirUpdate</td>
                                <td class="text-uppercase text-secondary text-xxs"></td>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIP</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit<br>Kerja</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat<br>Tugas</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan<br>Terakhir</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terakhir<br>Update</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data<br>Dasar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($tabel_data as $row) {
                            ?>
                                <tr>
                                    <td class="align-middle rupiah text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluh/detail/' . $row['nip']) ?>"><?= $row['noktp'] ?></a></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['nip'] ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['gelar_dpn'] ?> <?= $row['nama'] ?> <?= $row['gelar_blk'] ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_bpp'] ?><?= $row['nama_bapel'] ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0">Kec.<?= ucwords(strtolower($row['kecamatan_tugas'])) ?></p>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['status_kel'] ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['namajab'] ?> / <?= $row['gol_ruang'] ?></p>
                                        </p>
                                        </p>
                                    </td>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_update'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href="#">
                                            <button type="button" id="btnEdit" data-id="<?= $row['id']; ?>" class="btn bg-gradient-warning btn-sm">
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>
                                        </a>
                                        <button class="btn bg-gradient-danger btn-sm" id="btnHapus" data-id="<?= $row['id']; ?>" type="button">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        </a>
                                        <a href="#">
                                            <button type="button" id="btnEditStatus" data-id="<?= $row['id']; ?>" class="btn bg-gradient-info btn-sm">
                                                <i class="fas fa-edit"></i> Manajemen Status
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form text-left" method="POST" action="<?= base_url('Penyuluh/PenyuluhCpns/save/'); ?>">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" name="id" id="id" class="form-control id">
                                                        <input type="hidden" name="jenis_penyuluh" id="jenis_penyuluh" class="form-control jenis_penyuluh" value="1">
                                                        <input type="hidden" name="satminkal" id="satminkal" class="form-control satminkal" value="<?= $seskab; ?>">
                                                        <input type="hidden" name="mapping" id="mapping" class="form-control mapping" value="yes">
                                                        <input type="hidden" id="tgl_update" name="tgl_update" class="form-control">
                                                        <input type="hidden" name="tempat_tugas" id="tempat_tugas">
                                                        <input type="hidden" name="status" id="status" value="7">
                                                        <input type="hidden" name="tgl_pensiun" id="tgl_pensiun">
                                                        <input type="hidden" name="bulan_pensiun" id="bulan_pensiun">
                                                        <input type="hidden" name="tahun_pensiun" id="tahun_pensiun">
                                                        <?php
                                                        foreach ($tabel_data as $cek1) {
                                                        ?>
                                                            <input type="hidden" name="unit_kerja_kab" id="unit_kerja_kab" value="<?= $cek1['nama_bapel']; ?>">
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        foreach ($tabel_data as $cek) {
                                                        ?>
                                                            <input type="hidden" name="batas_pensiun" id="batas_pensiun" value="<?= $cek['bts_pensi']; ?>">
                                                        <?php
                                                        }
                                                        ?>
                                                        <label>NIP (18 Digit)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" id="nip" name="nip" class="form-control" placeholder="Penulisan NIP disambung (tanpa tanda pemisah)" maxlength="18" oninput="NipOnly(this)">
                                                        </div>
                                                        <label>NIK (16 Digit)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" id="noktp" name="noktp" class="form-control" placeholder="Penulisan NIK disambung (tanpa tanda pemisah)" maxlength="16" oninput="NikOnly(this)" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Nama Penyuluh</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" aria-label="Password" aria-describedby="password-addon">
                                                        </div>

                                                        <label>Gelar depan & Gelar Belakang</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="gelar_dpn" name="gelar_dpn" class="form-control" placeholder="Gelar Depan" aria-label="Password" aria-describedby="password-addon">

                                                            <input type="text" id="gelar_blk" name="gelar_blk" class="form-control" placeholder="| Gelar Belakang" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Tempat, Tanggal Lahir</label>
                                                        <div class="input-group mb-1">
                                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir" placeholder="Tempat Lahir">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir">
                                                        </div>
                                                        <label>Jenis Kelamin</label>
                                                        <div class="input-group mb-3">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input jenis_kelamin" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="1">
                                                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input jenis_kelamin" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="2">
                                                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                                            </div>
                                                        </div>
                                                        <label>Agama</label>
                                                        <div class="input-group mb-3">
                                                            <select name="agama" id="agama" class="form-select" aria-label="Default select example">
                                                                <option selected value="">Pilih Agama</option>
                                                                <option value="1">Islam</option>
                                                                <option value="2">Protestan</option>
                                                                <option value="3">Khatolik</option>
                                                                <option value="4">Hindu</option>
                                                                <option value="5">Budha</option>
                                                            </select>
                                                        </div>
                                                        <label>Bidang Keahlian</label>
                                                        <div class="input-group mb-3">
                                                            <select name="keahlian" id="keahlian" class="form-select" aria-label="Default select example">
                                                                <option selected>Pilih Bidang Keahlian</option>
                                                                <option value="1">Tanaman Pangan</option>
                                                                <option value="2">Peternakan</option>
                                                                <option value="3">Perkebunan</option>
                                                                <option value="4">Horikultura</option>
                                                            </select>
                                                        </div>
                                                        <label>Tingkat Pendidikan Akhir</label>
                                                        <div class="input-group mb-3">
                                                            <select name="tingkat_pendidikan" id="tingkat_pendidikan" class="form-control input-lg tingkat_pendidikan">
                                                                <option value="">Pilih Tingkat Pendidikan</option>
                                                                <?php
                                                                foreach ($tingkatpen as $row4) {
                                                                    echo '<option value="' . $row4["id"] . '">' . $row4["nama"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>Bidang Pendidikan</label>
                                                        <div class="input-group mb-3">
                                                            <select name="bidang_pendidikan" id="bidang_pendidikan" class="form-select" aria-label="Default select example">
                                                                <option selected>Pilih Bidang Pendidikan</option>
                                                                <option value="Pertanian">Pertanian</option>
                                                                <option value="Non Pertanian">Non Pertanian</option>
                                                            </select>
                                                        </div>
                                                        <label>Jurusan</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="jurusan" id="jurusan" class="form-control" placeholder="Jurusan" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Nama Sekolah/Universitas</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" placeholder="Nama Sekolah/Universitas" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label>Lokasi Kerja</label>
                                                        <div class="input-group mb-3">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input rad" type="radio" name="kode_kab" id="kode_kab1" value="3">
                                                                <label class="form-check-label" for="inlineRadio1">Kabupaten/Kota</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input rad" type="radio" name="kode_kab" id="kode_kab2" value="4">
                                                                <label class="form-check-label" for="inlineRadio2">Kecamatan</label>
                                                            </div>
                                                        </div>
                                                        <div id="form22">
                                                            <label>Kecamatan 1</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas1" id="kecamatan_tugas1" class="form-control input-lg kecamatan_tugas1">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row2) {
                                                                        echo '<option value="' . $row2["id_daerah"] . '">' . $row2["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form13">
                                                            <label>Kecamatan 2</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas2" id="kecamatan_tugas2" class="form-control input-lg kecamatan_tugas2">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row5) {
                                                                        echo '<option value="' . $row5["id_daerah"] . '">' . $row5["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form14">
                                                            <label>Kecamatan 3</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas3" id="kecamatan_tugas3" class="form-control input-lg kecamatan_tugas3">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row6) {
                                                                        echo '<option value="' . $row6["id_daerah"] . '">' . $row6["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form15">
                                                            <label>Kecamatan 4</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas4" id="kecamatan_tugas4" class="form-control input-lg kecamatan_tugas4">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row7) {
                                                                        echo '<option value="' . $row7["id_daerah"] . '">' . $row7["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form16">
                                                            <label>Kecamatan 5</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas5" id="kecamatan_tugas5" class="form-control input-lg kecamatan_tugas5">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row8) {
                                                                        echo '<option value="' . $row8["id_daerah"] . '">' . $row8["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form17">
                                                            <label>Kecamatan 6</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas6" id="kecamatan_tugas6" class="form-control input-lg kecamatan_tugas6">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row9) {
                                                                        echo '<option value="' . $row9["id_daerah"] . '">' . $row9["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form18">
                                                            <label>Kecamatan 7</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas7" id="kecamatan_tugas7" class="form-control input-lg kecamatan_tugas7">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row10) {
                                                                        echo '<option value="' . $row10["id_daerah"] . '">' . $row10["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form19">
                                                            <label>Kecamatan 8</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas8" id="kecamatan_tugas8" class="form-control input-lg kecamatan_tugas8">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row11) {
                                                                        echo '<option value="' . $row11["id_daerah"] . '">' . $row11["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form20">
                                                            <label>Kecamatan 9</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas9" id="kecamatan_tugas9" class="form-control input-lg kecamatan_tugas9">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row12) {
                                                                        echo '<option value="' . $row12["id_daerah"] . '">' . $row12["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form21">
                                                            <label>Kecamatan 10</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas10" id="kecamatan_tugas10" class="form-control input-lg kecamatan_tugas10">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row13) {
                                                                        echo '<option value="' . $row13["id_daerah"] . '">' . $row13["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="form2">
                                                            <label>Kecamatan</label>
                                                            <div class="input-group mb-3">
                                                                <select name="kecamatan_tugas" id="kecamatan_tugas" class="form-control input-lg tempat_tugas">
                                                                    <option value="">Pilih Kecamatan</option>
                                                                    <?php
                                                                    foreach ($tugas as $row14) {
                                                                        echo '<option value="' . $row14["id_daerah"] . '">' . $row14["deskripsi"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form1">
                                                            <label>Unit Kerja (BPP)</label>
                                                            <div class="input-group mb-3">
                                                                <select name="unit_kerja" id="unit_kerja" class="form-control input-lg unit_kerja">
                                                                    <option value="">Pilih Unit Kerja</option>
                                                                    <?php
                                                                    foreach ($bpp as $row15) {
                                                                        echo '<option value="' . $row15["id"] . '">' . $row15["nama_bpp"] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form3">
                                                            <label>Wilayah Kerja 1</label>
                                                            <div class="input-group mb-3">
                                                                <select id="wil_kerja" name="wil_kerja" class="form-select" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form4">
                                                            <label>Wilayah Kerja 2</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja2" name="wil_kerja2" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form5">
                                                            <label>Wilayah Kerja 3</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja3" name="wil_kerja3" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form6">
                                                            <label>Wilayah Kerja 4</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja4" name="wil_kerja4" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form7">
                                                            <label>Wilayah Kerja 5</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja5" name="wil_kerja5" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form8">
                                                            <label>Wilayah Kerja 6</label>
                                                            <div class="input-group mb-3">
                                                                <select id="wil_kerja6" name="wil_kerja6" class="form-select" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form9">
                                                            <label>Wilayah Kerja 7</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja7" name="wil_kerja7" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form10">
                                                            <label>Wilayah Kerja 8</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja8" name="wil_kerja8" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form11">
                                                            <label>Wilayah Kerja 9</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja9" name="wil_kerja9" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="form12">
                                                            <label>Wilayah Kerja 10</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="wil_kerja10" name="wil_kerja10" aria-label="Default select example">
                                                                    <option value="">--Pilih Desa--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label>Tgl SK CPNS</label>
                                                        <div class="input-group mb-3 select-date2">
                                                            <input type="text" id="tgl_skcpns" name="tgl_skcpns" class="form-control" placeholder="Tgl SK Cpns">
                                                        </div>
                                                        <label>Tgl SK Penyuluh</label>
                                                        <div class="input-group mb-3 select-date3">
                                                            <input type="text" id="tglsk" name="tglsk" class="form-control" placeholder="Tgl SPMT">
                                                        </div>
                                                        <input type="hidden" name="tgl_sk_luh" class="form-control" placeholder="Tgl SPMT">
                                                        <input type="hidden" name="bln_sk_luh" class="form-control" placeholder="Tgl SPMT">
                                                        <input type="hidden" name="thn_sk_luh" class="form-control" placeholder="Tgl SPMT">
                                                        <label>Alamat Rumah</label>
                                                        <div class="input-group mb-3">
                                                            <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat Rumah"></textarea>
                                                        </div>
                                                        <label>Kabupaten</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="dati2" id="dati2" class="form-control" placeholder="Kabupaten" aria-label="Password" aria-describedby="password-addon">

                                                            <input type="text" name="kodepos" id="kodepos" class="form-control" placeholder="| Kode Pos" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Provinsi</label>
                                                        <div class="input-group mb-3">
                                                            <select name="kode_prop" id="kode_prop" class="form-control input-lg kode_prop">
                                                                <option value="">Pilih Provinsi</option>
                                                                <?php
                                                                foreach ($namaprop as $row) {
                                                                    echo '<option value="' . $row["id_prop"] . '">' . $row["nama_prop"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>No.Telepon rumah</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="telp" id="telp" class="form-control" placeholder="No.Telepon rumah" aria-label="Password" aria-describedby="password-addon">
                                                            <input type="number" name="hp" id="hp" class="form-control" placeholder="| HP" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Alamat Email</label>
                                                        <div class="input-group mb-3">
                                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                                        <!-- <center><button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Simpan Data</button></center> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-form-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Manajemen Status</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="<?= base_url('Penyuluh/PenyuluhCpns/updatestatus'); ?>">
                                                <? csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" name="id" id="idd" class="form-control id">

                                                        <label>NIP</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="nip" id="nipp" class="form-control nip" disabled>
                                                            <input type="text" name="nip_lama" id="nip_lamaa" class="form-control nip_lama" disabled>

                                                        </div>
                                                        <label>Nama Penyuluh</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="gelar_dpn" id="gelar_dpnn" class="form-control gelar_dpn" disabled>
                                                            <input type="text" name="nama" id="namaa" class="form-control nama" disabled>
                                                            <input type="text" name="gelar_blk" id="gelar_blkk" class="form-control gelar_blk" disabled>
                                                        </div>
                                                        <label>Per tanggal</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="tgl_status" name="tgl_status" class="form-control" placeholder="Tgl SK Cpns">
                                                        </div>
                                                    </div>
                                                    <label>Status</label>
                                                    <div class="input-group mb-3">
                                                        <select name="status" id="statuss" class="form-control input-lg status">
                                                            <option value="">Pilih Status</option>
                                                            <?php
                                                            foreach ($status as $row2) {
                                                                echo '<option value="' . $row2["kode"] . '">' . $row2["nama_status"] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label>Keterangan</label>
                                                    <div class="input-group mb-3">
                                                        <textarea class="form-control ket_status" name="ket_status" id="ket_status" placeholder="Keterangan"></textarea>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="btnSaveStatus" class="btn bg-gradient-info">Simpan Data</button>
                                                        <!-- <center><button type="button" id="btnSaveStatus" class="btn btn-round bg-gradient-warning btn-lg ajax-save">Simpan Data</button></center> -->
                                                    </div>
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

        </div>
    </div>

    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script>
        $(document).ready(function() {

            var input_id = 0;
            $('#tblcpns thead td').each( function () {
                var title = $(this).text();
                if(title != ''){
                    $(this).html( '<input id="input_search_'+input_id+'" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
                }
                input_id++;
            } );
            
			 $('#tblcpns').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'excel'
				],
                initComplete: function () {
                    // Apply the search
                    this.api().columns().every( function () {
                        var that = this;
        
                        $( '#input_search_' + this.index() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                }
			});

            $('#filter_prov').change(function() { // Jika Select Box id provinsi dipilih
			var provinsi = $(this).val(); // Ciptakan variabel provinsi
			$.ajax({
                async: false,
				type: 'POST', // Metode pengiriman data menggunakan POST
				url: '<?= base_url() ?>/Penyuluh/PenyuluhPns/getlistkab/' + provinsi, // File yang akan memproses data
				//data: 'provinsi=' + provinsi, // Data yang akan dikirim ke file pemroses
				success: function(response) { // Jika berhasil
                    response = JSON.parse(response)
                    var html = '<option value="">-- SEMUA --</option>';
                    for(var i=0;i<response.length;i++){
                        html = html + '<option value="'+response[i].id_kab+'">'+response[i].nama_kab+'</option>'
                    }
					$('#filter_kab').html(html); // Berikan hasil ke id kota
					
				    }
                });
            });

            <?php if ($getPostProv != ''){ ?>
                $('#filter_prov').val('<?php echo $getPostProv; ?>').change();
            <?php } ?>

            // if ($("#filter_prov").val() != '') {
            //     $("#filter_prov option:selected").html();
            // }

            $('#filter_kab').change(function() { // Jika Select Box id provinsi dipilih
                    var kabupaten = $(this).val(); // Ciptakan variabel provinsi
                    $.ajax({
                        async: false,
                        type: 'POST', // Metode pengiriman data menggunakan POST
                        url: '<?= base_url() ?>/Penyuluh/PenyuluhPns/getlistkec/' + kabupaten, // File yang akan memproses data
                        //data: 'kabupaten=' + kabupaten, // Data yang akan dikirim ke file pemroses
                        success: function(response) { // Jika berhasil
                            response = JSON.parse(response)
                            var html = '<option value="">-- SEMUA --</option>';
                            for(var i=0;i<response.length;i++){
                                html = html + '<option value="'+response[i].id_kec+'">'+response[i].nama_kec+'</option>'
                            }
                            $('#filter_kec').html(html); // Berikan hasil ke id kota
                            
                        }
                    });
                });

                
            //if ($("#filter_kab").val() != '') {
            <?php if ($getPostKab != ''){ ?>
                $('#filter_kab').val('<?php echo $getPostKab; ?>').change();
            <?php } ?>
                //}

                
                //if ($("#filter_kec").val() != '') {
                    $('#filter_kec').val('<?php echo $getPostKec; ?>');
                // //}   
                

            $(document).delegate('#btnSave', 'click', function() {

                tglsk = $('#tglsk').val();
                bln = tglsk.substr(0, 2);
                tgl = tglsk.substr(3, 2);
                thn = tglsk.substr(6, 4);

                tgl_lahir = $('#tgl_lahir').val();
                bln1 = tgl_lahir.substr(5, 2);
                tgl1 = tgl_lahir.substr(8, 2);
                thn1 = tgl_lahir.substr(0, 4);

                var nip = $('#nip').val();
                var nama = $('#nama').val();
                var gelar_dpn = $('#gelar_dpn').val();
                var gelar_blk = $('#gelar_blk').val();
                var tgl_lahir = $('#tgl_lahir').val();
                var tempat_lahir = $('#tempat_lahir').val();
                var jenis_kelamin = $(".jenis_kelamin:checked").val();
                var status_kel = $('#status_kel').val();
                var agama = $('#agama').val();
                var gol_darah = $('#gol_darah').val();
                var keahlian = $('#keahlian').val();
                var satminkal = $('#satminkal').val();
                var kode_kab = $(".rad:checked").val();
                var tgl_skcpns = $('#tgl_skcpns').val();
                var alamat = $('#alamat').val();
                var dati2 = $('#dati2').val();
                var kodepos = $('#kodepos').val();
                var kode_prop = $('#kode_prop').val();
                var telp = $('#telp').val();
                var hp = $('#hp').val();
                var email = $('#email').val();
                var status = $('#status').val();
                var batas_pensiun = $('#batas_pensiun').val();
                var tgl_pensiun = tgl1;
                var bulan_pensiun = bln1;
                var tahun_pensiun = thn1;
                var tgl_update = $('#tgl_update').val();
                var unit_kerja = $('#unit_kerja').val();
                var unit_kerja_kab = $('#unit_kerja_kab').val();
                var tempat_tugas = $('#tempat_tugas').val();
                var kecamatan_tugas = $('#kecamatan_tugas').val();
                var kecamatan_tugas1 = $('#kecamatan_tugas1').val();
                var kecamatan_tugas2 = $('#kecamatan_tugas2').val();
                var kecamatan_tugas3 = $('#kecamatan_tugas3').val();
                var kecamatan_tugas4 = $('#kecamatan_tugas4').val();
                var kecamatan_tugas5 = $('#kecamatan_tugas5').val();
                var kecamatan_tugas6 = $('#kecamatan_tugas6').val();
                var kecamatan_tugas7 = $('#kecamatan_tugas7').val();
                var kecamatan_tugas8 = $('#kecamatan_tugas8').val();
                var kecamatan_tugas9 = $('#kecamatan_tugas9').val();
                var kecamatan_tugas10 = $('#kecamatan_tugas10').val();
                var wil_kerja = $('#wil_kerja').val();
                var wil_kerja2 = $('#wil_kerja2').val();
                var wil_kerja3 = $('#wil_kerja3').val();
                var wil_kerja4 = $('#wil_kerja4').val();
                var wil_kerja5 = $('#wil_kerja5').val();
                var wil_kerja6 = $('#wil_kerja6').val();
                var wil_kerja7 = $('#wil_kerja7').val();
                var wil_kerja8 = $('#wil_kerja8').val();
                var wil_kerja9 = $('#wil_kerja9').val();
                var wil_kerja10 = $('#wil_kerja10').val();
                var tgl_sk_luh = tgl;
                var bln_sk_luh = bln;
                var thn_sk_luh = thn;
                var tingkat_pendidikan = $('#tingkat_pendidikan').val();
                var bidang_pendidikan = $('#bidang_pendidikan').val();
                var mapping = $('#mapping').val();
                var jurusan = $('#jurusan').val();
                var nama_sekolah = $('#nama_sekolah').val();
                var noktp = $('#noktp').val();

                if (nip.length == 0 || noktp.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "NIP/NIK tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (nip.length < 18 || nip.length > 18) {
                    Swal.fire({
                        title: 'Error',
                        text: "NIP harus 18 digit",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (noktp.length < 16 || noktp.length > 16) {
                    Swal.fire({
                        title: 'Error',
                        text: "NIK harus 16 digit",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (nama.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Nama tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (agama == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Agama tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
		if (tempat_lahir.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tempat Lahir tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                if (tgl_lahir == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tanggal Lahir tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if ($('input[name=jenis_kelamin]:checked').length <= 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Jenis Kelamin tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if ($('input[name=kode_kab]:checked').length <= 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Lokasi Kerja tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                $.ajax({
                    url: '<?= base_url('Penyuluh/PenyuluhCpns/save/'); ?>',
                    type: 'POST',
                    data: {
                        'nip': nip,
                        'nama': nama,
                        'gelar_dpn': gelar_dpn,
                        'gelar_blk': gelar_blk,
                        'tgl_lahir': tgl_lahir,
                        'tempat_lahir': tempat_lahir,
                        'jenis_kelamin': jenis_kelamin,
                        'status_kel': status_kel,
                        'agama': agama,
                        'gol_darah': gol_darah,
                        'keahlian': keahlian,
                        'satminkal': satminkal,
                        'kode_kab': kode_kab,
                        'tgl_skcpns': tgl_skcpns,
                        'alamat': alamat,
                        'dati2': dati2,
                        'kodepos': kodepos,
                        'kode_prop': kode_prop,
                        'telp': telp,
                        'hp': hp,
                        'email': email,
                        'status': status,
                        'batas_pensiun': batas_pensiun,
                        'tgl_pensiun': tgl_pensiun,
                        'bulan_pensiun': bulan_pensiun,
                        'tahun_pensiun': tahun_pensiun,
                        'tgl_update': tgl_update,
                        'unit_kerja': unit_kerja,
                        'unit_kerja_kab': unit_kerja_kab,
                        'tempat_tugas': tempat_tugas,
                        'kecamatan_tugas': kecamatan_tugas,
                        'kecamatan_tugas1': kecamatan_tugas1,
                        'kecamatan_tugas2': kecamatan_tugas2,
                        'kecamatan_tugas3': kecamatan_tugas3,
                        'kecamatan_tugas4': kecamatan_tugas4,
                        'kecamatan_tugas5': kecamatan_tugas5,
                        'kecamatan_tugas6': kecamatan_tugas6,
                        'kecamatan_tugas7': kecamatan_tugas7,
                        'kecamatan_tugas8': kecamatan_tugas8,
                        'kecamatan_tugas9': kecamatan_tugas9,
                        'kecamatan_tugas10': kecamatan_tugas10,
                        'wil_kerja': wil_kerja,
                        'wil_kerja2': wil_kerja2,
                        'wil_kerja3': wil_kerja3,
                        'wil_kerja4': wil_kerja4,
                        'wil_kerja5': wil_kerja5,
                        'wil_kerja6': wil_kerja6,
                        'wil_kerja7': wil_kerja7,
                        'wil_kerja8': wil_kerja8,
                        'wil_kerja9': wil_kerja9,
                        'wil_kerja10': wil_kerja10,
                        'tgl_sk_luh': tgl_sk_luh,
                        'bln_sk_luh': bln_sk_luh,
                        'thn_sk_luh': thn_sk_luh,
                        'tingkat_pendidikan': tingkat_pendidikan,
                        'bidang_pendidikan': bidang_pendidikan,
                        'mapping': mapping,
                        'jurusan': jurusan,
                        'nama_sekolah': nama_sekolah,
                        'noktp': noktp
                    },
                    success: function(result) {
                        Swal.fire({
                            title: 'Sukses',
                            text: "Sukses tambah data",
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

            $(document).delegate('#btnHapus', 'click', function() {
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
                            url: '<?= base_url() ?>/Penyuluh/PenyuluhCpns/delete/' + id,
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

            var wil_kerjaa = null;
            var wil_kerjaa2 = null;
            var wil_kerjaa3 = null;
            var wil_kerjaa4 = null;
            var wil_kerjaa5 = null;
            var wil_kerjaa6 = null;
            var wil_kerjaa7 = null;
            var wil_kerjaa8 = null;
            var wil_kerjaa9 = null;
            var wil_kerjaa10 = null;

            $(document).delegate('#btnEdit', 'click', function() {
                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PenyuluhCpns/edit/' + $(this).data('id'),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(result) {
                        // console.log(result);

                        $('#id').val(result.id);
                        $('#nip').val(result.nip);
                        $('#nama').val(result.nama);
                        $('#gelar_dpn').val(result.gelar_dpn);
                        $('#gelar_blk').val(result.gelar_blk);
                        $('#tgl_lahir').val(result.tgl_lahir);
                        $('#tempat_lahir').val(result.tempat_lahir);
                        if (result.jenis_kelamin == "1") {
                            $('#jenis_kelamin1').prop("checked", true);
                        } else {
                            $('#jenis_kelamin2').prop("checked", true);
                        }
                        $('#status_kel').val(result.status_kel);
                        $('#agama').val(result.agama);
                        $('#gol_darah').val(result.gol_darah);
                        $('#keahlian').val(result.keahlian);
                        $('#satminkal').val(result.satminkal);
                        if (result.kode_kab == "3") {
                            $('#kode_kab1').prop("checked", true).click();
                        } else {
                            $('#kode_kab2').prop("checked", true).click();
                        }
                        $('#tgl_skcpns').val(result.tgl_skcpns);
                        $('#alamat').val(result.alamat);
                        $('#dati2').val(result.dati2);
                        $('#kodepos').val(result.kodepos);
                        $('#kode_prop').val(result.kode_prop);
                        $('#telp').val(result.telp);
                        $('#hp').val(result.hp);
                        $('#email').val(result.email);
                        $('#status').val(result.status);
                        $('#batas_pensiun').val(result.batas_pensiun);
                        $('#tgl_pensiun').val(result.tgl_pensiun);
                        $('#bulan_pensiun').val(result.bulan_pensiun);
                        $('#tahun_pensiun').val(result.tahun_pensiun);
                        $('#tgl_update').val(result.tgl_update);
                        $('#unit_kerja').val(result.unit_kerja);
                        $('#unit_kerja_kab').val(result.unit_kerja_kab);
                        $('#tempat_tugas').val(result.tempat_tugas);
                        $('#kecamatan_tugas').val(result.kecamatan_tugas).change();
                        $('#kecamatan_tugas1').val(result.kecamatan_tugas1);
                        $('#kecamatan_tugas2').val(result.kecamatan_tugas2);
                        $('#kecamatan_tugas3').val(result.kecamatan_tugas3);
                        $('#kecamatan_tugas4').val(result.kecamatan_tugas4);
                        $('#kecamatan_tugas5').val(result.kecamatan_tugas5);
                        $('#kecamatan_tugas6').val(result.kecamatan_tugas6);
                        $('#kecamatan_tugas7').val(result.kecamatan_tugas7);
                        $('#kecamatan_tugas8').val(result.kecamatan_tugas8);
                        $('#kecamatan_tugas9').val(result.kecamatan_tugas9);
                        $('#kecamatan_tugas10').val(result.kecamatan_tugas10);
                        wil_kerjaa = result.wil_kerja;
                        wil_kerjaa2 = result.wil_kerja2;
                        wil_kerjaa3 = result.wil_kerja3;
                        wil_kerjaa4 = result.wil_kerja4;
                        wil_kerjaa5 = result.wil_kerja5;
                        wil_kerjaa6 = result.wil_kerja6;
                        wil_kerjaa7 = result.wil_kerja7;
                        wil_kerjaa8 = result.wil_kerja8;
                        wil_kerjaa9 = result.wil_kerja9;
                        wil_kerjaa10 = result.wil_kerja10;
                        $('#tglsk').val(result.tgl_sk_luh + '/' + result.bln_sk_luh + '/' + result.thn_sk_luh);
                        $('#tingkat_pendidikan').val(result.tingkat_pendidikan);
                        $('#bidang_pendidikan').val(result.bidang_pendidikan);
                        $('#mapping').val(result.mapping);
                        $('#jurusan').val(result.jurusan);
                        $('#nama_sekolah').val(result.nama_sekolah);
                        $('#noktp').val(result.noktp);

                        $('#modal-form').modal('show');

                        $("#btnSave").attr("id", "btnDoEdit");

                        $(document).delegate('#btnDoEdit', 'click', function() {

                            tglsk = $('#tglsk').val();
                            bln = tglsk.substr(0, 2);
                            tgl = tglsk.substr(3, 2);
                            thn = tglsk.substr(6, 4);

                            tgl_lahir = $('#tgl_lahir').val();
                            bln1 = tgl_lahir.substr(5, 2);
                            tgl1 = tgl_lahir.substr(8, 2);
                            thn1 = tgl_lahir.substr(0, 4);

                            var id = $('#id').val();
                            var nip = $('#nip').val();
                            var nama = $('#nama').val();
                            var gelar_dpn = $('#gelar_dpn').val();
                            var gelar_blk = $('#gelar_blk').val();
                            var tgl_lahir = $('#tgl_lahir').val();
                            var tempat_lahir = $('#tempat_lahir').val();
                            var jenis_kelamin = $(".jenis_kelamin:checked").val();
                            var status_kel = $('#status_kel').val();
                            var agama = $('#agama').val();
                            var gol_darah = $('#gol_darah').val();
                            var keahlian = $('#keahlian').val();
                            var satminkal = $('#satminkal').val();
                            var kode_kab = $(".rad:checked").val();
                            var tgl_skcpns = $('#tgl_skcpns').val();
                            var alamat = $('#alamat').val();
                            var dati2 = $('#dati2').val();
                            var kodepos = $('#kodepos').val();
                            var kode_prop = $('#kode_prop').val();
                            var telp = $('#telp').val();
                            var hp = $('#hp').val();
                            var email = $('#email').val();
                            var status = $('#status').val();
                            var batas_pensiun = $('#batas_pensiun').val();
                            var tgl_pensiun = tgl1;
                            var bulan_pensiun = bln1;
                            var tahun_pensiun = thn1;
                            var tgl_update = $('#tgl_update').val();
                            var unit_kerja = $('#unit_kerja').val();
                            var unit_kerja_kab = $('#unit_kerja_kab').val();
                            var tempat_tugas = $('#tempat_tugas').val();
                            var kecamatan_tugas = $('#kecamatan_tugas').val();
                            var kecamatan_tugas1 = $('#kecamatan_tugas1').val();
                            var kecamatan_tugas2 = $('#kecamatan_tugas2').val();
                            var kecamatan_tugas3 = $('#kecamatan_tugas3').val();
                            var kecamatan_tugas4 = $('#kecamatan_tugas4').val();
                            var kecamatan_tugas5 = $('#kecamatan_tugas5').val();
                            var kecamatan_tugas6 = $('#kecamatan_tugas6').val();
                            var kecamatan_tugas7 = $('#kecamatan_tugas7').val();
                            var kecamatan_tugas8 = $('#kecamatan_tugas8').val();
                            var kecamatan_tugas9 = $('#kecamatan_tugas9').val();
                            var kecamatan_tugas10 = $('#kecamatan_tugas10').val();
                            var wil_kerja = $('#wil_kerja').val();
                            var wil_kerja2 = $('#wil_kerja2').val();
                            var wil_kerja3 = $('#wil_kerja3').val();
                            var wil_kerja4 = $('#wil_kerja4').val();
                            var wil_kerja5 = $('#wil_kerja5').val();
                            var wil_kerja6 = $('#wil_kerja6').val();
                            var wil_kerja7 = $('#wil_kerja7').val();
                            var wil_kerja8 = $('#wil_kerja8').val();
                            var wil_kerja9 = $('#wil_kerja9').val();
                            var wil_kerja10 = $('#wil_kerja10').val();
                            var tgl_sk_luh = tgl;
                            var bln_sk_luh = bln;
                            var thn_sk_luh = thn
                            var tingkat_pendidikan = $('#tingkat_pendidikan').val();
                            var bidang_pendidikan = $('#bidang_pendidikan').val();
                            var mapping = $('#mapping').val();
                            var jurusan = $('#jurusan').val();
                            var nama_sekolah = $('#nama_sekolah').val();
                            var noktp = $('#noktp').val();

if (nip.length == 0 || noktp.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "NIP/NIK tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (nip.length < 18 || nip.length > 18) {
                    Swal.fire({
                        title: 'Error',
                        text: "NIP harus 18 digit",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (noktp.length < 16 || noktp.length > 16) {
                    Swal.fire({
                        title: 'Error',
                        text: "NIK harus 16 digit",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (nama.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Nama tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (agama == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Agama tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (tempat_lahir.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tempat Lahir tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                if (tgl_lahir == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tanggal Lahir tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if ($('input[name=jenis_kelamin]:checked').length <= 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Jenis Kelamin tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if ($('input[name=kode_kab]:checked').length <= 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Lokasi Kerja tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nip', nip);
                            formData.append('nama', nama);
                            formData.append('gelar_dpn', gelar_dpn);
                            formData.append('gelar_blk', gelar_blk);
                            formData.append('tgl_lahir', tgl_lahir);
                            formData.append('tempat_lahir', tempat_lahir);
                            formData.append('jenis_kelamin', jenis_kelamin);
                            formData.append('status_kel', status_kel);
                            formData.append('agama', agama);
                            formData.append('gol_darah', gol_darah);
                            formData.append('keahlian', keahlian);
                            formData.append('satminkal', satminkal);
                            formData.append('kode_kab', kode_kab);
                            formData.append('tgl_skcpns', tgl_skcpns);
                            formData.append('alamat', alamat);
                            formData.append('dati2', dati2);
                            formData.append('kodepos', kodepos);
                            formData.append('kode_prop', kode_prop);
                            formData.append('telp', telp);
                            formData.append('hp', hp);
                            formData.append('email', email);
                            formData.append('status', status);
                            formData.append('batas_pensiun', batas_pensiun);
                            formData.append('tgl_pensiun', tgl_pensiun);
                            formData.append('bulan_pensiun', bulan_pensiun);
                            formData.append('tahun_pensiun', tahun_pensiun);
                            formData.append('tgl_update', tgl_update);
                            formData.append('unit_kerja', unit_kerja);
                            formData.append('unit_kerja_kab', unit_kerja_kab);
                            formData.append('tempat_tugas', tempat_tugas);
                            formData.append('kecamatan_tugas', kecamatan_tugas);
                            formData.append('kecamatan_tugas1', kecamatan_tugas1);
                            formData.append('kecamatan_tugas2', kecamatan_tugas2);
                            formData.append('kecamatan_tugas3', kecamatan_tugas3);
                            formData.append('kecamatan_tugas4', kecamatan_tugas4);
                            formData.append('kecamatan_tugas5', kecamatan_tugas5);
                            formData.append('kecamatan_tugas6', kecamatan_tugas6);
                            formData.append('kecamatan_tugas7', kecamatan_tugas7);
                            formData.append('kecamatan_tugas8', kecamatan_tugas8);
                            formData.append('kecamatan_tugas9', kecamatan_tugas9);
                            formData.append('kecamatan_tugas10', kecamatan_tugas10);
                            formData.append('wil_kerja', wil_kerja);
                            formData.append('wil_kerja2', wil_kerja2);
                            formData.append('wil_kerja3', wil_kerja3);
                            formData.append('wil_kerja4', wil_kerja4);
                            formData.append('wil_kerja5', wil_kerja5);
                            formData.append('wil_kerja6', wil_kerja6);
                            formData.append('wil_kerja7', wil_kerja7);
                            formData.append('wil_kerja8', wil_kerja8);
                            formData.append('wil_kerja9', wil_kerja9);
                            formData.append('wil_kerja10', wil_kerja10);
                            formData.append('tgl_sk_luh', tgl_sk_luh);
                            formData.append('bln_sk_luh', bln_sk_luh);
                            formData.append('thn_sk_luh', thn_sk_luh);
                            formData.append('tingkat_pendidikan', tingkat_pendidikan);
                            formData.append('bidang_pendidikan', bidang_pendidikan);
                            formData.append('mapping', mapping);
                            formData.append('jurusan', jurusan);
                            formData.append('nama_sekolah', nama_sekolah);
                            formData.append('noktp', noktp);


                            $.ajax({
                                url: '<?= base_url() ?>/Penyuluh/PenyuluhCpns/update/' + id,
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

            $('.tempat_tugas').on('change', function() {

                const id = $('.tempat_tugas').val();
                var kdtempat_tugas = id.substring(0, 6);

                $.ajax({
                    url: "<?= base_url() ?>/Penyuluh/PenyuluhCpns/showDesa/" + kdtempat_tugas + "",
                    success: function(response) {
                        var htmla = '<option value="">Pilih Desa</option>';
                        if (response == '') {
                            $("select#wil_kerja").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja2").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja3").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja4").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja5").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja6").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja7").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja8").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja9").html('<option value="">--Pilih Desa--</option>');
                            $("select#wil_kerja10").html('<option value="">--Pilih Desa--</option>');
                        } else {
                            $("select#wil_kerja").html(htmla += response);
                            $("select#wil_kerja2").html(htmla += response);
                            $("select#wil_kerja3").html(htmla += response);
                            $("select#wil_kerja4").html(htmla += response);
                            $("select#wil_kerja5").html(htmla += response);
                            $("select#wil_kerja6").html(htmla += response);
                            $("select#wil_kerja7").html(htmla += response);
                            $("select#wil_kerja8").html(htmla += response);
                            $("select#wil_kerja9").html(htmla += response);
                            $("select#wil_kerja10").html(htmla += response);

                            $('#wil_kerja').val(wil_kerjaa);
                            $('#wil_kerja2').val(wil_kerjaa2);
                            $('#wil_kerja3').val(wil_kerjaa3);
                            $('#wil_kerja4').val(wil_kerjaa4);
                            $('#wil_kerja5').val(wil_kerjaa5);
                            $('#wil_kerja6').val(wil_kerjaa6);
                            $('#wil_kerja7').val(wil_kerjaa7);
                            $('#wil_kerja8').val(wil_kerjaa8);
                            $('#wil_kerja9').val(wil_kerjaa9);
                            $('#wil_kerja10').val(wil_kerjaa10);
                        }
                    },
                    dataType: "html"
                });
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {


            $(document).delegate('#btnEditStatus', 'click', function() {
                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PenyuluhCpns/editstatus/' + $(this).data('id'),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(result) {
                        // console.log(result);

                        $('#idd').val(result.id);
                        $('#nip_lamaa').val(result.nip_lama);
                        $('#nipp').val(result.nip);
                        $('#namaa').val(result.nama);
                        $('#gelar_dpnn').val(result.gelar_dpn);
                        $('#gelar_blkk').val(result.gelar_blk);
                        $('#statuss').val(result.status);
                        $('#tgl_status').val(result.tgl_status);
                        $('#ket_status').val(result.ket_status);


                        $('#modal-form-edit').modal('show');

                        $("#btnSaveStatus").attr("id", "btnDoEditStatus");

                        $(document).delegate('#btnDoEditStatus', 'click', function() {

                            var id = $('#idd').val();
                            var nip_lama = $('#nip_lamaa').val();
                            var nip = $('#nipp').val();
                            var nama = $('#namaa').val();
                            var gelar_dpn = $('#gelar_dpnn').val();
                            var gelar_blk = $('#gelar_blkk').val();
                            var status = $('#statuss').val();
                            var tgl_status = $('#tgl_status').val();
                            var ket_status = $('#ket_status').val();

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nip_lama', nip_lama);
                            formData.append('nip', nip);
                            formData.append('nama', nama);
                            formData.append('gelar_dpn', gelar_dpn);
                            formData.append('gelar_blk', gelar_blk);
                            formData.append('status', status);
                            formData.append('tgl_status', tgl_status);
                            formData.append('ket_status', ket_status);



                            $.ajax({
                                url: '<?= base_url() ?>/Penyuluh/PenyuluhCpns/updatestatus/' + id,
                                type: "POST",
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    $('#modal-form-edit').modal('hide');
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
        });
    </script>

    <script>
        $(document).ready(function() {
            const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let qntYears = 80;
            let selectYear = $("#year4");
            let selectMonth = $("#month4");
            let selectDay = $("#day4");
            let currentYear = new Date().getFullYear();

            for (var y = 0; y < qntYears; y++) {
                let date = new Date(currentYear);
                let yearElem = document.createElement("option");
                yearElem.value = currentYear
                yearElem.textContent = currentYear;
                selectYear.append(yearElem);
                currentYear--;
            }

            for (var m = 1; m <= 12; m++) {
                let month = monthNames[m];
                let monthElem = document.createElement("option");
                monthElem.value = m;
                monthElem.textContent = month;
                selectMonth.append(monthElem);
            }

            var d = new Date();
            var month = d.getMonth();
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays() {
                var year = selectYear.val();
                var month = parseInt(selectMonth.val()) + 1;
                selectDay.empty();

                //get the last day, so the number of days in that month
                var days = new Date(year, month, 0).getDate();

                //lets create the days of that month
                for (var d = 1; d <= days; d++) {
                    var dayElem = document.createElement("option");
                    dayElem.value = d;
                    dayElem.textContent = d;
                    selectDay.append(dayElem);
                }
            }
        });
    </script>

    <script>
        var d = new Date();

        // Set the value of the "date" field
        document.getElementById("tgl_update").value = d.toLocaleString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        }).split(' ').join(' ');
    </script>

    <script>
        $(function() {
            $("#form1").hide();
            $("#form2").hide();
            $("#form3").hide();
            $("#form4").hide();
            $("#form5").hide();
            $("#form6").hide();
            $("#form7").hide();
            $("#form8").hide();
            $("#form9").hide();
            $("#form10").hide();
            $("#form11").hide();
            $("#form12").hide();
            $("#form13").hide();
            $("#form14").hide();
            $("#form15").hide();
            $("#form16").hide();
            $("#form17").hide();
            $("#form18").hide();
            $("#form19").hide();
            $("#form20").hide();
            $("#form21").hide();
            $("#form22").hide();
            $(":radio.rad").click(function() {
                $("#form1, #form2, #form3").hide()
                if ($(this).val() == "4") {
                    $("#form1").show();
                    $("#form2").show();
                    $("#form3").show();
                    $("#form4").show();
                    $("#form5").show();
                    $("#form6").show();
                    $("#form7").show();
                    $("#form8").show();
                    $("#form9").show();
                    $("#form10").show();
                    $("#form11").show();
                    $("#form12").show();
                    $("#form13").hide();
                    $("#form14").hide();
                    $("#form15").hide();
                    $("#form16").hide();
                    $("#form17").hide();
                    $("#form18").hide();
                    $("#form19").hide();
                    $("#form20").hide();
                    $("#form21").hide();
                    $("#form22").hide();
                } else {
                    $("#form1").hide();
                    $("#form2").hide();
                    $("#form3").hide();
                    $("#form4").hide();
                    $("#form5").hide();
                    $("#form6").hide();
                    $("#form7").hide();
                    $("#form8").hide();
                    $("#form9").hide();
                    $("#form10").hide();
                    $("#form11").hide();
                    $("#form12").hide();
                    $("#form13").show();
                    $("#form14").show();
                    $("#form15").show();
                    $("#form16").show();
                    $("#form17").show();
                    $("#form18").show();
                    $("#form19").show();
                    $("#form20").show();
                    $("#form21").show();
                    $("#form22").show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                $('input[name="tgl_status"]').daterangepicker({
                    formatDate: 'dd-mm-YYYY',
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'), 10)
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
                today = new Date(),
                // default targetDate is christmas
                targetDate = new Date(today.getFullYear(), 11, 2);

            setDate(targetDate);
            setYears(100) // set the next five years in dropdown

            $("#select-month").change(function() {
                var monthIndex = $("#select-month").val();
                setDays(monthIndex);
            });

            function setDate(date) {
                setDays(date.getMonth());
                $("#select-day").val(date.getDate());
                $("#select-month").val(date.getMonth());
                $("#select-year").val(date.getFullYear());
            }

            // make sure the number of days correspond with the selected month
            function setDays(monthIndex) {
                var optionCount = $('#select-day option').length,
                    daysCount = daysInMonth[monthIndex];

                if (optionCount < daysCount) {
                    for (var i = optionCount; i < daysCount; i++) {
                        $('#select-day')
                            .append($("<option></option>")
                                .attr("value", i + 1)
                                .text(i + 1));
                    }
                } else {
                    for (var i = daysCount; i < optionCount; i++) {
                        var optionItem = '#select-day option[value=' + (i + 1) + ']';
                        $(optionItem).remove();
                    }
                }
            }

            function setYears(val) {
                var year = today.getFullYear();
                for (var i = 0; i < val; i++) {
                    $('#select-year')
                        .append($("<option></option>")
                            .attr("value", year - i)
                            .text(year - i));
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
                today = new Date(),
                // default targetDate is christmas
                targetDate = new Date(today.getFullYear(), 11, 2);

            setDate(targetDate);
            setYears(100) // set the next five years in dropdown

            $("#select-month2").change(function() {
                var monthIndex = $("#select-month2").val();
                setDays(monthIndex);
            });

            function setDate(date) {
                setDays(date.getMonth());
                $("#select-day2").val(date.getDate());
                $("#select-month2").val(date.getMonth());
                $("#select-year2").val(date.getFullYear());
            }

            // make sure the number of days correspond with the selected month
            function setDays(monthIndex) {
                var optionCount = $('#select-day2 option').length,
                    daysCount = daysInMonth[monthIndex];

                if (optionCount < daysCount) {
                    for (var i = optionCount; i < daysCount; i++) {
                        $('#select-day2')
                            .append($("<option></option>")
                                .attr("value", i + 1)
                                .text(i + 1));
                    }
                } else {
                    for (var i = daysCount; i < optionCount; i++) {
                        var optionItem = '#select-day2 option[value=' + (i + 1) + ']';
                        $(optionItem).remove();
                    }
                }
            }

            function setYears(val) {
                var year = today.getFullYear();
                for (var i = 0; i < val; i++) {
                    $('#select-year2')
                        .append($("<option></option>")
                            .attr("value", year - i)
                            .text(year - i));
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                $('input[name="tgl_skcpns"]').daterangepicker({
                    formatDate: 'dd-mm-YYYY',
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'), 10)
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                $('input[name="tglsk"]').daterangepicker({
                    formatDate: 'dd-mm-YYYY',
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'), 10)
                });
            });

        });
    </script>

    <!-- <script>
        $(document).ready(function() {
            $(function() {
                $('input[name="tgl_lahir"]').daterangepicker({
                    formatDate: 'YYYY-mm-dd',
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'), 10)
                });
            });

        });
    </script> -->

    <script>
        $(document).ready(function() {
            var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
                today = new Date(),
                // default targetDate is christmas
                targetDate = new Date(today.getFullYear(), 11, 2);

            setDate(targetDate);
            setYears(100) // set the next five years in dropdown

            $("#select-month3").change(function() {
                var monthIndex = $("#select-month3").val();
                setDays(monthIndex);
            });

            function setDate(date) {
                setDays(date.getMonth());
                $("#select-day3").val(date.getDate());
                $("#select-month3").val(date.getMonth());
                $("#select-year3").val(date.getFullYear());
            }

            // make sure the number of days correspond with the selected month
            function setDays(monthIndex) {
                var optionCount = $('#select-day3 option').length,
                    daysCount = daysInMonth[monthIndex];

                if (optionCount < daysCount) {
                    for (var i = optionCount; i < daysCount; i++) {
                        $('#select-day3')
                            .append($("<option></option>")
                                .attr("value", i + 1)
                                .text(i + 1));
                    }
                } else {
                    for (var i = daysCount; i < optionCount; i++) {
                        var optionItem = '#select-day3 option[value=' + (i + 1) + ']';
                        $(optionItem).remove();
                    }
                }
            }

            function setYears(val) {
                var year = today.getFullYear();
                for (var i = 0; i < val; i++) {
                    $('#select-year3')
                        .append($("<option></option>")
                            .attr("value", year - i)
                            .text(year - i));
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let qntYears = 80;
            let selectYear = $("#year");
            let selectMonth = $("#month");
            let selectDay = $("#day");
            let currentYear = new Date().getFullYear();

            for (var y = 0; y < qntYears; y++) {
                let date = new Date(currentYear);
                let yearElem = document.createElement("option");
                yearElem.value = currentYear
                yearElem.textContent = currentYear;
                selectYear.append(yearElem);
                currentYear--;
            }

            selectMonth.html("");

            for (var m = 1; m <= 12; m++) {
                let month = monthNames[m];
                let monthElem = document.createElement("option");
                monthElem.value = m;
                monthElem.textContent = month;
                selectMonth.append(monthElem);
            }

            var d = new Date();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays() {
                var year = selectYear.val();
                var month = parseInt(selectMonth.val());
                selectDay.empty();

                //get the last day, so the number of days in that month
                var days = new Date(year, month, 0).getDate();

                //lets create the days of that month
                for (var d = 1; d <= days; d++) {
                    var dayElem = document.createElement("option");
                    dayElem.value = d;
                    dayElem.textContent = d;
                    selectDay.append(dayElem);
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let qntYears = 80;
            let selectYear = $("#year2");
            let selectMonth = $("#month2");
            let selectDay = $("#day2");
            let currentYear = new Date().getFullYear();

            for (var y = 0; y < qntYears; y++) {
                let date = new Date(currentYear);
                let yearElem = document.createElement("option");
                yearElem.value = currentYear
                yearElem.textContent = currentYear;
                selectYear.append(yearElem);
                currentYear--;
            }

            selectMonth.html("");

            for (var m = 1; m <= 12; m++) {
                let month = monthNames[m];
                let monthElem = document.createElement("option");
                monthElem.value = m;
                monthElem.textContent = month;
                selectMonth.append(monthElem);
            }

            var d = new Date();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays() {
                var year = selectYear.val();
                var month = parseInt(selectMonth.val());
                selectDay.empty();

                //get the last day, so the number of days in that month
                var days = new Date(year, month, 0).getDate();

                //lets create the days of that month
                for (var d = 1; d <= days; d++) {
                    var dayElem = document.createElement("option");
                    dayElem.value = d;
                    dayElem.textContent = d;
                    selectDay.append(dayElem);
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let qntYears = 80;
            let selectYear = $("#year3");
            let selectMonth = $("#month3");
            let selectDay = $("#day3");
            let currentYear = new Date().getFullYear();

            for (var y = 0; y < qntYears; y++) {
                let date = new Date(currentYear);
                let yearElem = document.createElement("option");
                yearElem.value = currentYear
                yearElem.textContent = currentYear;
                selectYear.append(yearElem);
                currentYear--;
            }

            selectMonth.html("");

            for (var m = 1; m <= 12; m++) {
                let month = monthNames[m];
                let monthElem = document.createElement("option");
                monthElem.value = m;
                monthElem.textContent = month;
                selectMonth.append(monthElem);
            }

            var d = new Date();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            var day = d.getDate();

            selectYear.val(year);
            selectYear.on("change", AdjustDays);
            selectMonth.val(month);
            selectMonth.on("change", AdjustDays);

            AdjustDays();
            selectDay.val(day)

            function AdjustDays() {
                var year = selectYear.val();
                var month = parseInt(selectMonth.val());
                selectDay.empty();

                //get the last day, so the number of days in that month
                var days = new Date(year, month, 0).getDate();

                //lets create the days of that month
                for (var d = 1; d <= days; d++) {
                    var dayElem = document.createElement("option");
                    dayElem.value = d;
                    dayElem.textContent = d;
                    selectDay.append(dayElem);
                }
            }
        });
    </script>
    <?= $this->endSection() ?>