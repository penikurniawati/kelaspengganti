<?php
class RuangAdminM extends CI_Model{
    public function getRuangAdmin(){
      $this->db->select("id_ruang AS id, nama_ruang AS namaRuang, jenis_ruang AS jenisRuang, kapasitas AS kapasitasRuang");
      $this->db->from("ruang");
      $this->db->where("isDeleted",0);
      
      $query = $this->db->get();
      return $query->result();
    }

    public function insertRuang($ruangInfo){
    
    $this->db->trans_start();
      
    $this->db->insert('ruang',$ruangInfo);
    $insert_id = $this->db->insert_id();
    
        $this->db->trans_complete();
      return $insert_id;
    }
  
  function ubahRuang($ruangInfo, $id_ruang) {
    $this->db->where('id_ruang', $id_ruang);
    $this->db->update('ruang', $ruangInfo);
    
    return TRUE;
  }

  function hapusRuang($ruangInfo, $id_ruang) {
    $this->db->where('id_ruang', $id_ruang);
    $this->db->update('ruang', $ruangInfo);
    
    return TRUE;
  }

  //pengecekan id ruang untuk delete
  public function cekIdRuang($id_ruang){
    $this->db->select("id_ruang");
    $this->db->from("jadwal");
    $this->db->where("id_ruang",$id_ruang);
    $this->db->where("isDeleted",0);

    $query = $this->db->get();
    return $query->result();
  }
  
}
?>