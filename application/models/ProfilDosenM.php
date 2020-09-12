<?php
class ProfilDosenM extends CI_Model{
  
    public function getProfilDosen($username){
    $this->db->select("d.*, u.*");
    $this->db->from("dosen d");
    $this->db->join("user u","u.id_user = d.id_user");
    $this->db->where("u.username",$username);
    $this->db->where("d.isDeleted",0);
    $query = $this->db->get();
    return $query->result();
  }

  public function editProfil($profilDosen, $id_dosen){
    $this->db->where("id_dosen",$id_dosen);
    $this->db->update("dosen",$profilDosen);
    return true;
  }

  public function cekPasswordDosen($id_user){
    $this->db->select("password");
    // $this->db->from("user");
    $this->db->where("id_user",$id_user);
    $this->db->where("isDeleted",0);
    $query = $this->db->get("user");
    return $query->row()->password; 
  }

  public function ubahPasswordDosen($dataPassword, $id_user)
    {
     //id apa yang mau di update, lalu DATA apa yang mau dikirim ke tabel di database
    $this->db->where('id_user',$id_user);
    $this->db->update('user',$dataPassword);
    return true;
    }
  
}
?>