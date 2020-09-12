<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahunAjaranAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		no_access();
		cekUserAdmin();
		$this->load->helper('url');
		$this->load->model('TahunAjaranAdminM');
	}
		

	public function index(){
	    $data['tampilTahunAjaranAdmin']= $this->TahunAjaranAdminM->getTahunAjaranAdmin();
	    $this->load->view('admin/View_tahunajaranadmin', $data);
	}

	public function detailTahunAjaran($id_ta){
		$data['detailTahunAjaranAdmin']= $this->TahunAjaranAdminM->getTahunAjaranAdminDetail($id_ta);
		$data['tampilTahunAjaran']= $this->TahunAjaranAdminM->getTahunAjaran($id_ta);
		$this->load->view('admin/View_detailtahunajaranAdmin', $data);
	}

	public function inputTahunAjaran(){
		$this->load->library('form_validation');
           
        $this->form_validation->set_rules('namaTa','Tahun Ajaran','required|xss_clean');
        $this->form_validation->set_rules('tglMulai','Tanggal Mulai','required|xss_clean');
        $this->form_validation->set_rules('tglTerakhir','Tanggal Terakhir','required|xss_clean');
        $this->form_validation->set_rules('tglUts','Tanggal UTS','required|xss_clean');
        $this->form_validation->set_rules('terakhirUts','Terakhir UTS','required|xss_clean');
        $this->form_validation->set_rules('tglResponsi','Tanggal Responsi','required|xss_clean');
        $this->form_validation->set_rules('terakhirResponsi','Terakhir Responsi','required|xss_clean');
        $this->form_validation->set_rules('tglMingguTenang','Tanggal Minggu Tenang','required|xss_clean');
        $this->form_validation->set_rules('terakhirMingguTenang','Terakhir Minggu Tenang','required|xss_clean');
        $this->form_validation->set_rules('tglUas','Tanggal UAS','required|xss_clean');
        $this->form_validation->set_rules('terakhirUas','Terakhir UAS','required|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "tahunAjaranAdminR"
			redirect('tahunAjaranAdminR');
        }
        else
        {
			$namaTa = $this->input->post('namaTa');
			$tglMulai = $this->input->post('tglMulai');
			$tglTerakhir = $this->input->post('tglTerakhir');
			$tglUts = $this->input->post('tglUts');
			$terakhirUts = $this->input->post('terakhirUts');
			$tglResponsi = $this->input->post('tglResponsi');
			$terakhirResponsi = $this->input->post('terakhirResponsi');
			$tglMingguTenang = $this->input->post('tglMingguTenang');
			$terakhirMingguTenang = $this->input->post('terakhirMingguTenang');
			$tglUas = $this->input->post('tglUas');
			$terakhirUas = $this->input->post('terakhirUas');

			$cekTa = $this->TahunAjaranAdminM->cekTa($namaTa);

			if(!empty($cekTa)){
				$this->session->set_flashdata('error','Tahun Ajaran sudah ada');
			}
			else{
				//kondisi jika tanggal mulai <= tgl selesai maka masukkan db
				if($tglTerakhir >= $tglMulai && $terakhirUts >= $tglUts && $terakhirUas >= $tglUas && $terakhirResponsi >= $tglResponsi && $terakhirMingguTenang >= $tglMingguTenang){
			$TahunAjaranInfo =  array(
				"nama_ta"=>$namaTa,
				"tgl_mulai"=>$tglMulai,
				"tgl_terakhir"=>$tglTerakhir,
				"tgl_mulai_uts"=>$tglUts,
				"tgl_terakhir_uts"=>$terakhirUts,
				"tgl_mulai_responsi"=>$tglResponsi,
				"tgl_terakhir_responsi"=>$terakhirResponsi,
				"tgl_mulai_minggutenang"=>$tglMingguTenang,
				"tgl_terakhir_minggutenang"=>$terakhirMingguTenang,
				"tgl_mulai_uas"=>$tglUas,
				"tgl_terakhir_uas"=>$terakhirUas,
				"createDtm"=>date('Y-m-d H:s:i')
			);

				
			$result = $this->TahunAjaranAdminM->insertTahunAjaran($TahunAjaranInfo);

			//lalu update tahun ajaran yang lain menjadi tidak aktif
			$statusTa = array(
				"status_ta"=>"Tidak Aktif",
			);

			$result = $this->TahunAjaranAdminM->editStatusTa($statusTa, $result);
			}	
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Tahun Ajaran berhasil dibuat');
			}
			else
			{
				$this->session->set_flashdata('error', 'Tahun Ajaran gagal dibuat');
			}
			}
			redirect('tahunAjaranAdminR');
		}
	}
	
	function editTahunAjaran() {
		//get id ta yang ingin di edit
		$id_ta = $this->input->post('id_ta');
		
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('tglMulai','Tanggal Mulai','required|xss_clean');
        $this->form_validation->set_rules('tglTerakhir','Tanggal Terakhir','required|xss_clean');
        $this->form_validation->set_rules('tglUts','Tanggal UTS','required|xss_clean');
        $this->form_validation->set_rules('terakhirUts','Terakhir UTS','required|xss_clean');
        $this->form_validation->set_rules('tglResponsi','Tanggal Responsi','required|xss_clean');
        $this->form_validation->set_rules('terakhirResponsi','Terakhir Responsi','required|xss_clean');
        $this->form_validation->set_rules('tglMingguTenang','Tanggal Minggu Tenang','required|xss_clean');
        $this->form_validation->set_rules('terakhirMingguTenang','Terakhir Minggu Tenang','required|xss_clean');
        $this->form_validation->set_rules('tglUas','Tanggal UAS','required|xss_clean');
        $this->form_validation->set_rules('terakhirUas','Terakhir UAS','required|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
					//jika form tidak lengkap maka akan dikembalikan ke route "matkulAdminR"
					redirect('tahunAjaranAdminR');
        }
        else
        {
					$tglMulai = $this->input->post('tglMulai');
					$tglTerakhir = $this->input->post('tglTerakhir');
				  $tglUts = $this->input->post('tglUts');
				  $terakhirUts = $this->input->post('terakhirUts');
				  $tglResponsi = $this->input->post('tglResponsi');
				  $terakhirResponsi = $this->input->post('terakhirResponsi');
				  $tglMingguTenang = $this->input->post('tglMingguTenang');
				  $terakhirMingguTenang = $this->input->post('terakhirMingguTenang');
				  $tglUas = $this->input->post('tglUas');
				  $terakhirUas = $this->input->post('terakhirUas');
					
					if($tglTerakhir >= $tglMulai && $terakhirUts >= $tglUts && $terakhirUas >= $tglUas && $terakhirResponsi >= $tglResponsi && $terakhirMingguTenang >= $tglMingguTenang){
					$TahunAjaranInfo =  array(
						"tgl_mulai"=>$tglMulai,
						"tgl_terakhir"=>$tglTerakhir,
						"tgl_mulai_uts"=>$tglUts,
						"tgl_terakhir_uts"=>$terakhirUts,
						"tgl_mulai_responsi"=>$tglResponsi,
						"tgl_terakhir_responsi"=>$terakhirResponsi,
						"tgl_mulai_minggutenang"=>$tglMingguTenang,
						"tgl_terakhir_minggutenang"=>$terakhirMingguTenang,
						"tgl_mulai_uas"=>$tglUas,
						"tgl_terakhir_uas"=>$terakhirUas,
						"updateDtm"=>date('Y-m-d H:s:i')
					);
				
				$result = $this->TahunAjaranAdminM->editTahunAjaran($TahunAjaranInfo, $id_ta);
				}
				if($result == TRUE)
				{
					$this->session->set_flashdata('success', 'Tahun Ajaran berhasil diubah');
				}
				else
				{
					$this->session->set_flashdata('error', 'Tahun Ajaran gagal diubah');
				}	
				redirect('tahunAjaranAdminR');
		}
	}

	function aktifasiTahunAjaran($id_ta) {	
	//aktifkan status ta yang dipilih				
		$aktifasiTa =  array(
			"status_ta"=>"Aktif",
			"updateDtm"=>date('Y-m-d H:s:i')
		);
	
	$result = $this->TahunAjaranAdminM->aktifasiStatusTa($aktifasiTa, $id_ta);

	//non aktif setatus ta yang lain
	$statusTa =  array(
			"status_ta"=>"Tidak Aktif",
			"updateDtm"=>date('Y-m-d H:s:i')
		);
	
	$result = $this->TahunAjaranAdminM->editStatusTa($statusTa, $id_ta);
	
	if($result == TRUE)
	{
		$this->session->set_flashdata('success', 'Aktifasi berhasil');
	}
	else
	{
		$this->session->set_flashdata('error', 'Aktifasi gagal');
	}	
	
	redirect('tahunAjaranAdminR');
}

	 function hapusTahunAjaran() {
    //get id ta yang ingin di hapus
    $id_ta = $this->input->post('id_ta');

    $cekIdTa = $this->TahunAjaranAdminM->cekIdTa($id_ta);

    if (!empty($cekIdTa)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }else{
      $TahunAjaranInfo =  array(
        "isDeleted"=>1,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->TahunAjaranAdminM->hapusTahunAjaran($TahunAjaranInfo, $id_ta);
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Tahun Ajaran berhasil dihapus');
      }
      else
      {
        $this->session->set_flashdata('error', 'Tahun Ajaran gagal dihapus');
      } 
      }
      redirect('tahunAjaranAdminR');
  }
}
?>