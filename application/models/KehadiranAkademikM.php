<?php
class KehadiranAkademikM extends CI_Model{

  	// public function getKehadiranAkademik(){
  	// 	$this->db->select("p.id_pertemuan AS id, k.nama_kelas AS kelas, d.nama_dosen AS namaDosen, mk.batas_pertemuan AS batas, count(p.status_pertemuan) AS pertemuan, (mk.batas_pertemuan - count(p.status_pertemuan)) AS kewajiban");
  	// 	$this->db->from("kelas k");
  	// 	$this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul","left");
  	// 	$this->db->join("pertemuan p","k.id_kelas = p.id_kelas","left");
   //    $this->db->join("jadwal j", "k.id_kelas=j.id_kelas");
   //    $this->db->join("tahun_ajaran ta", "j.id_ta=ta.id_ta");
   //    $this->db->join("kelas_dosen kd", "kd.id_kelas=k.id_kelas");
   //    $this->db->join("dosen d", "kd.id_dosen=d.id_dosen");
   //    $this->db->where("ta.status_ta","Aktif");
  	// 	$this->db->where("p.status_pertemuan","Hadir");
  	// 	$this->db->GROUP_BY("k.nama_kelas");
   //    $this->db->where("k.isDeleted",0);
  	// 	$query = $this->db->get();
  	// 	return $query->result();
  	// }  

    public function getKehadiranAkademik(){
      $data = $this->db->query("SELECT u.username AS u, d.nama_dosen AS namaDosen, p.id_pertemuan AS id, k.nama_kelas AS kelas, mk.batas_pertemuan AS batas, count(p.status_pertemuan) AS pertemuan, (mk.batas_pertemuan - count(p.status_pertemuan)) AS kewajiban FROM kelas k LEFT JOIN mata_kuliah mk ON mk.id_mk = k.id_matkul LEFT JOIN pertemuan p ON k.id_kelas = p.id_kelas LEFT JOIN kelas_dosen kd ON k.id_kelas = kd.id_kelas LEFT JOIN dosen d ON d.id_dosen = kd.id_dosen LEFT JOIN user u ON d.id_user = u.id_user JOIN jadwal j ON k.id_kelas = j.id_kelas JOIN tahun_ajaran ta ON j.id_ta=ta.id_ta WHERE p.status_pertemuan = 'Hadir' AND ta.status_ta='Aktif' GROUP BY k.nama_kelas")->result();
      return $data;    }  
}
?>