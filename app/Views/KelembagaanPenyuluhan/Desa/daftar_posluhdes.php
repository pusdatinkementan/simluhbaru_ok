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
    <h3> Daftar Posluhdes di Kecamatan <?= ucwords(strtolower($nama_kecamatan)) ?> </h3>
    <p> Ditemukan <?= ucwords(strtolower($jum_kec)) ?> Data </p>
</center>

<button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#modal-form">+ Tambah Data</button>

<div class="card">
    <div class="table-responsive">
        <table id="tblposluhdes" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs"></th>
                    <th class="text-uppercase text-secondary text-xxs">Desa</th>
                    <th class="text-uppercase text-secondary text-xxs">NamaPosluhdes</th>
                    <th class="text-uppercase text-secondary text-xxs">Alamat</th>
                    <th class="text-uppercase text-secondary text-xxs">Ketua</th>
                    <th class="text-uppercase text-secondary text-xxs">Sekretaris</th>
                    <th class="text-uppercase text-secondary text-xxs">Bendahara</th>
                    <th class="text-uppercase text-secondary text-xxs">TahunBerdiri</th>
                    <th class="text-uppercase text-secondary text-xxs">JumlahAnggota</th>
                    <th class="text-uppercase text-secondary text-xxs">PenyuluhSwadaya</th>

                </tr>
                <tr>
                    <td width="5" class="text-uppercase text-secondary text-xxs font-weight-bolder">No</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Desa</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama<br>Posluhdes</td>
                    <td width="120" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Ketua</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Sekretaris</td>
                    <td width="90" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Bendahara</td>
                    <td width="10" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Tahun<br>Berdiri</td>
                    <td width="10" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Jumlah<br>Anggota</td>
                    <td width="100" class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Penyuluh<br>Swadaya</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($tabel_data as $row => $item) {
                ?>
                    <tr>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                        </td>
                        <td width="50">
                            <p class="text-xs font-weight-bold mb-0"></p>
                            <div class="dropdown show">
                                <a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $item['nm_desa'] ?>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" data-idpos="<?= $item['idpos'] ?>" id="btn-edit" href="#"> <i class="fas fa-edit"></i> Ubah</a>
                                    <a class="dropdown-item" id="btn-hapus" data-idpos="<?= $item['idpos'] ?>" href="#"><i class="fas fa-trash"></i> Hapus</a>
                                </div>
                            </div>

                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['nama'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['alamat'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['ketua'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['sekretaris'] ?></p>
                        </td>
                        <td class="align-middle text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['bendahara'] ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['tahun_berdiri'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['jum_anggota'] ?></p>
                        </td>
                        <td class="align-middle rupiah text-sm">
                            <p class="text-xs font-weight-bold mb-0"><?= $item['penyuluh_swadaya'] ?></p>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>


        <!-- Modal Add  -->

        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h4 class="font-weight-bolder text-warning text-gradient" id="judul_form">Tambah Data</h4>
                            </div>
                            <div class="card-body">

                                <form role="form text-left" action="<?= base_url('KelembagaanPenyuluhan/Desa/desa/save'); ?>">
                                    <div class="row">
                                        <div class="col">
                                            <label for="deskripsi">Kecamatan</label>
                                            <input type="hidden" name="idpos" id="idpos">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="deskripsi" placeholder="Kecamatan" value="<?= $nama_kecamatan; ?>" disabled>
                                            </div>
                                            <label for="kode_desa">Desa</label>
                                            <div class="input-group mb-3">
                                                <select name="kode_desa" id="kode_desa" class="form-control input-lg" required>
                                                    <option value="">Pilih Desa</option>
                                                    <?php
                                                    foreach ($desa as $row2) {
                                                        echo '<option value="' . $row2["id_desa"] .  '">' . $row2["nm_desa"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label for="nama">Nama Posluhdes</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama" placeholder="nama posluhdes" name="nama" required>
                                            </div>
                                            <label for="alamat">Alamat</label>
                                            <div class="input-group mb-3">
                                                <textarea type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat"></textarea>
                                            </div>
                                            <label for="ketua">Ketua</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="ketua" placeholder="ketua" name="ketua">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="sekretaris">Sekretaris</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="sekretaris" placeholder="sekretaris" name="sekretaris">
                                            </div>
                                            <label for="bendahara">Bendahara</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="bendahara" placeholder="bendahara" name="bendahara">
                                            </div>
                                            <label for="tahun_beridiri">tahun Berdiri</label>
                                            <div class="input-group mb-3">
                                                <select name="tahun_berdiri" id="year" class="form-control input-lg">
                                                    <option value="">Tahun</option>
                                                </select>
                                            </div>
                                            <label for="jum_anggota">Jumlah Anggota</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="jum_anggota" placeholder="jumlah anggota" name="jum_anggota" onkeypress="return Angka(event)">
                                            </div>
                                            <label for="penyuluh_swadaya">Penyuluh Swadaya</label>
                                            <div class="input-group mb-3">
                                                <select name="penyuluh_swadaya" id="penyuluh_swadaya" class="form-control input-lg">
                                                    <option value="">Penyuluh Swadaya</option>
                                                    <?php
                                                    foreach ($pen_swa as $row3) {
                                                        echo '<option value="' . $row3["id_swa"] . '">' . $row3["nama"] . ' - ' . $row3["nm_desa"] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="kode_kab" id="kode_kab" value="<?= $kode; ?>">
                                            <input type="hidden" name="kode_prop" id="kode_prop" value="<?= $kode_prop; ?>">
                                            <input type="hidden" name="kode_kec" id="kode_kec" value="<?= $kode_kec; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="btnSave" class="btn bg-gradient-info">Simpan Data</button>
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
</div>
</tbody>
</table>
</div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    function Angka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
    $(document).ready(function() {

        var input_id = 0;
        $('#tblposluhdes thead th').each(function() {
            var title = $(this).text();
            if (title != '') {
                $(this).html('<input id="input_search_' + input_id + '" type="text" style="width: 100%" placeholder="Search ' + title + '" />');
            }
            input_id++;
        });

        $('#tblposluhdes').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel',
                'pdf'
            ],
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('#input_search_' + this.index()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });
        $(document).delegate('#btnSave', 'click', function() {

            var kode_desa = $('#kode_desa').val();
            var kode_kab = $('#kode_kab').val();
            var kode_prop = $('#kode_prop').val();
            var kode_kec = $('#kode_kec').val();
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var ketua = $('#ketua').val();
            var sekretaris = $('#sekretaris').val();
            var bendahara = $('#bendahara').val();
            var tahun_berdiri = $('#year').val();
            var jum_anggota = $('#jum_anggota').val();
            var penyuluh_swadaya = $('#penyuluh_swadaya').val();

            if (nama.length == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Nama Posluhdes Harus Di Pilih",
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

            if (tahun_berdiri == 0) {
                Swal.fire({
                    title: 'Error',
                    text: "Tahun Berdiri Harus Diisi",
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
                    text: "Jumlah Anggota Harus Dipilih",
                    type: 'error',
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                });
                return false;

            }

            $.ajax({
                url: '<?= base_url('/KelembagaanPenyuluhan/Desa/desa/save/') ?>',
                type: 'POST',
                data: {
                    'kode_desa': kode_desa,
                    'kode_prop': kode_prop,
                    'kode_kab': kode_kab,
                    'kode_kec': kode_kec,
                    'nama': nama,
                    'alamat': alamat,
                    'ketua': ketua,
                    'sekretaris': sekretaris,
                    'bendahara': bendahara,
                    'tahun_berdiri': tahun_berdiri,
                    'jum_anggota': jum_anggota,
                    'penyuluh_swadaya': penyuluh_swadaya

                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.value) {
                        Swal.fire({
                            title: 'Sukses',
                            text: "Sukses tambah data",
                            type: 'success',
                        }).then((result) => {

                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
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
        $(document).delegate('#btn-edit', 'click', function() {
            //var myModal = new bootstrap.Modal(document.getElementById('modal-edit'), options);
            // alert(id);
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPenyuluhan/Desa/desa/detail_posluhdes/' + $(this).data('idpos'),
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    // $(".daftpos").html(res)
                    //console.log(res);
                    //res = JSON.parse(res);

                    $('#idpos').val(res[0].idpos);
                    $('#deskripsi').val(res[0].deskripsi);
                    $('#kode_desa').val(res[0].kode_desa);
                    $('#kode_prop').val(res[0].kode_prop);
                    $('#kode_kab').val(res[0].kode_kab);
                    $('#kode_kec').val(res[0].kode_kec);
                    $('#nama').val(res[0].nama);
                    $('#alamat').val(res[0].alamat);
                    $('#ketua').val(res[0].ketua);
                    $('#sekretaris').val(res[0].sekretaris);
                    $('#bendahara').val(res[0].bendahara);
                    $('#year').val(res[0].tahun_berdiri);
                    $('#jum_anggota').val(res[0].jum_anggota);
                    $('#penyuluh_swadaya').val(res[0].penyuluh_swadaya);
                    $('#judul-form').text('Edit Data');
                    $('#modal-form').modal("show");
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                        console.log('ok');

                        var idpos = $('#idpos').val();
                        var kode_desa = $('#kode_desa').val();
                        var kode_prop = $('#kode_prop').val();
                        var kode_kab = $('#kode_kab').val();
                        var kode_kec = $('#kode_kec').val();
                        var nama = $('#nama').val();
                        var alamat = $('#alamat').val();
                        var ketua = $('#ketua').val();
                        var sekretaris = $('#sekretaris').val();
                        var bendahara = $('#bendahara').val();
                        var tahun_berdiri = $('#year').val();
                        var jum_anggota = $('#jum_anggota').val();
                        var penyuluh_swadaya = $('#penyuluh_swadaya').val();

                        if (nama.length == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Nama Posluhdes Harus Di Pilih",
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

                        if (tahun_berdiri == 0) {
                            Swal.fire({
                                title: 'Error',
                                text: "Tahun Berdiri Harus Diisi",
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
                                text: "Jumlah Anggota Harus Dipilih",
                                type: 'error',
                            }).then((result) => {
                                if (result.value) {
                                    return false;
                                }
                            });
                            return false;

                        }

                        let formData = new FormData();
                        formData.append('idpos', idpos);
                        formData.append('kode_desa', kode_desa);
                        formData.append('kode_prop', kode_prop);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_kec', kode_kec);
                        formData.append('nama', nama);
                        formData.append('alamat', alamat);
                        formData.append('ketua', ketua);
                        formData.append('sekretaris', sekretaris);
                        formData.append('bendahara', bendahara);
                        formData.append('tahun_berdiri', tahun_berdiri);
                        formData.append('jum_anggota', jum_anggota);
                        formData.append('penyuluh_swadaya', penyuluh_swadaya);

                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPenyuluhan/Desa/desa/update/' + idpos,
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
        $(document).delegate('#btn-hapus', 'click', function() {
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
                    var id = $(this).data('idpos');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPenyuluhan/Desa/desa/delete/' + id,
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
    });
</script>

<?= $this->endSection() ?>