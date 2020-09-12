<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RuangAkademikC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserAkademik();
		$this->load->model('RuangAkademikM');
	}
		

		public function index(){
		    $data['tampilRuangAkademik']= $this->RuangAkademikM->getRuangAkademik();
		    $this->load->view('akademik/View_ruangakademik', $data);

			
		}
}
?>