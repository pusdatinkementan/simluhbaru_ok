<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $seskab = session()->get('kodebpp'); ?>


<br>
<b>Daftar Penyuluh Swasta Kecamatan <?= ucwords(strtolower($nama_kecamatan)) ?></b>
<p>Ditemukan <?= $jml_data ?> data</p>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No KTP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Satmikal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tempat/Tgl Lahir</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Terakhir Update</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody class="swastadata">
                <?php
                foreach ($tabel_data as $key => $row) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $key + 1; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['noktp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['nama']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['kelompok']; ?>.<?= $row['namasat']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tempat_lahir']; ?>, <?= $row['tgl_lahir']; ?>-<?= $row['bln_lahir']; ?>-<?= $row['thn_lahir']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_update']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="#">
                                <button type="button" id="btnEdit" data-id_swa="<?= $row['id_swa']; ?>" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
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
                                <form method="POST" action="<?= base_url('Penyuluh/PenyuluhSwastaKec/save'); ?>">
                                    <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="id_swa" id="id_swa" class="form-control id_swa">
                                            <input type="hidden" name="jenis_penyuluh" id="jenis_penyuluh" class="form-control jenis_penyuluh">
                                            <input type="hidden" name="satminkal" id="satminkal" class="form-control satminkal">

                                            <label>No. KTP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="noktp" id="noktp" class="form-control noktp" placeholder="No. KTP">
                                            </div>
                                            <label>Nama Penyuluh</label> <span id="error_nama" class="text-danger ms-3"></span>
                                            <div class="input-group mb-3">
                                                <input type="text" name="nama" id="nama" class="form-control nama" placeholder="Nama">
                                            </div>
                                            <label>Tempat, Tanggal Lahir</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir" placeholder="Tempat Lahir">
                                                <select id="year" name="thn_lahir" class="form-select thn_lahir" aria-label="Default select example">
                                                    <option value="">Tahun</option>
                                                </select>
                                                <select id="month" name="bln_lahir" class="form-select bln_lahir" aria-label="Default select example">
                                                    <option value="">Bulan</option>
                                                </select>
                                                <select id="day" name="tgl_lahir" class="form-select tgl_lahir" aria-label="Default select example">
                                                    <option value="">Tanggal</option>
                                                </select>
                                            </div>
                                            <label>Jenis Kelamin</label>
                                            <div class="input-group mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="2">
                                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                                </div>
                                            </div>
                                            <label>Lokasi Kerja</label>
                                            <div class="input-group mb-3">
                                                <select name="lokasi_kerja" id="lokasi_kerja" class="form-select lokasi_kerja" aria-label="Default select example">
                                                    <option selected>Pilih Lokasi Kerja</option>
                                                    <option value="3">Kabupaten/Kota</option>
                                                    <option value="4">Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Kecamatan Tempat Tugas</label>
                                            <div class="input-group mb-3">
                                                <select name="tempat_tugas" id="tempat_tugas" class="form-control input-lg tempat_tugas">
                                                    <option value="">Pilih Desa</option>
                                                    <?php
                                                    foreach ($tugas as $row2) {
                                                        echo '<option value="' . $row2["id_daerah"] . '">' . $row2["deskripsi"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Alamat Rumah</label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control alamat" placeholder="Alamat Rumah" name="alamat" id="alamat"></textarea>
                                            </div>
                                            <label>Kab./Kota dan Kode Pos</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control dati2" name="dati2" id="dati2" placeholder="Kab./Kota">

                                                <input type="text" class="form-control kodepos" name="kodepos" id="kodepos" placeholder="| Kode Pos">
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
                                            <label>No.Telepon/HP</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="telp" id="telp" class="form-control telp" placeholder="No.Telepon/HP">
                                            </div>
                                            <label>Email</label>
                                            <div class="input-group mb-3">
                                                <input type="email" name="email" id="email" class="form-control email" placeholder="Email">
                                            </div>
                                        </div>
                                        <h5>Perusahaan</h5>
                                        <div class="col">

                                            <label>Nama Perusahaan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control nama_perusahaan" placeholder="Nama Perusahaan">
                                            </div>
                                            <label>
                                                Jabatan Dalam Perusahaan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="jabatan_di_perush" id="jabatan_di_perush" class="form-control jabatan_di_perush" placeholder="Jabatan Dalam Perusahaan">
                                            </div>
                                            <label>Alamat Perusahaan</label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control alamat_perush" name="alamat_perush" id="alamat_perush" placeholder="Alamat Perusahaan" id="floatingTextarea"></textarea>
                                            </div>
                                            <label>No.Telepon</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="telp_perush" id="telp_perush" class="form-control telp_perush" placeholder="No.Telepon">
                                                <input type="hidden" id="tgl_update" name="tgl_update">

                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <center><button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-lg ajax-save">Simpan Data</button></center>
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

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $(document).delegate('#btnSave', 'click', function() {

            var jenis_penyuluh = $('#jenis_penyuluh').val();
            var satminkal = $('#satminkal').val();
            var noktp = $('#noktp').val();
            var nama = $('#nama').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var thn_lahir = $('#year').val();
            var bln_lahir = $('#month').val();
            var tgl_lahir = $('#day').val();
            var jenis_kelamin = $('#jenis_kelamin').val();
            var lokasi_kerja = $('#lokasi_kerja').val();
            var tempat_tugas = $('#tempat_tugas').val();
            var alamat = $('#alamat').val();
            var dati2 = $('#dati2').val();
            var kodepos = $('#kodepos').val();
            var kode_prop = $('#kode_prop').val();
            var telp = $('#telp').val();
            var email = $('#email').val();
            var nama_perusahaan = $('#nama_perusahaan').val();
            var jabatan_di_perush = $('#jabatan_di_perush').val();
            var alamat_perush = $('#alamat_perush').val();
            var telp_perush = $('#telp_perush').val();
            var tgl_update = $('#tgl_update').val();

            $.ajax({
                url: '<?= base_url() ?>/Penyuluh/PenyuluhSwastaKec/save/',
                type: 'POST',
                data: {
                    'jenis_penyuluh': jenis_penyuluh,
                    'satminkal': satminkal,
                    'noktp': noktp,
                    'nama': nama,
                    'tempat_lahir': tempat_lahir,
                    'thn_lahir': thn_lahir,
                    'bln_lahir': bln_lahir,
                    'tgl_lahir': tgl_lahir,
                    'jenis_kelamin': jenis_kelamin,
                    'lokasi_kerja': lokasi_kerja,
                    'tempat_tugas': tempat_tugas,
                    'alamat': alamat,
                    'dati2': dati2,
                    'kodepos': kodepos,
                    'kode_prop': kode_prop,
                    'telp': telp,
                    'email': email,
                    'nama_perusahaan': nama_perusahaan,
                    'jabatan_di_perush': jabatan_di_perush,
                    'alamat_perush': alamat_perush,
                    'telp_perush': telp_perush,
                    'tgl_update': tgl_update
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
                    var id_swa = $(this).data('id_swa');

                    $.ajax({
                        url: '<?= base_url() ?>/Penyuluh/PenyuluhSwastaKec/delete/' + id_swa,
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


        $(document).delegate('#btnEdit', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/Penyuluh/PenyuluhSwastaKec/edit/' + $(this).data('id_swa'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_swa').val(result.id_swa);
                    $('#jenis_penyuluh').val(result.jenis_penyuluh);
                    $('#satminkal').val(result.satminkal);
                    $('#noktp').val(result.noktp);
                    $('#nama').val(result.nama);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#year').val(result.thn_lahir);
                    $('#month').val(result.bln_lahir);
                    $('#day').val(result.tgl_lahir);
                    $('#jenis_kelamin').val(result.jenis_kelamin);
                    $('#lokasi_kerja').val(result.lokasi_kerja);
                    $('#tempat_tugas').val(result.tempat_tugas);
                    $('#alamat').val(result.alamat);
                    $('#dati2').val(result.dati2);
                    $('#kodepos').val(result.kodepos);
                    $('#kode_prop').val(result.kode_prop);
                    $('#telp').val(result.telp);
                    $('#email').val(result.email);
                    $('#nama_perusahaan').val(result.nama_perusahaan);
                    $('#jabatan_di_perush').val(result.jabatan_di_perush);
                    $('#alamat_perush').val(result.alamat_perush);
                    $('#telp_perush').val(result.telp_perush);
                    $('#tgl_update').val(result.tgl_update);

                    $('#modal-form').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {


                        var id_swa = $('#id_swa').val();
                        var jenis_penyuluh = $('#jenis_penyuluh').val();
                        var satminkal = $('#satminkal').val();
                        var noktp = $('#noktp').val();
                        var nama = $('#nama').val();
                        var tempat_lahir = $('#tempat_lahir').val();
                        var thn_lahir = $('#year').val();
                        var bln_lahir = $('#month').val();
                        var tgl_lahir = $('#day').val();
                        var jenis_kelamin = $('#jenis_kelamin').val();
                        var lokasi_kerja = $('#lokasi_kerja').val();
                        var tempat_tugas = $('#tempat_tugas').val();
                        var alamat = $('#alamat').val();
                        var dati2 = $('#dati2').val();
                        var kodepos = $('#kodepos').val();
                        var kode_prop = $('#kode_prop').val();
                        var telp = $('#telp').val();
                        var email = $('#email').val();
                        var nama_perusahaan = $('#nama_perusahaan').val();
                        var jabatan_di_perush = $('#jabatan_di_perush').val();
                        var alamat_perush = $('#alamat_perush').val();
                        var telp_perush = $('#telp_perush').val();
                        var tgl_update = $('#tgl_update').val();

                        let formData = new FormData();
                        formData.append('id_swa', id_swa);
                        formData.append('jenis_penyuluh', jenis_penyuluh);
                        formData.append('satminkal', satminkal);
                        formData.append('noktp', noktp);
                        formData.append('nama', nama);
                        formData.append('tempat_lahir', tempat_lahir);
                        formData.append('thn_lahir', thn_lahir);
                        formData.append('bln_lahir', bln_lahir);
                        formData.append('tgl_lahir', tgl_lahir);
                        formData.append('jenis_kelamin', jenis_kelamin);
                        formData.append('lokasi_kerja', lokasi_kerja);
                        formData.append('tempat_tugas', tempat_tugas);
                        formData.append('alamat', alamat);
                        formData.append('dati2', dati2);
                        formData.append('kodepos', kodepos);
                        formData.append('kode_prop', kode_prop);
                        formData.append('telp', telp);
                        formData.append('email', email);
                        formData.append('nama_perusahaan', nama_perusahaan);
                        formData.append('jabatan_di_perush', jabatan_di_perush);
                        formData.append('alamat_perush', alamat_perush);
                        formData.append('telp_perush', telp_perush);
                        formData.append('tgl_update', tgl_update);

                        $.ajax({
                            url: '<?= base_url() ?>/Penyuluh/PenyuluhSwastaKec/update/' + id_swa,
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

<?= $this->endSection() ?>