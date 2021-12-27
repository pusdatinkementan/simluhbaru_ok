<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Rekap Potensi Wilayah </h4>
</center>
<br><br>
<div class="card">
    <form>
        <div class="row">
            <div class="col-md-2">
                <label for="kode_desa">Provinsi</label>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-4">
                    <select name="pilprov" id="pilprov" class="form-control input-sm pilprop">
                        <option value="">Pilih Provinsi</option>
                        <?php
                        foreach ($prov as $row) {
                            echo '<option value="' . $row["id_prop"] .  '">' . $row["nama_prop"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="kode_desa">Kabupaten/Kota</label>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-4">
                    <select name="pilkab" id="pilkab" class="form-control input-sm pilkabkot">
                        <option value="">Pilih Kabupaten</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="kode_desa">BP3K</label>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-4">
                    <select name="pilbp3k" id="pilbp3k" class="form-control input-sm pilbpp">
                        <option value="">Pilih BP3k</option>


                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" align="center">

                <button type="button" id="tampil" class="btn bg-gradient-success tampil">Tampilkan</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead id="judulTabel">
                </thead>
            </table>
        </div>
    </form>
</div>
</div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    $('.pilprop').on('change', function() {

        const id = $('.pilprop').val();
        var prop = id.substring(0, 4);

        $.ajax({
            url: "<?= base_url() ?>/profil/Guest/showKab/" + prop + "",
            success: function(response) {
                var htmla = '<option value="">Pilih Kabupaten</option>';
                if (response == '') {
                    $("select#pilkab").html('<option value="">--Pilih Kabupaten--</option>');
                } else {
                    $("select#pilkab").html(htmla += response);
                }
            },
            dataType: "html"
        });
        return false;
    });
    $('.pilkabkot').on('change', function() {

        const id = $('.pilkabkot').val();
        var kab = id.substring(0, 4);

        $.ajax({
            url: "<?= base_url() ?>/profil/Guest/showBpp/" + kab + "",
            success: function(response) {
                var htmla = '<option value="">Pilih BP3K</option>';
                if (response == '') {
                    $("select#pilbp3k").html('<option value="">--Pilih BP3k--</option>');
                } else {
                    $("select#pilbp3k").html(htmla += response);
                }
            },
            dataType: "html"
        });
        return false;
    });
    $(document).ready(function() {
        $(document).delegate('#tampil', 'click', function() {
            var idbpp = $('#pilbp3k').val();
            $.ajax({
                url: '<?= base_url() ?>/profil/Guest/showPowil/' + idbpp,
                type: 'POST',
                success: function(response) {
                    var htmla = '<tr> <td width=10 align=center><font color=black face=verdana size=2><b>No</b></font></td> <td width=150 bgcolor=#A5C677 width="70"><font color=black face=verdana size=2><b>Komoditas</td><td width=50 bgcolor=#A5C677 width="85" align="center"><font color=black face=verdana size=2><b>Luas Lahan<br>(Ha)</td><td width=50 bgcolor=#A5C677 width="80" align="center"><font color=black face=verdana size=2><b>Luas Tanam/<br>Area/<br>Populasi<br>(Ha)/(Ekor)</td><td width=50 bgcolor=#A5C677 width="80" align="center"><font color=black face=verdana size=2><b>Luas Panen<br>(Ha)</td><td width=50 bgcolor=#A5C677 width="80" align="center"><font color=black face=verdana size=2><b>Produksi<br>(Ton)</td><td width=50 bgcolor=#A5C677 width="80" align="center"><font color=black face=verdana size=2><b>Produktivitas<br>(Ton/Ha)</td><td width=50 bgcolor=#A5C677 width="80" align="center"><font color=black face=verdana size=2><b>IP</td></tr>';
                    if (response == '') {
                        $("#judulTabel").html('');
                    } else {
                        $("#judulTabel").html(htmla += response);
                    }
                },
                dataType: "html"
            });
        });
    });
</script>
<script>

</script>
<?= $this->endSection() ?>