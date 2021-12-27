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
                <?php
                $i = 1;
                $jumk53 = 0;
                $jum53 = 0;
                $jum54 = 0;
                $jum55 = 0;
                $jum56 = 0;
                $jum57 = 0;
                $jum58 = 0;
                $jum59 = 0;
                $jum60 = 0;
                $juml60 = 0;
                $jum0 = 0;
                $jumtot = 0;
                foreach ($rtprov as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++; ?></p>
                        </td>
                        <td class="align-left text-left text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama_prop']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kurang_53']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_53']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_54']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_55']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_56']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_57']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_58']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_59']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['pas_60']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['lebih_60']; ?></p>
                        </td>
                        <td class="align-center text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tidak_diisi']; ?></p>
                        </td>
                        <td class="align-center text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['kurang_53'] + $item['pas_53'] + $item['pas_54'] + $item['pas_55'] + $item['pas_56'] + $item['pas_57'] + $item['pas_58'] + $item['pas_59'] + $item['pas_60'] + $item['lebih_60'] + $item['tidak_diisi']; ?></p>
                        </td>
                    </tr>
                <?php
                    $jumk53 = $jumk53 + $item['kurang_53'];
                    $jum53 =  $jum53 + $item['pas_53'];
                    $jum54 =  $jum54 + $item['pas_54'];
                    $jum55 =  $jum55 + $item['pas_55'];
                    $jum56 =  $jum56 + $item['pas_56'];
                    $jum57 =  $jum57 + $item['pas_57'];
                    $jum58 =  $jum58 + $item['pas_58'];
                    $jum59 =  $jum59 + $item['pas_59'];
                    $jum60 =  $jum60 + $item['pas_60'];
                    $juml60 = $juml60 + $item['lebih_60'];
                    $jum0 = $jum0 + $item['tidak_diisi'];
                    $jumtot = $jum0 + ($item['kurang_53'] + $item['pas_53'] + $item['pas_54'] + $item['pas_55'] + $item['pas_56'] + $item['pas_57'] + $item['pas_58'] + $item['pas_59'] + $item['pas_60'] + $item['lebih_60'] + $item['tidak_diisi']);
                }
                ?>
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
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumk53 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum53 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum54 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum55 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum56 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum57 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum58 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum59 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum60 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $juml60 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jum0 ?></b></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-s font-weight-bold mb-0"><b><?= $jumtot ?></b></p>
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