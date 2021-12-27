<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Kelembagaan Pelaku Utama (KEP) Per Provinsi Berdasarkan Bentuk Kelembagaan </h4><br>
</center>


<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width="23" align=center rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="170" align=center rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td width="170" align=center rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Kelembagaan<br>Ekonomi Petani</td>
                </tr>
                <tr>
                    <td colspan="4" align=center size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder">Bentuk Kelembgaan Ekonomi Petani</td>
                 </tr>
                <tr>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Koperasi Tani</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">PT</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">CV</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">KUB</td>
                    <td width=99 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">LKMA</td>
                    <td width=112 size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Lainnya</td>
                    <td size=2 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tidak<br>Diketahui</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                   
                <?php
                $i = 1;
                $thl_apbn = 0;
                $kop = 0;
                $pt = 0;
                $cv = 0;
                $kub = 0;
                $lkma = 0;
                $lain = 0;
                $map = 0;
                foreach ($rkepprov as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/daftarrekapkepkab?kode_prop=' . $item['id_prop']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_prop'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['thl_apbn']; ?></p>
                        </td>
                        <td class="align-middle text-sm" align="center">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kop']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pt']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['cv']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kub']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['lkma']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['lain']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['map']; ?></p>
                        </td>

                    </tr>
                <?php
                    $thl_apbn = $thl_apbn + $item['thl_apbn'];
                    $kop = $kop + $item['kop'];
                    $pt = $pt + $item['pt'];
                    $cv = $cv + $item['cv'];
                    $kub = $kub + $item['kub'];
                    $lkma = $lkma + $item['lkma'];
                    $lain = $lain + $item['lain'];
                    $map = $map + $item['map'];
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $thl_apbn ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $kop ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pt ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $cv ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $kub ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $lkma ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $lain ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $map ?></b></p>
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