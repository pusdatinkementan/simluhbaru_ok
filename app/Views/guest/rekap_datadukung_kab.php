<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Data Dukung Layanan per Provinsi </h4>
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
                    <td width=180 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Provinsi</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Jumlah<br>Kios<br>Saprotan</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Jumlah<br>Pedangan<br>Pengepul</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Jumlah<br>Gudang<br>Pangan</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Jumlah<br>Perbankan</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Jumlah<br>Industri<br>Pertanian</b></font>
                    </td>
                    <td align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">
                        <font color=black face=verdana size=2><b>Jumlah</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $jumsap = 0;
                $jumpeng = 0;
                $jumpang = 0;
                $jumbank = 0;
                $jumin = 0;
                $jumtot = 0;
                foreach ($daduk as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/data_layanan_kec?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_dati2'] ?></p>
                            </a>
                        </td>
                        <td class="align-right text-right text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['saprotan']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['pengepul']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['gpangan']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['bank']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['industri']); ?></p>
                        </td>
                        <td class="align-right text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= number_format($item['saprotan'] + $item['pengepul'] + $item['gpangan'] + $item['bank'] + $item['industri']); ?></p>
                        </td>

                    </tr>
                <?php
                    $jumsap = $jumsap + $item['saprotan'];
                    $jumpeng = $jumpeng + $item['pengepul'];
                    $jumpang = $jumpang + $item['gpangan'];
                    $jumbank = $jumbank + $item['bank'];
                    $jumin =  $jumin + $item['industri'];
                    $jumtot =  $jumtot + ($item['saprotan'] + $item['pengepul'] + $item['gpangan'] + $item['bank'] + $item['industri']);
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
                        <p class="text-s font-weight-bold mb-0"><b><?= number_format($jumsap) ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= number_format($jumpeng) ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= number_format($jumpang) ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= number_format($jumbank) ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= number_format($jumin) ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= number_format($jumtot) ?></b></p>
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