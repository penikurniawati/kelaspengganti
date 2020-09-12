<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardAdminC extends CI_Controller{
  
  function __construct(){
    parent:: __construct();
    no_access();
    cekUserAdmin();
    $this->load->helper('url');
    $this->load->model('DashboardAdminM');
  }
    

  public function index(){
      $data['jumlahDosen']= $this->DashboardAdminM->jmlDosen();
      $data['jumlahKelas']= $this->DashboardAdminM->jmlKelas();
      $data['jumlahRuang']= $this->DashboardAdminM->jmlRuang();
      $data['jumlahMatkul']= $this->DashboardAdminM->jmlMatkul();
      $this->load->view('admin/View_dashboardadmin', $data); 
  }

}
?>