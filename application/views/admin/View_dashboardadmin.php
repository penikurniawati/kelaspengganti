<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Baranda</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Beranda</a></li>
		</ol>
	</SECTION>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $jumlahDosen[0]->jumDosen; ?></h3>
              <p>Jumlah Dosen</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo base_url() ?>dosenAdminR" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $jumlahKelas[0]->jumKelas; ?></h3>

              <p>Jumlah Kelas Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="<?php echo base_url() ?>kelasAdminR"" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $jumlahRuang[0]->jumRuang; ?></h3>

              <p>Jumlah Ruangan</p>
            </div>
            <div class="icon">
              <i class="fa fa-columns"></i>
            </div>
            <a href="<?php echo base_url() ?>ruangAdminR"" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $jumlahMatkul[0]->jumMatkul; ?></h3>

              <p>Jumlah Mata Kuliah</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="<?php echo base_url() ?>matkulAdminR"" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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