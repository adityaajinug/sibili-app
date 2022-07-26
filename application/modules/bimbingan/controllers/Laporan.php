<?php

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Bimbingan_model', 'bimbingan');
  }
  public function index()
  {
    $data = [
      'title' => 'Laporan',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),

    ];
    $this->template->load('templates/templates', 'laporan', $data);
  }

  public function pertama()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['id_dosen'];
      $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['id_dosen'];
      $idMhs =  $this->bimbingan->getDosen()['id_dosen'];
    }

    $data = [
      'title' => 'Detail / Laporan Pertama',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'bab' => $this->bimbingan->getBab(),
      'babDosen' => $this->bimbingan->getBabDosen($idDosen, 'Ganjil'),
      'bimbingan' => $this->bimbingan->getBimbingan($idMhs, 'Ganjil'),
      'semesterDosen' => $this->bimbingan->getSemesterDosen($idDosen, 'Ganjil'),
    ];
    $this->template->load('templates/templates', 'detail/detail-laporan-pertama', $data);
  }

  public function kedua()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['id_dosen'];
      $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['id_dosen'];
      $idMhs =  $this->bimbingan->getDosen()['id_dosen'];
    }

    $data = [
      'title' => 'Detail / Laporan Kedua',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'bab' => $this->bimbingan->getBab(),
      'babDosen' => $this->bimbingan->getBabDosen($idDosen, 'Genap'),
      'bimbingan' => $this->bimbingan->getBimbingan($idMhs, 'Genap'),
      'semesterDosen' => $this->bimbingan->getSemesterDosen($idDosen, 'Genap'),
    ];
    $this->template->load('templates/templates', 'detail/detail-laporan-kedua', $data);
  }

  public function babDosen()
  {
    $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    $idDosen =  $this->bimbingan->getMhs()['id_dosen'];

    foreach ($this->bimbingan->getBabDosen($idDosen) as $b) {
      if ($b['keterangan'] == 'Genap') {
        $bim[] = [
          'id_bab_dosen' => $b['id_bab_dosen'],
          'keterangan' => $b['keterangan'],
          'bab_name' => $b['bab_name'],
        ];
      }
    }
    $data = [
      'bimbingan' => $bim
    ];

    echo json_encode($data['bimbingan']);
  }
}
