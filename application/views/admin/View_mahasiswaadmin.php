<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Mahasiswa Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Mahasiswa</a></li>
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
              <form role="form" method="POST" action="<?php echo base_url() ?>mahasiswaAdminR">
              <div class="box-body">
                <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
                	<div class="col-md-2" style="padding-top: 4px">
                		<label for="inputangkatanmhs">Angkatan</label>
                	</div>
                	<div class="col-md-3">
                		<select name="angkatan1" class="form-control required">
                      <option value="" disabled selected=""> <i>---Pilih Angkatan---</i></option>
                      <?php
                      foreach ($angkatan as $dataangkatan) {
                        ?>
                        <option value="<?php echo $dataangkatan->angkatanMhs ?>"><?php echo $dataangkatan->angkatanMhs ?></option>
                        <?php   
                      }
                      ?>
                    </select>
                	</div>
                	<div class="col-md-1" style="padding-top: 4px">
                		<label for="inputsampai">sampai</label>
                	</div>
                	<div class="col-md-3" style="text-align: left; padding-left: 10px">
                		<select name="angkatan2" class="form-control required">
                      <option value="" disabled selected=""> <i>---Pilih Angkatan---</i></option>
                      <?php
                      foreach ($angkatan as $dataangkatan) {
                        ?>
                        <option value="<?php echo $dataangkatan->angkatanMhs ?>"><?php echo $dataangkatan->angkatanMhs ?></option>
                        <?php   
                      }
                      ?>
                    </select>
                	</div>
                </div>
                <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
                	<div class="col-md-2" style="padding-top: 4px">
                		<label for="inputnama">NIU <label style="font-size: 12px; font-style: italic"><sup>(6 digit)</sup></label></label>
                	</div>
                	<div class="col-md-7">
                    <input name="niu" type="number" class="form-control" id="nimawal" placeholder="NIU">
                  </div>
                  <!-- <div class="col-md-1" style="padding-top: 4px">
                    <label for="inputsampai">sampai</label>
                  </div>
                  <div class="col-md-3" style="text-align: left; padding-left: 10px">
                    <input type="number" class="form-control" id="nimakhir" placeholder="NIU akhir">
                  </div> -->
                </div>
                <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
                	<div class="col-md-2" style="padding-top: 4px">
                		<label for="ahli">Nama</label>
                	</div>
                	<div class="col-md-7">
                		<input name="nama" type="text" class="form-control" id="inputnamamhs" placeholder="Nama">
                	</div>
                	<div class="col-md-3">
                		<input type="submit" name="Simpan" value=" Tampil" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info">	
                	</div>
                </div>
              </div>
          <!--   <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">NIP</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Keahlian</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
              </div> -->
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
			</div>
			<div class="col-xs-12">
				<div class="box">
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
						<table id="jadwaladmin1" class="table table-bordered table-striped">
							<thead>
								<tr>
                  <th>No</th>
									<th>NIM</th>
                  <th>Nama</th>
                  <th>JK</th>
                  <th>Angkatan</th>
                  <th>Aksi</th>
								</tr>
							</thead>
							<tbody>
                <?php

                if (!empty($tampilMahasiswaAdmin)) {

                  $no = 1;

                  foreach ($tampilMahasiswaAdmin as $record) {
                    # code...
                  
                  # code...
                
                ?>
								<tr>
									<td><?php echo $no; ?></td>
                  <td><?php echo $record->nimMahasiswa; ?></td>
                  <td><?php echo $record->namaMahasiswa; ?></td>
                  <td><?php echo $record->jkMahasiswa; ?></td>
                  <td><?php echo $record->angkatanMahasiswa; ?></td>
                  <td>
                    <a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->id; ?>">
                      <span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
                    </a>
                    <a class="btn btn-edit" data-toggle="modal" data-target="#modalhapus-<?php echo $record->id; ?>">
                      <span data-toogle="tooltip" title="Hapus"><i class="fa fa-trash" style="color: #ff7849"></i></span>
                    </a>
                  </td>
								</tr>
              <!-- modal untuk ubah manual -->
               <div class="modal fade" id="modal-<?php echo $record->id; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"><center>Ubah Mahasiswa</center></h4>
                        </div>
                        <div class="modal-body">
                           <form id="form" class="form-horizontal" method="POST" action="<?php echo base_url()?>ubahMahasiswa">
                          <div class="form-group" style="padding: 15px 0">
                            <label for="inputnim" class="col-sm-2 control-label">NIM</label>
                            <div class="col-sm-10">
                              <input type="text" name="nim" class="form-control" id="inputnim" value="<?php echo $record->nimMahasiswa; ?>" disabled>
                              <input type="hidden" name="id" value="<?php echo $record->id; ?>">
                            </div>
                          </div>
                          <div class="form-group" style="padding: 15px 0">
                            <label for="inputnama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                              <input type="text" name="nama" class="form-control" id="inputnama" value="<?php echo $record->namaMahasiswa; ?>">
                            </div>
                          </div>
                           <div class="form-group" style="padding: 15px 0">
                            <label for="jeniskl" class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                              <select name="jk" class="form-control required">
                                <option <?php if($record->jkMahasiswa == "Laki - Laki") {echo "selected=selected";} ?> value="Laki - Laki">Laki - Laki</option>
                                <option <?php if($record->jkMahasiswa == "Perempuan") {echo "selected=selected";} ?>value="Perempuan">Perempuan</option>
                              </select>
                          </div>
                        </div>
                          <div class="form-group" style="padding: 15px 0">
                            <label for="angkatan" class="col-sm-2 control-label">Angkatan</label>
                            <div class="col-md-10">
                              <input type="text" name="angkatan" class="form-control" id="inputangkatan" value="<?php echo $record->angkatanMahasiswa; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                          <input type="submit" value="Simpan" class="btn btn-primary">
                        </div>
                      </div>
                      </form>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                        <!-- modal untuk hapus manual -->
                        <div class="modal fade" id="modalhapus-<?php echo $record->id; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title"><center>Hapus Mahasiswa</center></h4>
                                </div>
                                <form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusMahasiswa" method="POST" >
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-12">
                                      <label for="Mahasiswa" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
                                      <!-- input hidden -->
                                      <input type="hidden" name="id_mahasiswa" value="<?php echo $record->id; ?>" >
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
		 <div class="modal fade" id="modal-default">
      <form action="<?php echo base_url() ?>importMahasiswa" method="POST" enctype="multipart/form-data">
         	<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>Import Mahasiswa</center></h4>
              </div>
              <div class="modal-body">
                <div class="callout callout-danger">
                    <h4>PERHATIAN</h4>
                      <p>Pastikan format penulisan sudah sesuai dengan contoh agar data dapat dibaca oleh sistem. Sistem hanya membaca file dalam format <b> xlsx</b></p>
                      <p>Dokumen excel bisa diunduh <a href="<?php echo base_url('berkas/mahasiswa.xlsx')?>"><b> di sini</b></a></p>
                  </div>
                <img src="<?php echo base_url('gambar/mahasiswa.png')?>" style="width: 100%;height: 40%; padding-bottom: 15px;">
                <label for="importMatkul"><b>Jika format sudah sesuai, silahkan unggah file</b></label>
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
      <!-- modal untuk tambah manual -->
     <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>Tambah Mahasiswa</center></h4>
              </div>
              <div class="modal-body">
                 <form id="form" class="form-horizontal" action="<?php echo base_url() ?>inputMahasiswa" method="POST">
                <div class="form-group">
                  <label for="inputnim" class="col-sm-2 control-label">NIM</label>
                  <div class="col-sm-10">
                    <input type="text" name="nim" class="form-control" id="inputnim" placeholder="NIM" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputnama" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="inputnama" placeholder="Nama" required="">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="inputnama" class="col-sm-2 control-label">JK</label>
                  <div class="col-sm-10">
                    <select id="jeniskl" name="jk" class="form-control required" required="">
                      <option value="" disabled selected=""> <i>---Pilih Jenis Kelamin---</i></option>
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="angkatan" class="col-sm-2 control-label">Angkatan</label>
                  <div class="col-sm-10">
                    <input type="text" name="angkatan" id="angkatan" class="form-control" id="inputnama" placeholder="Angkatan" required="">
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <input type="submit" class="btn btn-primary" value="Simpan">
              </div>
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