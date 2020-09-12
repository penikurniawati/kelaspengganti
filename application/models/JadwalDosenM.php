<?php
class JadwalDosenM extends CI_Model{

  	public function getJadwalDosen(){
  		$this->db->select("j.id_jadwal AS id, w.hari AS Hari, w.jam AS Waktu, mk.nama_MK AS Matkul, k.nama_kelas AS Kelas, d.nama_dosen AS Dosen, r.nama_ruang AS Ruang, ta.nama_ta AS Semester");
  		$this->db->from("jadwal j");
  		$this->db->join("kelas k","k.id_kelas = j.id_kelas");
  		$this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul");
  		$this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
  		$this->db->join("tahun_ajaran ta","ta.id_ta = j.id_ta");
  		$this->db->join("waktu w","w.id_waktu = j.id_waktu");
  		$this->db->join("ruang r","r.id_ruang = j.id_ruang");
  		$this->db->join("dosen d","d.id_dosen = kd.id_dosen");
  		$this->db->order_by("w.hari","desc");
  		$this->db->order_by("w.jam");
      $this->db->where("ta.status_ta","Aktif");
      $this->db->where("j.isDeleted",0);
      $this->db->where("ta.status_ta","Aktif");
  		$query = $this->db->get();
  		return $query->result();
  	}

    //Yang dipakai ini
    public function getJadwalDosenW($hari, $waktu, $ruangan, $username){
      $this->db->select("k.id_kelas, p.keterangan, p.tgl_pertemuan AS tglPertemuan, p.status_pertemuan AS statusPertemuan, j.id_jadwal AS id, w.hari AS Hari, w.jam AS Waktu, mk.nama_MK AS Matkul, k.nama_kelas AS Kelas, d.nama_dosen AS Dosen, r.nama_ruang AS Ruang, ta.nama_ta AS Semester");
      $this->db->from("jadwal j");
      $this->db->join("kelas k","k.id_kelas = j.id_kelas");
      $this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul");
      $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
      $this->db->join("tahun_ajaran ta","ta.id_ta = j.id_ta");
      $this->db->join("waktu w","w.id_waktu = j.id_waktu");
      $this->db->join("ruang r","r.id_ruang = j.id_ruang");
      $this->db->join("pertemuan p","p.id_kelas = k.id_kelas", "left");
      $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
      $this->db->join("user u","d.id_user = u.id_user");
      $this->db->where("ta.status_ta","Aktif");
      $this->db->where("w.hari",$hari);
      $this->db->where("w.jam",$waktu);
      $this->db->where("r.nama_ruang",$ruangan);
      $this->db->where("u.username",$username);
      $this->db->where("j.isDeleted",0);
      $query = $this->db->get();
      return $query->result();
    }

    public function getRuangDosen(){
      $this->db->select("nama_ruang AS namaRuang, id_ruang");
      $this->db->from("ruang");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result();
    }

    //ini untuk dipanggil langsung ke view
  public function getKelasPenggantiDosen($id_kelas, $jam) {
    $this->db->select("*");
    $this->db->from("pengganti kp");
    $this->db->join("kelas k", "k.id_kelas=kp.id_kelas");
    $this->db->join("ruang r", "r.id_ruang=kp.id_ruang");
    $this->db->where("kp.id_kelas", $id_kelas);
    $this->db->where("kp.jam", $jam);
    $this->db->where("kp.tgl_absen", date("Y-m-d"));
    $this->db->where("kp.isDeleted",0);
    $query = $this->db->get();
    
    return $query->result();
  }

  public function getKelas($id_jadwal) {
    $this->db->select("k.id_kelas, k.nama_kelas, r.nama_ruang, j.id_jadwal, d.nama_dosen, d.id_dosen");
    $this->db->from("kelas as k");
    $this->db->join("jadwal as j", "j.id_kelas=k.id_kelas");
    $this->db->join("ruang as r", "j.id_ruang=r.id_ruang");
    $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
    $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
    $this->db->where("j.id_jadwal", $id_jadwal);
    $this->db->where("k.isDeleted",0);
    return $this->db->get()->result();
  } 

  //function untuk Cek apakah ada jadwal yang absen, kalau ada, kelas apa? tanggal kapan?
  public function getKelasPenggantiDosenCustom($id_kelas, $tgl, $username) {
    $this->db->select("k.nama_kelas, kp.tgl_absen, kp.tgl_hadir, r.nama_ruang, kp.id_pengganti, kp.id_kelas as id_kelas_kp, kp.keterangan, d.nama_dosen ");
    $this->db->from("pengganti kp");
    $this->db->join("kelas k", "k.id_kelas=kp.id_kelas");
    $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
    $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
    $this->db->join("ruang r", "r.id_ruang=kp.id_ruang");
    $this->db->join("user u", "u.id_user=d.id_user");
    $this->db->join("pertemuan p", "p.id_kelas=k.id_kelas", "left");
    $this->db->join("jadwal j", "k.id_kelas=j.id_kelas");
    $this->db->join("tahun_ajaran ta", "j.id_ta=ta.id_ta");
    $this->db->where("ta.status_ta","Aktif");
    $this->db->where("u.username", $username);
    $this->db->where("kp.id_kelas", $id_kelas);
    $this->db->where("kp.tgl_absen", $tgl);
    $this->db->where("kp.isDeleted",0);
    $query = $this->db->get();
    
    return $query->result();
  }

  //function untuk Cek apakah ada kelas pengganti hadir, kalau ada, dimana? kapan? sesi? 
  public function getKelasPenggantiHadirDosenCustom($ruang, $jam, $tgl_hadir, $username) {
    $this->db->select("k.nama_kelas, kp.tgl_absen, kp.id_pengganti, kp.id_kelas as id_kelas_kp, d.nama_dosen ");
    $this->db->from("pengganti kp");
    $this->db->join("kelas k", "k.id_kelas=kp.id_kelas");
    $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
    $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
    $this->db->join("ruang r", "r.id_ruang=kp.id_ruang");
    $this->db->join("user u", "u.id_user=d.id_user");
    $this->db->join("pertemuan p", "p.id_kelas=k.id_kelas", "left");
    $this->db->join("jadwal j", "k.id_kelas=j.id_kelas");
    $this->db->join("tahun_ajaran ta", "j.id_ta=ta.id_ta");
    $this->db->where("ta.status_ta","Aktif");
    $this->db->where("r.nama_ruang", $ruang);
    $this->db->where("kp.jam", $jam);
    $this->db->where("u.username", $username);
    $this->db->where("kp.tgl_hadir", $tgl_hadir);
    $this->db->where("kp.isDeleted",0);
    $query = $this->db->get();
    
    return $query->result();
  }

  //ini dipanggil langsung ke view
  public function getKelasPenggantiHadir($ruang, $jam) {
    $this->db->select("k.nama_kelas, kp.tgl_absen, kp.id_pengganti, kp.id_kelas as id_kelas_kp ");
    $this->db->from("pengganti kp");
    $this->db->join("kelas k", "k.id_kelas=kp.id_kelas");
    $this->db->join("ruang r", "r.id_ruang=kp.id_ruang");
    $this->db->join("pertemuan p", "p.id_kelas=k.id_kelas", "left");
    $this->db->where("r.nama_ruang", $ruang);
    $this->db->where("kp.jam", $jam);
    $this->db->where("kp.tgl_hadir", date("Y-m-d"));
    $this->db->where("kp.isDeleted",0);
    $query = $this->db->get();
    
    return $query->result();
  }

  //ini untuk implementasi cari kelas pengganti
  public function getJadwalDosenPengganti($hari, $waktu, $ruangan){
    $this->db->select("k.id_kelas, p.keterangan, p.tgl_pertemuan AS tglPertemuan, p.status_pertemuan AS statusPertemuan, j.id_jadwal AS id, w.hari AS Hari, w.jam AS Waktu, mk.nama_MK AS Matkul, k.nama_kelas AS Kelas, d.nama_dosen AS Dosen, r.nama_ruang AS Ruang, ta.nama_ta AS Semester");
    $this->db->from("jadwal j");
    $this->db->join("kelas k","k.id_kelas = j.id_kelas");
    $this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul");
    $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
    $this->db->join("tahun_ajaran ta","ta.id_ta = j.id_ta");
    $this->db->join("waktu w","w.id_waktu = j.id_waktu");
    $this->db->join("ruang r","r.id_ruang = j.id_ruang");
    $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
    $this->db->join("pertemuan p","p.id_kelas = k.id_kelas", "left");
    $this->db->where("w.hari",$hari);
    $this->db->where("w.jam",$waktu);
    $this->db->where("r.nama_ruang",$ruangan);
    $this->db->where("j.isDeleted",0);
    $query = $this->db->get();
    return $query->result();
  }

  public function getKelasPenggantiHadirCustom($ruang, $jam, $tgl_hadir) {
    $this->db->select("k.nama_kelas, kp.tgl_absen, kp.id_pengganti, kp.id_kelas as id_kelas_kp, d.nama_dosen ");
    $this->db->from("pengganti kp");
    $this->db->join("kelas k", "k.id_kelas=kp.id_kelas");
    $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
    $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
    $this->db->join("ruang r", "r.id_ruang=kp.id_ruang");
    $this->db->join("pertemuan p", "p.id_kelas=k.id_kelas", "left");
    $this->db->where("r.nama_ruang", $ruang);
    $this->db->where("kp.jam", $jam);
    $this->db->where("kp.tgl_hadir", $tgl_hadir);
    $this->db->where("kp.isDeleted",0);
    $query = $this->db->get();
    
    return $query->result();
  }

  //Ini function untuk memasukkan data kelas pengganti
  public function insertKelasPengganti($kelasPenggantiInfo) {
    $this->db->trans_start();
      
    $this->db->insert('pengganti',$kelasPenggantiInfo);
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    return $insert_id;
  }

  public function getWaktu(){
    $this->db->select("jam");
    $this->db->from("waktu");
    $this->db->where("isDeleted",0);
    $this->db->group_by("jam");
    $query = $this->db->get();
    return $query->result(); 
  }

  public function getPertemuan($id_kelas, $tgl_pertemuan, $sesi){
  $this->db->select("*");
  $this->db->from("pertemuan");
  $this->db->where("isDeleted",0);
  $this->db->where("id_kelas",$id_kelas);
  $this->db->where("tgl_pertemuan",$tgl_pertemuan);
  $this->db->where("sesi",$sesi);
  $query = $this->db->get();
  return $query->result(); 
  }

  public function getTahunAjaran(){
      $this->db->select("*");
      $this->db->from("tahun_ajaran");
      $this->db->where("status_ta","Aktif");
      $this->db->where("isDeleted",0);
      
      $query = $this->db->get();
      return $query->row(); //biar gapake indeks ke 0
    }
}
?>