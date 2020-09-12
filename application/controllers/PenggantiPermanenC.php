<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenggantiPermanenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
	}
		

	public function index(){
	    $this->load->view('akademik/View_penggantipermanenakademik');	
	}

	public function penggantiPermanenDosen(){
	    $this->load->view('dosen/View_penggantipermanendosen');	
	}
}
?>