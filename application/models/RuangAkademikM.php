<?php
class RuangAkademikM extends CI_Model{

  	public function getRuangAkademik(){
      $this->db->select("id_ruang AS id, nama_ruang AS namaRuang, jenis_ruang AS jenisRuang, kapasitas AS kapasitasRuang");
      $this->db->from("ruang");
      $this->db->where("isDeleted",0);
      
      $query = $this->db->get();
      return $query->result();
  	}
  
}
?>