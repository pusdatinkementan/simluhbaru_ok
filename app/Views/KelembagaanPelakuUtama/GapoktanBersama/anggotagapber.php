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
    <h2> Daftar Anggota Gapoktan Bersama <?= ucfirst($data_gapber['nama_gapoktan']); ?></h2>
</center>

<button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Data</button>
<div class="card">
    <div class="table-responsive">
        <table id="tblGapber" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Gapoktan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aksi</th>
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
                            <p class="text-xs font-weight-bold mb-0"><?= $row['nama_gapoktan'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">

                            <button type="button" data-id="<?= $row['id_anggota'] ?>" id="btnEdit" class="btn bg-gradient-warning btn-sm">
                                <i class="fas fa-edit"></i> Ubah
                            </button>
                            <button class="btn btn-danger btn-sm" id="btnHapus" data-id="<?= $row['id_anggota'] ?>" type="button">
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

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Gapoktan:</label>

                        <select name="idgap" id="idgap" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($dtgapoktan as $row) {

                            ?>
                                <option value="<?= $row['id_gap']; ?>"><?= $row['nama_gapoktan'] ?> ( <?= $row['ketua_gapoktan']; ?> )</option>
                            <?php } ?>

                        </select>

                        <input type="hidden" id="id_gap_ber" name="id_gap_ber" value="<?= $tabel_data[0]['id_gapber']; ?>">
                        <input type="hidden" id="created_at" name="created_at" value="<?= date('Y-m-d H:i:s'); ?>">

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSave" class="btn bg-gradient-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php echo view('layout/footer'); ?>
<br>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#tblGapber').DataTable();
        $(document).delegate('#btnSave', 'click', function() {

            var idgap = $('#idgap').val();
            var id_gap_ber = $('#id_gap_ber').val();
            var created_at = $('#created_at').val();

            if (idgap == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "GAPOKTAN Harus Di Pilih",
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
                url: '<?= base_url('/KelembagaanPelakuUtama/GapoktanBersama/AnggotaGapber/save'); ?>',
                type: 'POST',
                data: {
                    'idgap': idgap,
                    'id_gap_ber': id_gap_ber,
                    'created_at': created_at,
                    'updated_at': created_at,
                    'status_ang': 1
                },
                success: function(result) {
                    if (result == 'success') {
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
                            text: "Gagal tambah data",
                            type: 'error',
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
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
                    var id = $(this).data('id');
                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/ListJnsKel/delete/' + id,
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
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/ListJnsKel/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_poktan').val(result.id_poktan);
                    $('#idkel').val(result.id_jns_kel);
                    $('#created_at').val(result.volume);

                    $('#modal-form').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        var id_list = result.id_list;
                        var id_poktan = $('#id_poktan').val();
                        var idkel = $('#idkel').val();
                        var updated_at = $('#created_at').val();

                        let formData = new FormData();
                        formData.append('id_poktan', id_poktan);
                        formData.append('idkel', idkel);
                        formData.append('updated_at', updated_at);

                        if (idkel == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Jenis Kelompok Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelompokTani/ListJnsKel/update/' + id_list,
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