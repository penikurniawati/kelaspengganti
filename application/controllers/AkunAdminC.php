<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkunAdminC extends CI_Controller{
  
  function __construct(){
    parent:: __construct();
    no_access();
    cekUserAdmin();
    $this->load->helper('url');
    $this->load->model('AkunAdminM');
    $this->load->model('DosenAdminM');
    $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    // $this->load->library('PHPExcel');
  }
    

  public function index(){
      $data['tampilAkunAdmin']= $this->AkunAdminM->getAkunAdmin();
      $data['role']= $this->AkunAdminM->getRole();
      $this->load->view('admin/View_akunadmin', $data);
    
  }

  public function inputAkun(){
    
    $this->load->library('form_validation');
      
        $this->form_validation->set_rules('usernameAkun','Username Akun','trim|required|xss_clean');
        $this->form_validation->set_rules('passwordAkun','Password Akun','required|xss_clean');
        $this->form_validation->set_rules('namaAkun','Nama Akun','required|xss_clean');
        $this->form_validation->set_rules('posisiAkun','User Role','required');
    
        if($this->form_validation->run() == FALSE)
        {
      //jika form tidak lengkap maka akan dikembalikan ke route "akunAdminR"
      redirect('akunAdminR');
        }
        else
        {
      $usernameAkun = $this->input->post('usernameAkun');
      $passwordAkun = $this->input->post('passwordAkun');
      $namaAkun = $this->input->post('namaAkun');
      $idUserrole = $this->input->post('posisiAkun');
      $passwordAkunEnk = md5($passwordAkun);
      
      $cekUsername = $this->AkunAdminM->cekUsername($usernameAkun);

      if (!empty($cekUsername)) {
        $this->session->set_flashdata('error', 'Username sudah ada');
      }
      // jika username belum ada maka data diisikan ke database
      else{
        $akunInfo =  array(
          "username"=>$usernameAkun,
          "password"=>$passwordAkunEnk,
          "nama"=>$namaAkun,
          "id_userrole"=>$idUserrole,
          "createDtm"=>date('Y-m-d H:s:i')
        );
          
        $result = $this->AkunAdminM->insertAkun($akunInfo);

        //jika id userrole == 2 maka dia juga sekaligus menambahkan pada tabel dosen
        if($idUserrole == 2){
        $dosenInfo =  array(
          "nip"=>$usernameAkun,
          "nama_dosen"=>$namaAkun,
          "id_user"=>$result,
          "createDtm"=>date('Y-m-d H:s:i')
        );
        $result2 = $this->AkunAdminM->insertDosen($dosenInfo);
      }
        if($result > 0)
        {
          $this->session->set_flashdata('success', 'Akun berhasil dibuat');
        }
        else
        {
          $this->session->set_flashdata('error', 'Akun gagal dibuat');
        } 
      }
      // }
      redirect('akunAdminR');
    }
  }
  
  function editAkun() {
    //get id user yang ingin di edit
    $id_user = $this->input->post('id_user');
    $id_dosen = $this->input->post('id_dosen');
    
    $this->load->library('form_validation');
    
        $this->form_validation->set_rules('namaAkun','Nama Akun','required|xss_clean');
      
        if($this->form_validation->run() == FALSE)
        {
      //jika form tidak lengkap maka akan dikembalikan ke route "akunAdminR"
      redirect('akunAdminR');
        }
        else
        {
      $namaAkun = $this->input->post('namaAkun');
      
      $dataAkun =  array(
        "nama"=>$namaAkun,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->AkunAdminM->ubahAkunM($dataAkun,$id_user);

      $dataDosen =  array(
        "nama_dosen"=>$namaAkun,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
      $result2 = $this->DosenAdminM->editDosen($dataDosen, $id_dosen);
      
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Akun berhasil diubah');
      }
      else
      {
        $this->session->set_flashdata('error', 'Akun gagal diubah');
      } 
      
      redirect('akunAdminR');
    }
  }

  function hapusAkun() {
    //get username yang ingin di hapus
    $id_user = $this->input->post('id_user');
    $id_dosen = $this->input->post('id_dosen');

    $cekIdAkun = $this->AkunAdminM->cekIdAkun($id_user);

      if (!empty($cekIdAkun)) {
        $this->session->set_flashdata('error', 'Gagal menghapus, data sudah terintegrasi');
      }
      else{
      $akunInfo =  array(
        "isDeleted"=>1,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result = $this->AkunAdminM->hapusAkun($akunInfo, $id_user);

      $dosenInfo =  array(
        "isDeleted"=>1,
        "updateDtm"=>date('Y-m-d H:s:i')
      );
        
      $result2 = $this->DosenAdminM->hapusDosen($dosenInfo, $id_dosen);
      
      if($result == TRUE)
      {
        $this->session->set_flashdata('success', 'Akun berhasil dihapus');
      }
      else
      {
        $this->session->set_flashdata('error', 'Akun gagal dihapus');
      } 
      }
      redirect('akunAdminR');
  }

    function resetPassword() {
    //get id user yang akan diubah
    $id_user = $this->input->post('id_user');
    
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('passbaru1','Password Baru','required|xss_clean');
    $this->form_validation->set_rules('passbaru2','Password Baru','required|xss_clean');
    
    if($this->form_validation->run() == FALSE)
    {
      //jika form tidak lengkap maka akan dikembalikan ke route "profilDosenR"
      redirect('akunAdminR');
    }
    else
    {
      $passbaru1 = $this->input->post('passbaru1');
      $passbaru2 = $this->input->post('passbaru2');
      
        if($passbaru1 == $passbaru2){
          $dataPassword = array(
          "password"=>md5($passbaru1));

          $result = $this->AkunAdminM->resetPassword($dataPassword, $id_user);

          if($result == TRUE){
            $this->session->set_flashdata('success','Reset password berhasil');
          }else{
            $this->session->set_flashdata('error','Reset password gagal');
          }
        }else{
          $this->session->set_flashdata('error','Password baru tidak sesuai');
        }
      
      redirect('akunAdminR');
    }
  }

  public function UploadAkun(){
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
            $akunDitolak = array();
            $akunDiterima = array();
            $tolak=0;
            $terima=0;
            unlink($inputFileName);
            $jum=0;
            if ($judul[0][0]=="NIP" && $judul[0][1]=="Password" && $judul[0][2]=="Nama") {
              for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "username"=> $rowData[0][0],
                    "password"=> md5($rowData[0][1]),
                    "nama"=> $rowData[0][2],
                    "id_userrole"=> 2,
                    "createDtm"=>date('Y-m-d H:s:i')
                );


               $cekUsername=$this->AkunAdminM->cekUsername($rowData[0][0]);
                if(!empty($cekUsername)){
                  //jika kodeMK sudah ada
                  array_push($akunDitolak, $rowData[0][0]);
                }else{
                  //jika kodeMK belum ada
                  array_push($akunDiterima, $rowData[0][0]);
                  //sesuaikan nama dengan nama tabel
                  $this->db->trans_start(); //ini untuk gek id
                  $this->db->insert("user",$data);
                  $insert = $this->db->insert_id();
                  $this->db->trans_complete();

                $dataDosen =  array(
                  "nip"=>$rowData[0][0],
                  "nama_dosen"=>$rowData[0][2],
                  "id_user"=>$insert,
                  "createDtm"=>date('Y-m-d H:s:i')
                );
                $insert2 = $this->db->insert("dosen",$dataDosen);
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
            redirect('akunAdminR');         
    }
}
?>