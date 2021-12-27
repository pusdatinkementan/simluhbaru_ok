<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Kelompok Tani Berdasarkan Jenis Kelompok </h4>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=24 rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>No</b>
                    </td>
                    <td width=170 rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Kecamatan</b>
                    </td>
                    <td width=100 rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Jumlah<br>Poktan</b>
                    </td>
                    <td colspan="14" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center><strong>Jenis Kelompok Tani </strong></td>
                </tr>
                <tr>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center><strong>
                            Domisili
                        </strong></td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Perempuan</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Tan Pangan</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Horti</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Perkebunan</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Peternakan</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Pengolahan</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>UPJA</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>P3A/HIPPA</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>LMDH</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Penangkar Benih</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>KMP (Kawasan Mandiri Pangan)</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>UMKM (MP3L)</b>
                    </td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <b>Belum Diketahui</b>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                $thl_apbd = 0;
                $jum_domisili = 0;
                $jum_perempuan = 0;
                $jum_tp = 0;
                $jum_hor = 0;
                $jum_bun = 0;
                $jum_nak = 0;
                $jum_olah = 0;
                $jum_upja = 0;
                $jum_p3a = 0;
                $jum_lmdh = 0;
                $jum_penangkar_benih = 0;
                $jum_kmp = 0;
                $jum_umkm = 0;
                $jum_know = 0;
                foreach ($rgjenispokkec as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/rekap_jenispoktandesa?kode_kec=' . $item['kode_kec']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['deskripsi'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['thl_apbd']; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_domisili']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_perempuan']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_tp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_hor']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_bun']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_nak']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_olah']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_upja']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_p3a']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_lmdh']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_penangkar_benih']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_kmp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_umkm']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_know']; ?></p>
                        </td>
                    </tr>

                <?php
                    $thl_apbd = $thl_apbd + $item['thl_apbd'];
                    $jum_domisili = $jum_domisili + $item['jum_domisili'];
                    $jum_perempuan = $jum_perempuan + $item['jum_perempuan'];
                    $jum_tp = $jum_tp + $item['jum_tp'];
                    $jum_hor = $jum_hor + $item['jum_hor'];
                    $jum_bun = $jum_bun + $item['jum_bun'];
                    $jum_nak = $jum_nak + $item['jum_nak'];
                    $jum_olah = $jum_olah + $item['jum_olah'];
                    $jum_upja = $jum_upja + $item['jum_upja'];
                    $jum_p3a = $jum_p3a + $item['jum_p3a'];
                    $jum_lmdh = $jum_lmdh + $item['jum_lmdh'];
                    $jum_penangkar_benih = $jum_penangkar_benih + $item['jum_penangkar_benih'];
                    $jum_kmp = $jum_kmp + $item['jum_kmp'];
                    $jum_umkm = $jum_umkm + $item['jum_umkm'];
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $thl_apbd ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_domisili ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_perempuan ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_tp ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_hor ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_bun ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_nak ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_olah ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_upja ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_p3a ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_lmdh ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_penangkar_benih ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_kmp ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum_umkm ?></b></p>
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