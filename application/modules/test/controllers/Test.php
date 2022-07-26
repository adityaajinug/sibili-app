<?php


class Test extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Test_model', 'test');
  }
  public function index()
  {

    $data = [
      'role' => $this->test->getRole(),
      'mhs' => $this->db->get('mahasiswa')->result_array(),
      'dosen' => $this->db->get('dosen')->result_array()

    ];
    $this->load->view('index', $data);
  }
  public function tambah_mahasiswa()
  {
    $nim = $this->input->post('username');
    $result = preg_replace("/[^0-9]/", "", $nim);
    $tahun = substr($result, 3, 4);
    $akhir = substr($result, 7, 4);
    $default = 'DTI';
    $pass = $default . '-' . +$tahun . $akhir;
    $username = $this->input->post('username');

    $user = [
      'username' => htmlspecialchars($this->input->post('username', true)),
      'password' => password_hash($pass, PASSWORD_DEFAULT),
      'role_id' => 2,
      'image' => 'default.jpg',


    ];
    $this->db->insert('user', $user);

    $user_id = $this->db->insert_id();
    $mhs = [
      'mhs_name' => $this->input->post('mhs_name'),
      'email' => $this->input->post('email'),
      'user_id' => $user_id,
    ];
    $this->db->insert('mahasiswa', $mhs);

    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    redirect('test');
  }
  public function tambah_dosen()
  {
    $npp = $this->input->post('username');
    $result = preg_replace("/[^0-9]/", "", $npp);
    $tahun = substr($result, 6, 3);
    $akhir = substr($result, 9, 4);
    $default = 'DTI';
    $pass = $default . '-' . +$tahun . $akhir;

    $user = [
      'username' => $this->input->post('username'),
      'password' => password_hash($pass, PASSWORD_DEFAULT),
      'role_id' => $this->input->post('role'),
      'image' => 'default.jpg',

    ];
    $this->db->insert('user', $user);

    $user_id = $this->db->insert_id();
    $dosen = [
      'dosen_name' => $this->input->post('dosen_name'),
      'email' => $this->input->post('email'),
      'user_id' => $user_id,
    ];
    $this->db->insert('dosen', $dosen);
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    redirect('test');
  }
  public function tambah_mhs_bimbingan()
  {
    $mahasiswa = count($this->input->post('mhs_id'));
    for ($m = 0; $m < $mahasiswa; $m++) {
      $isi[$m] = [
        'dosen_id' => $this->input->post('dosen_id'),
        'semester_id' => $this->input->post('semester_id'),
        'mhs_id' => $this->input->post('mhs_id[' . $m . ']')
      ];
      $this->db->insert('mahasiswa_bimbingan', $isi[$m]);
    }
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    redirect('test');
  }
}
