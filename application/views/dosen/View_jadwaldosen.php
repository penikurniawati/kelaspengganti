<?php
$this->load->view('Head_dosen');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <style>
  .custom-size {
    font-size: 18px;
    font-weight: bold;
  }

  .table tbody tr td {
    vertical-align: middle;
  }
</style>

<?php   

function hari_ini(){
  $hari = date("D");

  switch($hari){
    case 'Sun':
    $hari_ini = "Minggu";
    break;

    case 'Mon':     
    $hari_ini = "Senin";
    break;

    case 'Tue':
    $hari_ini = "Selasa";
    break;

    case 'Wed':
    $hari_ini = "Rabu";
    break;

    case 'Thu':
    $hari_ini = "Kamis";
    break;

    case 'Fri':
    $hari_ini = "Jumat";
    break;

    case 'Sat':
    $hari_ini = "Sabtu";
    break;

    default:
    $hari_ini = "Tidak di ketahui";   
    break;
  }

  return "<b>" . $hari_ini . "</b>";

}

function hari_pada_tanggal($date){
  if ($date=="") {
    return "";
  } else {
    $hari = date("D", strtotime($date));

    switch($hari){
      case 'Sun':
      $hari_ini = "Minggu";
      break;

      case 'Mon':     
      $hari_ini = "Senin";
      break;

      case 'Tue':
      $hari_ini = "Selasa";
      break;

      case 'Wed':
      $hari_ini = "Rabu";
      break;

      case 'Thu':
      $hari_ini = "Kamis";
      break;

      case 'Fri':
      $hari_ini = "Jumat";
      break;

      case 'Sat':
      $hari_ini = "Sabtu";
      break;

      default:
      $hari_ini = "Tidak di ketahui";   
      break;
    }

    return $hari_ini;     
  }
}

    //defaultnya get hari pada hari ini :D
    // $hari = hari_pada_tanggal(date("Y-m-d"));
    //$hari = "Senin";

$hari = hari_pada_tanggal(date('Y-m-d'));
$tanggal = date("Y-m-d");

if (!empty($tampilRuangDosen)) {
  $ruangan = array();
  $i = 0;
  foreach ($tampilRuangDosen as $record) {
    $ruangan[$i]= $record->namaRuang;
    $i=$i+1;
  }
}

$this->load->model('JadwalDosenM');
$hasil = $this->JadwalDosenM->getJadwalDosenW("Senin","07.00 - 08.40","HY U-202","Umar Taufiq");
    //echo $hasil[0]->Kelas;

$datasesi = array();

//apabila ada filter tanggal yang dimasukkan
if(!empty($inputtgl)) {
  //get hari pada tanggal yang diinputkan
  $hari = hari_pada_tanggal($inputtgl);
  $tanggal = $inputtgl;
}
?>
<!-- Content Header (Page Header)-->
<SECTION class="content-header">
  <h1><b>Jadwal Prodi Komputer dan Sistem Informasi</b></h1>
  <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Jadwal</a></li>
  </ol>
</SECTION>

<!-- Main Content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php
      $this->load->helper('form');
      $error = $this->session->flashdata('error');
      if($error)
      {
        ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $this->session->flashdata('error'); ?>                    
        </div>
        <?php } ?>
        <?php  
        $success = $this->session->flashdata('success');
        if($success)
        {
          ?>
          <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-12">
              <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
        if (!empty($ruangan)) {
          ?>
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <center><h3 class="box-title"><b>Filter</b></h3></center>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="<?php echo base_url() ?>jadwalDosenR" method="POST" >
                <div class="box-body">
                  <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
                    <div class="col-md-2" style="padding-top: 4px">
                      <label for="inputbulan">Tanggal</label>
                    </div>
                    <div class="col-md-7">
                      <input type="date" class="form-control" id="inputtgl" name="inputtgl" value="<?php echo $tanggal ?>" >
                    </div>
                    <div class="col-md-3">
                      <input type="submit" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info" value="Tampil">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
          <div class="col-xs-12">
            <div class="box box-primary">
              <!-- Box Header -->
              <div class="box-header">
                <h3 class="text-center"><b><?php echo $hari . ", " . date("d F Y", strtotime($tanggal)) ?></b></h3>
              </div>
              <div class="box-body" >
                <table class="table table-bordered table-striped">
                  <!-- Ini kondisi untuk penenuan periode uts dll -->
                  <?php
                  if($cekTahunAjaran->tgl_mulai > $inputtgl){
                    ?>
                    <center><label><b><h3>Bukan Periode Tahun Ajaran</h3></b></label></center>
                    <?php
                    ;}
                    else if($cekTahunAjaran->tgl_mulai_uts <= $inputtgl && $cekTahunAjaran->tgl_terakhir_uts >= $inputtgl){
                      ?>
                      <center><label><b><h3>Masuk Periode UTS</h3></b></label></center>
                      <?php
                      ;}
                      else if($cekTahunAjaran->tgl_mulai_uas <= $inputtgl && $cekTahunAjaran->tgl_terakhir_uas >= $inputtgl){
                        ?>
                        <center><label><b><h3>Masuk Periode UAS</h3></b></label></center>
                        <?php
                        ;}
                        else if($cekTahunAjaran->tgl_terakhir < $inputtgl){
                          ?>
                          <center><label><b><h3>Sudah Melewati Tahun Ajaran</h3></b></label></center>
                          <?php
                          ;}
                          else if($cekTahunAjaran->tgl_mulai_minggutenang <= $inputtgl && $cekTahunAjaran->tgl_terakhir_minggutenang >= $inputtgl){
                            ?>
                            <center><label><b><h3>Masuk Periode Minggu Tenang</h3></b></label></center>
                            <thead>
                              <tr>
                                <th></th>
                                <?php 
                                foreach ($tampilWaktuDosen as $dataWaktuDosen) {
                                 # code...

                                  ?>
                                  <th class="text-center custom-size" ><?php echo $dataWaktuDosen->jam; ?></th>
                                  <?php
                                  array_push($datasesi,$dataWaktuDosen->jam);
                                } 
                                ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              $index = 0;

                              //load model JadwalDosenM
                              $this->load->model('JadwalDosenM');

                              foreach ($ruangan as $ruang) {

                                ?>
                                <tr>
                                  <td class="text-center custom-size"><?php echo $ruang; ?></td>
                                  <?php 
                                  foreach ($datasesi as $sesi) {
                                  # code...
                                    ?>
                                    <!-- Ini kolom mulai sesi pertama -->
                                    <td class="text-center">
                                      <?php
                                      $username = $this->session->userdata('user');
                                      $jadwal = $this->JadwalDosenM->getJadwalDosenW($hari, $sesi, $ruang, $username);
                                      if (!empty($jadwal)) {
                                      // apabila ada jadwal pada cell ini

                                      // cek apakah jadwal ini ada kelas pengganti absen
                                        $cek_kelas_pengganti_absen = $this->JadwalDosenM->getKelasPenggantiDosenCustom($jadwal[0]->id_kelas, $inputtgl, $username);

                                        if (!empty($cek_kelas_pengganti_absen)) {
                                      // apabila pada jadwal pada cell ini terdapat kelas pengganti absen (rescheduling jadwal)

                                          $keterangan = $cek_kelas_pengganti_absen[0]->keterangan;
                                      // $color = "background-color: #ffe7e5;";
                                          ?>

                                          <p style="padding-top: 5px" ><span class="badge bg-red" data-toggle="tooltip" title="<?php echo $keterangan ?>" >Absen</span> <?php echo $jadwal[0]->Kelas."<br>".$jadwal[0]->Dosen; ?></p>
                                          <p><i>diganti pada pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_absen[0]->tgl_hadir)) ?></b></font><br>diruang <u><b><?php echo $cek_kelas_pengganti_absen[0]->nama_ruang ?></b></u></p>

                                          <?php

                                        } 
                                      }
                                      // apabila tidak ada jadwal pada cell ini
                                      // echo "gak ada jadwal pada cell ini";

                                      // cek apakah pada ruangan dan sesi ini (cell ini) ada kelas pengganti hadir
                                      $cek_kelas_pengganti_hadir = $this->JadwalDosenM->getKelasPenggantiHadirDosenCustom($ruang, $sesi, $inputtgl, $username);

                                      if (!empty($cek_kelas_pengganti_hadir)) {
                                      // apabila pada pada cell ini terdapat kelas pengganti hadir (pegganti dari pertemuan sebelumnya)

                                      // if (!empty($cek_kelas_pengganti_hadir[0]->statusPertemuan)) {
                                      // apabila sudah melakukan presensi (sudah ada data pada tabel pertemuan)

                                        ?>

                                        <?php

                                        //} else {
                                        // apabila BELUM melakukan presensi (belum ada data pada tabel pertemuan)

                                        // echo "belum presensi";
                                        ?>

                                        <p style="padding-top: 5px" ><span class="badge bg-blue" >Pengganti</span> <?php echo $cek_kelas_pengganti_hadir[0]->nama_kelas ?></p>
                                        <p><i>pengganti dari pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_hadir[0]->tgl_absen)) ?></b></font></p>
                                        <?php
                                        $statusPertemuanKelasDosen = $this->JadwalDosenM->getPertemuan($cek_kelas_pengganti_hadir[0]->id_kelas_kp, $tanggal, $sesi);

                                        if(!empty($statusPertemuanKelasDosen)){

                                          ?>
                                          <p><label class="label label-<?php echo $statusPertemuanKelasDosen[0]->status_pertemuan == 'Hadir'? 'success' : 'danger'; ?>" <?php if(!empty($statusPertemuanKelasDosen[0]->keterangan)) {echo "data-toggle='tooltip' title='". $statusPertemuanKelasDosen[0]->keterangan ."'";} ?> ><?php echo $statusPertemuanKelasDosen[0]->status_pertemuan; ?></label></p>
                                          <?php
                                        }
                                        else{
                                          ?>
                                          <label class="label label-warning">Belum presensi</label>
                                          <?php
                                      //echo "belum";
                                        }
                                      }

                                      ?>
                                    </td>
                                    <?php 
                                  }
                                  ?>
                                  <!-- ========================================================================= ini adalah akhir dari sesi pertama -->
                                </tr>
                                <?php
                                $index=$index+1;
                              }
                              ?>
                            </tbody>
                            <?php
                            ;}
                            else{
                              ?>
                              <thead>
                                <tr>
                                  <th></th>
                                  <?php 
                                  foreach ($tampilWaktuDosen as $dataWaktuDosen) {
                                 # code...

                                    ?>
                                    <th class="text-center custom-size" ><?php echo $dataWaktuDosen->jam; ?></th>
                                    <?php
                                    array_push($datasesi,$dataWaktuDosen->jam);
                                  } 
                                  ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php

                                $index = 0;

                                //load model JadwalDosenM
                                $this->load->model('JadwalDosenM');

                                foreach ($ruangan as $ruang) {

                                  ?>
                                  <tr>
                                    <td class="text-center custom-size"><?php echo $ruang; ?></td>
                                    <?php 
                                    foreach ($datasesi as $sesi) {
                                    # code...
                                      ?>
                                      <!-- Ini kolom mulai sesi pertama -->
                                      <td class="text-center">
                                        <?php
                                        $username = $this->session->userdata('user');
                                        $jadwal = $this->JadwalDosenM->getJadwalDosenW($hari, $sesi, $ruang, $username);
                                        if (!empty($jadwal)) {
                                        // apabila ada jadwal pada cell ini

                                        // cek apakah jadwal ini ada kelas pengganti absen
                                          $cek_kelas_pengganti_absen = $this->JadwalDosenM->getKelasPenggantiDosenCustom($jadwal[0]->id_kelas, $inputtgl, $username);

                                          if (!empty($cek_kelas_pengganti_absen)) {
                                          // apabila pada jadwal pada cell ini terdapat kelas pengganti absen (rescheduling jadwal)

                                            $keterangan = $cek_kelas_pengganti_absen[0]->keterangan;
                                          // $color = "background-color: #ffe7e5;";
                                            ?>

                                            <p style="padding-top: 5px" ><span class="badge bg-red" data-toggle="tooltip" title="<?php echo $keterangan ?>" >Absen</span> <?php echo $jadwal[0]->Kelas."<br>".$jadwal[0]->Dosen; ?></p>
                                            <p><i>diganti pada pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_absen[0]->tgl_hadir)) ?></b></font><br>diruang <u><b><?php echo $cek_kelas_pengganti_absen[0]->nama_ruang ?></b></u></p>

                                            <?php

                                          } else {
                                          // apabila pada jadwal pada cell ini TIDAK terdapat kelas pengganti absen (rescheduling jadwal)
                                          // echo "kelas pengganti kosong";

                                          // if (empty($jadwal[0]->statusPertemuan) || (!empty($jadwal[0]->statusPertemuan) && $jadwal[0]->tglPertemuan != $tanggal ) ) {
                                          // apabila belum melakukan presensi (belum ada data pada tabel pertemuan)
                                          // echo $jadwal[0]->statusPertemuan . " " . $jadwal[0]->tglPertemuan;
                                            ?>
                                            <div class="col-md-12">
                                              <p><?php echo $jadwal[0]->Kelas."<br>".$jadwal[0]->Dosen; ?></p>

                                              <?php
                                              $statusPertemuanJadwal = $this->JadwalDosenM->getPertemuan($jadwal[0]->id_kelas, $tanggal, $sesi);
                                              if(!empty($statusPertemuanJadwal)){
                                            //ini jika sudah presensi
                                                ?>
                                                <p><label class="label label-<?php echo $statusPertemuanJadwal[0]->status_pertemuan == 'Hadir'? 'success' : 'danger'; ?>" <?php if(!empty($statusPertemuanJadwal[0]->keterangan)) {echo "data-toggle='tooltip' title='". $statusPertemuanJadwal[0]->keterangan ."'";} ?> ><?php echo $statusPertemuanJadwal[0]->status_pertemuan; ?></label></p>
                                                <?php
                                              }else{
                                                ?>
                                                <!-- button kelas_pengganti -->
                                                <a href="<?php echo base_url() ?>kelasPenggantiDosenR/<?php echo $jadwal[0]->id ?>/<?php echo $tanggal ?>" class="btn btn-edit" style="color: #3C8DBC" ><span data-toogle="tooltip" title="Buat Jadwal Pengganti"><i class="fa fa-retweet" ></i></span></a>
                                              </div>
                                              <?php
                                            } 
                                            // else {
                                            //   if ($jadwal[0]->tglPertemuan == $tanggal) {
                                              // apabila sudah melakukan presensi (sudah ada data pada tabel pertemuan) dan tanggal pertemuannya adalah tanggal sekarang.
                                            ?>  
                                            <?php 
                                          }
                                        } else {
                                        // apabila tidak ada jadwal pada cell ini
                                        // echo "gak ada jadwal pada cell ini";

                                        // cek apakah pada ruangan dan sesi ini (cell ini) ada kelas pengganti hadir
                                          $cek_kelas_pengganti_hadir = $this->JadwalDosenM->getKelasPenggantiHadirDosenCustom($ruang, $sesi, $inputtgl, $username);

                                          if (!empty($cek_kelas_pengganti_hadir)) {
                                          // apabila pada pada cell ini terdapat kelas pengganti hadir (pegganti dari pertemuan sebelumnya)

                                         // if (!empty($cek_kelas_pengganti_hadir[0]->statusPertemuan)) {
                                            // apabila sudah melakukan presensi (sudah ada data pada tabel pertemuan)

                                            ?>

                                            <?php
                                            // apabila BELUM melakukan presensi (belum ada data pada tabel pertemuan)

                                            // echo "belum presensi";
                                            ?>

                                            <p style="padding-top: 5px" ><span class="badge bg-blue" >Pengganti</span> <?php echo $cek_kelas_pengganti_hadir[0]->nama_kelas ?></p>
                                            <p><i>pengganti dari pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_hadir[0]->tgl_absen)) ?></b></font></p>
                                            <?php
                                            $statusPertemuanKelasDosen = $this->JadwalDosenM->getPertemuan($cek_kelas_pengganti_hadir[0]->id_kelas_kp, $tanggal, $sesi);

                                            if(!empty($statusPertemuanKelasDosen)){

                                              ?>
                                              <p><label class="label label-<?php echo $statusPertemuanKelasDosen[0]->status_pertemuan == 'Hadir'? 'success' : 'danger'; ?>" <?php if(!empty($statusPertemuanKelasDosen[0]->keterangan)) {echo "data-toggle='tooltip' title='". $statusPertemuanKelasDosen[0]->keterangan ."'";} ?> ><?php echo $statusPertemuanKelasDosen[0]->status_pertemuan; ?></label></p>
                                              <?php
                                            }
                                            else{
                                              ?>
                                              <label class="label label-warning">Belum presensi</label>
                                              <?php
                                            //echo "belum";
                                            }
                                          }
                                        }
                                        ?>
                                      </td>
                                      <?php 
                                    }
                                    ?>
                                    <!-- ========================================================================= ini adalah akhir dari sesi pertama -->
                                  </tr>
                                  <?php
                                  $index=$index+1;
                                }
                                ?>
                              </tbody>
                              <?php
                            }
                            ?>
                          </table>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                  else{
                    ?>
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">  
                          <h4>
                            <center>  
                              Belum ada ruangan
                            </center>
                          </h2>
                        </div>
                      </div>
                      <?php }?>
                    </div>
                  </section>
                </div>
                <script>

                  /** add active class and stay opened when selected */
                  var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
    }).parent().addClass('active');
    
    // for treeview
    $('ul.treeview-menu a').filter(function() {
      return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
  </script>
</body>
<footer class="main-footer">
  <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
</footer>
</html>
