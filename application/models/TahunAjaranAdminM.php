<?php
class TahunAjaranAdminM extends CI_Model{

  	public function getTahunAjaranAdmin(){
  		$this->db->select("id_ta AS idTa, nama_ta AS namaTa, status_ta AS statusTa, tgl_mulai, tgl_terakhir, tgl_mulai_uts, tgl_terakhir_uts, tgl_mulai_responsi, tgl_terakhir_responsi, tgl_mulai_minggutenang, tgl_terakhir_minggutenang, tgl_mulai_uas, tgl_terakhir_uas");
  		$this->db->from("tahun_ajaran");
      $this->db->where("isDeleted",0);
      
  		$query = $this->db->get();
  		return $query->result();
  	}

    public function getTahunAjaranAdminDetail($id_ta){
      $this->db->select("id_ta AS idTa, nama_ta AS namaTa, status_ta AS statusTa, tgl_mulai, tgl_terakhir, tgl_mulai_uts, tgl_terakhir_uts, tgl_mulai_responsi, tgl_terakhir_responsi, tgl_mulai_minggutenang, tgl_terakhir_minggutenang, tgl_mulai_uas, tgl_terakhir_uas");
      $this->db->from("tahun_ajaran");
      $this->db->where("id_ta",$id_ta);
      $this->db->where("isDeleted",0);
      
      $query = $this->db->get();
      return $query->result();
    }

  	public function insertTahunAjaran($TahunAjaranInfo){
  		$this->db->trans_start();
    		
  		$this->db->insert('tahun_ajaran',$TahunAjaranInfo);
  		$insert_id = $this->db->insert_id();
  		
      $this->db->trans_complete();
    	return $insert_id;
  	}

  function cekTa($namaTA){
    $this->db->select("nama_ta");
    $this->db->from("tahun_ajaran");
    $this->db->where("nama_ta","$namaTA");
    $this->db->where("isDeleted",0);

    $query = $this->db->get();
    return $query->result();
  }

  //pengecekan Id Ta untuk delete
  public function cekIdTa($id_ta){
    $this->db->select("id_ta");
    $this->db->from("jadwal");
    $this->db->where("id_ta",$id_ta);
    $this->db->where("isDeleted",0);

    $query = $this->db->get();
    return $query->result();
  }

  function editStatusTa($statusTa, $id_ta) {
    $where = "id_ta != ". $id_ta;
    $this->db->where($where);
    $this->db->update('tahun_ajaran', $statusTa);
    
    return TRUE;
  }

  function aktifasiStatusTa($aktifasiTa, $id_ta) {
    $this->db->where('id_ta', $id_ta);
    $this->db->update('tahun_ajaran', $aktifasiTa);
    
    return TRUE;
  }
	
	function editTahunAjaran($TahunAjaranInfo, $id_ta) {
		$this->db->where('id_ta', $id_ta);
		$this->db->update('tahun_ajaran', $TahunAjaranInfo);
		
		return TRUE;
	}

  function hapusTahunAjaran($TahunAjaranInfo, $id_ta) {
    $this->db->where('id_ta', $id_ta);
    $this->db->update('tahun_ajaran', $TahunAjaranInfo);
    
    return TRUE;
  }

  public function getTahunAjaran($id_ta){
      $this->db->select("nama_ta, id_ta");
      $this->db->from("tahun_ajaran");
      $this->db->where("id_ta",$id_ta);
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result();
    }
}
?>