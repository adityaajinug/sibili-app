<?php

if ($this->session->userdata('role_id') == 2) {
  $this->load->view('mahasiswa/proyekakhir/index');
} else if ($this->session->userdata('role_id') == 3) {
  $this->load->view('dosen/proyekakhir/index');
} else {
  redirect('login/blocked');
}
