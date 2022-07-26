<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Dashboard_model', 'dashboard');
  }
  public function index()
  {

    $data = [
      'title' => 'Dashboard',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->dashboard->getDosen(),
      'mhs' => $this->dashboard->getMhs(),
      'laporan' => $this->dashboard->getCountLaporan(),
      'countDosen' => $this->dashboard->getcountDosen(),
      'countMhs' => $this->dashboard->getcountMahasiswa(),
      'countSemester' => $this->dashboard->getcountSemester()

    ];
    if ($this->session->userdata('role_id') == 1) {
      $this->template->load('templates/templates', 'admin', $data);
    } else if ($this->session->userdata('role_id') == 2) {
      $this->template->load('templates/templates', 'mhs', $data);
    } else if ($this->session->userdata('role_id') == 3) {
      $this->template->load('templates/templates', 'dosen', $data);
    } else if ($this->session->userdata('role_id') == 4) {
      $this->template->load('templates/templates', 'koordinator-kki', $data);
    } else if ($this->session->userdata('role_id') == 5) {
      $this->template->load('templates/templates', 'koordinator-sertifikasi', $data);
    } else if ($this->session->userdata('role_id') == 6) {
      $this->template->load('templates/templates', 'koordinator-pa', $data);
    } else {
      redirect('login/blocked');
    }
  }
}
