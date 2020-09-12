<?php
class DosenAkademikM extends CI_Model{

  	public function getDosenAkademik(){
  		$this->db->select("d.id_dosen AS id, d.nip AS nipDosen, d.nama_dosen AS namaDosen, d.jk_dosen AS jkDosen, d.tgl_lahir AS tglDosen, d.nohp AS nohpDosen, d.email AS emailDosen, d.alamat AS alamatDosen");
  		$this->db->from("dosen d");
			$this->db->join("user u","d.id_user=u.id_user");
			$this->db->where("u.id_userrole",2);
  		$this->db->where("d.isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}  
}
?>