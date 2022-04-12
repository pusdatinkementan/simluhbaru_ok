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
<br>
<center>
    <h3> Daftar Anggota Kelompok Tani <?= ucwords(strtolower($nama_poktan)) ?> </h3>
</center>
<br>
<p> Catatan:</p>
<p>Sebelum input data anggota petani, wajib dilakukan pengecekan data petani terlebih dahulu yaitu NIK, Nama Lengkap, Tempat & Tanggal Lahir, Jenis Kelamin. Untuk memudahkan proses validasi diharapkan menginput data sesuai dengan KTP. Jika data tidak sesuai maka harap dilaporkan ke dinas dukcapil setempat.</p>

<p>Harap download ulang data petani dalam format excel, dikarenakan ada tambahan kolom isian tempat lahir,no HP dan titik koordinat
    Penulisan titik koordinat menggunakan format decimal degree, contoh : -7.303972903946691, 111.19991775514895
    <br>Tutorial mendapatkan titik koordinat dapat melihat <a href="<?= base_url('assets/Panduan%20Decimal%20Degree%20Google%20Maps.pptx') ?>"><b>panduan berikut</b></a>.
</p>

<p> Informasi:</p>
<p>Untuk menjaga kelancaran aliran data dimana telah dimulai input ERDKK pada bulan juni s/d oktober 2021 yang terintegrasi dengan data SIMLUHTAN,
    maka perbaikan/input data petani disarankan dilakukan melalui form input diatas
</p>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="cekpetani">Cek Data Petani</button>

<button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Anggota Kelompok</button>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">NIK</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tempat/Tgl Lahir</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat<br>(Sesuai KTP)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jenis Kelamin</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No Hp</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Status<br>Kenggotaan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Komoditas<br>Yang<br>Diusahakan(1)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Volume<br>(Ha,Ekor,unit)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Komoditas<br>Yang<br>Diusahakan(2)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Volume<br>(Ha,Ekor,unit)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Komoditas<br>Yang<br>Diusahakan(3)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Volume<br>(Ha,Ekor,unit)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Komoditas<br>Lainnya</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total Luas<br>Lahan Yang<br>Diuasahakan<br>(Ha)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total Luas<br>Lahan Yang<br>Dimiliki (Ha)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Kategori Petani</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Titik Koordinat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aksi</th>

                    <th class="text-secondary opacity-7"></th>
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
                            <p class="text-xs font-weight-bold mb-0"><?= $row['nama_anggota'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['no_ktp'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tempat_lahir'] ?>, <?= $row['tgl_lahir'] ?>-<?= $row['bln_lahir'] ?>-<?= $row['thn_lahir'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['alamat_ktp'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jenis_kelamin'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['no_hp'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['status_anggota'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['kode_komoditas1'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['volume'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['kode_komoditas2'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['volume2'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['kode_komoditas3'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['volume3'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['lainnya'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['luas_lahan_ternak_diusahakan'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['luas_lahan_ternak_dimiliki'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['kategori_petani_penggarap'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['titik_koordinat_lahan'] ?></p>
                        </td>

                        <td class="align-middle text-center text-sm">
                            <button type="button" data-id_anggota="<?= $row['id_anggota'] ?>" id="btnEditAnggota" class="btn bg-gradient-warning btn-sm">
                                <i class="fas fa-edit"></i> Ubah
                            </button>


                            <button class="btn btn-danger btn-sm" id="btnHapus" data-id_anggota="<?= $row['id_anggota'] ?>" type="button">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cek Data Petani</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label>NIK (sesuai KTP):</label>
                            <div class="col">
                                <div class="input-group mb-1">
                                    <input type="text" class="form-control" id="data-nik" maxlength="16" oninput="NikOnly(this)">
                                    <button class="btn btn-outline-secondary" type="button" id="cariNIK">Cari</button>
                                </div>
                                <p class="text-danger"><small>Silahkan klik tombol cari untuk cek data di database simluhtan</small></p>
                            </div>


                            <label>Nama Lengkap (sesuai KTP):</label>
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" id="data-namalkp" disabled>
                            </div>
                            <label>Tempat Lahir:</label>
                            <div class="input-group mb-1">
                                <input type="text" name="data-tmplhr" id="data-tmplhr" class="form-control data-tmplhr" placeholder="Tempat Lahir" disabled>
                            </div>
                            <div class="col">
                                <label>Tanggal Lahir </label>
                                <div class="input-group mb-2">
                                    <input type="text" id="data-tgllahir" name="data-tgllahir" class="form-control" placeholder="yyyy-mm-dd" disabled>
                                </div>
                                <p class="text-danger"><small>(format yyyy-mm-dd)</small></p>
                            </div>


                            <label>Jenis Kelamin (sesuai KTP):</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="data-jnskel" name="data-jnskel" disabled>
                                    <option value="">Pilih Jenis Kelamin </option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnCekdata" class="btn btn-primary" disabled>Cek Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <!-- <button type="button" class="btn btn-block bg-gradient-warning mb-3" data-bs-toggle="modal" data-bs-target="#modal-notification">Notification</button> -->
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-notification">Sukses terkirim</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="py-3 text-center">
                                <i class="fa-solid fa-share"></i>
                                <h4 class="text-gradient text-danger mt-4">Data sudah berhasil terkirim ke Dukcapil</h4>
                                <p>Harap cek status NIK yang sudah di kirim ke duckapil pada daftar data yang dikirimkan</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
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
                                <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                            </div>
                            <div class="card-body">
                                <form role="form text-left" action="<?= base_url('/KelembagaanPelakuUtama/KelompokTani/ListPoktanAnggota/save'); ?>" method="post" enctype="multipart/form-data">
                                    <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-5" mt-5>
                                            <label>Nama Anggota</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Nama Anggota" require>
                                            </div>
                                            <label>Nama Anggota (Sesuai KTP)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_ktp" name="nama_ktp" placeholder="Nama KTP">
                                            </div>

                                            <label>NO KTP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No KTP" onkeypress="return Angka(event)">
                                            </div>
                                            <label>Jenis Kelamin</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                    <option value="">Pilih Jenis Kelamin </option>
                                                    <option value="laki">Laki - Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <label>Tempat, Tanggal Lahir</label>
                                            <div class="input-group mb-1">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir" placeholder="Tempat Lahir">
                                            </div>
                                            <div class="input-group mb-3">
                                                <select id="day" name="tgl_lahir" class="form-select tgl_lahir" aria-label="Default select example">
                                                    <option value="">Tanggal</option>
                                                </select>
                                                <select id="month" name="bln_lahir" class="form-select bln_lahir" aria-label="Default select example">
                                                    <option value="">Bulan</option>
                                                </select>
                                                <select id="year" name="thn_lahir" class="form-select thn_lahir" aria-label="Default select example">
                                                    <option value="">Tahun</option>
                                                </select>
                                            </div>
                                            <label>No HP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" onkeypress="return Angka(event)">
                                            </div>
                                            <label>Alamat Lengkap Sekretariat</label>
                                            <textarea class="form-control" id="alamat_ktp" placeholder="Alamat" name="alamat_ktp"></textarea>

                                            <label>Status</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="status_anggota" name="status_anggota">
                                                    <option value="">Pilih </option>
                                                    <option value="1">Sebagai Anggota</option>
                                                    <option value="2">Calon Anggota</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">

                                            <label>Komoditas Yang Di Usahakan (1)</label>
                                            <div class="input-group mb-3">
                                                <select name="kode_komoditas" id="kode_komoditas" class="form-control input-lg">
                                                    <option value="">Pilih Komoditas</option>
                                                    <?php
                                                    foreach ($komoditas as $row2) {
                                                        echo '<option value="' . $row2["kode_komoditas"] . '">' . $row2["nama_subsektor"] . '-' . $row2["nama_komoditas"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Komoditas Yang Diusahakan (2)</label>
                                            <div class="input-group mb-3">
                                                <select name="kode_komoditas2" id="kode_komoditas2" class="form-control input-lg">
                                                    <option value="">Pilih Komoditas</option>
                                                    <?php
                                                    foreach ($komoditas as $row2) {
                                                        echo '<option value="' . $row2["kode_komoditas"] . '">' . $row2["nama_subsektor"] . '-' . $row2["nama_komoditas"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Komoditas Yang Diusahakan (3)</label>
                                            <div class="input-group mb-3">
                                                <select name="kode_komoditas3" id="kode_komoditas3" class="form-control input-lg">
                                                    <option value="">Pilih Komoditas</option>
                                                    <?php
                                                    foreach ($komoditas as $row2) {
                                                        echo '<option value="' . $row2["kode_komoditas"] . '">' . $row2["nama_subsektor"] . '-' . $row2["nama_komoditas"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Jika Lainnya, Isikan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="lainnya" name="lainnya">
                                            </div>
                                            <label>Total luas lahan yang diusahakan (ha) </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="luas_lahan_ternak_diusahakan" name="luas_lahan_ternak_diusahakan" placeholder="diisi dengan angka" onkeypress="return Angka(event)">
                                            </div>
                                            <label>Total luas lahan yang dimiliki (ha) </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="luas_lahan_ternak_dimiliki" name="luas_lahan_ternak_dimiliki" placeholder="diisi dengan angka" onkeypress="return Angka(event)">
                                            </div>
                                            <label>Titik Koordinat Lahan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="titik_koordinat_lahan" name="titik_koordinat_lahan" placeholder="Penulisan dengan format decimal degree" onkeypress="return Angka(event)">
                                                <label style="font-weight: normal">Format titik koordinat adalah Decimal Degree, contoh : <b>-6.2924034, 106.820540</b>
                                                    <br>Tutorial mendapatkan titik koordinat dapat melihat <a href="#"><b>panduan berikut</b></a>.
                                                </label>
                                            </div>
                                            <label>Kategori Petani</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="kategori_petani_penggarap" name="kategori_petani_penggarap" aria-label="Default select example">
                                                    <option value="">Kategori Petani </option>
                                                    <option value="1">Pemilik Lahan</option>
                                                    <option value="2">Penggarap dan Pemilik Lahan</option>
                                                    <option value="3">Penggarap</option>
                                                    <option value="4">Buruh</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label>Volume 1</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="volume" name="volume" placeholder="Volume (Ha,Ekor,Unit)" aria-label="Password" aria-describedby="password-addon">
                                            </div>
                                            <label>Volume 2</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="volume2" name="volume2" placeholder="Volume (Ha,Ekor,Unit)" aria-label="Password" aria-describedby="password-addon">
                                            </div>
                                            <label>Volume 3</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="volume3" name="volume3" placeholder="Volume (Ha,Ekor,Unit)" aria-label="Password" aria-describedby="password-addon">
                                            </div>

                                        </div>
                                        <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                        <input type="hidden" name="kode_desa" id="kode_desa" value="<?= $kode_desa; ?>">
                                        <input type="hidden" name="kode_kab" id="kode_kab" value="<?= $kode; ?>">
                                        <input type="hidden" name="kode_kec" id="kode_kec" value="<?= $kode_kec; ?>">
                                        <input type="hidden" id="id_anggota" name="id_anggota">
                                        <input type="hidden" id="id_poktan" name="id_poktan" value="<?= $id_poktan; ?>">
                                        <div class="text-center">
                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="btnSaveA" class="btn bg-gradient-info">Simpan Data</button>
                                            <!-- <button type="button" id="btnSaveA" class="btn btn-round bg-gradient-warning btn-sm">Simpan Data</button> -->
                                        </div>
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
</tbody>
</table>
</div>

</div>
<?php echo view('layout/footer'); ?>
<br>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#data-tgllahir').keyup(function() {
            debugger;
            mdata($('#data-tgllahir').val());
        });


        $("form").submit(function(event) {
            event.preventDefault();
            var data_nik = $('#data-nik').val();
            var data_namalkp = $('#data-namalkp').val();
            var data_tmplhr = $('#data-tmplhr').val();
            var data_tgllahir = $('#data-tgllahir').val();
            var data_jnskel = $('#data-jnskel').val();

            if (data_nik.length == 0) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "NIK Harus Diisi",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            } else if (data_nik.length < 16 || data_nik.length > 16) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "NIK wajib 16 Digit",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (data_namalkp.length == 0) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "Nama Lengkap Harus Diisi",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (data_tmplhr.length == 0) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "Tempat Lahir Harus Diisi",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (data_tgllahir.length == 0) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "Tanggal Lahir Harus Diisi",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            var bln = data_tgllahir.substring(5, 7);
            if (!validasi_tanggal(data_tgllahir)) {
                alert(bln)
                Swal.fire({
                    title: 'Perhatian',
                    text: "Tanggal tidak valid, format (yyyy-mm-dd)",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            } else if (bln > 12 || bln < 1) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "Bulan tidak valid, format (yyyy-mm-dd)",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (data_jnskel == 0) {
                Swal.fire({
                    title: 'Perhatian',
                    text: "Jenis Kelamin Harus Di Pilih ",
                    type: 'warning',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            var dataNikJson = {
                "NIK": data_nik,
                "NAMA_LGKP": data_namalkp,
                "JENIS_KLMIN": data_jnskel,
                "TMPT_LHR": data_tmplhr,
                "TGL_LHR": data_tgllahir
            };

            dataRaw = JSON.stringify(dataNikJson);

            $.ajax({
                url: "<?= base_url() ?>/validasi/Nikpetani/cekdukcapil/",
                method: 'POST',
                processData: false,
                contentType: 'application/json',
                dataType: 'JSON',
                data: dataRaw,
                enctype: 'multipart/form-data',
                success: function(result) {
                    console.log(result.content);

                    if (result) {
                        $('#modal-notification').modal('show');

                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'NIK tidak berhasil di cek',
                            type: 'error'
                        });
                    }

                },
                error: function(result, error) {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'NIK tidak berhasil di cek',
                        type: 'error'
                    });

                }
            });

        });

        function validasi_tanggal(tanggal) {
            var polaRegex = new RegExp(/^\d{4}-\d{2}-\d{2}$/);
            return polaRegex.test(tanggal);
        }

        function mdata(v) {
            v = v.replace(/\D/g, ""); //Remove what is not a digit
            v = v.replace(/(\d{2})(\d)/, "$1/$2");
            v = v.replace(/(\d{2})(\d)/, "$1/$2");

            v = v.replace(/(\d{2})(\d{2})$/, "$1$2");
            return v;
        }

        $('#cariNIK').on("click", function() {

            // alert($('#data-nik').val());
            var nikpetani = $('#data-nik').val();

            $.ajax({

                url: "<?= base_url() ?>/validasi/Nikpetani/ceknik/" + nikpetani,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    if (result) {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'NIK ditemukan di database, silahkan melengkapi data sesuai KTP untuk pengecekan data di Dukcapil',
                            type: 'success'
                        });

                        var tgllahir = result.THN_LAHIR + '-' + result.BLN_LAHIR + '-' + result.TGL_LAHIR
                        // alert(tgllahir);
                        if (result.JENIS_KELAMIN == 'laki') {
                            JnsKel = 'Laki-laki';
                        } else if (result.JENIS_KELAMIN == 'perempuan') {
                            JnsKel = 'Perempuan';
                        } else {
                            JnsKel = '';
                        }

                        //  alert(JnsKel);
                        $('#data-namalkp').val(result.NAMA_KTP);
                        $('#data-tmplhr').val(result.TMPT_LHR);
                        $('#data-tgllahir').val(tgllahir);
                        $('#data-jnskel').val(JnsKel);

                        $('#data-namalkp').prop('disabled', false);
                        $('#data-tmplhr').prop('disabled', false);
                        $('#data-tgllahir').prop('disabled', false);
                        $('#data-jnskel').prop('disabled', false);
                        $('#btnCekdata').prop('disabled', false);


                    } else {
                        Swal.fire({
                            title: 'Perhatian',
                            text: 'NIK tidak ditemukan, silahkan melengkapi data sesuai KTP untuk pengecekan data di Dukcapil ',
                            type: 'warning'
                        });
                        $('#data-namalkp').val('');
                        $('#data-tmplhr').val('');
                        $('#data-tgllahir').val('');
                        $('#data-jnskel').val('');

                        $('#data-namalkp').prop('disabled', false);
                        $('#data-tmplhr').prop('disabled', false);
                        $('#data-tgllahir').prop('disabled', false);
                        $('#data-jnskel').prop('disabled', false);
                        $('#btnCekdata').prop('disabled', false);
                    }

                },
                error: function(result, error) {
                    Swal.fire({
                        title: 'Perhatian',
                        text: 'NIK tidak ditemukan di database',
                        type: 'warning'
                    });

                }
            })

        });

        // $('#btnCekdata').on('click', function() {
        //     var data_nik = $('#data-nik').val();
        //     var data_namalkp = $('#data-namalkp').val();
        //     var data_tmplhr = $('#data-tmplhr').val();
        //     var data_tgllahir = $('#data-tgllahir').val();
        //     var data_jnskel = $('#data-jnskel').val();

        //     if (data_nik.length == 0) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "NIK Harus Diisi",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     } else if (data_nik.length < 16 || data_nik.length > 16) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "NIK wajib 16 Digit",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     }

        //     if (data_namalkp.length == 0) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "Nama Lengkap Harus Diisi",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     }

        //     if (data_tmplhr.length == 0) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "Tempat Lahir Harus Diisi",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     }

        //     if (data_tgllahir.length == 0) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "Tanggal Lahir Harus Diisi",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     }

        //     var bln = data_tgllahir.substring(5, 7);
        //     if (!validasi_tanggal(data_tgllahir)) {
        //         alert(bln)
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "Tanggal tidak valid, format (yyyy-mm-dd)",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     } else if (bln > 12 || bln < 1) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "Bulan tidak valid, format (yyyy-mm-dd)",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     }

        //     if (data_jnskel == 0) {
        //         Swal.fire({
        //             title: 'Perhatian',
        //             text: "Jenis Kelamin Harus Di Pilih ",
        //             type: 'warning',
        //         }).then((result) => {
        //             if (result.value) {
        //                 return false;
        //             }
        //         });
        //         return false;
        //     }

        //     var dataNikJson = {
        //         "NIK": data_nik,
        //         "NAMA_LGKP": data_namalkp,
        //         "JENIS_KLMIN": data_jnskel,
        //         "TMPT_LHR": data_tmplhr,
        //         "TGL_LHR": data_tgllahir,
        //         "TRESHOLD": 90,
        //         "user_id": "11953174202203011dummybppsdmpkementan",
        //         "password": "123",
        //         "ip_user": "10.214.41.21"
        //     };

        //     dataRaw = JSON.stringify(dataNikJson);
        //     // debugger;
        //     $.ajax({
        //         url: "http://172.16.160.84:8000/dukcapil/get_json/bppsdmp_kementan/nik_verifby_elemen",
        //         method: 'POST',
        //         processData: false,
        //         contentType: 'application/json',
        //         dataType: 'JSON',
        //         data: dataRaw,
        //         enctype: 'multipart/form-data',
        //         success: function(result) {
        //             console.log(result.content);
        //             // var json = $.parseJSON(result); // create an object with the key of the array
        //             // alert(json.html);
        //             // alert('ok');
        //             if (result) {

        //                 $('#modal-notification').modal('show');

        //             } else {
        //                 Swal.fire({
        //                     title: 'Gagal',
        //                     text: 'NIK tidak berhasil di cek',
        //                     type: 'error'
        //                 });
        //             }

        //         },
        //         error: function(result, error) {
        //             Swal.fire({
        //                 title: 'Gagal',
        //                 text: 'NIK tidak berhasil di cek',
        //                 type: 'error'
        //             });

        //         }
        //     });


        // });

        $(document).delegate('#btnSaveA', 'click', function() {

            var kode_kec = $('#kode_kec').val();
            var kode_desa = $('#kode_desa').val();
            var kode_kab = $('#kode_kab').val();
            var kode_prop = $('#kode_prop').val();
            var id_poktan = $('#id_poktan').val();
            var nama_anggota = $('#nama_anggota').val();
            var nama_ktp = $('#nama_ktp').val();
            var no_ktp = $('#no_ktp').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var tgl_lahir = $('#day').val();
            var bln_lahir = $('#month').val();
            var thn_lahir = $('#year').val();
            var no_hp = $('#no_hp').val();
            var jenis_kelamin = $('#jenis_kelamin').val();
            var alamat_ktp = $('#alamat_ktp').val();
            var status_anggota = $('#status_anggota').val();
            var kode_komoditas = $('#kode_komoditas').val();
            var kode_komoditas2 = $('#kode_komoditas2').val();
            var kode_komoditas3 = $('#kode_komoditas3').val();
            var volume = $('#volume').val();
            var volume2 = $('#volume2').val();
            var volume3 = $('#volume3').val();
            var lainnya = $('#lainnya').val();
            var luas_lahan_ternak_dimiliki = $('#luas_lahan_ternak_dimiliki').val();
            var luas_lahan_ternak_diusahakan = $('#luas_lahan_ternak_diusahakan').val();
            var titik_koordinat_lahan = $('#titik_koordinat_lahan').val();
            var kategori_petani_penggarap = $('#kategori_petani_penggarap').val();

            if (nama_anggota.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama Anggota Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (nama_ktp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama Anggota (Sesuai KTP) Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (nama_ktp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama Anggota (Sesuai KTP) Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (no_ktp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "NO KTP Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            } else if (no_ktp.length < 16 || no_ktp.length > 16) {
                Swal.fire({
                    title: 'Error',
                    text: "NO KTP Harus 16 Digit",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;

            }

            if (jenis_kelamin == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Jenis Kelamin Harus Di Pilih ",
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
                    text: "Tempat Lahir Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (no_hp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "No Telp Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (alamat_ktp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Alamat Harus Diisi Sesuai KTP",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (status_anggota == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Status Anggota Harus Di Pilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (kode_komoditas == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Komoditas Wajib Di Pilih Minimal 1",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (volume.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Volume Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (luas_lahan_ternak_dimiliki.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Luas Lahan Dimiliki Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (luas_lahan_ternak_diusahakan.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Luas Lahan Usahakan Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (titik_koordinat_lahan.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Titik Koordinat Lahan Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            } else {
                var koord_array = titik_koordinat_lahan.split(",");
                if (koord_array.length != 2 || !(validateLatLng(koord_array[0].trim(), koord_array[1].trim()))) {
                    Swal.fire({
                        title: 'Error',
                        text: "Titik Koordinat Lahan harus format Decimal Degree, contoh : -6.2924034, 106.820540",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
            }
            if (kategori_petani_penggarap == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Kategori Petani Harus Di Pilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }



            $.ajax({
                url: '<?= base_url('/KelembagaanPelakuUtama/KelompokTani/ListPokTanAnggota/save/') ?>',
                type: 'POST',
                data: {

                    'kode_desa': kode_desa,
                    'kode_kec': kode_kec,
                    'kode_kab': kode_kab,
                    'kode_prop': kode_prop,
                    'id_poktan': id_poktan,
                    'nama_anggota': nama_anggota,
                    'nama_ktp': nama_ktp,
                    'no_ktp': no_ktp,
                    'tempat_lahir': tempat_lahir,
                    'tgl_lahir': tgl_lahir,
                    'bln_lahir': bln_lahir,
                    'thn_lahir': thn_lahir,
                    'no_hp': no_hp,
                    'jenis_kelamin': jenis_kelamin,
                    'alamat_ktp': alamat_ktp,
                    'status_anggota': status_anggota,
                    'kode_komoditas': kode_komoditas,
                    'kode_komoditas2': kode_komoditas2,
                    'kode_komoditas3': kode_komoditas3,
                    'volume': volume,
                    'volume2': volume2,
                    'volume3': volume3,
                    'lainnya': lainnya,
                    'luas_lahan_ternak_dimiliki': luas_lahan_ternak_dimiliki,
                    'luas_lahan_ternak_diusahakan': luas_lahan_ternak_diusahakan,
                    'titik_koordinat_lahan': titik_koordinat_lahan,
                    'kategori_petani_penggarap': kategori_petani_penggarap
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
                    var id = $(this).data('id_anggota');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/ListPoktanAnggota/delete/' + id,
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
        $(document).delegate('#btnEditAnggota', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/ListPoktanAnggota/edit/' + $(this).data('id_anggota'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_anggota').val(result.id_anggota);
                    $('#kode_kec').val(result.kode_kec);
                    $('#kode_desa').val(result.kode_desa);
                    $('#kode_kab').val(result.kode_kab);
                    $('#kode_prop').val(result.kode_prop);
                    $('#id_poktan').val(result.id_poktan);
                    $('#nama_anggota').val(result.nama_anggota);
                    $('#nama_ktp').val(result.nama_ktp);
                    $('#jenis_kelamin').val(result.jenis_kelamin);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#day').val(result.tgl_lahir);
                    $('#month').val(result.bln_lahir);
                    $('#year').val(result.thn_lahir);
                    $('#no_hp').val(result.no_hp);
                    $('#no_ktp').val(result.no_ktp);
                    $('#alamat_ktp').val(result.alamat_ktp);
                    $('#status_anggota').val(result.status_anggota);
                    $('#kode_komoditas').val(result.kode_komoditas);
                    $('#kode_komoditas2').val(result.kode_komoditas2);
                    $('#kode_komoditas3').val(result.kode_komoditas3);
                    $('#volume').val(result.volume);
                    $('#volume2').val(result.volume2);
                    $('#volume3').val(result.volume3);
                    $('#lainnya').val(result.lainnya);
                    $('#luas_lahan_ternak_diusahakan').val(result.luas_lahan_ternak_diusahakan);
                    $('#luas_lahan_ternak_dimiliki').val(result.luas_lahan_ternak_dimiliki);
                    $('#titik_koordinat_lahan').val(result.titik_koordinat_lahan);
                    $('#kategori_petani_penggarap').val(result.kategori_petani_penggarap);


                    $('#modal-form').modal('show');
                    $("#btnSaveA").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {


                        var id_anggota = $('#id_anggota').val();
                        var kode_kec = $('#kode_kec').val();
                        var kode_desa = $('#kode_desa').val();
                        var kode_kab = $('#kode_kab').val();
                        var kode_prop = $('#kode_prop').val();
                        var id_poktan = $('#id_poktan').val();
                        var nama_anggota = $('#nama_anggota').val();
                        var nama_ktp = $('#nama_ktp').val();
                        var jenis_kelamin = $('#jenis_kelamin').val();
                        var tempat_lahir = $('#tempat_lahir').val();
                        var tgl_lahir = $('#day').val();
                        var bln_lahir = $('#month').val();
                        var thn_lahir = $('#year').val();
                        var no_hp = $('#no_hp').val();
                        var no_ktp = $('#no_ktp').val();
                        var alamat_ktp = $('#alamat_ktp').val();
                        var status_anggota = $('#status_anggota').val();
                        var kode_komoditas = $('#kode_komoditas').val();
                        var kode_komoditas2 = $('#kode_komoditas2').val();
                        var kode_komoditas3 = $('#kode_komoditas3').val();
                        var volume = $('#volume').val();
                        var volume2 = $('#volume2').val();
                        var volume3 = $('#volume3').val();
                        var lainnya = $('#lainnya').val();
                        var luas_lahan_ternak_dimiliki = $('#luas_lahan_ternak_dimiliki').val();
                        var luas_lahan_ternak_diusahakan = $('#luas_lahan_ternak_diusahakan').val();
                        var titik_koordinat_lahan = $('#titik_koordinat_lahan').val();
                        var kategori_petani_penggarap = $('#kategori_petani_penggarap').val();


                        let formData = new FormData();

                        formData.append('id_anggota', id_anggota);
                        formData.append('kode_kec', kode_kec);
                        formData.append('kode_desa', kode_desa);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_prop', kode_prop);
                        formData.append('id_poktan', id_poktan);
                        formData.append('nama_anggota', nama_anggota);
                        formData.append('nama_ktp', nama_ktp);
                        formData.append('jenis_kelamin', jenis_kelamin);
                        formData.append('tempat_lahir', tempat_lahir);
                        formData.append('tgl_lahir', tgl_lahir);
                        formData.append('bln_lahir', bln_lahir);
                        formData.append('thn_lahir', thn_lahir);
                        formData.append('no_hp', no_hp);
                        formData.append('no_ktp', no_ktp);
                        formData.append('alamat_ktp', alamat_ktp);
                        formData.append('status_anggota', status_anggota);
                        formData.append('kode_komoditas', kode_komoditas);
                        formData.append('kode_komoditas2', kode_komoditas2);
                        formData.append('kode_komoditas3', kode_komoditas3);
                        formData.append('volume', volume);
                        formData.append('volume2', volume2);
                        formData.append('volume3', volume3);
                        formData.append('lainnya', lainnya);
                        formData.append('luas_lahan_ternak_diusahakan', luas_lahan_ternak_diusahakan);
                        formData.append('luas_lahan_ternak_dimiliki', luas_lahan_ternak_dimiliki);
                        formData.append('titik_koordinat_lahan', titik_koordinat_lahan);
                        formData.append('kategori_petani_penggarap', kategori_petani_penggarap);


                        if (nama_anggota.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Anggota Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (nama_ktp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Anggota (Sesuai KTP) Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (nama_ktp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Anggota (Sesuai KTP) Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (no_ktp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "NO KTP Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        } else if (no_ktp.length < 16 || no_ktp.length > 16) {
                            Swal.fire({
                                title: 'Error',
                                text: "NO KTP Harus 16 Digit",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;

                        }

                        if (jenis_kelamin == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Jenis Kelamin Harus Di Pilih ",
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
                                text: "Tempat Lahir Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (no_hp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "No Telp Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (alamat_ktp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Alamat Harus Diisi Sesuai KTP",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (status_anggota == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Status Anggota Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (kode_komoditas == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Komoditas Wajib Di Pilih Minimal 1",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (volume.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Volume Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (luas_lahan_ternak_dimiliki.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Luas Lahan Dimiliki Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (luas_lahan_ternak_diusahakan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Luas Lahan Ternak Di Usahakan Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (titik_koordinat_lahan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Titik Koordinat Lahan Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        } else {
                            var koord_array = titik_koordinat_lahan.split(",");
                            if (koord_array.length != 2 || !(validateLatLng(koord_array[0].trim(), koord_array[1].trim()))) {
                                Swal.fire({
                                    title: 'Error',
                                    text: "Titik Koordinat Lahan harus format Decimal Degree, contoh : -6.2924034, 106.820540",
                                    type: 'error',
                                }).then((result) => {
                                    if (result.value) {
                                        return false;
                                    }
                                });
                                return false;
                            }
                        }
                        if (kategori_petani_penggarap == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Kategori Petani Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }




                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/ListPoktanAnggota/update/' + id_anggota,
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
    function Angka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>
<?= $this->endSection() ?>