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
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Kelompok</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Sudah Menerima<br>Bantuan</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Belum Menerima<br>Bantuan</td>
                    
                    
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkpbkab as $row => $item) {
                ?>
                    <tr>
                        <td align="center" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarrekappoktanpenbankec?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['nama_dati2'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['jumpoktan'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['jum_menerima'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['jumpoktan'] - $item['jum_menerima'] ?></p>
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