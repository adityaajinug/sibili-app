<?php

if ($this->session->userdata('role_id') == 2) {
  $this->load->view('mahasiswa/detail-bab');
} else if ($this->session->userdata('role_id') == 3) {
  $this->load->view('dosen/detail-bab');
} else {
  redirect('login/blocked');
}
