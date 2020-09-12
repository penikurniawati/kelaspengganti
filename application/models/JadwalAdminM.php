<?php
class JadwalAdminM extends CI_Model{

    //ini untuk nanti ruangan
  	public function getJadwalAdmin(){
  		$this->db->select("j.id_jadwal AS id, w.id_waktu AS idWaktu, w.hari AS hari, w.jam AS jam, mk.id_mk AS idMK, mk.nama_MK AS matkul, k.id_kelas AS idKelas, k.nama_kelas AS namaKelas, d.id_dosen AS idDosen, d.nama_dosen AS dosen, r.id_ruang AS idRuang, r.nama_ruang AS namaRuang, ta.id_ta AS idTa, ta.nama_ta AS semester");
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
      $this->db->GROUP_BY("r.nama_ruang");
      $this->db->where("j.isDeleted",0);
       $this->db->where("ta.status_ta","Aktif");
  		$query = $this->db->get();
  		return $query->result();
  	}

    //Yang dipakai ini untuk dipanggil ke view
    //get jadwal dengan parameter hari waktu ruang
    public function getJadwalW($hari, $waktu, $ruangan){
      $this->db->select("j.id_jadwal AS id, w.hari AS Hari, w.jam AS Waktu, w.id_waktu AS idWaktu, mk.nama_MK AS Matkul, k.nama_kelas AS Kelas, d.nama_dosen AS Dosen, r.nama_ruang AS Ruang, ta.nama_ta AS Semester");
      $this->db->from("jadwal j");
      $this->db->join("kelas k","k.id_kelas = j.id_kelas");
      $this->db->join("mata_kuliah mk","mk.id_mk = k.id_matkul");
      $this->db->join("kelas_dosen kd","kd.id_kelas = k.id_kelas");
      $this->db->join("tahun_ajaran ta","ta.id_ta = j.id_ta");
      $this->db->join("waktu w","w.id_waktu = j.id_waktu");
      $this->db->join("ruang r","r.id_ruang = j.id_ruang");
      $this->db->join("dosen d","d.id_dosen = kd.id_dosen");
       $this->db->where("ta.status_ta","Aktif");
      $this->db->where("w.hari",$hari);
      $this->db->where("w.jam",$waktu);
      $this->db->where("r.nama_ruang",$ruangan);
      $this->db->where("j.isDeleted",0);
      $query = $this->db->get();
      return $query->result();
    }

   public function ubahJadwal($dataJadwal,$id){
      $this->db->where("id_jadwal",$id);
      $this->db->update("jadwal",$dataJadwal);
      return true;
    }

    public function hapusJadwal($dataJadwal,$id){
      $this->db->where("id_jadwal",$id);
      $this->db->update("jadwal",$dataJadwal);
      return true;
    }

    public function getRuangWaktu(){
      $this->db->select("r.nama_ruang AS namaRuang, r.id_ruang AS idRuang, w.id_waktu AS idWaktu, w.jam AS jam, w.hari AS hari");
      $this->db->from("jadwal j");
      $this->db->join("ruang r","r.id_ruang = j.id_ruang");
      $this->db->join("waktu w","w.id_waktu = j.id_waktu");
      $this->db->where("j.isDeleted",0);
      $this->db->GROUP_BY("r.nama_ruang");
      $query = $this->db->get();
      return $query->result();
    }

    public function getWaktu(){
      $this->db->select("*");
      $this->db->from("waktu");
      $this->db->where("isDeleted",0);
      $query = $this->db->get();
      return $query->result();
    }

    public function getWaktuAdmin(){
      $this->db->select("jam");
      $this->db->from("waktu");
      $this->db->where("isDeleted",0);
      $this->db->group_by("jam");
      $query = $this->db->get();
      return $query->result(); 
    }

    public function getRuang(){
      $this->db->select("*");
      $this->db->from("ruang");
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

    public function getTa(){
      $this->db->select("*");
      $this->db->from("tahun_ajaran");
      $this->db->where("isDeleted",0);
      $this->db->where("status_ta","Aktif");
      $query = $this->db->get();
      return $query->result();
    }

    public function getKelas(){
      $this->db->select("*");
      $this->db->from("kelas");
      $this->db->where("isDeleted",0);
      $this->db->where("status_kelas","Aktif");
      $query = $this->db->get();
      return $query->result();
    }


    public function insertJadwal($dataJadwal){
      $this->db->trans_start();
        
        $this->db->insert('jadwal',$dataJadwal);
        $insert_id = $this->db->insert_id();
      
        $this->db->trans_complete();
        return $insert_id;
    }

    function cekJadwal($waktu){
        $this->db->select("id_waktu");
        $this->db->from("jadwal");
        $this->db->where("id_waktu","$waktu");
        $this->db->where("isDeleted",0);

        $query = $this->db->get();
        return $query->result();
    }

    function cekKelas($waktu, $kelas){
        $this->db->select("id_waktu, id_kelas");
        $this->db->from("jadwal");
        $this->db->where("id_waktu","$waktu");
        $this->db->where("id_kelas","$kelas");
        $this->db->where("isDeleted",0);

        $query = $this->db->get();
        return $query->result();
    }

    function cekRuang($waktu, $kelas, $ruang){
        $this->db->select("id_waktu, id_kelas, id_ruang");
        $this->db->from("jadwal");
        $this->db->where("id_waktu","$waktu");
        $this->db->where("id_kelas","$kelas");
        $this->db->where("id_ruang","$ruang");
        $this->db->where("isDeleted",0);

        $query = $this->db->get();
        return $query->result();
    }
  
}
?>