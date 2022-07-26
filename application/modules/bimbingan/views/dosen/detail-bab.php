<div class="container-fluid">
  <div class="row">

    <div class="col-md">
      <div class="card card-radius">

        <div class="card-body">
          <h4 class="card-title">Tabel Data Bab</h4>
          </h6>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>File</th>
                  <th>Status saat ini</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($mhsBab as $m) : ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $m['username'] ?></td>
                    <td><?= $m['mhs_name'] ?></td>
                    <td><span class="badge badge-pill badge-primary pr-5 pl-5 pt-2 pb-2"> <?= $m['bab_name'] ?></span></td>
                    <td>
                      <?php if ($m['status_confirm'] == 0) : ?>
                        <span class="badge badge-pill badge-danger font-weight-bold pr-3 pl-3 pt-2 pb-2" style=" background-color: #7C87B3;">Terkirim </span>
                      <?php elseif ($m['status_confirm'] == 1) : ?>
                        <span class=" badge badge-pill badge-danger font-weight-bold pr-3 pl-3 pt-2 pb-2"> Revisi </span>
                      <?php else : ?>
                        <span class=" badge badge-pill badge-warning font-weight-bold pr-3 pl-3 pt-2 pb-2"> Diterima </span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('bimbingan/bab_detail/' . $m['id_bab_dosen'] . '/' . $m['id_bimbingan']) ?>" class="badge badge-pill badge-success pr-3 pl-3 pt-2 pb-2"> Detail </a>
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