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
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jenis<br>Kelembagaan</td>
                    <td width="120" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nomenklatur</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Unit Kerja<br>yang<br>menangani<br>penyuluhan</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama<br>Bidang/UPTD</td>
                    <td width="90" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Kepala<br>Bidang/UPTD<br>(No HP)</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Seksi</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Kepala Seksi<br>(No HP)</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Dasar Hukum <br>Pembentukan</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tanggal<br>Pembentukan</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No <br>Peraturan</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat Kantor</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No Telp/Fax<br>Email<br>Website</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Kepala<br>Dinas<br>(No HP)</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Koordinator Penyuluh</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rlprov as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="<?= base_url('/dl_kab?kode_prop=' . $item['kode_prop']) ?>" style="color: blue;">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['namaprov'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['nama_bapel'] == "21") {
                                                                            echo "Badan";
                                                                        } elseif ($item['nama_bapel'] == "22") {
                                                                            echo "Dinas";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['deskripsi_lembaga_lain'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['eselon3_luh'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_bidang_luh'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_kabid'] ?><br><?= $item['hp_kabid']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['seksi_luh'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_kasie'] ?><br><?= $item['hp_kasie']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['dasar_hukum'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_berdiri'] ?>/<?= $item['bln_berdiri']; ?>/<?= $item['thn_berdiri']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['no_peraturan'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['alamat'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['telp_kantor'] ?>/<?= $item['fax_kantor']; ?><br><?= $item['email']; ?><br><?= $item['website']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['ketua'] ?><br><?= $item['telp_hp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['namapen'] ?><br><?= $item['nip']; ?></p>
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