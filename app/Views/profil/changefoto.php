<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Page Heading -->
        <div class="row mt-3 mb-4">
            <?= $validation->listErrors(); ?>
            <form method="POST" enctype="multipart/form-data" action="<?= base_url('profil/lembaga/saveProfil'); ?>">

                <div class="col-lg-3 mb-lg-0 text-center">
                    <div class="card">
                        <div class="card-body p-3">
                            <img src="<?= base_url('assets/img/logo.png'); ?>" width="150px" class="img-thumbnail" alt="profil">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nama </label>
                    <input type="text" class="form-control <?= ($validation->hasError('nameTxt')) ? 'is-invalid' : ''; ?>" name="nameTxt" id="nameTxt" autofocus>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto">
                    <label class="input-group-text" for="foto">Pilih Foto</label>
                </div>


        </div>
        <div class="modal-footer">
            <button type="submit" id="btnSave" class="btn bg-gradient-primary">Simpan</button>
        </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>