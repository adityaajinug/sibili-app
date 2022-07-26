<div class="container-fluid">
  <div class="col-12">
    <a href="#" data-toggle="modal" data-target="#tambah-data" class="btn btn-primary mb-2 shadow mb-3" style="border-radius:10px;">Tambah </a>

    <div class="card shadow-lg" style="border-radius:10px;">

      <div class="card-body">

        <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered no-wrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Keterangan</th>
                <th>Status Aktif</th>
                <th>Aksi</th>

              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($semester as $s) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $s['tahun'] ?></td>
                  <td><?= $s['keterangan'] ?></td>
                  <td width="10%" align="center">
                    <div class="form-group">
                      <div class="custom-control custom-switch custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input semester_check" name="semester_check" id="check_semester<?= $s['id_semester'] ?>" <?= ($s['is_done'] == 1) ? 'checked' : ''; ?> data-id=<?= $s['id_semester']; ?> data-semester=<?= $s['is_done']; ?>>
                        <label class="custom-control-label" for="check_semester<?= $s['id_semester'] ?>"></label>
                      </div>
                    </div>

                  <td>

                    <a href=" #" class="badge badge-pill badge-warning py-2 px-3"> Edit</a>
                    <a href="#" class="badge badge-pill badge-danger py-2 px-3"> Hapus</a>
                  </td>
                </tr>

              <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <p style="font-size: 24px;color:black;font-weight:500">Tambah Tahun Ajaran</p>
        </div>

        <form action="#" method="POST" class="pl-3 pr-3">
          <div class="form-group">
            <label for="th">Tahun</label>
            <input type="text" class="form-control" id="th" name="year">
          </div>
          <div class="form-group">
            <label for="th">Keterangan</label>
            <select name="keterangan" id="" class="form-control">
              <option value="Ganjil">Ganjil</option>
              <option value="Genap">Genap</option>
            </select>
          </div>
          <input type="hidden" name="is_done" value="0">

          <div class="form-group text-center">
            <button class="btn btn-rounded btn-primary" type="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>

</div>
<script>
  $('.semester_check').on('click', function() {
    const id = $(this).data('id');

    const check_semester = $(this).data('semester');

    $.ajax({
      url: "<?= base_url('admin/checkSemester') ?>",
      type: "post",
      data: {
        id: id,
        check_semester: check_semester
      },
      success: function() {
        location.reload()

      }

    })


  })
</script>