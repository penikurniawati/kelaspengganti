<?php
$this->load->view('Head_akademik');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Data Kelas Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
      <li><a href="#">Kelas</a></li>
			<li><a href="#">Data Kelas</a></li>
		</ol>
	</SECTION>

	<!-- Main Content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<!-- Box Header -->
					<div class="box-body">
						<div class="row" style="padding: 15px">
						</div>
						<table id="jadwaladmin1" class="table table-bordered table-striped">
							<thead>
								<tr>
						             <th>No</th>
						             <th>Mata Kuliah</th>
						             <th>Nama Kelas</th>
						             <th>Dosen</th>
						             <th>Jumlah Mahasiswa</th>
						             <th>Grup</th>
						             <th>Status</th>
					           	</tr>
							</thead>
							<tbody>
							<?php

					           if (!empty($tampilKelasAkademik)) {
					            $no = 1;
					            foreach ($tampilKelasAkademik as $record) {
					                  # code...

				            ?>
				              <tr>
				                <td><?php echo $no; ?></td>
				                <!-- ini berfungsi untuk get id berdasarkan yang dipilih -->
				                <td><?php echo $record->matkul; ?></td>
				                <td><a href="<?php echo base_url() ?>detailKelasAkademik/<?php echo $record->id; ?>"> <?php echo $record->namaKelas; ?></a></td>
				                <td><?php echo $record->dosen; ?></td>
				                <td><?php echo $record->jumMhs; ?></td>
				                <td><?php echo $record->grup; ?></td>
				                <td><?php echo $record->statusKelas; ?></td>
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