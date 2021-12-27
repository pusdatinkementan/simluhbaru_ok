<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<br>
<br>
<center>
    <h4>Daftar Kelompok Petani Yang Telah Menerima Bantuan Kegiatan  </h4>
   
</center>
<br>
<div class="container">
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Kecamatan</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Desa</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Kelompok</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Ketua</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Alamat</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Kegiatan</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Sub Kegiatan</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Volume</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Tahun</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkpbk61 as $row => $item) {
                ?>
                    <tr>
                        <td align="center" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                       
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['deskripsi'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['nm_desa'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['nama_poktan'] ?></p>
                            </a>
                        </td>  
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['ketua_poktan'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['alamat'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['desckeg'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['subitem'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['volume'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['tahun'] ?></p>
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