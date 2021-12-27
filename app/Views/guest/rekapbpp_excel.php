<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<center>
    <h4> Donwload Rekap Profil BPP </h4>
</center>
<br><br>
<div class="card">
    <form action="<?= base_url('/profil/Guest/rekapbppexcel/') ?>">
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
            <div class="row">
                <div class="col-md-6" align="center">
                    <button type="button" id="btnDownload" class="btn bg-gradient-info">Download</button>
                </div>
            </div>
        </div>
    </form>
</div>
</tbody>
</table>
</div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>

<script>
    $(document).ready(function() {
        $(document).delegate('#btnDownload', 'click', function() {
            var kode_prop = $('#pilprov').val();
            location.href = "<?= base_url() ?>/profil/Guest/rekapbppexcel/" + kode_prop;

        });
    });
</script>
<?= $this->endSection() ?>