<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MatkulDosenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserDosen();
		$this->load->model('MatkulDosenM');
	}
		

		public function index(){
			$username = $this->session->userdata('user');
		    $data['tampilMatkulDosen']= $this->MatkulDosenM->getMatkulDosenU($username);
		    $this->load->view('dosen/View_matkuldosen', $data);

			
		}
}
?>