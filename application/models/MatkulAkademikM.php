<?php
class MatkulAkademikM extends CI_Model{

  	public function getMatkulAkademik(){
  		$this->db->select("id_mk AS id, kode_MK AS kodeMK, nama_MK AS namaMK, sks_MK AS sksMK, kategori AS kategoriMK, batas_pertemuan AS batasPertemuan");
  		$this->db->from("mata_kuliah");
  		$this->db->where("isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}
  
}
?>