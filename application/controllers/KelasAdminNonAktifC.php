<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasAdminNonAktifC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_access();
    cekUserAdmin();
		$this->load->model('KelasAdminNonAktifM');
	}


	public function index(){
		$data['tampilKelasAdminAktif']= $this->KelasAdminNonAktifM->getKelasAktifAdmin();
		$this->load->view('admin/View_datakelasadminaktif', $data);	
	}

	function nonAktifKelas() {
    $id_kelas = $this->input->post('nonaktif');
      
      //jika idkelas yang dipilih ada maka ubah statusnya menjadi tidak aktif
      if(!empty($id_kelas)){
      	foreach ($id_kelas as $id) {
      		 $statusKelas =  array(
        "status_kelas"=>"Tidak Aktif"
      	);
        //$result adalah hasil dari perubahan status dimana function didapat dari modal
      	$result = $this->KelasAdminNonAktifM->ubahstatusKelas($statusKelas,$id);
      	}
      	
      }
     
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Kelas berhasil di nonaktifkan');
      }
      else
      {
        $this->session->set_flashdata('error', 'Kelas gagal di nonaktifkan');
      } 
      
      redirect('nonaktifKelas');
  }
}
?>