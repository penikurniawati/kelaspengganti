<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Kelas Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
      <li><a href="#">Kelas</a></li>
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
         <div class="col-xs-12">
          <div class="box">
           <!-- Box Header -->
           <div class="box-body">
            <div class="row" style="padding: 15px">
             <div class="col-md-12" style="padding-bottom: 10px; text-align: right;">
              <div class="col-md-9">
                <a href="<?php echo base_url() ?>nonaktifKelas"><button type="button" style=" margin-left: 675px" class="btn btn-warning">
                  Non Aktif Kelas
                </button></a>
              </div>
              <div class="col-md-2">
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
            <!-- </div> -->
            
          </div>
          <table id="jadwaladmin1" class="table table-bordered table-striped">
           <thead>
            <tr>
             <th>No</th>
             <th>Mata Kuliah</th>
             <th>Nama Kelas</th>
             <th>Dosen</th>
             <th>Jml Mhs</th>
             <th>Grup</th>
             <th>Status</th>
             <th>Aksi</th>
           </tr>
         </thead>
         <tbody>
           <?php

           if (!empty($tampilKelasAdmin)) {
            $no = 1;
            foreach ($tampilKelasAdmin as $record) {
                  # code...

              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <!-- ini berfungsi untuk get id berdasarkan yang dipilih -->
                <td><?php echo $record->matkul; ?></td>
                <td>
                  <a href="<?php echo base_url() ?>detailKelas/<?php echo $record->id; ?>"> <?php echo $record->namaKelas; ?></a>
                </td>
                <td><?php echo $record->dosen; ?></td>
                <td><?php echo $record->jumMhs; ?></td>
                <td><?php echo $record->grup; ?></td>
                <td><?php echo $record->statusKelas; ?></td>
                <td>
                  <a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->idkd; ?>">
                    <span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
                  </a>
                  <a class="btn btn-edit" data-toggle="modal" data-target="#modalhapus-<?php echo $record->idkd; ?>">
                    <span data-toogle="tooltip" title="Hapus"><i class="fa fa-trash" style="color: #ff7849"></i></span>
                  </a>
                </td>
              </tr>
                      <!-- modal untuk ubah manual -->
                      <div class="modal fade" id="modal-<?php echo $record->idkd; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><center>Ubah Kelas</center></h4>
                              </div>
                              <form id="form" class="form-horizontal" action="<?php echo base_url() ?>editKelas" method="POST" >
                                <div class="modal-body">
                                  <div class="form-group" style="padding: 15px 0;">
                                    <label for="inputkode" class="col-sm-2 control-label">Kelas</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="namaKelas" class="form-control" value="<?php echo $record->namaKelas; ?>" readonly>
                                      
                                      <!-- Get id Kelasdosen (hidden) -->
                                      <input type="hidden" name="id_dosenkelas" value="<?php echo $record->idkd; ?>" >
                                    </div>
                                  </div>
                                  <div class="form-group" style="padding: 15px 0;">
                                    <label for="inputmatkul" class="col-sm-2 control-label">Matkul</label>
                                    <div class="col-sm-10">
                                      <select name="namaMatkul" class="form-control required">
                                        <?php
                                        foreach ($matkul as $datamatkul) {
                                          ?>
                                          <!-- record itu yang udah didefinisikan AS -->
                                          <option <?php if ($datamatkul->id_mk == $record->idMatkul) {echo "selected=selected";} ?> value="<?php echo $datamatkul->id_mk ?>"><?php echo $datamatkul->nama_MK ?></option>
                                          <?php   
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" style="padding: 15px 0;">
                                    <label for="inputdosen" class="col-sm-2 control-label">Dosen</label>
                                    <div class="col-sm-10">
                                      <select name="namaDosen" class="form-control required">
                                        <?php
                                        foreach ($dosen as $datadosen) {
                                          ?>
                                          <option <?php if ($datadosen->id_dosen == $record->idd) {echo "selected=selected";} ?> value="<?php echo $datadosen->id_dosen ?>"><?php echo $datadosen->nama_dosen ?></option>
                                          <?php   
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" style="padding: 15px 0;">
                                    <label for="inputgrup" class="col-sm-2 control-label">Grup</label>
                                    <div class="col-sm-10">
                                     <select name="namaGrup" class="form-control required">
                                      <?php
                                      foreach ($grup as $datagrup) {
                                        ?>
                                        <option <?php if ($datagrup->id_grup == $record->idgrup) {echo "selected=selected";} ?> value="<?php echo $datagrup->id_grup ?>"><?php echo $datagrup->nama_grup ?></option>
                                        <?php   
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group" style="padding: 15px 0;">
                                  <label for="inputsks" class="col-sm-2 control-label">Status</label>
                                  <div class="col-sm-10">
                                    <select id="grup" name="statusKelas" class="form-control required">
                                      <option value="" disabled selected=""> <i>---Pilih Kategori---</i></option>
                                      <option value="Aktif" <?php if($record->statusKelas == "Aktif") {echo "selected=selected";} ?> >Aktif</option>
                                      <option value="Tidak Aktif" <?php if($record->statusKelas == "Tidak Aktif") {echo "selected=selected";} ?> >Tidak Aktif</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                              </div>
                            </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->
                        <!-- modal untuk hapus manual -->
                        <div class="modal fade" id="modalhapus-<?php echo $record->idkd; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title"><center>Hapus Kelas</center></h4>
                                </div>
                                <form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusKelas" method="POST" >
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-12">
                                      <label for="inputsks" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
                                      <!-- input hidden -->
                                      <input type="hidden" name="id_kelas" value="<?php echo $record->id; ?>" >
                                    </div>
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
              <?php
              $no=$no+1;
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<form action="<?php echo base_url() ?>importKelas" method="POST" enctype="multipart/form-data">
  <div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><center>Import Kelas</center></h4>
        </div>
        <div class="modal-body">
          <div class="callout callout-danger">
            <h4>PERHATIAN</h4>
              <p>Pastikan format penulisan sudah sesuai dengan contoh agar data dapat dibaca oleh sistem. Sistem hanya membaca file dalam format <b> xlsx</b></p>
              <p>Dokumen excel bisa diunduh <a href="<?php echo base_url('berkas/kelasDosen.xlsx')?>"><b> di sini</b></a></p>
          </div>
          <img src="<?php echo base_url('gambar/Kelas_Dosen.png')?>" style="width: 100%;height: 40%; padding-bottom: 15px;">
          <label for="importKelas"><b>Jika format sudah sesuai, silahkan unggah file</b></label>
          <input name="file" type="File" id="importKelas" required="">
          <p class="help-block">File maksimal 10 MB</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-primary" name="simpan" value="Simpan" style="background-color: #00A65A; border-color: #00A65A;">
          <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</form>
  <!-- modal untuk tambah manual -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><center>Tambah Data Kelas</center></h4>
          </div>
          <div class="modal-body">
           <form id="form" class="form-horizontal" method="POST" action="<?php echo base_url() ?>inputKelas">
            <div class="form-group">
              <label for="inputnama" class="col-sm-2 control-label">Matkul</label>
              <div class="col-sm-10">
                <select name="namaMatkul" class="form-control required">
                  <option value="" disabled selected=""> <i>---Pilih Mata Kuliah---</i></option>
                  <?php
                  foreach ($matkul as $record) {
                    ?>
                    <option value="<?php echo $record->id_mk ?>"><?php echo $record->nama_MK ?></option>
                    <?php   
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputgrup" class="col-sm-2 control-label">Grup</label>
              <div class="col-sm-10">
                <select name="namaGrup" class="form-control required">
                  <option value="" disabled selected=""> <i>---Pilih Grup---</i></option>
                  <?php
                  foreach ($grup as $record) {
                    ?>
                    <option value="<?php echo $record->id_grup ?>"><?php echo $record->nama_grup ?></option>
                    <?php   
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="namakelas" class="col-sm-2 control-label">Kelas</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputnama" name="namaKelas" placeholder="Nama Kelas" required >
              </div>
            </div>
            <div class="form-group">
              <label for="inputgrup" class="col-sm-2 control-label">Dosen</label>
              <div class="col-sm-10">
                <select name="namaDosen" class="form-control required">
                  <option value="" disabled selected=""> <i>---Pilih Dosen---</i></option>
                  <?php
                  foreach ($dosen as $record) {
                    ?>
                    <option value="<?php echo $record->id_dosen ?>"><?php echo $record->nama_dosen ?></option>
                    <?php   
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="status" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select id="status" name="statusKelas" class="form-control required">
                  <option>Aktif</option>
                  <option>Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
            <input type="submit" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</section>


</div>
<script>
  $(function () {
    $('#jadwaladmin1').DataTable()
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
</body>
<footer class="main-footer">
  <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
</footer>
</html>