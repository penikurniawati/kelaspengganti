<?php
class MahasiswaAkademikM extends CI_Model{

  	public function getMahasiswaAkademik($nama='', $angkatan1='', $angkatan2='', $niu=''){
  		$this->db->select("id_mahasiswa AS id, nim AS nimMahasiswa, nama_mahasiswa AS namaMahasiswa, jk_mahasiswa AS jkMahasiswa, angkatan_mahasiswa AS angkatanMahasiswa");
  		$this->db->from("mahasiswa");
  		if(!empty($nama)){
        $this->db->LIKE("nama_mahasiswa",$nama);  
      }
      if (!empty($angkatan1) && !is_null($angkatan2)) {
        $this->db->where("angkatan_mahasiswa BETWEEN $angkatan1 AND $angkatan2");
        //$this->db->where("angkatan_mahasiswa",$angkatan2);
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


