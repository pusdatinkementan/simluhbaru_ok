<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center><h2> Daftar Kelompok Tani di Desa <?= ucwords(strtolower($nama_desa)) ?> </h2></center>
<br />
<div class="card">
    <div class="table-responsive">
        <table id="tblDes" class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">No</th>
                   
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Poktan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Alamat Sekretariat</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Nama Ketua</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Anggota Poktan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="text-align: center;">Aksi</th>
                 
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($tabel_data as $row) {
            ?>
            
                <tr>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama_poktan'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['alamat'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['ketua_poktan'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0"><?= $row['jum'] ?></p>
                    </td>
                    <td class="align-middle text-center text-sm">
                    <button type="button"  data-id_poktan="<?= $row['id_poktan'] ?>" id="btnEditDes" class="btn bg-gradient-warning btn-sm">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                            
                           
                                <button class="btn btn-danger btn-sm" id="btnHapus" data-id_poktan="<?= $row['id_poktan'] ?>" type="button" >
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
                                        <form role="form text-left" action="<?= base_url('/KelembagaanPelakuUtama/Gapoktan/ListGapoktanDesa/save'); ?>" method="post" enctype="multipart/form-data">
                                            <? csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-5" mt-5>
                                            <label>Desa</label>
                                            <div class="input-group mb-3">
                                            <input type="text" class="form-control"   placeholder="Kecamatan" value="<?= $nama_desa; ?>" disabled>
                                            </div>
                                            <label>Desa</label>
                                            <div class="input-group mb-3">
                                               <select name="kode_desa" id="kode_desa"  class="form-control input-lg">
                                                            <option value="">Pilih Desa</option>
                                                            <?php
                                                            foreach ($desa as $row2) {
                                                                echo '<option value="' . $row2["id_desa"] . '">' . $row2["nm_desa"] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                            </div>
                                            <label>Nama Kelompok Tani</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="nama_poktan" name="nama_poktan" placeholder="Nama Poktan" required>
                                            </div>
                                            <label>Ketua Kelompok Tani</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="ketua_poktan" name="ketua_poktan" placeholder="Nama Ketua" required>
                                            </div>
                                            <label>Alamat Lengkap Sekretariat</label>
                                                <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" required></textarea>
                                                </div>
                                                <div class="col">
                                                <label>Tahun Pembentukan</label>
                                            <div class="input-group mb-3">
                                                <select id="year" class="form-select"  aria-label="Default select example" name="simluh_tahun_bentuk">
                                                    <option selected>Pilih Tahun</option>
                                                </select>
                                            </div>
                                            <label>Jenis Kelompok</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select simluh_jenis_kelompok" id="simluh_jenis_kelompok" name="simluh_jenis_kelompok" >
                                                    <option selected>Pilih  </option>
                                                    <option value="domisili">Domisili</option>
                                                    <option value="perempuan">Perempuan</option>
                                                    <option value="tp">Tanaman Pangan</option>
                                                    <option value="hor">Hortikultura</option>
                                                    <option value="nak">Peternakan</option>
                                                    <option value="bun">Perkebunan</option>
                                                    <option value="olah">Pengolahan</option>
                                                    <option value="lain">Lainnya</option>
                                                </select>
                                            </div>  
                                            <label>Kelas Kemampuan</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="simluh_kelas_kemampuan" name="simluh_kelas_kemampuan" aria-label="Default select example">
                                                    <option selected>Pilih  </option>
                                                    <option value="pemula">Pemula</option>
                                                    <option value="lanjut">Lanjut</option>
                                                    <option value="madya">Madya</option>
                                                    <option value="utama">Utama</option>
                                                </select>
                                            </div>  
                                            <label>Tahun Penetapan Kelas</label>
                                            <div class="input-group mb-3">
                                                <select id="year2" class="form-select"  aria-label="Default select example" name="simluh_tahun_tap_kelas">
                                                    <option selected>Pilih Tahun</option>
                                                </select>
                                            </div>
                                                        </div>
                                            
                                                <br>
                                                <input type="hidden" id="id_poktan" name="id_poktan" >
                                            <input type="hidden" class="form-control" id="id_gap" name="id_gap" value="<?= $row['id_gap'] ?>" >
                                            <div class="text-center">
<button type="button" class="btn btn-round bg-gradient-secondary" data-bs-dismiss="modal">Close</button>


                                                        <button type="button" id="btnSave" class="btn btn-round bg-gradient-info btn-sm">Simpan Data</button>
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

        $('#tblDes').DataTable();
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
                    var id = $(this).data('id_poktan');

                    $.ajax({
                        url: '<?= base_url() ?>/KelembagaanPelakuUtama/Gapoktan/ListGapoktanDesa/delete/' + id,
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
        $(document).delegate('#btnEditDes', 'click', function() {
            $.ajax({
                url: '<?= base_url() ?>/KelembagaanPelakuUtama/Gapoktan/ListGapoktanDesa/edit/' + $(this).data('id_poktan'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    // console.log(result);

                    $('#id_poktan').val(result.id_poktan);
                    $('#kode_kec').val(result.kode_kec);
                    $('#kode_prop').val(result.kode_prop);
                    $('#kode_desa').val(result.kode_desa);
                    $('#kode_kab').val(result.kode_kab);
                    $('#nama_poktan').val(result.nama_poktan);
                    $('#ketua_poktan').val(result.ketua_poktan);
                    $('#alamat').val(result.alamat);
                    $('#year').val(result.simluh_tahun_bentuk);
                    $('#simluh_jenis_kelompok').val(result.simluh_jenis_kelompok);
                    $('#simluh_kelas_kemampuan').val(result.simluh_kelas_kemampuan);
                    $('#year2').val(result.simluh_tahun_tap_kelas);
                   
                    $('#modal-form').modal('show');
                    $("#btnSave").attr("id", "btnDoEdit");

                    $(document).delegate('#btnDoEdit', 'click', function() {
                     

                        var id_poktan = $('#id_poktan').val();
                        var id_gap = $('#id_gap').val();
                        var kode_prop = $('#kode_prop').val();
                        var kode_kec = $('#kode_kec').val();
                        var kode_kab = $('#kode_kab').val();
                        var kode_desa = $('#kode_desa').val();
                        var nama_poktan = $('#nama_poktan').val();
                        var ketua_poktan = $('#ketua_poktan').val();
                        var alamat = $('#alamat').val();
                        var simluh_tahun_bentuk = $('#year').val();
                        var simluh_jenis_kelompok = $('#simluh_jenis_kelompok').val();
                        var simluh_kelas_kemampuan = $('#simluh_kelas_kemampuan').val();
                        var simluh_tahun_tap_kelas = $('#year2').val();
                       
                      
                

                        let formData = new FormData();
                        formData.append('id_poktan', id_poktan);
                        formData.append('id_gap', id_gap);
                        formData.append('kode_prop', kode_prop);
                        formData.append('kode_kec', kode_kec);
                        formData.append('kode_kab', kode_kab);
                        formData.append('kode_desa', kode_desa);
                        formData.append('nama_poktan', nama_poktan);
                        formData.append('ketua_poktan', ketua_poktan);
                        formData.append('alamat', alamat);
                        formData.append('simluh_tahun_bentuk', simluh_tahun_bentuk);
                        formData.append('simluh_jenis_kelompok', simluh_jenis_kelompok);
                        formData.append('simluh_kelas_kemampuan', simluh_kelas_kemampuan);
                        formData.append('simluh_tahun_tap_kelas', simluh_tahun_tap_kelas);
                       
                        $.ajax({
                            url: '<?= base_url() ?>/KelembagaanPelakuUtama/Gapoktan/ListGapoktanDesa/update/' + id_poktan,
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
    $(document).ready(function() {
        const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        let qntYears = 80;
        let selectYear = $("#year2");
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

        for (var m = 1; m <= 12; m++) {
            let month = monthNames[m];
            let monthElem = document.createElement("option");
            monthElem.value = m;
            monthElem.textContent = month;
            selectMonth.append(monthElem);
        }

        var d = new Date();
        var month = d.getMonth();
        var year2 = d.getFullYear();
        var day = d.getDate();

        selectYear.val(year2);
        selectYear.on("change", AdjustDays);
        selectMonth.val(month);
        selectMonth.on("change", AdjustDays);

        AdjustDays();
        selectDay.val(day)

        function AdjustDays() {
            var year2 = selectYear.val();
            var month = parseInt(selectMonth.val()) + 1;
            selectDay.empty();

            //get the last day, so the number of days in that month
            var days = new Date(year2, month, 0).getDate();

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
<?php $this->endSection() ?>