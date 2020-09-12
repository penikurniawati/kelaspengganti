<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalAdminC extends CI_Controller{
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		no_access();
		cekUserAdmin();
		$this->load->model('JadwalAdminM');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}
	
	public function index(){
		$data['tampilHari']=$this->input->post('inputhari');
		// 2 variabel atas paling penting
		//$data['tampilJadwalAdmin']= $this->JadwalAdminM->getJadwalAdmin();
		$data['tampilRuangAdmin']=$this->JadwalAdminM->getJadwalAdmin();
		$data['waktu']= $this->JadwalAdminM->getWaktu();
		$data['matkul']= $this->JadwalAdminM->getMatkul();
		$data['ruang']= $this->JadwalAdminM->getRuang();
		$data['tahun']= $this->JadwalAdminM->getTa();
		$data['kelas']= $this->JadwalAdminM->getKelas();
		$data['tampilWaktuAdmin']=$this->JadwalAdminM->getWaktuAdmin();
		$this->load->view('admin/View_jadwaladmin', $data);
	}

	public function inputJadwal(){
		$this->load->library('form_validation');
  
        $this->form_validation->set_rules('kelas','Kelas','required|xss_clean');
        $this->form_validation->set_rules('waktu','Waktu','required|xss_clean');
        $this->form_validation->set_rules('ruang','Ruang','required|xss_clean');
        $this->form_validation->set_rules('tahun','Tahun Ajaran','required|xss_clean');

        if($this->form_validation->run() == FALSE)
        {
        	redirect('jadwalAdminR');
        }
        else
        {
	        $kelas = $this->input->post('kelas');
	        $waktu = $this->input->post('waktu');
	        $ruang = $this->input->post('ruang');
	        $tahun = $this->input->post('tahun');

	        $cekJadwal = $this->JadwalAdminM->cekJadwal($waktu);
	        $cekKelas = $this->JadwalAdminM->cekKelas($waktu, $kelas);
	        $cekRuang = $this->JadwalAdminM->cekRuang($waktu, $kelas, $ruang);

	      $dataJadwal =  array(
				"id_kelas"=>$kelas,
				"id_waktu"=>$waktu,
				"id_ruang"=>$ruang,
				"id_ta"=>$tahun,
				"createDtm"=>date('Y-m-d H:s:i')
			);

	        	$result = $this->JadwalAdminM->insertJadwal($dataJadwal);

	        	if($result > 0)
	        	{
	        		$this->session->set_flashdata('success', 'Jadwal Berhasil Ditambahkan');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('error', 'Jadwal Gagal Ditambahkan');
	        	}
	        redirect('jadwalAdminR');
	    }
	}

	function ubahJadwal() {
		//get id jadwal yang ingin di edit
		$id = $this->input->post('id');
		
		$this->load->library('form_validation');
		
        $this->form_validation->set_rules('waktu','Waktu Jadwal','required|xss_clean');
        $this->form_validation->set_rules('kelas','Kelas Jadwal','required|xss_clean');
        $this->form_validation->set_rules('ruang','Ruang Jadwal','required|xss_clean');
        $this->form_validation->set_rules('tahun','Tahun Jadwal','required|xss_clean');
		
        if($this->form_validation->run() == FALSE)
        {
			//jika form tidak lengkap maka akan dikembalikan ke route "jadwalAdminR"
			redirect('jadwalAdminR');
        }
        else
        {
			$waktu = $this->input->post('waktu');
			$kelas = $this->input->post('kelas');
			$ruang = $this->input->post('ruang');
			$tahun = $this->input->post('tahun');
			
			$dataJadwal =  array(
				"id_waktu"=>$waktu,
				"id_kelas"=>$kelas,
				"id_ruang"=>$ruang,
				"id_ta"=>$tahun,
				"updateDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->JadwalAdminM->ubahJadwal($dataJadwal, $id);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Jadwal berhasil diubah');
			}
			else
			{
				$this->session->set_flashdata('error', 'Jadwal gagal diubah');
			}	
			
			redirect('jadwalAdminR');
		}
	}

	function hapusJadwal() {
		//get id jadwal yang ingin di hapus
		$id = $this->input->post('id');

			$dataJadwal =  array(
				"isDeleted"=>1,
				"updateDtm"=>date('Y-m-d H:s:i')
			);
				
			$result = $this->JadwalAdminM->ubahJadwal($dataJadwal, $id);
			
			if($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Jadwal berhasil dihapus');
			}
			else
			{
				$this->session->set_flashdata('error', 'Jadwal gagal dihapus');
			}	
			
			redirect('jadwalAdminR');
	}

	//function di bawah ini digunakan di function upload jadwal
	private function getIdDosen($nama){
		$this->load->helper('string');
		$id = 0;
  	$this->db->where('nama_dosen',$nama);
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('dosen');
  	//jika data dosen belum ada di db maka dimasukkan
  	if($data->num_rows() == 0){
  		$this->db->insert('dosen', array("nip"=>"akademik", "nama_dosen"=>$nama, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_dosen');
  	}
 		return $id;
	}
	private function getIdDosenKelas($id_dosen,$id_kelas){
		$id = 0;
  	$this->db->where('id_dosen',$id_dosen);
  	$this->db->where('id_kelas',$id_kelas);
  	$data = $this->db->get('kelas_dosen');
  	if($data->num_rows() == 0){
  		$this->db->insert('kelas_dosen', array("id_kelas"=>$id_kelas, "id_dosen"=>$id_dosen, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_dosenkelas');
  	}
 		return $id;
	}
	private function getIdMatkul($kode_MK, $nama_MK){
  	$id = 0;	
  	$this->db->where('kode_MK',$kode_MK);
  	//$this->db->where('nama_MK',$nama_MK);
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('mata_kuliah');
  	if($data->num_rows() == 0){
  		$this->db->insert('mata_kuliah', array("kode_MK"=>$kode_MK, "nama_MK"=>$nama_MK, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_mk');
  	}
 		return $id;
	}

	private function getIdGrup($nama_grup){
  	$id = 0;
  	$this->db->where('nama_grup',$nama_grup);
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('grup');
  	if($data->num_rows() == 0){
  		$this->db->insert('grup', array("nama_grup"=>$nama_grup, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_grup');
  	}
 		return $id;
	}

	private function getIdKelas($nama_kelas, $idGrup, $idMatkul){
  	$id = 0;
  	$this->db->where('nama_kelas',$nama_kelas);
  	$this->db->where('status_kelas','Aktif');
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('kelas');
  	if($data->num_rows() == 0){
  		$this->db->insert('kelas', array("nama_kelas"=>$nama_kelas, "id_grup"=>$idGrup, "id_matkul"=>$idMatkul, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_kelas');
  	}
 		return $id;
	}

	private function getIdRuang($nama_ruang){
  	$id = 0;
  	$this->db->where('nama_ruang',$nama_ruang);
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('ruang');
  	if($data->num_rows() == 0){
  		$this->db->insert('ruang', array("nama_ruang"=>$nama_ruang, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_ruang');
  	}
 		return $id;
	}

	private function getIdWaktu($hari, $jam){
  	$id = 0;
  	$this->db->where('jam',$jam);
  	$this->db->where('hari',$hari);
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('waktu');
  	if($data->num_rows() == 0){
  		$this->db->insert('waktu', array("jam"=>$jam, "hari"=>$hari, "createDtm"=>date('Y-m-d H:s:i')));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_waktu');
  	}
 		return $id;
	}
	private function insertJadwal1($hari, $jam){
  	$id = 0;
  	$this->db->where('jam',$jam);
  	$this->db->where('hari',$hari);
  	$this->db->where('isDeleted',0);
  	$data = $this->db->get('waktu');
  	if($data->num_rows() == 0){
  		$this->db->insert('waktu', array("jam"=>$jam, "hari"=>$hari));
  		$id = $this->db->insert_id();
  	}else{
  		$id = $data->row('id_waktu');
  	}
 		return $id;
	}

	private function qc_1 ($data,$highestRow,$highestColumn,$id_ta)
	{
		for ($i=0; $i < count($data); $i++) { 
			$idGrup = $this->getIdGrup($data[$i][9]);
  		$idMatkul = $this->getIdMatkul($data[$i][1], $data[$i][2]);		
  		$idKelas = $this->getIdKelas($data[$i][4], $idGrup, $idMatkul);
			$isi[$i] = $this->db->query("SELECT id_jadwal FROM jadwal WHERE jadwal.id_ta=$id_ta AND jadwal.id_kelas=$idKelas")->result_array();
		}
		$st = "";
		foreach ($isi as $value) {
			foreach ($value as $a) {
				$st = $st.$a["id_jadwal"].",";
			}
		}
		if ($st != "") {
			$st[strlen($st)-1]='';
		  $ids_exp = explode(',',$st);
	    $this->db->where_in('id_jadwal',$ids_exp);//
	    $this->db->delete('jadwal');
	    return $this->db->affected_rows();
		}
		
	}

	public function UploadJadwal(){			
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
        $jadwalDitolak = array();
        $jadwalDiterima = array();
        $tolak = 0;
        $terima = 0;
        unlink($inputFileName);
        $jum=0;
        $tahunAjaran = $this->JadwalAdminM->getTa();
        if(!empty($tahunAjaran)){
        if ($judul[0][0]=="NO." && $judul[0][1]=="KODE" && $judul[0][2]=="NAMA" && $judul[0][3]=="PAKET SEMESTER" && $judul[0][4]=="KELAS" && $judul[0][5]=="SKS" && $judul[0][6]=="DOSEN" && $judul[0][7]=="RUANG" && $judul[0][8]=="JUMLAH PESERTA" && $judul[0][9]=="GRUP" && $judul[0][10]=="Senin" && $judul[0][11]=="Selasa" && $judul[0][12]=="Rabu" && $judul[0][13]=="Kamis" && $judul[0][14]=="Jumat") {
        			// echo 'Berhasil';
        			// exit();
        			  $rows= $sheet->rangeToArray('A2:' . $highestColumn . $highestRow,NULL,TRUE,FALSE);
        			  $this->qc_1($rows,$highestRow,$highestColumn,$tahunAjaran[0]->id_ta);            	

            	for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
            		
            		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
            			NULL,
            			TRUE,
            			FALSE);

            		if(!empty($rowData[0][0])){
            		$idGrup = $this->getIdGrup($rowData[0][9]);
            		$idMatkul = $this->getIdMatkul($rowData[0][1], $rowData[0][2]);
            		$idDosen = $this->getIdDosen($rowData[0][6]);
            		$idKelas = $this->getIdKelas($rowData[0][4], $idGrup, $idMatkul);
            		$idDosenKelas = $this->getIdDosenKelas($idDosen,$idKelas);
            		//echo $this->getIdWaktu($rowData[0][9]);
            		$idRuang = $this->getIdRuang($rowData[0][7]);

            		if($rowData[0][10] != NULL){
            			$idWaktu = $this->getIdWaktu('Senin', $rowData[0][10]);
            			//echo $idWaktu;
            			 //Sesuaikan sama nama kolom tabel di database                                
	            		$dataJadwal = array(
	            			"id_kelas"=>$idKelas,
	            			"id_waktu"=>$idWaktu,
	            			"id_ruang"=>$idRuang,
	            			"id_ta"=> $tahunAjaran[0]->id_ta,
	            			"createDtm"=>date('Y-m-d H:s:i')
	            		);

	            		$cek = $this->cek2($idKelas,$idWaktu,$tahunAjaran[0]->id_ta);
	            		if ($cek == 0) {
	            			array_push($jadwalDiterima, $rowData[0][0]);
	            			$insert = $this->db->insert("Jadwal",$dataJadwal);
	            			$terima++;
	            		}
            		}
            		if($rowData[0][11] != ''){
            			$idWaktu = $this->getIdWaktu('Selasa', $rowData[0][11]);

            		// 	//Sesuaikan sama nama kolom tabel di database                                
	            		$dataJadwal = array(
	            			"id_kelas"=>$idKelas,
	            			"id_waktu"=>$idWaktu,
	            			"id_ruang"=>$idRuang,
	            			"id_ta"=> $tahunAjaran[0]->id_ta,
	            			"createDtm"=>date('Y-m-d H:s:i')
	            		);

	            		$cek = $this->cek2($idKelas,$idWaktu,$tahunAjaran[0]->id_ta);
	            		if ($cek == 0) {
	            			array_push($jadwalDiterima, $rowData[0][0]);
	            			$insert = $this->db->insert("Jadwal",$dataJadwal);
	            			$terima++;
	            		}
            		}
            		if($rowData[0][12] != ''){
            			$idWaktu = $this->getIdWaktu('Rabu', $rowData[0][12]);

            			//Sesuaikan sama nama kolom tabel di database                                
	            		$dataJadwal = array(
	            			"id_kelas"=>$idKelas,
	            			"id_waktu"=>$idWaktu,
	            			"id_ruang"=>$idRuang,
	            			"id_ta"=> $tahunAjaran[0]->id_ta,
	            			"createDtm"=>date('Y-m-d H:s:i')
	            		);

									$cek = $this->cek2($idKelas,$idWaktu,$tahunAjaran[0]->id_ta);
	            		if ($cek == 0) {
	            			array_push($jadwalDiterima, $rowData[0][0]);
	            			$insert = $this->db->insert("Jadwal",$dataJadwal);
	            			$terima++;
	            		}
            		}
            		if($rowData[0][13] != ''){
            			$idWaktu = $this->getIdWaktu('Kamis', $rowData[0][13]);

            			//Sesuaikan sama nama kolom tabel di database                                
	            		$dataJadwal = array(
	            			"id_kelas"=>$idKelas,
	            			"id_waktu"=>$idWaktu,
	            			"id_ruang"=>$idRuang,
	            			"id_ta"=> $tahunAjaran[0]->id_ta,
	            			"createDtm"=>date('Y-m-d H:s:i')
	            		);

	            		$cek = $this->cek2($idKelas,$idWaktu,$tahunAjaran[0]->id_ta);
	            		if ($cek == 0) {
	            			array_push($jadwalDiterima, $rowData[0][0]);
	            			$insert = $this->db->insert("Jadwal",$dataJadwal);
	            			$terima++;
	            		}
            		}
            		if($rowData[0][14] != ''){
            			$idWaktu = $this->getIdWaktu('Jumat', $rowData[0][14]);

            			//Sesuaikan sama nama kolom tabel di database                                
	            		$dataJadwal = array(
	            			"id_kelas"=>$idKelas,
	            			"id_waktu"=>$idWaktu,
	            			"id_ruang"=>$idRuang,
	            			"id_ta"=> $tahunAjaran[0]->id_ta,
	            			"createDtm"=>date('Y-m-d H:s:i')
	            		);

	            		$cek = $this->cek2($idKelas,$idWaktu,$tahunAjaran[0]->id_ta);
	            		if ($cek == 0) {
	            			array_push($jadwalDiterima, $rowData[0][0]);
	            			$insert = $this->db->insert("Jadwal",$dataJadwal);
	            			$terima++;
	            		}
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
          }
          else{
          	$this->session->set_flashdata('error', 'Tauhun ajaran belum dibuat');
          }
            redirect('jadwalAdminR');         
          }
  private function cek2($kelas,$waktu,$tahun)
  {
  	$jum = $this->db->query("SELECT * FROM (SELECT j.id_waktu FROM jadwal j WHERE id_kelas IN (SELECT id_kelas FROM kelas_dosen WHERE id_dosen = (SELECT a.id_dosen FROM kelas_dosen as a WHERE a.id_kelas = $kelas)) AND j.id_ta =$tahun) as w where id_waktu = $waktu")->num_rows();
  	return $jum;	
  }

	public function ajax_getDataEdit()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}

		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * from jadwal where id_jadwal = $id")->row();
		echo json_encode($data);
	}

	public function ajax_getDataHapus()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}

		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * from jadwal where id_jadwal = $id")->row();
		echo json_encode($data);
	}

	//validasi tambah jadwal
	public function ajax_cekValidateAddJadwal()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}

		$kelas = $this->input->post('kelas');
		$ruang = $this->input->post('ruang');
		$waktu = $this->input->post('waktu');
		$tahun = $this->input->post('tahun');

		$this->db->where('id_ta',$tahun);
		$this->db->where('id_ruang',$ruang);
		$this->db->where('id_waktu',$waktu);
		$this->db->where('isDeleted',0);
		$cek1 = $this->db->get('jadwal')->num_rows();
		if ($cek1 == 0) {
			$jum = $this->db->query("SELECT * FROM (SELECT j.id_waktu FROM jadwal j WHERE id_kelas IN (SELECT id_kelas FROM kelas_dosen WHERE id_dosen = (SELECT a.id_dosen FROM kelas_dosen as a WHERE a.id_kelas = $kelas)) AND j.id_ta =$tahun) as w where id_waktu = $waktu")->num_rows();	
			if ($jum == 0) {
				echo json_encode(array('status' => true));
			}else
				echo json_encode(array('status' => false,'pesan' => 'Waktu yang dipilih invalid!'));
		}else{
			echo json_encode(array('status' => false,'pesan' => 'Jadwal bentrok dengan Kelas lain!'));
		}
	}

	public function ajax_cekValidateEditJadwal()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$id = $this->input->post('id');
		$kelas = $this->input->post('kelas');
		$ruang = $this->input->post('ruang');
		$waktu = $this->input->post('waktu');
		$tahun = $this->input->post('tahun');
		
		$this->db->where('id_ta',$tahun);
		$this->db->where('id_ruang',$ruang);
		$this->db->where('id_waktu',$waktu);
		$this->db->where('isDeleted',0);
		$cek1 = $this->db->get('jadwal')->num_rows();
		if ($cek1 == 0) {
			$jum = $this->db->query("SELECT * FROM (SELECT j.id_waktu FROM jadwal j WHERE id_kelas IN (SELECT id_kelas FROM kelas_dosen WHERE id_dosen = (SELECT a.id_dosen FROM kelas_dosen as a WHERE a.id_kelas = $kelas)) AND j.id_ta =$tahun) as w where id_waktu = $waktu")->num_rows();	
			if ($jum == 0) {
				echo json_encode(array('status' => true));
			}else
				echo json_encode(array('status' => false,'pesan' => 'Waktu yang dipilih invalid!'));
		}else{
			echo json_encode(array('status' => false,'pesan' => 'Jadwal bentrok dengan Kelas lain!'));
		}
	}
}
?>