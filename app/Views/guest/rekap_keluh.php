<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Kelembagaan Penyuluhan Pertanian Provinsi </h4>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=23 rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=170 rowspan="3" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td colspan="6" align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah Kelembagaan</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Provinsi
                    </td>
                    <td colspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Kabupaten
                    </td>
                    <td width="102" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Kecamatan
                    </td>
                    <td width="102" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2>Desa
                    </td>
                </tr>
                <tr>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font size="2" face="verdana">Bakorluh</font>

                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Dinas</b></font>
                    </td>
                    <td width=99 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Bapeluh</b></font>
                    </td>
                    <td width=112 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Dinas/Lainnya</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>BPP</b></font>
                    </td>
                    <td class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana size=2><b>Posluhdes</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $jum_bakor = 0;
                $jum_dinas = 0;
                $jum_bapeluh = 0;
                $jum_kabdinas = 0;
                $jum_kec = 0;
                $jum_pos = 0;
                foreach ($rkeluh as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['namaprov']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_bakor']; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['dinas']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_bapeluh']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kab_dinas']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/rekapkec?kode_prop=' . $item['kode_prop']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0"><?= $item['kec_bp3k']; ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['posluhdes']; ?></p>
                        </td>
                    </tr>

                <?php
                    $jum_bakor = $jum_bakor + $item['jum_bakor'];
                    $jum_dinas = $jum_dinas + $item['dinas'];
                    $jum_bapeluh = $jum_bapeluh + $item['jum_bapeluh'];
                    $jum_kabdinas = $jum_kabdinas + $item['kab_dinas'];
                    $jum_kec = $jum_kec + $item['kec_bp3k'];
                    $jum_pos = $jum_pos + $item['posluhdes'];
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_bakor ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_dinas ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_bapeluh ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_kabdinas ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_kec ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_pos ?></b></p>
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