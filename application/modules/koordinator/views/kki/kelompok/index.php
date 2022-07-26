<div class="container-fluid">
  <?= $this->session->flashdata('pesan'); ?>
  <div class="row">
    <div class="col-12" id="loop">

      <div style="display: flex;justify-content:space-between">
        <div class="btn">
          <a href="#" data-toggle="modal" data-target="#tambah-bimbingan" class="btn btn-rounded btn-primary mb-2 shadow mb-3">Tambah </a>

        </div>
        <form action="<?= base_url('koordinator/kelompokBimbigan') ?>" method="GET" id="form-filter">
          <div style="display: flex;">
            <select class="form-control mb-2 shadow mb-3" style="border-radius: 10px;" id="keterangan">
              <option value="">--Pilih Semester--</option>
              <option value="">Ganjil</option>
              <option value="">Genap</option>

            </select>
            <select class="form-control mb-2 shadow mb-3 ml-2" style="border-radius: 10px;" id="tahun">
              <option value="">--Pilih Tahun--</option>
              <?php foreach ($semesterTahun as $k) : ?>
                <option value=""><?= $k['tahun'] ?></option>

              <?php endforeach; ?>

            </select>
            <button type="submit" class="btn btn-secondary btn-rounded mb-3 ml-2">Tampilkan</button>
          </div>

        </form>
      </div>

      <div class="contain" id="container-card">

        <?php
        if ($kelompok) :
          foreach ($kelompok as $k) :


        ?>

            <div class="card shadow-lg" style="border-radius:10px;" id="card-loop">
              <div class="card-body">
                <h4 class="card-title"><?= $k['dosen_name'] ?></h4>

                <div class="table-responsive">
                  <table id="" class="table table-striped table-bordered no-wrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tahun</th>
                        <th>Keterangan</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($k['data']) :

                      ?>
                        <?php
                        $no = 1;
                        foreach ($k['data'] as $mhs) :
                          if ($mhs['category_mhs_bimbingan'] == 1) :
                        ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $mhs['mhs_name'] ?></td>
                              <td><?= $mhs['tahun'] ?></td>
                              <td><?= $mhs['keterangan'] ?></td>
                            </tr>
                        <?php endif;
                        endforeach; ?>

                      <?php else : ?>
                        <td colspan="4" style="text-align: center;">Data tidak ada</td>
                      <?php endif; ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php
          endforeach; ?>
        <?php else : ?>
          <h6>Belum ada data Plot Bimbingan</h6>

        <?php
        endif; ?>
      </div>


    </div>
  </div>

</div>

<div id="tambah-bimbingan" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <p style="font-size: 24px;color:black;font-weight:500">Tambah Plot Bimbingan</p>
        </div>

        <form action="<?= base_url('koordinator/tambahKelompok') ?>" method="POST" class="pl-3 pr-3">


          <div class="form-group">
            <label for="dosen">Dosen</label>
            <select class="js-example-basic-single form-control" name="id_dosen" style="width:100%;font-size:18px">
              <?php foreach ($dataDosen as $d) : ?>
                <option value="<?= $d['id_dosen'] ?>"><?= $d['dosen_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="mhs">Mahasiswa</label>
            <select class="js-example-basic-multiple js-stetes form-control" name="id_mhs[]" multiple="multiple" style="width:100%;font-size:18px">
              <?php foreach ($dataMhs as $m) : ?>
                <option value="<?= $m['id_mhs'] ?>"><?= $m['mhs_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="dosen">Semester</label>
            <select class="js-example-basic-single form-control" name="id_semester" style="width:100%;font-size:18px">
              <?php foreach ($dataSemester as $s) : ?>
                <option value="<?= $s['id_semester'] ?>"><?= $s['tahun'] ?> - <?= $s['keterangan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <input type="hidden" value="1" name="category_mhs_bimbingan">


          <div class="form-group text-center">
            <button class="btn btn-rounded btn-primary" type="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script>
  const formFilter = document.getElementById('form-filter');
  const keterangan = document.getElementById('keterangan');
  const tahun = document.getElementById('tahun');
  const containerCard = document.getElementById('container-card');
  let th = "";
  let ket = "";

  formFilter.onsubmit = (e) => {
    e.preventDefault()

    if (tahun.selectedIndex != 0 && keterangan.selectedIndex != 0) {
      th = tahun.options[tahun.selectedIndex].text
      ket = keterangan.options[keterangan.selectedIndex].text
    } else if (tahun.selectedIndex) {
      th = tahun.options[tahun.selectedIndex].text
      ket = ''
    } else if (keterangan.selectedIndex) {
      th = ''
      ket = keterangan.options[keterangan.selectedIndex].text
    } else {
      th = ''
      ket = ''

    }
    fetch(`http://localhost/sibili-revisi/koordinator/dataKelompok?tahun=${th}&keterangan=${ket}`, {
        method: "GET"
      }).then(d => d.json())
      .then(d => {
        containerCard.innerHTML = d.map(groupDosen => {
          return `<div class="contain" id="container-card">
                    <div class="card shadow-lg" style="border-radius:10px;" id="card-loop">
                        <div class="card-body">
                          <h4 class="card-title">${groupDosen.dosen_name}</h4>

                            <div class="table-responsive">
                              <table id="" class="table table-striped table-bordered no-wrap">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tahun</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                ${groupDosen.data.length == 0 ? (
                                  `<td colspan="4" style="text-align: center;">Data tidak ada</td>`
                                )
                              : groupDosen.data.map((detailMhs, index) => {
                                if(detailMhs.category_mhs_bimbingan == 1) {

                                  return `<tr>
                                            <td>${index+1}</td>
                                            <td>${detailMhs.mhs_name}</td>
                                            <td>${detailMhs.tahun}</td>
                                            <td>${detailMhs.keterangan}</td>
                                          </tr>`

                                }
                              }).join('')}
                                  
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                  </div>`
        }).join('')
      })
      .catch(err => console.log(err))

  }
</script>