<?php
class WaktuAdminM extends CI_Model{

  	public function getWaktuAdmin(){
  		$this->db->select("id_waktu AS idWaktu, hari AS hari, jam AS sesi");
  		$this->db->from("waktu");
      $this->db->where("isDeleted",0);
      
  		$query = $this->db->get();
  		return $query->result();
  	}

  	public function insertWaktu($waktuInfo){
  		$this->db->trans_start();
    		
  		$this->db->insert('waktu',$waktuInfo);
  		$insert_id = $this->db->insert_id();
  		
      $this->db->trans_complete();
    	return $insert_id;
  	}
	
	function editWaktu($waktuInfo, $id_waktu) {
		$this->db->where('id_waktu', $id_waktu);
		$this->db->update('waktu', $waktuInfo);
		
		return TRUE;
	}

  function hapusWaktu($waktuInfo, $id_waktu) {
    $this->db->where('id_waktu', $id_waktu);
    $this->db->update('waktu', $waktuInfo);
    
    return TRUE;
  }

  //pengecekan id waktu untuk delete
  public function cekIdWaktu($id_waktu){
    $this->db->select("id_waktu");
    $this->db->from("jadwal");
    $this->db->where("id_waktu",$id_waktu);
    $this->db->where("isDeleted",0);

    $query = $this->db->get();
    return $query->result();
  }
}
?>