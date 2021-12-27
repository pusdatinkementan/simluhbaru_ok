<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Kelembagaan Penyuluhan Pertanian Tingkat Kecamatan </h4>
    <br>
    <h6 style="margin-top: -30px;">Provinsi <?= $namaprov; ?></h6>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Kecamatan</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah BP3k</td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $jum_bp3k = 0;
                foreach ($rkeluhkec as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['namakab']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jumbpp']; ?>
                            </p>
                        </td>
                    </tr>

                <?php
                    $jum_bp3k = $jum_bp3k + $item['jumbpp'];
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b>J U M L A H</b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_bp3k ?></b></p>
                    </th>
                </tr>
            </tfoot>
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