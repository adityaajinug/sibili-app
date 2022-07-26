<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="card card-total-file shadow-sm">
        <div class="card-body body-total-file d-flex align-items-center">
          <div class="text-total-file">
            <span class="sum"><?php foreach ($countMhs as $m) :
                                echo $m['jmlMhs'];
                              endforeach; ?></span>
            <p class="desc">Mahasiswa</p>
          </div>
          <div class="icon-total-file">
            <i class="fas fa-user-graduate"></i>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-total-file shadow-sm">
        <div class="card-body body-total-file d-flex align-items-center">
          <div class="text-total-file">
            <span class="sum"><?php foreach ($countDosen as $l) :
                                echo $l['jmlDosen'];
                              endforeach; ?></span>
            <p class="desc">Dosen</p>
          </div>
          <div class="icon-total-file">
            <i class="fas fa-user-tie"></i>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-total-file shadow-sm">
        <div class="card-body body-total-file d-flex align-items-center">
          <div class="text-total-file">
            <span class="sum"><?php foreach ($countSemester as $s) :
                                echo $s['jmlSemester'];
                              endforeach; ?></span>
            <p class="desc">Semester</p>
          </div>
          <div class="icon-total-file">
            <i class="fas fa-graduation-cap"></i>
          </div>

        </div>
      </div>
    </div>



  </div>
</div>