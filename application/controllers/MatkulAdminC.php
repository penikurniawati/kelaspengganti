<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MatkulAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		no_access();
		cekUserAdmin();
		$this->load->helper('url');
		$this->load->model('MatkulAdminM');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}
		

	public function index(){
	    $data['tampilMatkulAdmin']= $this->MatkulAdminM->getMatkulAdmin();
	    $this->load->view('admin/View_matkuladmin', $data);
		
	}

	public function inputMatkul(){
		
		$this->load->library('form_validation');
        //untuk form validasi
        $this->form_validation->set_rules('kodeMK','Kode Mata Kuliah','trim|required|xss_clean');
        $this->form_validation->set_rules('namaMK','Nama Mata Kuliah','required|xss_clean');
        $this->form_validation->set_rules('sksMK','SKS Mata Kuliah','required|numeric|xss_clean');
        $this->form_validation->set_rules('kategoriMK','Kategori Mata Kuliah','required|xss_clean');
        $this->form_validation->set_rules('batasPertemuan','Batas Pertemuan','required|numeric|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "matkulAdminR"
			redirect('matkulAdminR');
        }
        else
        {
			$kodeMK = $this->input->post('kodeMK');
			$namaMK = $this->input->post('namaMK');
			$sksMK = $this->input->post('sksMK');
			$kategoriMK = $this->input->post('kategoriMK');
			$batasPertemuan = $this->input->post('batasPertemuan');

			$cekKode = $this->MatkulAdminM->cekKode($kodeMK);
			//jika kode Mk sudah ada
			if( !empty($cekKode)){
				$this->session->set_flashdata('error', 'Kode Mk sudah ada');
			}//jika belum ada maka masukkan data ke database
			else{
			$matkulInfo =  array(
				"kode_MK"=>$kodeMK,
				"nama_MK"=>$namaMK,
				"sks_MK"=>$sksMK,
				"kategori"=>$kategoriMK,
				"batas_pertemuan"=>$batasPertemuan,
				"createDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->MatkulAdminM->insertMatkul($matkulInfo);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Mata Kuliah berhasil dibuat');
			}
			else
			{
				$this->session->set_flashdata('error', 'Mata Kuliah gagal dibuat');
			}
			}	
			
			redirect('matkulAdminR');
		}
	}
	
	function editMatkul() {
		//get id matakuliah yang ingin di edit
		$id_mk = $this->input->post('id_mk');
		
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('namaMK','Nama Mata Kuliah','required|xss_clean');
        $this->form_validation->set_rules('sksMK','SKS Mata Kuliah','required|numeric|xss_clean');
        $this->form_validation->set_rules('kategoriMK','Kategori Mata Kuliah','required');
        $this->form_validation->set_rules('batasPertemuan','Batas Pertemuan','required|numeric|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "matkulAdminR"
			redirect('matkulAdminR');
        }
        else
        {
			$namaMK = $this->input->post('namaMK');
			$sksMK = $this->input->post('sksMK');
			$kategoriMK = $this->input->post('kategoriMK');
			$batasPertemuan = $this->input->post('batasPertemuan');
			
			$matkulInfo =  array(
				"nama_MK"=>$namaMK,
				"sks_MK"=>$sksMK,
				"kategori"=>$kategoriMK,
				"batas_pertemuan"=>$batasPertemuan,
				"updateDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->MatkulAdminM->editMatkul($matkulInfo, $id_mk);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Mata Kuliah berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Mata Kuliah gagal diubah');
			}	
			
			redirect('matkulAdminR');
		}
	}

	function hapusMatkul() {
		//get id matakuliah yang ingin di hapus
		$id_mk = $this->input->post('id_mk');
			//diubah statusnya menjadi isDeleted 1

		$cekIdMatkul = $this->MatkulAdminM->cekIdMatkul($id_mk);

      if (!empty($cekIdMatkul)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }
      else{
			$matkulInfo =  array(
				"isDeleted"=>1,
				"updateDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->MatkulAdminM->hapusMatkul($matkulInfo, $id_mk);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Mata Kuliah berhasil dihapus');
			}
			else
			{
				$this->session->set_flashdata('error', 'Mata Kuliah gagal dihapus');
			}	
			}
			redirect('matkulAdminR');
	}

	public function UploadMatkul(){
		$this->load->helper('file');
		$fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './upload/upload_excel'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = './upload/upload_excel/'.$fileName;
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $judul = $sheet->rangeToArray('A' . 1 . ':' . $highestColumn . 1,NULL,TRUE,FALSE);
            $matkulDitolak= array();
            $matkulDiterima= array();
            $tolak=0;
            $terima=0;
            unlink($inputFileName);
            $jum=0;
            if ($judul[0][0]=="Kode MK" && $judul[0][1]=="Mata Kuliah" && $judul[0][2]=="SKS" && $judul[0][3]=="Kategori" && $judul[0][4]=="Batas Pertemuan") {
            	for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $dataMatkul = array(
                    "kode_MK"=> $rowData[0][0],
                    "nama_MK"=> $rowData[0][1],
                    "sks_MK"=> $rowData[0][2],
                    "kategori"=> $rowData[0][3],
                    "batas_pertemuan"=> $rowData[0][4],
                    "createDtm"=>date('Y-m-d H:s:i')
                );

                $cekKode=$this->MatkulAdminM->cekKode($rowData[0][0]);
                if(!empty($cekKode)){
                	//jika kodeMK sudah ada
                	array_push($matkulDitolak, $rowData[0][0]);
                }else{
                	//jika kodeMK belum ada
                	array_push($matkulDiterima, $rowData[0][0]);
                	//sesuaikan nama dengan nama tabel
                	$insert = $this->db->insert("mata_kuliah",$dataMatkul);
                	$terima++;
                }

                delete_files($media['file_path']);
                $jum++;
                         
                }
                $highestRow--;
                $pesan = "(".$terima." data berhasil dimasukan dari total ".$highestRow." data!)";
               	$this->session->set_flashdata('success', $pesan);
                }else{
            	$pesanEror = "('Gagal import excel, colomn tidak sesuai!')";
                $this->session->set_flashdata('error', $pesanEror);
            }
            redirect('matkulAdminR');         
    }
}
?>