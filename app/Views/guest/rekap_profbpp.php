<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>PROFIL BALAI PENYULUHAN PERTANIAN</h4>
    <br>
    <h6 style="margin-top: -30px;">Provinsi <?= $namaprov; ?></h6><br>
    <h6 style="margin-top: -30px;">Kabupaten/Kota : <?= $namakab; ?></h6>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width="10" rowspan="2" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>No</b>
                    </td>
                    <td width="250" rowspan="2" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>Nama BP3K/BPP/BPK</b>
                    </td>
                    <td width="250" rowspan="2" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>Wilayah Kerja<br>(Kecamatan)</b>
                    </td>
                    <td size="2" colspan="5" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>Klasifikasi</b>
                    </td>
                    <td size="2" colspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>Status Bangunan</b>
                    </td>
                    <td size="2" colspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>Kondisi Bangunan</b>
                    </td>
                    <td size="2" colspan="2" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font face=verdana size=2><b>Luas lahan Percontohan</b>
                    </td>
                </tr>
                <tr>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font size="2" face="verdana"><b>Pratama</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Madya</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Utama</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Aditama</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Tanpa Keterangan</b></font>
                    </td>

                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Milik Sendiri</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Sewa/<br>Numpang</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Tanpa Keterangan</b></font>
                    </td>

                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Baik</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Rusak</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Tanpa Keterangan</b></font>
                    </td>

                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>di BPP<br>(ha)</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>di Petani<br>(ha)</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rpbpp as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_bpp']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['namakec']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['klasifikasi'] == "pratama") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['klasifikasi'] == "madya") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['klasifikasi'] == "utama") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['klasifikasi'] == "aditama") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['klasifikasi'] == "") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['status_gedung'] == "milik sendiri") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['status_gedung'] == "sewa/pinjam") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['status_gedung'] == "") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['kondisi_bangunan'] == "baik") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['kondisi_bangunan'] == "rusak") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['kondisi_bangunan'] == "") {
                                                                            echo "✓";
                                                                        } else {
                                                                            echo "-";
                                                                        } ?></p>
                        </td>

                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['luas_lahan_bp3k']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['luas_lahan_petani']; ?></p>
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