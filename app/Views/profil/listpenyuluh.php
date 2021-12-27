<?= $this->extend('layout/main_template') ?>

<?= $this->section('content') ?>


<div class="container-fluid py-4">
  <div class="p-4 bg-light">
    <div class="col-md-6">
      <form action="">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Jenis Penyuluh</label>
          <select class="form-control" id="exampleFormControlSelect1" onchange="location = this.value;">
            <option>Pilih</option>
            <option value="/penyuluhpns">PNS</option>
            <option value="/penyuluhcpns">CPNS</option>
            <option value="/penyuluhthlapbn">THL APBN</option>
            <option value="/penyuluhthlapbd">THL APBD</option>
            <option value="/penyuluhswadaya">Swadaya</option>
            <option value="/penyuluhswasta">Swasta</option>
            <option value="/penyuluhpppk">P3K</option>
          </select>
        </div>

      </form>

    </div>

  </div>


  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Poktan</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><a href="<?= base_url('penyuluh') ?>">Nandhar Mundhy</a></td>
          <td>10</td>
          <td>@mdo</td>
        </tr>

        <tr>
          <th scope="row">1</th>
          <td><a href="<?= base_url('penyuluh') ?>">Nandhar Mundhy</a></td>
          <td>10</td>
          <td>@mdo</td>
        </tr>

      </tbody>
    </table>

    <?php echo view('layout/footer'); ?>

  </div>
</div>

<?= $this->endSection() ?>