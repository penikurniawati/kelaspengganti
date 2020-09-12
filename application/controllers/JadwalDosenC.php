<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalDosenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserDosen();
		$this->load->model('JadwalDosenM');
	}
		

		public function index(){
			if($this->input->post('inputtgl')){
				//Apabila filter diklik
				$data['inputtgl'] = $this->input->post('inputtgl');
			}
			else{
				//apabila tombol filter tidak diklik
				$data['inputtgl'] = date('Y-m-d');
			}
			
		  // $data['tampilJadwalDosen']= $this->JadwalDosenM->getJadwalDosen();
		    $data['tampilRuangDosen']=$this->JadwalDosenM->getRuangDosen();
		    $data['tampilWaktuDosen']=$this->JadwalDosenM->getWaktu();
		    $data['cekTahunAjaran']=$this->JadwalDosenM->getTahunAjaran();
		    $this->load->view('dosen/View_jadwaldosen', $data);			
		}

		//ini function dari jadwaldosen menuju kelaspenggantidosen
		public function tambahKelasPenggantiDosen($id_jadwal = NULL, $tanggal = NULL){
			if($id_jadwal == NULL || $tanggal == NULL){
				redirect('jadwalDosenR');
			}

			$inputtgl = $this->input->post('inputtgl');
			$data['inputtgl'] = $inputtgl;
			$data['kelas'] = $this->JadwalDosenM->getKelas($id_jadwal);
			$data['tgl'] = $tanggal;
			$data['tampilRuangDosen']=$this->JadwalDosenM->getRuangDosen();
			$data['tampilWaktuDosen']=$this->JadwalDosenM->getWaktu();
			$data['cekTahunAjaran']=$this->JadwalDosenM->getTahunAjaran();

			$this->load->view('dosen/View_kelaspenggantidosenL',$data);
		}

		//ini function dari jadwaldosen menuju kelaspenggantidosen
		public function tambahKelasPenggantiDosenP($id_jadwal = NULL, $tanggal = NULL, $id_pertemuan = NULL){
			if($id_jadwal == NULL || $tanggal == NULL || $id_pertemuan == NULL){
				redirect('jadwalDosenR');
			}

			$inputtgl = $this->input->post('inputtgl');
			$data['inputtgl'] = $inputtgl;
			$data['kelas'] = $this->JadwalDosenM->getKelas($id_jadwal);
			$data['tgl'] = $tanggal;
			$data['tampilRuangDosen']=$this->JadwalDosenM->getRuangDosen();
			$data['tampilWaktuDosen']=$this->JadwalDosenM->getWaktu();
			$data['cekTahunAjaran']=$this->JadwalDosenM->getTahunAjaran();
			$data['id_pertemuan']=$id_pertemuan;

			$this->load->view('dosen/View_kelaspenggantidosenLP',$data);
		}

		//ini untuk menambahkan data ke kelas pengganti
		public function addKelasPengganti(){
				$this->load->library('form_validation');
           
        $this->form_validation->set_rules('id_kelas','Kelas','required|xss_clean');
        $this->form_validation->set_rules('id_ruang','Ruangan','required|xss_clean');
        $this->form_validation->set_rules('sesi','Sesi','required|xss_clean');
        $this->form_validation->set_rules('tgl_absen','Tanggal Absen','required|xss_clean');
        $this->form_validation->set_rules('tgl_hadir','Tanggal Hadir','required|xss_clean');
        $this->form_validation->set_rules('keterangan','Keterangan','required|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "kelasPenggantiR"
			redirect('jadwalDosenR');
        }
        else
        {
			$id_kelas = $this->input->post('id_kelas');
			$id_ruang = $this->input->post('id_ruang');
			$sesi = $this->input->post('sesi');
			$tgl_absen = $this->input->post('tgl_absen');
			$tgl_hadir = $this->input->post('tgl_hadir');
			$keterangan = $this->input->post('keterangan');
			if($this->input->post('id_pertemuan')){
				$id_pertemuan = $this->input->post('id_pertemuan');
			}else{
				$id_pertemuan = NULL;
			}

			$kelasPenggantiInfo =  array(
				"id_kelas"=>$id_kelas,
				"id_ruang"=>$id_ruang,
				"jam"=>$sesi,
				"tgl_absen"=>$tgl_absen,
				"tgl_hadir"=>$tgl_hadir,
				"keterangan"=>$keterangan,
				"id_pertemuan"=>$id_pertemuan,
				"createDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->JadwalDosenM->insertKelasPengganti($kelasPenggantiInfo);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Kelas Pengganti berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Kelas Pengganti gagal diubah');
			}
				
			redirect('jadwalDosenR');
			}
		}


	function logout(){	
 	 	$this->session->unset_userdata('user');
 	 	$this->session->unset_userdata('status');	
 	 	$this->session->set_flashdata('sukses', 'Anda telah keluar dari Sistem');
 	 	redirect('loginUserR');	
	}
}
?>