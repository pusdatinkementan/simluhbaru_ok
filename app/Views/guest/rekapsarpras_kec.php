<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap sarana dan prasarana pendukung penyelenggaraan penyuluhan </h4><br>
    <h5> Kabupaten/Kota <?= $namakab; ?> </h5>
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
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Kend Roda 4</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Kend Roda 2</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Komputer (PC)</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Laptop</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Printer</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Modem</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">LCD Proyektor</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Soil Tester</td>
                </tr>
                <tr>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $jumr4n = 0;
                $jumr4d = 0;
                $jumr2n = 0;
                $jumr2d = 0;
                $jumpcn = 0;
                $jumpcd = 0;
                $jumln = 0;
                $jumld = 0;
                $jumpn = 0;
                $jumpd = 0;
                $jummn = 0;
                $jummd = 0;
                $jumlcdn = 0;
                $jumlcdd = 0;
                $jumsn = 0;
                $jumsd = 0;

                foreach ($sarpras as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['deskripsi'] ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $r4apbn = $item['r4_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $r4apbd = $item['r4_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $r2apbn = $item['r2_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $r2apbd = $item['r2_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $pcapbn = $item['pc_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $pcapbd = $item['pc_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $laptopapbn = $item['laptop_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $laptopapbd = $item['laptop_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $printerapbn = $item['printer_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $printerapbd = $item['printer_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $modemapbn = $item['modem_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $modemapbd = $item['modem_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $lcdapbn = $item['lcd_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $lcdapbd = $item['lcd_apbdb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $soilapbn = $item['soil_apbnb']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $soilapbd = $item['soil_apbdb']; ?></p>
                        </td>

                    </tr>
                <?php
                    $jumr4n = $jumr4n + $r4apbn;
                    $jumr4d = $jumr4d + $r4apbd;
                    $jumr2n = $jumr2n + $r2apbn;
                    $jumr2d = $jumr2d + $r2apbd;
                    $jumpcn = $jumpcn + $pcapbn;
                    $jumpcd = $jumpcd + $pcapbd;
                    $jumln = $jumln + $laptopapbn;
                    $jumld = $jumld + $laptopapbd;
                    $jumpn = $jumpn + $printerapbn;
                    $jumpd = $jumpd + $printerapbd;
                    $jummn = $jummn + $modemapbn;
                    $jummd = $jummd + $modemapbd;
                    $jumlcdn = $jumlcdn + $lcdapbn;
                    $jumlcdd = $jumlcdd + $lcdapbd;
                    $jumsn = $jumsn + $soilapbn;
                    $jumsd = $jumsd + $soilapbd;
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumr4n ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumr4d ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumr2n ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumr2d ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpcn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpcd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumln ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumld ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jummn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jummd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumlcdn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumlcdd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumsn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumsd ?></b></p>
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