<?php

class Test_model extends CI_Model
{



  public function getRole()
  {
    return $this->db->get('user_role')->result_array();
  }
}
