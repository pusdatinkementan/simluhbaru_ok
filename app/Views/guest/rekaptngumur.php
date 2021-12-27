<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4>Rekap Ketenagaan Penyuluhan Tingkat Nasional (Berdasarkan Usia)</h4>
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
                    <td width=23 rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width=170 rowspan="3" class="text-uppercase text-secondary text-xxs font-weight-bolder" align="center"><b>Unit Kerja</b></td>
                </tr>
                <tr>
                    <td colspan="11" class="text-uppercase text-secondary text-xxs font-weight-bolder" align="center"><b>Usia</b></td>
                    <td rowspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>Total</b></td>
                </tr>
                <tr>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>
                            < 53</b>
                    </td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>53</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>54</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>55</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>56</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>57</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>58</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>59</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>60</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>> 60</b></td>
                    <td width=99 size=2 class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;"><b>TIdak Diisi</b></td>

                </tr>

            </thead>
            <tbody>
                <tr>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">1</p>
                    </td>
                    <td class="align-left text-left text-sm">
                        <a href="<?= base_url('/rekaptngumur_pst') ?>" style="color: blue;">
                            <p class="text-xs font-weight-bold mb-0">Pusat</p>
                        </a>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_kurang_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_54; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_55; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_56; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_57; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_58; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_59; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_pas_60; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_lebih_60; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_tidak_diisi; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pst_kurang_53 + $pst_pas_53 + $pst_pas_54 + $pst_pas_55 + $pst_pas_56 + $pst_pas_57 + $pst_pas_58 + $pst_pas_59 + $pst_pas_60 + $pst_lebih_60 + $pst_tidak_diisi; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">2</p>
                    </td>
                    <td class="align-left text-left text-sm">
                        <a href="<?= base_url('/rekaptngumur_prov') ?>" style="color: blue;">
                            <p class="text-xs font-weight-bold mb-0">Provinsi</p>
                        </a>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_kurang_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_54; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_55; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_56; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_57; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_58; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_59; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_pas_60; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_lebih_60; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_tidak_diisi; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $prov_kurang_53 + $prov_pas_53 + $prov_pas_54 + $prov_pas_55 + $prov_pas_56 + $prov_pas_57 + $prov_pas_58 + $prov_pas_59 + $prov_pas_60 + $prov_lebih_60 + $prov_tidak_diisi; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">3</p>
                    </td>
                    <td class="align-left text-left text-sm">
                        <p class="text-xs font-weight-bold mb-0">Kabupaten</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_kurang_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_54; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_55; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_56; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_57; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_58; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_59; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_pas_60; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_lebih_60; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_tidak_diisi; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kab_kurang_53 + $kab_pas_53 + $kab_pas_54 + $kab_pas_55 + $kab_pas_56 + $kab_pas_57 + $kab_pas_58 + $kab_pas_59 + $kab_pas_60 + $kab_lebih_60 + $kab_tidak_diisi; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">4</p>
                    </td>
                    <td class="align-left text-left text-sm">
                        <p class="text-xs font-weight-bold mb-0">BPTP</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_kurang_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_54; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_55; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_56; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_57; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_58; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_59; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_pas_60; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_lebih_60; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_tidak_diisi; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $bptp_kurang_53 + $bptp_pas_53 + $bptp_pas_54 + $bptp_pas_55 + $bptp_pas_56 + $bptp_pas_57 + $bptp_pas_58 + $bptp_pas_59 + $bptp_pas_60 + $bptp_lebih_60 + $bptp_tidak_diisi; ?></p>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b>J U M L A H</b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_kurang_53 + $prov_kurang_53 + $kab_kurang_53 + $bptp_kurang_53 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_53 + $prov_pas_53 + $kab_pas_53 + $bptp_pas_53 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_54 + $prov_pas_54 + $kab_pas_54 + $bptp_pas_54 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_55 + $prov_pas_55 + $kab_pas_55 + $bptp_pas_55 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_56 + $prov_pas_56 + $kab_pas_56 + $bptp_pas_56 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_57 + $prov_pas_57 + $kab_pas_57 + $bptp_pas_57 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_58 + $prov_pas_58 + $kab_pas_58 + $bptp_pas_58 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_59 + $prov_pas_59 + $kab_pas_59 + $bptp_pas_59 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_pas_60 + $prov_pas_60 + $kab_pas_60 + $bptp_pas_60 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_lebih_60 + $prov_lebih_60 + $kab_lebih_60 + $bptp_lebih_60 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pst_tidak_diisi + $prov_tidak_diisi + $kab_tidak_diisi + $bptp_tidak_diisi ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= ($pst_kurang_53 + $pst_pas_53 + $pst_pas_54 + $pst_pas_55 + $pst_pas_56 + $pst_pas_57 + $pst_pas_58 + $pst_pas_59 + $pst_pas_60 + $pst_lebih_60 + $pst_tidak_diisi) + ($prov_kurang_53 + $prov_pas_53 + $prov_pas_54 + $prov_pas_55 + $prov_pas_56 + $prov_pas_57 + $prov_pas_58 + $prov_pas_59 + $prov_pas_60 + $prov_lebih_60 + $prov_tidak_diisi) + ($kab_kurang_53 + $kab_pas_53 + $kab_pas_54 + $kab_pas_55 + $kab_pas_56 + $kab_pas_57 + $kab_pas_58 + $kab_pas_59 + $kab_pas_60 + $kab_lebih_60 + $kab_tidak_diisi) + ($bptp_kurang_53 + $bptp_pas_53 + $bptp_pas_54 + $bptp_pas_55 + $bptp_pas_56 + $bptp_pas_57 + $bptp_pas_58 + $bptp_pas_59 + $bptp_pas_60 + $bptp_lebih_60 + $bptp_tidak_diisi) ?></b></p>
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

<?= $this->endSection() ?>


<?= $this->section('script') ?>


<?= $this->endSection() ?>