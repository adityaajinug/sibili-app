<?php

if ($this->session->userdata('role_id') == 2) {
  $this->load->view('mahasiswa/proposal/kedua');
} else if ($this->session->userdata('role_id') == 3) {
  $this->load->view('dosen/bab');
} else {
  redirect('login/blocked');
}
