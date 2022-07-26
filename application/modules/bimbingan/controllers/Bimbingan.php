<?php

class Bimbingan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Bimbingan_model', 'bimbingan');
  }
  public function unggahBabDosen()
  {
    $bab_id = $this->input->post('bab_id');
    $dosen_id = $this->input->post('dosen_id');
    $mhs_bimbingan_id = $this->input->post('mhs_bimbingan_id');

    $data = [
      'id_bab' => $bab_id,
      'id_dosen' => $dosen_id,
      'id_mhs_bimbingan' => $mhs_bimbingan_id,
    ];
    $this->db->insert('bab_dosen', $data);
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    if ($this->input->post('semester') == 'Ganjil') {
      if ($this->input->post('category_bab') == 2) {
        redirect('bimbingan/laporan/pertama');
      } else if ($this->input->post('category_bab') == 3) {
        redirect('bimbingan/proyekakhir/pertama');
      } else if ($this->input->post('category_bab') == 1) {
        redirect('bimbingan/proposal/pertama');
      }
    } else {
      if ($this->input->post('category_bab') == 2) {
        redirect('bimbingan/laporan/kedua');
      } else if ($this->input->post('category_bab') == 3) {
        redirect('bimbingan/proyekakhir/kedua');
      } else if ($this->input->post('category_bab') == 1) {
        redirect('bimbingan/proposal/kedua');
      }
    }
  }
  public function uploadBimbingan()
  {
    $config['upload_path']   = FCPATH . './file/laporan/';
    $config['allowed_types'] = 'pdf|doc|docx';
    $config['max_size']      = 5000;
    $config['file_name']     = url_title($this->input->post('file'));
    $this->upload->initialize($config);

    $this->upload->do_upload('file');
    $file = $this->upload->data();
    $data = [
      'id_bab_dosen' => $this->input->post('bab_dosen_id'),
      'file' => $file['file_name'],
      'id_mhs' => $this->input->post('mhs_id'),
      'status_confirm' => 0,
      'category_bimbingan' =>  $this->input->post('category_bimbingan'),
    ];
    $this->db->insert('bimbingan', $data);
    $now = date("Y-m-d H:i:s");
    $bimbingan_id = $this->db->insert_id();
    $log = [
      'id_bimbingan' => $bimbingan_id,
      'id_semester' => $this->input->post('semester'),
      'status_log' => 1,
      'date_log' => $now
    ];
    $this->db->insert('log_bimbingan', $log);
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    if ($this->input->post('semester') == 'Ganjil') {
      if ($this->input->post('category_bimbingan') == 2) {
        redirect('bimbingan/laporan/pertama');
      } else if ($this->input->post('category_bimbingan') == 3) {
        redirect('bimbingan/proyekakhir/pertama');
      } else if ($this->input->post('category_bimbingan') == 1) {
        redirect('bimbingan/proposal/pertama');
      }
    } else {
      if ($this->input->post('category_bimbingan') == 2) {
        redirect('bimbingan/laporan/kedua');
      } else if ($this->input->post('category_bimbingan') == 3) {
        redirect('bimbingan/proyekakhir/kedua');
      } else if ($this->input->post('category_bimbingan') == 1) {
        redirect('bimbingan/proposal/kedua');
      }
    }
  }
  public function bab()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['id_dosen'];
      $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['id_dosen'];
      $idMhs =  $this->bimbingan->getDosen()['id_mhs'];
    }
    $idBimbingan = $this->uri->segment(3);
    $idBabDosen = $this->uri->segment(3);

    $data = [
      'title' => 'Detail / Bab',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'detailBab' => $this->bimbingan->getBimbinganId($idBimbingan, $idMhs),
      'mhsBab' => $this->bimbingan->getMhsBabBimbingan($idBabDosen, $idDosen)
    ];
    $this->template->load('templates/templates', 'bab', $data);
  }
  public function bab_detail()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['id_dosen'];
      $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['id_dosen'];
      $idMhs =  $this->bimbingan->getDosen()['id_mhs'];
    }


    $idBabDosen = $this->uri->segment(3);
    $idBimbingan = $this->uri->segment(4);
    // var_dump($this->bimbingan->getCatatan($idBabDosen, $idDosen, $idBimbingan));
    // die;
    $data = [
      'title' => 'Bab / Detail File ',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->bimbingan->getDosen(),
      'mhs' => $this->bimbingan->getMhs(),
      'mhsBabDetail' => $this->bimbingan->getDetailMhsBab($idBabDosen, $idDosen, $idBimbingan)
    ];
    $this->template->load('templates/templates', 'dosen/detail-bimbingan', $data);
  }
  public function catatan()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['id_dosen'];
      $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['id_dosen'];
      $idMhs =  $this->bimbingan->getDosen()['id_mhs'];
    }
    $idBabDosen = $this->uri->segment(3);
    $idBimbingan = $this->uri->segment(4);
    foreach ($this->bimbingan->getCatatan($idBabDosen, $idDosen, $idBimbingan) as $c) {
      $result[] = [
        'id_bimbingan' => $c['id_bimbingan'],
        'correction' => $c['correction'],
        'id_dosen' => $c['id_dosen'],
        'date_created' => $c['date_created'],
      ];
    }
    $data = [
      'catatan' => $result
    ];

    echo json_encode($data);
  }
  public function catatanmhs()
  {
    if ($this->session->userdata('role_id') == 2) {
      $idDosen =  $this->bimbingan->getMhs()['id_dosen'];
      $idMhs =  $this->bimbingan->getMhs()['id_mhs'];
    } else {
      $idDosen =  $this->bimbingan->getDosen()['id_dosen'];
      $idMhs =  $this->bimbingan->getDosen()['id_mhs'];
    }
    $idBimbingan = $this->uri->segment(3);

    foreach ($this->bimbingan->getCatatanMhs($idBimbingan, $idMhs) as $c) {
      $result[] = [
        'id_bimbingan' => $c['id_bimbingan'],
        'correction' => $c['correction'],
        'id_dosen' => $c['id_dosen'],
        'date_created' => $c['date_created'],
      ];
    }
    $data = [
      'catatan' => $result
    ];

    echo json_encode($data);
  }
  public function tambah_catatan()
  {
    $correction = $this->input->post('content');
    $idBimbingan = $this->input->post('id_bimbingan');
    $dosenId = $this->input->post('dosen_id');
    $now = date("Y-m-d H:i:s");

    $data = [
      'id_bimbingan' => $idBimbingan,
      'correction' => $correction,
      'id_dosen' => $dosenId,
      'date_created' => $now
    ];
    $this->db->insert('catatan', $data);
  }
  public function allBab()
  {
    $data = [
      'bab' => $this->bimbingan->getBab()
    ];
    echo json_encode($data['bab']);
  }
}
