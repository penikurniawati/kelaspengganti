<?php
class MatkulDosenM extends CI_Model{

  	public function getMatkulDosenU($username){
  		$this->db->select("mk.id_mk AS id, mk.kode_MK AS kodeMK, mk.nama_MK AS namaMK, mk.sks_MK AS sksMK, mk.kategori AS kategoriMK, mk.batas_pertemuan AS batasPertemuan");
  		$this->db->from("mata_kuliah mk");
  		$this->db->join("kelas k","mk.id_mk = k.id_matkul");
  		$this->db->join("kelas_dosen kd","k.id_kelas = kd.id_kelas");
  		$this->db->join("dosen d","d.id_dosen = kd.id_dosen");
  		$this->db->join("user u","u.id_user = d.id_user");
  		$this->db->where("u.username",$username);
      $this->db->where("mk.isDeleted",0);
      $this->db->GROUP_BY("mk.nama_MK");
  		$query = $this->db->get();
  		return $query->result();
  	}
  
}
?>