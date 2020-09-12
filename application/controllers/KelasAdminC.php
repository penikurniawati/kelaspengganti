<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelasAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_access();
		cekUserAdmin();
		$this->load->model('KelasAdminM');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}


	public function index(){
		$data['tampilKelasAdmin']= $this->KelasAdminM->getKelasAdmin();
		$data['matkul']= $this->KelasAdminM->getMatkul();
		$data['grup']= $this->KelasAdminM->getGrup();
		$data['dosen']= $this->KelasAdminM->getDosen();
		$this->load->view('admin/View_datakelasadmin', $data);	
	}

	public function detailKelas($idkelas){
		$data['detailKelasMhs']= $this->KelasAdminM->getKelasMahasiswa($idkelas);
		$data['tampilKelasAdmin']= $this->KelasAdminM->getKelas($idkelas);
		$data['mahasiswa']= $this->KelasAdminM->getMhs();
		$this->load->view('admin/View_detailkelasadmin', $data);
	}

	public function inputKelas(){
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namaMatkul','Mata Kuliah','required|xss_clean');
		$this->form_validation->set_rules('namaGrup','Grup','required|xss_clean');
		$this->form_validation->set_rules('namaKelas','Kelas','required|xss_clean');
		$this->form_validation->set_rules('namaDosen','Status','required|xss_clean');
		$this->form_validation->set_rules('statusKelas','Status','required|xss_clean');

		
		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "kelasAdminR"
			redirect('kelasAdminR');
		}
		else
		{
			$namaMatkul = $this->input->post('namaMatkul');
			$namaGrup = $this->input->post('namaGrup');
			$namaKelas = $this->input->post('namaKelas');
			$namaDosen = $this->input->post('namaDosen');
			$statusKelas = $this->input->post('statusKelas');
			
			$cekKelas = $this->KelasAdminM->cekKelas($namaKelas);

			if (!empty($cekKelas)) {
				$this->session->set_flashdata('error', 'Kelas sudah ada');
			}
			//jika nama kelas yang status aktif belum ada
			else{
				$kelasInfo =  array(
					"id_matkul"=>$namaMatkul,
					"id_grup"=>$namaGrup,
					"nama_kelas"=>$namaKelas,
					"status_kelas"=>$statusKelas,
					"createDtm"=>date('Y-m-d H:s:i')
				);

				$result = $this->KelasAdminM->insertKelas($kelasInfo);
				
				$kelasDosen =  array(
					"id_kelas"=>$result,
					"id_dosen"=>$namaDosen,
					"createDtm"=>date('Y-m-d H:s:i')
				);

				$result2 = $this->KelasAdminM->insertKelasDosen($kelasDosen);

				if($result2 > 0)
				{
					$this->session->set_flashdata('success', 'Kelas berhasil dibuat');
				}
				else
				{
					$this->session->set_flashdata('error', 'Kelas gagal dibuat');
				}	
			}
			
			redirect('kelasAdminR');
		}
	}

	public function editKelas(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namaMatkul','Mata Kuliah','required|xss_clean');
		$this->form_validation->set_rules('namaGrup','Grup','required|xss_clean');
		$this->form_validation->set_rules('namaKelas','Kelas','required|xss_clean');
		$this->form_validation->set_rules('namaDosen','Dosen','required|xss_clean');
		$this->form_validation->set_rules('statusKelas','Status','required|xss_clean');

        //get id_dosenkelas
		$id_dosenkelas = $this->input->post('id_dosenkelas');
		
		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "kelasAdminR"
			redirect('mahasiswaAdminR');
		}
		else
		{
			$namaMatkul = $this->input->post('namaMatkul');
			$namaGrup = $this->input->post('namaGrup');
			$namaKelas = $this->input->post('namaKelas');
			$namaDosen = $this->input->post('namaDosen');
			$statusKelas = $this->input->post('statusKelas');

			$result = $this->KelasAdminM->updateKelasDosen($namaMatkul, $namaGrup, $namaKelas, $namaDosen, $statusKelas, $id_dosenkelas);

			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Kelas berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Kelas gagal diubah');
			}	
			
			redirect('kelasAdminR');
		}
		
	}

	function hapusKelas() {
		//get id kelas yang ingin di hapus
		$id_kelas = $this->input->post('id_kelas');

		$cekIdKelas = $this->KelasAdminM->cekIdKelas($id_kelas);

      if (!empty($cekIdKelas)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }
      else{	
			$kelasInfo =  array(
				"isDeleted"=>1,
				"updateDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->KelasAdminM->hapusKelas($kelasInfo, $id_kelas);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Kelas berhasil dihapus');
			}
			else
			{
				$this->session->set_flashdata('error', 'Kelas gagal dihapus');
			}	
			}
			redirect('kelasAdminR');
	}

	public function inputKelasMahasiswa(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_mahasiswa','NIM Mahasiswa','required|xss_clean');
         //trim : tanpa spasi, required : wajib
		$this->form_validation->set_rules('statusMhs','Status Mahasiswa','required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "mahasiswaAdminR"
			redirect('detailKelas/'.$id_kelas);
		}
		else
		{
	        $id_mahasiswa = $this->input->post('id_mahasiswa'); //$variabel bebas deklarasinya
	        $statusMhs = $this->input->post('statusMhs');
	        $id_kelas = $this->input->post('id_kelas');

	        $cekIdM = $this->KelasAdminM->getKelasMahasiswaNim($id_kelas, $id_mahasiswa, $statusMhs);

			//peruntah ini misal NIM ada
	        if( !empty($cekIdM)){
	        	$this->session->set_flashdata('error', 'NIM sudah ada di kelas ini');
	        }
	        else{
				//jika NIM ga ada
	        	$dataKelasMahasiswa =  array(
	        		"id_mahasiswa"=>$id_mahasiswa,
	        		"id_kelas"=>$id_kelas,
	        		"status_km"=>$statusMhs,
	        		"createDtm"=>date('Y-m-d H:s:i')
	        	);

	        	$result = $this->KelasAdminM->insertKelasMahasiswa($dataKelasMahasiswa);

	        	if($result > 0)
	        	{
	        		$this->session->set_flashdata('success', 'Data Mahasiswa Berhasil Ditambahkan');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('error', 'Data Mahasiswa Gagal Ditambahkan');
	        	}
	        }	

	        redirect('detailKelas/'.$id_kelas);
	    }
	}

	public function editKelasMahasiswa(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_mahasiswa','NIM Mahasiswa','required|xss_clean');
		$this->form_validation->set_rules('statusMhs','Status Mahasiswa','required|xss_clean');

        //get id_kelasmahasiswa
		$id_kelasmahasiswa = $this->input->post('id_kelasmahasiswa');
		$id_kelas = $this->input->post('id_kelas');

		// echo $id_kelas;
		// exit();


		if($this->form_validation->run() == FALSE)
		{
			//jika form tidak lengkap maka akan dikembalikan ke route "detailKelas"
			redirect('detailKelas/'. $id_kelas);
		}
		else
		{
			$id_mahasiswa = $this->input->post('id_mahasiswa');
			$statusMhs = $this->input->post('statusMhs');


			$result = $this->KelasAdminM->updateKelasMahasiswa($id_mahasiswa, $statusMhs, $id_kelasmahasiswa);

			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Data Mahasiswa Berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Data Mahasiswa Gagal diubah');
			}

			redirect('detailKelas/'. $id_kelas);
		}
	}

	//function di bawah ini untuk function upload kelas
  private function getIdMatkul($kodeMK, $namaMk){
  	$id = 0;
  	$this->db->where('kode_MK',$kodeMK);
  	$data = $this->db->get('mata_kuliah');
  	if($data->num_rows() == 0){
  		$this->db->insert('mata_kuliah', array("kode_MK"=>$kodeMK,"nama_MK"=>$namaMk));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_mk');
  	}
 		return $id;
	}

	private function getIdDosen($nip, $namaDosen){
  	$id = 0;
  	$this->db->where('nip',$nip);
  	$data = $this->db->get('dosen');
  	if($data->num_rows() == 0){
  		$this->db->insert('dosen', array("nip"=>$nip,"nama_dosen"=>$namaDosen));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_dosen');
  	}
 		return $id;
	}

	private function getIdGrup($namaGrup){
  	$id = 0;
  	$this->db->where('nama_grup',$namaGrup);
  	$data = $this->db->get('grup');
  	if($data->num_rows() == 0){
  		$this->db->insert('grup', array("nama_grup"=>$namaGrup));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_grup');
  	}
 		return $id;
	}

	public function UploadKelas(){
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
            $kelasDitolak= array();
            $kelasDiterima= array();
            $tolak=0;
            $terima=0;
            unlink($inputFileName);
            $jum=0;
            if ($judul[0][0]=="Nama Kelas" && $judul[0][1]=="Kode MK" && $judul[0][2]=="Nama MK" && $judul[0][3]=="NIP Dosen" && $judul[0][4]=="Nama Dosen" && $judul[0][5]=="Nama Grup") {
            	for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                if(!empty($rowData[0][0])){
					        $kelasInfo =  array(
					        	"nama_kelas"=>$rowData[0][0],
										"id_matkul"=>$this->getIdMatkul($rowData[0][1],$rowData[0][2]),
										"id_grup"=>$this->getIdGrup($rowData[0][5]),
										"createDtm"=>date('Y-m-d H:s:i')
									);

                $cekKelas=$this->KelasAdminM->cekKelas($rowData[0][0]);
                if(!empty($cekKelas)){
                	//jika kodeMK sudah ada
                	array_push($kelasDitolak, $rowData[0][0]);
                }else{
                	//jika kodeMK belum ada
                	array_push($kelasDiterima, $rowData[0][0]);
                	//sesuaikan nama dengan nama tabel
                	$this->db->trans_start(); // ini utk get id
                	$this->db->insert("kelas",$kelasInfo);
                	$insert = $this->db->insert_id();
                	$this->db->trans_complete();

                	$kelasDosen =  array(
										"id_kelas"=>$insert,
										"id_dosen"=>$this->getIdDosen($rowData[0][3],$rowData[0][4]),
										"createDtm"=>date('Y-m-d H:s:i')
									);

                	$insert2 = $this->db->insert("kelas_dosen",$kelasDosen);
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
            	$pesanEror = "('Gagal import excel, colomn tidak sesuai!')";
                $this->session->set_flashdata('error', $pesanEror);
            }
            redirect('kelasAdminR');         
    }

    private function getIdMhs($nim, $nama, $jk, $angkatan){
    	$id = 0;
    	$this->db->where('nim',$nim);
    	$data = $this->db->get('mahasiswa');
    	if($data->num_rows() == 0){
    		$this->db->insert('mahasiswa', array("nim"=>$nim,"nama_mahasiswa"=>$nama,"jk_mahasiswa"=>$jk,"angkatan_mahasiswa"=>$angkatan));
    		$id = $this->db->insert_id();
    	}else{
    		$id = $data->row('id_mahasiswa');
    	}
   	return $id;
			// query()->row()
			// return $data->id_mahasiswa;
		}

	public function UploadKelasMahasiswa(){
		$this->load->helper('file');
		$id_kelas  =$this->input->post('id_kelas_import');
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
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $dataKelasMahasiswa = array(
                    "id_mahasiswa"=> $this->getIdMhs($rowData[0][0],$rowData[0][1],$rowData[0][2],$rowData[0][3]),
                    "id_kelas" => $id_kelas,
                    "status_km" => 'Aktif',
                    "createDtm"=>date('Y-m-d H:s:i')
                );
                
                $cekIdM = $this->db->query("SELECT * from kelas_mahasiswa where id_kelas = $id_kelas and id_mahasiswa = ".$dataKelasMahasiswa['id_mahasiswa']."")->num_rows();
                if($cekIdM > 0){
                  //jika kodeMK sudah ada
                  array_push($mahasiswaDitolak, $rowData[0][0]);
                }else{
                  //jika kodeMK belum ada
                  array_push($mahasiswaDiterima, $rowData[0][0]);
                  //sesuaikan nama dengan nama tabel
                  $insert = $this->db->insert("kelas_mahasiswa",$dataKelasMahasiswa);
                  $terima++;
                }

                delete_files($media['file_path']);
                $jum++;
                         
                }
                $highestRow--;
                $pesan = "(".$terima." data berhasil dimasukan dari total ".$highestRow." data!)";
               	$this->session->set_flashdata('success', $pesan);
            }else{
            	$pesanEror = "('Gagal import excel, Kolom tidak sesuai!')";
                $this->session->set_flashdata('error', $pesanEror);
            }
            redirect('detailKelas/'.$id_kelas);         
    }

}
?>