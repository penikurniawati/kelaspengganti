<?php
class DashboardAdminM extends CI_Model{
   
  public function jmlDosen(){  
    $this->db->select('count(u.id_user) AS jumDosen'); 
    $this->db->from('user u');
    $this->db->where('u.id_userrole', 2);
    $this->db->where('u.isDeleted', 0);   
    
    $query = $this->db->get();
		return $query->result();
  }

  public function jmlKelas(){  
    $this->db->select('count(id_kelas) AS jumKelas'); 
    $this->db->from('kelas');
    $this->db->where('isDeleted', 0);
    $this->db->where('status_kelas', "Aktif");   
    
    $query = $this->db->get();
		return $query->result();
  }

  public function jmlRuang(){  
    $this->db->select('count(id_ruang) AS jumRuang'); 
    $this->db->from('ruang');
    $this->db->where('isDeleted', 0);   
    
    $query = $this->db->get();
		return $query->result();
  }

  public function jmlMatkul(){  
    $this->db->select('count(id_mk) AS jumMatkul'); 
    $this->db->from('mata_kuliah');
    $this->db->where('isDeleted', 0);   
    
    $query = $this->db->get();
		return $query->result();
  }
}
?>