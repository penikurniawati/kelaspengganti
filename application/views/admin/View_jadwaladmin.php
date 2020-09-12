<?php
// print_r($waktu);exit();
$this->load->view('Head_admin');
?>

<style>
.select2-container--default .select2-selection--single {
  border-radius: 0px;
  border-color: #d2d6de;
  box-shadow: none;
}

.select2-container .select2-selection--single {
  height: 34px;
}
</style>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <?php 
  if (!empty($tampilRuangAdmin)) {
    $ruangan = array();
    $i = 0;
    foreach ($tampilRuangAdmin as $record) {
        //if ($record->Ruang=="Labkom 6" && $record->Waktu=="07.00 - 08.40" && $record->Hari=="Senin") {
          //echo $record->namaRuang;
      $ruangan[$i]= $record->namaRuang;
      $i=$i+1;
          //echo $record->Dosen;
        //}
        //$labkom67=$labkom67+1;
    }
  }

    // $this->load->model('JadwalAdminM');
    // $hasil = $this->JadwalAdminM->getJadwalW("Senin","07.00 - 08.40","HY U-202");
    //echo $hasil[0]->Kelas;

  //ini adalah arrray data sesi
  $datasesi = array();
  ?>

  <!-- Content Header (Page Header)-->
  <SECTION class="content-header">
    <h1><b>Jadwal Kuliah Prodi Komputer dan Sistem Informasi</b></h1>
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
       <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <center><h3 class="box-title"><b>Filter</b></h3></center>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="<?php echo base_url() ?>jadwalAdminR" method="POST" >
            <div class="box-body">
              <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
               <div class="col-md-2" style="padding-top: 4px">
                <label for="labelhari">Hari</label>
              </div>
              <div class="col-md-7">
                <select id="inputhari" name="inputhari" class="form-control required">
                  <option value="" disabled selected=""> <i>---Pilih Hari---</i></option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                  <option>Sabtu</option>
                </select>
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
      <div class="box">
        <div class="box-header">
          <h3 class="text-center"><b><?php echo $tampilHari ?></b></h3>
        </div>
        <!-- Box Header -->
        <div class="box-body">
          <div class="row" style="padding: 15px">
           <div class="col-md-12" style="padding-bottom: 10px; text-align: right;">
            <div class="col-md-11">
              <button type="button" style="background-color: #00A65A; border-color: #00A65A color: #fff; padding-right: 15px" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Import Excel
              </button> 
            </div>
            <div class="col-md-1">
              <button type="button" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
                Tambah
              </button>
            </div>  
          </div>
          <!-- </div> -->
        </div>
        <table id="jadwaladmin" class="table table-bordered table-striped">
         <thead>
          <tr>
           <th></th>
           <?php 
           //ini untuk menampilkan data waktu di jadwal
           foreach ($tampilWaktuAdmin as $dataWaktuAdmin) {
            # code...

            ?>
            <th class="text-center custom-size" ><?php echo $dataWaktuAdmin->jam; ?></th>
            <?php
            array_push($datasesi,$dataWaktuAdmin->jam);
          } 
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        //print_r($tampilRuangAdmin);exit();
        //ini untuk memeunculkan nama ruangan 
        if (!empty($tampilRuangAdmin)) {

          $index = 0;

          $this->load->model('JadwalAdminM');
          foreach ($tampilRuangAdmin as $record) {

            ?>
            <tr>
              <!-- ini untuk memunculkan nama ruang di tabel jadwal -->
              <td><b><center><?php echo $record->namaRuang; ?></center></b></td>
              <?php 
              foreach ($datasesi as $sesi) {
              # code...
                ?>
                <td>
                  <center>
                    <?php
                    //$hasil adalah hasil atau keluaran dari function jadwal biar bisa dimunculkan, $tampilhari untuk tau itu hari apa, $record->namaruang untuk tau ruangan mana, $sesi untuk tau sesi mana
                    $hasil = $this->JadwalAdminM->getJadwalW($tampilHari,$sesi,$record->namaRuang);
                    if (!empty($hasil)) {
                      echo $hasil[0]->Kelas."<br>".$hasil[0]->Dosen;
                      ?>
                      <br>
                      <a class="btn btn-edit" onclick="editModal(<?php echo $hasil[0]->id?>)" data-toggle="modal" >
                        <span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
                      </a>
                      <a class="btn btn-edit" onclick="hapusModal(<?php echo $hasil[0]->id?>)" data-toggle="modal">
                        <span data-toogle="tooltip" title="Hapus"><i class="fa fa-trash" style="color: #ff7849"></i></span>
                      </a>
                      <?php
                    }

                    ?>
                  </center>
                </td>
                <?php 
              }
              ?>
            </tr>
            <?php
            $index=$index+1;
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<!-- modal untuk tambah manual -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><center>Tambah Jadwal</center></h4>
        </div>
        <div class="modal-body">
         <form id="formAddJadwal" class="form-horizontal" method="POST" action="<?php echo base_url() ?>inputJadwal">
          <div class="form-group">
            <label for="inputnamaruang" class="col-sm-2 control-label">Waktu</label>
            <div class="col-sm-10">
              <select name="waktu" class="form-control required" required="">
                <option value="" disabled selected=""> <i>---Pilih Waktu---</i></option>
                <?php
                foreach ($waktu as $datawaktu) {
                  ?>
                  <option value="<?php echo $datawaktu->id_waktu ?>"><?php echo $datawaktu->hari ?> ( <?php echo $datawaktu->jam ?> )</option>
                  <?php   
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputmatkul" class="col-sm-2 control-label">Kelas</label>
            <div class="col-sm-10">
              <select name="kelas" class="form-control required" required="">
                <option value="" disabled selected=""> <i>---Pilih Kelas---</i></option>
                <?php
                foreach ($kelas as $datakelas) {
                  ?>
                  <option value="<?php echo $datakelas->id_kelas ?>"><?php echo $datakelas->nama_kelas ?> </option>
                  <?php   
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputkelas" class="col-sm-2 control-label">Ruang</label>
            <div class="col-sm-10">
              <select name="ruang" class="form-control required" required="">
                <option value="" disabled selected=""> <i>---Pilih Ruang---</i></option>
                <?php
                foreach ($ruang as $dataruang) {
                  ?>
                  <option value="<?php echo $dataruang->id_ruang ?>"><?php echo $dataruang->nama_ruang ?> </option>
                  <?php   
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputdosen" class="col-sm-2 control-label">Tahun</label>
            <div class="col-sm-10">
             <!-- <select name="tahun" class="form-control required"> -->
              <!-- <option value="" disabled selected=""> <i>---Pilih Tahun---</i></option> -->
              <?php
              foreach ($tahun as $datatahun) {
                ?>
                <input type="text" name="tahun" class="form-control" value="<?php echo $datatahun->nama_ta; ?>" readonly>
                 <input type="hidden" name="tahun" class="form-control" value="<?php echo $datatahun->id_ta; ?>">
                <!-- <option value="<?php echo $datatahun->id_ta ?>"><?php echo $datatahun->nama_ta ?> </option> -->
                <?php   
              }
              ?>
            <!-- </select> -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <input class="btn btn-primary" id="saveAddJadwal" type="submit" value="Simpan" >
      </div>
    </div>
  </form>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-default">
  <form action="<?php echo base_url() ?>importJadwal" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><center>Import Jadwal</center></h4>
          </div>
          <div class="modal-body">
            <div class="callout callout-danger">
              <h4>PERHATIAN</h4>
              <p>Pastikan format penulisan sudah sesuai dengan contoh agar data dapat dibaca oleh sistem. Sistem hanya membaca file dalam format <b> xlsx</b></p>
              <p>Dokumen excel bisa diunduh <a href="<?php echo base_url('berkas/jadwal.xlsx')?>"><b> di sini</b></a></p>
            </div>
            <img src="<?php echo base_url('gambar/jadwalImport.png')?>" style="width: 100%;height: 40%; padding-bottom: 15px;">
            <label for="importJadwal"><b>Jika format sudah sesuai, silahkan unggah file</b></label>
            <input type="File" id="inputmhs" name="file" required="">
            <p class="help-block">File maksimal 10 MB</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary" style="background-color: #00A65A; border-color: #00A65A;">
            <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </form>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- modal untuk hapus manual -->
  <div class="modal fade" id="modalhapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><center>Hapus Jadwal</center></h4>
          </div>
          <form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusJadwal" method="POST" >
            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="Mahasiswa" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
                  <!-- input hidden -->
                  <input type="hidden" name="id" id="id_record" value="<?php echo $record->id; ?>" >
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-12">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <input type="submit" class="btn btn-primary" value="Hapus">
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- modal ubah -->
    <div class="modal fade" id="modaledit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><center>Ubah Jadwal</center></h4>
            </div>
            <div class="modal-body">
              <form  id="formEditJadwal" class="form-horizontal" action="<?php echo base_url() ?>ubahJadwal" method="POST">

                <div class="form-group">
                  <label for="inputnamaruang" class="col-sm-2 control-label">Waktu</label>
                  <div class="col-sm-10">
                    <select name="waktu" id="waktuedit" class="form-control required">
                      <?php
                      foreach ($waktu as $datawaktu) {
                        ?>
                        <option value="<?php echo $datawaktu->id_waktu ?>"><?php echo $datawaktu->hari ?> ( <?php echo $datawaktu->jam ?> )</option>
                        <?php   
                      }
                      ?>
                    </select>
                    <!-- Get id jadwal (hidden) -->
                    <input type="hidden" name="id" id="id_record" value="<?php echo $record->id; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputmatkul" class="col-sm-2 control-label">Kelas</label>
                  <div class="col-sm-10">
                    <select name="kelas" id="kelasedit" class="form-control required">
                     <?php
                     foreach ($kelas as $datakelas) {
                      ?>
                      <option value="<?php echo $datakelas->id_kelas ?>"><?php echo $datakelas->nama_kelas ?> </option>
                      <?php   
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputkelas" class="col-sm-2 control-label">Ruang</label>
                <div class="col-sm-10">
                  <select name="ruang" id="ruangedit" class="form-control required">
                   <?php
                   foreach ($ruang as $dataruang) {
                    ?>
                    <option value="<?php echo $dataruang->id_ruang ?>"><?php echo $dataruang->nama_ruang ?> </option>
                    <?php   
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputruang" class="col-sm-2 control-label">Semester</label>
              <div class="col-sm-10">
                <select name="tahun" id="tahunedit" class="form-control required">
                  <?php
                  foreach ($tahun as $datatahun) {
                    ?>
                    <option value="<?php echo $datatahun->id_ta ?>"><?php echo $datatahun->nama_ta ?> </option>
                    <?php   
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            <!-- <input type="submit" class="btn btn-primary" value="Simpan"> -->
            <input class="btn btn-primary" id="saveEditJadwal" type="submit" value="Simpan" >
          </div>
        </div>
      </form>
    </div>
  </div>

</section>


</div>
</div>
</div>
</div>
</section>
</div>
<script>
  $(function () {
    $('#jadwaladmin').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  
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
  <script>
    $(document).ready(function() {
       $('#saveAddJadwal').click(function(event) { // <- goes here !
        $.ajax({
          url :"<?php echo base_url()."jadwaladminc/ajax_cekValidateAddJadwal"?>",
          type:"POST",
          async: false,
          data:$("#formAddJadwal").serialize(),
          dataType:"JSON",
          success:function (data) { 
            if (data.status === false) {
              event.preventDefault();  
              alert(data.pesan);
            }
          }
        });
      });

      $('#saveEditJadwal').click(function(event) { // <- goes here !
        $.ajax({
          url :"<?php echo base_url()."jadwaladminc/ajax_cekValidateAddJadwal"?>",
          type:"POST",
          async: false,
          data:$("#formEditJadwal").serialize(),
          dataType:"JSON",
          success:function (data) { 
            if (data.status === false) {
              event.preventDefault();  
              alert(data.pesan);
            }

          }
        });
        
      }); 
    });

    
    

    function getDataEditAjax(id) {
      $.ajax({
        url :"<?php echo base_url()."jadwaladminc/ajax_getdataedit"?>",
        type:"POST",
        data:{'id': id},
        dataType:"JSON",
        success:function (data) {
          $("#waktuedit").val(data.id_waktu).change();
          $("#kelasedit").val(data.id_kelas).change();
          $("#ruangedit").val(data.id_ruang).change();
          $("#tahunedit").val(data.id_ta).change();  
        }
      });
    }
    function editModal(id) {
      console.log(id)
      $('#modaledit').modal('show');
      $('#modaledit #id_record').val(id)
      getDataEditAjax(id);
    }
    
    function getDataHapusAjax(id) {
      $.ajax({
        url :"<?php echo base_url()."jadwaladminc/ajax_getdatahapus"?>",
        type:"POST",
        data:{'id': id},
        dataType:"JSON",
        success:function (data) {
          $("#waktuedit").val(data.id_waktu).change();
          $("#kelasedit").val(data.id_kelas).change();
          $("#ruangedit").val(data.id_ruang).change();
          $("#tahunedit").val(data.id_ta).change();  
        }
      });
    }
    function hapusModal(id) {
      console.log(id)
      $('#modalhapus').modal('show');
      $('#modalhapus #id_record').val(id)
      getDataHapusAjax(id);
    }
    
  </script>
</body>
<footer class="main-footer">
  <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
</footer>
</html>