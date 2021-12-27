<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<form action="" role="form text-left">
    <div class="row">
        <div class="col">
            <label>Status Penyuluh</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" disabled>
            </div>
            <label>No. KTP</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="No. KTP" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>Nama Penyuluh</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>Tempat, Tanggal Lahir</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tempat" aria-label="Password" aria-describedby="password-addon">
                <input type="date" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>Jenis Kelamin</label>
            <div class="input-group mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                </div>
            </div>
            <label>Lokasi Kerja</label>
            <div class="input-group mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Pilih Lokasi Kerja</option>
                    <option value="3">Kabupaten/Kota</option>
                    <option value="4">Kecamatan</option>
                </select>
            </div>
        </div>
        <div class="col">
            <label>Kecamatan Tempat Tugas</label>
            <div class="input-group mb-3">
                <select name="tempat_tugas" id="tempat_tugas" class="form-control input-lg">
                    <option value="">Pilih Desa</option>
                    <?php
                    foreach ($tabel_data as $row) {
                        echo '<option value="' . $row["id_daerah"] . '">' . $row["deskripsi"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <label>Alamat Rumah</label>
            <div class="input-group mb-3">
                <textarea class="form-control" placeholder="Alamat Rumah" id="floatingTextarea"></textarea>
            </div>
            <label>Kab./Kota dan Kode Pos</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Kab./Kota" aria-label="Password" aria-describedby="password-addon">

                <input type="text" class="form-control" placeholder="| Kode Pos" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>Provinsi</label>
            <div class="input-group mb-3">
                <select name="kode_prop" id="kode_prop" class="form-control input-lg">
                    <option value="">Pilih Provinsi</option>
                    <?php
                    foreach ($tabel_data as $row) {
                        echo '<option value="' . $row["id_prop"] . '">' . $row["nama_prop"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <label>No.Telepon/HP</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>Email</label>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
            </div>
        </div>
        <h5>Perusahaan</h5>
        <div class="col">

            <label>Nama Perusahaan</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="No. KTP" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>
                Jabatan Dalam Perusahaan</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama" aria-label="Password" aria-describedby="password-addon">
            </div>
            <label>Alamat Perusahaan</label>
            <div class="input-group mb-3">
                <textarea class="form-control" placeholder="Alamat Rumah" id="floatingTextarea"></textarea>
            </div>
            <label>No.Telepon</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama" aria-label="Password" aria-describedby="password-addon">
            </div>
        </div>
        <div class="text-center">
            <center><button type="button" class="btn btn-round bg-gradient-warning btn-lg">Simpan Data</button></center>
        </div>
    </div>
</form>

<?= $this->endSection() ?>