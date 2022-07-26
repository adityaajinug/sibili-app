<div class="container-fluid">
  <div class="col-12">
    <a href="#" class="btn btn-primary mb-2 shadow mb-3" style="border-radius:10px;">Tambah </a>

    <div class="card shadow-lg" style="border-radius:10px;">

      <div class="card-body">

        <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered no-wrap">
            <thead>
              <tr>
                <th>No</th>
                <th>NPP</th>
                <th>Nama Dosen</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>

              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($dataDosen as $d) :

              ?>
                <tr>

                  <td><?= $no++; ?></td>

                  <td><?= $d['username'] ?></td>
                  <td><?= $d['dosen_name'] ?></td>

                  <td><?= $d['email'] ?></td>
                  <td>
                    <?php
                    if ($d['role_id'] == 3) :

                    ?>
                      <span class="badge badge-pill badge-secondary py-2 px-3"><?= $d['role_name'] ?></span>

                    <?php elseif ($d['role_id'] == 4) : ?>
                      <span class="badge badge-pill badge-secondary py-2 px-3"><?= $d['role_name'] ?></span>
                    <?php elseif ($d['role_id'] == 5) : ?>
                      <span class="badge badge-pill badge-secondary py-2 px-3"><?= $d['role_name'] ?></span>
                    <?php elseif ($d['role_id'] == 6) : ?>
                      <span class="badge badge-pill badge-secondary py-2 px-3"><?= $d['role_name'] ?></span>

                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="http://" class="badge badge-pill badge-success py-2 px-3"> Edit</a>
                    <a href="http://" class="badge badge-pill badge-danger py-2 px-3"> Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>


          </table>
        </div>
      </div>
    </div>
  </div>

</div>