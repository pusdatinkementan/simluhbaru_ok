<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Audit Lahan Tahun 2012 </h4>
    <h5> Provinsi <?= $namaprov; ?></h5>
</center>

<?php
$tanggal_today = date('d');
$bulan_today = date('m');
$tahun_today = date('Y'); ?>

<div class="card">
    <p class="text-xs font-weight-bold mb-0">Per : <?= $tanggal_today . '-' . $bulan_today . '-' . $tahun_today; ?></p>
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=23 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>No</b></font>
                    </td>
                    <td width=170 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Provinsi</b></font>
                    </td>
                    <td width=99 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder"><strong>
                            <font color="black" size="2" face="verdana">Irigasi</font>
                        </strong></td>
                    <td width=99 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Tadah Hujan</b></font>
                    </td>
                    <td width=99 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Pasang Surut</b></font>
                    </td>
                    <td width=99 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Lebak</b></font>
                    </td>
                    <td align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Total</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;

                foreach ($audlhn as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/data_audit2012_kec?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_dati2'] ?></p>
                            </a>
                        </td>
                        <td class="align-right text-right text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['irigasi']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['tadah_hujan']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['pasang_surut']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['lebak']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['irigasi'] + $item['tadah_hujan'] + $item['pasang_surut'] + $item['lebak']); ?></p>
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