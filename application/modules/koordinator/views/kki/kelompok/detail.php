<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-primary mb-4 shadow" style="border-radius: 10px;">Kembali</a>
      <div class="card" style="border-radius: 10px;">
        <div class="card-body">


          <div class="d-flex align-items-center mb-4">
            <h4 class="card-title">Dosen Pembimbing : <?= $dosenPembimbing['dosen_name'] ?></span>
            </h4>
            <div class="ml-auto mt-3">
              <a href="#" data-toggle="modal" data-target="#tambah-bimbingan" class="btn btn-primary mb-4 shadow" style="border-radius: 10px;">Tambah</a>
              <!-- <a href="http://localhost/sibili/kki/edit_kelompok/DTI2122" class="btn btn-success mb-4 shadow" style="border-radius: 10px;">Edit</a> -->
            </div>
          </div>



          <div class="table-responsive">
            <table class="table no-wrap v-middle mb-0">
              <thead>
                <tr class="border-0">
                  <th class="border-0 font-16 font-weight-medium text-muted">No
                  </th>
                  <th class="border-0 font-16 font-weight-medium text-muted">Mahasiswa
                  </th>
                  <th class="border-0 font-16 font-weight-medium text-muted px-2">NIM
                  </th>
                  <th class="border-0 font-16 font-weight-medium text-muted text-center">
                    Status
                  </th>
                  <th class="border-0 font-16 font-weight-medium text-muted text-center"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs shadow" style="border-radius: 10px;">Delete Multiple</button></th>

                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($detailMahasiswa as $mhs) : ?>
                  <tr>
                    <td class="border-top-0 text-muted px-2 py-4 font-16"><?= $no++; ?></td>
                    <td class="border-top-0 px-2 py-4">
                      <div class="d-flex no-block align-items-center">
                        <div class="mr-3"><img src="<?= base_url() ?>assets/vendor/images/profile.png" alt="user" class="rounded-circle" width="45" height="45" /></div>
                        <div class="">
                          <h5 class="text-dark mb-0 font-16 font-weight-medium"><?= $mhs['mhs_name'] ?></h5>
                          <span class="text-muted font-14">adityaajinug@gmail.com</span>
                        </div>
                      </div>
                    </td>
                    <td class="border-top-0 text-muted px-2 py-4 font-16">A22.2019.02756</td>
                    <td class="border-top-0 text-muted px-2 py-4 font-16 text-center">
                      Aktif </td>
                    <td class="border-top-0 text-center">
                      <input type="checkbox" class="delete_checkbox" value="41" data-id="<?= $mhs['id_mhs_bimbingan'] ?>">
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
<script>
  const deleteAll = document.getElementById('delete_all')
  const listMhs = document.querySelectorAll('.delete_checkbox')
  let listIdMhsSelected = []
  deleteAll.onclick = () => {
    listMhs.forEach(d => {
      if (d.checked) {
        listIdMhsSelected.push(d.dataset.id)
      }
    })
    if (listIdMhsSelected.length != 0) {
      const form = new FormData()
      for (const idMhs of listIdMhsSelected) {
        form.append('idMhsBimbingan[]', idMhs)
      }
      fetch('<?= base_url('koordinator/deleteMultiple') ?>', {
          method: "POST",
          body: form
        }).then(d => d.json())
        .then(d => {
          if (d.status) {
            location.reload()
          }
        })
        .catch(e => console.log(e))
    } else {
      alert('pilih salah satu untuk dihapus')
    }
  };
</script>