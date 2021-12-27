<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
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
?>

<center>
    <h5> Daftar Kelembagaan Penyuluhan Pertanian Tingkat Kecamatan <br>Kab <?= ucwords(strtolower($nama_kabupaten)) ?> </h5>
</center>
<a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn-kec bg-gradient-primary">+ Tambah Data</button></a>
<div class="card">
    <?php
    if ($validation->hasError('foto')) {

    ?>
        <div class="alert alert-danger" role="alert">
            <?= $validation->listErrors(); ?>
        </div>

    <?php } ?>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="180" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Lembaga</td>
                    <td width="180" class="text-uppercase text-secondary text-xxs font-weight-bolder">Alamat</td>
                    <td width="300" class="text-uppercase text-secondary text-xxs font-weight-bolder">Wilayah<br>(Kecamatan)</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama<br>Pimpinan</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Penyuluh<br>PNS</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Penyuluh<br>THL</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Penyuluh<br>Swadaya</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Poktan</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Gapoktan</td>
                    <td width="150" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>KEP</td>
                    <td width="190" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Update<br>Terakhir</td>
                    <td width="160" class="text-secondary opacity-7"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($tabel_data as $row) {
                ?>

                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td>
                            <a href="<?= base_url('/detail_kecamatan?kode_kec=' . $row['id_daerah'] . '&kodebpp=' . $row['id'] . '&kode_bp3k=' . $row['kode_bp3k']) ?>">
                                <p class="text-xs font-weight-bold mb-0"><?= $row['nama_bpp'] ?></p>
                            </a>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0"><?= $row['alamat'] ?></p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">- <?= $row['deskripsi'] ?> .</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0"><?= $row['ketua'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jumpns'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jumthl'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jumswa'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jumpok'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jumgap'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jumkep'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_update'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/detail_kecamatan?kode_kec=' . $row['id_daerah'] . '&kodebpp=' . $row['id'] . '&kode_bp3k=' . $row['kode_bp3k']) ?>">
                                <button type="button" id="btn-edit" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                            </a>
                            <a href="<?= base_url('KelembagaanPenyuluhan/Kecamatan/Kecamatan/delete/' . $row['id']) ?>" onclick="return confirm('apakah anda ingin menghapus data ini?')">
                                <button type="button" class="btn bg-gradient-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </a>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>

                <!-- Modal form -->
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left" action="<?= base_url('KelembagaanPenyuluhan/Kecamatan/Kecamatan/save'); ?>" method="post" enctype="multipart/form-data">
                                            <? csrf_field(); ?>
                                            <div class=" row">
                                                <div class="col">
                                                    <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                                    <input type="hidden" name="satminkal" id="satminkal" value="<?= $kode_kab; ?>">
                                                    <input type="hidden" name="urut" id="urut" value="<?= $urut; ?>">
                                                    <input type="hidden" name="kode_bp3k" id="kode_bp3k" value="<?= $kode . $urut; ?>">

                                                    <label>Bentuk Kelembagaan</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" name="bentuk_lembaga" id="bentuk_lembaga" required>
                                                            <option value="">Pilih Bentuk Kelembagaan</option>
                                                            <option value="20">Balai Penyuluhan Pertanian</option>
                                                            <option value="40">UPTD</option>
                                                        </select>
                                                    </div>
                                                    <label>Nama Kelembagaan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama Kelembagaan" name="nama_bpp" id="nama_bpp" aria-label="Nama" aria-describedby="nama-addon" required>
                                                    </div>
                                                    <label>Alamat Kantor</label>
                                                    <div class="input-group mb-3">
                                                        <textarea class="form-control" placeholder="Alamat Kantor" id="alamat" name="alamat" required></textarea>
                                                    </div>
                                                    <label>Kecamatan (lokasi BPP)</label>
                                                    <div class="input-group mb-3">
                                                        <select name="kecamatan" id="kecamatan" class="form-select" required>
                                                            <option value="">Pilih Kecamatan</option>
                                                            <?php
                                                            foreach ($kec as $row) {
                                                                echo '<option value="' . $row["id_daerah"] . '">' . 'Kec. ' . $row["deskripsi"] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label for="ketua">Tanggal Pembentukan</label>
                                                    <div class="input-group mb-3">
                                                        <select id="day" name="tgl_berdiri" class="form-select tgl_berdiri" aria-label="Default select example" required>
                                                            <option value=""></option>
                                                        </select>
                                                        <select id="month" name="bln_berdiri" class="form-select bln_berdiri" aria-label="Default select example" required>
                                                            <option value=""></option>
                                                        </select>
                                                        <select id="year" name="thn_berdiri" class="form-select thn_berdiri" aria-label="Default select example" required>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <label>Status Gedung</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" name="status_gedung" id="status_gedung" aria-label="Default select example">
                                                            <option value="">Pilih Status</option>
                                                            <option value="milik sendiri">Milik sendiri</option>
                                                            <option value="sewa/pinjam">Sewa/Pinjam</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label>kondisi Bangunan</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" name="kondisi_bangunan" id="kondisi_bangunan" aria-label="Default select example">
                                                            <option value="">Pilih Kondisi</option>
                                                            <option value="baik">Baik</option>
                                                            <option value="rusak">Rusak</option>
                                                        </select>
                                                    </div>
                                                    <label>Koordinat BPP</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Koordinat BPP" name="koordinat_lokasi_bpp" id="koordinat_lokasi_bpp" aria-label="gps" aria-describedby="nama-addon" required>
                                                    </div>
                                                    <label>No.Telepon/Fax</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="No. Telepon" name="telp_bpp" id="telp_bpp" onkeypress="return Angka(event)" required>
                                                    </div>
                                                    <label>Alamat Email</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Email" name="email" id="email" required>
                                                    </div>
                                                    <label>Alamat Website/Blog</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Website" name="website" id="website" value="http://">
                                                    </div>
                                                    <label>Nama Pimpinan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama" name="ketua" id="ketua" required>
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">No. HP</label>&nbsp; &nbsp;
                                                        <input type="text" class="form-control" name="telp_hp" id="telp_hp" placeholder="No. HP" onkeypress="return Angka(event)" required>
                                                    </div>
                                                    <label>Koordinator Penyuluh</label>
                                                    <div class="input-group mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio1" value="1" required>
                                                            <label class="form-check-label" for="inlineRadio1">PNS</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio2" value="2" required>
                                                            <label class="form-check-label" for="inlineRadio2">THL</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input pen" type="radio" name="kode_koord_penyuluh" id="inlineRadio3" value="3" required>
                                                            <label class="form-check-label" for="inlineRadio2">Struktural</label>
                                                        </div><br>
                                                    </div>
                                                    <div class="input-group mb-3" id="divPNS">
                                                        <label style="margin-top: 10px;">PNS:</label>
                                                        <select name="nama_koord_penyuluh" id="nama_koord_penyuluh" class="form-control input-lg" style="margin-left: 15px;">
                                                            <option value="">-</option>
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
                                                            <option value="">-</option>
                                                            <?php
                                                            foreach ($penyuluhTHL as $row2) {
                                                                echo '<option value="' . $row2["noktp"] . '">' . $row2["noktp"] . ' - ' . $row2["nama"] . '</option>';
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
                                                    <h5>Sarana & Prasarana</h5>
                                                    <label>Kendaraan Roda 4</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="roda_4_apbn" id="roda_4_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="roda_4_apbd" id="roda_4_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Kendaraan Roda 2</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="roda_2_apbn" id="roda_2_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="roda_2_apbd" id="roda_2_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Alat Pengolah Data (PC)</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="pc_apbn" id="pc_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="pc_apbd" id="pc_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Alat Pengolah Data (Laptop)</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="laptop_apbn" id="laptop_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="laptop_apbd" id="laptop_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Alat Pengolah Data (Printer)</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="printer_apbn" id="printer_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="printer_apbd" id="printer_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Alat Pengolah Data (Modem)</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="modem_apbn" id="modem_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="modem_apbd" id="modem_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>LCD Proyektor</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="lcd_apbn" id="lcd_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="lcd_apbd" id="lcd_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Soil Tester</label>
                                                    <div class="input-group mb-3">
                                                        <label style="margin-top: 10px;">APBN</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="soil_apbn" id="soil_apbn" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                        <label style="margin-top: 10px;">APBD</label>
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="soil_apbd" id="soil_apbd" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h5>Potensi Ekonomi</h5>
                                                    <label>Kios saprotan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="kios_saprotan" id="kios_saprotan" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Pedagang pengepul</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="pedagang_pengepul" id="pedagang_pengepul" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Gudang pangan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="gudang_pangan" id="gudang_pangan" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Perbankan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="perbankan" id="perbankan" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Industri Pertanian</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="industri_penyuluhan" id="industri_penyuluhan" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Unit</label>&nbsp; &nbsp;
                                                    </div>
                                                    <h5>Lahan Percontohan</h5>
                                                    <label>Di BPP</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="luas_lahan_bp3k" id="luas_lahan_bp3k" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Ha</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Di Petani</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style="margin-left: 10px;" class="form-control" name="luas_lahan_petani" id="luas_lahan_petani" placeholder="" aria-label="gps" aria-describedby="nama-addon" onkeypress="return Angka(event)">
                                                        &nbsp; &nbsp;<label style="margin-top: 10px;">Ha</label>&nbsp; &nbsp;
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" id="btnSave" class="btn bg-gradient-primary">Simpan Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal lahancth-->
                <div class="modal fade" id="modal-lahancth" tabindex="-1" role="dialog" aria-labelledby="modal-lahancth" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-l" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left">
                                            <div class="row">
                                                <div class="col">

                                                    <label>Di BPP</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama Kelembagaan" aria-label="Nama" aria-describedby="nama-addon">
                                                        &nbsp; &nbsp;<label>Ha</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Di Petani</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama Kelembagaan" aria-label="Nama" aria-describedby="nama-addon">
                                                        &nbsp; &nbsp;<label>Ha</label>&nbsp; &nbsp;
                                                    </div>
                                                    <label>Penghargaan yang pernah diterima</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama Kelembagaan" aria-label="Nama" aria-describedby="nama-addon">
                                                    </div>
                                                    <label> Dana Alokasi Khusus (DAK)</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama Kelembagaan" aria-label="Nama" aria-describedby="nama-addon">
                                                    </div>

                                                    <div class="text-center">
                                                        <center><button type="button" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Simpan Data</button></center>
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
</tbody>
</table>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(function() {
        $('input[name="tglpembentukan"]').daterangepicker({
            format: 'dd/MM/YYYY',
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1950
        });
    });
</script>
<script>
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
</script>

<?= $this->endSection() ?>