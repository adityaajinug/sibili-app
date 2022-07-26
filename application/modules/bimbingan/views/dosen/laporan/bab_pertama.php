<div class="container-fluid">
  <?= $this->session->flashdata('pesan'); ?>
  <a href="#" data-toggle="modal" data-target="#tambah-file" class="btn btn-primary mb-2 shadow mb-3" style="border-radius: 10px;">Upload Bab</a>
  <div class="row">
    <?php foreach ($babDosen as $b) :
      if ($b['category_bab'] == 2 && $b['keterangan'] == 'Ganjil') :
    ?>

        <div class="col-md-4">
          <div class="card card-radius">
            <div class="card-body">
              <h3 class="card-title-text"><?= $b['bab_name'] ?></h3>
              <p class="card-text-space"><?= $b['description'] ?></p>
              <a href="<?= base_url('bimbingan/bab/' . $b['id_bab_dosen']) ?>" class="btn btn-primary" style="border-radius: 10px;">Detail</a>
            </div>
          </div>
        </div>
    <?php endif;
    endforeach; ?>

  </div>
</div>
<div id="tambah-file" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <p style="font-size: 24px;color:black;font-weight:500">Upload Bab</p>
        </div>

        <form action="<?= base_url('bimbingan/unggahBabDosen') ?>" method="POST" class="pl-3 pr-3">

          <div class="form-group">
            <label for="bab">Jenis File</label>

            <select class="js-choose form-control" name="bab_id" style="width:100%;font-size:18px">
              <?php
              foreach ($bab as $b) :
                if ($b['category_bab'] == 2) :
              ?>
                  <option value="<?= $b['id_bab'] ?>"><?= $b['bab_name'] ?></option>
              <?php endif;
              endforeach; ?>

            </select>
          </div>
          <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">sdsdsds</textarea>
          <input type="hidden" name="dosen_id" id="" value="<?= $dosen['id_dosen'] ?>">
          <input type="hidden" name="mhs_bimbingan_id" id="" value="<?= $dosen['id_mhs_bimbingan'] ?>">
          <input type="hidden" name="semester" id="" value="<?= $dosen['keterangan'] ?>">


          <div class="form-group text-center">
            <button class="btn btn-rounded btn-primary" type="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>
<script>

</script>