<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('MahasiswaAkademikM');
	}
		

		public function index(){
				$nama = $this->input->post('nama');
				$niu = $this->input->post('niu');
				$angkatan1 = $this->input->post('angkatan1');
				$angkatan2 = $this->input->post('angkatan2');
		    $data['tampilMahasiswaAkademik']= $this->MahasiswaAkademikM->getMahasiswaAkademik($nama, $angkatan1, $angkatan2, $niu);
		    $data['angkatan']= $this->MahasiswaAkademikM->getAngkatanMhs();
		    $this->load->view('akademik/View_mahasiswaakademik', $data);
		}
}
?>