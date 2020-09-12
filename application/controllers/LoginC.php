<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		in_access();

		//ini untuk memanggil model
		$this->load->model('LoginM');
	}
		
	public function index(){
		//load view untuk halaman login
	 	 $this->load->view('View_login');
	}

	//function untuk validasi login
	public function signin(){
	 	$username_admin=$this->input->post('username_admin');
	 	$password_admin=$this->input->post('password_admin');
		$this->load->model('LoginM');
		$ceknum=$this->LoginM->ceknum($username_admin,md5($password_admin))->num_rows();
		if($ceknum>0){
			$this->session->set_userdata('user', $username_admin);
			$this->session->set_userdata('status',"loginSukses");
			$this->session->set_userdata('akses',"admin");
			redirect('dashboardAdminR');
		}else{
			$this->session->set_flashdata('error','Username atau password salah');
			redirect('loginAdmin');
		}
	}	
}
?>