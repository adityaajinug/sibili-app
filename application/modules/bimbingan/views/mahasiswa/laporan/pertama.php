<style>
  .status {
    /* border: 1px solid red; */
    display: flex;
    justify-content: space-between;
  }

  .status .revisi {
    width: auto;
    height: 25px;
    border-radius: 7px;
    font-size: 14px;
    background-color: #E72626;
    padding-right: 10px;
    padding-left: 10px;
    padding-top: 2px;
    color: #fff;
    font-weight: 500;

  }

  .status .terkirim {
    width: auto;
    height: 25px;
    border-radius: 7px;
    font-size: 14px;
    background-color: #7C87B3;
    padding-right: 10px;
    padding-left: 10px;
    padding-top: 2px;
    color: #fff;
    font-weight: 500;

  }

  .status .diterima {
    width: auto;
    height: 25px;
    border-radius: 7px;
    font-size: 14px;
    background-color: #fecc00;
    padding-right: 10px;
    padding-left: 10px;
    padding-top: 2px;
    color: #000;
    font-weight: 500;

  }
</style>


<div class="container-fluid">
  <?= $this->session->flashdata('pesan'); ?>


  <a href="#" data-toggle="modal" data-target="#tambah-file" class="btn btn-primary mb-2 shadow mb-3" style="border-radius: 10px;">Upload File</a>
  <div class="row">
    <?php
    foreach ($bimbingan as $b) : ?>
      <?php if ($b['category_bimbingan'] == 2) :
        if ($b['keterangan'] == 'Ganjil') :
      ?>

          <div class="col-md-4">
            <div class="card card-radius">
              <div class="card-body">
                <div class="status">
                  <h3 class="card-title-text"><?= $b['bab_name'] ?></h3>
                  <?php if ($b['status_confirm'] == 0) : ?>
                    <span class="terkirim">
                      <p>Terkirim</p>
                    </span>
                  <?php elseif ($b['status_confirm'] == 1) : ?>
                    <span class="revisi">
                      <p>Revisi</p>
                    </span>
                  <?php else : ?>
                    <span class="diterima">
                      <p>Diterima</p>
                    </span>
                  <?php endif; ?>
                </div>

                <p class="card-text-space"><?= $b['description'] ?></p>
                <a href="<?= base_url('bimbingan/bab/' . $b['id_bimbingan']) ?>" class="btn btn-primary" style="border-radius: 10px;">Detail</a>
                <a href="javascript:void(0)" class="btn btn-success" style="border-radius: 10px;">Edit</a>
              </div>
            </div>
          </div>

      <?php endif;
      endif; ?>
    <?php endforeach; ?>


  </div>
</div>
<div id="tambah-file" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <p style="font-size: 24px;color:black;font-weight:500">Upload File</p>
        </div>

        <form action="<?= base_url('bimbingan/uploadBimbingan') ?>" method="POST" class="pl-3 pr-3" enctype="multipart/form-data">

          <div class="form-group">
            <label for="bab">Jenis File</label> <br>


            <select class="js-choose form-control" name="bab_dosen_id" style="width:100%;font-size:18px">

              <?php
              $lastBabIndex = count($bimbingan) - 1;
              $isAcceptedLastBab = $bimbingan[$lastBabIndex]['status_confirm'];

              if ($lastBabIndex < 0) {

              ?>

                <?php if ($babDosen) : ?>
                  <option value="<?= $babDosen[0]['id_bab_dosen'] ?>"><?= $babDosen[0]['bab_name'] ?></option>
                <?php else : ?>
                  <option value="">Dosen Belum Unggah Bab</option>
                <?php endif; ?>
                <?php

              } else {
                foreach ($babDosen as $i => $v) :
                  if ($v['category_bab'] == 2 && $v['keterangan'] == 'Ganjil') :


                    if ($i <= $lastBabIndex) :
                ?>
                      <option value="<?= $v['id_bab_dosen'] ?>"><?= $v['bab_name'] ?> - <?= $v['id_bab_dosen'] ?></option>
                    <?php elseif ($i == $lastBabIndex + 1 && $isAcceptedLastBab == 2) : ?>
                      <option value="<?= $v['id_bab_dosen'] ?>"><?= $v['bab_name'] ?> - <?= $v['id_bab_dosen'] ?></option>
                    <?php else : ?>
                      <option value="<?= $v['id_bab_dosen'] ?>" disabled><?= $v['bab_name'] ?>- Locked <?= $v['id_bab_dosen'] ?></option>
              <?php endif;
                  endif;
                endforeach;
              }
              ?>
            </select>
          </div>
          <!-- <i class="fas fa-solid fa-lock"></i> -->
          <input type="hidden" name="mhs_id" value="<?= $mhs['id_mhs'] ?>">
          <input type="hidden" name="semester" value="<?= $mhs['keterangan'] ?>">
          <input type="hidden" name="category_bimbingan" value="2">



          <div class="form-group">
            <label for="filedfd">File</label>
            <input class="form-control" type="file" id="filedfd" name="file">
            <small class="text-danger">Ekstensi : PDF, max 5MB</small>

          </div>

          <div class="form-group text-center">
            <button class="btn btn-rounded btn-primary" type="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>