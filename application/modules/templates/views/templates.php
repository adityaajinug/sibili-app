<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/vendor/images/logo-sibili.png">
  <title>Sibili - <?= $title; ?></title>
  <!-- Custom CSS -->
  <link href="<?= base_url() ?>/assets/vendor/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>/assets/vendor/extra-libs/c3/c3.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>/assets/vendor/libs/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>/assets/vendor/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="<?= base_url() ?>/assets/dist/css/style.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>/assets/dist/css/card.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>/assets/dist/css/table.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/extra-libs/sweetalert2/') ?>sweetalert2.min.css">
  <script src="<?= base_url() ?>/assets/vendor/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/libs/bootstrap/dist/js/bootstrap.min.js"></script>



</head>

<body>

  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>

  <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <header class="topbar" data-navbarbg="skin6">
      <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

          <div class="navbar-brand">
            <!-- Logo icon -->
            <a href="index.html">
              <b class="logo-icon">
                <!-- Dark Logo icon -->
                <img src="<?= base_url('assets/vendor/') ?>/images/Group 91 (1).png" alt="homepage" class="dark-logo" />
                <!-- Light Logo icon -->
                <img src="<?= base_url('assets/vendor/') ?>/images/logo-icon.png" alt="homepage" class="light-logo" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text" style="margin-left: 10px;">
                <!-- dark Logo text -->
                <img src="<?= base_url('assets/vendor/') ?>/images/Sibili (4).png" alt="homepage" class="dark-logo" />
                <!-- Light Logo text -->
                <img src="<?= base_url('assets/vendor/') ?>/images/logo-light-text.png" class="light-logo" alt="homepage" />
              </span>
            </a>
          </div>

          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">

          <ul class="navbar-nav float-left mr-auto ml-3 pl-1">

            <?php
            if ($this->session->userdata('role_id') == 2) {
              $data = $this->session->userdata('role_id');
              $query = "SELECT mahasiswa.*, mahasiswa_bimbingan.*, semester.* FROM `user`
                        JOIN `mahasiswa` ON `user`.`id_user` = `mahasiswa`.`user_id`
                        JOIN `mahasiswa_bimbingan` ON `mahasiswa_bimbingan`.`id_mhs` = `mahasiswa`.`id_mhs`
                        JOIN `semester` ON `semester`.`id_semester` = `mahasiswa_bimbingan`.`id_semester`
                        WHERE `user`.`role_id` = $data";

              $semester =  $this->db->query($query)->row_array();
            } else if ($this->session->userdata('role_id') == 3 && $this->session->userdata('role_id') == 4 && $this->session->userdata('role_id') == 5) {
              $data = $this->session->userdata('role_id');
              $query = "SELECT dosen.*, mahasiswa_bimbingan.*, semester.* FROM `user`
                        JOIN `dosen` ON `user`.`id_user` = `dosen`.`user_id`
                        JOIN `mahasiswa_bimbingan` ON `mahasiswa_bimbingan`.`id_dosen` = `dosen`.`id_dosen`
                        JOIN `semester` ON `semester`.`id_semester` = `mahasiswa_bimbingan`.`id_semester`
                        WHERE `user`.`role_id` = $data";

              $semester =  $this->db->query($query)->row_array();
            } else {
              echo "";
            }

            ?>
            <!-- 
            <h3>Semester


            </h3> -->




          </ul>

          <ul class="navbar-nav float-right">
            <!-- ============================================================== -->
            <!-- Notification -->
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span><i data-feather="bell" class="svg-icon"></i></span>
                <span class="badge badge-primary notify-no rounded-circle">5</span>
              </a>

            </li> -->


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <?php if ($user['role_id'] == 1) { ?>
                  <span class="ml-2 d-none d-lg-inline-block"><span><?= $user['username']; ?> - </span> <span class="text-dark">Sibili Administrator </span>

                  <?php } else if ($user['role_id'] == 2) { ?>
                    <span class="ml-2 d-none d-lg-inline-block"><span><?= $user['username']; ?> - </span> <span class="text-dark"><?= $mhs['mhs_name'] ?> </span>
                    <?php } else { ?>
                      <span class="ml-2 d-none d-lg-inline-block"><span><?= $user['username']; ?> - </span> <span class="text-dark"><?= $dosen['dosen_name'] ?></span> </span>
                    <?php } ?>

                    <img src="<?= base_url('assets/vendor/') ?>/images/profile.png" alt="user" class="rounded-circle" width="40">
                    <i data-feather="chevron-down" class="svg-icon"></i>
              </a>

              <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                <a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-user mr-2 ml-1"></i></i>
                  Profil Saya</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-cog mr-2"></i></i>
                  Pengaturan Akun</a>

                <div class="dropdown-divider"></div>
                <div class="pl-4 p-3">
                  <a href="<?= base_url('login/logout') ?>" class="btn btn-sm btn-info px-4 py-2" style="font-size:14px;border-radius: 10px;">
                    <i data-feather="power" class="svg-icon mr-2"></i>
                    Logout
                  </a>
                </div>
            </li>

          </ul>
        </div>
      </nav>
    </header>

    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url('dashboard') ?>" aria-expanded="false"><i class="fas fa-tachometer-alt awesome-icon"></i><span class="hide-menu">Dashboard</span></a></li>
            <li class="list-divider"></li>
            <?php
            if ($user['role_id'] == 1) : ?>
              <li class="nav-small-cap"><span class="hide-menu">Data User</span></li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('admin/dataMahasiswa') ?>" aria-expanded="false">
                  <i class="fas fa-user-graduate awesome-icon"></i>
                  <span class="hide-menu">Data Mahasiswa</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('admin/dataDosen') ?>" aria-expanded="false">
                  <i class="fas fa-user-tie awesome-icon"></i>
                  <span class="hide-menu">Data Dosen</span>
                </a>
              </li>
              <li class="list-divider"></li>
              <li class="nav-small-cap"><span class="hide-menu">Semester</span></li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('admin/semester') ?>" aria-expanded="false">
                  <i class="fas fa-graduation-cap awesome-icon"></i>
                  <span class="hide-menu">Kelola Semester</span>
                </a>
              </li>
            <?php elseif ($user['role_id'] == 2) :  ?>
              <li class="nav-small-cap"><span class="hide-menu">KKI</span></li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('bimbingan/proposal') ?>" aria-expanded="false">
                  <i class="fas fa-file awesome-icon"></i>
                  <span class="hide-menu">Proposal</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('bimbingan/laporan') ?>" aria-expanded="false">
                  <i class="fas fa-file-alt awesome-icon"></i>
                  <span class="hide-menu">Laporan</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-city awesome-icon"></i>
                  <span class="hide-menu">Magang</span>
                </a>
              </li>

              <li class="list-divider"></li>
              <li class="nav-small-cap"><span class="hide-menu">Sertifikasi</span></li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-book awesome-icon"></i>
                  <span class="hide-menu">User Guide</span>
                </a>
              </li>


              <li class="list-divider"></li>
              <li class="nav-small-cap"><span class="hide-menu">Proyek Akhir</span></li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-file-invoice awesome-icon"></i>
                  <span class="hide-menu">Tugas Akhir</span>
                </a>
              </li>


              <li class="list-divider"></li>
              <li class="nav-small-cap"><span class="hide-menu">Submission</span></li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-paste awesome-icon"></i>
                  <span class="hide-menu">Ujian</span>
                </a>
              </li>
              <!-- <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-upload awesome-icon"></i>
                  <span class="hide-menu">File Lain</span>
                </a>
              </li> -->
              <li class="list-divider"></li>
            <?php elseif ($user['role_id'] == 3) : ?>
              <li class="nav-small-cap"><span class="hide-menu">KKI</span></li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-file awesome-icon"></i>
                  <span class="hide-menu">Proposal</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('bimbingan/laporan') ?>" aria-expanded="false">
                  <i class="fas fa-file-alt awesome-icon"></i>
                  <span class="hide-menu">Laporan</span>
                </a>
              </li>

              <li class="list-divider"></li>
              <li class="nav-small-cap"><span class="hide-menu">Sertifikasi</span></li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-book awesome-icon"></i>
                  <span class="hide-menu">User Guide</span>
                </a>
              </li>


              <li class="list-divider"></li>
              <li class="nav-small-cap"><span class="hide-menu">Proyek Akhir</span></li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-file-invoice awesome-icon"></i>
                  <span class="hide-menu">Tugas Akhir</span>
                </a>
              </li>
            <?php elseif ($user['role_id'] == 4) : ?>
              <li class="nav-small-cap"><span class="hide-menu">KKI</span></li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('koordinator') ?>" aria-expanded="false">
                  <i class="fas fa-user-tie awesome-icon"></i>
                  <span class="hide-menu">Koordinator KKI </span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="ticket-list.html" aria-expanded="false">
                  <i class="fas fa-file awesome-icon"></i>
                  <span class="hide-menu">Proposal</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('bimbingan/laporan') ?>" aria-expanded="false">
                  <i class="fas fa-file-alt awesome-icon"></i>
                  <span class="hide-menu">Laporan</span>
                </a>
              </li>

              <li class="list-divider"></li>

            <?php endif; ?>











          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>


    <div class="page-wrapper">

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
              <?php
              //ubah timezone menjadi jakarta
              date_default_timezone_set("Asia/Jakarta");

              //ambil jam dan menit
              $jam = date('H:i');

              //atur salam menggunakan IF
              if ($jam > '05:30' && $jam < '10:00') {
                $salam = 'Pagi';
              } elseif ($jam >= '10:00' && $jam < '15:00') {
                $salam = 'Siang';
              } elseif ($jam >= '15:00' && $jam < '18:30') {
                $salam = 'Sore';
              } else {
                $salam = 'Malam';
              }

              //tampilkan pesan
              echo 'Selamat ' . $salam;

              ?>
              <?php if ($user['role_id'] == 1) {
                echo $user['username'];
              } else if ($user['role_id'] == 2) {
                echo $mhs['mhs_name'];
              } else {
                echo $dosen['dosen_name'];
              }


              ?>
            </h3>
            <div class="d-flex align-items-center">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                  <li class="breadcrumb-item"><a href="index.html"><?= $title; ?></a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- <div class="col-5 align-self-center">
            <div class="customize-input float-right">
              <div class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                <option><?php echo (date('d M y')); ?></option>
              </div>
            </div>
          </div> -->
        </div>
      </div>

      <?= $contents; ?>



      <footer class="footer text-center text-muted d-flex justify-content-center">
        <p class="text-center">All Rights Reserved by DTI. Designed and Developed by <a href="https://adityaajinug.github.io/webprofile/">adityaajinug</a></p>.
      </footer>
    </div>
  </div>
  <script src="<?= base_url() ?>/assets/dist/js/app-style-switcher.js"></script>
  <script src="<?= base_url() ?>/assets/dist/js/feather.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/dist/js/sidebarmenu.js"></script>

  <script src="<?= base_url() ?>/assets/dist/js/custom.min.js"></script>


  <script src="<?= base_url() ?>/assets/vendor/extra-libs/c3/d3.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/extra-libs/c3/c3.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?= base_url() ?>/assets/dist/js/pages/dashboards/dashboard1.min.js"></script>



  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="<?= base_url() ?>/assets/vendor/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/assets/dist/js/pages/datatable/datatable-basic.init.js"></script>


  <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2({
        placeholder: 'Pilih Dosen',
        width: 'resolve'
      });
    });
    $(document).ready(function() {
      $('.js-choose').select2({
        placeholder: 'Pilih BAB',
        width: 'resolve'
      });
    });

    $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        placeholder: 'Pilih Mahasiswa',
        width: 'resolve'
      });
    });
    $(document).ready(function() {
      $('.js-choose-status').select2({
        placeholder: 'Pilih Status',
        width: 'resolve'
      });
      $('.js-choose-role').select2({
        placeholder: 'Pilih Role',
        width: 'resolve'
      });
      $('.js-choose-instansi').select2({
        placeholder: 'Pilih Instansi',
        width: 'resolve'
      });
    });
  </script>
</body>

</html>