<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('KelasAkademikM');
	}
		

	public function index(){
	    $data['tampilKelasAkademik']= $this->KelasAkademikM->getKelasAkademik();
	    $data['matkul']= $this->KelasAkademikM->getMatkul();
	    $data['grup']= $this->KelasAkademikM->getGrup();
	    $data['dosen']= $this->KelasAkademikM->getDosen();
	    $data['mahasiswa']= $this->KelasAkademikM->getMhs();
	    $this->load->view('akademik/View_datakelasakademik', $data);	
	}

	public function detailKelas($idkelas){
		$data['detailKelasMhs']= $this->KelasAkademikM->getKelasMahasiswa($idkelas);
		$data['tampilKelasAkademik']= $this->KelasAkademikM->getKelas($idkelas);
		$this->load->view('akademik/View_detailkelasakademik', $data);
	}
}
?>