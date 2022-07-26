<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Input</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
  <?= $this->session->flashdata('pesan'); ?> <br>
  <form action="<?= base_url('test/tambah_mahasiswa') ?>" method="POST">
    <label for="">Mahasiswa</label> <br><br>
    <input type="text" name="username" placeholder="nim">
    <input type="text" name="mhs_name" placeholder="nama mahasiswa">
    <input type="text" name="email" placeholder="email">



    <button type="submit">Add Mahasiswa</button>
  </form>

  <br><br><br><br>

  <form action="<?= base_url('test/tambah_dosen') ?>" method="POST">
    <label for="">Dosen</label> <br><br>
    <input type="text" name="username" placeholder="npp">
    <input type="text" name="dosen_name" placeholder="nama dosen">
    <input type="text" name="email" placeholder="email">
    <select name="role">
      <option value="">Pilih Role</option>
      <?php foreach ($role as $r) : ?>
        <option value="<?= $r['id_role'] ?>"><?= $r['role_name'] ?></option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Add Dosen</button>
  </form>

  <br><br><br><br>
  <form action="<?= base_url('test/tambah_mhs_bimbingan') ?>" method="post">
    <label for="">Mahasiswa Bimbingan</label> <br>
    <select name="dosen_id" id="">
      <?php $no = 1;
      foreach ($dosen as $d) : ?>
        <option value="<?= $d['id_dosen'] ?>"><?= $no++; ?>. <?= $d['dosen_name'] ?></option>
      <?php endforeach; ?>
    </select> <br><br>
    <select class="js-example-basic-multiple js-stetes form-control" name="mhs_id[]" multiple="multiple">
      <?php $no = 1;
      foreach ($mhs as $m) : ?>
        <option value="<?= $m['id_mhs'] ?>"><?= $no++; ?>. <?= $m['mhs_name'] ?></option>
      <?php endforeach; ?>
    </select>
    <input type="hidden" name="semester_id" value="1">
    <br><br>

    <button type="submit">Add Mahasiswa Bimbingan</button>

  </form>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        placeholder: 'Pilih Mahasiswa',
        width: 'resolve'
      });
    });
    $(document).ready(function() {
      $('.js-example-basic-single').select2({
        placeholder: 'Pilih Dosen',
        width: 'resolve'
      });
    });
  </script>
</body>

</html>