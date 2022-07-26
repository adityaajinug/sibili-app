<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <a href="#" data-toggle="modal" data-target="#tambah-bimbingan" class="btn btn-rounded btn-primary mb-2 shadow mb-3">Tambah </a>


      <div class="card shadow-lg" style="border-radius:10px;">
        <div class="card-body">
          <h4 class="card-title">Tabel Industri</h4>


          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Industri</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($industry as $d) : ?>
                  <tr>
                    <td><?= $no++; ?></td>

                    <td><?= $d['industry_name'] ?></td>
                    <td><?= $d['address'] ?></td>




                    <td>
                      <a href="#" class="badge badge-pill badge-success py-2 px-3"> Detail</a>
                    </td>

                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>