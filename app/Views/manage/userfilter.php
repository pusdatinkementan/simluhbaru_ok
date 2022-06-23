<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Page Heading -->
        <div class="row text-center mt-3">
            <h2><?= $title; ?></h2>
        </div>
        <hr>

        <div class="row" id="filter" style="">

            <div class="col-md-4">
                <form method="POST" action="<?php echo base_url('manage/filter'); ?>">
                    <label>Provinsi</label>

                    <div class="input-group mb-3">
                        <select name="filter_prov" id="filter_prov" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($prov as $row) {
                            ?>
                                <option value="<?= $row['id_prop']; ?>"><?= $row['nama_prop']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

            </div>
            <div class="col-md-4">
                <label>Kabupaten</label>
                <div class="input-group mb-3">
                    <select name="filter_kab" id="filter_kab" class="form-control">
                        <option value="">-- SEMUA --</option>

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label>Kecamatan</label>
                <div class="input-group mb-3">
                    <select name="filter_kec" id="filter_kec" class="form-control">
                        <option value="">-- SEMUA --</option>

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" name="filter_submit" class="btn bg-gradient-warning btn-sm">Filter</button>
            </div>
            </form>
        </div>

        <div class="row mt-3">
            <div class="col-lg-2">
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#newUserModal">Tambah</button>
            </div>
            <table id="tblUser" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Status</th>
                        <th scope="col">BPP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Satker</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dtsearch as $row) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['p_oke']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['namastatus']; ?></td>
                            <td><?= $row['nama_bpp']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['satminkal']; ?></td>
                            <td><button type="button" id="btnHapusUser" data-id="<?= $row['id']; ?>" class="btn btn-danger btn-xs">Hapus</button>
                                <button type="button" id="btnEditUser" data-id="<?= $row['id']; ?>" class="btn btn-primary btn-xs">Edit</button>
                                <button type="button" id="btnResetUser" data-id="<?= $row['id']; ?>" class="btn btn-warning btn-xs">Reset</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" class="form-control" id="namauser" name="namauser" placeholder="Nama User">
                    </div>
                    <div class="form-group">
                        <label for="prov">Provinsi</label>
                        <select name="prov" id="prov" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($prov as $row) {
                            ?>
                                <option value="<?= $row['id_prop']; ?>"><?= $row['nama_prop']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kab">Kabupaten</label>
                        <select name="kab" id="kab" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kec">Kecamatan</label>
                        <select name="kec" id="kec" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        <select name="desa" id="desa" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="tel">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Tel">
                    </div>
                    <div class="form-group">
                        <label for="mobile">HP</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Hp">
                    </div>

                    <div class="form-group">
                        <label for="nama">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($stsuser as $row) {
                            ?>
                                <option value="<?= $row['statusid']; ?>"><?= $row['name']; ?></option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="iduser" id="iduser">
                    <input type="hidden" class="form-control" id="created_at" name="created_at" value="<?php echo date('dmY:His'); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="resetPassword" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleresetPassword">Reset Password</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="newpass">New Password</label>
                    <input type="text" class="form-control" id="newPass" name="newPass" placeholder="New Password">
                </div>
                <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSavePass" class="btn btn-primary">Save</button>
            </div>
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
            // "serverSide": true, //Feature control DataTables' server-side processing mode.
            "ordering": true, // Set true agar bisa di sorting
            // "order": [], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            // Load data for the table's content from an Ajax source
            // "ajax": {
            //     "url": "<?php echo site_url('manage/user/ajax_user_list') ?>",
            //     //"url": "ajax_user_list",
            //     "type": "POST"
            // },`
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

        $(document).delegate('#btnResetUser', 'click', function() {
            // alert('reset');
            // alert($(this).data('id'));
            $('#resetPassword').modal('show');
            $.ajax({
                url: '<?= base_url() ?>/manage/user/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);                        
                    // $('#newPass').val(result.password);
                    $("#btnSavePass").attr("id", "btnDoEditPass");
                    $("#titleresetPassword").text("Reset Password");

                    $(document).delegate('#btnDoEditPass', 'click', function() {
                        var iduser = result.id;
                        var newpass = $('#newPass').val();
                        var updatedat = $('#updated_at').val();

                        let formData = new FormData();
                        formData.append('newpass', newpass);
                        formData.append('updatedat', updatedat);

                        debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/manage/user/updatepass/' + iduser,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
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
        });

        //save

        $(document).delegate('#btnSave', 'click', function() {

            var namauser = $('#namauser').val();
            var prov = $('#prov').val();
            var kab = $('#kab').val();
            var kec = $('#kec').val();
            var desa = $('#desa').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var phone = $('#phone').val();
            var mobile = $('#mobile').val();
            var status = $('#status').val();
            var is_active = $('#is_active').val();
            var joindate = $('#created_at').val();

            $.ajax({
                url: '<?= base_url() ?>/manage/user/saveUser/',
                type: 'POST',
                data: {
                    'username': username,
                    'password': password,
                    'name': namauser,
                    'joiningdate': joindate,
                    'status': status,
                    'phone': phone,
                    'mobile': mobile,
                    'idprop': prov,
                    'kodebakor': prov,
                    'kodebapel': kab,
                    'kodebpp': kec
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

        function setkodekab(kodekab) {

            var kdkabsub = kodekab.substring(0, 2);
            $.ajax({
                url: "<?= base_url() ?>/master/kab/edit/" + kdkabsub + "",
                type: "GET",
                dataType: "JSON",
                success: function(result) {
                    // console.log(result);
                    var dbSelect = $('#kab').html();
                    dbSelect = '';
                    dbSelect += '<option value=""> Pilih </option>';
                    for (var x = 0; x < result.length; x++) {
                        const kdkab = result[x].id_dati2;
                        //kdes2 = kodeeselon2.substring(0, 4) + '000000';
                        if (kdkab == kodekab) {
                            dbSelect += '<option value="' + result[x].id_dati2 + '" selected=selected>' + result[x].nama_dati2 + '</option>';
                        } else {
                            dbSelect += '<option value="' + result[x].id_dati2 + '">' + result[x].nama_dati2 + '</option>';
                        }
                    }
                    $("#kab").html(dbSelect);
                },
            });
        }

        function setkodekec(kodekec) {

            var kdkecsub = kodekec.substring(0, 4);
            $.ajax({
                url: "<?= base_url() ?>/master/wilayah/showKecJson/" + kdkecsub + "",
                type: "GET",
                dataType: "JSON",
                success: function(result) {
                    // console.log(result);
                    var dbSelect = $('#kec').html();
                    dbSelect = '';
                    dbSelect += '<option value=""> Pilih </option>';
                    for (var x = 0; x < result.length; x++) {
                        const kdkec = result[x].id_daerah;
                        //kdes2 = kodeeselon2.substring(0, 4) + '000000';
                        if (kdkec == kodekec) {
                            dbSelect += '<option value="' + result[x].id_daerah + '" selected=selected>' + result[x].deskripsi + '</option>';
                        } else {
                            dbSelect += '<option value="' + result[x].id_daerah + '">' + result[x].deskripsi + '</option>';
                        }
                    }
                    $("#kec").html(dbSelect);
                },
            });
        }

        $(document).delegate('#btnEditUser', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/manage/user/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);
                    $('#iduser').val(result.id);
                    $('#namauser').val(result.name);
                    $('#prov').val(result.idProp);
                    $('#kab').val(result.kodeBapel);
                    $('#kec').val(result.kodeBpp);
                    $('#username').val(result.username);
                    $('#password').val(result.p_oke);
                    $('#phone').val(result.phone);
                    $('#mobile').val(result.mobile);
                    $('#status').val(result.status);
                    $('#created_at').val(result.joiningdate);
                    $('#newUserModal').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#newSubMenuModalLabel").text("Edit User");

                    setkodekab(result.kodeBapel);
                    setkodekec(result.kodeBpp);

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        var iduser = $('#iduser').val();
                        var namauser = $('#namauser').val();
                        var prov = $('#prov').val();
                        var kab = $('#kab').val();
                        var kec = $('#kec').val();
                        var desa = $('#desa').val();
                        var username = $('#username').val();
                        var password = $('#password').val();
                        var phone = $('#phone').val();
                        var mobile = $('#mobile').val();
                        var status = $('#status').val();
                        var is_active = $('#is_active').val();
                        var joindate = $('#created_at').val();

                        let formData = new FormData();
                        formData.append('namauser', namauser);
                        formData.append('prov', prov);
                        formData.append('kab', kab);
                        formData.append('kec', kec);
                        formData.append('desa', desa);
                        formData.append('username', username);
                        formData.append('password', password);
                        formData.append('phone', phone);
                        formData.append('mobile', mobile);
                        formData.append('status', status);

                        debugger;

                        $.ajax({
                            url: '<?= base_url() ?>/manage/user/update/' + iduser,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {

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

        $(document).delegate('#btnHapusUser', 'click', function() {

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
                        url: '<?= base_url() ?>/manage/user/delete/' + $(this).data('id'),
                        type: 'GET',
                        data: {
                            'id': $(this).data('id')
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

        });

        $('#prov').on('change', function() {
            $('#kec').html('');
            $('#desa').html('');
            const id = $('#prov').val();
            var kdprov = id.substring(0, 2);

            $.ajax({
                url: "<?= base_url() ?>/master/wilayah/showKab/" + kdprov + "",
                success: function(response) {
                    console.log(response);
                    $("#kab").html(response);
                },
                dataType: "html"
            });
            return false;
        });


        $('#kab').on('change', function() {
            $('#desa').html('');
            const id = $('#kab').val();
            var kdkab = id.substring(0, 4);

            $.ajax({
                url: "<?= base_url() ?>/master/wilayah/showKec/" + kdkab + "",
                success: function(response) {
                    console.log(response);
                    $("#kec").html(response);
                },
                dataType: "html"
            });
            return false;
        });

        $('#kec').on('change', function() {

            const id = $('#kec').val();
            var kdkec = id.substring(0, 6);

            $.ajax({
                url: "<?= base_url() ?>/master/wilayah/showDesa/" + kdkec + "",
                success: function(response) {
                    $("#desa").html(response);
                },
                dataType: "html"
            });
            return false;
        });

    });


    $('#filter_prov').on('change', function() {
        $('#filter_kab').html('');
        $('#filter_kec').html('');
        const id = $('#filter_prov').val();
        var kdprov = id.substring(0, 2);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showKab/" + kdprov + "",
            success: function(response) {
                //console.log(response);
                $("#filter_kab").html(response);
            },
            dataType: "html"
        });
        return false;
    });


    $('#filter_kab').on('change', function() {
        $('#filter_kec').html('');
        const id = $('#filter_kab').val();
        var kdkab = id.substring(0, 4);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showKec/" + kdkab + "",
            success: function(response) {
                console.log(response);
                $("#filter_kec").html(response);
            },
            dataType: "html"
        });
        return false;
    });
</script>

<?= $this->endSection() ?>