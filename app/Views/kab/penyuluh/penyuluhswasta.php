<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $seskab = session()->get('kodebapel'); ?>

<center>
    <h3>Daftar Penyuluh Swasta Kab <?= ucwords(strtolower($nama_kabupaten)) ?></h3>
	 <p>Ditemukan <?= $jml_data ?> data</p>
</center>


<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
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
						<form method="POST" action="<?= base_url('Penyuluh/PenyuluhSwasta/viewfilter'); ?>">
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
        <table id="tblswasta" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <td class="text-uppercase text-secondary text-xxs"></td>
                    <td class="text-uppercase text-secondary text-xxs">NoKTP</td>
                    <td class="text-uppercase text-secondary text-xxs">Nama</td>
                    <td class="text-uppercase text-secondary text-xxs">Satminkal</td>
                    <td class="text-uppercase text-secondary text-xxs">TempatTglLahir</td>
                    <td class="text-uppercase text-secondary text-xxs">TerakhirUpdate</td>
                    <td class="text-uppercase text-secondary text-xxs"></td>
                </tr>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No KTP</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Satmikal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tempat/Tgl Lahir</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Terakhir Update</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody class="swastadata">
                <?php
                foreach ($tabel_data as $key => $row) {
                ?>
                    <tr>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $key + 1; ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><a href="<?= base_url('profil/penyuluhswasta/detail/' . $row['noktp']) ?>"><?= $row['noktp']; ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['nama']; ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['kelompok']; ?>.<?= $row['namasat']; ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tempat_lahir']; ?>, <?= $row['tgl_lahir']; ?>-<?= $row['bln_lahir']; ?>-<?= $row['thn_lahir']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_update']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="#">
                                <button type="button" id="btnEdit" data-id_swa="<?= $row['id_swa']; ?>" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                            </a>
                            <button class="btn bg-gradient-danger btn-sm" id="btnHapus" data-id_swa="<?= $row['id_swa']; ?>" type="button">
                                <i class="fas fa-trash"></i> Hapus</button>
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
                                <form method="POST" action="<?= base_url('Penyuluh/PenyuluhSwasta/save'); ?>">
                                    <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="id_swa" id="id_swa" class="form-control id_swa">
                                            <input type="hidden" name="jenis_penyuluh" id="jenis_penyuluh" class="form-control jenis_penyuluh" value="4">
                                            <input type="hidden" name="satminkal" id="satminkal" class="form-control satminkal" value="<?= $seskab; ?>">

                                            <label>No. KTP</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="noktp" id="noktp" class="form-control noktp" placeholder="No. KTP" maxlength="16" oninput="NikOnly(this)">
                                            </div>
                                            <label>Nama Penyuluh</label> <span id="error_nama" class="text-danger ms-3"></span>
                                            <div class="input-group mb-3">
                                                <input type="text" name="nama" id="nama" class="form-control nama" placeholder="Nama">
                                            </div>
                                            <label>Tempat, Tanggal Lahir</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir" placeholder="Tempat Lahir">
                                                <input type="text" name="tgllahir" id="tgllahir" class="form-control tgllahir" placeholder="Tanggal Lahir" value="">
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
                                            <label>Lokasi Kerja</label>
                                            <div class="input-group mb-3">
                                                <select name="lokasi_kerja" id="lokasi_kerja" class="form-select lokasi_kerja" aria-label="Default select example">
                                                    <option selected value="">Pilih Lokasi Kerja</option>
                                                    <option value="3">Kabupaten/Kota</option>
                                                    <option value="4">Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Kecamatan Tempat Tugas</label>
                                            <div class="input-group mb-3">
                                                <select name="tempat_tugas" id="tempat_tugas" class="form-control input-lg tempat_tugas">
                                                    <option value="">Pilih Desa</option>
                                                    <?php
                                                    foreach ($tugas as $row2) {
                                                        echo '<option value="' . $row2["id_daerah"] . '">' . $row2["deskripsi"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Alamat Rumah</label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control alamat" placeholder="Alamat Rumah" name="alamat" id="alamat"></textarea>
                                            </div>
                                            <label>Kab./Kota dan Kode Pos</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control dati2" name="dati2" id="dati2" placeholder="Kab./Kota">

                                                <input type="text" class="form-control kodepos" name="kodepos" id="kodepos" placeholder="| Kode Pos">
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
                                                <input type="number" name="telp" id="telp" class="form-control telp" placeholder="No.Telepon/HP">
                                            </div>
                                            <label>Email</label>
                                            <div class="input-group mb-3">
                                                <input type="email" name="email" id="email" class="form-control email" placeholder="Email">
                                            </div>
                                        </div>
                                        <h5>Perusahaan</h5>
                                        <div class="col">

                                            <label>Nama Perusahaan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control nama_perusahaan" placeholder="Nama Perusahaan">
                                            </div>
                                            <label>
                                                Jabatan Dalam Perusahaan</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="jabatan_di_perush" id="jabatan_di_perush" class="form-control jabatan_di_perush" placeholder="Jabatan Dalam Perusahaan">
                                            </div>
                                            <label>Alamat Perusahaan</label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control alamat_perush" name="alamat_perush" id="alamat_perush" placeholder="Alamat Perusahaan" id="floatingTextarea"></textarea>
                                            </div>
                                            <label>No.Telepon</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="telp_perush" id="telp_perush" class="form-control telp_perush" placeholder="No.Telepon">
                                                <input type="hidden" id="tgl_update" name="tgl_update">

                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                            <!-- <center><button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-lg ajax-save">Simpan Data</button></center> -->
                                        </div>
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
        $('#tblswasta thead td').each( function () {
            var title = $(this).text();
            if(title != ''){
                $(this).html( '<input id="input_search_'+input_id+'" type="text" style="width: 100%" placeholder="Search '+title+'" />' );
            }
            input_id++;
        } );

        $('#tblswasta').DataTable({
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

            var jenis_penyuluh = $('#jenis_penyuluh').val();
            var satminkal = $('#satminkal').val();
            var noktp = $('#noktp').val();
            var nama = $('#nama').val();
            var tempat_lahir = $('#tempat_lahir').val();
            var thn_lahir = thn;
            var bln_lahir = bln;
            var tgl_lahir = tgl;
            var jenis_kelamin = $(".jenis_kelamin:checked").val();
            var lokasi_kerja = $('#lokasi_kerja').val();
            var tempat_tugas = $('#tempat_tugas').val();
            var alamat = $('#alamat').val();
            var dati2 = $('#dati2').val();
            var kodepos = $('#kodepos').val();
            var kode_prop = $('#kode_prop').val();
            var telp = $('#telp').val();
            var email = $('#email').val();
            var nama_perusahaan = $('#nama_perusahaan').val();
            var jabatan_di_perush = $('#jabatan_di_perush').val();
            var alamat_perush = $('#alamat_perush').val();
            var telp_perush = $('#telp_perush').val();
            var tgl_update = $('#tgl_update').val();

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
            if (lokasi_kerja == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Lokasi Kerja tidak boleh kosong",
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
                url: '<?= base_url('Penyuluh/PenyuluhSwasta/save'); ?>',
                type: 'POST',
                data: {
                    'jenis_penyuluh': jenis_penyuluh,
                    'satminkal': satminkal,
                    'noktp': noktp,
                    'nama': nama,
                    'tempat_lahir': tempat_lahir,
                    'thn_lahir': thn_lahir,
                    'bln_lahir': bln_lahir,
                    'tgl_lahir': tgl_lahir,
                    'jenis_kelamin': jenis_kelamin,
                    'lokasi_kerja': lokasi_kerja,
                    'tempat_tugas': tempat_tugas,
                    'alamat': alamat,
                    'dati2': dati2,
                    'kodepos': kodepos,
                    'kode_prop': kode_prop,
                    'telp': telp,
                    'email': email,
                    'nama_perusahaan': nama_perusahaan,
                    'jabatan_di_perush': jabatan_di_perush,
                    'alamat_perush': alamat_perush,
                    'telp_perush': telp_perush,
                    'tgl_update': tgl_update
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
                        url: '<?= base_url() ?>/Penyuluh/PenyuluhSwasta/delete/' + id_swa,
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

        $(document).delegate('#btnEditStatus', 'click', function() {
                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PenyuluhSwasta/editstatus/' + $(this).data('id_swa'),
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
                                url: '<?= base_url() ?>/Penyuluh/PenyuluhSwasta/updatestatus/' + id,
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


        $(document).delegate('#btnEdit', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/Penyuluh/PenyuluhSwasta/edit/' + $(this).data('id_swa'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_swa').val(result.id_swa);
                    $('#jenis_penyuluh').val(result.jenis_penyuluh);
                    $('#satminkal').val(result.satminkal);
                    $('#noktp').val(result.noktp);
                    $('#nama').val(result.nama);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#tgllahir').val(result.tgl_lahir + '/' + result.bln_lahir + '/' + result.thn_lahir);
                    if (result.jenis_kelamin == "1") {
                        $('#jenis_kelamin1').prop("checked", true);
                    } else {
                        $('#jenis_kelamin2').prop("checked", true);
                    }
                    $('#lokasi_kerja').val(result.lokasi_kerja);
                    $('#tempat_tugas').val(result.tempat_tugas);
                    $('#alamat').val(result.alamat);
                    $('#dati2').val(result.dati2);
                    $('#kodepos').val(result.kodepos);
                    $('#kode_prop').val(result.kode_prop);
                    $('#telp').val(result.telp);
                    $('#email').val(result.email);
                    $('#nama_perusahaan').val(result.nama_perusahaan);
                    $('#jabatan_di_perush').val(result.jabatan_di_perush);
                    $('#alamat_perush').val(result.alamat_perush);
                    $('#telp_perush').val(result.telp_perush);
                    $('#tgl_update').val(result.tgl_update);

                    $('#modal-form').modal('show');

                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {

                        tgllahir = $('#tgllahir').val();
                        bln = tgllahir.substr(0, 2);
                        tgl = tgllahir.substr(3, 2);
                        thn = tgllahir.substr(6, 4);

                        var id_swa = $('#id_swa').val();
                        var jenis_penyuluh = $('#jenis_penyuluh').val();
                        var satminkal = $('#satminkal').val();
                        var noktp = $('#noktp').val();
                        var nama = $('#nama').val();
                        var tempat_lahir = $('#tempat_lahir').val();
                        var thn_lahir = thn;
                        var bln_lahir = bln;
                        var tgl_lahir = tgl;
                        var jenis_kelamin = $(".jenis_kelamin:checked").val();
                        var lokasi_kerja = $('#lokasi_kerja').val();
                        var tempat_tugas = $('#tempat_tugas').val();
                        var alamat = $('#alamat').val();
                        var dati2 = $('#dati2').val();
                        var kodepos = $('#kodepos').val();
                        var kode_prop = $('#kode_prop').val();
                        var telp = $('#telp').val();
                        var email = $('#email').val();
                        var nama_perusahaan = $('#nama_perusahaan').val();
                        var jabatan_di_perush = $('#jabatan_di_perush').val();
                        var alamat_perush = $('#alamat_perush').val();
                        var telp_perush = $('#telp_perush').val();
                        var tgl_update = $('#tgl_update').val();

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
            if (lokasi_kerja == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Lokasi Kerja tidak boleh kosong",
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
                        formData.append('jenis_penyuluh', jenis_penyuluh);
                        formData.append('satminkal', satminkal);
                        formData.append('noktp', noktp);
                        formData.append('nama', nama);
                        formData.append('tempat_lahir', tempat_lahir);
                        formData.append('thn_lahir', thn_lahir);
                        formData.append('bln_lahir', bln_lahir);
                        formData.append('tgl_lahir', tgl_lahir);
                        formData.append('jenis_kelamin', jenis_kelamin);
                        formData.append('lokasi_kerja', lokasi_kerja);
                        formData.append('tempat_tugas', tempat_tugas);
                        formData.append('alamat', alamat);
                        formData.append('dati2', dati2);
                        formData.append('kodepos', kodepos);
                        formData.append('kode_prop', kode_prop);
                        formData.append('telp', telp);
                        formData.append('email', email);
                        formData.append('nama_perusahaan', nama_perusahaan);
                        formData.append('jabatan_di_perush', jabatan_di_perush);
                        formData.append('alamat_perush', alamat_perush);
                        formData.append('telp_perush', telp_perush);
                        formData.append('tgl_update', tgl_update);

                        $.ajax({
                            url: '<?= base_url() ?>/Penyuluh/PenyuluhSwasta/update/' + id_swa,
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