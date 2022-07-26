<?php
class Bimbingan_model extends CI_Model
{
  public function getDosen()
  {
    $data = $this->session->userdata('username');
    $this->db->select('user.username, dosen.*, mahasiswa_bimbingan.*, semester.keterangan');
    $this->db->from('user');
    $this->db->join('dosen', 'user.id_user = dosen.user_id', 'left');
    $this->db->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_dosen = dosen.id_dosen');
    $this->db->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester');
    $this->db->where('user.username', $data)->where('semester.is_done', 1);
    return $this->db->get()->row_array();
  }
  public function getMhs()
  {
    $data = $this->session->userdata('username');
    $this->db->select('user.username, mahasiswa.*, mahasiswa_bimbingan.*, semester.*');
    $this->db->from('user');
    $this->db->join('mahasiswa', 'user.id_user = mahasiswa.user_id', 'left');
    $this->db->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs');
    $this->db->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester');
    $this->db->where('user.username=', $data)->where('semester.is_done', 1);
    return $this->db->get()->row_array();
  }
  public function getBab()
  {
    return $this->db->get('bab')->result_array();
  }
  public function getSemesterDosen($idDosen, $isStatus)
  {

    $this->db
      ->select('mahasiswa_bimbingan.*, semester.keterangan')
      ->from('semester')
      ->join('mahasiswa_bimbingan', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->join('dosen', 'dosen.id_dosen = mahasiswa_bimbingan.id_dosen')
      ->where('dosen.id_dosen', $idDosen)
      ->where('semester.keterangan', $isStatus);
    return $this->db->get()->row_array();
  }
  public function getBabDosen($idDosen, $isKeterangan)
  {

    $this->db
      ->select('bab_dosen.*, bab.*, semester.*')
      ->from('bab_dosen')
      ->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_mhs_bimbingan = bab_dosen.id_mhs_bimbingan')
      ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->join('bab', 'bab.id_bab = bab_dosen.id_bab')
      ->join('dosen', 'dosen.id_dosen = bab_dosen.id_dosen')
      ->where('dosen.id_dosen', $idDosen)
      ->where('semester.keterangan', $isKeterangan)
      ->where('semester.is_done', 1);

    return $this->db->get()->result_array();
  }
  public function getBimbingan($idMhs, $isStatus)
  {
    $this->db
      ->select('bimbingan.*, mahasiswa.mhs_name, bab.*, semester.*, bab_dosen.*')
      ->from('bimbingan')
      ->join('mahasiswa', 'mahasiswa.id_mhs = bimbingan.id_mhs')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_mhs_bimbingan = bab_dosen.id_mhs_bimbingan')
      ->join('semester', 'semester.id_semester = mahasiswa_bimbingan.id_semester')
      ->join('bab', 'bab.id_bab = bab_dosen.id_bab')
      ->where('mahasiswa.id_mhs', $idMhs)
      ->where('semester.keterangan', $isStatus)
      ->where('semester.is_done', 1);
    return $this->db->get()->result_array();
  }
  public function getBimbinganId($idBimbingan, $idMhs)
  {
    $this->db
      ->select('bimbingan.*, mahasiswa.*, bab.*, dosen.dosen_name')
      ->from('bimbingan')
      ->join('mahasiswa', 'mahasiswa.id_mhs = bimbingan.id_mhs')
      ->join('mahasiswa_bimbingan', 'mahasiswa_bimbingan.id_mhs = mahasiswa.id_mhs')
      ->join('dosen', 'dosen.id_dosen = mahasiswa_bimbingan.id_dosen')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('bab', 'bab.id_bab = bab_dosen.id_bab')
      ->where('bimbingan.id_bimbingan', $idBimbingan)
      ->where('mahasiswa.id_mhs', $idMhs);
    return $this->db->get()->row_array();
  }
  public function getMhsBabBimbingan($idBabDosen, $idDosen)
  {
    $this->db
      ->select('bimbingan.*, mahasiswa.mhs_name, bab.bab_name, user.username')
      ->from('bimbingan')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('bab', 'bab.id_bab = bab_dosen.id_bab')
      ->join('mahasiswa', 'mahasiswa.id_mhs = bimbingan.id_mhs')
      ->join('user', 'user.id_user = mahasiswa.user_id')
      ->where('bimbingan.id_bab_dosen', $idBabDosen)
      ->where('bab_dosen.id_dosen', $idDosen);
    return $this->db->get()->result_array();
  }
  public function getDetailMhsBab($idBabDosen, $idDosen, $idBimbingan)
  {
    $this->db
      ->select('bimbingan.*, mahasiswa.mhs_name, bab.bab_name, user.username')
      ->from('bimbingan')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('bab', 'bab.id_bab = bab_dosen.id_bab')
      ->join('mahasiswa', 'mahasiswa.id_mhs = bimbingan.id_mhs')
      ->join('user', 'user.id_user = mahasiswa.user_id')
      ->where('bimbingan.id_bab_dosen', $idBabDosen)
      ->where('bab_dosen.id_dosen', $idDosen)
      ->where('bimbingan.id_bimbingan', $idBimbingan);
    return $this->db->get()->row_array();
  }
  public function getCatatan($idBabDosen, $idDosen, $idBimbingan)
  {
    $this->db
      ->select('catatan.*')
      ->from('catatan')
      ->join('bimbingan', 'bimbingan.id_bimbingan = catatan.id_bimbingan')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('dosen', 'dosen.id_dosen = catatan.id_dosen')
      ->where('bimbingan.id_bab_dosen', $idBabDosen)
      ->where('bab_dosen.id_dosen', $idDosen)
      ->where('bimbingan.id_bimbingan', $idBimbingan);
    return $this->db->get()->result_array();
  }
  public function getCatatanMhs($idBimbingan, $idMhs)
  {
    $this->db
      ->select('catatan.*')
      ->from('catatan')
      ->join('bimbingan', 'bimbingan.id_bimbingan = catatan.id_bimbingan')
      ->join('bab_dosen', 'bab_dosen.id_bab_dosen = bimbingan.id_bab_dosen')
      ->join('dosen', 'dosen.id_dosen = catatan.id_dosen')
      ->where('bimbingan.id_bimbingan', $idBimbingan)
      ->where('bimbingan.id_mhs', $idMhs);
    return $this->db->get()->result_array();
  }
}
