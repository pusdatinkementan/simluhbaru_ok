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
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalRole">Tambah</button>
            </div>
            <table id="tblAksesMenu" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role_name</th>
                        <th scope="col">Menu_name</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dt as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['role']; ?></td>
                            <td><?= $row['menu']; ?></td>
                            <td>
                                <button type="button" id="btnEditRole" data-id="<?= $row['aksesid'] ?>" class=" btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" id="btnHapusAkses" data-id="<?= $row['aksesid'] ?>" type="button">Hapus</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <?php echo view('layout/footer'); ?>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Role:</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Select Role</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['role_id']; ?>"><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Menu:</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>

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

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#tblAksesMenu').DataTable();

        $(document).delegate('#btnSave', 'click', function() {

            var role_id = $('#role_id').val();
            var menu_id = $('#menu_id').val();


            $.ajax({
                url: '<?= base_url('manage/rolemenu/akses_menu_save/') ?>',
                type: 'POST',
                data: {
                    'role_id': role_id,
                    'menu_id': menu_id
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

        $(document).delegate('#btnEditRole', 'click', function() {
            // debugger;
            $.ajax({
                url: '<?= base_url() ?>/manage/rolemenu/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);
                    $('#role_id').val(result.role_id);
                    $('#menu_id').val(result.menu_id);

                    $('#modalRole').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#exampleModalLabel").text("Edit Jabatan");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        // console.log('ok');
                        var role_id = $('#role_id').val();
                        var menu_id = $('#menu_id').val();

                        let formData = new FormData();
                        formData.append('role_id', role_id);
                        formData.append('menu_id', menu_id);
                        // debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/manage/rolemenu/updateRoleAccess/' + result.id,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modalRole').modal('hide');
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

        $(document).delegate('#btnHapusAkses', 'click', function() {

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
                        url: '<?= base_url() ?>/manage/rolemenu/deleteAkses/' + $(this).data('id'),
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

        })

    });
</script>


<?= $this->endSection() ?>