<?php
class MatkulAdminM extends CI_Model{

  	public function getMatkulAdmin(){
  		$this->db->select("id_mk AS id, kode_MK AS kodeMK, nama_MK AS namaMK, sks_MK AS sksMK, kategori AS kategoriMK, batas_pertemuan AS batasPertemuan");
  		$this->db->from("mata_kuliah");
      $this->db->where("isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}

  	public function insertMatkul($matkulInfo){
		$this->db->trans_start();
  		
		$this->db->insert('mata_kuliah',$matkulInfo);
		$insert_id = $this->db->insert_id();
		
        $this->db->trans_complete();
  		return $insert_id;
  	}
	
	function editMatkul($matkulInfo, $id_mk) {
		$this->db->where('id_mk', $id_mk);
		$this->db->update('mata_kuliah', $matkulInfo);
		
		return TRUE;
	}

  function hapusMatkul($matkulInfo, $id_mk) {
    $this->db->where('id_mk', $id_mk);
    $this->db->update('mata_kuliah', $matkulInfo);
    
    return TRUE;
  }

  //pengecekan id matkul untuk delete
  public function cekIdMatkul($id_mk){
    $this->db->select("id_matkul");
    $this->db->from("kelas");
    $this->db->where("id_matkul",$id_mk);
    $this->db->where("isDeleted",0);

    $query = $this->db->get();
    return $query->result();
  }

	function cekKode($kodeMK){
      	$this->db->select("kode_MK");
      	$this->db->from("mata_kuliah");
      	$this->db->where("kode_MK","$kodeMK");
        $this->db->where("isDeleted",0);

      	$query = $this->db->get();
      	return $query->result();
    }
  
}
?>