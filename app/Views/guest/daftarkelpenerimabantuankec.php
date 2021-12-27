<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Daftar Kelompok Tani Penerima Bantuan Kegiatan </h4>
</center>

<div class="container">
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Kecamatan</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Desa</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Kelompok</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Ketua</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Alamat</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Kegiatan</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Sub Kegiatan</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Volume</td>
                    <td  class="text-uppercase text-secondary text-xxs font-weight-bolder">Tahun</td>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rkpbkec as $row => $item) {
                ?>
                    <tr>
                        <td align="left" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['deskripsi'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nm_desa'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_poktan'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['ketua_poktan'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['alamat'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['desckeg'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['subitem'] ?></p>
                        </td>   
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['volume'] ?></p>
                        </td> 
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['tahun'] ?></p>
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