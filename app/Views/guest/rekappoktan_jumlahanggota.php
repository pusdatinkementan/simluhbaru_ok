<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Kelompok Tani Berdasarkan Jumlah Anggota </h4>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=10 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=170 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face="verdana">Jumlah
                            Poktan</font>

                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Tergabung dalam gapoktan</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Prosentase
                                (%)</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $jumpoktan = 0;
                $jum_pemula = 0;

                foreach ($rgjumlahanggota as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/rekap_jumlahanggotapoktankab?kode_prop=' . $item['kode_prop']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_prop'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jumpoktan']; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_pemula']; ?></p>
                        </td>
                        <?php $persen = $item['jum_pemula'] / $item['jumpoktan'] * 100;
                        $persentase = number_format($persen, 2, '.', '') ?>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $persentase ?></p>
                        </td>
                    </tr>

                <?php
                    $jumpoktan = $jumpoktan + $item['jumpoktan'];
                    $jum_pemula = $jum_pemula + $item['jum_pemula'];
                    $persen_total = $jum_pemula / $jumpoktan * 100;
                    $persentase_total = number_format($persen_total, 2, '.', '');
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumpoktan ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_pemula ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $persentase_total ?></b></p>
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