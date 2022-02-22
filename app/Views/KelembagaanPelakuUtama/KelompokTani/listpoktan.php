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
    <h3>Daftar Kelompok Tani di Kecamatan <?= ucwords(strtolower($nama_kecamatan)) ?></h3>
    <p>Data ditemukan <?= ucwords(strtolower($jum)) ?></p>
</center>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Data</button>
            <div class="card">
                <div class="table-responsive">
                    <table id="tblPoktan" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Poktan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">ID Poktan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Desa</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Ketua</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat Sekretariat</th>
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
                                        <div class="dropdown show">
                                            <a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= $row['nama_poktan'] ?>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="<?= base_url('/listpoktananggota?ip=' . $row['id_poktan']) ?>"><i class="fas fa-plus"></i> Tambah Anggota</a>
                                                <a class="dropdown-item" href="<?= base_url('/listbantu?ip=' . $row['id_poktan']) ?>"><i class="fas fa-plus"></i> Tambah Bantuan</a>
                                                <a class="dropdown-item" href="<?= base_url('/komoditasbun?ip=' . $row['id_poktan']) ?>"><i class="fas fa-plus"></i> Komoditas yang diusahakan</a>
                                                <a class="dropdown-item" href="<?= base_url('/kelaskelompok?ip=' . $row['id_poktan']) ?>"><i class="fas fa-plus"></i> Input Kelas Kelompok</a>
                                                <a class="dropdown-item" href="<?= base_url('/listjnskel?ip=' . $row['id_poktan']) ?>"><i class="fas fa-plus"></i> Input Jenis Kelompok</a>
                                                <a class="dropdown-item" data-id_poktan="<?= $row['id_poktan'] ?>" id="btnEditPok" href="#"> <i class="fas fa-edit"></i> Ubah</a>
                                                <a class="dropdown-item" id="btnHapus" data-id_poktan="<?= $row['id_poktan'] ?>" href="#"><i class="fas fa-trash"></i> Hapus</a>
                                            </div>
                                        </div>

                                    </td>

                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['id_poktan'] ?></p>
                                    </td>

                                    <td class="align-middle text-sm">

                                        <p class="text-xs font-weight-bold mb-0"><?= $row['nm_desa'] ?></p>
                                    </td>

                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['ketua_poktan'] ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['alamat'] ?></p>
                                    </td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                                        </div>
                                        <div class="card-body">
                                            <form role="form text-left" action="<?= base_url('/KelembagaanPelakuUtama/KelompokTani/ListPokTan/save'); ?>" method="post" enctype="multipart/form-data">
                                                <? csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-5" mt-5>
                                                        <label>Kecamatan</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Kecamatan" value="<?= $nama_kecamatan; ?>" disabled>
                                                        </div>
                                                        <label>Desa</label>
                                                        <div class="input-group mb-3">
                                                            <select name="kode_desa" id="kode_desa" class="form-control input-lg">
                                                                <option value="">Pilih Desa</option>
                                                                <?php
                                                                foreach ($desa as $row2) {
                                                                    echo '<option value="' . $row2["id_desa"] . '">' . $row2["nm_desa"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>Nama Poktan</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="nama_poktan" name="nama_poktan" placeholder="Nama Poktan" required>
                                                        </div>
                                                        <label>Nama Ketua</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="ketua_poktan" name="ketua_poktan" placeholder="Nama Ketua" required>
                                                        </div>
                                                        <label>Nama Sekretaris</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="sekretaris_poktan" name="sekretaris_poktan" placeholder="Nama Sekretaris" required>
                                                        </div>
                                                        <label>Nama Bendahara</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="bendahara_poktan" name="bendahara_poktan" placeholder="Nama Bendahara" required>
                                                        </div>
                                                        <label>Alamat Lengkap Sekretariat</label>
                                                        <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" required></textarea>
                                                        <label>Tahun Pembentukan</label>
                                                        <div class="input-group mb-3">
                                                            <select id="year" class="form-select" aria-label="Default select example" name="simluh_tahun_bentuk">
                                                                <option selected>Pilih Tahun</option>

                                                            </select>
                                                        </div>
                                                        <label>Status</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="status" name="status" aria-label="Default select example">
                                                                <option value="">Pilih </option>
                                                                <option value="1">Aktif</option>
                                                                <option value="2">Tidak aktif</option>
                                                                <option value="3">Bergabung Dengan Kelompok Lain</option>
                                                            </select>
                                                        </div>
                                                        <label>Kelas Kemampuan</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="simluh_kelas_kemampuan" name="simluh_kelas_kemampuan" aria-label="Default select example">
                                                                <option selected>Pilih </option>
                                                                <option value="pemula">Pemula</option>
                                                                <option value="lanjut">Lanjut</option>
                                                                <option value="madya">Madya</option>
                                                                <option value="utama">Utama</option>
                                                            </select>
                                                        </div>

                                                        <label>Penilaian Kelas Kemampuan</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="nilai_kelas" name="nilai_kelas" placeholder="Nilai Kelas" required>
                                                        </div>

                                                        <label>Status Pengukuhan Kelompok</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="simluh_pengukuhan_kelompok" name="simluh_kelas_kemampuan" aria-label="Default select example">
                                                                <option selected>Pilih </option>
                                                                <option value="bupati">Bupati/Walikota</option>
                                                                <option value="kadis">Kepala Dinas</option>
                                                                <option value="kades">Kepala Desa</option>

                                                            </select>
                                                        </div>

                                                        <label>Tahun Penetapan Kelas</label>
                                                        <div class="input-group mb-3">
                                                            <select id="year2" class="form-select" aria-label="Default select example" name="simluh_tahun_tap_kelas">
                                                                <option selected>Pilih Tahun</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">

                                                        <label>Jenis Kelompok Lainnya</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_perempuan" type="checkbox" value="perempuan" name="simluh_jenis_kelompok_perempuan" id="simluh_jenis_kelompok_perempuan">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_perempuan">
                                                                Perempuan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_domisili" type="checkbox" value="domisili" name="simluh_jenis_kelompok_domisili" id="simluh_jenis_kelompok_domisili">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_domisili">
                                                                Domisili
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_upja" type="checkbox" value="upja" name="simluh_jenis_kelompok_upja" id="simluh_jenis_kelompok_upja">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_upja">
                                                                UPJA
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_p3a" type="checkbox" value="p3a" name="simluh_jenis_kelompok_p3a" id="simluh_jenis_kelompok_p3a">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_p3a">
                                                                P3A/HIPPA
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input  simluh_jenis_kelompok_lmdh" type="checkbox" value="lmdh" name="simluh_jenis_kelompok_lmdh" id="simluh_jenis_kelompok_lmdh">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_lmdh">
                                                                LMDH
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_penangkar" type="checkbox" value="penangkar" name="simluh_jenis_kelompok_penangkar" id="simluh_jenis_kelompok_penangkar">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_penangkar">
                                                                Penangkar Benih
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_kmp" type="checkbox" value="kmp" name="simluh_jenis_kelompok_kmp" id="simluh_jenis_kelompok_kmp">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_kmp">
                                                                KMP (Kawasan Mandiri Pangan)
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_umkm" type="checkbox" value="umkm" name="simluh_jenis_kelompok_umkm" id="simluh_jenis_kelompok_umkm">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_umkm">
                                                                UMKM Model Pengembangan Pangan Pokok Lokal (MP3L)
                                                            </label>
                                                        </div>

                                                        <Label> Komoditas Diusahakan</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_tp" type="checkbox" value="tp" name="simluh_jenis_kelompok_tp" id="simluh_jenis_kelompok_tp">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_tp">
                                                                Tanaman Pangan
                                                            </label>
                                                        </div>

                                                        <label>Pilih Komoditas</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="komoditas_tp" name="komoditas_tp" aria-label="Default select example">
                                                                <option selected>Pilih </option>
                                                                <?php
                                                                foreach ($datatp as $row) {
                                                                ?>
                                                                    <option value="<?= $row['id_komoditas']; ?>"><?= $row['nama_komoditas']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_komo_lain_tp" name="simluh_komo_lain_tp" placeholder="Komoditas Tanaman Pangan Lainnya">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_bun" type="checkbox" value="bun" name="simluh_jenis_kelompok_bun" id="simluh_jenis_kelompok_bun">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_bun">
                                                                Perkebunan
                                                            </label>
                                                        </div>
                                                        <label>Pilih Komoditas</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="komoditas_bun" name="komoditas_bun" aria-label="Default select example">
                                                                <option selected>Pilih </option>
                                                                <?php
                                                                foreach ($databun as $row) {
                                                                ?>
                                                                    <option value="<?= $row['id_komoditas']; ?>"><?= $row['nama_komoditas']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_komo_lain_bun" name="simluh_komo_lain_bun" placeholder="Komoditas Perkebunan Lainnya">
                                                        </div>


                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_hor" type="checkbox" value="hor" name="simluh_jenis_kelompok_hor" id="simluh_jenis_kelompok_hor">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_hor">
                                                                Hortikultura
                                                            </label>
                                                        </div>
                                                        <label>Pilih Komoditas</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="komoditas_horti" name="komoditas_horti" aria-label="Default select example">
                                                                <option selected>Pilih </option>

                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_komo_lain_hor" name="simluh_komo_lain_hor" placeholder="Komoditas Hortikultura Lainnya">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_nak" type="checkbox" value="nak" name="simluh_jenis_kelompok_nak" id="simluh_jenis_kelompok_nak">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_nak">
                                                                Peternakan
                                                            </label>
                                                        </div>
                                                        <label>Pilih Komoditas</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="komoditas_nak" name="komoditas_nak" aria-label="Default select example">
                                                                <option selected>Pilih </option>

                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_komo_lain_nak" name="simluh_komo_lain_nak" placeholder="Komoditas Peternakan Lainnya">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_jenis_kelompok_olah" type="checkbox" value="olah" name="simluh_jenis_kelompok_olah" id="simluh_jenis_kelompok_olah">
                                                            <label class="form-check-label" for="simluh_jenis_kelompok_olah">
                                                                Pengolahan
                                                            </label>
                                                        </div>
                                                        <label>Pilih Komoditas</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="komoditas_olah" name="komoditas_olah" aria-label="Default select example">
                                                                <option selected>Pilih </option>

                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_komo_lain_olah" name="simluh_komo_lain_olah" placeholder="Komoditas Pengolahan Lainnya">
                                                        </div>

                                                    </div>



                                                    <input type="hidden" name="kode_kab" id="kode_kab" value="<?= $kode; ?>">
                                                    <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                                    <input type="hidden" name="kode_kec" id="kode_kec" value="<?= $kode_kec; ?>">
                                                    <input type="hidden" id="id_poktan" name="id_poktan">

                                                    <div class="text-center">
                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                                        <!-- <button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-sm">Simpan Data</button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div </div>
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


        $('#tblPoktan').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
        $(document).delegate('#btnSave', 'click', function() {

            var kode_kec = $('#kode_kec').val();
            var kode_kab = $('#kode_kab').val();
            var kode_desa = $('#kode_desa').val();
            var kode_prop = $('#kode_prop').val();
            var id_gap = $('#id_gap').val();
            var nama_poktan = $('#nama_poktan').val();
            var ketua_poktan = $('#ketua_poktan').val();
            var alamat = $('#alamat').val();
            var simluh_tahun_bentuk = $('#year').val();
            var status = $('#status').val();
            var simluh_tahun_tap_kelas = $('#year2').val();
            var simluh_kelas_kemampuan = $('#simluh_kelas_kemampuan').val();
            var nilai_kelas = $('#nilai_kelas').val();

            var simluh_jenis_kelompok_perempuan = $(".simluh_jenis_kelompok_perempuan")[0].checked ? $(".simluh_jenis_kelompok_perempuan").val() : "";
            var simluh_jenis_kelompok_domisili = $(".simluh_jenis_kelompok_domisili")[0].checked ? $(".simluh_jenis_kelompok_domisili").val() : "";
            var simluh_jenis_kelompok_upja = $(".simluh_jenis_kelompok_upja")[0].checked ? $(".simluh_jenis_kelompok_upja").val() : "";
            var simluh_jenis_kelompok_p3a = $(".simluh_jenis_kelompok_p3a")[0].checked ? $(".simluh_jenis_kelompok_p3a").val() : "";
            var simluh_jenis_kelompok_lmdh = $(".simluh_jenis_kelompok_lmdh")[0].checked ? $(".simluh_jenis_kelompok_lmdh").val() : "";
            var simluh_jenis_kelompok_penangkar = $(".simluh_jenis_kelompok_penangkar")[0].checked ? $(".simluh_jenis_kelompok_penangkar").val() : "";
            var simluh_jenis_kelompok_kmp = $(".simluh_jenis_kelompok_kmp")[0].checked ? $(".simluh_jenis_kelompok_kmp").val() : "";
            var simluh_jenis_kelompok_umkm = $(".simluh_jenis_kelompok_umkm")[0].checked ? $(".simluh_jenis_kelompok_umkm").val() : "";


            var simluh_jenis_kelompok_tp = $(".simluh_jenis_kelompok_tp")[0].checked ? $(".simluh_jenis_kelompok_tp").val() : "";
            var simluh_jenis_kelompok_bun = $(".simluh_jenis_kelompok_bun")[0].checked ? $(".simluh_jenis_kelompok_bun").val() : "";
            var simluh_jenis_kelompok_hor = $(".simluh_jenis_kelompok_hor")[0].checked ? $(".simluh_jenis_kelompok_hor").val() : "";
            var simluh_jenis_kelompok_nak = $(".simluh_jenis_kelompok_nak")[0].checked ? $(".simluh_jenis_kelompok_nak").val() : "";
            var simluh_jenis_kelompok_olah = $(".simluh_jenis_kelompok_olah")[0].checked ? $(".simluh_jenis_kelompok_olah").val() : "";

            var simluh_komo_lain_tp = $('#simluh_komo_lain_tp').val();
            var simluh_komo_lain_bun = $('#simluh_komo_lain_bun').val();
            var simluh_komo_lain_hor = $('#simluh_komo_lain_hor').val();
            var simluh_komo_lain_nak = $('#simluh_komo_lain_nak').val();
            var simluh_komo_lain_olah = $('#simluh_komo_lain_olah').val();

            /*
                Edit By: Bambang, Wahyu, Asyhadi
                Tgl: 31 Januari 200
                Desc: variabel komoditas bun, tp, nak ,horti
            */

            var komTp = $('#komoditas_tp').val();


            if (kode_desa == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Desa Harus Di pilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (nama_poktan.length < 3) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama Poktan Harus Diisi Minimal 3 Karakter",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (ketua_poktan.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Ketua Poktan Harus Diisi",
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
                    text: "Alamat Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (status == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Status Harus Di Pilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            debugger;
            $.ajax({
                url: '<?= base_url('/KelembagaanPelakuUtama/KelompokTani/KelompokTani/save/') ?>',
                type: 'POST',
                data: {
                    'kode_kec': kode_kec,
                    'kode_kab': kode_kab,
                    'kode_desa': kode_desa,
                    'kode_prop': kode_prop,
                    'id_gap': id_gap,
                    'nama_poktan': nama_poktan,
                    'ketua_poktan': ketua_poktan,
                    'alamat': alamat,
                    'simluh_tahun_bentuk': simluh_tahun_bentuk,
                    'status': status,
                    'simluh_tahun_tap_kelas': simluh_tahun_tap_kelas,
                    'simluh_kelas_kemampuan': simluh_kelas_kemampuan,
                    'nilai_kelas': nilai_kelas,
                    'simluh_jenis_kelompok_perempuan': simluh_jenis_kelompok_perempuan,
                    'simluh_jenis_kelompok_domisili': simluh_jenis_kelompok_domisili,
                    'simluh_jenis_kelompok_upja': simluh_jenis_kelompok_upja,
                    'simluh_jenis_kelompok_p3a': simluh_jenis_kelompok_p3a,
                    'simluh_jenis_kelompok_lmdh': simluh_jenis_kelompok_lmdh,
                    'simluh_jenis_kelompok_penangkar': simluh_jenis_kelompok_penangkar,
                    'simluh_jenis_kelompok_kmp': simluh_jenis_kelompok_kmp,
                    'simluh_jenis_kelompok_umkm': simluh_jenis_kelompok_umkm,
                    'simluh_jenis_kelompok_tp': simluh_jenis_kelompok_tp,
                    'simluh_jenis_kelompok_bun': simluh_jenis_kelompok_bun,
                    'simluh_jenis_kelompok_hor': simluh_jenis_kelompok_hor,
                    'simluh_jenis_kelompok_nak': simluh_jenis_kelompok_nak,
                    'simluh_jenis_kelompok_olah': simluh_jenis_kelompok_olah,
                    'simluh_komo_lain_tp': simluh_komo_lain_tp,
                    'simluh_komo_lain_bun': simluh_komo_lain_bun,
                    'simluh_komo_lain_hor': simluh_komo_lain_hor,
                    'simluh_komo_lain_nak': simluh_komo_lain_nak,
                    'simluh_komo_lain_olah': simluh_komo_lain_olah,
                    'komTp': komTp
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
                    var id = $(this).data('id_poktan');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/KelompokTani/delete/' + id,
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
        $(document).delegate('#btnEditPok', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/KelompokTani/edit/' + $(this).data('id_poktan'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#id_poktan').val(result.id_poktan);
                    $('#kode_kec').val(result.kode_kec);
                    $('#kode_desa').val(result.kode_desa);
                    $('#kode_kab').val(result.kode_kab);
                    $('#kode_prop').val(result.kode_prop);
                    $('#id_gap').val(result.id_gap);
                    $('#nama_poktan').val(result.nama_poktan);
                    $('#ketua_poktan').val(result.ketua_poktan);
                    $('#alamat').val(result.alamat);
                    $('#year').val(result.simluh_tahun_bentuk);
                    $('#status').val(result.status);
                    $('#year2').val(result.simluh_tahun_tap_kelas);
                    $('#simluh_kelas_kemampuan').val(result.simluh_kelas_kemampuan);
                    $('#nilai_kelas').val(result.simluh_nilai_kelas);

                    if (result.simluh_jenis_kelompok_perempuan == "perempuan") {
                        $("#simluh_jenis_kelompok_perempuan").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_perempuan").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_domisili == "domisili") {
                        $("#simluh_jenis_kelompok_domisili").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_domisili").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_upja == "upja") {
                        $("#simluh_jenis_kelompok_upja").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_upja").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_p3a == "p3a") {
                        $("#simluh_jenis_kelompok_p3a").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_p3a").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_lmdh == "lmdh") {
                        $("#simluh_jenis_kelompok_lmdh").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_lmdh").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_penangkar == "penangkar") {
                        $("#simluh_jenis_kelompok_penangkar").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_penangkar").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_kmp == "kmp") {
                        $("#simluh_jenis_kelompok_kmp").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_kmp").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_umkm == "umkm") {
                        $("#simluh_jenis_kelompok_umkm").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_umkm").prop("checked", false);
                    }

                    if (result.simluh_jenis_kelompok_tp == "tp") {
                        $("#simluh_jenis_kelompok_tp").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_tp").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_bun == "bun") {
                        $("#simluh_jenis_kelompok_bun").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_bun").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_hor == "hor") {
                        $("#simluh_jenis_kelompok_hor").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_hor").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_nak == "nak") {
                        $("#simluh_jenis_kelompok_nak").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_nak").prop("checked", false);
                    }
                    if (result.simluh_jenis_kelompok_olah == "olah") {
                        $("#simluh_jenis_kelompok_olah").prop("checked", true);
                    } else {
                        $("#simluh_jenis_kelompok_olah").prop("checked", false);
                    }
                    $('#simluh_komo_lain_tp').val(result.simluh_komo_lain_tp);
                    $('#simluh_komo_lain_bun').val(result.simluh_komo_lain_bun);
                    $('#simluh_komo_lain_hor').val(result.simluh_komo_lain_hor);
                    $('#simluh_komo_lain_nak').val(result.simluh_komo_lain_nak);
                    $('#simluh_komo_lain_olah').val(result.simluh_komo_lain_olah);

                    $('#modal-form').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");

                    debugger;
                    $(document).delegate('#btnDoEdit', 'click', function() {

                        var id_poktan = $('#id_poktan').val();
                        var kode_kec = $('#kode_kec').val();
                        var kode_kab = $('#kode_kab').val();
                        var kode_desa = $('#kode_desa').val();
                        var kode_prop = $('#kode_prop').val();
                        var id_gap = $('#id_gap').val();
                        var nama_poktan = $('#nama_poktan').val();
                        var ketua_poktan = $('#ketua_poktan').val();
                        var alamat = $('#alamat').val();
                        var simluh_tahun_bentuk = $('#year').val();
                        var status = $('#status').val();
                        var simluh_tahun_tap_kelas = $('#year2').val();
                        var simluh_kelas_kemampuan = $('#simluh_kelas_kemampuan').val();
                        var nilai_kelas = $('#nilai_kelas').val();

                        var simluh_jenis_kelompok_perempuan = $(".simluh_jenis_kelompok_perempuan")[0].checked ? $(".simluh_jenis_kelompok_perempuan").val() : "";
                        var simluh_jenis_kelompok_domisili = $(".simluh_jenis_kelompok_domisili")[0].checked ? $(".simluh_jenis_kelompok_domisili").val() : "";
                        var simluh_jenis_kelompok_upja = $(".simluh_jenis_kelompok_upja")[0].checked ? $(".simluh_jenis_kelompok_upja").val() : "";
                        var simluh_jenis_kelompok_p3a = $(".simluh_jenis_kelompok_p3a")[0].checked ? $(".simluh_jenis_kelompok_p3a").val() : "";
                        var simluh_jenis_kelompok_lmdh = $(".simluh_jenis_kelompok_lmdh")[0].checked ? $(".simluh_jenis_kelompok_lmdh").val() : "";
                        var simluh_jenis_kelompok_penangkar = $(".simluh_jenis_kelompok_penangkar")[0].checked ? $(".simluh_jenis_kelompok_penangkar").val() : "";
                        var simluh_jenis_kelompok_kmp = $(".simluh_jenis_kelompok_kmp")[0].checked ? $(".simluh_jenis_kelompok_kmp").val() : "";
                        var simluh_jenis_kelompok_umkm = $(".simluh_jenis_kelompok_umkm")[0].checked ? $(".simluh_jenis_kelompok_umkm").val() : "";

                        var simluh_jenis_kelompok_tp = $(".simluh_jenis_kelompok_tp")[0].checked ? $(".simluh_jenis_kelompok_tp").val() : "";
                        var simluh_jenis_kelompok_bun = $(".simluh_jenis_kelompok_bun")[0].checked ? $(".simluh_jenis_kelompok_bun").val() : "";
                        var simluh_jenis_kelompok_hor = $(".simluh_jenis_kelompok_hor")[0].checked ? $(".simluh_jenis_kelompok_hor").val() : "";
                        var simluh_jenis_kelompok_nak = $(".simluh_jenis_kelompok_nak")[0].checked ? $(".simluh_jenis_kelompok_nak").val() : "";
                        var simluh_jenis_kelompok_olah = $(".simluh_jenis_kelompok_olah")[0].checked ? $(".simluh_jenis_kelompok_olah").val() : "";

                        var simluh_komo_lain_tp = $('#simluh_komo_lain_tp').val();
                        var simluh_komo_lain_bun = $('#simluh_komo_lain_bun').val();
                        var simluh_komo_lain_hor = $('#simluh_komo_lain_hor').val();
                        var simluh_komo_lain_nak = $('#simluh_komo_lain_nak').val();
                        var simluh_komo_lain_olah = $('#simluh_komo_lain_olah').val();

                        let formData = new FormData();
                        formData.append('id_poktan', id_poktan);
                        formData.append('kode_kec', kode_kec);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_desa', kode_desa);
                        formData.append('kode_prop', kode_prop);
                        formData.append('id_gap', id_gap);
                        formData.append('nama_poktan', nama_poktan);
                        formData.append('ketua_poktan', ketua_poktan);
                        formData.append('alamat', alamat);
                        formData.append('simluh_tahun_bentuk', simluh_tahun_bentuk);
                        formData.append('status', status);
                        formData.append('simluh_tahun_tap_kelas', simluh_tahun_tap_kelas);
                        formData.append('simluh_kelas_kemampuan', simluh_kelas_kemampuan);
                        formData.append('nilai_kelas', nilai_kelas);
                        formData.append('simluh_jenis_kelompok_perempuan', simluh_jenis_kelompok_perempuan);
                        formData.append('simluh_jenis_kelompok_domisili', simluh_jenis_kelompok_domisili);
                        formData.append('simluh_jenis_kelompok_upja', simluh_jenis_kelompok_upja);
                        formData.append('simluh_jenis_kelompok_p3a', simluh_jenis_kelompok_p3a);
                        formData.append('simluh_jenis_kelompok_lmdh', simluh_jenis_kelompok_lmdh);
                        formData.append('simluh_jenis_kelompok_penangkar', simluh_jenis_kelompok_penangkar);
                        formData.append('simluh_jenis_kelompok_kmp', simluh_jenis_kelompok_kmp);
                        formData.append('simluh_jenis_kelompok_umkm', simluh_jenis_kelompok_umkm);
                        formData.append('simluh_jenis_kelompok_tp', simluh_jenis_kelompok_tp);
                        formData.append('simluh_jenis_kelompok_bun', simluh_jenis_kelompok_bun);
                        formData.append('simluh_jenis_kelompok_hor', simluh_jenis_kelompok_hor);
                        formData.append('simluh_jenis_kelompok_nak', simluh_jenis_kelompok_nak);
                        formData.append('simluh_jenis_kelompok_olah', simluh_jenis_kelompok_olah);
                        formData.append('simluh_komo_lain_tp', simluh_komo_lain_tp);
                        formData.append('simluh_komo_lain_bun', simluh_komo_lain_bun);
                        formData.append('simluh_komo_lain_hor', simluh_komo_lain_hor);
                        formData.append('simluh_komo_lain_nak', simluh_komo_lain_nak);
                        formData.append('simluh_komo_lain_olah', simluh_komo_lain_olah);


                        if (kode_desa == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Desa Harus Di pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }


                        if (nama_poktan.length < 3) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Poktan Harus Diisi Minimal 3 Karakter",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }


                        if (ketua_poktan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Ketua Poktan Harus Diisi",
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
                                text: "Alamat Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (status == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Status Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/KelompokTani/update/' + id_poktan,
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
    $(document).ready(function() {
        const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        let qntYears = 80;
        let selectYear = $("#year2");
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

        for (var m = 1; m <= 12; m++) {
            let month = monthNames[m];
            let monthElem = document.createElement("option");
            monthElem.value = m;
            monthElem.textContent = month;
            selectMonth.append(monthElem);
        }

        var d = new Date();
        var month = d.getMonth();
        var year2 = d.getFullYear();
        var day = d.getDate();

        selectYear.val(year2);
        selectYear.on("change", AdjustDays);
        selectMonth.val(month);
        selectMonth.on("change", AdjustDays);

        AdjustDays();
        selectDay.val(day)

        function AdjustDays() {
            var year2 = selectYear.val();
            var month = parseInt(selectMonth.val()) + 1;
            selectDay.empty();

            //get the last day, so the number of days in that month
            var days = new Date(year2, month, 0).getDate();

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