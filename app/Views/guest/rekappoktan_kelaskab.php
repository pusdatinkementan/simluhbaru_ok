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
                    <td width=170 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Kabupaten</td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face="verdana">Jumlah
                            Poktan</font>

                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Poktan
                                (Pemula)</b></font>
                    </td>
                    <td width=100 align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Poktan
                                (Lanjut)</b></font>
                    </td>
                    <td width=100 align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Poktan
                                (Madya)</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Poktan
                                (Utama)</b></font>
                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Jumlah
                                Poktan
                                (Belum Diketahui)</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $jumpoktan = 0;
                $jum_pemula = 0;
                $jum_lanjut = 0;
                $jum_madya = 0;
                $jum_utama = 0;
                $jum_know = 0;
                foreach ($rgkelaspokkab as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/rekap_kelaspoktankec?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_kab'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jumpoktan']; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_pemula']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_lanjut']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_madya']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_utama']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_know']; ?></p>
                        </td>
                    </tr>

                <?php
                    $jumpoktan = $jumpoktan + $item['jumpoktan'];
                    $jum_pemula = $jum_pemula + $item['jum_pemula'];
                    $jum_lanjut = $jum_lanjut + $item['jum_lanjut'];
                    $jum_madya = $jum_madya + $item['jum_madya'];
                    $jum_utama = $jum_utama + $item['jum_utama'];
                    $jum_know = $jum_know + $item['jum_know'];
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_lanjut ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_madya ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_utama ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_know ?></b></p>
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