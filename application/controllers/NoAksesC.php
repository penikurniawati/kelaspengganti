<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NoAksesC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
	}
		

		public function index(){
			$this->load->view('View_noakses');
		}
		public function cekRole(){
			if ($this->session->userdata('akses')=='admin') {
        redirect('loginAdmin');
    	} else {
    		redirect('loginUserR');
    	}
		}
}
?>