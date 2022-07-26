<div class="container-fluid">
  <div class="col-12">
    <a href="<?= base_url('admin/tambahMahasiswa') ?>" class="btn btn-primary mb-2 shadow mb-3" style="border-radius:10px;">Tambah </a>

    <div class="card shadow-lg" style="border-radius:10px;">

      <div class="card-body">

        <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered no-wrap">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Email</th>

                <th>Aksi</th>

              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($dataMhs as $m) :

              ?>
                <tr>

                  <td><?= $no++; ?></td>

                  <td><?= $m['username'] ?></td>
                  <td><?= $m['mhs_name'] ?></td>

                  <td><?= $m['email'] ?></td>

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