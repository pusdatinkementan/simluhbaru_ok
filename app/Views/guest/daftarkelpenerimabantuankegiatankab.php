<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<br>
<br>
<center>
    <h4>Rekap Kelembagaan Pelaku Utama Per Kabupaten </h4>
   
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
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">RJIT</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">RJIT APBN</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">JITUT</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">JIDES</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">PJI</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">PJI BARU</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">PSA</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">EMBUNG</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">OPLA</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">CETAK SAWAH</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">SRI</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">TR2</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">TR4 47.8 HP</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">TR4 90</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">RICE<BR>TRANSPLANTER</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">CHOPPER</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">CULTIVATOR</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">POMPA AIR</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">PUAP</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">SLPTT</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">GPPTT</td>
                    
                    
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkpbkkab as $row => $item) {
                ?>
                    <tr>
                        <td align="center" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['nama_dati2'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan11?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['rjit'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan12?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['rjitapbn'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan13?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['jitut'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan14?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['jides'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan15?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pji'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan16?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pji_baru'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan17?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['psa'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan18?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['embung'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan21?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['opla'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan22?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['cetak_sawah'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan23?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['sri'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan31?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['tr2'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan32?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['tr4_hp'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan33?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['tr4_90'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan34?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['rice'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan35?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['coper'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan36?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['cultiv'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan37?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pompa'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan61?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['puap'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan71?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['slptt'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <a href="<?= base_url('/daftarkelpenerimabantuankegiatan72?kode_kab=' . $item['kode_kab']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['gpptt'] ?></p>
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