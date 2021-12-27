<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Data Dasar Penyuluh Pertanian THL-TB (APBN)</h4>
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
                    <td width=250 align=left rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh<br>Tempat/Tgl Lahir<br>Usia<br>Jenis Kelamin</b></td>

                    <td width=200 align=left rowspan="2" size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No KTP<br>No Peserta<br>Angkatan</b></td>
                    <td width=200 size=2 align=left rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Pendidikan Formal<br>Bidang Pendidikan</b></td>
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
                foreach ($thlapbn as $row => $item) {
                    $tgllahir = $item['tgl_lahir'];
                    $ambilthnlhr = substr($tgllahir, 0, 4);
                    $ambilblnlhr = substr($tgllahir, 5, 2);
                    $ambiltgllhr = substr($tgllahir, 8, 2);

                    $tgl_lahir = $item['tgl_lahir'];
                    $bln_lahir = $item['bln_lahir'];
                    $thn_lahir = $item['thn_lahir'];
                    $tanggal_today = date('d');
                    $bulan_today = date('m');
                    $tahun_today = date('Y');
                    $harilahir = gregoriantojd($bln_lahir, $tgl_lahir, $thn_lahir);
                    $hariini = gregoriantojd($bulan_today, $tanggal_today, $tahun_today);
                    $umur = $hariini - $harilahir;

                    $tahun = $umur / 365; //menghitung usia tahun
                    $sisa = $umur % 365; //sisa pembagian dari tahun untuk menghitung bulan
                    $bulan = $sisa / 30; //menghitung usia bulan
                    $hari = $sisa % 30; //menghitung sisa hari
                    $lahir = $tgl_lahir - $bln_lahir - $thn_lahir;
                    $today = $tanggal_today - $bulan_today - $tahun_today;
                    $umur_th = floor($tahun);
                    $umur_bl = floor($bulan);
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_bpp'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['gelar_dpn'] . ' ' . $item['nama'] . ' ' . $item['gelar_blk']; ?> <br> <?= $item['tempat_lahir'] . ',' . $item['tgl_lahir'] . '/' . $item['bln_lahir'] . '/' . $item['thn_lahir']; ?><br><br><?php if ($item['jenis_kelamin'] == "1") {
                                                                                                                                                                                                                                                                                echo "Laki-Laki";
                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                echo "Perempuan";
                                                                                                                                                                                                                                                                            } ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['noktp']; ?><br> <?= $item['no_peserta'] . '(' . $item['sumber_dana'] . ')'; ?> <br><?= $item['angkatan']; ?><br><?= $umur_th . ' Tahun' . ' ' . $umur_bl . ' Bulan'; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['tingkat_pendidikan'] == "02") {
                                                                            echo "S2(Setara)";
                                                                        } elseif ($item['tingkat_pendidikan'] == "03") {
                                                                            echo "S1(Setara)";
                                                                        } elseif ($item['tingkat_pendidikan'] == "04") {
                                                                            echo "D4";
                                                                        } elseif ($item['tingkat_pendidikan'] == "06") {
                                                                            echo "D3";
                                                                        } elseif ($item['tingkat_pendidikan'] == "09") {
                                                                            echo "SLTA";
                                                                        } ?> <br> <?= $item['bidang_pendidikan']; ?></p>
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