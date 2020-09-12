<?php
$this->load->view('Head_akademik');
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
				<!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <center><h3 class="box-title"><b>Filter</b></h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form role="form">
              <div class="box-body">
                <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
                	<div class="col-md-2" style="padding-top: 4px">
                		<label for="ahli">Nama</label>
                	</div>
                	<div class="col-md-7">
                		<input type="text" class="form-control" id="inputkeahlian" placeholder="Nama">
                	</div>
                	<div class="col-md-3">
                		<button type="button" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
									Tampil
								</button>	
                	</div>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box -->
			</div>
			<div class="col-xs-12">
				<div class="box">
					<!-- Box Header -->
					<div class="box-body" style="padding-top: 30px;">
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
								</tr>
							</thead>
							<tbody>
                <?php

                if (!empty($tampilDosenAkademik)) {
                  $no = 1;
                  foreach ($tampilDosenAkademik as $record) {
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
                </tr>
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