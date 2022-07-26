<?php

class Proyekakhir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Bimbingan_model', 'bimbingan');
  }
  public function index()
  {
    $data = [
      'title' => 'Proyek Akhir',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),

    ];
    $this->template->load('templates/templates', 'proyekakhir', $data);
  }

  public function pertama()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['dosen_id'];
      $idMhs =  $this->bimbingan->getMhs()['mhs_id'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['dosen_id'];

      $idMhs =  $this->bimbingan->getDosen()['id_dosen'];
    }

    $data = [
      'title' => 'Detail / Proyek Akhir Pertama',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'bab' => $this->bimbingan->getBab(),
      'babDosen' => $this->bimbingan->getBabDosen($idDosen),
      'bimbingan' => $this->bimbingan->getBimbingan($idMhs)
    ];
    $this->template->load('templates/templates', 'detail/detail-laporan-pertama', $data);
  }
  public function kedua()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['dosen_id'];
      $idMhs =  $this->bimbingan->getMhs()['mhs_id'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['dosen_id'];

      $idMhs =  $this->bimbingan->getDosen()['id_dosen'];
    }

    $data = [
      'title' => 'Detail / Proyek Akhir Kedua',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'bab' => $this->bimbingan->getBab(),
      'babDosen' => $this->bimbingan->getBabDosen($idDosen),
      'bimbingan' => $this->bimbingan->getBimbingan($idMhs)
    ];
    $this->template->load('templates/templates', 'detail/detail-laporan-kedua', $data);
  }
}
