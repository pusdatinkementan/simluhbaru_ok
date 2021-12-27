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

            <table id="tblValGap" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">List Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a href="<?= base_url('validasi/penyuluh/nik'); ?>">Gapoktan yang tidak mempunyai SK</a></td>
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

        $('#tblValGap').DataTable();

    });
</script>


<?= $this->endSection() ?>