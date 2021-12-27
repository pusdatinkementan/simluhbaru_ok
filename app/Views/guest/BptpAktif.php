<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Data Dasar Penyuluh Pertanian PNS Status Aktif<br>
        BPTP</h4>
</center>


<div class="card">
    <?php
    $tanggal_today = date('d');
    $bulan_today = date('m');
    $tahun_today = date('Y'); ?>
    <p class="text-xs font-weight-bold mb-0">Per : <?= $tanggal_today . '-' . $bulan_today . '-' . $tahun_today; ?></p>

    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td width=10 class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=200 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Nama Penyuluh<br>NIP<br>Jenis Kelamin</b></td>
                    <td width=100 class="text-uppercase text-secondary text-xxs font-weight-bolder"><b>Tempat Lahir<br>Tanggal Lahir<br>Usia</b></td>

                    <td width=100 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Pendidikan Formal<br>Bidang Pendidikan</b></td>
                    <td width=100 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Bidang Keahlian</b></td>
                    <td width=100 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>TMT CPNS<br>TMT PP</b></td>
                    <td width=150 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Jabatan PP<br>Gol/Ruang<BR>TMT</b></td>
                    <td width=100 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Angka Kredit Utama Terakhir</b></td>
                    <td width=100 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>No HP<br>Email</b></td>

                </tr>

            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($bptp as $row => $item) {
                    $tgllahir = $item['tgl_lahir'];
                    $ambilthnlhr = substr($tgllahir, 0, 4);
                    $ambilblnlhr = substr($tgllahir, 5, 2);
                    $ambiltgllhr = substr($tgllahir, 8, 2);

                    $tgl_lahir = $ambiltgllhr;
                    $bln_lahir = $ambilblnlhr;
                    $thn_lahir = $ambilthnlhr;
                    $tanggal_today = date('d');
                    $bulan_today = date('m');
                    $tahun_today = date('Y');
                    $harilahir = gregoriantojd($bln_lahir, $tgl_lahir, $thn_lahir);
                    $hariini = gregoriantojd($bulan_today, $tanggal_today, $tahun_today);
                    $umur = $hariini - $harilahir;

                    $tahun = $umur / 365; //menghitung usia tahun
                    $sisa = $umur % 365; //sisa pembagian dari tahun untuk menghitung bulan
                    $bulan = $sisa / 30; //menghitung usia bulan
                    $hari = $sisa % 30; //menghitung sisa hari
                    $lahir = $tgl_lahir - $bln_lahir - $thn_lahir;
                    $today = $tanggal_today - $bulan_today - $tahun_today;
                    $umur_th = floor($tahun);
                    $umur_bl = floor($bulan);
                    $tgl_tmtjab = substr($item['tgl_spk'], -2, 8);
                    $bln_tmtjab = substr($item['tgl_spk'], -4, -2);
                    $thn_tmtjab = substr($item['tgl_spk'], 0, 4);
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['gelar_dpn'] . ' ' . $item['nama'] . ' ' . $item['gelar_blk']; ?> <br> <?= $item['nip']; ?><br><?php if ($item['jenis_kelamin'] == "1") {
                                                                                                                                                                                    echo "Laki-Laki";
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo "Perempuan";
                                                                                                                                                                                } ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tempat_lahir']; ?><br> <?= $ambiltgllhr . '/' . $ambilblnlhr . '/' . $ambilthnlhr; ?> <br> <?= $umur_th . ' Tahun' . ' ' . $umur_bl . ' Bulan'; ?>
                            </p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tingkat_pendidikan']; ?> <br> <?= $item['bidang_pendidikan']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?php if ($item['keahlian'] == "1") {
                                                                            echo "Tanaman Pangan";
                                                                        } elseif ($item['keahlian'] == "2") {
                                                                            echo "Peternakan";
                                                                        }
                                                                        if ($item['keahlian'] == "3") {
                                                                            echo "Perkebunan";
                                                                        }
                                                                        if ($item['keahlian'] == "4") {
                                                                            echo "Hortikultura";
                                                                        } ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tgl_skcpns']; ?><br><?= $item['tgl_sk_luh'] . '/' . $item['tgl_sk_luh'] . '/' . $item['bln_sk_luh'] . '/' . $item['thn_sk_luh']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['desgol']; ?><br> <?= $item['gol_ruang']; ?> <br> <?= $tgl_tmtjab . '/' . $bln_tmtjab . '/' . $thn_tmtjab; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kredit_utama']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['hp']; ?><br><?= $item['email']; ?></p>
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