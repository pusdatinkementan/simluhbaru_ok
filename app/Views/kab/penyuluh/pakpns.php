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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenjang<br>Jabatan/Golongan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Penilaian</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl SK PAK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penunjang</th>
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
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['nama'] ?> / <?= $row['gol_ruang'] ?></a></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_nilai'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['tgl_spk'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['kredit_utama'] ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0"><?= $row['kredit_penunjang'] ?></p>
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
                                        <button class="btn bg-gradient-danger btn-sm" id="btnHapus" data-id="<?= $row['id']; ?>" type="submit" >
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
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h4 class="font-weight-bolder text-warning text-gradient">Ubah Data</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="<?= base_url('Penyuluh/PakPNS/save'); ?>">
                                                <? csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" id="tgl_update" name="tgl_update" class="form-control">
                                                        <input type="hidden" id="id" name="id">
                                                        <input type="hidden" name="satminkal" id="satminkal" class="form-control satminkal" value="<?= $seskab; ?>">
                                                        <label>Nama Penyuluh</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" value="<?= $namaa; ?>" class="form-control" disabled>
                                                            <input type="text" id="nip" name="nip" value="<?= $nipp; ?>" class="form-control" disabled>
                                                        </div>
                                                        <label>Tanggal Penilaian</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="tgl_nilai" id="tgl_nilai" class="form-control tgl_nilai" placeholder="Tanggal Nilai"> S/D
                                                            <input type="text" name="tgl_nilai2" id="tgl_nilai2" class="form-control tgl_nilai2" placeholder="Tanggal Nilai">
                                                        </div>
                                                        <label>Angka Kredit Unsur Utama</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="kredit_utama" id="kredit_utama" class="form-control kredit_utama rupiah" placeholder="Angka Kredit Unsur Utama">
                                                        </div>
                                                        <label>Angka Kredit Unsur Penunjang</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="kredit_penunjang" id="kredit_penunjang" class="form-control rupiah" placeholder="Angka Kredit Unsur Penunjang">
                                                        </div>
                                                        <label>Jenjang Jabatan / Golongan</label>
                                                        <div class="input-group mb-3">
                                                            <select name="gol" id="gol" class="form-control input-lg gol">
                                                                <option value="">Pilih Jabatan</option>
                                                                <?php
                                                                foreach ($pp as $row2) {
                                                                    echo '<option value="' . $row2["kode"] . '">' . $row2["nama"] . ' / ' .  $row2['gol_ruang']. '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>TMT Jenjang JAB / Tgl SPK PAK</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="tgl_spk" id="tgl_spk" class="form-control tgl_spk" placeholder="Tanggal SPK">
                                                        </div>
                                                        <label>Nomor SK PAK</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="no_sk" id="no_sk" class="form-control" placeholder="Nomor SK PAK">
                                                        </div>
                                                        <label>Pejabat Pembuat SK PAK</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="pejabat" id="pejabat" class="form-control" placeholder="Pejabat Pembuat SK PAK">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
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

        </div>
    </div>

    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script>
        $(document).ready(function() {

            $(document).delegate('#btnSave', 'click', function() {

                var nip = $('#nip').val();
                var kredit_utama = $('#kredit_utama').val();
                var kredit_penunjang = $('#kredit_penunjang').val();
                var gol = $('#gol').val();
                var tgl_nilai = $('#tgl_nilai').val();
                var tgl_nilai2 = $('#tgl_nilai2').val();
                var tgl_spk = $('#tgl_spk').val();
                var no_sk = $('#no_sk').val();
                var pejabat = $('#pejabat').val();
                var satminkal = $('#satminkal').val();
                var tgl_update = $('#tgl_update').val();

                if (tgl_nilai.length == 0 || tgl_nilai2.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tanggal Penilaian tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (kredit_utama.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Angka Kredit Unsur Utama tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (kredit_penunjang.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Angka Kredit Unsur Penunjang tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (gol == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Jenjang Jabatan/Golongan tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (tgl_spk.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "TMT Jenjang jab tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (no_sk.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Nomor SK PAK tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (pejabat.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Pejabat pembuat SK PAK tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                $.ajax({
                    url: '<?= base_url('Penyuluh/PakPNS/save'); ?>',
                    type: 'POST',
                    data: {
                        'nip': nip,
                        'kredit_utama': kredit_utama,
                        'kredit_penunjang': kredit_penunjang,
                        'gol': gol,
                        'tgl_nilai': tgl_nilai,
                        'tgl_nilai2': tgl_nilai2,
                        'tgl_spk': tgl_spk,
                        'no_sk': no_sk,
                        'pejabat': pejabat,
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
                            url: '<?= base_url() ?>/Penyuluh/PakPNS/delete/' + id,
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
                    url: '<?= base_url() ?>/Penyuluh/PakPNS/edit/' + $(this).data('id'),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(result) {
                        // console.log(result);

                        $('#id').val(result.id);
                        $('#nip').val(result.nip);
                        $('#kredit_utama').val(result.kredit_utama);
                        $('#kredit_penunjang').val(result.kredit_penunjang);
                        $('#gol').val(result.gol);
                        $('#tgl_nilai').val(result.tgl_nilai);
                        $('#tgl_nilai2').val(result.tgl_nilai2);
                        $('#tgl_spk').val(result.tgl_spk);
                        $('#no_sk').val(result.no_sk);
                        $('#pejabat').val(result.pejabat);
                        $('#satminkal').val(result.satminkal);
                        $('#tgl_update').val(result.tgl_update);

                        $('#modal-form').modal('show');

                        $("#btnSave").attr("id", "btnDoEdit");

                        $(document).delegate('#btnDoEdit', 'click', function() {

                            var id = $('#id').val();
                            var nip = $('#nip').val();
                            var kredit_utama = $('#kredit_utama').val();
                            var kredit_penunjang = $('#kredit_penunjang').val();
                            var gol = $('#gol').val();
                            var tgl_nilai = $('#tgl_nilai').val();
                            var tgl_nilai2 = $('#tgl_nilai2').val();
                            var tgl_spk = $('#tgl_spk').val();
                            var no_sk = $('#no_sk').val();
                            var pejabat = $('#pejabat').val();
                            var satminkal = $('#satminkal').val();
                            var tgl_update = $('#tgl_update').val();

                if (tgl_nilai.length == 0 || tgl_nilai2.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Tanggal Penilaian tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (kredit_utama.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Angka Kredit Unsur Utama tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (kredit_penunjang.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Angka Kredit Unsur Penunjang tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (gol == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Jenjang Jabatan/Golongan tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (tgl_spk.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "TMT Jenjang jab tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (no_sk.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Nomor SK PAK tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }
                if (pejabat.length == 0) {
                    Swal.fire({
                        title: 'Error',
                        text: "Pejabat pembuat SK PAK tidak boleh kosong",
                        type: 'error',
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }
                    });
                    return false;
                }

                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('nip', nip);
                            formData.append('kredit_utama', kredit_utama);
                            formData.append('kredit_penunjang', kredit_penunjang);
                            formData.append('gol', gol);
                            formData.append('tgl_nilai', tgl_nilai);
                            formData.append('tgl_nilai2', tgl_nilai2);
                            formData.append('tgl_spk', tgl_spk);
                            formData.append('no_sk', no_sk);
                            formData.append('pejabat', pejabat);
                            formData.append('satminkal', satminkal);
                            formData.append('tgl_update', tgl_update);


                            $.ajax({
                                url: '<?= base_url() ?>/Penyuluh/PakPNS/update/' + id,
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
            const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let qntYears = 80;
            let selectYear = $("#year2");
            let selectMonth = $("#month2");
            let selectDay = $("#day2");
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
            const monthNames = ["Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            let qntYears = 80;
            let selectYear = $("#year3");
            let selectMonth = $("#month3");
            let selectDay = $("#day3");
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
                $('input[name="tgl_nilai"]').daterangepicker({
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

                $('input[name="tgl_nilai"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                });

                $('input[name="tgl_nilai"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                $('input[name="tgl_nilai2"]').daterangepicker({
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

                $('input[name="tgl_nilai2"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                });

                $('input[name="tgl_nilai2"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                $('input[name="tgl_spk"]').daterangepicker({
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

                $('input[name="tgl_spk"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                });

                $('input[name="tgl_spk"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

        });
    </script>
    <?= $this->endSection() ?>