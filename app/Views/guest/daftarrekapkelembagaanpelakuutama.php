<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<br>
<br>
<center>
    <h4>Rekap Kelembagaan Pelaku Utama Per Provinsi </h4>
   
</center>
<br>
<div class="container">
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Kelompok<br>Tani</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Gabungan<br>Kelompok<br>Tani</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Kelembagaan<br>Ekonomi<br>Petani</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah</td>
                    
                    
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkpuprov as $row => $item) {
                ?>
                    <tr>
                        <td align="center" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarrekapkelembagaanpelakuutamakab?kode_prop=' . $item['kode_prop']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['nama_prop'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pns'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pnsTB'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['thl_apbn'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['thl_apbn'] + $item['pnsTB'] + $item['pns'] ?></p>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
            </div>


    </div>
</div>
</tbody>
</table>
</div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>


<?= $this->endSection() ?>