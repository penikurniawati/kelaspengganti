<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		no_access();
		cekUserAdmin();
		$this->load->helper('url');
		$this->load->model('MahasiswaAdminM');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}


	public function index(){
		$nama = $this->input->post('nama');
		$niu = $this->input->post('niu');
		$angkatan1 = $this->input->post('angkatan1');
		$angkatan2 = $this->input->post('angkatan2');
		$data['tampilMahasiswaAdmin']= $this->MahasiswaAdminM->getMahasiswaAdmin($nama, $angkatan1, $angkatan2, $niu);
		$data['angkatan']= $this->MahasiswaAdminM->getAngkatanMhs();
		$this->load->view('admin/View_mahasiswaadmin', $data);
	}

	public function inputMahasiswa(){
		$this->load->library('form_validation');

        //nip = sesuai name di view   
        $this->form_validation->set_rules('nim','NIM Mahasiswa','trim|required|xss_clean'); //trim : tanpa spasi, required : wajib
        $this->form_validation->set_rules('nama','Nama Mahasiswa','required|xss_clean');
        $this->form_validation->set_rules('jk','JK Mahasiswa','required|xss_clean');
        $this->form_validation->set_rules('angkatan','Angkatan Mahasiswa','required|xss_clean');

        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "mahasiswaAdminR"
        	redirect('mahasiswaAdminR');
        }
        else
        {
	        $nim = $this->input->post('nim'); //$variabel bebas deklarasinya
	        $nama = $this->input->post('nama');
	        $jk = $this->input->post('jk');
	        $angkatan = $this->input->post('angkatan');

	        $cekNim = $this->MahasiswaAdminM->cekNim($nim);

			//peruntah ini misal NIM ada
	        if( !empty($cekNim)){
	        	$this->session->set_flashdata('error', 'NIM sudah ada');
	        }
	        else{
				//jika NIM ga ada
	        	$dataMahasiswa =  array(
				"nim"=>$nim, //"nim" harus sama dengan db, $nim boleh beda
				"nama_mahasiswa"=>$nama,
				"jk_mahasiswa"=>$jk,
				"angkatan_mahasiswa"=>$angkatan,
				"createDtm"=>date('Y-m-d H:s:i')
			);

	        	$result = $this->MahasiswaAdminM->insertMahasiswa($dataMahasiswa);

	        	if($result > 0)
	        	{
	        		$this->session->set_flashdata('success', 'Data Mahasiswa Berhasil Ditambahkan');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('error', 'Data Mahasiswa Gagal Ditambahkan');
	        	}
	        }	

	        redirect('mahasiswaAdminR');
	      }
	    }

	    public function ubahMahasiswa(){
	    	$this->load->library('form_validation');

        // $this->form_validation->set_rules('nim','NIM Mahasiswa','trim|required|xss_clean');
	    	$this->form_validation->set_rules('nama','Nama Mahasiswa','required|xss_clean');
	    	$this->form_validation->set_rules('jk','JK Mahasiswa','required|xss_clean');
	    	$this->form_validation->set_rules('angkatan','Angkatan Mahasiswa','required|xss_clean');

	    	if($this->form_validation->run() == FALSE)
	    	{
			//jika form tidak lengkap maka akan dikembalikan ke route "mahasiswaAdminR"
	    		redirect('mahasiswaAdminR');
	    	}
	    	else
	    	{
	    		$id = $this->input->post('id');
	    		$nama = $this->input->post('nama');
	    		$jk = $this->input->post('jk');
	    		$angkatan = $this->input->post('angkatan');

	    		$cekNim = $this->MahasiswaAdminM->cekNim($nim);

			//perintah ini misal NIM ada
	    		if( !empty($cekNim)){
	    			$this->session->set_flashdata('error', 'NIM sudah ada');
	    		}
	    		else{
				//jika NIM ga ada
	    			$dataMahasiswa =  array(
				// "nim"=>$nim,
	    				"nama_mahasiswa"=>$nama,
	    				"jk_mahasiswa"=>$jk,
	    				"angkatan_mahasiswa"=>$angkatan,
	    				"updateDtm"=>date('Y-m-d H:s:i')
	    			);


	    			$result = $this->MahasiswaAdminM->ubahMahasiswa($dataMahasiswa,$id);

	    			if($result == true)
	    			{
	    				$this->session->set_flashdata('success', 'Mahasiswa berhasil diubah');
	    			}
	    			else
	    			{
	    				$this->session->set_flashdata('error', 'Mahasiswa gagal diubah');
	    			}
	    		}	

	    		redirect('mahasiswaAdminR');
	    	}
	    }

	    function hapusMahasiswa() {
			//get id matakuliah yang ingin di hapus
	    $id_mahasiswa = $this->input->post('id_mahasiswa');

			$cekIdMahasiswa = $this->MahasiswaAdminM->cekIdMahasiswa($id_mahasiswa);

      if (!empty($cekIdMahasiswa)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }
      else{
	    	$dataMahasiswa =  array(
	    		"isDeleted"=>1,
	    		"updateDtm"=>date('Y-m-d H:s:i')
	    	);

	    	$result = $this->MahasiswaAdminM->hapusMahasiswa($dataMahasiswa, $id_mahasiswa);

	    	if($result == TRUE)
	    	{
	    		$this->session->set_flashdata('success', 'Mahasiswa berhasil dihapus');
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('error', 'Mahasiswa gagal dihapus');
	    	}	
	    }
	    	redirect('mahasiswaAdminR');
	    }

	    public function UploadMahasiswa(){
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
        $mahasiswaDitolak = array();
        $mahasiswaDiterima = array();
        $tolak = 0;
        $terima = 0;
        unlink($inputFileName);
        $jum=0;
        if ($judul[0][0]=="NIM" && $judul[0][1]=="Nama" && $judul[0][2]=="JK" && $judul[0][3]=="Angkatan") {
            	for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 

            		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
            			NULL,
            			TRUE,
            			FALSE);

            		if(!empty($rowData[0][0])){
                //Sesuaikan sama nama kolom tabel di database                                
            		$dataMhs = array(
            			"nim"=> $rowData[0][0],
            			"nama_mahasiswa"=>  $rowData[0][1],
            			"jk_mahasiswa"=> $rowData[0][2],
            			"angkatan_mahasiswa"=> $rowData[0][3],
            			"createDtm"=>date('Y-m-d H:s:i')
            		);

            		$cekNimUpload=$this->MahasiswaAdminM->cekNimUpload($rowData[0][0]);
            		if(!empty($cekNimUpload)){
                  //jika kodeMK sudah ada
            			array_push($mahasiswaDitolak, $rowData[0][0]);
            		}else{
                  //jika kodeMK belum ada
            			array_push($mahasiswaDiterima, $rowData[0][0]);
                  //sesuaikan nama dengan nama tabel
            			$insert = $this->db->insert("mahasiswa",$dataMhs);
            			$terima++;
            		}

            		delete_files($media['file_path']);
            		$jum++;
            		}

            	}
            	$highestRow--;
            	$pesan = "(".$terima." data berhasil dimasukan dari total ".$highestRow." data!)";
            	$this->session->set_flashdata('success', $pesan);
            }else{
            	$pesanEror = "('Gagal import excel, Kolom tidak sesuai!')";
            	$this->session->set_flashdata('error', $pesanEror);
            }
            redirect('mahasiswaAdminR');         
          }

        }
        ?>