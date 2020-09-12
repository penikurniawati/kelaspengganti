<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KehadiranAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('KehadiranAkademikM');
	}
		

		public function index(){
		    $data['tampilKehadiranAkademik']= $this->KehadiranAkademikM->getKehadiranAkademik();
		    $this->load->view('akademik/View_kehadiranakademik', $data);

			
		}
}
?>