<?php
class Koordinator extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Koordinator_model', 'koordinator');
  }
  public function index()
  {
    $data = [
      'title' => 'Koordinator KKI',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->koordinator->getDosen(),
    ];
    $this->template->load('templates/templates', 'index', $data);
  }
  public function industri()
  {
    $data = [
      'title' => 'Koordinator KKI',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->koordinator->getDosen(),
      'industry' => $this->koordinator->getIndustry()
    ];
    $this->template->load('templates/templates', 'kki/data-industri/index', $data);
  }
  public function kelompokBimbingan()
  {
    $tahun = $this->input->get('tahun');
    $keterangan = $this->input->get('keterangan');


    if ($tahun && $keterangan) {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'Tahun dan Keterangan',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], $tahun, $keterangan)
        ];
      }
    } else if ($tahun) {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'tahun',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], $tahun, '')
        ];
      }
    } else if ($keterangan) {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'Keterangan',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], '', $keterangan)
        ];
      }
    } else {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'Semua',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], '', '')
        ];
      }
    }
    $data = [
      'title' => 'Koordinator KKI',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->koordinator->getDosen(),
      'dataDosen' => $this->koordinator->getAllDosen(),
      'dataMhs' => $this->koordinator->getAllMahasiswa(),
      'dataSemester' => $this->koordinator->getAllSemester(),
      'dataMhsBimbingan' => $this->koordinator->getMahasiswaBimbingan(),
      'kelompok' => $kelompok,
      'semesterTahun' => $this->koordinator->getTahunSemester()
    ];
    $this->template->load('templates/templates', 'kki/kelompok/index', $data);
  }
  public function tambahKelompok()
  {
    $idDosen = $this->input->post('id_dosen');
    $idSemester = $this->input->post('id_semester');
    $categoryBimbingan = $this->input->post('category_mhs_bimbingan');

    $mahasiswa = count($this->input->post('id_mhs'));
    for ($m = 0; $m < $mahasiswa; $m++) {
      $data[$m] = [
        'id_dosen' => $idDosen,
        'id_semester' => $idSemester,
        'category_mhs_bimbingan' => $categoryBimbingan,
        'id_mhs' => $this->input->post('id_mhs[' . $m . ']')
      ];
      $this->db->insert('mahasiswa_bimbingan', $data[$m]);
    }
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    redirect('koordinator/kelompokBimbingan');
  }
  public function detailMhsBimbingan()
  {
    $idDosenDetail = $this->uri->segment('3');
    $data = [
      'title' => 'Koordinator',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->koordinator->getDosen(),
      'detailMahasiswa' => $this->koordinator->getDetailMahasiswaBimbingan($idDosenDetail),
      'dosenPembimbing' => $this->koordinator->getDosenPembimbing($idDosenDetail)

    ];
    $this->template->load('templates/templates', 'kki/kelompok/detail', $data);
  }
  public function deleteMultiple()
  {
    $idMhs =  $this->input->post('idMhsBimbingan');
    foreach ($idMhs as $id) {
      $this->db->where('id_mhs_bimbingan', $id);
      $this->db->delete('mahasiswa_bimbingan');
    }
    echo json_encode([
      'status' => true,
      'message' => 'success hapus',
    ]);
  }
  public function schedule()
  {
    foreach ($this->koordinator->getTanggalUjian() as $m) {
      $mhs_ujian[] = [
        'date' => $m['date'],
        'room' => $m['room'],
        'data' => $this->koordinator->getMahasiswaUjian($m['date'])
      ];
    }
    $data = [
      'title' => 'Koordinator',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
      'dosen' => $this->koordinator->getDosen(),
      'dataDosen' => $this->koordinator->getAllDosen(),
      'dataMhsBimbingan' => $this->koordinator->getMahasiswaBimbingan(),
      'mhs_ujian' => $mhs_ujian
    ];
    $this->template->load('templates/templates', 'kki/jadwal/index', $data);
    // echo json_encode($data['mhs_ujian']);
  }
  public function dataPlot()
  {
    foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
      $plot[] = [
        'id_dosen' => $r['id_dosen'],
        'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
        'dosen_name' => $r['dosen_name'],
        // 'keterangan' => $r['keterangan'],
        'data' => $this->koordinator->getDetailMahasiswaBimbingan($r['id_dosen'])
      ];
    }
    $data = [
      'plot' => $plot

    ];

    echo json_encode($data['plot']);
  }
  public function dataKelompok()
  {

    $tahun = $this->input->get('tahun');
    $keterangan = $this->input->get('keterangan');


    if ($tahun && $keterangan) {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'Tahun dan Keterangan',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], $tahun, $keterangan)
        ];
      }
    } else if ($tahun) {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'tahun',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], $tahun, '')
        ];
      }
    } else if ($keterangan) {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'Keterangan',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], '', $keterangan)
        ];
      }
    } else {
      foreach ($this->koordinator->getMahasiswaBimbingan() as $r) {
        $kelompok[] = [
          'filter' => 'Semua',
          'id_dosen' => $r['id_dosen'],
          'id_mhs_bimbingan' => $r['id_mhs_bimbingan'],
          'dosen_name' => $r['dosen_name'],
          'data' => $this->koordinator->getDetailMhs($r['id_dosen'], '', '')
        ];
      }
    }

    $data = [
      'kelompok' => $kelompok

    ];

    echo json_encode($data['kelompok']);
  }
  public function tambahMahasiswaUjian()
  {
    $idMhsBimbingan = $this->input->post('id_mhs_bimbingan');
    $exam_leader = $this->input->post('exam_leader');
    $exam_member = $this->input->post('exam_member');
    $date = $this->input->post('date');
    $room = $this->input->post('room');

    $mahasiswa = count($idMhsBimbingan);
    for ($m = 0; $m < $mahasiswa; $m++) {
      $data[$m] = [
        'exam_leader' => $exam_leader,
        'exam_member' => $exam_member,
        'date' => $date,
        'room' => $room,
        'id_mhs_bimbingan' => $this->input->post('id_mhs_bimbingan[' . $m . ']')
      ];
      $this->db->insert('schedule', $data[$m]);
    }
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    <strong>Success - </strong> Data Tersimpan!</div>');
    redirect('koordinator/schedule');
  }
  public function dataUjian()
  {
    foreach ($this->koordinator->getTanggalUjian() as $r) {
      $mhs_ujian[] = [

        'date' => $r['date'],
        'room' => $r['room'],
        'data' => $this->koordinator->getMahasiswaUjian($r['room'])
      ];
    }
    $data = [
      'mhs_ujian' => $mhs_ujian

    ];

    echo json_encode($data['mhs_ujian']);
  }
}
