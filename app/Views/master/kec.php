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
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalKec">Tambah</button>
            </div>
            <table id="tblKec" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Kecamatan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dtkec as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['id_daerah']; ?></td>
                            <td><a class="btn btn-link" href="<?= base_url(); ?>/master/desa/index/<?= $row['id_daerah']; ?>"><?= $row['deskripsi']; ?></a></td>
                            <td>
                                <button type="button" id="btnEditKec" data-id="<?= $row['id_daerah'] ?>" class=" btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" id="btnHapusKec" data-id="<?= $row['id_daerah'] ?>" type="button">Hapus</button>

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
<div class="modal fade" id="modalKec" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kecamatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('master/kab/save'); ?>">
                    <div class="form-group">
                        <label for="idprov" class="col-form-label">Kode Provinsi:</label>
                        <input type="text" class="form-control" name="idprov" id="idprov" value="<?= $dtkec[0]['id_prop'] ?>" disabled>
                        <label for="idprov" class="col-form-label">Kode Kabupaten:</label>
                        <input type="text" class="form-control" name="idkab" id="idkab" value="<?= $dtkec[0]['id_dati2'] ?>" disabled>
                        <label for="idprov" class="col-form-label">Kode Kecamatan:</label>
                        <input type="text" class="form-control" name="idkec" id="idkec">
                        <label for="recipient-name" class="col-form-label">Nama Kecamatan:</label>
                        <input type="text" class="form-control" name="nmkec" id="nmkec">

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

        $('#tblKec').DataTable();
        // $(this).find('modalKec')[0].reset();
        $(document).delegate('#btnSave', 'click', function() {

            var nmkec = $('#nmkec').val();
            var idprov = $('#idprov').val();
            var idkab = $('#idkab').val();
            var idkec = $('#idkec').val();
            // debugger;
            $.ajax({
                url: '<?= base_url() ?>/master/kec/saveKecamatan/',
                type: 'POST',
                data: {
                    'nmkec': nmkec,
                    'idprov': idprov,
                    'idkab': idkab,
                    'idkec': idkec
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

        $(document).delegate('#btnEditKec', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/master/kec/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);
                    // res = result[0];
                    $('#idprov').val(result.id_prop);
                    $('#idkab').val(result.id_dati2);
                    $('#idkec').val(result.id_daerah);
                    $('#nmkec').val(result.deskripsi);

                    $('#modalKec').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#idprov").attr("disabled", "disabled");
                    $("#exampleModalLabel").text("Edit Kecamatan");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        var id = result.id;
                        var idprov = $('#idprov').val();
                        var idkab = $('#idkab').val();
                        var idkec = $('#idkec').val();
                        var nmkec = $('#nmkec').val();

                        let formData = new FormData();
                        formData.append('idprov', idprov);
                        formData.append('idkab', idkab);
                        formData.append('idkec', idkec);
                        formData.append('nmkec', nmkec);
                        // debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/master/kec/update/' + id,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                if (result == 'success') {
                                    $('#modalKec').modal('hide');
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

        $(document).delegate('#btnHapusKec', 'click', function() {

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
                        url: '<?= base_url() ?>/master/kec/delete/' + $(this).data('id'),
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