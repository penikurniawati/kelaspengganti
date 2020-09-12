<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilDosenC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_accessuser();
		cekUserDosen();
		$this->load->model('ProfilDosenM');
	}
		

	public function index(){
		$username = $this->session->userdata('user');
		$data['tampilProfilDosen']= $this->ProfilDosenM->getProfilDosen($username);
		$this->load->view('dosen/View_profildosen', $data);
	}

	function editProfilDosen() {
		//get id dosen yang ingin di edit
		$id_dosen = $this->input->post('id_dosen');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama','Nama Dosen','required|xss_clean');
		$this->form_validation->set_rules('jkDosen','Jenis Kelamin','required|xss_clean');
		$this->form_validation->set_rules('tglLahir','Tanggal Lahir','required|xss_clean');
		$this->form_validation->set_rules('noHp','No HP','numeric|required|xss_clean');
		$this->form_validation->set_rules('email','E - mail','required|xss_clean');
		$this->form_validation->set_rules('alamat','alamat','required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "profilDosenR"
			redirect('profilDosenR');
		}
		else
		{
			$nama = $this->input->post('nama');
			$jkDosen = $this->input->post('jkDosen');
			$tglLahir = $this->input->post('tglLahir');
			$noHp = $this->input->post('noHp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			
			//jika inputan sesuai maka masukkan ke database
			$profilDosen =  array(
				"nama_dosen"=>$nama,
				"jk_dosen"=>$jkDosen,
				"tgl_lahir"=>$tglLahir,
				"nohp"=>$noHp,
				"email"=>$email,
				"alamat"=>$alamat,
				"updateDtm"=>date('Y-m-d H:s:i')
			);

			$result = $this->ProfilDosenM->editProfil($profilDosen, $id_dosen);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Profil berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Profil gagal diubah');
			}	
			
			redirect('profilDosenR');
		}
	}

	function ubahPassowrdDosen() {
		//get id user yang akan diubah
		$id_user = $this->input->post('id_user');
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('passlama','Password Lama','required|xss_clean');
		$this->form_validation->set_rules('passbaru1','Password Baru','required|xss_clean');
		$this->form_validation->set_rules('passbaru2','Password Baru','required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "profilDosenR"
			redirect('profilDosenR');
		}
		else
		{
			$passlama = $this->input->post('passlama');
			$passbaru1 = $this->input->post('passbaru1');
			$passbaru2 = $this->input->post('passbaru2');

			//lakukan pengecekan terhadap inputan password lama
			$pass = $this->ProfilDosenM->cekPasswordDosen($id_user);
			// echo $pass;
			// exit();
			if($pass == md5($passlama)){
				//jika pass lama sesuai, 
				if($passbaru1 == $passbaru2){
					//jika pass baru sesuai maka masukkan db
					$dataPassword = array(
					"password"=>md5($passbaru1));

					$result = $this->ProfilDosenM->ubahPasswordDosen($dataPassword, $id_user);

					if($result == TRUE){
						$this->session->set_flashdata('success','Password berhasil diubah');
					}else{
						$this->session->set_flashdata('error','Password gagal diubah');
					}
				}else{
					$this->session->set_flashdata('error','Password baru tidak sesuai');
				}
			}else{
				$this->session->set_flashdata('error','Password lama tidak sesuai');
			}
			
			redirect('profilDosenR');
		}
	}
}
?>