<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class waktuAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		no_access();
		cekUserAdmin();
		$this->load->helper('url');
		$this->load->model('WaktuAdminM');
	}
		

	public function index(){
	    $data['tampilWaktuAdmin']= $this->WaktuAdminM->getWaktuAdmin();
	    $this->load->view('admin/View_waktuadmin', $data);
	}

	public function inputWaktu(){
		$this->load->library('form_validation');
           
        $this->form_validation->set_rules('hari','Hari','required|xss_clean');
        $this->form_validation->set_rules('sesi','Sesi','required|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "waktuAdminR"
			redirect('waktuAdminR');
        }
        else
        {
			$hari = $this->input->post('hari');
			$sesi = $this->input->post('sesi');

			$waktuInfo =  array(
				"hari"=>$hari,
				"jam"=>$sesi,
				"createDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->WaktuAdminM->insertWaktu($waktuInfo);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Waktu berhasil dibuat');
			}
			else
			{
				$this->session->set_flashdata('error', 'Waktu gagal dibuat');
			}
			
			redirect('waktuAdminR');
		}
	}
	
	function editWaktu() {
		//get id matakuliah yang ingin di edit
		$id_waktu = $this->input->post('id_waktu');
		
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('hari','Hari','required|xss_clean');
        $this->form_validation->set_rules('sesi','Sesi','required|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "waktuAdminR"
			redirect('waktuAdminR');
        }
        else
        {
			$hari = $this->input->post('hari');
			$sesi = $this->input->post('sesi');
			
			$waktuInfo =  array(
				"hari"=>$hari,
				"jam"=>$sesi,
				"updateDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->WaktuAdminM->editWaktu($waktuInfo, $id_waktu);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Waktu berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Waktu gagal diubah');
			}	
			
			redirect('waktuAdminR');
		}
	}

	 function hapusWaktu() {
    //get id waktu yang ingin di hapus
    $id_waktu = $this->input->post('id_waktu');

    $cekIdWaktu = $this->WaktuAdminM->cekIdWaktu($id_waktu);

      if (!empty($cekIdWaktu)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }
      else{  
      $waktuInfo =  array(
        "isDeleted"=>1,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->WaktuAdminM->hapusWaktu($waktuInfo, $id_waktu);
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Waktu berhasil dihapus');
      }
      else
      {
        $this->session->set_flashdata('error', 'Waktu gagal dihapus');
      } 
      }
      redirect('waktuAdminR');
  }
}
?>