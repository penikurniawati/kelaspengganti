<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggantiAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('PenggantiAkademikM');
	}
		

	public function index(){
			$data['tampilKelasKosong']= $this->PenggantiAkademikM->getKelasTidakHadir();
	    $this->load->view('akademik/View_penggantiakademik', $data);	
	}
}
?>