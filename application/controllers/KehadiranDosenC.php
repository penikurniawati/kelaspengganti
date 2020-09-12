<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KehadiranDosenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserDosen();
		$this->load->model('KehadiranDosenM');
	}
		

		public function index(){
			$username = $this->session->userdata('user');
			//ECHO $username;
		    // $data['tampilKehadiranDosen']= $this->KehadiranDosenM->getKehadiranDosen($username);
		    $data['tampilKehadiranDosen']= $this->KehadiranDosenM->getKehadiranDosen1($username);
		    $this->load->view('dosen/View_kehadirandosen', $data);

			
		}
}
?>