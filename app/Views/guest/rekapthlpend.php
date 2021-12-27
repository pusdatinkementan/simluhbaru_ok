<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Ketenagaan Penyuluhan THL-TB Tingkat Nasional Berdasarkan Pendidikan </h4><br>
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
                    <td colspan="7" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td colspan="7" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                </tr>
                <tr>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">SLTA</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">D3</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">D4</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">S1 (Setara)</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">S2 (Setara)</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">TIdak Diisi</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total</td>

                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">SLTA</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">D3</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">D4</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">S1 (Setara)</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">S2 (Setara)</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">TIdak Diisi</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $jumslta = 0;
                $jumd3 = 0;
                $jumd4 = 0;
                $jums1 = 0;
                $jums2 = 0;
                $jumtd = 0;
                $jumsltad = 0;
                $jumd3d = 0;
                $jumd4d = 0;
                $jums1d = 0;
                $jums2d = 0;
                $jumtdd = 0;
                $jumtot = 0;
                $jumtot2 = 0;

                foreach ($thlpend as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_prop'] ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['slta_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['d3_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['d4_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['s1_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['s2_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kosong_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['slta_apbn'] + $item['d3_apbn'] + $item['d4_apbn'] + $item['s1_apbn'] + $item['s2_apbn'] + $item['kosong_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['slta_apbd']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['d3_apbd']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['d4_apbd']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['s1_apbd']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['s2_apbd']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kosong_apbd']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['slta_apbd'] + $item['d3_apbd'] + $item['d4_apbd'] + $item['s1_apbd'] + $item['s2_apbd'] + $item['kosong_apbd']; ?></p>
                        </td>

                    </tr>
                <?php
                    $jumslta =  $jumslta + $item['slta_apbn'];
                    $jumd3 = $jumd3 + $item['d3_apbn'];
                    $jumd4 = $jumd4 + $item['d4_apbn'];
                    $jums1 = $jums1 + $item['s1_apbn'];
                    $jums2 = $jums2 + $item['s2_apbn'];
                    $jumtd =  $jumtd + $item['kosong_apbn'];
                    $jumsltad = $jumsltad + $item['slta_apbd'];
                    $jumpd3d =  $jumd3d + $item['d3_apbd'];
                    $jumd4d =  $jumd4d + $item['d4_apbd'];
                    $jums1d =  $jums1d + $item['s1_apbd'];
                    $jums2d = $jums2d + $item['s2_apbd'];
                    $jumtdd = $jumtdd + $item['kosong_apbd'];
                    $jumtot = $jumtot + ($item['d3_apbn'] + $item['d4_apbn'] + $item['s1_apbn'] + $item['s2_apbn'] + $item['kosong_apbn']);
                    $jumtot2 = $jumtot2 + ($item['slta_apbd'] + $item['d3_apbd'] + $item['d4_apbd'] + $item['s1_apbd'] + $item['s2_apbd'] + $item['kosong_apbd']);
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtot ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumsltad ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumd3d ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumd4d ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jums1d ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jums2d ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtdd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtot2 ?></b></p>
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