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
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenuModal">Tambah</button>
            </div>
            <table id="tblMenu" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dt as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['menu']; ?></td>
                            <td><?= $row['url']; ?></td>
                            <td><?= $row['icon']; ?></td>
                            <td><?= $row['is_active']; ?></td>
                            <td>
                                <button type="button" id="btnEditSubMenu" data-id="<?= $row['id'] ?>" class=" btn btn-warning btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" id="btnDeleteSubmenu" data-id="<?= $row['id'] ?>">Hapus</button>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('manage/menu/submenu_save'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Tambah</button>
                    <input type="hidden" class="form-control" id="submenuid" name="submenuid" placeholder="Submenu id">
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

            var judul = $('#title').val();
            var menu_id = $('#menu_id').val();
            var url = $('#url').val();
            var icon = $('#icon').val();
            var is_active = $('#is_active').val();

            //debugger;
            $.ajax({
                url: '<?= base_url('manage/menu/submenu_save') ?>',
                type: 'POST',
                data: {
                    'judul': judul,
                    'menu_id': menu_id,
                    'url': url,
                    'icon': icon,
                    'is_active': is_active
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

        $(document).delegate('#btnEditSubMenu', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/manage/menu/editsubmenu/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#submenuid').val(result.id);
                    $('#title').val(result.title);
                    $('#menu_id').val(result.menu_id);
                    $('#url').val(result.url);
                    $('#icon').val(result.icon);
                    $('#is_active').val(result.is_active);

                    $('#newSubMenuModal').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#newSubMenuModalLabel").text("Edit Sub Menu");
                    $("#btnDoEdit").text("Edit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        // console.log('ok');
                        var submenuid = $('#submenuid').val();
                        var judul = $('#title').val();
                        var menu_id = $('#menu_id').val();
                        var url = $('#url').val();
                        var icon = $('#icon').val();
                        var is_active = $('#is_active').val();

                        let formData = new FormData();
                        formData.append('menu_id', menu_id);
                        formData.append('judul', judul);
                        formData.append('submenuid', submenuid);
                        formData.append('url', url);
                        formData.append('icon', icon);
                        formData.append('is_active', is_active);
                        debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/manage/menu/submenu_update/' + submenuid,
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

        $(document).delegate('#btnDeleteSubmenu', 'click', function() {

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
                        url: '<?= base_url() ?>/manage/menu/deletesubmenu/' + $(this).data('id'),
                        type: 'GET',
                        data: {
                            'id': $(this).data('id')
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