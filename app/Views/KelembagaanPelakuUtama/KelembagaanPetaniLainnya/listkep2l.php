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
    <h3>Daftar Kelompok P2L di Kec <?= ucwords(strtolower($nama_kecamatan)) ?> </h3>
	 <p>Data ditemukan <?= ucwords(strtolower($jum)) ?></p>
</center>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
<button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-success btn-sm">+ Tambah Data</button>

<div class="card">
    <div class="table-responsive">
        <table id="tblP2l" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Desa</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No SK CPCL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Kelompok</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Ketua</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Sekretaris</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Bendahara</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat Sekretariat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tanggal Pembentukan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Komodias Yang <br> Diusahakan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Status</th>
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
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nm_desa'] ?></p>
                    </td>  
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['no_sk_cpcl'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_poktan'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_ketua'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_sekretaris'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_bendahara'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['alamat_sekretariat'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['tanggal_bentuk'] ?></p>
                    </td>
                    <td class="align-middle text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['kode_komoditas_hor'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['status'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                    <button type="button"  data-id_p2l="<?= $row['id_p2l'] ?>" id="btnEditP2l" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                            
                           
                                <button class="btn btn-danger btn-sm" id="btnHapus" data-id_p2l="<?= $row['id_p2l'] ?>" type="button" >
                                <i class="fas fa-trash"></i> Hapus
                            </button>
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
                                        <form role="form text-left" action="<?= base_url('/KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya/save'); ?>" method="post" enctype="multipart/form-data">
                                            <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col" mt-5>
                                            <label>Kecamatan</label>
                                            <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Kecamatan" value="<?= $nama_kecamatan; ?>" disabled>
                                            </div>
                                            <label>Desa</label>
                                            <div class="input-group mb-3">
                                               <select name="kode_desa" id="kode_desa"  class="form-control input-lg">
                                                            <option value="">Pilih Desa</option>
                                                            <?php
                                                            foreach ($desa as $row2) {
                                                                echo '<option value="' . $row2["id_desa"] . '">' . $row2["id_desa"].'-' . $row2["nm_desa"] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                            </div>
                                            <label>No SK CPL</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="no_sk_cpcl" name="no_sk_cpcl" >
                                            </div>
                                            <label>No Urut Dalam SK</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="no_urut_sk" name="no_urut_sk">
                                            </div>
                                            <label>Nama Kelompok</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_poktan" name="nama_poktan" >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label>Nama Ketua (ISIKAN NIK)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_ketua" name="nama_ketua">
                                            </div>
                                            <label>Nama Sekretaris (ISIKAN NIK)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_sekretaris" name="nama_sekretaris" >
                                            </div> 
                                            <label>Nama Bendahara (ISIKAN NIK)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_bendahara" name="nama_bendahara" >
                                            </div>
                                            <label>Alamat Lengkap Sekretariat</label>
                                                <textarea class="form-control" id="alamat_sekretariat" placeholder="Alamat" name="alamat_sekretariat" ></textarea>
                                            <label>Tanggal Pembentukan</label>
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" id="tanggal_bentuk" name="tanggal_bentuk"  >
                                                   
                                                </select>
                                            </div>
                                            <label>Komoditas</label>
                                            <div class="input-group mb-3">
                                               <select name="kode_komoditas_hor" id="kode_komoditas_hor"  class="form-control input-lg">
                                                            <option value="">Pilih Komoditas</option>
                                                            <?php
                                                            foreach ($komoditas as $row2) {
                                                                echo '<option value="' . $row2["id_komoditas"] . '">' . $row2["nama_subsektor"] . '-' . $row2["nama_komoditas"] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                            </div>
                                            <label>Status</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="status" name="status" aria-label="Default select example">
                                                    <option value="">Pilih  </option>
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Tidak aktif</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                            <input type="hidden" name="kode_kab" id="kode_kab" value="<?= $kode_kab; ?>">
                                            <input type="hidden" id="kode_kec" name="kode_kec" value="<?= $kode_kec; ?>" >
                                                <input type="hidden" id="id_p2l" name="id_p2l" >
                                               
                                                </div>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-round bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="btnSave" class="btn btn-round bg-gradient-info btn-sm">Simpan Data</button>
                                                    </div>
                                            </form>
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

<?php $this->section('script') ?>


<script>
    $(document).ready(function() {
   $('#tblP2l').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'excel'
				]
			});
        $(document).delegate('#btnSave', 'click', function() {

            var kode_prop = $('#kode_prop').val();
            var kode_kec = $('#kode_kec').val();
            var kode_kab = $('#kode_kab').val();
            var kode_desa = $('#kode_desa').val();
            var no_sk_cpcl = $('#no_sk_cpcl').val();
            var no_urut_sk = $('#no_urut_sk').val();
            var nama_poktan = $('#nama_poktan').val();
            var nama_ketua = $('#nama_ketua').val();
            var nama_sekretaris = $('#nama_sekretaris').val();
            var nama_bendahara = $('#nama_bendahara').val();
            var alamat_sekretariat = $('#alamat_sekretariat').val();
            var tanggal_bentuk = $('#tanggal_bentuk').val();
            var kode_komoditas_hor = $('#kode_komoditas_hor').val();
            var status = $('#status').val();
if (kode_desa == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Desa Harus Di pilih",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

   if (no_sk_cpcl.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "SK Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
 if (no_urut_sk.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "No Urut SK Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
 if (nama_poktan.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Kelompok Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
 if (nama_ketua.length == 0) {
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
if (nama_sekretaris.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Sekretaris Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (nama_bendahara.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Bendahara Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (alamat_sekretariat.length == 0) {
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
if (kode_komoditas_hor == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Kode Komoditas Harus Di Pilih",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (status == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Status Harus Di Pilih",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

            $.ajax({
                url: '<?= base_url('/KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya/save'); ?>',
                type: 'POST',
                data: {
                    'kode_prop': kode_prop,
                    'kode_kec': kode_kec,
                    'kode_kab': kode_kab,
                    'kode_desa': kode_desa,
                    'no_sk_cpcl': no_sk_cpcl,
                    'no_urut_sk': no_urut_sk,
                    'nama_poktan': nama_poktan,
                    'nama_ketua': nama_ketua,
                    'nama_sekretaris': nama_sekretaris,
                    'nama_bendahara': nama_bendahara,
                    'alamat_sekretariat': alamat_sekretariat,
                    'tanggal_bentuk': tanggal_bentuk,
                    'kode_komoditas_hor': kode_komoditas_hor,
                    'status': status,
                    
                   

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
                    var id = $(this).data('id_p2l');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya/delete/' + id,
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
        $(document).delegate('#btnEditP2l', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya/edit/' + $(this).data('id_p2l'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_p2l').val(result.id_p2l);
                    $('#kode_kec').val(result.kode_kec);
                    $('#kode_prop').val(result.kode_prop);
                    $('#kode_desa').val(result.kode_desa);
                    $('#kode_kab').val(result.kode_kab);
                    $('#no_sk_cpcl').val(result.no_sk_cpcl);
                    $('#no_urut_sk').val(result.no_urut_sk);
                    $('#nama_poktan').val(result.nama_poktan);
                    $('#nama_ketua').val(result.nama_ketua);
                    $('#nama_bendahara').val(result.nama_bendahara);
                    $('#nama_sekretaris').val(result.nama_sekretaris);
                    $('#alamat_sekretariat').val(result.alamat_sekretariat);
                    $('#tanggal_bentuk').val(result.tanggal_bentuk);
                    $('#kode_komoditas_hor').val(result.kode_komoditas_hor);
                    $('#status').val(result.status);


                    $('#modal-form').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                     

                        var id_p2l = $('#id_p2l').val();
                        var kode_prop = $('#kode_prop').val();
                        var kode_kec = $('#kode_kec').val();
                        var kode_kab = $('#kode_kab').val();
                        var kode_desa = $('#kode_desa').val();
                        var no_sk_cpcl = $('#no_sk_cpcl').val();
                        var no_urut_sk = $('#no_urut_sk').val();
                        var nama_poktan = $('#nama_poktan').val();
                        var nama_ketua = $('#nama_ketua').val();
                        var nama_bendahara = $('#nama_bendahara').val();
                        var nama_sekretaris = $('#nama_sekretaris').val();
                        var alamat_sekretariat = $('#alamat_sekretariat').val();
                        var tanggal_bentuk = $('#tanggal_bentuk').val();
                        var $kode_komoditas_hor = $('#kode_komoditas_hor').val();
                        var status = $('#status').val();

                        let formData = new FormData();
                        formData.append('id_p2l', id_p2l);
                        formData.append('kode_prop', kode_prop);
                        formData.append('kode_kec', kode_kec);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_desa', kode_desa);
                        formData.append('no_sk_cpcl', no_sk_cpcl);
                        formData.append('no_urut_sk', no_urut_sk);
                        formData.append('nama_poktan', nama_poktan);
                        formData.append('nama_ketua', nama_ketua);
                        formData.append('nama_bendahara', nama_bendahara);
                        formData.append('nama_sekretaris', nama_sekretaris);
                        formData.append('alamat_sekretariat', alamat_sekretariat);
                        formData.append('tanggal_bentuk', tanggal_bentuk);
                        formData.append('kode_komoditas_hor', kode_komoditas_hor);
                        formData.append('status', status);
                        
                       if (kode_desa == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Desa Harus Di pilih",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

   if (no_sk_cpcl.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "SK Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
 if (no_urut_sk.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "No Urut SK Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
 if (nama_poktan.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Kelompok Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
 if (nama_ketua.length == 0) {
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
if (nama_sekretaris.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Sekretaris Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (nama_bendahara.length == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Nama Bendahara Harus Diisi",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (alamat_sekretariat.length == 0) {
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
if (kode_komoditas_hor == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Kode Komoditas Harus Di Pilih",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
if (status == 0) {
                Swal.fire({
                        title: 'Error',
                        text: "Status Harus Di Pilih",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }


                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/KelembagaanPetaniLainnya/KelembagaanPetaniLainnya/update/' + id_p2l,
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
<?php $this->endSection() ?>
