<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Kelembagaan Penyuluhan Pertanian Provinsi </h4>
</center>



<div class="card">

    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama BP3k</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama<br>Kelembagaan</td>
                    <td width="120" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Wilayah Kecamatan</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat Kantor</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No Telp/Fax<br>Email<br>Website</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">GPS Point</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Pim[inan <br> No HP</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rlkec as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/profilbpp?kode_kec=' . $item['kecamatan'] . '&kodebpp=' . $item['id']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_bpp'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['bentuk_lembaga'] == "10") {
                                                                            echo "Balai Penyuluhan Pertanian, Perikanan dan Kehutanan";
                                                                        } elseif ($item['bentuk_lembaga'] == "20") {
                                                                            echo "Balai Penyuluhan Pertanian";
                                                                        } elseif ($item['bentuk_lembaga'] == "30") {
                                                                            echo "$item[deskripsi_lembaga_lain]";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0">- <?= $item['namakec'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['alamat'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['telp_bpp'] ?><br><?= $item['email']; ?><br><?= $item['website']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['koordinat_lokasi_bpp'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['ketua'] ?><br><?= $item['telp_hp']; ?></p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
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