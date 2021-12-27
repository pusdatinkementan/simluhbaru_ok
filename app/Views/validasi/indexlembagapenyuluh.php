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

            <table id="tblValLembaga" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">List Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">BPP Jumlah Penyuluh Kosong</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">BPP Jumlah Poktan Kosong</a></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">BPP Jumlah Gapoktan Kosong</a></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">BPP Tidak Ada Tanggal Pembentukan </a></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">BPP Tidak Ada Koordinat</a></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">kabupaten yang tidak punya koordinat dan tanggal pembentukan </a></td>
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

        $('#tblValLembaga').DataTable();

    });
</script>


<?= $this->endSection() ?>