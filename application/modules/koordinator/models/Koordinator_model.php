<?php

use Mpdf\Tag\P;

class Koordinator_model extends CI_Model
{
  public function getDosen()
  {
    $data = $this->session->userdata('username');
    $this->db->select('user.username, dosen.*');
    $this->db->from('user');
    $this->db->join('dosen', 'user.id_user = dosen.user_id', 'left');
    // $this->db->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_dosen = dosen.id_dosen');
    // $this->db->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester');
    $this->db->where('user.username=', $data);
    return $this->db->get()->row_array();
  }
  public function getIndustry()
  {
    return $this->db->get('industry')->result_array();
  }
  public function getAllDosen()
  {
    return $this->db->get('dosen')->result_array();
  }
  public function getAllMahasiswa()
  {
    return $this->db->get('mahasiswa')->result_array();
  }
  public function getAllSemester()
  {
    $this->db
      ->select('semester.*')
      ->from('semester')
      ->where('is_done', 1);
    return $this->db->get()->result_array();
  }
  public function getTahunSemester()
  {
    $this->db
      ->select('semester.tahun')
      ->from('semester')
      ->group_by('semester.tahun')
      ->order_by('semester.tahun', 'DESC');
    return $this->db->get()->result_array();
  }
  public function getMahasiswaBimbingan()
  {

    $this->db
      ->select('mahasiswa_bimbingan.id_dosen, semester.*, mahasiswa_bimbingan.id_mhs_bimbingan, dosen.dosen_name')
      ->from('mahasiswa_bimbingan')
      ->join('dosen', 'mahasiswa_bimbingan.id_dosen = dosen.id_dosen')
      ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->group_by(array('mahasiswa_bimbingan.id_dosen'));

    return $this->db->get()->result_array();
  }
  public function getDosenPembimbing($idDosenDetail)
  {

    $this->db
      ->select('mahasiswa_bimbingan.id_dosen, semester.*, mahasiswa_bimbingan.id_mhs_bimbingan, dosen.dosen_name')
      ->from('mahasiswa_bimbingan')
      ->join('dosen', 'mahasiswa_bimbingan.id_dosen = dosen.id_dosen')
      ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->where('dosen.id_dosen', $idDosenDetail);

    return $this->db->get()->row_array();
  }
  public function getDetailMahasiswaBimbingan($idDosenDetail)
  {
    $this->db
      ->select('mahasiswa_bimbingan.*, mahasiswa.mhs_name, semester.keterangan')
      ->from('mahasiswa_bimbingan')
      ->join('mahasiswa', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs')
      ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->where('mahasiswa_bimbingan.id_dosen', $idDosenDetail);
    // ->group_by('mahasiswa_bimbingan.id_dosen');

    return $this->db->get()->result_array();
  }
  public function getDetailMhs($idDosenDetail, $tahun, $keterangan)
  {
    if ($tahun && $keterangan) {
      $this->db
        ->select('mahasiswa_bimbingan.*, mahasiswa.mhs_name, semester.keterangan, semester.tahun')
        ->from('mahasiswa_bimbingan')
        ->join('mahasiswa', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs')
        ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
        ->where('mahasiswa_bimbingan.id_dosen', $idDosenDetail)
        ->where('semester.tahun', $tahun)
        ->where('semester.keterangan', $keterangan);
    } else if ($tahun) {
      $this->db
        ->select('mahasiswa_bimbingan.*, mahasiswa.mhs_name, semester.keterangan, semester.tahun')
        ->from('mahasiswa_bimbingan')
        ->join('mahasiswa', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs')
        ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
        ->where('mahasiswa_bimbingan.id_dosen', $idDosenDetail)
        ->where('semester.tahun', $tahun);
    } else if ($keterangan) {
      $this->db
        ->select('mahasiswa_bimbingan.*, mahasiswa.mhs_name, semester.keterangan, semester.tahun')
        ->from('mahasiswa_bimbingan')
        ->join('mahasiswa', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs')
        ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
        ->where('mahasiswa_bimbingan.id_dosen', $idDosenDetail)
        ->where('semester.keterangan', $keterangan);
    } else {
      $this->db
        ->select('mahasiswa_bimbingan.*, mahasiswa.mhs_name, semester.keterangan, semester.tahun')
        ->from('mahasiswa_bimbingan')
        ->join('mahasiswa', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs')
        ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
        ->where('mahasiswa_bimbingan.id_dosen', $idDosenDetail);
    }
    return $this->db->get()->result_array();
  }
  public function getTanggalUjian()
  {
    $this->db
      ->select('schedule.*')
      ->from('schedule')
      ->group_by('schedule.date');

    return $this->db->get()->result_array();
  }
  public function getMahasiswaUjian($room)
  {
    $this->db
      ->select('schedule.*, mahasiswa.mhs_name, dosen.dosen_name, user.username')
      ->from('schedule')
      ->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_mhs_bimbingan = schedule.id_mhs_bimbingan')
      ->join('mahasiswa', 'mahasiswa.id_mhs = mahasiswa_bimbingan.id_mhs')
      ->join('dosen', 'dosen.id_dosen = mahasiswa_bimbingan.id_dosen')
      ->join('user', 'user.id_user = mahasiswa.user_id')
      ->where('schedule.date', $room);

    return $this->db->get()->result_array();
  }
}
