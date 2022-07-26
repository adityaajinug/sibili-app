<?php
if ($this->session->userdata('role_id') == 4) {
  $this->load->view('kki/index');
} else {
  redirect('login/blocked');
}
