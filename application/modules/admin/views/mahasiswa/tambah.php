<div class="container-fluid">
  <div class="card shadow-lg" style="border-radius:10px;">

    <div class="card-body">

      <form action="<?= base_url('admin/processAddMhs') ?>" method="POST">
        <button type="button" class="btn btn-primary " id="baris-baru">Tambah Baris</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button> <br><br>
        <div class="table-responsive">
          <table id="table-rows" class="table table-striped table-bordered no-wrap">
            <thead>
              <tr>
                <!-- <th>No</th> -->
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Email</th>
                <th>Aksi</th>

              </tr>

            </thead>
            <tbody id="add-new-insert">
              <!-- <tr>
                <td>1</td>
                <td><input type="text" class="form-control" name="nim[]"></td>
                <td><input type="text" class="form-control" name="mhs_name[]"></td>
                <td><input type="text" class="form-control" name="email[]"></td>

                <td>
                  <button type="button" class="badge badge-pill badge-success py-2 px-3" id="baris-baru">Tambah</button>
                </td>
              </tr> -->
            </tbody>
          </table>


        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const newRows = document.getElementById('baris-baru')
  const addInsert = document.getElementById('add-new-insert')

  newRows.onclick = (e) => {
    e.preventDefault()



    let row = addInsert.insertRow(0)
    // let cell1 = row.insertCell(0)
    let cell1 = row.insertCell(0)
    let cell2 = row.insertCell(1)
    let cell3 = row.insertCell(2)
    let cell4 = row.insertCell(3)




    cell1.innerHTML = `<tr>
                  <td><input type="text" class="form-control" name="nim[]"></td>`
    cell2.innerHTML = `<td><input type="text" class="form-control" name="mhs_name[]"></td>`
    cell3.innerHTML = `<td><input type="text" class="form-control" name="email[]"></td>`
    cell4.innerHTML = `<td>
                    <button type="button" class="badge badge-pill badge-danger py-2 px-3" id="del-btn" onclick="deleteRow(this)">Hapus</button>
                  </td></tr>`

  }


  const deleteRow = (element) => {
    element.parentNode.parentNode.remove();
  }
</script>