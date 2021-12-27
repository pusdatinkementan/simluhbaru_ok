<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Profil BPP </h4>
    <br>
    <h6 style="margin-top: -30px;">Provinsi <?= $namaprov; ?></h6>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width="23" rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="170" rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Kabupaten</td>
                    <td width="170" rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Kelembagaan Penyuluhan</td>
                    <td width="170" rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah Kec</td>
                    <td width="170" rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah BPP</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=5>Klasifikasi
                    </td>
                    <td colspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Status Bangunan
                    </td>
                    <td colspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Kondisi Bangunan
                    </td>
                    <td colspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Luas Lahan <br>Percontohan
                    </td>
                </tr>
                <tr>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font size="2" face="verdana"><b>Pratama</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Madya</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Utama</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Aditama</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Tanpa Keterangan</b></font>
                    </td>

                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Milik Sendiri</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Sewa/<br>Numpang</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Tanpa Keterangan</b></font>
                    </td>

                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Baik</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Rusak</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Tanpa Keterangan</b></font>
                    </td>

                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>di BPP<br>(ha)</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>di Petani<br>(ha)</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkbpp as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <a href="<?= base_url('/rekap_profbpp?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['nama_dati2']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['nama_bapel'] == "10") {
                                                                            echo "Badan Pelaksana Penyuluhan Pertanian, Perikanan dan Kehutanan";
                                                                        } elseif ($item['nama_bapel'] == "20") {
                                                                            echo "Badan Pelaksana Penyuluhan";
                                                                        } elseif ($item['nama_bapel'] == "31") {
                                                                            echo "$item[deskripsi_lembaga_lain]";
                                                                        } elseif ($item['nama_bapel'] == "32") {
                                                                            echo "$item[deskripsi_lembaga_lain]";
                                                                        } elseif ($item['nama_bapel'] == "33") {
                                                                            echo "$item[deskripsi_lembaga_lain]";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jumkec']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jumbpp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['klasprat']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['klasmad']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['klasut']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['klasad']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['klasno']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['milik']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['sewa']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['noket']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['baik']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['rusak']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tk']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['lahan_bp3k'], 2, ",", "."); ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['lahan_petani'], 2, ",", "."); ?></p>
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