<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Ketenagaan Penyuluhan Tingkat Kabupaten/Kota </h4><br>
    <h5> Provinsi <?= $namaprov; ?> </h5>
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
                    <td width="170" align=center rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">Kabupaten/Kota</td>
                </tr>
                <tr>
                    <td colspan="4" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah PNS (+ BPTP)</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah THL-TBPP</td>
                    <td colspan="2" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah Lainnya</td>
                    <td rowspan="2" width="90" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Total</td>
                </tr>
                <tr>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aktif</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tugas Belajar</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">CPNS</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">PPPK</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBN</td>
                    <td width=112 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">APBD</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Swadaya</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Swasta</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align=center size=2 class="align-middle text-center text-sm">1</td>
                    <td align=left size=2 class="align-middle text-center text-sm">BPTP</td>
                    <td align=right size=2 class="align-middle text-center text-sm">
                        <a href="<?= base_url('/BptpAktif?kode_prop=' . $id_prop) ?>" style="color: blue;">
                            <?= $jum_bptp; ?>
                        </a>
                    </td>
                    <td align=left size=2 class="align-middle text-center text-sm"><?= $jum_bptp_TB; ?> </td>
                    <td align=right size=2 class="align-middle text-center text-sm">0</td>
                    <td align=right size=2 class="align-middle text-center text-sm">0</td>
                    <td align=right size=2 class="align-middle text-center text-sm">0</td>
                    <td align=right size=2 class="align-middle text-center text-sm">0</td>
                    <td align=right size=2 class="align-middle text-center text-sm">0</td>
                    <td align=right size=2 class="align-middle text-center text-sm">0</td>
                    <td align=right size=2 class="align-middle text-center text-sm"><?= $jum_bptp + $jum_bptp_TB; ?></td>
                </tr>
                <?php
                $i = 2;
                $jumpns = 0;
                $jumpnsTB = 0;
                $jumcpns = 0;
                $jump3k = 0;
                $jumthl_apbn = 0;
                $jumthl_apbd = 0;
                $jumswa = 0;
                $jumswasta = 0;
                $tanggal_today = date('d');

                foreach ($dk as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/dk_kab?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_dati2'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <a href="<?= base_url('/PnsAktif?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['pns']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pnsTB']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['cpns']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['p3k']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbn?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['thl_apbn']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/ThlApbd?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['thl_apbd']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/Swadaya?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['swa']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['swasta']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pns'] + $item['pnsTB'] + $item['cpns'] + $item['p3k'] + $item['thl_apbn'] + $item['thl_apbd'] + $item['swa'] + $item['swasta']; ?></p>
                        </td>

                    </tr>
                <?php
                    $jumpns = $jumpns + $item['pns'];
                    $jumpnsTB = $jumpnsTB + $item['pnsTB'];
                    $jumcpns = $jumcpns + $item['cpns'];
                    $jump3k = $jump3k + $item['p3k'];
                    $jumthl_apbn = $jumthl_apbn + $item['thl_apbn'];
                    $jumthl_apbd = $jumthl_apbd + $item['thl_apbd'];
                    $jumswa = $jumswa + $item['swa'];
                    $jumswasta = $jumswasta + $item['swasta'];
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpns ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpnsTB ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumcpns ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jump3k ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumthl_apbn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumthl_apbd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumswa ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumswasta ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpns + $jumpnsTB + $jumcpns + $jump3k + $jumthl_apbn + $jumthl_apbd + $jumswa + $jumswasta + $jumswasta ?></b></p>
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