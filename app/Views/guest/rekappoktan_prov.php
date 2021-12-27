<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Kelompok Tani Berdasarkan Jumlah Anggota Per Provinsi </h4>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=10 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=170 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rgprov as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <a href="<?= base_url('/rekap_genprovdetail?kode_prop=' . $item['kode_prop']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_prop'] ?></p>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</tbody>
</table>
</div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>


<?= $this->endSection() ?>