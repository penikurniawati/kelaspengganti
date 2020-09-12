<?php
$this->load->view('Head_dosen');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Mata Kuliah Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Mata Kuliah</a></li>
		</ol>
	</SECTION>

	<!-- Main Content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<!-- Box Header -->
					<div class="box-body" style="padding-top: 30px;">
						<table id="jadwaladmin1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode MK</th>
									<th>Mata Kuliah</th>
									<th>SKS</th>
									<th>Kategori</th>
									<th>Batas Pertemuan</th>
								</tr>
							</thead>
							<tbody>
								<?php
	                				if (!empty($tampilMatkulDosen)) {
	                  				# code...
	                  				$no = 1;

	                  				foreach ($tampilMatkulDosen as $record) {
	                    			# code...
                				?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $record->kodeMK; ?></td>
									<td><?php echo $record->namaMK; ?></td>
									<td><?php echo $record->sksMK; ?></td>
									<td><?php echo $record->kategoriMK; ?></td>
									<td><?php echo $record->batasPertemuan; ?></td>
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