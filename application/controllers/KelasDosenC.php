<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasDosenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserDosen();
		$this->load->model('KelasDosenM');
	}
		

	public function index(){
			$username = $this->session->userdata('user');
	    $data['tampilKelasDosen']= $this->KelasDosenM->getKelasDosen($username);
	    $data['matkul']= $this->KelasDosenM->getMatkul();
	    $data['grup']= $this->KelasDosenM->getGrup();
	    $data['dosen']= $this->KelasDosenM->getDosen();
	    $data['mahasiswa']= $this->KelasDosenM->getMhs();
	    $this->load->view('dosen/View_kelasDosen', $data);	
	}

	public function detailKelas($idkelas){
		$data['detailKelasMhs']= $this->KelasDosenM->getKelasMahasiswa($idkelas);
		$data['tampilKelasDosen']= $this->KelasDosenM->getKelas($idkelas);
		$this->load->view('dosen/View_detailkelasDosen', $data);
	}
}
?>