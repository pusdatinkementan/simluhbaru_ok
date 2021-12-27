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
                    <td width=170 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Desa</td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face="verdana">Jumlah
                            Poktan</font>

                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Anggota
                                (Laki-Laki)</b></font>
                    </td>
                    <td width=100 align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Anggota
                                (Perempuan)</b></font>
                    </td>
                    <td width=100 align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Anggota
                                (Belum diisi jenis kelaminnya)</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Total
                                Jumlah
                                Anggota</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Anggota Sudah diisi NIK</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                anggota memiliki lahan kurang dari 1 ha</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                anggota memiliki lahan kurang dari 1-2 ha</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                anggota memiliki lahan lebih dari 2 ha</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $thl_apbd = 0;
                $jum_laki = 0;
                $jum_pr = 0;
                $jum_kosong = 0;
                $jum_total = 0;
                $jum_nik = 0;
                $jum_nik_kurang = 0;
                $jum_nik_diantara = 0;
                $jum_nik_lebih = 0;
                foreach ($rgprovdetaildesa as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <a href="<?= base_url('/rekap_genprovdetaildesalist?kode_desa=' . $item['kode_desa']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nm_desa'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['thl_apbd']; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_laki']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_pr']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_kosong']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_total']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_nik']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_nik_kurang']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_nik_diantara']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_nik_lebih']; ?></p>
                        </td>
                    </tr>

                <?php
                    $thl_apbd = $thl_apbd + $item['thl_apbd'];
                    $jum_laki = $jum_laki + $item['jum_laki'];
                    $jum_pr = $jum_pr + $item['jum_pr'];
                    $jum_kosong = $jum_kosong + $item['jum_kosong'];
                    $jum_total = $jum_total + $item['jum_total'];
                    $jum_nik = $jum_nik + $item['jum_nik'];
                    $jum_nik_kurang = $jum_nik_kurang + $item['jum_nik_kurang'];
                    $jum_nik_diantara = $jum_nik_diantara + $item['jum_nik_diantara'];
                    $jum_nik_lebih = $jum_nik_lebih + $item['jum_nik_lebih'];
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $thl_apbd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_laki ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_pr ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_kosong ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_total ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_nik ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_nik_kurang ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_nik_diantara ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_nik_lebih ?></b></p>
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