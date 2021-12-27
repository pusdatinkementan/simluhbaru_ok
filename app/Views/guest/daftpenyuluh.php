<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Data Dasar Penyuluh Pertanian</h4>
    <h5>BP3K (<?= $nama_bpp; ?>)</h5>
</center>

<?php
$tanggal_today = date('d');
$bulan_today = date('m');
$tahun_today = date('Y'); ?>
<p class="text-xs font-weight-bold mb-0">Per : <?= $tanggal_today . '-' . $bulan_today . '-' . $tahun_today; ?></p>
<br>
<div class="card">

    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td colspan="6" align="center"><b>Penyuluh Pertanian PNS (Aktif)</b></td>
                <tr>
                    <td width=10 class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh</td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Wil Kerja(desa)</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Email</b></td>

                    <td width=150 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Tgl Update</b></td>

                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($pns as $row => $item) {

                ?>
                    <tr>
                        <td class="align-middle text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['gelar_dpn'] . ' ' . $item['nama'] . ' ' . $item['gelar_blk']; ?> </p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['wilker']; ?><br>- <?= $item['wilker2']; ?><br>- <?= $item['wilker3']; ?><br>- <?= $item['wilker4']; ?><br>- <?= $item['wilker5']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['hp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['email']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_update']; ?></p>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td colspan="6" align="center"><b>Penyuluh Pertanian PPPK</b></td>
                <tr>
                    <td width=10 class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh</td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Wil Kerja(desa)</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Email</b></td>

                    <td width=150 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Tgl Update</b></td>

                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($p3k as $row => $item) {

                ?>
                    <tr>
                        <td class="align-middle text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['gelar_dpn'] . ' ' . $item['nama'] . ' ' . $item['gelar_blk']; ?> </p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['wilker']; ?><br>- <?= $item['wilker2']; ?><br>- <?= $item['wilker3']; ?><br>- <?= $item['wilker4']; ?><br>- <?= $item['wilker5']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['hp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['email']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_update']; ?></p>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td colspan="6" align="center"><b>Penyuluh Pertanian PPPK</b></td>
                <tr>
                    <td width=10 class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh</td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Wil Kerja(desa)</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Email</b></td>

                    <td width=150 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Tgl Update</b></td>

                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($thl_apbn as $row => $item) {

                ?>
                    <tr>
                        <td class="align-middle text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama']; ?> </p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['wilker']; ?><br>- <?= $item['wilker2']; ?><br>- <?= $item['wilker3']; ?><br>- <?= $item['wilker4']; ?><br>- <?= $item['wilker5']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['telp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['email']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_update']; ?></p>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td colspan="6" align="center"><b>Penyuluh Pertanian PPPK</b></td>
                <tr>
                    <td width=10 class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh</td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Wil Kerja(desa)</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Email</b></td>

                    <td width=150 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Tgl Update</b></td>

                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($thl_apbd as $row => $item) {

                ?>
                    <tr>
                        <td class="align-middle text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama']; ?> </p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['wilker']; ?><br>- <?= $item['wilker2']; ?><br>- <?= $item['wilker3']; ?><br>- <?= $item['wilker4']; ?><br>- <?= $item['wilker5']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['telp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['email']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_update']; ?></p>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>

        </table>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td colspan="6" align="center"><b>Penyuluh Pertanian PPPK</b></td>
                <tr>
                    <td width=10 class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh</td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Wil Kerja(desa)</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP</b></td>
                    <td width=50 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Email</b></td>

                    <td width=150 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Tgl Update</b></td>

                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($swa as $row => $item) {

                ?>
                    <tr>
                        <td class="align-middle text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama']; ?> </p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['wilker']; ?><br>- <?= $item['wilker2']; ?><br>- <?= $item['wilker3']; ?><br>- <?= $item['wilker4']; ?><br>- <?= $item['wilker5']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['telp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['email']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_update']; ?></p>
                        </td>
                    </tr>

                <?php
                }
                ?>
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