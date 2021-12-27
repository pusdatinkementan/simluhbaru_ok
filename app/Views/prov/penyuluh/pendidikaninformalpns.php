<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>
<?php $seskab = session()->get('kodebapel'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Map -->
        <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-gradient-primary btn-sm">+ Tambah Data</button><br>
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Diklat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelompok Diklat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penyelenggara</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terakhir Update</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama'] ?></a></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['kelompok'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['lokasi'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['penyelenggara'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= ucwords(strtolower($row['tgl_update'])) ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a href="#">
                                            <button type="button" id="btnEdit" data-id="<?= $row['id']; ?>" class="btn bg-gradient-warning btn-sm">
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>
                                        </a>
                                        <button class="btn bg-gradient-danger btn-sm" id="btnHapus" data-id="<?= $row['id']; ?>" type="submit" onclick="return confirm('Are you sure ?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- modal -->
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Ubah Data</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="<?= base_url('Penyuluh/PendInFormalPns/save'); ?>">
                                                <? csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" id="tgl_update" name="tgl_update" class="form-control">
                                                        <input type="hidden" id="id" name="id">
                                                        <label>Nama Penyuluh</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" value="<?= $namaa; ?>" class="form-control" disabled>
                                                            <input type="text" id="nip" name="nip" value="<?= $nipp; ?>" class="form-control" disabled>
                                                        </div>
                                                        <label>Nama Diklat Fungsional</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="nama" id="nama" class="form-control nama" placeholder="Nama">
                                                        </div>
                                                        <label>Kelompok Diklat Fungsional</label>
                                                        <div class="input-group mb-3">
                                                            <select name="kelompok" id="kelompok" class="form-control input-lg kelompok">
                                                                <option value="">Pilih Provinsi</option>
                                                                <?php
                                                                foreach ($diklat as $row2) {
                                                                    echo '<option value="' . $row2["nama"] . '">' . $row2["nama"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>Tahun Diklat</label>
                                                        <div class="input-group mb-3">
                                                            <select id="year" name="tgl_mulai" class="form-select tgl_mulai" aria-label="Default select example">
                                                                <option value="">Tahun</option>
                                                            </select>
                                                        </div>
                                                        <label>Lembaga Penyelenggara</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" placeholder="Lembaga Penyelenggara">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <center><button type="button" id="btnSave" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Simpan Data</button></center>
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

        </div>
    </div>

    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script>
        $(document).ready(function() {

            $(document).delegate('#btnSave', 'click', function() {

                var nip = $('#nip').val();
                var nama = $('#nama').val();
                var kelompok = $('#kelompok').val();
                var lokasi = $('#lokasi').val();
                var tgl_mulai = $('#year').val();
                var penyelenggara = $('#penyelenggara').val();
                var jml_jam = $('#jml_jam').val();
                var satminkal = $('#satminkal').val();
                var tgl_update = $('#tgl_update').val();

                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PendInformalPns/save/',
                    type: 'POST',
                    data: {
                        'nip': nip,
                        'nama': nama,
                        'kelompok': kelompok,
                        'lokasi': lokasi,
                        'tgl_mulai': tgl_mulai,
                        'penyelenggara': penyelenggara,
                        'jml_jam': jml_jam,
                        'satminkal': satminkal,
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
                        var id = $(this).data('id');

                        $.ajax({
                            url: '<?= base_url() ?>/Penyuluh/PendInformalPns/delete/' + id,
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


            $(document).delegate('#btnEdit', 'click', function() {
                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PendInformalPns/edit/' + $(this).data('id'),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(result) {
                        // console.log(result);

                        $('#id').val(result.id);
                        $('#nip').val(result.nip);
                        $('#nama').val(result.nama);
                        $('#kelompok').val(result.kelompok);
                        $('#lokasi').val(result.lokasi);
                        $('#year').val(result.tgl_mulai);
                        $('#penyelenggara').val(result.penyelenggara);
                        $('#jml_jam').val(result.jml_jam);
                        $('#satminkal').val(result.satminkal);
                        $('#tgl_update').val(result.tgl_update);

                        $('#modal-form').modal('show');

                        $("#btnSave").attr("id", "btnDoEdit");

                        $(document).delegate('#btnDoEdit', 'click', function() {

                            var id = $('#id').val();
                            var nip = $('#nip').val();
                            var nama = $('#nama').val();
                            var kelompok = $('#kelompok').val();
                            var lokasi = $('#lokasi').val();
                            var tgl_mulai = $('#year').val();
                            var penyelenggara = $('#penyelenggara').val();
                            var jml_jam = $('#jml_jam').val();
                            var satminkal = $('#satminkal').val();
                            var tgl_update = $('#tgl_update').val();

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nip', nip);
                            formData.append('nama', nama);
                            formData.append('kelompok', kelompok);
                            formData.append('lokasi', lokasi);
                            formData.append('tgl_mulai', year);
                            formData.append('penyelenggara', penyelenggara);
                            formData.append('jml_jam', jml_jam);
                            formData.append('satminkal', satminkal);
                            formData.append('tgl_update', tgl_update);


                            $.ajax({
                                url: '<?= base_url() ?>/Penyuluh/PendInformalPns/update/' + id,
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

            for (var m = 1; m <= 12; m++) {
                let month = monthNames[m];
                let monthElem = document.createElement("option");
                monthElem.value = m;
                monthElem.textContent = month;
                selectMonth.append(monthElem);
            }

            var d = new Date();
            var month = d.getMonth();
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
                var month = parseInt(selectMonth.val()) + 1;
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
    <?= $this->endSection() ?>