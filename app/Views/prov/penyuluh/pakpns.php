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
                                                            <select id="hari" name="tgl_nilai" class="form-select tgl_nilai" aria-label="Default select example">
                                                                <option value="">Tgl</option>
                                                                <OPTION value="01">01<BR>
                                                                <OPTION value="02">02<BR>
                                                                <OPTION value="03">03<BR>
                                                                <OPTION value="04">04<BR>
                                                                <OPTION value="05">05<BR>
                                                                <OPTION value="06">06<BR>
                                                                <OPTION value="07">07<BR>
                                                                <OPTION value="08">08<BR>
                                                                <OPTION value="09">09<BR>
                                                                <OPTION value="10">10<BR>
                                                                <OPTION value="11">11<BR>
                                                                <OPTION value="12">12<BR>
                                                                <OPTION value="13">13<BR>
                                                                <OPTION value="14">14<BR>
                                                                <OPTION value="15">15<BR>
                                                                <OPTION value="16">16<BR>
                                                                <OPTION value="17">17<BR>
                                                                <OPTION value="18">18<BR>
                                                                <OPTION value="19">19<BR>
                                                                <OPTION value="20">20<BR>
                                                                <OPTION value="21">21<BR>
                                                                <OPTION value="22">22<BR>
                                                                <OPTION value="23">23<BR>
                                                                <OPTION value="24">24<BR>
                                                                <OPTION value="25">25<BR>
                                                                <OPTION value="26">26<BR>
                                                                <OPTION value="27">27<BR>
                                                                <OPTION value="28">28<BR>
                                                                <OPTION value="29">29<BR>
                                                                <OPTION value="30">30<BR>
                                                                <OPTION value="31">31<BR>
                                                            </select>
                                                            <select id="bulan" name="tgl_nilai" class="form-select tgl_nilai" aria-label="Default select example">
                                                                <option value="">Bulan</option>
                                                                <OPTION value="01">Januari<BR>
                                                                <OPTION value="02">Pebruari<BR>
                                                                <OPTION value="03">Maret<BR>
                                                                <OPTION value="04">April<BR>
                                                                <OPTION value="05">Mei<BR>
                                                                <OPTION value="06">Juni<BR>
                                                                <OPTION value="07">Juli<BR>
                                                                <OPTION value="08">Agustus<BR>
                                                                <OPTION value="09">September<BR>
                                                                <OPTION value="10">Oktober<BR>
                                                                <OPTION value="11">Nopember<BR>
                                                                <OPTION value="12">Desember<BR>
                                                            </select>
                                                            <select id="year" name="tgl_nilai" class="form-select tgl_nilai" aria-label="Default select example">
                                                                <option value="">Tahun</option>
                                                            </select> S/D
                                                            <select id="hari2" name="tgl_nilai2" class="form-select tgl_nilai2" aria-label="Default select example">
                                                                <option value="">Tgl</option>
                                                                <OPTION value="01">01<BR>
                                                                <OPTION value="02">02<BR>
                                                                <OPTION value="03">03<BR>
                                                                <OPTION value="04">04<BR>
                                                                <OPTION value="05">05<BR>
                                                                <OPTION value="06">06<BR>
                                                                <OPTION value="07">07<BR>
                                                                <OPTION value="08">08<BR>
                                                                <OPTION value="09">09<BR>
                                                                <OPTION value="10">10<BR>
                                                                <OPTION value="11">11<BR>
                                                                <OPTION value="12">12<BR>
                                                                <OPTION value="13">13<BR>
                                                                <OPTION value="14">14<BR>
                                                                <OPTION value="15">15<BR>
                                                                <OPTION value="16">16<BR>
                                                                <OPTION value="17">17<BR>
                                                                <OPTION value="18">18<BR>
                                                                <OPTION value="19">19<BR>
                                                                <OPTION value="20">20<BR>
                                                                <OPTION value="21">21<BR>
                                                                <OPTION value="22">22<BR>
                                                                <OPTION value="23">23<BR>
                                                                <OPTION value="24">24<BR>
                                                                <OPTION value="25">25<BR>
                                                                <OPTION value="26">26<BR>
                                                                <OPTION value="27">27<BR>
                                                                <OPTION value="28">28<BR>
                                                                <OPTION value="29">29<BR>
                                                                <OPTION value="30">30<BR>
                                                                <OPTION value="31">31<BR>
                                                            </select>
                                                            <select id="bulan2" name="tgl_nilai2" class="form-select tgl_nilai2" aria-label="Default select example">
                                                                <option value="">Bulan</option>
                                                                <OPTION value="01">Januari<BR>
                                                                <OPTION value="02">Pebruari<BR>
                                                                <OPTION value="03">Maret<BR>
                                                                <OPTION value="04">April<BR>
                                                                <OPTION value="05">Mei<BR>
                                                                <OPTION value="06">Juni<BR>
                                                                <OPTION value="07">Juli<BR>
                                                                <OPTION value="08">Agustus<BR>
                                                                <OPTION value="09">September<BR>
                                                                <OPTION value="10">Oktober<BR>
                                                                <OPTION value="11">Nopember<BR>
                                                                <OPTION value="12">Desember<BR>
                                                            </select>
                                                            <select id="year2" name="tgl_nilai2" class="form-select tgl_nilai2" aria-label="Default select example">
                                                                <option value="">Tahun</option>
                                                            </select>
                                                        </div>
                                                        <label>Angka Kredit Unsur Utama</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="kredit_utama" id="kredit_utama" class="form-control kredit_utama" placeholder="Angka Kredit Unsur Utama">
                                                        </div>
                                                        <label>Angka Kredit Unsur Penunjang</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="kredit_penunjang" id="kredit_penunjang" class="form-control" placeholder="Angka Kredit Unsur Penunjang">
                                                        </div>
                                                        <label>Jenjang Jabatan / Golongan</label>
                                                        <div class="input-group mb-3">
                                                            <select name="gol" id="gol" class="form-control input-lg gol">
                                                                <option value="">Pilih Jabatan</option>
                                                                <?php
                                                                foreach ($pp as $row2) {
                                                                    echo '<option value="' . $row2["kode"] . '">' . $row2["nama"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label>TMT Jenjang JAB / Tgl SPK PAK</label>
                                                        <div class="input-group mb-3">
                                                            <select id="hari3" name="tgl_spk" class="form-select tgl_spk" aria-label="Default select example">
                                                                <option value="">Tgl</option>
                                                                <OPTION value="01">01<BR>
                                                                <OPTION value="02">02<BR>
                                                                <OPTION value="03">03<BR>
                                                                <OPTION value="04">04<BR>
                                                                <OPTION value="05">05<BR>
                                                                <OPTION value="06">06<BR>
                                                                <OPTION value="07">07<BR>
                                                                <OPTION value="08">08<BR>
                                                                <OPTION value="09">09<BR>
                                                                <OPTION value="10">10<BR>
                                                                <OPTION value="11">11<BR>
                                                                <OPTION value="12">12<BR>
                                                                <OPTION value="13">13<BR>
                                                                <OPTION value="14">14<BR>
                                                                <OPTION value="15">15<BR>
                                                                <OPTION value="16">16<BR>
                                                                <OPTION value="17">17<BR>
                                                                <OPTION value="18">18<BR>
                                                                <OPTION value="19">19<BR>
                                                                <OPTION value="20">20<BR>
                                                                <OPTION value="21">21<BR>
                                                                <OPTION value="22">22<BR>
                                                                <OPTION value="23">23<BR>
                                                                <OPTION value="24">24<BR>
                                                                <OPTION value="25">25<BR>
                                                                <OPTION value="26">26<BR>
                                                                <OPTION value="27">27<BR>
                                                                <OPTION value="28">28<BR>
                                                                <OPTION value="29">29<BR>
                                                                <OPTION value="30">30<BR>
                                                                <OPTION value="31">31<BR>
                                                            </select>
                                                            <select id="bulan3" name="tgl_spk" class="form-select tgl_spk" aria-label="Default select example">
                                                                <option value="">Bulan</option>
                                                                <OPTION value="01">Januari<BR>
                                                                <OPTION value="02">Pebruari<BR>
                                                                <OPTION value="03">Maret<BR>
                                                                <OPTION value="04">April<BR>
                                                                <OPTION value="05">Mei<BR>
                                                                <OPTION value="06">Juni<BR>
                                                                <OPTION value="07">Juli<BR>
                                                                <OPTION value="08">Agustus<BR>
                                                                <OPTION value="09">September<BR>
                                                                <OPTION value="10">Oktober<BR>
                                                                <OPTION value="11">Nopember<BR>
                                                                <OPTION value="12">Desember<BR>
                                                            </select>
                                                            <select id="year3" name="tgl_spk" class="form-select tgl_spk" aria-label="Default select example">
                                                                <option value="">Tahun</option>
                                                            </select>
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
                var kredit_utama = $('#kredit_utama').val();
                var kredit_penunjang = $('#kredit_penunjang').val();
                var gol = $('#gol').val();
                var tgl_nilai = $('#year').val() + $('#bulan').val() + $('#hari').val();
                var tgl_nilai2 = $('#year2').val() + $('#bulan2').val() + $('#hari2').val();
                var tgl_spk = $('#year3').val() + $('#bulan3').val() + $('#hari3').val();
                var no_sk = $('#no_sk').val();
                var pejabat = $('#pejabat').val();
                var satminkal = $('#satminkal').val();
                var tgl_update = $('#tgl_update').val();

                $.ajax({
                    url: '<?= base_url() ?>/Penyuluh/PakPNS/save/',
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
                        $('#hari').val(parseInt(result.tgl_nilai.substr(6, 2)));
                        $('#bulan').val(parseInt(result.tgl_nilai.substr(4, 2)));
                        $('#year').val(result.tgl_nilai.substr(0, 4)).change();
                        $('#hari2').val(parseInt(result.tgl_nilai2.substr(-2, 8)));
                        $('#bulan2').val(parseInt(result.tgl_nilai2.substr(-4, -2)));
                        $('#year2').val(result.tgl_nilai2.substr(0, 4)).change();
                        $('#hari3').val(parseInt(result.tgl_spk.substr(-2, 8)));
                        $('#bulan3').val(parseInt(result.tgl_spk.substr(-4, -2)));
                        $('#year3').val(result.tgl_spk.substr(0, 4)).change();
                        $('#no_sk').val(result.no_sk);
                        $('#pejabat').val(result.pejabat);
                        $('#satminkal').val(result.satminkal);
                        $('#tgl_update').val(result.tgl_update);

                        $('#modal-form').modal('show');

                        $("#btnSave").attr("id", "btnDoEdit");

                        $(document).delegate('#btnDoEdit', 'click', function() {

                            var nip = $('#nip').val();
                            var kredit_utama = $('#kredit_utama').val();
                            var kredit_penunjang = $('#kredit_penunjang').val();
                            var gol = $('#gol').val();
                            var tgl_nilai = $('#year').val()('#bulan').val()('#hari').val();
                            var tgl_nilai2 = $('#year2').val()('#bulan2').val()('#hari2').val();
                            var tgl_spk = $('#year3').val()('#bulan3').val()('#hari3').val();
                            var no_sk = $('#no_sk').val();
                            var pejabat = $('#pejabat').val();
                            var satminkal = $('#satminkal').val();
                            var tgl_update = $('#tgl_update').val();

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
    <?= $this->endSection() ?>