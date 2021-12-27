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
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#newUserModal">Tambah</button>
            </div>
            <table id="tblUser" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">IdProp</th>
                        <th scope="col">kodeBakor</th>
                        <th scope="col">kodeBapel</th>
                        <th scope="col">kodeBpp</th>
                        <th scope="col">p_oke</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

            </table>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('manage/user/saveUser'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namauser" name="namauser" placeholder="Nama User">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="password" name="password" placeholder="password">
                    </div>

                    <select name="status" id="status" class="form-control">
                        <option value="3">Admin Pusat</option>
                    </select>

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

        //datatables
        var table = $('#tblUser').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "ordering": true, // Set true agar bisa di sorting
            "order": [], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('manage/user/ajax_user_list') ?>",
                //"url": "ajax_user_list",
                "type": "POST"
            },
            "aLengthMenu": [
                [5, 10, 50],
                [5, 10, 50]
            ], // Combobox Limit

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": true, //set not orderable
            }, ],
        });

        //save

        $(document).delegate('#btnSave', 'click', function() {

            var judul = $('#title').val();
            var menu_id = $('#menu_id').val();
            var url = $('#url').val();
            var icon = $('#icon').val();
            var is_active = $('#is_active').val();

            //debugger;
            $.ajax({
                url: '<?= base_url() ?>/manage/menu/submenu_save/',
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