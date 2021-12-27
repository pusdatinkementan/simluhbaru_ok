<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<div class="container">
    <h2 class="text-center mt-4 mb-4">Export Rekap Data BPP Ke Excel</h2>
    <span id="message"></span>
    <div class="card">
        <a href="<?php echo base_url('profil/Guest/rekapbppexcel'); ?>" class="btn btn-success">Export</a>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Kabupaten</th>
                            <th>WKBPP Kecamatan</th>
                            <th>BPP</th>
                            <th>Klasifikasi</th>
                            <th>Alamat</th>
                            <th>GPS Point</th>
                            <th>Nama Pimpinan</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Kondisi Bangunan</th>
                            <th>PC APBN</th>
                            <th>PC APBD</th>
                            <th>Laptop APBN</th>
                            <th>Laptop APBD</th>
                            <th>PNS</th>
                            <th>THL-TBPP</th>
                            <th>Swadaya</th>
                            <th>Swasta</th>
                            <th>Poktan</th>
                            <th>Gapoktan</th>
                            <th>KEP</th>
                            <th>Lahan Demplot BPP</th>
                            <th>Lahan Demplot Petani</th>
                        </tr>
                        <?php
                        foreach ($bpp as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row["nama_dati2"]; ?></td>
                                <td><?php echo $row["deskripsi"]; ?></td>
                                <td><?php echo $row["nama_bpp"]; ?></td>
                                <td><?php echo $row["klasifikasi"]; ?></td>
                                <td><?php echo $row["alamat"]; ?></td>
                                <td><?php echo $row["koordinat_lokasi_bpp"]; ?></td>
                                <td><?php echo $row["ketua"]; ?></td>
                                <td><?php echo $row["telp_hp"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["kondisi_bangunan"]; ?></td>
                                <td><?php echo $row["pc_apbn"]; ?></td>
                                <td><?php echo $row["pc_apbd"]; ?></td>
                                <td><?php echo $row["laptop_apbn"]; ?></td>
                                <td><?php echo $row["laptop_apbd"]; ?></td>
                                <td><?php echo $row["jumpns"]; ?></td>
                                <td><?php echo $row["jumthl"]; ?></td>
                                <td><?php echo $row["jumswa"]; ?></td>
                                <td><?php echo $row["jumswas"]; ?></td>
                                <td><?php echo $row["jumpok"]; ?></td>
                                <td><?php echo $row["jumgap"]; ?></td>
                                <td><?php echo $row["jumkep"]; ?></td>
                                <td><?php echo $row["luas_lahan_bp3k"]; ?></td>
                                <td><?php echo $row["luas_lahan_petani"]; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>


<?= $this->endSection() ?>