<?php

use Mpdf\Tag\P;

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

  public function getDosen()
  {
    $data = $this->session->userdata('username');
    $this->db->select('user.username, dosen.dosen_name');
    $this->db->from('user');
    $this->db->join('dosen', 'user.id_user = dosen.user_id', 'left');
    $this->db->where('user.username=', $data);
    return $this->db->get()->row_array();
  }
  public function getMhs()
  {
    $data = $this->session->userdata('username');
    $this->db->select('user.username, mahasiswa.mhs_name');
    $this->db->from('user');
    $this->db->join('mahasiswa', 'user.id_user = mahasiswa.user_id', 'left');
    $this->db->where('user.username=', $data);
    return $this->db->get()->row_array();
  }
  public function getCountLaporan()
  {
    $data = $this->session->userdata('username');
    $this->db
      ->select('count(*) as jmlLaps')
      ->from('bimbingan')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_mhs_bimbingan = bab_dosen.id_mhs_bimbingan')
      ->join('mahasiswa', 'mahasiswa.id_mhs = mahasiswa_bimbingan.id_mhs')
      ->join('user', 'mahasiswa.user_id = user.id_user')
      ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->where('bimbingan.category_bimbingan', 2)
      ->where('mahasiswa.id_mhs', 1);

    return $this->db->get()->result_array();
  }
  public function getcountDosen()
  {
    $this->db->select('count(*) as jmlDosen')
      ->from('dosen');

    return $this->db->get()->result_array();
  }
  public function getcountMahasiswa()
  {
    $this->db->select('count(*) as jmlMhs')
      ->from('mahasiswa');

    return $this->db->get()->result_array();
  }
  public function getcountSemester()
  {
    $this->db->select('count(*) as jmlSemester')
      ->from('semester');

    return $this->db->get()->result_array();
  }
}
