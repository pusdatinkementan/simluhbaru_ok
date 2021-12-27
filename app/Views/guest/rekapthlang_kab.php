<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Ketenagaan Penyuluhan THL-TB APBN Berdasarkan Angkatan </h4><br>
    <h5><?= $namaprov; ?></h5>
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
                    <td width="23" align=center rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="170" align=center rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                </tr>
                <tr>
                    <td colspan="5" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">ANGKATAN</td>
                    <td colspan="7" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td colspan="4" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">UMUR SAAT INi</td>
                </tr>
                <tr>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">I</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">II</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">III</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tidak Diisi</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total</td>

                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">SLTA</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">D3</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">D4</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">S1 (Setara)</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">S2 (Setara)</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">TIdak Diisi</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total</td>

                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">
                        <=35 </td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">>35</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tidak Input Tgl Lahir</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $jum1 = 0;
                $jum2 = 0;
                $jum3 = 0;
                $jumna = 0;
                $jumslta = 0;
                $jumd3 = 0;
                $jumd4 = 0;
                $jums1 = 0;
                $jums2 = 0;
                $jumtd = 0;
                $jum35 = 0;
                $juml35 = 0;
                $jumt = 0;
                $jumtot = 0;
                $jumtot2 = 0;
                $jumtot3 = 0;

                foreach ($thlangkab as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbn?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_dati2'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/ThlApbn1?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['apbn_1']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/ThlApbn2?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['apbn_2']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbn3?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['apbn_3']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['apbn_na']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['apbn_1'] + $item['apbn_2'] + $item['apbn_3'] + $item['apbn_na']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/ThlApbnslta?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['slta_apbn']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/ThlApbnd3?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['d3_apbn']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbnd4?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['d4_apbn']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbns1?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['s1_apbn']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbns2?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['s2_apbn']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kosong_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['slta_apbn'] + $item['d3_apbn'] + $item['d4_apbn'] + $item['s1_apbn'] + $item['s2_apbn'] + $item['kosong_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/ThlApbnk35?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['kurang35']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/ThlApbnl35?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['lebih35']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['umur_na']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kurang35'] + $item['lebih35'] + $item['umur_na']; ?></p>
                        </td>
                    </tr>
                <?php

                    $jum1 = $jum1 + $item['apbn_1'];
                    $jum2 =  $jum2 + $item['apbn_2'];
                    $jum3 =  $jum3 + $item['apbn_3'];
                    $jumna =  $jumna + $item['apbn_na'];
                    $jumslta =  $jumslta + $item['slta_apbn'];
                    $jumd3 = $jumd3 + $item['d3_apbn'];
                    $jumd4 =  $jumd4 + $item['d4_apbn'];
                    $jums1 = $jums1 + $item['s1_apbn'];
                    $jums2 = $jums2 + $item['s2_apbn'];
                    $jumtd =  $jumtd + $item['kosong_apbn'];
                    $jum35 =  $jum35 + $item['kurang35'];
                    $juml35 =  $juml35 + $item['lebih35'];
                    $jumt =  $jumt + $item['umur_na'];
                    $jumtot2 = $jumtot2 + ($item['d3_apbn'] + $item['d4_apbn'] + $item['s1_apbn'] + $item['s2_apbn'] + $item['kosong_apbn']);
                    $jumtot = $jumtot + ($item['apbn_1'] + $item['apbn_2'] + $item['apbn_3'] + $item['apbn_na']);
                    $jumtot3 = $jumtot3 + ($item['kurang35'] + $item['lebih35'] + $item['umur_na']);
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum1 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum2 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum3 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumna ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtot ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumslta ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumd3 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumd4 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jums1 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jums2 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtot2 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum35 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $juml35 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumt ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtot3 ?></b></p>
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