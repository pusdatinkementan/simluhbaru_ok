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
                        <p class="text-xs font-weight-bold mb-0"><?= $nama; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kurang_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_54; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_55; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_56; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_57; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_58; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_59; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $pas_60; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $lebih_60; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $tidak_diisi; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $kurang_53 + $pas_53 + $pas_54 + $pas_55 + $pas_56 + $pas_57 + $pas_58 + $pas_59 + $pas_60 + $lebih_60 + $tidak_diisi; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">2</p>
                    </td>
                    <td class="align-left text-left text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $nama2; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $krg_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_53; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_54; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_55; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_56; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_57; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_58; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_59; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $ps_60; ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $lbh_60; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $tdk_diisi; ?></p>
                    </td>
                    <td class="align-center text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $krg_53 + $ps_53 + $ps_54 + $ps_55 + $ps_56 + $ps_57 + $ps_58 + $ps_59 + $ps_60 + $lbh_60 + $tdk_diisi; ?></p>
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $kurang_53 + $krg_53 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_53 + $ps_53 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_54 + $ps_54 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_55 + $ps_55 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_56 + $ps_56 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_57 + $ps_57 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_58 + $ps_58 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_59 + $ps_59 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $pas_60 + $ps_60 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $lebih_60 + $lbh_60 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $tidak_diisi + $tdk_diisi ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= ($kurang_53 + $pas_53 + $pas_54 + $pas_55 + $pas_56 + $pas_57 + $pas_58 + $pas_59 + $pas_60 + $lebih_60 + $tidak_diisi) + ($krg_53 + $ps_53 + $ps_54 + $ps_55 + $ps_56 + $ps_57 + $ps_58 + $ps_59 + $ps_60 + $lbh_60 + $tdk_diisi) ?></b></p>
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