<?php

class Proposal extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Bimbingan_model', 'bimbingan');
  }
  public function index()
  {
    $data = [
      'title' => 'Proposal',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),

    ];
    $this->template->load('templates/templates', 'proposal', $data);
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
      'title' => 'Detail / Proposal Pertama',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'bab' => $this->bimbingan->getBab(),
      'babDosen' => $this->bimbingan->getBabDosen($idDosen),
      'bimbingan' => $this->bimbingan->getBimbingan($idMhs)
    ];
    $this->template->load('templates/templates', 'detail/detail-proposal-pertama', $data);
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
      'title' => 'Detail / Proposal Kedua',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'bab' => $this->bimbingan->getBab(),
      'babDosen' => $this->bimbingan->getBabDosen($idDosen),
      'bimbingan' => $this->bimbingan->getBimbingan($idMhs)
    ];
    $this->template->load('templates/templates', 'detail/detail-proposal-kedua', $data);
  }
}
