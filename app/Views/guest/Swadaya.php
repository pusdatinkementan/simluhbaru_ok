<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Data Dasar Penyuluh Pertanian THL-TB (APBD)</h4>
    <h5>Kabupaten / Kota <?= $namakab; ?></h5>
</center>


<div class="card">
    <?php
    $tanggal_today = date('d');
    $bulan_today = date('m');
    $tahun_today = date('Y'); ?>
    <p class="text-xs font-weight-bold mb-0">Per : <?= $tanggal_today . '-' . $bulan_today . '-' . $tahun_today; ?></p>

    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=10 align=left rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 align=left rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Unit Kerja (BP3K)</b></td>
                    <td width=250 align=left rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh<br>Tempat/Tgl Lahir</b></td>

                    <td width=200 align=left rowspan="2" size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No KTP<br>No SK Penetapan<br>Pejabat</b></td>
                    <td width=200 size=2 align=left rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Pendidikan Formal</b></td>
                    <td colspan="5" size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Keahlian Bidang Teknis</b></td>
                    <td width=100 align=left rowspan="2" size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Wilayah Kerja<br>(Desa)</b></td>
                    <td width=100 align=left rowspan="2" size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP<br>Email</b></td>

                </tr>
                <tr>
                    <td width="50" class="text-uppercase text-secondary text-xxs font-weight-bolder">TP</td>
                    <td width="50" class="text-uppercase text-secondary text-xxs font-weight-bolder">NAK</td>
                    <td width="50" class="text-uppercase text-secondary text-xxs font-weight-bolder">BUN</td>
                    <td width="50" class="text-uppercase text-secondary text-xxs font-weight-bolder">HORTI</td>
                    <td width="50" class="text-uppercase text-secondary text-xxs font-weight-bolder">Lainnya</td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($swadaya as $row => $item) {

                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_bpp'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama']; ?> <br> <?= $item['tempat_lahir'] . ',' . $item['tgl_lahir'] . '/' . $item['bln_lahir'] . '/' . $item['thn_lahir']; ?><br><br><?php if ($item['jenis_kelamin'] == "1") {
                                                                                                                                                                                                                            echo "Laki-Laki";
                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                            echo "Perempuan";
                                                                                                                                                                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['noktp']; ?><br> <?= $item['no_sk_penetapan']; ?> <br><?= $item['pejabat_menetapkan']; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['tingkat'] == "01") {
                                                                            echo "S3 (Setara)";
                                                                        } elseif ($item['tingkat'] == "02") {
                                                                            echo "S2 (Setara)";
                                                                        } elseif ($item['tingkat'] == "03") {
                                                                            echo "S1 (Setara)";
                                                                        } elseif ($item['tingkat'] == "04") {
                                                                            echo "D4";
                                                                        } elseif ($item['tingkat'] == "05") {
                                                                            echo "SM";
                                                                        } elseif ($item['tingkat'] == "06") {
                                                                            echo "D3";
                                                                        } elseif ($item['tingkat'] == "07") {
                                                                            echo "D2";
                                                                        } elseif ($item['tingkat'] == "08") {
                                                                            echo "D1";
                                                                        } elseif ($item['tingkat'] == "09") {
                                                                            echo "SLTA";
                                                                        } elseif ($item['tingkat'] == "10") {
                                                                            echo "SLTP";
                                                                        } elseif ($item['tingkat'] == "11") {
                                                                            echo "SD";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['ahli_tp'] == "") {
                                                                            echo "";
                                                                        } else {
                                                                            echo "<center>✓</center>";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['ahli_nak'] == "") {
                                                                            echo "";
                                                                        } else {
                                                                            echo "<center>✓</center>";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['ahli_bun'] == "") {
                                                                            echo "";
                                                                        } else {
                                                                            echo "<center>✓</center>";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['ahli_hor'] == "") {
                                                                            echo "";
                                                                        } else {
                                                                            echo "<center>✓</center>";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['ahli_lainnya'] == "") {
                                                                            echo "";
                                                                        } else {
                                                                            echo "<center>✓</center>";
                                                                        } ?></p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['wilker']; ?><br>- <?= $item['wilker2']; ?><br>- <?= $item['wilker3']; ?><br>- <?= $item['wilker4']; ?><br>- <?= $item['wilker5']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['telp']; ?><br><?= $item['email']; ?></p>
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