<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Page Heading -->


        <div class="row">

            <nav class="col-lg-12">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
                </div>
            </nav>
            <div class="tab-content " id="nav-tabContent">
                <div class="tab-pane  fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-lg-9 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                                        <div class="col-lg-12">

                                            <table class="table">

                                                <tbody>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td><?= $dt['name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>:</td>
                                                        <td><?= $dt['status']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>username</td>
                                                        <td>:</td>
                                                        <td><?= $dt['username']; ?></td>
                                                    </tr>

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-lg-0 mb-4 text-center">
                            <div class="card">
                                <div class="card-body p-3 ">

                                    <img src="<?php if ($dt['fotoprofil'] == '') {
                                                    echo base_url('assets/img/logo.png');
                                                } else {
                                                    echo base_url('assets/img/' . $dt['fotoprofil']);
                                                }  ?>" width="150px" class="img-thumbnail" alt="profil">

                                </div>
                                <!-- <a href="<?= base_url('profil/lembaga/editfoto') ?>" class="btn btn-primary btn-lg w-100 btn-sm">Upload</a> -->
                                <button type="button" class="btn btn-primary btn-lg w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto" id="uploadbtn">Change Picture</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFoto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url('profil/Admin/saveFotoProfil'); ?>">


                        <div class="col-lg-3 mb-lg-0 text-center">
                            <div class="card">
                                <div class="card-body p-3">
                                    <img src="<?php if ($dt['fotoprofil'] == '') {
                                                    echo base_url('assets/img/logo.png');
                                                } else {
                                                    echo base_url('assets/img/' . $dt['fotoprofil']);
                                                }  ?>" width="150px" class="img-thumbnail" alt="profil">
                                </div>

                            </div>


                        </div>


                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="foto" name="foto">
                            <label class="input-group-text" for="foto">Pilih Foto</label>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnSave" class="btn bg-gradient-primary">Simpan</button>
                </div>
                </form>

            </div>

        </div>
    </div>
</div>
<?php echo view('layout/footer'); ?>

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script type="text/javascript">
    $('#uploadbtn').on('click', function() {
        $('#modalFoto').modal('show');
    })
</script>

<?= $this->endSection() ?>