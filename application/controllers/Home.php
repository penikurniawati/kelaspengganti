<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->helper('url');
	}

	// var $data= array();

	public function index()
	{
		redirect("loginUserR");
	}
}
