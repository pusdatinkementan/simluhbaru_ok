<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $sessnama = session()->get('username'); ?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Page Heading -->
        <div class="row mt-3 mb-4">
            <h3>Selamat datang <?= $sessnama; ?></h3>

        </div>

        <div class="row">

            <!-- <nav class="col-lg-12">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
                </div>
            </nav>
            <div class="tab-content " id="nav-tabContent"> -->



        </div>
    </div>





</div>

<?php echo view('layout/footer'); ?>
<style>
    #chartdiv {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }
</style>

<?= $this->endSection() ?>



<?= $this->section('script') ?>

<?= $this->endSection() ?>