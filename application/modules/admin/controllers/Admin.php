<?php

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model', 'admin');
  }
  public function dataDosen()
  {
    $data = [
      'title' => 'Data Dosen',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dataDosen' => $this->admin->getDosen(),
    ];
    $this->template->load('templates/templates', 'dosen/index', $data);
  }
  public function dataMahasiswa()
  {
    $data = [
      'title' => 'Data Mahasiswa',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dataMhs' => $this->admin->getMhs(),
    ];
    $this->template->load('templates/templates', 'mahasiswa/index', $data);
  }
  public function semester()
  {
    $data = [
      'title' => 'Data Semester',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'semester' => $this->admin->getSemester()
    ];
    $this->template->load('templates/templates', 'semester/index', $data);
  }
  public function tambahMahasiswa()
  {
    $data = [
      'title' => 'Tambah Data Mahasiswa',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),

    ];
    $this->template->load('templates/templates', 'mahasiswa/tambah', $data);
  }
  public function processAddMhs()
  {
    $nim = $this->input->post('nim');
    $mhs_name = $this->input->post('mhs_name');
    $email = $this->input->post('email');

    $result = preg_replace("/[^0-9]/", "", $nim);
    $tahun = substr($result, 3, 4);
    $akhir = substr($result, 7, 4);
    $default = 'DTI';
    $pass = $default . '-' . +$tahun . $akhir;


    foreach ($nim as $i => $n) {
      $user = [
        'username' => $n,
        'password' => password_hash($pass[$i], PASSWORD_DEFAULT),
        'role_id' => 2,
        'image' => 'default.jpg',


      ];
      $this->db->insert('user', $user);

      $user_id = $this->db->insert_id();
      $mhs = [
        'mhs_name' => $mhs_name[$i],
        'email' => $email[$i],
        'user_id' => $user_id,
      ];
      $this->db->insert('mahasiswa', $mhs);
    }




    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
      <strong>Success - </strong> Data Tersimpan!</div>');
    redirect('admin/dataMahasiswa');
  }
  public function checkSemester()
  {
    $id = htmlspecialchars($this->input->post('id', true));
    $check = htmlspecialchars($this->input->post('check_semester', true));

    if ($check == 0) :
      $check = 1;
    else :
      $check = 0;
    endif;

    $this->db->set('is_done', $check);
    $this->db->where('id_semester', $id);
    $this->db->update('semester');
  }
}
