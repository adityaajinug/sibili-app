<?php

if ($this->session->userdata('role_id') == 2) {
  $this->load->view('mahasiswa/laporan/kedua');
} else if ($this->session->userdata('role_id') == 3) {
  $this->load->view('dosen/laporan/bab_kedua');
} else {
  redirect('login/blocked');
}
