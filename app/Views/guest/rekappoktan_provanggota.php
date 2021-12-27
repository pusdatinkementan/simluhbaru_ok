<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Kelompok Tani Berdasarkan Jumlah Anggota </h4>
</center>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=10 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=170 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama Anggota</td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face="verdana">Jenis Kelamin</font>

                    </td>
                    <td width=100 align=center class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>No KTP</b></font>
                    </td>
                    <td width=100 align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Komoditas yang diusahakan</b></font>
                    </td>
                    <td width=100 align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder" align=center>
                        <font face=verdana><b>Volume (ha/ekor/unit)</b></font>
                    </td>
                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($rgprovanggota as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0" style="text-align: left;"><?= $item['nama_anggota'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jenis_kelamin']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['no_ktp']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_subsektor']; ?>-<?= $item['nama_komoditas']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['volume']; ?></p>
                        </td>
                    </tr>
                <?php } ?>
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