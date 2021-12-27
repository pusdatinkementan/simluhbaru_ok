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

            <table id="tblValPenyuluh" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIP</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dt as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row['nip']; ?></td>
                            <td><?= $row['noktp']; ?></td>
                            <td><?= $row['gelar_dpn'] . $row['nama'] . $row['gelar_blk']; ?></td>
                            <td><?= $row['tgl_lahir']; ?></td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalJab" id="btnEditJab" data-id="<?= $row['id'] ?>" class=" btn btn-warning btn-sm">Edit</button>
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
<div class="modal fade" id="modalJab" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit NIK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" name="nama" id="nama" disabled>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">NIP:</label>
                        <input type="text" class="form-control" name="nip" id="nip">
                        <input type="hidden" class="form-control" name="idpenyuluh" id="idpenyuluh">
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

        $('#tblValPenyuluh').DataTable();


        $(document).delegate('#btnEditJab', 'click', function() {
            $.ajax({
                url: '<?= base_url('Penyuluh/PenyuluhPns/editstatus') ?>/' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#nama').val(result.nama);
                    $('#nip').val(result.nip);
                    $('#idpenyuluh').val(result.id);

                    $('#modalJab').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");
                    $("#exampleModalLabel").text("Edit");

                    $(document).delegate('#btnDoEdit', 'click', function() {

                        if ($('#nip').val().length == 0) {
                            Swal.fire({
                                title: 'Gagal',
                                text: "NIP Tidak boleh kosong !",
                                type: 'Error',
                            });
                            return false;
                        }

                        if ($('#nip').val().length < 18 || $('#nip').val().length > 18) {
                            Swal.fire({
                                title: 'Gagal',
                                text: "NIP harus 18 digit !",
                                type: 'Error',
                            });
                            return false;
                        }


                        var id = $('#idpenyuluh').val();
                        var nip = $('#nip').val();

                        let formData = new FormData();
                        formData.append('id', id);
                        formData.append('nip', nip);

                        $.ajax({
                            url: '<?= base_url() ?>/validasi/penyuluh/doeditnip/' + id,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modalJab').modal('hide');
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


<?= $this->endSection() ?>