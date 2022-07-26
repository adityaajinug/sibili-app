<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <a href="#" data-toggle="modal" data-target="#tambah-bimbingan" class="btn btn-rounded btn-primary mb-2 shadow mb-3">Tambah </a>

      <?php
      if (empty($mhs_ujian)) : ?>
        <h4>Belum ada data Jadwal Ujian</h4>
      <?php else : ?>
        <?php
        foreach ($mhs_ujian as $t) : ?>
          <div class="card shadow-lg" style="border-radius:10px;">
            <div class="card-body">
              <h4 class="card-title"><?= tgl_indo($t['date']) ?></h4>
              <p><?= waktu_indo($t['date']) ?> - Selesai</p>

              <div class="table-responsive">
                <table id="#" class="table table-striped table-bordered no-wrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIM</th>
                      <th>Mahasiswa</th>
                      <th>Dosen Pembimbing</th>
                      <th>Ketua Penguji</th>
                      <th>Anggota Penguji</th>
                      <th>Room</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($t['data'] as $d) : ?>
                      <tr>
                        <td><?= $no++; ?></td>

                        <td><?= $d['username'] ?></td>
                        <td><?= $d['mhs_name'] ?></td>
                        <td><?= $d['dosen_name'] ?></td>
                        <td><?= $d['exam_leader'] ?></td>
                        <td><?= $d['exam_member'] ?></td>
                        <td><?= $d['room'] ?></td>



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
        <?php endforeach; ?>


      <?php endif; ?>
    </div>
  </div>
</div>

<div id="tambah-bimbingan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <p style="font-size: 24px;color:black;font-weight:500">Tambah Jadwal</p>
        </div>

        <form action="<?= base_url('koordinator/tambahMahasiswaUjian') ?>" method="POST" class="pl-3 pr-3">

          <div class="form-group">
            <label for="">Tanggal dan Waktu</label>
            <input type="datetime-local" class="form-control" name="date">
          </div>
          <div class="form-group">
            <label for="dosen">Dosen Pembimbing</label>
            <select class="js-example-basic-single form-control" name="id_dosen" id="pembimbing" style="width:100%;font-size:18px">

            </select>
          </div>
          <div class="form-group">
            <label for="mhs">Mahasiswa</label>
            <select class="js-example-basic-multiple js-stetes form-control" name="id_mhs_bimbingan[]" id="mhs" multiple="multiple" style="width:100%;font-size:18px">

            </select>
          </div>

          <div class="form-group">
            <label for="dosen">Ketua Penguji</label>
            <select class="js-example-basic-single form-control" name="exam_leader" style="width:100%;font-size:18px">

              <?php foreach ($dataDosen as $d) : ?>
                <option value="<?= $d['dosen_name'] ?>"><?= $d['dosen_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="dosen">Anggota Penguji</label>
            <select class="js-example-basic-single form-control" name="exam_member" style="width:100%;font-size:18px">

              <?php foreach ($dataDosen as $d) : ?>
                <option value="<?= $d['dosen_name'] ?>"><?= $d['dosen_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">Room</label>
            <input type="text" class="form-control" name="room" placeholder="Contoh : H.3.8">
          </div>

          <div class="form-group text-center">
            <button class="btn btn-rounded btn-primary" type="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script>
  const dataPlot = () => {
    return fetch('<?= base_url('koordinator/dataPlot') ?>')
      .then(r => {
        if (r.ok) {
          return r.json();
        } else {
          console.log('ga keambil')
        }

      })
      .then(d => d)
      .catch(e => console.log(e))
  }
  document.addEventListener('DOMContentLoaded', async () => {
    const pembimbing = document.getElementById('pembimbing');
    const mhs = document.getElementById('mhs');
    // const test = document.getElementById('test');


    let listPlot = []
    listPlot = await dataPlot()

    pembimbing.innerHTML = listPlot.map(d => `<option value="${d.id_dosen}">${d.dosen_name}</option>`).join('')
    const listOption = pembimbing.querySelectorAll('option')
    pembimbing.onchange = () => {
      mhs.innerHTML = listPlot[pembimbing.selectedIndex].data.map(d => {
        return `<option value="${d.id_mhs_bimbingan}">${d.mhs_name}</option>`
      }).join('')
    }
  })
</script>