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
                        <th scope="col">No</th>
                        <th scope="col">List Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">NIK kosong, tidak sesuai standar dan nik yang tidak terdaftar di dukcapil</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nohp'); ?>">No HP kosong</a></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nip'); ?>">Penyuluh PNS yang tidak punya nip/tidak valid</a></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nip'); ?>">Penyuluh yang belum mendapatkan pelatihan</a></td>
                    </tr>
                </tbody>
            </table>

        </div>

        <?php echo view('layout/footer'); ?>

    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#tblValPenyuluh').DataTable();
    });
</script>


<?= $this->endSection() ?>