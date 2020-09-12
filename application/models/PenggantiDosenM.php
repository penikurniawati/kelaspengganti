<?php
class PenggantiDosenM extends CI_Model{

    //untuk tau kelas yang pernah melakukan pertemuan dengan status tidak hadir dan belum dilakukan pengganti
  public function getKelasTidakHadirDosen($username){
    $query = $this->db->query("SELECT p.id_pertemuan AS idPertemuan, k.nama_kelas AS namaKelas, d.nama_dosen AS namaDosen, w.hari AS hari, w.jam AS sesi, j.id_jadwal AS idJadwal, p.tgl_pertemuan AS tglPertemuan FROM jadwal j JOIN kelas k ON k.id_kelas = j.id_kelas JOIN kelas_dosen kd ON kd.id_kelas = k.id_kelas JOIN dosen d ON kd.id_dosen = d.id_dosen JOIN waktu w ON w.id_waktu = j.id_waktu JOIN pertemuan p ON p.id_kelas = k.id_kelas JOIN tahun_ajaran ta ON ta.id_ta = j.id_ta JOIN user u ON u.id_user = d.id_user WHERE p.status_pertemuan = 'Tidak Hadir' AND ta.status_ta = 'Aktif' AND p.id_pertemuan NOT IN (SELECT p.id_pertemuan FROM pengganti pe, pertemuan p WHERE p.id_pertemuan = pe.id_pertemuan) AND u.username = '".$username."' GROUP BY p.id_pertemuan");
    return $query->result();
  }
}
?>