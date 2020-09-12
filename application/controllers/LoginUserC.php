<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginUserC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		in_accessuser();

		$this->load->model('LoginUserM');
	}
		
	public function index(){
	 	 $this->load->view('View_loginuser');
	}

	public function signin(){
	 	$username=$this->input->post('username');
	 	$password=$this->input->post('password');
		$this->load->model('LoginUserM');
		$cekusernamepass=$this->LoginUserM->cekusernamepass($username,md5($password))->num_rows();
		 // jadi nanti isinya cuma 1 apa 2 gtu
		$cekuser=$this->LoginUserM->cekusernamepass($username,md5($password))->result();
		if($cekusernamepass>0){
			$id_userrole=$cekuser[0]->id_userrole;//index ke 0
			$nama=$cekuser[0]->nama;
			$this->session->set_userdata('user', $username);
			$this->session->set_userdata('id_userrole', $id_userrole);
			$this->session->set_userdata('nama', $nama);
			$this->session->set_userdata('status',"loginSukses");
			if ($id_userrole==1) {
				redirect('jadwalAkademikR');
			}
			else if ($id_userrole==2) {
				redirect('jadwalDosenR');
			}
		}else{
			$this->session->set_flashdata('error','Username atau password salah');
			redirect('loginUserR');
		}
	 	 	
	}

	function logout(){	
		//$this->load->driver('cache');
 	 	$this->session->unset_userdata('user');
 	 	$this->session->unset_userdata('status');	
 	 	$this->session->set_flashdata('sukses', 'Anda telah keluar dari Sistem');
 	 	//$this->session->sess_destroy();
 	 	//$this->cache->clean();
 	 	redirect('loginUserR');	
	}
}
?>