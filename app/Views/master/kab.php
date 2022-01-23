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
                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalProv">Tambah</button>
            </div>
            <table id="tblProv" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Kab</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dtkab as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['id_dati2']; ?></td>
                            <td><a href="<?= base_url(); ?>/master/kec/index/<?= $row['id_dati2']; ?>"><?= $row['nama_dati2']; ?></a></td>
                            <td>
                                <button type="button" id="btnEditKab" data-id="<?= $row['id_dati2'] ?>" class=" btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" id="btnHapusKab" data-id="<?= $row['id_dati2'] ?>" type="button">Hapus</button>

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
<div class="modal fade" id="modalProv" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kabupaten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('master/kab/save'); ?>">
                    <div class="form-group">
                        <label for="idprov" class="col-form-label">Kode Provinsi:</label>
                        <input type="text" class="form-control" name="idprov" id="idprov" value="<?= $nmprov[0]['id_prop']; ?>" disabled>
                        <label for="idprov" class="col-form-label">Kode Kabupaten:</label>
                        <input type="text" class="form-control" name="idkab" id="idkab">
                        <label for="recipient-name" class="col-form-label">Nama Kabupaten:</label>
                        <input type="text" class="form-control" name="nmkab" id="nmkab">
                        <!-- <input type="hidden" class="form-control" name="idkab1" id="idkab1" value="<?= $dtkab[0]['id_dati2']; ?>"> -->
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

        $('#tblProv').DataTable();
        // $(this).find('modalProv')[0].reset();
        $(document).delegate('#btnSave', 'click', function() {

            var nmkab = $('#nmkab').val();
            var idprov = $('#idprov').val();
            var idkab = $('#idkab').val();

            $.ajax({
                url: '<?= base_url() ?>/master/kab/save/',
                type: 'POST',
                data: {
                    'nmkab': nmkab,
                    'idprov': idprov,
                    'idkab': idkab
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

        $(document).delegate('#btnEditKab', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/master/kab/edit/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);
                    res = result[0];
                    $('#idprov').val(res.id_prop);
                    $('#idkab').val(res.id_dati2);
                    $('#nmkab').val(res.nama_dati2);

                    $('#modalProv').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#idprov").attr("disabled", "disabled");
                    $("#exampleModalLabel").text("Edit Kabupaten");

                    $(document).delegate('#btnDoEdit', 'click', function() {

                        var idprov = $('#idprov').val();
                        var idkab = $('#idkab').val();
                        var nmkab = $('#nmkab').val();
                        var idati2 = res.id_dati2

                        let formData = new FormData();
                        formData.append('idprov', idprov);
                        formData.append('idkab', idkab);
                        formData.append('nmkab', nmkab);
                        debugger;
                        $.ajax({
                            url: '<?= base_url() ?>/master/kab/update/' + idati2,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                if (result == 'success') {
                                    $('#modalProv').modal('hide');
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

        $(document).delegate('#btnHapusKab', 'click', function() {

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
                        url: '<?= base_url() ?>/master/kab/delete/' + $(this).data('id'),
                        type: 'GET',
                        data: {
                            'idkab': $(this).data('id')
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


<?= $this->endSection() ?>