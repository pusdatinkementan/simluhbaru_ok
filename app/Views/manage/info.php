<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Page Heading -->
        <div class="row text-center mt-3">
            <h2><?= $title; ?></h2>
        </div>
        <hr>

        <div class="row mt-3">
            <div class="col-lg-2">
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalMenu">Tambah</button>
            </div>
            <table id="tblMenu" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Info</th>
                        <th scope="col">Tanggal Info</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dt_info as $row) {
                    ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['judul_info']; ?></td>
                            <td><?= $row['tgl_info']; ?></td>
                            <td><?= $row['status_info']; ?></td>
                            <td>
                                <button type="button" id="btnEditMenu" data-id="<?= $row['id_info']; ?>" class=" btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" id="btnHapusMenu" data-id="<?= $row['id_info']; ?>" type="button">Hapus</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('manage/menu/save'); ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Judul Info:</label>
                        <input type="text" class="form-control" name="judul_info" id="judul_info">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Deskripsi:</label>
                        <input type="text" class="form-control" name="desk_info" id="desk_info">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="text" class="form-control" name="tglinfo" id="tglinfo">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="dok" name="dok">
                        <label class="input-group-text" for="dok">Upload Dok</label>
                        <br>
                        <label for="infosize" class="input-group-text" style="text-align: right;  font-size: 8pt; font-style: italic;">Max Size 2 Mb </label>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Status Active ?
                            </label>
                        </div>
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

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#tblMenu').DataTable();

        //save

        $(document).delegate('#btnSave', 'click', function() {

            var menu = $('#menu').val();
            var menu = $('#menu').val();
            var menu = $('#menu').val();
            var menu = $('#menu').val();
            var menu = $('#menu').val();

            $.ajax({
                url: '<?= base_url('manage/menu/saveInfo/') ?>',
                type: 'POST',
                data: {
                    'menu': menu
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

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

        });

        //Update

        $(document).delegate('#btnEditMenu', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/manage/menu/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#idmenu').val(result.id);
                    $('#menu').val(result.menu);

                    $('#modalMenu').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#exampleModalLabel").text("Edit Menu");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        console.log('ok');

                        var idmenu = $('#idmenu').val();
                        var menu = $('#menu').val();

                        let formData = new FormData();
                        formData.append('idmenu', idmenu);
                        formData.append('menu', menu);

                        $.ajax({
                            url: '<?= base_url() ?>/manage/menu/update/' + idmenu,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modalMenu').modal('hide');
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

        $(document).delegate('#btnHapusMenu', 'click', function() {

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
                    $.ajax({
                        url: '<?= base_url() ?>/manage/menu/delete/' + $(this).data('id'),
                        type: 'GET',
                        data: {
                            'idmenu': $(this).data('id')
                        },
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

<?= $this->endSection() ?>