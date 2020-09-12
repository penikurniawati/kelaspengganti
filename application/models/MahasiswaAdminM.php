<?php
class MahasiswaAdminM extends CI_Model{

  	public function getMahasiswaAdmin($nama='', $angkatan1='', $angkatan2='', $niu=''){
  		$this->db->select("id_mahasiswa AS id, nim AS nimMahasiswa, nama_mahasiswa AS namaMahasiswa, jk_mahasiswa AS jkMahasiswa, angkatan_mahasiswa AS angkatanMahasiswa");
  		$this->db->from("mahasiswa");
      // if di bawah ini untuk filter mahasiswa
      if(!empty($nama)){
        $this->db->LIKE("nama_mahasiswa",$nama);  
      }
      if (!empty($angkatan1) && !is_null($angkatan2)) {
        $this->db->where("angkatan_mahasiswa BETWEEN $angkatan1 AND $angkatan2");
      }elseif (!empty($angkatan1) && is_null($angkatan2)) {
        $this->db->where("angkatan_mahasiswa",$angkatan1);
      }
      if(!empty($niu)){
        $this->db->LIKE("nim",$niu);  
      }
      $this->db->where("isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}

  	public function insertMahasiswa($dataMahasiswa){
    	$this->db->trans_start();
        
      	$this->db->insert('mahasiswa',$dataMahasiswa);
      	$insert_id = $this->db->insert_id();
      
        $this->db->trans_complete();
        return $insert_id;
  	} 	

    function cekNim($nim){
      	$this->db->select("nim");
      	$this->db->from("mahasiswa");
      	$this->db->where("nim","$nim");
        $this->db->where("isDeleted",0);

      	$query = $this->db->get();
      	return $query->result();
    }

    function cekNimUpload($nim){
        $this->db->select("nim");
        $this->db->from("mahasiswa");
        $this->db->where("nim","$nim");

        $query = $this->db->get();
        return $query->result();
    }

    public function ubahMahasiswa($dataMahasiswa,$id){
      $this->db->where("id_mahasiswa",$id);
      $this->db->update("mahasiswa",$dataMahasiswa);
      return true;
    }

    public function hapusMahasiswa($dataMahasiswa,$id_mahasiswa){
      $this->db->where("id_mahasiswa",$id_mahasiswa);
      $this->db->update("mahasiswa",$dataMahasiswa);
      return true;
    }

    //pengecekan id mahasiswa untuk delete
    public function cekIdMahasiswa($id_mahasiswa){
      $this->db->select("id_mahasiswa");
      $this->db->from("kelas_mahasiswa");
      $this->db->where("id_mahasiswa",$id_mahasiswa);
      $this->db->where("isDeleted",0);

      $query = $this->db->get();
      return $query->result();
    }

    public function getAngkatanMhs(){
      $this->db->select("angkatan_mahasiswa AS angkatanMhs");
      $this->db->from("mahasiswa");
      $this->db->where("isDeleted",0);
      $this->db->group_by("angkatan_mahasiswa");
      $query = $this->db->get();
      return $query->result(); 
    }

  
}
?>