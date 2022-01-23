<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
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
?>

<center>
    <h3>Daftar Kelembagaan Ekonomi Petani di Kecamatan <?= ucwords(strtolower($nama_kecamatan)) ?>  </h3>
	 <p>Data ditemukan <?= ucwords(strtolower($jum)) ?></p>
</center>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
<button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Data</button>
<div class="card">
    <div class="table-responsive">
        <table id="listkep" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Kelembagaan Ekonomi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jenis Kelembagaan Ekonomi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Direktur/Ketua</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No.Telp</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tahun Pembentukan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Akta Badan Hukum</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah Pemegang Saham</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah Poktan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah Gapoktan</th>
                   
                   
                    <th class="text-secondary opacity-7"></th>
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
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_kep'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['jenis_kep'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_direktur'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['alamat'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['no_telp'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['email'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['tahun_bentuk'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['badan_hukum'] ?></p>
                    </td>
                    <td class="align-middle rupiah text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['jum_anggota'] ?></p>
                    </td>
                    <td class="align-middle rupiah text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['jum_poktan'] ?></p>
                    </td>
                    <td class="align-middle rupiah text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['jum_gapoktan'] ?></p>
                    </td>
                   
                    <td class="align-middle text-center text-sm">
                    <button type="button"  data-id_kep="<?= $row['id_kep'] ?>" id="btnEditKEP" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                           
                                <button class="btn btn-danger btn-sm" id="btnHapus" data-id_kep="<?= $row['id_kep'] ?>" type="button" >
                                <i class="fas fa-trash"></i> Hapus</button>

                                <!-- <button type="button" class="btn bg-gradient-success btn-sm"> -->
                            <a class="btn bg-gradient-success btn-sm" href="<?= base_url('/kegiatanbun?id_kep=' . $row['id_kep']) ?>"> 
                                 +Tambah Kegiatan Usaha</a>
                            <!-- </button> -->
                        </td>
                </tr>
            <?php
            }
            ?>

            </tbody>
           
        </table>
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Tambah Data</h4>
                                        </div>
                                        <div class="card-body">
                                        <form role="form text-left" action="<?= base_url('/KelembagaanPelakuUtama/KelembagaanEkonomiPetani/ListKEP/save'); ?>" method="post" enctype="multipart/form-data">
                                            <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-5" mt-5>
                                            <label>Kecamatan</label>
                                            <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Kecamatan" value="<?= $nama_kecamatan; ?>" disabled>
                                            </div>
                                            <label>Nama Kelembagaan Ekonomi</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_kep" name="nama_kep" placeholder="Nama KEP" aria-label="Password" aria-describedby="password-addon">
                                            </div>
                                            <label>Jenis Kelembagaan Ekonomi</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="jenis_kep" name="jenis_kep" aria-label="Default select example">
                                                    <option selected>  </option>
                                                    <option value="kop">Koperasi Tani</option>
                                                    <option value="pt">PT</option>
                                                    <option value="cv">CV</option>
                                                    <option value="kub">Kelompok Usaha Bersama (KUB)</option>
                                                    <option value="mini_kub">Mini Kelompok Usaha Bersama (Mini KUB)</option>
                                                    <option value="bump">Badan Usaha Milik Petani (BUMP)</option>
                                                    <option value="lkma">LKMA</option>
                                                    <option value="lain">Lainnya</option>
                                                </select>
                                            </div>
                                          
                                            <label>Alamat</label>
                                                <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" aria-label="Password" aria-describedby="password-addon"></textarea>
                                            <label>No Telp</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telp" aria-label="Password" aria-describedby="password-addon">
                                                </div>
                                                <label>Email</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="email" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" >
                                                </div>
                                                <label>Nama Ketua / Direktur</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="nama_direktur" name="nama_direktur" placeholder="Nama Ketua / Direktur" aria-label="Password" aria-describedby="password-addon">
                                                </div>
                                                <label>Tahun Pembentukan</label>
                                            <div class="input-group mb-3">
                                                <select id="year" class="form-select"  aria-label="Default select example" name="tahun_bentuk">
                                                    <option selected>Pilih Tahun</option>
                                                    
                                                </select>
                                            </div>
                                            <label>Badan Hukum</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="badan_hukum" name="badan_hukum" aria-label="Default select example">
                                                    <option selected>  </option>
                                                    <option value="ada">Ada</option>
                                                    <option value="tidak">Tidak Ada</option>
                                                    
                                                </select>
                                            </div>
                                            <label>Jumlah Anggota / Pemegang Saham</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="jum_anggota" name="jum_anggota" placeholder="Jumlah Anggota" >
                                                </div>
                                                <label>Jumlah Poktan</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="jum_poktan" name="jum_poktan" placeholder="Jumlah Poktan" >
                                                </div>
                                                <label>Jumlah Gapoktan</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="jum_gapoktan" name="jum_gapoktan" placeholder="Jumlah Gapoktan" >
                                                </div>
                                                <Label> Kegiatan Usaha </label><br>
                                               <label class="form-check-label">Tanaman Pangan</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="luas_lahan_usaha_tp" name="luas_lahan_usaha_tp" placeholder="Luas Lahan yang diusahakan(Ha)" >
                                                </div>
                                                <label class="form-check-label">Pemasaran Tanaman Pangan</label>
                                                <div class="form-check">
                                                 <input class="form-check-input pemasaran_regional_tp" type="checkbox" value="regional" name="pemasaran_regional_tp" id="pemasaran_regional_tp" >
                                                    <label class="form-check-label" for="pemasaran_regional_tp">
                                                    Regional
                                                    </label>
                                                 </div>
                                                 <div class="form-check">  
                                                    <input class="form-check-input pemasaran_ekspor_tp" type="checkbox" value="ekspor" name="pemasaran_ekspor_tp" id="pemasaran_ekspor_tp" >
                                                    <label class="form-check-label" for="pemasaran_ekspor_tp">
                                                    Ekspor
                                                    </label>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label class="form-check-label">Perkebunan</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="luas_lahan_usaha_bun" name="luas_lahan_usaha_bun" placeholder="Luas Lahan yang diusahakan(Ha)" >
                                                </div>
                                                <label class="form-check-label">Pemasaran Perkebunan</label>
                                                <div class="form-check">
                                                 <input class="form-check-input pemasaran_regional_bun" type="checkbox" value="regional" name="pemasaran_regional_bun" id="pemasaran_regional_bun" >
                                                    <label class="form-check-label" for="pemasaran_regional_bun">
                                                    Regional
                                                    </label>
                                                 </div>
                                                 <div class="form-check">  
                                                    <input class="form-check-input pemasaran_ekspor_bun" type="checkbox" value="ekspor" name="pemasaran_ekspor_bun" id="pemasaran_ekspor_bun" >
                                                    <label class="form-check-label" for="pemasaran_ekspor_bun">
                                                    Ekspor
                                                    </label>
                                                    </div>

                                                    <label class="form-check-label">Hortikultura</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="luas_lahan_usaha_hor" name="luas_lahan_usaha_hor" placeholder="Luas Lahan yang diusahakan(Ha)" >
                                                </div>
                                                <label class="form-check-label">Pemasaran Hortikultura</label>
                                                <div class="form-check">
                                                 <input class="form-check-input pemasaran_regional_hor" type="checkbox" value="regional" name="pemasaran_regional_hor" id="pemasaran_regional_hor" >
                                                    <label class="form-check-label" for="pemasaran_regional_hor">
                                                    Regional
                                                    </label>
                                                 </div>
                                                 <div class="form-check">  
                                                    <input class="form-check-input pemasaran_ekspor_hor" type="checkbox" value="ekspor" name="pemasaran_ekspor_hor" id="pemasaran_ekspor_hor" >
                                                    <label class="form-check-label" for="pemasaran_ekspor_hor">
                                                    Ekspor
                                                    </label>
                                                    </div>

                                                    <label class="form-check-label">Peternakan</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="luas_lahan_usaha_nak" name="luas_lahan_usaha_nak" placeholder="Luas Lahan yang diusahakan(Ha)" >
                                                </div>
                                                <label class="form-check-label">Pemasaran Peternakan</label>
                                                <div class="form-check">
                                                 <input class="form-check-input pemasaran_regional_nak" type="checkbox" value="regional" name="pemasaran_regional_nak" id="pemasaran_regional_nak" >
                                                    <label class="form-check-label" for="pemasaran_regional_nak">
                                                    Regional
                                                    </label>
                                                 </div>
                                                 <div class="form-check">  
                                                    <input class="form-check-input pemasaran_ekspor_nak" type="checkbox" value="ekspor" name="pemasaran_ekspor_nak" id="pemasaran_ekspor_nak" >
                                                    <label class="form-check-label" for="pemasaran_ekspor_nak">
                                                    Ekspor
                                                    </label>
                                                    </div>

                                                    <label class="form-check-label">Pengolahan</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="luas_lahan_usaha_olah" name="luas_lahan_usaha_olah" placeholder="Luas Lahan yang diusahakan(Ha)" >
                                                </div>
                                                    <label class="form-check-label">Pemasaran Pengolahan</label>
                                                <div class="form-check">
                                                 <input class="form-check-input pemasaran_regional_olah" type="checkbox" value="regional" name="pemasaran_regional_olah" id="pemasaran_regional_olah" >
                                                    <label class="form-check-label" for="pemasaran_regional_olah">
                                                    Regional
                                                    </label>
                                                 </div>
                                                 <div class="form-check">  
                                                    <input class="form-check-input pemasaran_ekspor_olah" type="checkbox" value="ekspor" name="pemasaran_ekspor_olah" id="pemasaran_ekspor_olah" >
                                                    <label class="form-check-label" for="pemasaran_ekspor_olah">
                                                    Ekspor
                                                    </label>
                                                    </div>

                                                    <label class="form-check-label">Pemasaran</label>
                                                <div class="form-check">
                                                 <input class="form-check-input pemasaran_tti" type="checkbox" value="tti" name="pemasaran_tti" id="pemasaran_tti" >
                                                    <label class="form-check-label" for="pemasaran_tti">
                                                    Toko Tani Indonesia (TTI)
                                                    </label>
                                                 </div>

                                                <label>Kemitraan Usaha</label>
                                                <div class="form-check">
                                                 <input class="form-check-input jenis_mitra_internasional" type="checkbox" value="perusahaan internasional" name="jenis_mitra_internasional" id="jenis_mitra_internasional" >
                                                    <label class="form-check-label" for="jenis_mitra_internasional">
                                                    Perusahaan Internasional
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                 <input class="form-check-input jenis_mitra_nasional" type="checkbox" value="perusahaan nasional" name="jenis_mitra_nasional" id="jenis_mitra_nasional" >
                                                    <label class="form-check-label" for="jenis_mitra_nasional">
                                                    Perusahaan Nasional
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                 <input class="form-check-input jenis_mitra_lokal" type="checkbox" value="perusahaan lokal" name="jenis_mitra_lokal" id="jenis_mitra_lokal" >
                                                    <label class="form-check-label" for="jenis_mitra_lokal">
                                                    Perusahaan Lokal
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                 <input class="form-check-input jenis_mitra_koperasi" type="checkbox" value="koperasi" name="jenis_mitra_koperasi" id="jenis_mitra_koperasi" >
                                                    <label class="form-check-label" for="jenis_mitra_koperasi">
                                                    Koperasi
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                 <input class="form-check-input jenis_mitra_perorangan" type="checkbox" value="perorangan" name="jenis_mitra_perorangan" id="jenis_mitra_perorangan" >
                                                    <label class="form-check-label" for="jenis_mitra_perorangan">
                                                    Perorangan
                                                    </label>
                                                    </div>
                                             
                                                    <label>Bentuk Kemitraan</label>
                                                    <div class="form-check">
                                                 <input class="form-check-input bentuk_mitra_pemasaran" type="checkbox" value="pemasaran" name="bentuk_mitra_pemasaran" id="bentuk_mitra_pemasaran" >
                                                    <label class="form-check-label" for="bentuk_mitra_pemasaran">
                                                    Pemasaran
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                 <input class="form-check-input bentuk_mitra_saprodi" type="checkbox" value="sarana produksi" name="bentuk_mitra_saprodi" id="bentuk_mitra_saprodi" >
                                                    <label class="form-check-label" for="bentuk_mitra_saprodi">
                                                    Sarana Produksi
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                 <input class="form-check-input bnetuk_mitra_pendampingan" type="checkbox" value="pendampingan" name="bnetuk_mitra_pendampingan" id="bnetuk_mitra_pendampingan" >
                                                    <label class="form-check-label" for="bnetuk_mitra_pendampingan">
                                                    Pendampingan
                                                    </label>
                                                    </div>
                                                    <label>Total Aset</label>
                                                <div class="input-group mb-3">
                                                  Rp.   <input type="text" class="form-control" id="total_aset" name="total_aset" placeholder="" >
                                                </div><label>Sertifikat Mutu Produk (ISO, dll)n</label>
                                                <div class="input-group mb-3">
                                                     <input type="text" class="form-control" id="sertifikasi" name="sertifikasi" placeholder="" >
                                                </div>
                                                </div>

                                                <input type="hidden" name="kode_kab" id="kode_kab" value="<?= $kode; ?>">
                                            <input type="hidden" name="kode_kec" id="kode_kec" value="<?= $kode_kec; ?>">
                                                
                                                <input type="hidden" id="id_kep" name="id_kep" >
                                                    <div class="text-center">
                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
                                                        <!-- <button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-sm">Simpan Data</button> -->
                                                    </div>
                                                
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div 
    </div>
</div>   
    </div>
</div>
    </div>
</div>
</div>
    </div>
</div>
</tbody>
</table>
</div>

</div>
<?php echo view('layout/footer'); ?>
<br>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
		 $('#listkep').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'excel'
				]
			});
        $(document).delegate('#btnSave', 'click', function() {

            var kode_kec = $('#kode_kec').val();
            var kode_kab = $('#kode_kab').val();
            var kode_desa = $('#kode_desa').val();
            var nama_kep = $('#nama_kep').val();
            var jenis_kep = $('#jenis_kep').val();
            var alamat = $('#alamat').val();
            var no_telp = $('#no_telp').val();
            var email = $('#email').val(); 
            var nama_direktur = $('#nama_direktur').val();
            var tahun_bentuk = $('#year').val();
            var badan_hukum = $('#badan_hukum').val();
            var jum_anggota = $('#jum_anggota').val();
            var jum_poktan = $('#jum_poktan').val();
            var jum_gapoktan = $('#jum_gapoktan').val();
            var total_aset = $('#total_aset').val();
            var sertifikasi = $('#sertifikasi').val();

            var jenis_mitra_internasional = $(".jenis_mitra_internasional")[0].checked ? $(".jenis_mitra_internasional").val() : "";
            var jenis_mitra_nasional = $(".jenis_mitra_nasional")[0].checked ? $(".jenis_mitra_nasional").val() : "";
            var jenis_mitra_lokal = $(".jenis_mitra_lokal")[0].checked ? $(".jenis_mitra_lokal").val() : "";
            var jenis_mitra_koperasi = $(".jenis_mitra_koperasi")[0].checked ? $(".jenis_mitra_koperasi").val() : "";
            var jenis_mitra_perorangan = $(".jenis_mitra_perorangan")[0].checked ? $(".jenis_mitra_perorangan").val() : "";

            var bentuk_mitra_pemasaran = $(".bentuk_mitra_pemasaran")[0].checked ? $(".bentuk_mitra_pemasaran").val() : "";
            var bentuk_mitra_saprodi = $(".bentuk_mitra_saprodi")[0].checked ? $(".bentuk_mitra_saprodi").val() : "";
            var bnetuk_mitra_pendampingan = $(".bnetuk_mitra_pendampingan")[0].checked ? $(".bnetuk_mitra_pendampingan").val() : "";
           
           
            var luas_lahan_usaha_tp = $('#luas_lahan_usaha_tp').val();
            var luas_lahan_usaha_bun = $('#luas_lahan_usaha_bun').val();
            var luas_lahan_usaha_hor = $('#luas_lahan_usaha_hor').val();
            var luas_lahan_usaha_nak = $('#luas_lahan_usaha_nak').val();
            var luas_lahan_usaha_olah = $('#luas_lahan_usaha_olah').val();

            var pemasaran_regional_tp = $(".pemasaran_regional_tp")[0].checked ? $(".pemasaran_regional_tp").val() : "";
            var pemasaran_regional_bun = $(".pemasaran_regional_bun")[0].checked ? $(".pemasaran_regional_bun").val() : "";
            var pemasaran_regional_hor = $(".pemasaran_regional_hor")[0].checked ? $(".pemasaran_regional_hor").val() : "";
            var pemasaran_regional_nak = $(".pemasaran_regional_nak")[0].checked ? $(".pemasaran_regional_nak").val() : "";
            var pemasaran_regional_olah = $(".pemasaran_regional_olah")[0].checked ? $(".pemasaran_regional_olah").val() : "";

            var pemasaran_ekspor_tp = $(".pemasaran_ekspor_tp")[0].checked ? $(".pemasaran_ekspor_tp").val() : "";
            var pemasaran_ekspor_bun = $(".pemasaran_ekspor_bun")[0].checked ? $(".pemasaran_ekspor_bun").val() : "";
            var pemasaran_ekspor_hor = $(".pemasaran_ekspor_hor")[0].checked ? $(".pemasaran_ekspor_hor").val() : "";
            var pemasaran_ekspor_nak = $(".pemasaran_ekspor_nak")[0].checked ? $(".pemasaran_ekspor_nak").val() : "";
            var pemasaran_ekspor_olah = $(".pemasaran_ekspor_olah")[0].checked ? $(".pemasaran_ekspor_olah").val() : "";
            
            var pemasaran_tti = $(".pemasaran_tti")[0].checked ? $(".pemasaran_tti").val() : "";

  
            if (nama_kep.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama KEP Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (jenis_kep == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jenis KEP Harus Di Pilih",
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
                        text: "Alamat Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (no_telp.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "No Telp Harus Diisi",
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
                        text: "Email Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (nama_direktur.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Ketua/Direktur Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (jum_anggota.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jumlah Anggota Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (jum_poktan.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jumlah Poktan Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (jum_gapoktan.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jumlah Gapoktan Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }


            $.ajax({
                url: '<?= base_url('/KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KelembagaanEkonomiPetani/save/') ?>',
                type: 'POST',
                data: {
                    'kode_kec': kode_kec,
                    'kode_kab': kode_kab,
                    'kode_desa': kode_desa,
                    'nama_kep': nama_kep,
                    'jenis_kep': jenis_kep,
                    'alamat': alamat,
                    'no_telp': no_telp,
                    'email': email,
                    'nama_direktur': nama_direktur,
                    'badan_hukum': badan_hukum,
                    'tahun_bentuk': tahun_bentuk,
                    'jum_anggota': jum_anggota,
                    'jum_poktan': jum_poktan,
                    'jum_gapoktan': jum_gapoktan,
                    'total_aset': total_aset,
                    'sertifikasi': sertifikasi,
                    
                    'jenis_mitra_internasional': jenis_mitra_internasional,
                    'jenis_mitra_nasional': jenis_mitra_nasional,
                    'jenis_mitra_lokal': jenis_mitra_lokal,
                    'jenis_mitra_koperasi': jenis_mitra_koperasi,
                    'jenis_mitra_perorangan': jenis_mitra_perorangan,

                    'bentuk_mitra_pemasaran': bentuk_mitra_pemasaran,
                    'bentuk_mitra_saprodi': bentuk_mitra_saprodi,
                    'bnetuk_mitra_pendampingan': bnetuk_mitra_pendampingan,
                    
                    'luas_lahan_usaha_tp': luas_lahan_usaha_tp,
                    'luas_lahan_usaha_bun': luas_lahan_usaha_bun,
                    'luas_lahan_usaha_hor': luas_lahan_usaha_hor,
                    'luas_lahan_usaha_nak': luas_lahan_usaha_nak,
                    'luas_lahan_usaha_olah': luas_lahan_usaha_olah,
                  
                    
                    'pemasaran_regional_tp': pemasaran_regional_tp,
                    'pemasaran_regional_bun': pemasaran_regional_bun,
                    'pemasaran_regional_hor': pemasaran_regional_hor,
                    'pemasaran_regional_nak': pemasaran_regional_nak,
                    'pemasaran_regional_olah': pemasaran_regional_olah,
                    
                    'pemasaran_ekspor_tp': pemasaran_ekspor_tp,
                    'pemasaran_ekspor_bun': pemasaran_ekspor_bun,
                    'pemasaran_ekspor_hor': pemasaran_ekspor_hor,
                    'pemasaran_ekspor_nak': pemasaran_ekspor_nak,
                    'pemasaran_ekspor_olah': pemasaran_ekspor_olah,
                    
                    'pemasaran_tti': pemasaran_tti,
                    
                    
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if(result.value){
                        Swal.fire({
                            title: 'Sukses',
                            text: "Sukses tambah data",
                            type: 'success',
                        }).then((result) => {

                            if (result.value) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: "Gagal tambah data. " + result.message,
                            type: 'error',
                        }).then((result) => {
                            
                        });
                    }
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
                    var id = $(this).data('id_kep');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KelembagaanEkonomiPetani/delete/' + id,
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
        $(document).delegate('#btnEditKEP', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KelembagaanEkonomiPetani/edit/' + $(this).data('id_kep'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_kep').val(result.id_kep);
                    $('#kode_kec').val(result.kode_kec);
                    $('#kode_desa').val(result.kode_desa);
                    $('#kode_kab').val(result.kode_kab);
                    $('#nama_kep').val(result.nama_kep);
                    $('#jenis_kep').val(result.jenis_kep);
                    $('#alamat').val(result.alamat);
                    $('#year').val(result.tahun_bentuk);
                    $('#no_telp').val(result.no_telp);
                    $('#email').val(result.email);
                    $('#nama_direktur').val(result.nama_direktur);
                    $('#jum_anggota').val(result.jum_anggota);
                    $('#badan_hukum').val(result.badan_hukum);
                    $('#jum_poktan').val(result.jum_poktan);

                    $('#jum_gapoktan').val(result.jum_gapoktan);
                    $('#total_aset').val(result.total_aset);
                    $('#sertifikasi').val(result.sertifikasi);

                    if (result.jenis_mitra_internasional == "perusahaan internasional") {
                        $("#jenis_mitra_internasional").prop("checked", true);
                    } else {
                        $("#jenis_mitra_internasional").prop("checked", false);
                    } 
                    if (result.jenis_mitra_nasional == "perusahaan nasional") {
                        $("#jenis_mitra_nasional").prop("checked", true);
                    } else {
                        $("#jenis_mitra_nasional").prop("checked", false);
                    } 
                    if (result.jenis_mitra_lokal == "perusahaan lokal") {
                        $("#jenis_mitra_lokal").prop("checked", true);
                    } else {
                        $("#jenis_mitra_lokal").prop("checked", false);
                    }
                    if (result.jenis_mitra_koperasi == "koperasi") {
                        $("#jenis_mitra_koperasi").prop("checked", true);
                    } else {
                        $("#jenis_mitra_koperasi").prop("checked", false);
                    }
                    if (result.jenis_mitra_perorangan == "perorangan") {
                        $("#jenis_mitra_perorangan").prop("checked", true);
                    } else {
                        $("#jenis_mitra_perorangan").prop("checked", false);
                    }

                    if (result.bentuk_mitra_pemasaran == "pemasaran") {
                        $("#bentuk_mitra_pemasaran").prop("checked", true);
                    } else {
                        $("#bentuk_mitra_pemasaran").prop("checked", false);
                    } 
                    if (result.bentuk_mitra_saprodi == "sarana produksi") {
                        $("#bentuk_mitra_saprodi").prop("checked", true);
                    } else {
                        $("#bentuk_mitra_saprodi").prop("checked", false);
                    } 
                    if (result.bnetuk_mitra_pendampingan == "pendampingan") {
                        $("#bnetuk_mitra_pendampingan").prop("checked", true);
                    } else {
                        $("#bnetuk_mitra_pendampingan").prop("checked", false);
                    }

                    $('#luas_lahan_usaha_tp').val(result.luas_lahan_usaha_tp);
                    $('#luas_lahan_usaha_bun').val(result.luas_lahan_usaha_bun);
                    $('#luas_lahan_usaha_hor').val(result.luas_lahan_usaha_hor);
                    $('#luas_lahan_usaha_nak').val(result.luas_lahan_usaha_nak);
                    $('#luas_lahan_usaha_olah').val(result.luas_lahan_usaha_olah);

                    if (result.pemasaran_regional_tp == "regional") {
                        $("#pemasaran_regional_tp").prop("checked", true);
                    } else {
                        $("#pemasaran_regional_tp").prop("checked", false);
                    }   
                    if (result.pemasaran_ekspor_tp == "ekspor") {
                        $("#pemasaran_ekspor_tp").prop("checked", true);
                    } else {
                        $("#pemasaran_ekspor_tp").prop("checked", false);
                    } 

                    if (result.pemasaran_regional_bun == "regional") {
                        $("#pemasaran_regional_bun").prop("checked", true);
                    } else {
                        $("#pemasaran_regional_bun").prop("checked", false);
                    }   
                    if (result.pemasaran_ekspor_bun == "ekspor") {
                        $("#pemasaran_ekspor_bun").prop("checked", true);
                    } else {
                        $("#pemasaran_ekspor_bun").prop("checked", false);
                    } 

                    if (result.pemasaran_regional_hor == "regional") {
                        $("#pemasaran_regional_hor").prop("checked", true);
                    } else {
                        $("#pemasaran_regional_hor").prop("checked", false);
                    }   
                    if (result.pemasaran_ekspor_hor == "ekspor") {
                        $("#pemasaran_ekspor_hor").prop("checked", true);
                    } else {
                        $("#pemasaran_ekspor_hor").prop("checked", false);
                    } 

                    if (result.pemasaran_regional_nak == "regional") {
                        $("#pemasaran_regional_nak").prop("checked", true);
                    } else {
                        $("#pemasaran_regional_nak").prop("checked", false);
                    }   
                    if (result.pemasaran_ekspor_nak == "ekspor") {
                        $("#pemasaran_ekspor_nak").prop("checked", true);
                    } else {
                        $("#pemasaran_ekspor_nak").prop("checked", false);
                    } 

                    if (result.pemasaran_regional_olah == "regional") {
                        $("#pemasaran_regional_olah").prop("checked", true);
                    } else {
                        $("#pemasaran_regional_olah").prop("checked", false);
                    }   
                    if (result.pemasaran_ekspor_olah == "ekspor") {
                        $("#pemasaran_ekspor_olah").prop("checked", true);
                    } else {
                        $("#pemasaran_ekspor_olah").prop("checked", false);
                    } 

                    if (result.pemasaran_tti == "tti") {
                        $("#pemasaran_tti").prop("checked", true);
                    } else {
                        $("#pemasaran_tti").prop("checked", false);
                    }   
                  






                    $('#modal-form').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");


                    $(document).delegate('#btnDoEdit', 'click', function() {
                     
                        var id_kep = $('#id_kep').val();
             var kode_kec = $('#kode_kec').val();
            var kode_kab = $('#kode_kab').val();
            var kode_desa = $('#kode_desa').val();
            var nama_kep = $('#nama_kep').val();
            var jenis_kep = $('#jenis_kep').val();
            var alamat = $('#alamat').val();
            var tahun_bentuk = $('#year').val();
            var email = $('#email').val();
            var no_telp = $('#no_telp').val();
            var jum_anggota = $('#jum_anggota').val();
            var jum_poktan = $('#jum_poktan').val();
            var jum_gapoktan = $('#jum_gapoktan').val();
            var nama_direktur = $('#nama_direktur').val();
            var badan_hukum = $('#badan_hukum').val();
            var total_aset = $('#total_aset').val();
            var sertifikasi = $('#sertifikasi').val();

            var jenis_mitra_internasional = $(".jenis_mitra_internasional")[0].checked ? $(".jenis_mitra_internasional").val() : "";
            var jenis_mitra_nasional = $(".jenis_mitra_nasional")[0].checked ? $(".jenis_mitra_nasional").val() : "";
            var jenis_mitra_lokal = $(".jenis_mitra_lokal")[0].checked ? $(".jenis_mitra_lokal").val() : "";
            var jenis_mitra_koperasi = $(".jenis_mitra_koperasi")[0].checked ? $(".jenis_mitra_koperasi").val() : "";
            var jenis_mitra_perorangan = $(".jenis_mitra_perorangan")[0].checked ? $(".jenis_mitra_perorangan").val() : "";

            
            var bentuk_mitra_pemasaran = $(".bentuk_mitra_pemasaran")[0].checked ? $(".bentuk_mitra_pemasaran").val() : "";
            var bentuk_mitra_saprodi = $(".bentuk_mitra_saprodi")[0].checked ? $(".bentuk_mitra_saprodi").val() : "";
            var bnetuk_mitra_pendampingan = $(".bnetuk_mitra_pendampingan")[0].checked ? $(".bnetuk_mitra_pendampingan").val() : "";

            var luas_lahan_usaha_tp = $('#luas_lahan_usaha_tp').val();
            var luas_lahan_usaha_hor = $('#luas_lahan_usaha_hor').val();
            var luas_lahan_usaha_bun = $('#luas_lahan_usaha_bun').val();
            var luas_lahan_usaha_nak = $('#luas_lahan_usaha_nak').val();
            var luas_lahan_usaha_olah = $('#luas_lahan_usaha_olah').val();

            var pemasaran_regional_tp = $(".pemasaran_regional_tp")[0].checked ? $(".pemasaran_regional_tp").val() : "";
            var pemasaran_regional_bun = $(".pemasaran_regional_bun")[0].checked ? $(".pemasaran_regional_bun").val() : "";
            var pemasaran_regional_hor = $(".pemasaran_regional_hor")[0].checked ? $(".pemasaran_regional_hor").val() : "";
            var pemasaran_regional_nak = $(".pemasaran_regional_nak")[0].checked ? $(".pemasaran_regional_nak").val() : "";
            var pemasaran_regional_olah = $(".pemasaran_regional_olah")[0].checked ? $(".pemasaran_regional_olah").val() : "";
            
            var pemasaran_ekspor_tp = $(".pemasaran_ekspor_tp")[0].checked ? $(".pemasaran_ekspor_tp").val() : "";
            var pemasaran_ekspor_bun = $(".pemasaran_ekspor_bun")[0].checked ? $(".pemasaran_ekspor_bun").val() : "";
            var pemasaran_ekspor_hor = $(".pemasaran_ekspor_hor")[0].checked ? $(".pemasaran_ekspor_hor").val() : "";
            var pemasaran_ekspor_nak = $(".pemasaran_ekspor_nak")[0].checked ? $(".pemasaran_ekspor_nak").val() : "";
            var pemasaran_ekspor_olah = $(".pemasaran_ekspor_olah")[0].checked ? $(".pemasaran_ekspor_olah").val() : "";
            
            var pemasaran_tti = $(".pemasaran_tti")[0].checked ? $(".pemasaran_tti").val() : "";

                        let formData = new FormData();
                        formData.append('id_kep', id_kep);
                        formData.append('kode_kec', kode_kec);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_desa', kode_desa);
                        formData.append('nama_kep', nama_kep);
                        formData.append('jenis_kep', jenis_kep);
                        formData.append('alamat', alamat);
                        formData.append('tahun_bentuk', tahun_bentuk);
                        formData.append('email', email);
                        formData.append('no_telp', no_telp);
                        formData.append('nama_direktur', nama_direktur);
                        formData.append('badan_hukum', badan_hukum);
                        formData.append('jum_poktan', jum_poktan);
                        formData.append('jum_anggota', jum_anggota);

                        formData.append('jum_gapoktan', jum_gapoktan);
                        formData.append('total_aset', total_aset);
                        formData.append('sertifikasi', sertifikasi);

                        formData.append('jenis_mitra_internasional', jenis_mitra_internasional);
                        formData.append('jenis_mitra_nasional', jenis_mitra_nasional);
                        formData.append('jenis_mitra_lokal', jenis_mitra_lokal);
                        formData.append('jenis_mitra_koperasi', jenis_mitra_koperasi);
                        formData.append('jenis_mitra_perorangan', jenis_mitra_perorangan);

                        
                        formData.append('bentuk_mitra_pemasaran', bentuk_mitra_pemasaran);
                        formData.append('bentuk_mitra_saprodi', bentuk_mitra_saprodi);
                        formData.append('bnetuk_mitra_pendampingan', bnetuk_mitra_pendampingan);

                        formData.append('jum_poktan', jum_poktan);
                        
                        formData.append('luas_lahan_usaha_tp', luas_lahan_usaha_tp);
                        formData.append('luas_lahan_usaha_bun', luas_lahan_usaha_bun);
                        formData.append('luas_lahan_usaha_hor', luas_lahan_usaha_hor);
                        formData.append('luas_lahan_usaha_nak', luas_lahan_usaha_nak);
                        formData.append('luas_lahan_usaha_olah', luas_lahan_usaha_olah);
                        
                        formData.append('pemasaran_regional_tp', pemasaran_regional_tp);
                        formData.append('pemasaran_regional_bun', pemasaran_regional_bun);
                        formData.append('pemasaran_regional_hor', pemasaran_regional_hor);
                        formData.append('pemasaran_regional_nak', pemasaran_regional_nak);
                        formData.append('pemasaran_regional_olah', pemasaran_regional_olah);

                        formData.append('pemasaran_ekspor_tp', pemasaran_ekspor_tp);
                        formData.append('pemasaran_ekspor_bun', pemasaran_ekspor_bun);
                        formData.append('pemasaran_ekspor_hor', pemasaran_ekspor_hor);
                        formData.append('pemasaran_ekspor_nak', pemasaran_ekspor_nak);
                        formData.append('pemasaran_ekspor_olah', pemasaran_ekspor_olah);
                        
                        formData.append('pemasaran_tti', pemasaran_tti);

            if (nama_kep.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama KEP Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (jenis_kep == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jenis KEP Harus Di Pilih",
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
                        text: "Alamat Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (no_telp.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "No Telp Harus Diisi",
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
                        text: "Email Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (nama_direktur.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Ketua/Direktur Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (jum_anggota.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jumlah Anggota Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (jum_poktan.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jumlah Poktan Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (jum_gapoktan.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Jumlah Gapoktan Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelembagaanEkonomiPetani/KelembagaanEkonomiPetani/update/' + id_kep,
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
<?= $this->endSection() ?>