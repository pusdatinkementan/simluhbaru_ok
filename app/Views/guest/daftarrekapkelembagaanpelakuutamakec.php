<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>

<br>
<br>
<center>
    <h4>Rekap Kelembagaan Pelaku Utama Per Kabupaten/Kota </h4>
   
</center>
<br>
<div class="container">
<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Provinsi</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Kelompok<br>Tani</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Gabungan<br>Kelompok<br>Tani</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah<br>Kelembagaan<br>Ekonomi<br>Petani</td>
                    <td align="center" class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah</td>
                    
                    
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $jumpns=0;
                $jumthlapbn=0;
                $jumthlapbd=0;
                foreach ($rkpukec as $row => $item) {
                ?>
                    <tr>
                        <td align="center" class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['nama_bpp'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pns'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['pnsTB'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['thl_apbn'] ?></p>
                            </a>
                        </td>
                        <td class="align-middle text-center text-sm">
                                <p class="text-xs font-weight-bold mb-0" style="text-align: center;"><?= $item['thl_apbn'] + $item['pnsTB'] + $item['pns'] ?></p>
                            </a>
                        </td>
                    </tr>
                <?php
                $jumpns = $jumpns +$item['pns'];
                $jumthlapbn = $jumthlapbn +$item['pnsTB'];
                $jumthlapbd = $jumthlapbd +$item['thl_apbn'];
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">JUMLAH</p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $jumpns ?></p>
                    </th>
                
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $jumthlapbn ?></p>
                    </th>
                    
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $jumthlapbd ?></p>
                    </th>
                    
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $jumthlapbd + $jumpns + $jumthlapbn ?></p>
                    </th>

                </tr>
            
                <tr>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"></p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">Jumlah poktan berada di kecamatan yang belum dipetakan BP3K</p>
                    </th>
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $nomap ?></p>
                    </th>
                
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $nomap_gap ?></p>
                    </th>
                    
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $nomap_kep ?></p>
                    </th>
                    
                    <th class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $nomap + $nomap_gap + $nomap_kep ?></p>
                    </th>

                </tr>
            </tfoot>
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