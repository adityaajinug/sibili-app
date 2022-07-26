<?php

if ($this->session->userdata('role_id') == 2) {
  $this->load->view('mahasiswa/proposal/index');
} else if ($this->session->userdata('role_id') == 3) {
  $this->load->view('dosen/index');
} else {
  redirect('login/blocked');
}
