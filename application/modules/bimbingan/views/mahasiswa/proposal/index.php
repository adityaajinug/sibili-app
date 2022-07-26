<div class="container-fluid">

  <div class="row">
    <?php if ($mhs['status_semester'] == 1) : ?>
      <div class="col-md-6">
        <div class="card card-data shadow-sm">
          <div class="card-body body-data">
            <div class="data-desc">
              <h5>Proposal<br><span class="badge mt-2" style="color:#FECC00;padding:0;font-weight:600;font-size:24px">KKI I</span></br></h5>
              <div class="btn-data">
                <a href="<?= base_url('bimbingan/proposal/pertama') ?>" class="btn btn-blue">Detail</a>
              </div>
            </div>
            <div class="icon-data">
              <i class="fas fa-file"></i>
            </div>
          </div>
        </div>
      </div>
    <?php elseif ($mhs['status_semester'] == 2) : ?>
      <div class="col-md-6">
        <div class="card card-data shadow-sm">
          <div class="card-body body-data">
            <div class="data-desc">
              <h5>Proposal<br><span class="badge mt-2" style="color:#FECC00;padding:0;font-weight:600;font-size:24px">KKI II</span></br></h5>
              <div class="btn-data">
                <a href="<?= base_url('bimbingan/proposal/kedua') ?>" class="btn btn-blue">Detail</a>
              </div>
            </div>
            <div class="icon-data">
              <i class="fas fa-copy"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>