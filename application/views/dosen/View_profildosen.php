<?php
$this->load->view('Head_dosen');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Profil</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Profil</a></li>
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
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="img-responsive img-circle" src="<?php echo base_url('gambar/ugm.png')?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $this->session->userdata('nama');?></h3>
              <p class="text-muted text-center">Dosen</p>
              <!-- <a href="#" class="btn btn-primary btn-block">Ubah Foto</a> -->
              <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#ubahprofil">Ubah Profil</a>
              <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#ubahpass">Ubah Password</a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body box-profile">
               <div class="box-header with-border">
                  <center><h3 class="box-title"><b>Profil</b></h3></center>
              </div>
              <?php
                  if (!empty($tampilProfilDosen)) {
                  foreach ($tampilProfilDosen as $record) {      
              ?>
              <div class="col-md-9" style="padding-top: 10px;">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>NIP</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->nip ?></b></h5></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>Nama</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->nama_dosen ?></b></h5></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>Jenis Kelamin</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->jk_dosen ?></b></h5></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>Tanggal Lahir</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->tgl_lahir ?></b></h5></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>No HP</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->nohp ?></b></h5></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>E - mail</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->email ?></b></h5></label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="col-md-4">
                  <label class="control-label"><h5><b>Alamat</b></h5></label>
                </div>
                <div class="col-md-5">
                  <label class="control-label"><h5><b>: <?php echo $record->alamat ?></b></h5></label>
                </div>
              </div>
              </div>
            </div>
          </div>
            <!-- modal untuk ubah password manual -->
            <div class="modal fade" id="ubahpass">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><center>Ubah Password</center></h4>
                  </div>
                  <div class="modal-body">
                     <form id="form" class="form-horizontal" action="<?php echo base_url() ?>editPasswordDosenR" method="POST" >
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">Password Lama</label>
                      <div class="col-sm-10">
                        <input type="password" name="passlama" required="" class="form-control" id="passlama">
                        <input type="hidden" name="id_user" value="<?php echo $record->id_user; ?>" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnama" class="col-sm-2 control-label">Password Baru</label>
                      <div class="col-sm-10">
                        <input type="password" name="passbaru1" required="" class="form-control" id="passbaru1">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnama" class="col-sm-2 control-label">Konfirmasi Password Baru *</label>
                      <div class="col-sm-10">
                        <input type="password" name="passbaru2" required="" class="form-control" id="passbaru2">
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

            <!-- modal untuk ubah profil -->
            <div class="modal fade" id="ubahprofil">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><center>Ubah Profil</center></h4>
                  </div>
                  <div class="modal-body">
                     <form id="form" class="form-horizontal" action="<?php echo base_url() ?>editProfilDosenR" method="POST" >
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">NIP</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          <input type="text" class="form-control" value="<?php echo $record->nip; ?>" readonly>

                          <!-- get id dosen hidden -->
                          <input type="hidden" name="id_dosen" value="<?php echo $record->id_dosen; ?>" >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">Nama</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" id="namadosen" name="nama" value="<?php echo $record->nama_dosen; ?>" readonly >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">JK</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-male"></i></span>
                            <select id="jkDosen" name="jkDosen" class="form-control required">
                              <option value="" disabled selected=""> <i>---Pilih Jenis Kelamin---</i></option>
                              <option value="Laki - Laki" <?php if($record->jk_dosen == "Laki - Laki") {echo "selected=selected";} ?> >Laki - Laki</option>
                              <option value="Perempuan" <?php if($record->jk_dosen == "Perempuan") {echo "selected=selected";} ?> >Perempuan</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">Tgl Lahir</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="date" class="form-control" id="tgldosen" name="tglLahir" value="<?php echo $record->tgl_lahir; ?>"  required >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">No HP</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                          <input type="number" class="form-control" id="nohpdosen" name="noHp" value="<?php echo $record->nohp; ?>"  required >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">E - mail</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-at"></i></span>
                          <input type="email" class="form-control" id="emaildosen" name="email" value="<?php echo $record->email; ?>"  required >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputnip" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home"></i></span>
                          <input type="text" class="form-control" id="alamatdosen" name="alamat" value="<?php echo $record->alamat; ?>"  required >
                        </div>
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
             <?php
                }
              }
            ?> 
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      </div>
	</section>
</div>
</body>
 <footer class="main-footer">
    <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
  </footer>
</html>