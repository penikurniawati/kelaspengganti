<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Dosen Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Dosen</a></li>
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
          
          <!-- /.box -->
			</div>
			<div class="col-xs-12">
				<div class="box">
					<!-- Box Header -->
					<div class="box-body">
						<table id="jadwaladmin1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
                  <th>NIP</th>
									<th>Nama</th>
                  <th>JK</th>
                  <th>Ttl</th>
                  <th>No HP</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
								</tr>
							</thead>
							<tbody>
                <?php

                if (!empty($tampilDosenAdmin)) {
                  $no = 1;
                  foreach ($tampilDosenAdmin as $record) {
                    # code...

                ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $record->nipDosen; ?></td>
                  <td><?php echo $record->namaDosen; ?></td>
                  <td><?php echo $record->jkDosen; ?></td>
                  <td><?php echo $record->tglDosen; ?></td>
                  <td><?php echo $record->nohpDosen; ?></td>
                  <td><?php echo $record->emailDosen; ?></td>
                  <td><?php echo $record->alamatDosen; ?></td>
                  <td>
                    <a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->id; ?>">
                      <span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
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
                        <h4 class="modal-title"><center>Ubah Dosen</center></h4>
                      </div>
                      <div class="modal-body">
                         <form id="form" class="form-horizontal" method="POST" action="<?php echo base_url()?>ubahDosen ">
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputnip" class="col-sm-2 control-label">NIP</label>
                          <div class="col-sm-10">
                            <input type="text" name="nip" class="form-control" id="inputnip" value="<?php echo $record->nipDosen; ?>" readonly>
                            <input type="hidden" name="id" value="<?php echo $record->id; ?>">
                          </div>
                        </div>
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputnama" class="col-sm-2 control-label">Nama</label>
                          <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control" id="inputnama" value="<?php echo $record->namaDosen; ?>" readonly>
                          </div>
                        </div>
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputnama" class="col-sm-2 control-label">Jenis Kelamin</label>
                          <div class="col-sm-10">
                            <select name="jk" class="form-control required">
                              <option <?php if($record->jkDosen == "Laki - Laki") {echo "selected=selected";} ?> value="Laki - Laki">Laki - Laki</option>
                              <option <?php if($record->jkDosen == "Perempuan") {echo "selected=selected";} ?> value="Perempuan">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputttl" class="col-sm-2 control-label">Ttl</label>
                          <div class="col-sm-10">
                            <input type="date" name="ttl" class="form-control" id="inputttl" value="<?php echo $record->tglDosen; ?>">
                          </div>
                        </div>
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputnohp" class="col-sm-2 control-label">No HP</label>
                          <div class="col-sm-10">
                            <input type="number" name="nohp" class="form-control" id="inputttl" value="<?php echo $record->nohpDosen; ?>">
                          </div>
                        </div>
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputemail" class="col-sm-2 control-label">E-mail</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputemail" value="<?php echo $record->emailDosen; ?>">
                          </div>
                        </div>
                        <div class="form-group" style="padding: 15px 0;">
                          <label for="inputalamat" class="col-sm-2 control-label">Alamat</label>
                          <div class="col-sm-10">
                            <input type="text" name="alamat" class="form-control" id="inputalamat" value="<?php echo $record->alamatDosen; ?>">
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
         	<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>Import Dosen</center></h4>
              </div>
              <div class="modal-body">
                <label for="inputjadwal"><b>File</b></label>
                <input type="File" id="inputjadwal">
                <p class="help-block">File maksimal 500 KB</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" style="background-color: #00A65A; border-color: #00A65A;">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
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
                <h4 class="modal-title"><center>Tambah Dosen</center></h4>
              </div>
              <div class="modal-body">
                 <form id="form" class="form-horizontal" action="<?php echo base_url() ?>inputDosen" method="POST">
                <div class="form-group">
                  <label for="inputnip" class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nip" id="inputnip" placeholder="NIP">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputnama" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="inputnama" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputnama" class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select name="jk">
                      <option value="Laki - Laki">Laki - Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <input type="submit" value="Simpan" class="btn btn-primary">
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