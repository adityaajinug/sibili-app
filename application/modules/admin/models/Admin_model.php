<?php

class Admin_model extends CI_Model
{


  public function getDosen()
  {
    $this->db
      ->select('dosen.*, user.*, user_role.role_name')
      ->from('dosen')
      ->join('user', 'user.id_user = dosen.user_id')
      ->join('user_role', 'user_role.id_role = user.role_id')
      ->order_by('user.username', 'DESC');
    return $this->db->get()->result_array();
  }
  public function getMhs()
  {
    $this->db
      ->select('mahasiswa.*, user.*')
      ->from('mahasiswa')
      ->join('user', 'user.id_user = mahasiswa.user_id')
      ->order_by('user.username', 'DESC');
    return $this->db->get()->result_array();
  }
  public function getSemester()
  {
    $this->db->select('semester.*')
      ->from('semester')->order_by('tahun', 'DESC');
    return $this->db->get()->result_array();
  }

}
