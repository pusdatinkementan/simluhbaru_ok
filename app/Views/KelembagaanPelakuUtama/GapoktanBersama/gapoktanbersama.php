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
    <h3>Daftar Gapoktan Bersama di Kabupaten <?= ucwords(strtolower($nama_kabupaten)) ?> </h3>
    <p>Data ditemukan <?= ucwords(strtolower($jum)) ?></p>
</center>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Data</button>

            <div class="card">
                <div class="table-responsive">
                    <table id="tblGapber" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Gapoktan Bersama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Ketua</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Bendahara</th>
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
                                                <?= $row['nama_gapoktan'] ?>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="<?= base_url('/anggotagapber?id=' . $row['id_gapber']) ?>"><i class="fas fa-plus"></i> Tambah Anggota Gapoktan Bersama</a>
                                                <a class="dropdown-item" data-id_gapber="<?= $row['id_gapber'] ?>" id="btnEditGapber" href="#"> <i class="fas fa-edit"></i> Ubah</a>
                                                <a class="dropdown-item" id="btnHapus" data-id_gapber="<?= $row['id_gapber'] ?>" href="#"><i class="fas fa-trash"></i> Hapus</a>
                                            </div>


                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['ketua_gapoktan'] ?></p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['simluh_bendahara'] ?></p>
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
                                            <form role="form text-left" action="<?= base_url('/KelembagaanPelakuUtama/GapoktanBersama/GapoktanBersama/save'); ?>" method="post" enctype="multipart/form-data">
                                                <? csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-5" mt-5>
                                                        <label>Nama Gapoktan Bersama</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="nama_gapoktan" name="nama_gapoktan" placeholder="Nama Gapoktan Bersama" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Nama Ketua</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="ketua_gapoktan" name="ketua_gapoktan" placeholder="Nama Ketua" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Nama Bendahara</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_bendahara" name="simluh_bendahara" placeholder="Nama Bendahara" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Nama Sekretaris</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_sekretaris" name="simluh_sekretaris" placeholder="Nama Sekretaris" aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <label>Alamat Sekretariat</label>
                                                        <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" aria-label="Password" aria-describedby="password-addon"></textarea>
                                                        <label>Tahun Pembentukan</label>
                                                        <div class="input-group mb-3">
                                                            <select id="year" class="form-select" aria-label="Default select example" name="simluh_tahun_bentuk">
                                                                <option selected>Pilih Tahun</option>

                                                            </select>
                                                        </div>
                                                        <label>SK Pengukuhan</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-select" id="simluh_sk_pengukuhan" name="simluh_sk_pengukuhan" aria-label="Default select example">
                                                                <option selected>Pilih </option>
                                                                <option value="ada">Ada</option>
                                                                <option value="tidak">Tidak</option>
                                                            </select>
                                                        </div>

                                                        <label>Unit Usaha</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_usaha_saprodi" type="checkbox" value="saprodi" name="simluh_usaha_saprodi" id="simluh_usaha_saprodi">
                                                            <label class="form-check-label" for="simluh_usaha_saprodi">
                                                                Sarana dan Prasarana Produksi
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_usaha_pemasaran" type="checkbox" value="pemasaran" name="simluh_usaha_pemasaran" id="simluh_usaha_pemasaran">
                                                            <label class="form-check-label" for="simluh_usaha_pemasaran">
                                                                Pemasaran
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_usaha_simpan_pinjam" type="checkbox" value="simpan_pinjam" name="simluh_usaha_simpan_pinjam" id="simluh_usaha_simpan_pinjam">
                                                            <label class="form-check-label" for="simluh_usaha_simpan_pinjam">
                                                                Keuangan Mikro / Simpan Pinjam
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input simluh_usaha_jasa_lain" type="checkbox" value="jasa_lain" name="simluh_usaha_jasa_lain" id="simluh_usaha_jasa_lain">
                                                            <label class="form-check-label" for="simluh_usaha_jasa_lain">
                                                                Jasa Lainnya
                                                            </label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="simluh_usaha_jasa_lain_desc" name="simluh_usaha_jasa_lain_desc" placeholder="">
                                                        </div>

                                                    </div>
                                                    <div class="col">

                                                        <label>Usaha Tani</label>
                                                        <div class="input-group mb-3">
                                                            <select name="simluh_usaha_tani" id="simluh_usaha_tani" class="form-control input-lg">
                                                                <option value="">Pilih Usaha</option>
                                                                <?php
                                                                foreach ($usahatani as $row2) {
                                                                    echo '<option value="' . $row2["id_kom_general"] . '">' . $row2["nama_komoditas"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>Usaha Olah</label>
                                                        <div class="input-group mb-3">
                                                            <select name="simluh_usaha_olah" id="simluh_usaha_olah" class="form-control input-lg">
                                                                <option value="">Pilih Usaha</option>
                                                                <?php
                                                                foreach ($usahaolah as $row3) {
                                                                    echo '<option value="' . $row3["id_kom_general"] . '">' . $row3["nama_komoditas"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>Alat dan Mesin Pertanian Yang Dimiliki</label>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Traktor</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_alsin_traktor" name="simluh_alsin_traktor" placeholder="isi dengan angka">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Hand Traktor</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_alsin_hand_tractor" name="simluh_alsin_hand_tractor" placeholder="isi dengan angka">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Pompa Air</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_alsin_pompa_air" name="simluh_alsin_pompa_air" placeholder="isi dengan angka">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Mesin Penggiling Padi</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_penggiling_padi" name="simluh_penggiling_padi" placeholder="isi dengan angka">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Mesin Pengering</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_alsin_pengering" name="simluh_alsin_pengering" placeholder="isi dengan angka">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Mesin Pencacah</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_alsin_chooper" name="simluh_alsin_chooper" placeholder="isi dengan angka">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label style="margin-top : 10px;" class="form-check-label">Lainnya</label>
                                                            <input type="text" style="margin-left : 10px;" class="form-control" id="simluh_alsin_lain_desc" name="simluh_alsin_lain_desc" placeholder="isi dengan nama alsin">
                                                            <input type="text" style="margin-left : 10px;" class="form-control rupiah" id="simluh_alsin_lain" name="simluh_alsin_lain" placeholder="isi dengan angka">
                                                        </div>

                                                    </div>
                                                </div>

                                                <input type="hidden" id="kode_kab" name="kode_kab" value="<?= $kode_kab; ?>">
                                                <input type="hidden" id="kode_prop" name="kode_prop" value="<?= $kode_prop; ?>">

                                                <input type="hidden" id="id_gapber" name="id_gapber">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-round bg-gradient-secondary" data-bs-dismiss="modal">Close</button>


                                                    <button type="button" id="btnSave" class="btn btn-round bg-gradient-info btn-sm">Simpan Data</button>
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

        $('#tblGapber').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
        $(document).delegate('#btnSave', 'click', function() {
            var kode_prop = $('#kode_prop').val();
            var kode_kec = $('#kode_kec').val();
            var kode_kab = $('#kode_kab').val();
            var kode_desa = $('#kode_desa').val();
            var nama_gapoktan = $('#nama_gapoktan').val();
            var ketua_gapoktan = $('#ketua_gapoktan').val();
            var alamat = $('#alamat').val();
            var simluh_tahun_bentuk = $('#year').val();
            var simluh_sk_pengukuhan = $('#simluh_sk_pengukuhan').val();
            var simluh_bendahara = $('#simluh_bendahara').val();
            var simluh_sekretaris = $('#simluh_sekretaris').val();
            var simluh_usaha_tani = $('#simluh_usaha_tani').val();
            var simluh_usaha_olah = $('#simluh_usaha_olah').val();

            var simluh_usaha_saprodi = $(".simluh_usaha_saprodi")[0].checked ? $(".simluh_usaha_saprodi").val() : "";
            var simluh_usaha_pemasaran = $(".simluh_usaha_pemasaran")[0].checked ? $(".simluh_usaha_pemasaran").val() : "";
            var simluh_usaha_simpan_pinjam = $(".simluh_usaha_simpan_pinjam")[0].checked ? $(".simluh_usaha_simpan_pinjam").val() : "";
            var simluh_usaha_jasa_lain = $(".simluh_usaha_jasa_lain")[0].checked ? $(".simluh_usaha_jasa_lain").val() : "";
            var simluh_usaha_jasa_lain_desc = $('#simluh_usaha_jasa_lain_desc').val();

            var simluh_alsin_traktor = $('#simluh_alsin_traktor').val();
            var simluh_alsin_hand_tractor = $('#simluh_alsin_hand_tractor').val();
            var simluh_alsin_pompa_air = $('#simluh_alsin_pompa_air').val();
            var simluh_alsin_penggiling_padi = $('#simluh_alsin_penggiling_padi').val();
            var simluh_alsin_pengering = $('#simluh_alsin_pengering').val();
            var simluh_alsin_chooper = $('#simluh_alsin_chooper').val();
            var simluh_alsin_lain_desc = $('#simluh_alsin_lain_desc').val();
            var simluh_alsin_lain = $('#simluh_alsin_lain').val();

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
            if (nama_gapoktan.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama Gapoktan Bersama Harus Diisi",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            if (ketua_gapoktan.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Ketua Gapoktan Harus Diisi",
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

            if (year == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Tahun Pembentukan Harus Di Pilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (simluh_sk_pengukuhan == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "SK Harus Di Pilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }




            $.ajax({
                url: '<?= base_url('/KelembagaanPelakuUtama/GapoktanBersama/GapoktanBersama/save'); ?>',
                type: 'POST',
                data: {
                    'kode_prop': kode_prop,
                    'kode_kec': kode_kec,
                    'kode_kab': kode_kab,
                    'kode_desa': kode_desa,
                    'nama_gapoktan': nama_gapoktan,
                    'ketua_gapoktan': ketua_gapoktan,
                    'alamat': alamat,
                    'simluh_tahun_bentuk': simluh_tahun_bentuk,
                    'simluh_sk_pengukuhan': simluh_sk_pengukuhan,
                    'simluh_sekretaris': simluh_sekretaris,
                    'simluh_bendahara': simluh_bendahara,
                    'simluh_usaha_tani': simluh_usaha_tani,
                    'simluh_usaha_olah': simluh_usaha_olah,

                    'simluh_usaha_saprodi': simluh_usaha_saprodi,
                    'simluh_usaha_pemasaran': simluh_usaha_pemasaran,
                    'simluh_usaha_simpan_pinjam': simluh_usaha_simpan_pinjam,
                    'simluh_usaha_jasa_lain': simluh_usaha_jasa_lain,
                    'simluh_usaha_jasa_lain_desc': simluh_usaha_jasa_lain_desc,


                    'simluh_alsin_traktor': simluh_alsin_traktor,
                    'simluh_alsin_hand_tractor': simluh_alsin_hand_tractor,
                    'simluh_alsin_pompa_air': simluh_alsin_pompa_air,
                    'simluh_alsin_penggiling_padi': simluh_alsin_penggiling_padi,
                    'simluh_alsin_pengering': simluh_alsin_pengering,
                    'simluh_alsin_chooper': simluh_alsin_chooper,
                    'simluh_alsin_lain_desc': simluh_alsin_lain_desc,
                    'simluh_alsin_lain': simluh_alsin_lain,

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
                    var id_gapber = $(this).data('id_gapber');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/GapoktanBersama/GapoktanBersama/delete/' + id_gapber,
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
        $(document).delegate('#btnEditGapber', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/GapoktanBersama/GapoktanBersama/edit/' + $(this).data('id_gapber'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_gapber').val(result.id_gapber);
                    $('#kode_kec').val(result.kode_kec);
                    $('#kode_prop').val(result.kode_prop);
                    $('#kode_desa').val(result.kode_desa);
                    $('#kode_kab').val(result.kode_kab);
                    $('#nama_gapoktan').val(result.nama_gapoktan);
                    $('#ketua_gapoktan').val(result.ketua_gapoktan);
                    $('#alamat').val(result.alamat);
                    $('#year').val(result.simluh_tahun_bentuk);
                    $('#simluh_sk_pengukuhan').val(result.simluh_sk_pengukuhan);
                    $('#simluh_bendahara').val(result.simluh_bendahara);
                    $('#simluh_sekretaris').val(result.simluh_sekretaris);
                    $('#simluh_usaha_tani').val(result.simluh_usaha_tani);
                    $('#simluh_usaha_olah').val(result.simluh_usaha_olah);

                    if (result.simluh_usaha_saprodi == "saprodi") {
                        $("#simluh_usaha_saprodi").prop("checked", true);
                    } else {
                        $("#simluh_usaha_saprodi").prop("checked", false);
                    }
                    if (result.simluh_usaha_pemasaran == "pemasaran") {
                        $("#simluh_usaha_pemasaran").prop("checked", true);
                    } else {
                        $("#simluh_usaha_pemasaran").prop("checked", false);
                    }
                    if (result.simluh_usaha_simpan_pinjam == "simpan_pinjam") {
                        $("#simluh_usaha_simpan_pinjam").prop("checked", true);
                    } else {
                        $("#simluh_usaha_simpan_pinjam").prop("checked", false);
                    }
                    if (result.simluh_usaha_jasa_lain == "jasa_lain") {
                        $("#simluh_usaha_jasa_lain").prop("checked", true);
                    } else {
                        $("#simluh_usaha_jasa_lain").prop("checked", false);
                    }
                    $('#simluh_usaha_jasa_lain_desc').val(result.simluh_usaha_jasa_lain_desc);

                    $('#simluh_alsin_traktor').val(result.simluh_alsin_traktor);
                    $('#simluh_alsin_hand_tractor').val(result.simluh_alsin_hand_tractor);
                    $('#simluh_alsin_pompa_air').val(result.simluh_alsin_pompa_air);
                    $('#simluh_alsin_pengering').val(result.simluh_alsin_pengering);
                    $('#simluh_alsin_penggiling_padi').val(result.simluh_alsin_penggiling_padi);
                    $('#simluh_alsin_chooper').val(result.simluh_alsin_chooper);
                    $('#simluh_alsin_lain_desc').val(result.simluh_alsin_lain_desc);
                    $('#simluh_alsin_lain').val(result.simluh_alsin_lain);


                    $('#modal-form').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {


                        var id_gapber = $('#id_gapber').val();
                        var kode_kec = $('#kode_kec').val();
                        var kode_prop = $('#kode_prop').val();
                        var kode_kab = $('#kode_kab').val();
                        var kode_desa = $('#kode_desa').val();
                        var nama_gapoktan = $('#nama_gapoktan').val();
                        var ketua_gapoktan = $('#ketua_gapoktan').val();
                        var alamat = $('#alamat').val();
                        var simluh_tahun_bentuk = $('#year').val();
                        var simluh_sekretaris = $('#simluh_sekretaris').val();
                        var simluh_bendahara = $('#simluh_bendahara').val();
                        var simluh_sk_pengukuhan = $('#simluh_sk_pengukuhan').val();
                        var simluh_usaha_tani = $('#simluh_usaha_tani').val();
                        var simluh_usaha_olah = $('#simluh_usaha_olah').val();

                        var simluh_usaha_saprodi = $(".simluh_usaha_saprodi")[0].checked ? $(".simluh_usaha_saprodi").val() : "";
                        var simluh_usaha_pemasaran = $(".simluh_usaha_pemasaran")[0].checked ? $(".simluh_usaha_pemasaran").val() : "";
                        var simluh_usaha_simpan_pinjam = $(".simluh_usaha_simpan_pinjam")[0].checked ? $(".simluh_usaha_simpan_pinjam").val() : "";
                        var simluh_usaha_jasa_lain = $(".simluh_usaha_jasa_lain")[0].checked ? $(".simluh_usaha_jasa_lain").val() : "";
                        var simluh_usaha_jasa_lain_desc = $('#simluh_usaha_jasa_lain_desc').val();

                        var simluh_alsin_traktor = $('#simluh_alsin_traktor').val();
                        var simluh_alsin_hand_tractor = $('#simluh_alsin_hand_tractor').val();
                        var simluh_alsin_pompa_air = $('#simluh_alsin_pompa_air').val();
                        var simluh_alsin_penggiling_padi = $('#simluh_alsin_penggiling_padi').val();
                        var simluh_alsin_pengering = $('#simluh_alsin_pengering').val();
                        var simluh_alsin_chooper = $('#simluh_alsin_chooper').val();
                        var simluh_alsin_lain_desc = $('#simluh_alsin_lain_desc').val();
                        var simluh_alsin_lain = $('#simluh_alsin_lain').val();


                        let formData = new FormData();
                        formData.append('id_gapber', id_gapber);
                        formData.append('kode_kec', kode_kec);
                        formData.append('kode_prop', kode_prop);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_desa', kode_desa);
                        formData.append('nama_gapoktan', nama_gapoktan);
                        formData.append('ketua_gapoktan', ketua_gapoktan);
                        formData.append('alamat', alamat);
                        formData.append('simluh_tahun_bentuk', simluh_tahun_bentuk);
                        formData.append('simluh_bendahara', simluh_bendahara);
                        formData.append('simluh_sekretaris', simluh_sekretaris);
                        formData.append('simluh_usaha_tani', simluh_usaha_tani);
                        formData.append('simluh_usaha_olah', simluh_usaha_olah);
                        formData.append('simluh_sk_pengukuhan', simluh_sk_pengukuhan);

                        formData.append('simluh_usaha_saprodi', simluh_usaha_saprodi);
                        formData.append('simluh_usaha_pemasaran', simluh_usaha_pemasaran);
                        formData.append('simluh_usaha_simpan_pinjam', simluh_usaha_simpan_pinjam);
                        formData.append('simluh_usaha_jasa_lain', simluh_usaha_jasa_lain);
                        formData.append('simluh_usaha_jasa_lain_desc', simluh_usaha_jasa_lain_desc);
                        formData.append('simluh_alsin_traktor', simluh_alsin_traktor);
                        formData.append('simluh_alsin_hand_tractor', simluh_alsin_hand_tractor);
                        formData.append('simluh_alsin_pompa_air', simluh_alsin_pompa_air);
                        formData.append('simluh_alsin_penggiling_padi)', simluh_alsin_penggiling_padi);
                        formData.append('simluh_alsin_chooper', simluh_alsin_chooper);
                        formData.append('simluh_alsin_lain_desc', simluh_alsin_lain_desc);
                        formData.append('simluh_alsin_lain', simluh_alsin_lain);
                        formData.append('simluh_alsin_pengering', simluh_alsin_pengering);
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
                        if (nama_gapoktan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Gapoktan Bersama Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (ketua_gapoktan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Ketua Gapoktan Harus Diisi",
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

                        if (year == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Tahun Pembentukan Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (simluh_sk_pengukuhan == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "SK Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/GapoktanBersama/GapoktanBersama/update/' + id_gapber,
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
<?= $this->endSection() ?>