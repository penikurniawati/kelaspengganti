<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		no_access();
		cekUserAdmin();
		$this->load->helper('url');
		$this->load->model('DosenAdminM');
	}


	public function index(){
		$data['tampilDosenAdmin']= $this->DosenAdminM->getDosenAdmin();
		$this->load->view('admin/View_dosenadmin', $data);


	}

	function editDosen() {
		//get id dosen yang ingin di edit
		$id_dosen = $this->input->post('id');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama','Nama Dosen','required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "dosenAdminR"
			redirect('dosenAdminR');
		}
		else
		{
			$nama = $this->input->post('nama');
			$jk = $this->input->post('jk');
			$ttl = $this->input->post('ttl');
			$nohp = $this->input->post('nohp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			
			$dataDosen =  array(
				"nama_dosen"=>$nama,
				"jk_dosen"=>$jk,
				"tgl_lahir"=>$ttl,
				"nohp"=>$nohp,
				"email"=>$email,
				"alamat"=>$alamat,
				"updateDtm"=>date('Y-m-d H:s:i')
			);

			$result = $this->DosenAdminM->editDosen($dataDosen, $id_dosen);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Dosen berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Dosen gagal diubah');
			}	
			
			redirect('dosenAdminR');
		}
	}
}
?>