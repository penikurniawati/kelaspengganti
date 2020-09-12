<?php
class KehadiranDosenM extends CI_Model{

  	public function getKehadiranDosen($username){
  		$this->db->select("us.username AS u, p.id_pertemuan AS id, k.nama_kelas AS kelas, mk.batas_pertemuan AS batas, count(p.status_pertemuan) AS pertemuan, (mk.batas_pertemuan - count(p.status_pertemuan)) AS kewajiban");
  		$this->db->from("kelas k");
  		$this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul");
  		$this->db->join("pertemuan p","k.id_kelas = p.id_kelas");
      $this->db->join("kelas_dosen kd","k.id_kelas = kd.id_kelas");
      $this->db->join("dosen d","kd.id_dosen = kd.id_dosen");
      $this->db->join("user us","d.id_user = us.id_user");
  		$this->db->where("p.status_pertemuan","Hadir");
      $this->db->where("us.username",$username);
      $this->db->where("k.isDeleted",0);
  		$this->db->group_by("k.nama_kelas");
  		$query = $this->db->get();
  		return $query->result();
  	}  

    function getKehadiranDosen1($id)
    {
      $data = $this->db->query("SELECT u.username AS u, p.id_pertemuan AS id, k.nama_kelas AS kelas, mk.batas_pertemuan AS batas, count(p.status_pertemuan) AS pertemuan, (mk.batas_pertemuan - count(p.status_pertemuan)) AS kewajiban FROM kelas k LEFT JOIN mata_kuliah mk ON mk.id_mk = k.id_matkul LEFT JOIN pertemuan p ON k.id_kelas = p.id_kelas LEFT JOIN kelas_dosen kd ON k.id_kelas = kd.id_kelas LEFT JOIN dosen d ON d.id_dosen = kd.id_dosen LEFT JOIN user u ON d.id_user = u.id_user JOIN jadwal j ON j.id_kelas = k.id_kelas JOIN tahun_ajaran ta ON ta.id_ta = j.id_ta WHERE p.status_pertemuan = 'Hadir' AND ta.status_ta='Aktif' AND u.username = $id GROUP BY k.nama_kelas")->result();
      return $data;
    }
}
?>