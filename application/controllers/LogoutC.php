<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
	}
	
	public function index(){
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('status');	
		$this->session->unset_userdata('akses');	
		$this->session->sess_destroy();
		$this->session->set_flashdata('sukses', 'Anda telah keluar dari Sistem');
		redirect('loginAdmin');
	}
}
?>