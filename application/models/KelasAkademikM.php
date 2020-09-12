<?php
class KelasAkademikM extends CI_Model{

  	public function getKelasAkademik(){
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

  	public function getKelas($id){
  		$this->db->select("nama_kelas AS kelas, id_kelas");
  		$this->db->from("kelas");
  		$this->db->where("id_kelas",$id);
      $this->db->where("isDeleted",0);
  		$query = $this->db->get();
  		return $query->result();
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

    public function getGrup(){
      $this->db->select("*");
      $this->db->from("grup");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    }

    public function cekIdMatkul($namaMatkul){
      $this->db->select("*");
      $this->db->from("mata_kuliah");
      $this->db->where("nama_MK",$namaMatkul);
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result(); 
    } 
}
?>