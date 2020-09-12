<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class JadwalAkademikC extends CI_Controller{
		
		function __construct(){
			parent:: __construct();
			$this->load->helper('url');
			// $this->load->driver('cache');
			// $this->cache->clean();
			no_accessuser();
			cekUserAkademik();
			//no_access();
			$this->load->model('JadwalAkademikM');
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
			 $data['semester'] = $this->JadwalAkademikM->getSemester();
		   $data['tampilJadwalAkademik']= $this->JadwalAkademikM->getJadwalAkademik();
		   $data['tampilRuangAkademik']=$this->JadwalAkademikM->getRuangAkademik();
		   $data['tampilWaktuAkademik']=$this->JadwalAkademikM->getWaktu();
		   $data['cekTahunAjaran']=$this->JadwalAkademikM->getTahunAjaran();

		   $this->load->view('akademik/View_jadwalakademik', $data);
		   // $this->load->view('akademik/View_jadwalakademik', $data);
		}

		//untuk create pertemuan hadir
		public function hadir($id_kelas, $tglPertemuan, $sesi){
			$presensiInfo = array(
				'id_kelas'=>$id_kelas,
				'tgl_pertemuan'=>$tglPertemuan,
				'sesi'=>str_replace('%20',' ',$sesi),
				'status_pertemuan'=>'Hadir',
				"createDtm"=>date('Y-m-d H:s:i')
			);
			$result = $this->JadwalAkademikM->presensi($presensiInfo);

			if($result > 0){
				$this->session->set_flashdata('success','Presensi berhasil dibuat');
			}else{
				$this->session->set_flashdata('error','Presensi gagal dibuat');
			}

			redirect('jadwalAkademikR');
		}

			//untuk create pertemuan pengganti ,
		public function hadirPengganti($id_kelas, $tglPertemuan, $sesi){
			$presensiPenggantiInfo = array(
				'id_kelas'=>$id_kelas,
				'tgl_pertemuan'=>$tglPertemuan,
				'sesi'=>$sesi,
				'status_pertemuan'=>'Hadir',
				"createDtm"=>date('Y-m-d H:s:i')
			);
			
			$result = $this->JadwalAkademikM->presensiPengganti($presensiPenggantiInfo);

			if($result > 0){
				$this->session->set_flashdata('success','Presensi berhasil dibuat');
			}else{
				$this->session->set_flashdata('error','Presensi gagal dibuat');
			}

			redirect('jadwalAkademikR');
		}

		//untuk create pertemuan absen
		public function absen(){
			$id_kelas = $this->input->post('id_kelas');
			$keterangan = $this->input->post('keterangan');
			$tanggal = $this->input->post('tanggal');
			$sesi = $this->input->post('sesi');

			$presensiInfo = array(
				'id_kelas'=>$id_kelas,
				'tgl_pertemuan'=>$tanggal,
				'keterangan'=>$keterangan,
				'sesi'=>$sesi,
				'status_pertemuan'=>'Tidak Hadir',
				"createDtm"=>date('Y-m-d H:s:i')
			);

			//get id_pertemuan yang barusaja dibuat
			$result = $this->JadwalAkademikM->presensi($presensiInfo);

			if($result > 0){
				$this->session->set_flashdata('success','Presensi berhasil dibuat');
			}else{
				$this->session->set_flashdata('error','Presensi gagal dibuat');
			}

			redirect('jadwalAkademikR');
		}

		//ini function dari jadwalakademik menuju kelaspenggantiakademik
		public function tambahKelasPengganti($id_jadwal = NULL, $tanggal = NULL){
			if($id_jadwal == NULL || $tanggal == NULL){
				redirect('jadwalAkademikR');
			}


			$inputtgl = $this->input->post('inputtgl');
			$data['inputtgl'] = $inputtgl;
			$data['kelas'] = $this->JadwalAkademikM->getKelas($id_jadwal);
			$data['tgl'] = $tanggal;
			$data['tampilRuangAkademik']=$this->JadwalAkademikM->getRuangAkademik();
			$data['semesterAktif']=$this->JadwalAkademikM->getStatusTa();
			$data['tampilWaktuAkademik']=$this->JadwalAkademikM->getWaktu();
		  $data['cekTahunAjaran']=$this->JadwalAkademikM->getTahunAjaran();

			$this->load->view('akademik/View_kelaspenggantiakademikL',$data);
		}

		//ini function dari jadwalakademik menuju kelaspenggantiakademik
		public function tambahKelasPenggantiP($id_jadwal = NULL, $tanggal = NULL, $id_pertemuan = NULL){
			if($id_jadwal == NULL || $tanggal == NULL || $id_pertemuan == NULL){
				redirect('jadwalAkademikR');
			}


			$inputtgl = $this->input->post('inputtgl');
			$data['inputtgl'] = $inputtgl;
			$data['kelas'] = $this->JadwalAkademikM->getKelas($id_jadwal);
			$data['tgl'] = $tanggal;
			$data['tampilRuangAkademik']=$this->JadwalAkademikM->getRuangAkademik();
			$data['semesterAktif']=$this->JadwalAkademikM->getStatusTa();
			$data['tampilWaktuAkademik']=$this->JadwalAkademikM->getWaktu();
		  $data['cekTahunAjaran']=$this->JadwalAkademikM->getTahunAjaran();
			$data['id_pertemuan']=$id_pertemuan;
			$this->load->view('akademik/View_kelaspenggantiakademikLP',$data);
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
			redirect('jadwalAkademikR');
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
				
			$result = $this->JadwalAkademikM->insertKelasPengganti($kelasPenggantiInfo);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Kelas Pengganti berhasil dibuat');
			}
			else
			{
				$this->session->set_flashdata('error', 'Kelas Pengganti gagal dibuat');
			}
				
			
			redirect('jadwalAkademikR');
		}
		}
}
?>