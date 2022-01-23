<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $sessnama = session()->get('nama'); ?>
<?php
if (empty(session()->get('status_user')) || session()->get('status_user') == '2') {
    $kode = '00';
} elseif (session()->get('status_user') == '1') {
    $kode = session()->get('kodebakor');
} elseif (session()->get('status_user') == '200') {
    $kode = session()->get('kodebapel');
} elseif (session()->get('status_user') == '300') {
    $kode = session()->get('kodebpp');
}

$api = 'https://api.pertanian.go.id/api/simantap/dashboard/list?&api-key=f13914d292b53b10936b7a7d1d6f2406&kode=' . $kode;
$result = file_get_contents($api, false);
$json = json_decode($result, true);
$data = $json[0];
?>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Page Heading -->
        <div class="row mt-3 mb-4">

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah BPP</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumbpp']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="far fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Poktan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpoktan']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Gapoktan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumgapoktan']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh PNS</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhpns']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBN</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhthlapbn']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBD</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhthlapbd']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swadaya</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhswadaya']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swasta</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        <?= number_format($data['jumpenyuluhswasta']); ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">

            <nav class="col-lg-12">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
                    <button class="nav-link" id="nav-penyuluh-tab" data-bs-toggle="tab" t type="button" role="tab" aria-controls="nav-penyuluh" aria-selected="false">Daftar Penyuluh</button>
                    <!-- <button class="nav-link" id="nav-sarpras-tab" data-bs-toggle="tab" data-bs-target="#nav-sarpras" type="button" role="tab" aria-controls="nav-sarpras" aria-selected="false">Sarana & Prasarana</button>
                    <button class="nav-link" id="nav-pokom-tab" data-bs-toggle="tab" data-bs-target="#nav-pokom" type="button" role="tab" aria-controls="nav-pokom" aria-selected="false">Potensi Ekonomi</button>
                    <button class="nav-link" id="nav-powil-tab" data-bs-toggle="tab" data-bs-target="#nav-powil" type="button" role="tab" aria-controls="nav-powil" aria-selected="false">Potensi Wilayah</button> -->
                </div>
            </nav>
            <div class="tab-content " id="nav-tabContent">
                <div class="tab-pane  fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-lg-9 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">



                                        <h1 class="h3 mb-4 text-gray-800">
											<?= $title; ?>
											<div style="float:right">
												<a data-bs-toggle="modal" data-bs-target="#modal-form" id="btn-edit" data-id_bakor="<?= $dt['id_bakor']; ?>"><i class="fas fa-edit"></i></a>&nbsp; &nbsp;
												<a href="<?php echo site_url('/profil/cetaklembaga'); ?>" target="_blank" id="btn-edit"><i class="fas fa-file-pdf"></i></a>
											</div>
										</a></h1>

                                        <div class="col-lg-12">                                           
                                                <table class="table" id="profil" >
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Kelembagaan</td>
                                                            <td>:</td>
                                                            <td ><?= $dt['deskripsi_lembaga_lain']; ?> <?= $sessnama; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pembentukan lembaga</td>
                                                            <td>:</td>
                                                            <td><?= format_date($dt['thn_berdiri'] . '-' . $dt['bln_berdiri'] . '-' . $dt['tgl_berdiri'], 2).' ('.$dt['dasar_hukum'].' '.(($dt['no_peraturan'] <> '') ? ' No. '.$dt['no_peraturan']: '').')'; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td> <?= $dt['alamat']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Provinsi</td>
                                                            <td>:</td>
                                                            <td><?= $namaprov; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Titik Koordinat Lembaga</td>
                                                            <td>:</td>
                                                            <td>
															<?php echo ($dt['koordinat'] <> '') ? '<a href="https://www.google.com/maps/?q='.$dt['koordinat'].'" target="_blank"><i class="fas fa-map-marker-alt"></i> '.$dt['koordinat'].'</a>' : '' ; ?>
															</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Pimpinan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['ketua']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>No HP Pimpinan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_hp']; ?></td>
                                                        </tr>
                                                        
														<tr>
                                                            <td>Nama Kepala <?php echo ($dt['eselon3_luh'] == '') ? 'Unit Kerja' : $dt['eselon3_luh']; ?> yang Menangani Penyuluhan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['nama_kabid'].(($dt['nama_bidang_luh'] <> '') ? ' (Kepala '.$dt['nama_bidang_luh'].')' : ''); ?></td>
                                                        </tr>
														<tr>
                                                            <td>No HP Kepala <?php echo ($dt['eselon3_luh'] == '') ? 'Unit Kerja' : $dt['eselon3_luh']; ?> yang Menangani Penyuluhan</td>
                                                            <td>:</td>
                                                            <td><?= $dt['hp_kabid']; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Nama Kepala Seksi yang Menangani Penyuluhan</td>
                                                            <td>:</td>
                                                             <td><?= $dt['nama_kasie'].(($dt['seksi_luh'] <> '') ? ' (Kepala '.$dt['seksi_luh'].')' : ''); ?></td>
                                                        </tr>
														
														<tr>
                                                            <td>No HP Kepala Seksi </td>
                                                            <td>:</td>
                                                            <td><?= $dt['hp_kasie']; ?></td>
                                                        </tr>
														
														
														<tr>
                                                            <td>Nama Koordinator PP</td>
                                                            <td>:</td>
                                                            <td><?= $dt['namakoord']; ?></td>
                                                        </tr>
														<tr>
                                                            <td>No Telepon/Fax</td>
                                                            <td>:</td>
                                                            <td><?= $dt['telp_kantor'].'/'.$dt['fax_kantor']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat Email</td>
                                                            <td>:</td>
                                                            <td><?= $dt['email']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat Website</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['website'] <> '') ? '<a href="'.$dt['website'].'" target="_blank"><i class="fas fa-globe"></i> '.$dt['website'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Instagram Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['instagram'] <> '') ? '<a href="http://instagram.com/'.$dt['instagram'].'" target="_blank"><i class="fab fa-instagram"></i> '.$dt['instagram'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Facebook Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['facebook'] <> '') ? '<a href="http://facebook.com/'.$dt['facebook'].'" target="_blank"><i class="fab fa-facebook"></i> '.$dt['facebook'].'</a>' : '' ; ?></td>
                                                        </tr>
														<tr>
                                                            <td>Akun Twitter Lembaga</td>
                                                            <td>:</td>
                                                            <td><?php echo ($dt['twitter'] <> '') ? '<a href="http://twitter.com/'.$dt['twitter'].'" target="_blank"><i class="fab fa-twitter"></i> '.$dt['twitter'].'</a>' : '' ; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-lg-3 mb-lg-0 mb-4 text-center">
                            <div class="card">
                                <div class="card-body p-3 ">

                                    <img src="<?php if ($fotoprofil == '') {
                                                    echo base_url('assets/img/logo.png');
                                                } else {
                                                    echo base_url('assets/img/' . $fotoprofil);
                                                }  ?>" width="150px" class="img-thumbnail" alt="profil">

                                </div>
                                <!-- <a href="<?= base_url('profil/lembaga/editfoto') ?>" class="btn btn-primary btn-lg w-100 btn-sm">Upload</a> -->
                                <button type="button" class="btn btn-primary btn-lg w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto" id="uploadbtn">Change Picture</button>

                            </div>
                        </div>


                    </div>
                </div>

                <div class="tab-pane fade" id="nav-penyuluh" role="tabpanel" aria-labelledby="nav-penyuluh-tab">
                    <div class="row">

                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <h4 class="h3 mb-4 text-gray-800">Daftar Penyuluh Yang Bertugas di Provinsi</h4>
                                        <div class="col-sm-4">
                                            <h5><span>Jumlah Penyuluh PNS</span></h5>
                                        </div>
                                        <div class="col-sm-4"><span>(<?= $jum_pns; ?> Orang)</span></div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <table class="table align-items-center mb-0">
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($datapns as $row => $pns) {
                                                        ?>
                                                            <tr>
                                                                <td class="align-middle text-center text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                                                </td>
                                                                <td class="align-middle text-sm">
                                                                    <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluh/detail/' . $pns['nip']) ?>"><?= $pns['nip'].' - '.$pns['nama']; ?></p>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>

        <?php
        $i = 1;
        foreach ($tabel_data as $row => $item) {
        ?>
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Edit Data</h4>
                                </div>
                                <div class="card-body">

                                    <form method="POST" role="form text-left">
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" name="id_bakor" id="id_bakor">
                                                <label for="prov">Propinsi</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="prov" value="<?= $item['nama_prop']; ?>" disabled>
                                                </div>
                                                <label for="kode_desa">Jenis Kelembagaan</label>
                                                <div class="input-group mb-3">
                                                    <select name="nama_bapel" id="nama_bapel" class="form-control input-lg">
                                                        <option value="">Pilih</option>
                                                        <OPTION value="21">Badan<BR>
                                                        <OPTION value="22">Dinas<BR>
                                                    </select>
                                                </div>
                                                <label>Nomenklatur :</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="deskripsi_lembaga_lain" placeholder="" value="<?= $item['deskripsi_lembaga_lain']; ?>" name="deskripsi_lembaga_lain">
                                                </div>
                                                <label for="ketua">Nama Kepala Dinas</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ketua" placeholder="Nama Kepala Dinas" value="<?= $item['ketua']; ?>" name="ketua">
                                                    
                                                </div>
												<label for="telp_hp">No.HP Kepala Dinas</label>
                                                <div class="input-group mb-3">                                                   
                                                    <input type="text" style="margin-left: 5px;" class="form-control" id="telp_hp" placeholder="No. HP" name="telp_hp" onkeypress="return Angka(event)">
                                                </div>

                                                <label>Nama Koordinator Penyuluh</label>
                                                <div class="input-group mb-3">
                                                    <select name="nama_koord_penyuluh pen" id="nama_koord_penyuluh" class="form-control input-lg">

                                                        <?php
														
                                                        foreach ($pnsprov as $row) {
															$select = ($item['nip'] == $row["nip"]) ? " selected='selected' " : "";
                                                            echo '<option value="' . $row["nip"] . '" '.$select.'>' . $row["nip"] . '-' . $row["nama"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <label for="ketua">Unit Kerja yang menangani penyuluhan</label>
                                                <div class="input-group mb-3">
                                                    <select name="eselon3_luh" id="eselon3_luh" class="form-control input-lg">
                                                        <option value="">Pilih</option>
                                                        <OPTION value="BIDANG">BIDANG<BR>
                                                        <OPTION value="SEKSI">SEKSI<BR>
                                                        <OPTION value="UPTD">UPTD<BR>
                                                    </select>
                                                </div>
                                                <label for="ketua">Nama Bidang / UPTD yang Menangani Penyuluhan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="nama_bidang_luh" placeholder="Bidang" name="nama_bidang_luh">
                                                </div>
                                                <label for="ketua">Nama Kepala Bidang / UPTD</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="nama_kabid" placeholder="Nama Kabid" name="nama_kabid">
                                                </div>
												<label for="hp_kabid">No.HP Kepala Bidang / UPTD</label>
                                                <div class="input-group mb-3">                                                    
                                                    <input type="text" style="margin-left: 5px;" class="form-control" id="hp_kabid" placeholder="No. HP" name="hp_kabid" onkeypress="return Angka(event)">
                                                </div>
                                                <label for="seksi_luh">Nama seksi yang menangani penyuluhan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="seksi_luh" placeholder="Nama seksi" name="seksi_luh">
                                                </div>
                                                <label for="nama_kasie">Nama Kepala Seksi</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="nama_kasie" name="nama_kasie" placeholder="Nama Kepala Seksi">
                                                </div>
												 <label for="hp_kasie">No.HP Kepala Seksi</label>
                                                <div class="input-group mb-3">
													<input type="text" style="margin-left: 5px;" class="form-control" id="hp_kasie" name="hp_kasie" placeholder="No. HP" onkeypress="return Angka(event)">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="alamat">Dasar Hukum Pembentukan</label>
                                                <select name="dasar_hukum" id="dasar_hukum" class="form-control input-lg">
                                                    <option value="">Pilih</option>
                                                    <option value="PERDA">PERDA</option>
                                                    <option value="PERGUB">PERGUB</option>
                                                </select>
                                                <label for="ketua">No Peraturan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="no_peraturan" placeholder="Nomor Peraturan" name="no_peraturan">
                                                </div>
                                                <label for="ketua">Tanggal Pembentukan</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="tglpembentukan" placeholder="Tanggal Pembentukan" name="tglpembentukan" required>
                                                </div>
                                                <label for="alamat">Alamat Kantor</label>
                                                <div class="input-group mb-3">
                                                    <textarea type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat"></textarea>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <label for="jum_anggota">Titik koordinat (GPS Point)
                                                        <input type="text" class="form-control" id="koordinat" name="koordinat"><br>
                                                        <label>Format titik koordinat adalah Decimal Degree, contoh : -6.2924034,106.820540</label>
                                                    </label>
                                                </div>
                                                <label for="ketua">No.Telepon/Fax</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="telp_kantor" placeholder="No Telp Kantor" name="telp_kantor" onkeypress="return Angka(event)">
                                                </div>
                                                <label for="ketua">Alamat Email</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="email" placeholder="email" name="email">
                                                </div>
                                                <label for="ketua">Alamat Website/Blog</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="website" placeholder="Alamat website" name="website">
                                                </div>
												<label for="ketua">Akun Instagram Lembaga</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="instagram" placeholder="Akun Instagram" name="instagram">
                                                </div>
												<label for="ketua">Akun Facebook Lembaga</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="facebook" placeholder="Akun Facebook" name="facebook">
                                                </div>
												<label for="ketua">Akun Twitter Lembaga</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="twitter" placeholder="Akun Twitter" name="twitter">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" onclick="submitform()"  id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFoto" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('profil/lembaga/saveProfil'); ?>">


                            <div class="col-lg-3 mb-lg-0 text-center">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <img src="<?php if ($fotoprofil == '') {
                                                        echo base_url('assets/img/logo.png');
                                                    } else {
                                                        echo base_url('assets/img/' . $fotoprofil);
                                                    }  ?>" width="150px" class="img-thumbnail" alt="profil">
                                    </div>
                                </div>


                            </div>


                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="foto" name="foto">
                                <label class="input-group-text" for="foto">Pilih Foto</label>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnSave" class="btn bg-gradient-info">Simpan</button>
                    </div>
                    </form>

                </div>

            </div>
        </div>
				
				
            </div>
        <?php } ?>

        <?php echo view('layout/footer'); ?>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script type="text/javascript">
    function Angka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    $(function() {
        $('input[name="tglpembentukan"]').daterangepicker({
            format: 'dd/MM/YYYY',
            indonesianDate: true,
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1950
        });
    });

    function submitform() {
        var f = document.getElementsByTagName('form')[0];
        if (f.checkValidity()) {
            f.submit();
        } else {
            alert(document.getElementById('example').validationMessage);
        }
    }

    $(document).ready(function() {
		
	
		
        $(document).delegate('#btn-edit', 'click', function() {
			
			//alert('test');
            //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
            // alert(id);
            $.ajax({
                url: '<?= base_url() ?>/profil/Lembaga/detailProv/' + $(this).data('id_bakor'),
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    // $(".daftpos").html(res)
                    //console.log(res);
                    //res = JSON.parse(res);

                    $('#id_bakor').val(res[0].id_bakor);
                    $('#nama_bapel').val(res[0].nama_bapel);
                    $('#dasar_hukum').val(res[0].dasar_hukum);
                    $('#no_peraturan').val(res[0].no_peraturan);
                    $('#tglpembentukan').val(res[0].tgl_berdiri + '/' + res[0].bln_berdiri + '/' + res[0].thn_berdiri);
                    $('#alamat').val(res[0].alamat);
                    $('#deskripsi_lembaga_lain').val(res[0].deskripsi_lembaga_lain);
                    $('#telp_kantor').val(res[0].telp_kantor);
                    $('#email').val(res[0].email);
                    $('#website').val(res[0].website);
                    $('#ketua').val(res[0].ketua);
                    $('#koordinat').val(res[0].koordinat);
                    $('#telp_hp').val(res[0].telp_hp);
                    $('#eselon3_luh').val(res[0].eselon3_luh);
                    $('#nama_bidang_luh').val(res[0].nama_bidang_luh);
                    $('#nama_kabid').val(res[0].nama_kabid);
                    $('#hp_kabid').val(res[0].hp_kabid);
                    $('#seksi_luh').val(res[0].seksi_luh);
                    $('#nama_kasie').val(res[0].nama_kasie);
                    $('#hp_kasie').val(res[0].hp_kasie);
                    $('#nama_koord_penyuluh').val(res[0].nama_koord_penyuluh);
					$('#twitter').val(res[0].twitter);
					$('#instagram').val(res[0].instagram);
					$('#facebook').val(res[0].facebook);
					
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
						
                        tglpembentukan = $('#tglpembentukan').val();
                        tgl = tglpembentukan.substr(0, 2);
                        bln = tglpembentukan.substr(3, 2);
                        thn = tglpembentukan.substr(6, 4);

                        var id_bakor = $('#id_bakor').val();
                        var deskripsi_lembaga_lain = $('#deskripsi_lembaga_lain').val();
                        var nama_bapel = $('#nama_bapel').val();
                        var dasar_hukum = $('#dasar_hukum').val();
                        var no_peraturan = $('#no_peraturan').val();
                        var tgl_berdiri = tgl;
                        var bln_berdiri = bln;
                        var thn_berdiri = thn;
                        var alamat = $('#alamat').val();
                        var telp_kantor = $('#telp_kantor').val();
                        var email = $('#email').val();
                        var website = $('#website').val();
                        var ketua = $('#ketua').val();
                        var telp_hp = $('#telp_hp').val();
                        var koordinat = $('#koordinat').val();
                        var eselon3_luh = $('#eselon3_luh').val();

                        var nama_bidang_luh = $('#nama_bidang_luh').val();
                        var nama_kabid = $('#nama_kabid').val();
                        var hp_kabid = $('#hp_kabid').val();
                        var seksi_luh = $('#seksi_luh').val();
                        var nama_kasie = $('#nama_kasie').val();
                        var hp_kasie = $('#hp_kasie').val();
                        var nama_koord_penyuluh = $('#nama_koord_penyuluh').val();
						var twitter = $('#twitter').val();
						var instagram = $('#instagram').val();
						var facebook = $('#facebook').val();
						
						/*
                        if (nama_bapel == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Jenis Kelembagaan Harus Di Pilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (deskripsi_lembaga_lain.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomenklatur Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (ketua.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Ketua Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (telp_hp.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor HP Ketua Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
                        if (nama_koord_penyuluh == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Koordinator Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;

                        }

                        if (eselon3_luh == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Unit Kerja Harus Dipiplih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (nama_bidang_luh.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Bidang Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (nama_kabid.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Kepala Bidang Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (hp_kabid.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor HP Kepala Bidang Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (seksi_luh.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Seksi Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (nama_kasie.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Kepala Seksi Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (hp_kasie.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "NOmor HP Kepala Seksi Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (dasar_hukum == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Dasar Hukum Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (no_peraturan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nomor Peraturan Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (tglpembentukan.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Tanggal Pembentukan Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (alamat.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Alamat Kantor Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                       
                        if (telp_kantor.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Telepon Kantor Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }

                        if (email.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Email Kantor Harus Diisi",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;
                        }
						*/

                        let formData = new FormData();
                        formData.append('id_bakor', id_bakor);
                        formData.append('nama_bapel', nama_bapel);
                        formData.append('deskripsi_lembaga_lain', deskripsi_lembaga_lain);
                        formData.append('dasar_hukum', dasar_hukum);
                        formData.append('no_peraturan', no_peraturan);
                        formData.append('tgl_berdiri', tgl_berdiri);
                        formData.append('bln_berdiri', bln_berdiri);
                        formData.append('thn_berdiri', thn_berdiri);
                        formData.append('alamat', alamat);
                        formData.append('telp_kantor', telp_kantor);
                        formData.append('email', email);
                        formData.append('website', website);
                        formData.append('ketua', ketua);
                        formData.append('koordinat', koordinat);
                        formData.append('eselon3_luh', eselon3_luh);
                        formData.append('telp_hp', telp_hp);
                        formData.append('nama_bidang_luh', nama_bidang_luh);
                        formData.append('nama_kabid', nama_kabid);
                        formData.append('hp_kabid', hp_kabid);
                        formData.append('seksi_luh', seksi_luh);
                        formData.append('nama_kasie', nama_kasie);
                        formData.append('hp_kasie', hp_kasie);
                        formData.append('nama_koord_penyuluh', nama_koord_penyuluh);
						formData.append('twitter', twitter);
						formData.append('instagram', instagram);
						formData.append('facebook', facebook);
						
                        $.ajax({
                            url: '<?= base_url() ?>/profil/Lembaga/updateprov/' + id_bakor,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
								//alert('berhasil');
                                $('#modal-form').modal('hide');
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses edit data",
                                    type: 'success',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
										window.location.href = '<?= base_url() ?>/lembaga';
                                    }
                                });

                            },
                            error: function(jqxhr, status, exception) {
								//alert('gagal');
                                Swal.fire({
                                    title: 'Error',
                                    text: "Gagal edit data",
                                    type: 'Error',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });

                            }
                        });
                    });

                }
            });

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

        });
    });
</script>




<script type="text/javascript">
    function loadingproses() {
        $('.backDrop').show();
        $('.backDrop_content').fadeIn('slow');
    }

    function loadingproses_close() {
        $('.backDrop').hide();
        $('.backDrop_content').fadeOut('slow');
    }

    $('#prov').on('change', function() {
        $('#kec').html('');
        $('#desa').html('');
        const id = $('#prov').val();
        var kdprov = id.substring(0, 2);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showKab/" + kdprov + "",
            success: function(response) {
                console.log(response);
                $("#kab").html(response);
            },
            dataType: "html"
        });
        return false;
    });


    $('#kab').on('change', function() {
        $('#desa').html('');
        const id = $('#kab').val();
        var kdkab = id.substring(0, 4);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showKec/" + kdkab + "",
            success: function(response) {
                console.log(response);
                $("#kec").html(response);
            },
            dataType: "html"
        });
        return false;
    });

    $('#kec').on('change', function() {

        const id = $('#kec').val();
        var kdkec = id.substring(0, 6);

        $.ajax({
            url: "<?= base_url() ?>/master/wilayah/showDesa/" + kdkec + "",
            success: function(response) {
                $("#desa").html(response);
            },
            dataType: "html"
        });
        return false;
    });
</script>

<?= $this->endSection() ?>