<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RuangAdminC extends CI_Controller{
  
  function __construct(){
    parent:: __construct();
    $this->load->helper('url');
    no_access();
    cekUserAdmin();
    $this->load->model('RuangAdminM');
    $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
  }
    

  public function index(){
      $data['tampilRuangAdmin']= $this->RuangAdminM->getRuangAdmin();
      $this->load->view('admin/View_ruangadmin', $data);
    
  }

  public function inputRuang(){
    
    $this->load->library('form_validation');
           
        $this->form_validation->set_rules('namaRuang','Nama Ruang','required|xss_clean');
        $this->form_validation->set_rules('jenisRuang','Jenis Ruang','required|xss_clean');
        $this->form_validation->set_rules('kapasitasRuang','Kapasitas Ruang','required|numeric|xss_clean');
    
        if($this->form_validation->run() == FALSE)
        {
      //jika form tidak lengkap maka akan dikembalikan ke route "matkulAdminR"
      redirect('ruangAdminR');
        }
        else
        {
      $namaRuang = $this->input->post('namaRuang');
      $jenisRuang = $this->input->post('jenisRuang');
      $kapasitasRuang = $this->input->post('kapasitasRuang');
      
      $ruangInfo =  array(
        "nama_ruang"=>$namaRuang,
        "jenis_ruang"=>$jenisRuang,
        "kapasitas"=>$kapasitasRuang,
        "createDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->RuangAdminM->insertRuang($ruangInfo);
      
      if($result > 0)
      {
        $this->session->set_flashdata('success', 'Ruang berhasil dibuat');
      }
      else
      {
        $this->session->set_flashdata('error', 'Ruang gagal dibuat');
      } 
      
      redirect('ruangAdminR');
    }
  }
  
  function ubahRuang() {
    //get id ruang yang ingin di ubah
    $id_ruang = $this->input->post('id_ruang');
    
    $this->load->library('form_validation');
    
        $this->form_validation->set_rules('namaRuang','Nama Ruang','required|xss_clean');
        $this->form_validation->set_rules('jenisRuang','Jenis Ruang','required|xss_clean');
        $this->form_validation->set_rules('kapasitasRuang','Kapasitas Ruang','required|numeric|xss_clean');
    
        if($this->form_validation->run() == FALSE)
        {
      //jika form tidak lengkap maka akan dikembalikan ke route "matkulAdminR"
      redirect('ruangAdminR');
        }
        else
        {
      $namaRuang = $this->input->post('namaRuang');
      $jenisRuang = $this->input->post('jenisRuang');
      $kapasitasRuang = $this->input->post('kapasitasRuang');
      
      $ruangInfo =  array(
        "nama_ruang"=>$namaRuang,
        "jenis_ruang"=>$jenisRuang,
        "kapasitas"=>$kapasitasRuang,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->RuangAdminM->ubahRuang($ruangInfo, $id_ruang);
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Ruang berhasil diubah');
      }
      else
      {
        $this->session->set_flashdata('error', 'Ruang gagal diubah');
      } 
      
      redirect('ruangAdminR');
    }
  }

  function hapusRuang() {
    //get id matakuliah yang ingin di hapus
    $id_ruang = $this->input->post('id_ruang');
    
    $cekIdRuang = $this->RuangAdminM->cekIdRuang($id_ruang);

      if (!empty($cekIdRuang)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }
      else{
      $ruangInfo =  array(
        "isDeleted"=>1,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->RuangAdminM->hapusRuang($ruangInfo, $id_ruang);
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Ruang berhasil dihapus');
      }
      else
      {
        $this->session->set_flashdata('error', 'Ruang gagal dihapus');
      } 
      }      
      redirect('ruangAdminR');
  }

  public function UploadRuang(){
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
            unlink($inputFileName);
            $jum=0;
            if ($judul[0][0]=="Nama Ruang" && $judul[0][1]=="Jenis" && $judul[0][2]=="Kapasitas") {
              for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $dataRuang = array(
                    "nama_ruang"=> $rowData[0][0],
                    "jenis_ruang"=> $rowData[0][1],
                    "Kapasitas"=> $rowData[0][2],
                    "createDtm"=>date('Y-m-d H:s:i')
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("ruang",$dataRuang);

                delete_files($media['file_path']);
                $jum++;
                         
                }
                $highestRow--;
                $pesan = "(".$jum." data berhasil dimasukan dari total ".$highestRow." data!)";
                $this->session->set_flashdata('success', $pesan);
            }else{
              $pesanEror = "('Gagal import excel, colomn tidak sesuai!')";
                $this->session->set_flashdata('error', $pesanEror);
            }
            redirect('ruangAdminR');         
    }
}
?>