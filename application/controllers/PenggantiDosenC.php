<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggantiDosenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserDosen();
		$this->load->model('PenggantiDosenM');
	}
		

	public function index(){
		$username = $this->session->userdata('user');
			$data['tampilKelasKosongDosen']= $this->PenggantiDosenM->getKelasTidakHadirDosen($username);
	    $this->load->view('dosen/View_penggantidosen', $data);	
	}
}
?>