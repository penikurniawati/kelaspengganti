<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggantiAkademikLC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('PenggantiAkademikM');
	}
		

		public function index(){
		    $data['tampilRuang']=$this->PenggantiAkademikM->getRuang();
		    $data['kelas'] = $this->PenggantiAkademikM->getKelas($id_kelas);
		    $this->load->view('akademik/View_pengganti2akademik', $data);	
		}
}
?>