<?php
class KelasAdminNonAktifM extends CI_Model{

  	public function getKelasAktifAdmin(){
  		$this->db->select("k.id_kelas AS id, kd.id_dosenkelas AS idkd, d.id_dosen AS idd, mk.id_mk AS idMatkul, g.id_grup AS idgrup, k.nama_kelas AS namaKelas, k.status_kelas AS statusKelas, mk.nama_MK AS matkul, g.nama_grup AS grup, d.nama_dosen AS dosen, COUNT(m.id_mahasiswa) AS jumMhs");
  		$this->db->from("kelas k");
  		$this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul","left");
  		$this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas","left");
  		$this->db->join("kelas_mahasiswa km","km.id_kelas = k.id_kelas","left");
  		$this->db->join("grup g","g.id_grup = k.id_grup","left");
  		$this->db->join("mahasiswa m","m.id_mahasiswa = km.id_mahasiswa","left");
  		$this->db->join("dosen d","d.id_dosen = kd.id_dosen","left");
  		$this->db->group_by("k.nama_kelas");
      $this->db->where("k.isDeleted",0);
      $this->db->where("k.status_kelas","Aktif");
  		$query = $this->db->get();
  		return $query->result();
  	}

    public function ubahstatusKelas($statusKelas, $id_kelas){
      $this->db->where('id_kelas', $id_kelas);
      $this->db->update("kelas", $statusKelas);

      return TRUE;
    }  
}
?>