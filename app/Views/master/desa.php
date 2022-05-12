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
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalDesa">Tambah</button>
            </div>
            <table id="tblDesa" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Desa</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dtdesa as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['id_desa']; ?></td>
                            <td><?= $row['nm_desa']; ?></td>
                            <td>
                                <button type="button" id="btnEditDesa" data-id="<?= $row['id'] ?>" class=" btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" id="btnHapusDesa" data-id="<?= $row['id'] ?>" type="button">Hapus</button>
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
<div class="modal fade" id="modalDesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Desa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('master/desa/save'); ?>">
                    <div class="form-group">
                        <label for="idprov" class="col-form-label">Kode Provinsi:</label>
                        <input type="text" class="form-control" name="idprov" id="idprov" value="<?= $dtkec->id_prop; ?>" disabled>
                        <label for="idprov" class="col-form-label">Kode Kabupaten:</label>
                        <input type="text" class="form-control" name="idkab" id="idkab" value="<?= $dtkec->id_dati2; ?>" disabled>
                        <label for="idprov" class="col-form-label">Kode Kecamatan:</label>
                        <input type="text" class="form-control" name="idkec" id="idkec" value="<?= $dtkec->id_daerah; ?>" disabled>
                        <label for="iddesa" class="col-form-label">Kode Desa:</label>
                        <input type="text" class="form-control" name="iddesa" id="iddesa">
                        <label for="recipient-name" class="col-form-label">Nama Desa:</label>
                        <input type="text" class="form-control" name="nmdesa" id="nmdesa">
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

        $('#tblDesa').DataTable();
        // $(this).find('modalDesa')[0].reset();
        $(document).delegate('#btnSave', 'click', function() {

            var nmdesa = $('#nmdesa').val();
            var idprov = $('#idprov').val();
            var idkab = $('#idkab').val();
            var idkec = $('#idkec').val();
            var iddesa = $('#iddesa').val();
            debugger;
            $.ajax({
                url: '<?= base_url("/Master/Desa/simpan/") ?>',
                type: 'POST',
                data: {
                    'nmdesa': nmdesa,
                    'idprov': idprov,
                    'idkab': idkab,
                    'idkec': idkec,
                    'iddesa': iddesa
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

        $(document).delegate('#btnEditDesa', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/master/desa/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);
                    // res = result[0];
                    $('#idprov').val(result.id_prop);
                    $('#idkab').val(result.id_dati2);
                    $('#idkec').val(result.id_daerah);
                    $('#iddesa').val(result.id_desa);
                    $('#nmdesa').val(result.nm_desa);

                    $('#modalDesa').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#idprov").attr("disabled", "disabled");
                    $("#exampleModalLabel").text("Edit Desa");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        var id = result.id;
                        var idprov = $('#idprov').val();
                        var idkab = $('#idkab').val();
                        var idkec = $('#idkec').val();
                        var iddesa = $('#iddesa').val();
                        var nmdesa = $('#nmdesa').val();

                        let formData = new FormData();
                        formData.append('idprov', idprov);
                        formData.append('idkab', idkab);
                        formData.append('idkec', idkec);
                        formData.append('iddesa', iddesa);
                        formData.append('nmdesa', nmdesa);
                        // debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/master/desa/update/' + id,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                if (result == 'success') {
                                    $('#modalDesa').modal('hide');
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

        $(document).delegate('#btnHapusDesa', 'click', function() {

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
                        url: '<?= base_url() ?>/master/desa/delete/' + $(this).data('id'),
                        type: 'GET',
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


<?= $this->endSection() ?>