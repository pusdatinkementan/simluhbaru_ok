<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Daftar Kelompok Penerima Bantuan Kegiatan  </h4>
    <h4>Provinsi <?= ucwords(strtolower($nama_provinsi)) ?> </h4>
</center>

<div class="container">
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Tampilkan</td>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkpbkab as $row => $item) {
                ?>
                    <tr>
                        <td align="left" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_dati2'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankec?kode_kab=' . $item['id_dati2']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;">Tampilkan</p>
                                <a href="" style="color: blue;">
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