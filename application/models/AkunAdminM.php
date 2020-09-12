<?php
class AkunAdminM extends CI_Model{

    //menampilkan akun
  	public function getAkunAdmin(){
  		$this->db->select("u.id_user AS iduser, d.id_dosen AS iddosen, u.username AS usernameAkun, u.nama AS namaAkun, ur.nama_userrole AS posisiAkun");
  		$this->db->from("user u");
      $this->db->join("user_role ur","u.id_userrole = ur.id_userrole");
      $this->db->join("dosen d","d.id_user = u.id_user","left");
      $this->db->where("u.isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}

    //select role
    public function getRole(){
      $this->db->select("*");
      $this->db->from("user_role");
      $this->db->where("user_role.isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    }

    ///memasukkan data akun
  	public function insertAkun($dataAkun){
    	$this->db->trans_start();
        
      $this->db->insert('user',$dataAkun);
      $insert_id = $this->db->insert_id();
      
      $this->db->trans_complete();
      return $insert_id;
  	}

    //memasukkan data dosen
    public function insertDosen($dataDosen){
      $this->db->trans_start();

      $this->db->insert('dosen',$dataDosen);
      $insert_id = $this->db->insert_id();

      $this->db->trans_complete();
      return $insert_id;
    }

    //hapus akun
    function hapusAkun($akunInfo, $id_user) {
      $this->db->where('id_user', $id_user);
      $this->db->update('user', $akunInfo);
      
      return TRUE;
    }

    //ubah akun
    public function ubahAkunM($dataAkun,$id_user){
      $this->db->where("id_user",$id_user);
      $this->db->update("user",$dataAkun);
      return true;
    }

    //pengecekan username akun
    public function cekUsername($usernameAkun){
      $this->db->select("username");
      $this->db->from("user");
      $this->db->where("username",$usernameAkun);
      $this->db->where("isDeleted",0);

      $query = $this->db->get();
      return $query->result();
    }

    //pengecekan username akun untuk delete
    public function cekIdAkun($id_user){
      $this->db->select("id_user");
      $this->db->from("dosen");
      $this->db->where("id_user",$id_user);
      $this->db->where("isDeleted",0);

      $query = $this->db->get();
      return $query->result();
    }

    public function resetPassword($dataPassword, $id_user)
    {
     //id apa yang mau di update, lalu DATA apa yang mau dikirim ke tabel di database
    $this->db->where('id_user',$id_user);
    $this->db->update('user',$dataPassword);
    return true;
    }
  
}
?>