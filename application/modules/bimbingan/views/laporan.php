<?php

if ($this->session->userdata('role_id') == 2) {
  $this->load->view('mahasiswa/laporan/index');
} else if ($this->session->userdata('role_id') == 3) {
  $this->load->view('dosen/laporan/index');
} else {
  redirect('login/blocked');
}
