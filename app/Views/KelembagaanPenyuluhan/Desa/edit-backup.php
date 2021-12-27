<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h4 class="font-weight-bolder text-warning text-gradient">Ubah Data</h4>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" action="<?= base_url('KelembagaanPenyuluhan/Desa/desa/edit'); ?>" method="post" enctype="multipart/form-data">
                            <? csrf_field(); ?>
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="idpos" id="idpos" value="<?= $value['idpos']; ?>">
                                    <label for="deskripsi">Kecamatan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Kecamatan" value="<?= $value['deskripsi']; ?>" disabled>
                                    </div>
                                    <label for="nm_desa">Desa</label>
                                    <div class="input-group mb-3">
                                        <select name="kode_desa" id="kode_desa" class="form-control input-lg">
                                            <option value="<?= $value['kode_desa']; ?>"><?= $value['nm_desa']; ?></option>
                                            <?php
                                            foreach ($desa as $row2) {
                                                echo '<option value="' . $row2["id_desa"] . '">' . $row2["nm_desa"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label for="nama">Nama Posluhdes</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="nama posluhdes" id="nama" name="nama" value="<?= $value['nama']; ?>">
                                    </div>
                                    <label for="alamat">Alamat</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="alamat" id="alamat" name="alamat" value="<?= $value['alamat']; ?>">
                                    </div>
                                    <label for="ketua">Ketua</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="ketua" id="ketua" name="ketua" value="<?= $value['ketua']; ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="sekretaris">Sekretaris</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="sekretaris" id="sekretaris" name="sekretaris" value="<?= $value['sekretaris']; ?>">
                                    </div>
                                    <label for="bendahara">Bendahara</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="bendahara" id="bendahara" name="bendahara" value="<?= $value['bendahara']; ?>">
                                    </div>
                                    <label for="tahun_beridiri">Tahun Berdiri</label>
                                    <div class="input-group mb-3">
                                        <select name="tahun_berdiri" id="selectElementId2" class="form-control input-lg">
                                            <option value="<?= $value['tahun_berdiri']; ?>"><?= $value['tahun_berdiri']; ?></option>
                                        </select>
                                    </div>
                                    <label for="jum_anggota">Jumlah Anggota</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="jumlah anggota" id="jum_anggota" name="jum_anggota" value="<?= $value['jum_anggota']; ?>">
                                    </div>
                                    <label for="penyuluh_swadaya">Penyuluh Swadaya </label>
                                    <div class="input-group mb-3">
                                        <select name="penyuluh_swadaya" id="penyuluh_swadaya" class="form-control input-lg">
                                            <option value="<?= $value['penyuluh_swadaya']; ?>"><?= $value['penyuluh_swadaya']; ?></option>
                                            <?php
                                            foreach ($pen_swa as $row3) {
                                                echo '<option value="' . $row3["id_swa"] . '">' . $row3["nama"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="kode_kab" id="kode_kab" value="<?= $value['id_dati2']; ?>">
                                    <input type="hidden" name="kode_kec" id="kode_kec" value="<?= $value['kode_kec']; ?>">
                                    <!-- <input type="hidden" name="kode_kec" value=""> -->
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-round bg-gradient-warning btn-lg w-100 mt-4 mb-0">Ubah Data</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>