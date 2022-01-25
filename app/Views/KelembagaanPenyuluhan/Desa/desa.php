<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $sessnama = session()->get('kodebapel'); ?>
<?php $sessnama = session()->get('kodebpp'); ?>


<center>
    <h3> Daftar Posluhdes di Kab <?= ucwords(strtolower($nama_kabupaten)) ?> </h3>
</center>
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center; width: 10%">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Kecamatan</th>

                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Posluhdes</th>

                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $jml_des = 0;
                $i = 1;
                foreach ($tabel_data as $row) {
                ?>

                    <tr>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <a href="<?= base_url('/daftar_posluhdes?kode_kec=' . $row['id_daerah']) ?>">
                                <p class="text-xs font-weight-bold mb-0"><?= $row['deskripsi'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['jum'] ?></p>
                        </td>
                    </tr>
                <?php
                    $jml_des = $jml_des + $row['jum'];
                }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b>JUMLAH</b></p>
                    </th>
                    <th class="align-middle rupiah text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jml_des ?></b></p>
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
<?php echo view('layout/footer'); ?>
<br>

<?= $this->endSection() ?>