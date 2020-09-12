<?php
class KelasAdminM extends CI_Model{

  	public function getKelasAdmin(){
  		$this->db->select("k.id_kelas AS id, kd.id_dosenkelas AS idkd, d.id_dosen AS idd, mk.id_mk AS idMatkul, g.id_grup AS idgrup, k.nama_kelas AS namaKelas, k.status_kelas AS statusKelas, mk.nama_MK AS matkul, g.nama_grup AS grup, d.nama_dosen AS dosen, COUNT(m.id_mahasiswa) AS jumMhs");
  		$this->db->from("kelas k");
  		$this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul","left");
  		$this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas","left");
  		$this->db->join("kelas_mahasiswa km","km.id_kelas = k.id_kelas","left");
  		$this->db->join("grup g","g.id_grup = k.id_grup","left");
  		$this->db->join("mahasiswa m","m.id_mahasiswa = km.id_mahasiswa","left");
  		$this->db->join("dosen d","d.id_dosen = kd.id_dosen","left");
  		$this->db->group_by("k.status_kelas");
      $this->db->group_by("k.nama_kelas");
      $this->db->where("k.isDeleted",0);
      $this->db->order_by("k.status_kelas");
      $this->db->order_by("k.nama_kelas");
  		$query = $this->db->get();
  		return $query->result();
  	}

  	public function getKelasMahasiswa($idkelas){
  		$this->db->select("km.id_kelasmahasiswa AS idkm, m.nim AS nim, m.nama_mahasiswa AS namaMhs, m.jk_mahasiswa AS jkMhs, km.status_km AS statusMhs");
  		$this->db->from("kelas_mahasiswa km");
  		$this->db->join("mahasiswa m","m.id_mahasiswa = km.id_mahasiswa");
  		$this->db->join("kelas k","k.id_kelas = km.id_kelas");
  		$this->db->where("k.id_kelas",$idkelas);
      $this->db->where("km.isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}

    public function getKelasMahasiswaNim($id_kelas, $id_mahasiswa){
      $this->db->select("m.nim AS nim, m.nama_mahasiswa AS namaMhs, m.jk_mahasiswa AS jkMhs");
      $this->db->from("kelas_mahasiswa km");
      $this->db->join("mahasiswa m","m.id_mahasiswa = km.id_mahasiswa");
      $this->db->join("kelas k","k.id_kelas = km.id_kelas");
      $this->db->where("k.id_kelas",$id_kelas);
      $this->db->where("m.id_mahasiswa",$id_mahasiswa);
      $this->db->where("km.isDeleted",0);
      $query = $this->db->get();
      return $query->result();
    }

  	public function getKelas($id){
  		$this->db->select("nama_kelas AS kelas, id_kelas");
  		$this->db->from("kelas");
  		$this->db->where("id_kelas",$id);
      $this->db->where("isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
  	}

    public function insertKelasDosen($kelasDosen){
      $this->db->trans_start();
        
      $this->db->insert('kelas_dosen',$kelasDosen);
      $insert_id = $this->db->insert_id();
    
      $this->db->trans_complete();
      return $insert_id;
    }

    public function insertKelas($kelasInfo){
      $this->db->trans_start();
        
      $this->db->insert('kelas',$kelasInfo);
      $insert_id = $this->db->insert_id();
    
      $this->db->trans_complete();
      return $insert_id;
    }

    public function getMatkul(){
      $this->db->select("*");
      $this->db->from("mata_kuliah");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    }

    public function getMhs(){
      $this->db->select("*");
      $this->db->from("mahasiswa");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    }

    public function getDosen(){
      $this->db->select("*");
      $this->db->from("dosen");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    }

    function cekIdM($id_mahasiswa){
      $this->db->select("id_mahasiswa");
      $this->db->from("mahasiswa");
      $this->db->where("id_mahasiswa","$id_mahasiswa");
      $this->db->where("isDeleted",0);

      $query = $this->db->get();
      return $query->result();
    }

    public function getGrup(){
      $this->db->select("*");
      $this->db->from("grup");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    }

    public function cekKelas($namaKelas){
      $this->db->select("nama_kelas");
      $this->db->from("kelas");
      $this->db->where("nama_kelas","$namaKelas");
      $this->db->where("status_kelas","Aktif");
     
      $query = $this->db->get();
      return $query->result();
    }

    public function updateKelasDosen($namaMatkul, $namaGrup, $namaKelas, $namaDosen, $statusKelas, $id_dosenkelas){
      $this->db->set('k.nama_kelas', $namaKelas);
      $this->db->set('k.id_matkul', $namaMatkul);
      $this->db->set('k.id_grup', $namaGrup);
      $this->db->set('k.status_kelas', $statusKelas);
      $this->db->set('kd.id_dosen', $namaDosen);
      $this->db->set('kd.updateDtm', date('Y-m-d H:i:s'));
      $this->db->set('k.updateDtm', date('Y-m-d H:i:s'));

      $this->db->where('kd.id_dosenkelas', $id_dosenkelas);
      $result = $this->db->update("(kelas_dosen AS kd JOIN kelas AS k ON kd.id_kelas = k.id_kelas)");

      if ($result) {
        return true;
      }else{
        return false;
      }
    }

    public function insertKelasMahasiswa($dataKelasMahasiswa){
      $this->db->trans_start();
        
        $this->db->insert('kelas_mahasiswa',$dataKelasMahasiswa);
        $insert_id = $this->db->insert_id();
      
        $this->db->trans_complete();
        return $insert_id;
    }

    public function updateKelasMahasiswa($id_mahasiswa, $statusMhs, $id_kelasmahasiswa){
      $this->db->set('kelas_mahasiswa.status_km', $statusMhs);
      $this->db->where('kelas_mahasiswa.id_kelasmahasiswa', $id_kelasmahasiswa);
      $this->db->update("kelas_mahasiswa");

      return TRUE;
    }

  function hapusKelas($kelasInfo, $id_kelas) {
    $this->db->where('id_kelas', $id_kelas);
    $this->db->update('kelas', $kelasInfo);
    
    return TRUE;
  }

  //pengecekan id kelas untuk delete
  public function cekIdKelas($id_kelas){
    $this->db->select("id_kelas");
    $this->db->from("jadwal");
    $this->db->where("id_kelas",$id_kelas);
    $this->db->where("isDeleted",0);

    $query = $this->db->get();
    return $query->result();
  }
}
?>