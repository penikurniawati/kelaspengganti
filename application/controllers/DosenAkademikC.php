<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('DosenAkademikM');
	}
		

		public function index(){
		    $data['tampilDosenAkademik']= $this->DosenAkademikM->getDosenAkademik();
		    $this->load->view('akademik/View_dosenakademik', $data);

			
		}
}
?>