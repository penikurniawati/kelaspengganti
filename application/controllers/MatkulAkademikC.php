<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MatkulAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('MatkulAkademikM');
	}		

		public function index(){
		    $data['tampilMatkulAkademik']= $this->MatkulAkademikM->getMatkulAkademik();
		    $this->load->view('akademik/View_matkulakademik', $data);
			
		}
}
?>