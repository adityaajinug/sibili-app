<div class="container-fluid">
  <?= $this->session->flashdata('pesan'); ?>
  <a href="#" data-toggle="modal" data-target="#tambah-file" class="btn btn-primary mb-2 shadow mb-3" style="border-radius: 10px;">Upload Bab</a>
  <?php if ($semesterDosen['keterangan'] == 'Genap') {
    echo $semesterDosen['id_mhs_bimbingan'];
  }
  ?>
  <div class="row">
    <?php foreach ($babDosen as $b) :
      if ($b['category_bab'] == 2 && $b['keterangan'] == 'Genap') :
    ?>

        <div class="col-md-4">
          <div class="card card-radius">
            <div class="card-body">
              <h3 class="card-title-text"><?= $b['bab_name'] ?></h3>
              <p class="card-text-space"><?= $b['description'] ?></p>
              <a href="<?= base_url('bimbingan/bab/' . $b['id_bab_dosen']) ?>" class="btn btn-primary" style="border-radius: 10px;">Detail</a>
            </div>
          </div>
        </div>
    <?php endif;
    endforeach; ?>

  </div>
</div>
<div id="tambah-file" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <p style="font-size: 24px;color:black;font-weight:500">Upload Bab</p>
        </div>

        <form action="<?= base_url('bimbingan/unggahBabDosen') ?>" method="POST" class="pl-3 pr-3">

          <div class="form-group">
            <label for="bab">Jenis File</label>

            <select class="js-choose form-control" name="bab_id" id="bab" style="width:100%;font-size:18px">


            </select>
          </div>
          <textarea name="deskripsi" class="form-control" cols="30" rows="5" id="deskripsi" readonly></textarea>
          <input type="hidden" name="dosen_id" id="" value="<?= $dosen['id_dosen'] ?>">
          <input type="hidden" name="mhs_bimbingan_id" id="" value="<?= $dosen['id_mhs_bimbingan'] ?>">

          <input type="hidden" name="semester" id="" value="<?= $dosen['keterangan'] ?>">
          <input type="text" name="category_bab" id="category-bab">



          <div class="form-group text-center">
            <button class="btn btn-rounded btn-primary" type="submit">Simpan</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', async () => {
    const bab = document.getElementById('bab')
    const deskripsi = document.getElementById('deskripsi')
    const categoryBab = document.getElementById('category-bab')


    let listAllBab = []
    listAllBab = await ambilSemuaBab()
    bab.innerHTML = listAllBab.map(d => `<option value="${d.id_bab}">${d.bab_name}</option>`).join('')
    bab.onchange = () => {
      deskripsi.value = listAllBab[bab.selectedIndex].description
      categoryBab.value = listAllBab[bab.selectedIndex].category_bab
    }
  })
  const ambilSemuaBab = () => {
    return fetch('<?= base_url('bimbingan/allBab') ?>')
      .then(r => {
        if (r.ok) {
          return r.json();
        } else {
          console.log('ga keambil')
        }

      })
      .then(d => d)
      .catch(e => console.log(e))
  };
</script>