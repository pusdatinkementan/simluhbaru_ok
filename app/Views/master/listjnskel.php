<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<center>
    <h2> Daftar Jenis Kelompok Lainnya </h2>
</center>

<div class="col-lg-2">
    <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalKel">Tambah</button>
</div>
<div class="card">
    <div class="table-responsive">
        <table id="tblJnsKel" class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Jenis Kelompok</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($dtkegiatan as $row) {
                ?>
                    <tr>
                        <td scope="row">
                            <?= $i++ ?>
                        </td>

                        <td>
                            <?= $row['id_kel'] ?>
                        </td>
                        <td>
                            <?= $row['jns_kel'] ?>
                        </td>
                        <td>
                            <button type="button" id="btnEdit" data-id="<?= $row['id_kel'] ?>" class=" btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm" id="btnHapus" data-id="<?= $row['id_kel'] ?>" type="button">Hapus</button>

                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php echo view('layout/footer'); ?>

<div class="modal fade" id="modalKel" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Provinsi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('master/PoktanJnskel/save'); ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Jenis Kelompok:</label>
                        <input type="text" class="form-control" name="jnskelompok" id="jnskelompok">
                        <input type="hidden" class="form-control" name="created_at" id="created_at" value="<?= date('Y-m-d'); ?>">
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

<br>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#tblJnsKel').DataTable();

        $(document).delegate('#btnSave', 'click', function() {

            var jnskelompok = $('#jnskelompok').val();
            var created_at = $('#created_at').val();
            // debugger;
            $.ajax({
                url: '<?= base_url('master/PoktanJnskel/save/') ?>',
                type: 'POST',
                data: {
                    'jnskelompok': jnskelompok,
                    'created_at': created_at
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

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

        });

        $(document).delegate('#btnEdit', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/master/PoktanJnskel/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#jnskelompok').val(result.jns_kel);
                    $('#created_at').val(result.created_at);

                    $('#modalKel').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#exampleModalLabel").text("Edit Jenis Kelompok");

                    $(document).delegate('#btnDoEdit', 'click', function() {

                        var idkel = result.id_kel;
                        var jnskelompok = $('#jnskelompok').val();
                        var updated_at = $('#created_at').val();

                        let formData = new FormData();
                        formData.append('idkel', idkel);
                        formData.append('jnskelompok', jnskelompok);
                        formData.append('updated_at', updated_at);
                        debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/master/PoktanJnskel/update/' + idkel,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                if (result == 'success') {
                                    $('#modalKel').modal('hide');
                                    Swal.fire({
                                        title: 'Sukses',
                                        text: "Sukses edit data",
                                        type: 'success',
                                    }).then((result) => {

                                        if (result.value) {
                                            location.reload();
                                        }
                                    });
                                } else {
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
                    debugger;
                    $.ajax({
                        url: '<?= base_url() ?>/master/PoktanJnskel/delete/' + $(this).data('id'),
                        type: 'GET',
                        data: {
                            'idkel': $(this).data('id')
                        },
                        success: function(result) {
                            if (result == 'success') {
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses hapus data",
                                    type: 'success',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
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

        })

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