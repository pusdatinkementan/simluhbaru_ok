<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $seskab = session()->get('kodebapel'); ?>
<center>
    <h3>Daftar Penyuluh Swadaya Kab <?= ucwords(strtolower($nama_kabupaten)) ?></h3>
	 <p>Ditemukan <?= $jml_data ?> data</p>
</center>

<div class="container-fluid py-4">
            <div class="row">    
               
               <div class="col-md-3">
               </div>    
               <div class="col-md-9" style="text-align:right">  
					<button class="btn bg-gradient-success btn-sm" onclick="showfilter()"  name="pencarian" >&nbsp; <i class="fas fa-search"></i> Filter</button>			   
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
            </div>   
			
			<div class="row" id="filter" style="display:none">
			
					<div class="col-md-4">
						<form method="POST" action="<?= base_url('Penyuluh/PenyuluhSwadaya/viewfilter'); ?>">
						<label>Provinsi</label>
						
						<div class="input-group mb-3">
								<select name="filter_prov" id="filter_prov" class="form-control">
									<?php if(count($list_prov) > 1) {?>
										<option value="">Pilih Provinsi</option>
									<?php } ?>
									<?php foreach($list_prov as $row){
										echo '<option value="' . $row["id_prop"] . '">' . $row["nama_prop"] . '</option>';
									} ?>
								</select>
						</div>
					</div>
					<div class="col-md-4">    
						<label>Kabupaten</label>
							<div class="input-group mb-3">
								<select name="filter_kab" id="filter_kab" class="form-control">
									<?php if(count($list_kab) > 1) {?>
										<option value="">Pilih Kabupaten</option>
									<?php } ?>
									<?php foreach($list_kab as $row){
										echo '<option value="' . $row["id_dati2"] . '">' . $row["nama_dati2"] . '</option>';
									} ?>
								</select>
						</div>
					</div>
					<div class="col-md-4">      
						<label>Kecamatan</label>
							<div class="input-group mb-3">
								<select name="filter_kec" id="filter_kec" class="form-control">
									<?php if(count($list_kec) > 1) {?>
										<option value="">Pilih Kecamatan</option>
									<?php } ?>
									<?php foreach($list_kec as $row){
										echo '<option value="' . $row["id_daerah"] . '">' . $row["deskripsi"] . '</option>';
									} ?>
								</select>
						</div>
					</div>
					<div class="col-md-4">     
						 <button type="submit" name="filter_submit" class="btn bg-gradient-warning btn-sm">Filter</button>
					</div>
					 </form>   
				</div>
			
            <br>
<div class="card">
    <div class="table-responsive">
        <table id="tblswadaya" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td class="text-uppercase text-secondary text-xxs"></td>
                    <td class="text-uppercase text-secondary text-xxs">NoKTP</td>
                    <td class="text-uppercase text-secondary text-xxs">Nama</td>
                    <td class="text-uppercase text-secondary text-xxs">UnitKerja</td>
                    <td class="text-uppercase text-secondary text-xxs">TempatTugas</td>
                    <td class="text-uppercase text-secondary text-xxs">WilayahKerja</td>
                    <td class="text-uppercase text-secondary text-xxs">TerakhirUpdate</td>
                    <td class="text-uppercase text-secondary text-xxs"></td>
                </tr>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No KTP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Unit Kerja (BP3k)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tempat Tugas<br>(Kecamatan)</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Wilayah Kerja</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Terakhir<br>Update</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($tabel_data as $row) {
                ?>
                    <tr>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluhswadaya/detail/' . $row['noktp']) ?>"><?= $row['noktp'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['nama'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['nama_bpp'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['deskripsi'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0">
								<?php
									for ($y=1;$y<=5;$y++){
										$field = ($y=='1') ? 'wil_ker' : 'wil_ker'.$y;
										echo ($row[$field] == '') ? '' : $y.'. '.$row[$field].'<br />';
									}
								?>
							</p>								
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_update'] ?></p>
                        </td>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="#">
                                <button type="button" id="btnEdit" data-id_swa="<?= $row['id_swa']; ?>" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                            </a>
                            <a href="#">
                            <button class="btn bg-gradient-danger btn-sm" id="btnHapus" data-id_swa="<?= $row['id_swa']; ?>" type="submit" onclick="return confirm('Are you sure ?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            </a>
                            
                            <a href="#">
                                            <button type="button" id="btnEditStatus" data-id_swa="<?= $row['id_swa']; ?>" class="btn bg-gradient-info btn-sm">
                                                <i class="fas fa-edit"></i> Manajemen Status
                                            </button>
                                        </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= base_url('Penyuluh/PenyuluhSwadaya/save'); ?>">
                                    <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="id_swa" id="id_swa" class="form-control id_swa">
                                            <input type="hidden" name="jenis_penyuluh" id="jenis_penyuluh" class="form-control jenis_penyuluh" value="4">
                                            <input type="hidden" name="satminkal" id="satminkal" class="form-control satminkal" value="<?= $seskab; ?>">
                                            <input type="hidden" name="kode_kab" id="kode_kab" class="form-control kode" value="<?= $seskab; ?>">
                                            <input type="hidden" name="mapping" id="mapping" class="form-control mapping" value="yes">
                                            <label>Status Penyuluh</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" value="Swadaya" disabled>
                                            </div>
                                            <label>No. KTP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="noktp" id="noktp" class="form-control noktp" placeholder="No. KTP" maxlength="16" oninput="NikOnly(this)">
                                            </div>
                                            <label>Nama</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="nama" id="nama" class="form-control nama" placeholder="Nama">
                                            </div>
                                            <label>Tempat, Tanggal Lahir</label>
                                            <div class="input-group mb-1">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir" placeholder="Tempat Lahir">
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" name="tgllahir" id="tgllahir" class="form-control tgllahir" placeholder="Tanggal Lahir">
                                            </div>
                                            <input type="hidden" name="tgl_lahir" class="form-control" placeholder="Tgl SPMT">
                                            <input type="hidden" name="bln_lahir" class="form-control" placeholder="Tgl SPMT">
                                            <input type="hidden" name="thn_lahir" class="form-control" placeholder="Tgl SPMT">
                                            <label>Jenis Kelamin</label>
                                            <div class="input-group mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input jenis_kelamin" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input jenis_kelamin" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="2">
                                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                                </div>
                                            </div>
                                            <label>Status Pernikahan</label>
                                            <div class="input-group mb-3">
                                                <select id="status_kel" name="status_kel" class="form-select" aria-label="Default select example">
                                                    <option selected>Pilih Status Pernikahan</option>
                                                    <option value="1">Menikah</option>
                                                    <option value="2">Belum Menikah</option>
                                                    <option value="3">Janda</option>
                                                    <option value="4">Duda</option>
                                                </select>
                                            </div>
                                            <label>Agama</label>
                                            <div class="input-group mb-3">
                                                <select id="agama" name="agama" class="form-select" aria-label="Default select example">
                                                    <option selected value="">Pilih Agama</option>
                                                    <option value="1">Islam</option>
                                                    <option value="2">Kristen Protestan</option>
                                                    <option value="3">Khatolik</option>
                                                    <option value="4">Hindu</option>
                                                    <option value="5">Budha</option>
                                                </select>
                                            </div>
                                            <label>Tingkat Pendidikan</label>
                                            <div class="input-group mb-3">
                                                <select id="tingkat" name="tingkat" class="form-select" aria-label="Default select example">
                                                    <option selected>Pilih Tingkat Pendidikan</option>
                                                    <option value="01">S3 (Setara)</option>
                                                    <option value="02">S2 (Setara)</option>
                                                    <option value="03">S1 (Setara)</option>
                                                    <option value="04">D4</option>
                                                    <option value="05">SM</option>
                                                    <option value="06">D3</option>
                                                    <option value="07">D2</option>
                                                    <option value="08">D1</option>
                                                    <option value="09">SLTA</option>
                                                    <option value="10">SLTP</option>
                                                    <option value="11">D3</option>
                                                </select>
                                            </div>
                                            <label>No. SK Penetapan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="no_sk_penetapan" name="no_sk_penetapan" class="form-control" placeholder="No. SK Penetapan" aria-label="Password" aria-describedby="password-addon">
                                            </div>


                                            <label>Pejabat Yang Menetapkan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="pejabat_menetapkan" name="pejabat_menetapkan" class="form-control" placeholder="Pejabat Yang Menetapkan" aria-label="Password" aria-describedby="password-addon">
                                            </div>
                                            <label>Keahlian Bidang Teknis</label>
                                            <div class="input-group">
                                                <div class="form-check">
                                                    <input class="form-check-input ahli_tp" type="checkbox" id="ahli_tp" name="ahli_tp" value="1">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Tanaman Pangan
                                                    </label>
                                                </div>
                                            </div><input type="text" class="form-control" id="detail_tp" name="detail_tp" aria-label="Password" aria-describedby="password-addon">
                                            <div class="input-group">
                                                <div class="form-check">
                                                    <input class="form-check-input ahli_nak" type="checkbox" id="ahli_nak" name="ahli_nak" value="2">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Peternakan
                                                    </label>
                                                </div>
                                            </div><input type="text" class="form-control" id="detail_nak" name="detail_nak" aria-label="Password" aria-describedby="password-addon">
                                            <div class="input-group">
                                                <div class="form-check">
                                                    <input class="form-check-input ahli_bun" type="checkbox" id="ahli_bun" name="ahli_bun" value="3">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Perkebunan
                                                    </label>
                                                </div>
                                            </div><input type="text" class="form-control" id="detail_bun" name="detail_bun" aria-label="Password" aria-describedby="password-addon">
                                            <div class="input-group">
                                                <div class="form-check">
                                                    <input class="form-check-input ahli_hor" type="checkbox" id="ahli_hor" name="ahli_hor" value="4">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Hortikultura
                                                    </label>
                                                </div>
                                            </div><input type="text" class="form-control" id="detail_hor" name="detail_hor" aria-label="Password" aria-describedby="password-addon">
                                            <div class="input-group">
                                                <div class="form-check">
                                                    <input class="form-check-input ahli_lainnya" type="checkbox" id="ahli_lainnya" name="ahli_lainnya" value="5">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Lainnya
                                                    </label>
                                                </div>
                                            </div><input type="text" class="form-control" id="detail_lainnya" name="detail_lainnya" aria-label="Password" aria-describedby="password-addon">

                                        </div>
                                        <div class="col">
                                            <label>Unit Kerja (BPP Kecamatan)</label>
                                            <div class="input-group mb-3">
                                                <select name="unit_kerja" id="unit_kerja" class="form-control input-lg unit_kerja">
                                                    <option value="">Pilih Unit Kerja</option>
                                                    <?php
                                                    foreach ($unitkerja as $row3) {
                                                        echo '<option value="' . $row3["id"] . '">' . $row3["nama_bpp"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Tempat Tugas</label>
                                            <div class="input-group mb-3">
                                                <select name="tempat_tugas" id="tempat_tugas" class="form-control input-lg tempat_tugas">
                                                    <option value="">Pilih Kecamatan</option>
                                                    <?php
                                                    foreach ($tugas as $row2) {
                                                        echo '<option value="' . $row2["id_daerah"] . '">' . $row2["deskripsi"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Wilayah Kerja 1</label>
                                            <div class="input-group mb-3">
                                                <select id="wil_kerja" name="wil_kerja" class="form-select" aria-label="Default select example">
                                                    <option value="">Pilih Desa</option>
                                                </select>
                                            </div>
                                            <label>Wilayah Kerja 2</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wil_kerja2" name="wil_kerja2" aria-label="Default select example">
                                                    <option selected>Pilih Desa</option>
                                                </select>
                                            </div>

                                            <label>Wilayah Kerja 3</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wil_kerja3" name="wil_kerja3" aria-label="Default select example">
                                                    <option selected>Pilih Desa</option>
                                                </select>
                                            </div>
                                            <label>Wilayah Kerja 4</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wil_kerja4" name="wil_kerja4" aria-label="Default select example">
                                                    <option selected>Pilih Desa</option>
                                                </select>
                                            </div>
                                            <label>Wilayah Kerja 5</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wil_kerja5" name="wil_kerja5" aria-label="Default select example">
                                                    <option selected>Pilih Desa</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label>Alamat Rumah</label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Rumah"></textarea>
                                                </div>
                                                <label>Kab./Kota dan Kode Pos</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="dati2" name="dati2" placeholder="Kab./Kota">

                                                    <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="| Kode Pos">
                                                </div>
                                                <label>Provinsi</label>
                                                <div class="input-group mb-3">
                                                    <select name="kode_prop" id="kode_prop" class="form-control input-lg kode_prop">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php
                                                        foreach ($namaprop as $row) {
                                                            echo '<option value="' . $row["id_prop"] . '">' . $row["nama_prop"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <label>No.Telepon/HP</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" id="telp" name="telp" class="form-control">
                                                </div>
                                                <label>Email</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" id="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="row">
                                                
                                            <div class="col-4">
                                                <div class="text-center">
                                                <label>Tahun <br>Pelatihan</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="tahun_pelatihan1" name="tahun_pelatihan1" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="tahun_pelatihan2" name="tahun_pelatihan2" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="tahun_pelatihan3" name="tahun_pelatihan3" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="tahun_pelatihan4" name="tahun_pelatihan4" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="tahun_pelatihan5" name="tahun_pelatihan5" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="tahun_pelatihan6" name="tahun_pelatihan6" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-8">
                                                <div class="text-center">
                                                <label>Nama <br>Pelatihan</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nm_pelatihan1" name="nm_pelatihan1" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nm_pelatihan2" name="nm_pelatihan2" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nm_pelatihan3" name="nm_pelatihan3" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nm_pelatihan4" name="nm_pelatihan4" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nm_pelatihan5" name="nm_pelatihan5" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="nm_pelatihan6" name="nm_pelatihan6" class="form-control">
                                                </div>
                                                <input type="hidden" name="kecamatan_tugas" class="form-control">
                                                <input type="hidden" id="tgl_update" name="tgl_update" class="form-control">
                                                <input type="hidden" id="id" name="id">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                        <!-- <center><button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Simpan Data</button></center> -->
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-form-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Manajemen Status</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="<?= base_url('Penyuluh/PenyuluhSwadaya/updatestatus'); ?>">
                                                <? csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" name="id" id="idd" class="form-control id">
                                                        <label>Nama Penyuluh</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="nama" id="namaa" class="form-control nama" disabled>
                                                        </div>
                                                        <label>Per tanggal</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="tgl_status" name="tgl_status" class="form-control" placeholder="Tgl Status">
                                                        </div>
                                                    </div>
                                                    <label>Status</label>
                                                    <div class="input-group mb-3">
                                                        <select name="status" id="statuss" class="form-control input-lg status">
                                                            <option value="">Pilih Status</option>
                                                            <?php
                                                            foreach ($status as $row2) {
                                                                echo '<option value="' . $row2["kode"] . '">' . $row2["nama_status"] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label>Keterangan</label>
                                                    <div class="input-group mb-3">
                                                        <textarea class="form-control ket_status" name="ket_status" id="ket_status" placeholder="Keterangan"></textarea>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="btnSaveStatus" class="btn bg-gradient-warning">Simpan Data</button>
                                                        <!-- <center><button type="button" id="btnSaveStatus" class="btn btn-round bg-gradient-warning btn-lg ajax-save">Simpan Data</button></center> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    </div>
</div></div>

    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    var flag_filter = false;

    function showfilter(){
       if(flag_filter){
       flag_filter=false;
        $('#filter').hide("slow");
       }	
       else{
       flag_filter=true;
        $('#filter').show("slow");	
       }
    }

    $(document).ready(function() {

        var input_id = 0;
        $('#tblswadaya thead td').each( function () {
            var title = $(this).text();
            if(title != ''){
                $(this).html( '<input id="input_search_'+input_id+'" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
            }
            input_id++;
        } );

        $('#tblswadaya').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'excel'
				],
                initComplete: function () {
                    // Apply the search
                    this.api().columns().every( function () {
                        var that = this;
        
                        $( '#input_search_' + this.index() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                }
			});

            $('#filter_prov').change(function() { // Jika Select Box id provinsi dipilih
			var provinsi = $(this).val(); // Ciptakan variabel provinsi
			$.ajax({
                async: false,
				type: 'POST', // Metode pengiriman data menggunakan POST
				url: '<?= base_url() ?>/Penyuluh/PenyuluhPns/getlistkab/' + provinsi, // File yang akan memproses data
				//data: 'provinsi=' + provinsi, // Data yang akan dikirim ke file pemroses
				success: function(response) { // Jika berhasil
                    response = JSON.parse(response)
                    var html = '<option value="">-- SEMUA --</option>';
                    for(var i=0;i<response.length;i++){
                        html = html + '<option value="'+response[i].id_kab+'">'+response[i].nama_kab+'</option>'
                    }
					$('#filter_kab').html(html); // Berikan hasil ke id kota
					
				    }
                });
            });

            <?php if ($getPostProv != ''){ ?>
                $('#filter_prov').val('<?php echo $getPostProv; ?>').change();
            <?php } ?>

            // if ($("#filter_prov").val() != '') {
            //     $("#filter_prov option:selected").html();
            // }

            $('#filter_kab').change(function() { // Jika Select Box id provinsi dipilih
                    var kabupaten = $(this).val(); // Ciptakan variabel provinsi
                    $.ajax({
                        async: false,
                        type: 'POST', // Metode pengiriman data menggunakan POST
                        url: '<?= base_url() ?>/Penyuluh/PenyuluhPns/getlistkec/' + kabupaten, // File yang akan memproses data
                        //data: 'kabupaten=' + kabupaten, // Data yang akan dikirim ke file pemroses
                        success: function(response) { // Jika berhasil
                            response = JSON.parse(response)
                            var html = '<option value="">-- SEMUA --</option>';
                            for(var i=0;i<response.length;i++){
                                html = html + '<option value="'+response[i].id_kec+'">'+response[i].nama_kec+'</option>'
                            }
                            $('#filter_kec').html(html); // Berikan hasil ke id kota
                            
                        }
                    });
                });

                
            //if ($("#filter_kab").val() != '') {
            <?php if ($getPostKab != ''){ ?>
                $('#filter_kab').val('<?php echo $getPostKab; ?>').change();
            <?php } ?>
                //}

                
                //if ($("#filter_kec").val() != '') {
                    $('#filter_kec').val('<?php echo $getPostKec; ?>');
                // //}               

        $(document).delegate('#btnSave', 'click', function() {

            tgllahir = $('#tgllahir').val();
            bln = tgllahir.substr(0, 2);
            tgl = tgllahir.substr(3, 2);
            thn = tgllahir.substr(6, 4);

            var id = $('#id').val();
            var jenis_penyuluh = $('#jenis_penyuluh').val();
            var noktp = $('#noktp').val();
            var nama = $('#nama').val();
            var thn_lahir = thn;
            var bln_lahir = bln;
            var tgl_lahir = tgl;
            var tempat_lahir = $('#tempat_lahir').val();
            var jenis_kelamin = $(".jenis_kelamin:checked").val();
            var status_kel = $('#status_kel').val();
            var agama = $('#agama').val();
            var ahli_tp = $(".ahli_tp")[0].checked ? $(".ahli_tp:checked").val() : "";
            var detail_tp = $('#detail_tp').val();
            var ahli_nak = $(".ahli_nak")[0].checked ? $(".ahli_nak:checked").val() : "";
            var detail_nak = $('#detail_nak').val();
            var ahli_bun = $(".ahli_bun")[0].checked ? $(".ahli_bun:checked").val() : "";
            var detail_bun = $('#detail_bun').val();
            var ahli_hor = $(".ahli_hor")[0].checked ? $(".ahli_hor:checked").val() : "";
            var detail_hor = $('#detail_hor').val();
            var ahli_lainnya = $(".ahli_lainnya")[0].checked ? $(".ahli_lainnya:checked").val() : "";
            var detail_lainnya = $('#detail_lainnya').val();
            var instansi_pembina = $('#instansi_pembina').val();
            var satminkal = $('#satminkal').val();
            var prop_satminkal = $('#prop_satminkal').val();
            var unit_kerja = $('#unit_kerja').val();
            var kode_kab = $('#kode_kab').val();
            var tempat_tugas = $('#tempat_tugas').val();
            var wil_kerja = $('#wil_kerja').val();
            var alamat = $('#alamat').val();
            var dati2 = $('#dati2').val();
            var kodepos = $('#kodepos').val();
            var kode_prop = $('#kode_prop').val();
            var telp = $('#telp').val();
            var email = $('#email').val();
            var no_sk_penetapan = $('#no_sk_penetapan').val();
            var pejabat_menetapkan = $('#pejabat_menetapkan').val();
            var tingkat = $('#tingkat').val();
            var tahun_pelatihan1 = $('#tahun_pelatihan1').val();
            var nm_pelatihan1 = $('#nm_pelatihan1').val();
            var tahun_pelatihan2 = $('#tahun_pelatihan2').val();
            var nm_pelatihan2 = $('#nm_pelatihan2').val();
            var tahun_pelatihan3 = $('#tahun_pelatihan3').val();
            var nm_pelatihan3 = $('#nm_pelatihan3').val();
            var tahun_pelatihan4 = $('#tahun_pelatihan4').val();
            var nm_pelatihan4 = $('#nm_pelatihan4').val();
            var tahun_pelatihan5 = $('#tahun_pelatihan5').val();
            var nm_pelatihan5 = $('#nm_pelatihan5').val();
            var tahun_pelatihan6 = $('#tahun_pelatihan6').val();
            var nm_pelatihan6 = $('#nm_pelatihan6').val();
            var tgl_update = $('#tgl_update').val();
            var wil_kerja2 = $('#wil_kerja2').val();
            var wil_kerja3 = $('#wil_kerja3').val();
            var wil_kerja4 = $('#wil_kerja4').val();
            var wil_kerja5 = $('#wil_kerja5').val();
            var kecamatan_tugas = $('#tempat_tugas').val();
            var mapping = $('#mapping').val();

            if (noktp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "NIK tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (noktp.length < 16 || noktp.length > 16) {
                Swal.fire({
                    title: 'Error',
                    text: "NIK harus 16 digit",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (nama.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (agama == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Agama tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
	if (tempat_lahir.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tempat Lahir tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

            if (tgl_lahir.length == 0 || bln_lahir.length == 0 || thn_lahir.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Tanggal Lahir tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if ($('input[name=jenis_kelamin]:checked').length <= 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Jenis Kelamin tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

            $.ajax({
                url: '<?= base_url('Penyuluh/PenyuluhSwadaya/save'); ?>',
                type: 'POST',
                data: {
                    'id': id,
                    'jenis_penyuluh': jenis_penyuluh,
                    'noktp': noktp,
                    'nama': nama,
                    'tgl_lahir': tgl_lahir,
                    'bln_lahir': bln_lahir,
                    'thn_lahir': thn_lahir,
                    'tempat_lahir': tempat_lahir,
                    'jenis_kelamin': jenis_kelamin,
                    'status_kel': status_kel,
                    'agama': agama,
                    'ahli_tp': ahli_tp,
                    'detail_tp': detail_tp,
                    'ahli_nak': ahli_nak,
                    'detail_nak': detail_nak,
                    'ahli_bun': ahli_bun,
                    'detail_bun': detail_bun,
                    'ahli_hor': ahli_hor,
                    'detail_hor': detail_hor,
                    'ahli_lainnya': ahli_lainnya,
                    'detail_lainnya': detail_lainnya,
                    'instansi_pembina': instansi_pembina,
                    'satminkal': satminkal,
                    'prop_satminkal': prop_satminkal,
                    'unit_kerja': unit_kerja,
                    'kode_kab': kode_kab,
                    'tempat_tugas': tempat_tugas,
                    'wil_kerja': wil_kerja,
                    'alamat': alamat,
                    'dati2': dati2,
                    'kodepos': kodepos,
                    'kode_prop': kode_prop,
                    'telp': telp,
                    'email': email,
                    'no_sk_penetapan': no_sk_penetapan,
                    'pejabat_menetapkan': pejabat_menetapkan,
                    'tingkat': tingkat,
                    'tahun_pelatihan1': tahun_pelatihan1,
                    'nm_pelatihan1': nm_pelatihan1,
                    'tahun_pelatihan2': tahun_pelatihan2,
                    'nm_pelatihan2': nm_pelatihan2,
                    'tahun_pelatihan3': tahun_pelatihan3,
                    'nm_pelatihan3': nm_pelatihan3,
                    'tahun_pelatihan4': tahun_pelatihan4,
                    'nm_pelatihan4': nm_pelatihan4,
                    'tahun_pelatihan5': tahun_pelatihan5,
                    'nm_pelatihan5': nm_pelatihan5,
                    'tahun_pelatihan6': tahun_pelatihan6,
                    'nm_pelatihan6': nm_pelatihan6,
                    'tgl_update': tgl_update,
                    'wil_kerja2': wil_kerja2,
                    'wil_kerja3': wil_kerja3,
                    'wil_kerja4': wil_kerja4,
                    'wil_kerja5': wil_kerja5,
                    'kecamatan_tugas': kecamatan_tugas,
                    'mapping': mapping
                },
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: "Sukses tambah data",
                        type: 'success',
                    }).then((result) => {

                        if (result.value) {
                            location.reload();
                        }
                    });
                },
                error: function(jqxhr, status, exception) {
                    Swal.fire({
                        title: 'Error',
                        text: "Gagal tambah data",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }
            });
        });

        $(document).delegate('#btnEditStatus', 'click', function() {
                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PenyuluhSwadaya/editstatus/' + $(this).data('id_swa'),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(result) {
                        // console.log(result);

                        $('#idd').val(result.id);
                        $('#namaa').val(result.nama);
                        $('#statuss').val(result.status_kel);
                        $('#tgl_status').val(result.tgl_status);
                        $('#ket_status').val(result.nama_status);
 

                        $('#modal-form-edit').modal('show');

                        $("#btnSaveStatus").attr("id", "btnDoEditStatus");

                        $(document).delegate('#btnDoEditStatus', 'click', function() {

                            var id = $('#idd').val();
                            var nama = $('#namaa').val();
                            var status = $('#statuss').val();
                            var tgl_status = $('#tgl_status').val();
                            var ket_status = $('#ket_status').val();

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nama', nama);
                            formData.append('status', status);
                            formData.append('tgl_status', tgl_status);
                            formData.append('ket_status', ket_status);



                            $.ajax({
                                url: '<?= base_url() ?>/Penyuluh/PenyuluhSwadaya/updatestatus/' + id,
                                type: "POST",
                                data: formData,
                                cache: false,
                                processData: false,
                                contentType: false,
                                success: function(result) {
                                    $('#modal-form-edit').modal('hide');
                                    Swal.fire({
                                        title: 'Sukses',
                                        text: "Sukses edit data",
                                        type: 'success',
                                    }).then((result) => {

                                        if (result.value) {
                                            location.reload();
                                        }
                                    });

                                },
                                error: function(jqxhr, status, exception) {

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


        $(document).delegate('#btnHapus', 'click', function() {
            Swal.fire({
                title: 'Apakah anda yakin',
                text: "Data akan dihapus ?",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data!'
            }).then((result) => {
                if (result.value) {
                    var id_swa = $(this).data('id_swa');

                    $.ajax({
                        url: '<?= base_url() ?>/Penyuluh/PenyuluhSwadaya/delete/' + id_swa,
                        type: 'POST',

                        success: function(result) {
                            Swal.fire({
                                title: 'Sukses',
                                text: "Sukses hapus data",
                                type: 'success',
                            }).then((result) => {

                                if (result.value) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(jqxhr, status, exception) {
                            Swal.fire({
                                title: 'Error',
                                text: "Gagal hapus data",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            });

        });

        var wil_kerjaa = null;
        var wil_kerjaa2 = null;
        var wil_kerjaa3 = null;
        var wil_kerjaa4 = null;
        var wil_kerjaa5 = null;


        

        $(document).delegate('#btnEdit', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/Penyuluh/PenyuluhSwadaya/edit/' + $(this).data('id_swa'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_swa').val(result.id_swa);
                    $('#id').val(result.id);
                    $('#jenis_penyuluh').val(result.jenis_penyuluh);
                    $('#noktp').val(result.noktp);
                    $('#nama').val(result.nama);
                    $('#tgllahir').val(result.tgl_lahir + '/' + result.bln_lahir + '/' + result.thn_lahir);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    if (result.jenis_kelamin == "1") {
                        $('#jenis_kelamin1').prop("checked", true);
                    } else {
                        $('#jenis_kelamin2').prop("checked", true);
                    }
                    $('#status_kel').val(result.status_kel);
                    $('#agama').val(result.agama);
                    if (result.ahli_tp == "1") {
                        $("#ahli_tp").prop("checked", true);
                    } else {
                        $("#ahli_tp").prop("checked", false);
                    }
                    $('#detail_tp').val(result.detail_tp);
                    if (result.ahli_nak == "2") {
                        $("#ahli_nak").prop("checked", true);
                    } else {
                        $("#ahli_nak").prop("checked", false);
                    }
                    $('#detail_nak').val(result.detail_nak);
                    if (result.ahli_bun == "3") {
                        $("#ahli_bun").prop("checked", true);
                    } else {
                        $("#ahli_bun").prop("checked", false);
                    }
                    $('#detail_bun').val(result.detail_bun);
                    if (result.ahli_hor == "4") {
                        $("#ahli_hor").prop("checked", true);
                    } else {
                        $("#ahli_hor").prop("checked", false);
                    }
                    $('#detail_hor').val(result.detail_hor);
                    if (result.ahli_lainnya == "5") {
                        $("#ahli_lainnya").prop("checked", true);
                    } else {
                        $("#ahli_lainnya").prop("checked", false);
                    }
                    $('#detail_lainnya').val(result.detail_lainnya);
                    $('#instansi_pembina').val(result.instansi_pembina);
                    $('#satminkal').val(result.satminkal);
                    $('#prop_satminkal').val(result.prop_satminkal);
                    $('#unit_kerja').val(result.unit_kerja);
                    $('#kode_kab').val(result.kode_kab);
                    $('#tempat_tugas').val(result.tempat_tugas).change();
                    wil_kerjaa = result.wil_kerja;
                    $('#alamat').val(result.alamat);
                    $('#dati2').val(result.dati2);
                    $('#kodepos').val(result.kodepos);
                    $('#kode_prop').val(result.kode_prop);
                    $('#telp').val(result.telp);
                    $('#email').val(result.email);
                    $('#no_sk_penetapan').val(result.no_sk_penetapan);
                    $('#pejabat_menetapkan').val(result.pejabat_menetapkan);
                    $('#tingkat').val(result.tingkat);
                    $('#tahun_pelatihan1').val(result.tahun_pelatihan1);
                    $('#nm_pelatihan1').val(result.nm_pelatihan1);
                    $('#tahun_pelatihan2').val(result.tahun_pelatihan2);
                    $('#nm_pelatihan2').val(result.nm_pelatihan2);
                    $('#tahun_pelatihan3').val(result.tahun_pelatihan3);
                    $('#nm_pelatihan3').val(result.nm_pelatihan3);
                    $('#tahun_pelatihan4').val(result.tahun_pelatihan4);
                    $('#nm_pelatihan4').val(result.nm_pelatihan4);
                    $('#tahun_pelatihan5').val(result.tahun_pelatihan5);
                    $('#nm_pelatihan5').val(result.nm_pelatihan5);
                    $('#tahun_pelatihan6').val(result.tahun_pelatihan6);
                    $('#nm_pelatihan6').val(result.nm_pelatihan6);
                    $('#tgl_update').val(result.tgl_update);
                    wil_kerjaa2 = result.wil_kerja2;
                    wil_kerjaa3 = result.wil_kerja3;
                    wil_kerjaa4 = result.wil_kerja4;
                    wil_kerjaa5 = result.wil_kerja5;
                    // $('#tempat_tugas').val(result.kecamatan_tugas);
                    $('#mapping').val(result.mapping);

                    $('#modal-form').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {

                        tgllahir = $('#tgllahir').val();
                        bln = tgllahir.substr(0, 2);
                        tgl = tgllahir.substr(3, 2);
                        thn = tgllahir.substr(6, 4);

                        var id_swa = $('#id_swa').val();
                        var id = $('#id').val();
                        var jenis_kelamin = $(".jenis_kelamin:checked").val();
                        var noktp = $('#noktp').val();
                        var nama = $('#nama').val();
                        var thn_lahir = thn;
                        var bln_lahir = bln;
                        var tgl_lahir = tgl;
                        var tempat_lahir = $('#tempat_lahir').val();
                        var jenis_kelamin = $(".jenis_kelamin:checked").val();
                        var status_kel = $('#status_kel').val();
                        var agama = $('#agama').val();
                        var ahli_tp = $(".ahli_tp")[0].checked ? $(".ahli_tp:checked").val() : "";
                        var detail_tp = $('#detail_tp').val();
                        var ahli_nak = $(".ahli_nak")[0].checked ? $(".ahli_nak:checked").val() : "";
                        var detail_nak = $('#detail_nak').val();
                        var ahli_bun = $(".ahli_bun")[0].checked ? $(".ahli_bun:checked").val() : "";
                        var detail_bun = $('#detail_bun').val();
                        var ahli_hor = $(".ahli_hor")[0].checked ? $(".ahli_hor:checked").val() : "";
                        var detail_hor = $('#detail_hor').val();
                        var ahli_lainnya = $(".ahli_lainnya")[0].checked ? $(".ahli_lainnya:checked").val() : "";
                        var detail_lainnya = $('#detail_lainnya').val();
                        var instansi_pembina = $('#instansi_pembina').val();
                        var satminkal = $('#satminkal').val();
                        var prop_satminkal = $('#prop_satminkal').val();
                        var unit_kerja = $('#unit_kerja').val();
                        var kode_kab = $('#kode_kab').val();
                        var tempat_tugas = $('#tempat_tugas').val();
                        var wil_kerja = $('#wil_kerja').val();
                        var alamat = $('#alamat').val();
                        var dati2 = $('#dati2').val();
                        var kodepos = $('#kodepos').val();
                        var kode_prop = $('#kode_prop').val();
                        var telp = $('#telp').val();
                        var email = $('#email').val();
                        var no_sk_penetapan = $('#no_sk_penetapan').val();
                        var pejabat_menetapkan = $('#pejabat_menetapkan').val();
                        var tingkat = $('#tingkat').val();
                        var tahun_pelatihan1 = $('#tahun_pelatihan1').val();
                        var nm_pelatihan1 = $('#nm_pelatihan1').val();
                        var tahun_pelatihan2 = $('#tahun_pelatihan2').val();
                        var nm_pelatihan2 = $('#nm_pelatihan2').val();
                        var tahun_pelatihan3 = $('#tahun_pelatihan3').val();
                        var nm_pelatihan3 = $('#nm_pelatihan3').val();
                        var tahun_pelatihan4 = $('#tahun_pelatihan4').val();
                        var nm_pelatihan4 = $('#nm_pelatihan4').val();
                        var tahun_pelatihan5 = $('#tahun_pelatihan5').val();
                        var nm_pelatihan5 = $('#nm_pelatihan5').val();
                        var tahun_pelatihan6 = $('#tahun_pelatihan6').val();
                        var nm_pelatihan6 = $('#nm_pelatihan6').val();
                        var tgl_update = $('#tgl_update').val();
                        var wil_kerja2 = $('#wil_kerja2').val();
                        var wil_kerja3 = $('#wil_kerja3').val();
                        var wil_kerja4 = $('#wil_kerja4').val();
                        var wil_kerja5 = $('#wil_kerja5').val();
                        var kecamatan_tugas = $('#tempat_tugas').val();
                        var mapping = $('#mapping').val();

            if (noktp.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "NIK tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (noktp.length < 16 || noktp.length > 16) {
                Swal.fire({
                    title: 'Error',
                    text: "NIK harus 16 digit",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (nama.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if (agama == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Agama tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
if (tempat_lahir.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tempat Lahir tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

            if (tgl_lahir.length == 0 || bln_lahir.length == 0 || thn_lahir.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Tanggal Lahir tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }
            if ($('input[name=jenis_kelamin]:checked').length <= 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Jenis Kelamin tidak boleh kosong",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;
            }

                        let formData = new FormData();
                        formData.append('id_swa', id_swa);
                        formData.append('id', id);
                        formData.append('jenis_penyuluh', jenis_penyuluh);
                        formData.append('noktp', noktp);
                        formData.append('nama', nama);
                        formData.append('tgl_lahir', tgl_lahir);
                        formData.append('bln_lahir', bln_lahir);
                        formData.append('thn_lahir', thn_lahir);
                        formData.append('tempat_lahir', tempat_lahir);
                        formData.append('jenis_kelamin', jenis_kelamin);
                        formData.append('status_kel', status_kel);
                        formData.append('agama', agama);
                        formData.append('ahli_tp', ahli_tp);
                        formData.append('detail_tp', detail_tp);
                        formData.append('ahli_nak', ahli_nak);
                        formData.append('detail_nak', detail_nak);
                        formData.append('ahli_bun', ahli_bun);
                        formData.append('detail_bun', detail_bun);
                        formData.append('ahli_hor', ahli_hor);
                        formData.append('detail_hor', detail_hor);
                        formData.append('ahli_lainnya', ahli_lainnya);
                        formData.append('detail_lainnya', detail_lainnya);
                        formData.append('instansi_pembina', instansi_pembina);
                        formData.append('satminkal', satminkal);
                        formData.append('prop_satminkal', prop_satminkal);
                        formData.append('unit_kerja', unit_kerja);
                        formData.append('kode_kab', kode_kab);
                        formData.append('tempat_tugas', tempat_tugas);
                        formData.append('wil_kerja', wil_kerja);
                        formData.append('alamat', alamat);
                        formData.append('dati2', dati2);
                        formData.append('kodepos', kodepos);
                        formData.append('kode_prop', kode_prop);
                        formData.append('telp', telp);
                        formData.append('email', email);
                        formData.append('no_sk_penetapan', no_sk_penetapan);
                        formData.append('pejabat_menetapkan', pejabat_menetapkan);
                        formData.append('tingkat', tingkat);
                        formData.append('tahun_pelatihan1', tahun_pelatihan1);
                        formData.append('nm_pelatihan1', nm_pelatihan1);
                        formData.append('tahun_pelatihan2', tahun_pelatihan2);
                        formData.append('nm_pelatihan2', nm_pelatihan2);
                        formData.append('tahun_pelatihan3', tahun_pelatihan3);
                        formData.append('nm_pelatihan3', nm_pelatihan3);
                        formData.append('tahun_pelatihan4', tahun_pelatihan4);
                        formData.append('nm_pelatihan4', nm_pelatihan4);
                        formData.append('tahun_pelatihan5', tahun_pelatihan5);
                        formData.append('nm_pelatihan5', nm_pelatihan5);
                        formData.append('tahun_pelatihan6', tahun_pelatihan6);
                        formData.append('nm_pelatihan6', nm_pelatihan6);
                        formData.append('tgl_update', tgl_update);
                        formData.append('wil_kerja2', wil_kerja2);
                        formData.append('wil_kerja3', wil_kerja3);
                        formData.append('wil_kerja4', wil_kerja4);
                        formData.append('wil_kerja5', wil_kerja5);
                        formData.append('kecamatan_tugas', kecamatan_tugas);
                        formData.append('mapping', mapping);

                        $.ajax({
                            url: '<?= base_url() ?>/Penyuluh/PenyuluhSwadaya/update/' + id_swa,
                            type: "POST",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                $('#modal-form').modal('hide');
                                Swal.fire({
                                    title: 'Sukses',
                                    text: "Sukses edit data",
                                    type: 'success',
                                }).then((result) => {

                                    if (result.value) {
                                        location.reload();
                                    }
                                });

                            },
                            error: function(jqxhr, status, exception) {

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

        $('#tempat_tugas').on('change', function() {

            const id = $('#tempat_tugas').val();
            var kdtempat_tugas = id.substring(0, 6);

            $.ajax({
                url: "<?= base_url() ?>/Penyuluh/PenyuluhSwadaya/showDesa/" + kdtempat_tugas + "",
                success: function(response) {
                    var htmla = '<option value="">Pilih Desa</option>';
                    if (response == '') {
                        $("select#wil_kerja").html('<option value="">--Pilih Desa--</option>');
                        $("select#wil_kerja2").html('<option value="">--Pilih Desa--</option>');
                        $("select#wil_kerja3").html('<option value="">--Pilih Desa--</option>');
                        $("select#wil_kerja4").html('<option value="">--Pilih Desa--</option>');
                        $("select#wil_kerja5").html('<option value="">--Pilih Desa--</option>');
                    } else {
                        $("select#wil_kerja").html(htmla += response);
                        $("select#wil_kerja2").html(htmla += response);
                        $("select#wil_kerja3").html(htmla += response);
                        $("select#wil_kerja4").html(htmla += response);
                        $("select#wil_kerja5").html(htmla += response);

                        $('#wil_kerja').val(wil_kerjaa);
                        $('#wil_kerja2').val(wil_kerjaa2);
                        $('#wil_kerja3').val(wil_kerjaa3);
                        $('#wil_kerja4').val(wil_kerjaa4);
                        $('#wil_kerja5').val(wil_kerjaa5);
                    }
                },
                dataType: "html"
            });
            return false;
        });
    });
</script>

<script>
    var d = new Date();

    // Set the value of the "date" field
    document.getElementById("tgl_update").value = d.toLocaleString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    }).split(' ').join(' ');
</script>

<script>
    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }
    var ack = makeid(12);
    document.getElementById("id").value = ack
</script>
<script>
    $(document).ready(function() {
        const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        let qntYears = 80;
        let selectYear = $("#year");
        let selectMonth = $("#month");
        let selectDay = $("#day");
        let currentYear = new Date().getFullYear();

        for (var y = 0; y < qntYears; y++) {
            let date = new Date(currentYear);
            let yearElem = document.createElement("option");
            yearElem.value = currentYear
            yearElem.textContent = currentYear;
            selectYear.append(yearElem);
            currentYear--;
        }

        selectMonth.html("");

        for (var m = 1; m <= 12; m++) {
            let month = monthNames[m];
            let monthElem = document.createElement("option");
            monthElem.value = m;
            monthElem.textContent = month;
            selectMonth.append(monthElem);
        }

        var d = new Date();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        var day = d.getDate();

        selectYear.val(year);
        selectYear.on("change", AdjustDays);
        selectMonth.val(month);
        selectMonth.on("change", AdjustDays);

        AdjustDays();
        selectDay.val(day)

        function AdjustDays() {
            var year = selectYear.val();
            var month = parseInt(selectMonth.val());
            selectDay.empty();

            //get the last day, so the number of days in that month
            var days = new Date(year, month, 0).getDate();

            //lets create the days of that month
            for (var d = 1; d <= days; d++) {
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(function() {
            $('input[name="tgllahir"]').daterangepicker({
                formatDate: 'dd-mm-YYYY',
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10),
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="tgllahir"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
            });

            $('input[name="tgllahir"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

    });
</script>

<?= $this->endSection() ?>