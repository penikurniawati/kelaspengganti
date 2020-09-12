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
           <form id="form" class="form-horizontal" action="<?php echo base_url() ?>aksiNonaktifKelas" method="POST">
           <div class="box-body">
            <div class="row" style="padding: 15px">
             <div class="col-md-12" style="padding-bottom: 10px; text-align: right;">
                <div class="col-md-10" style="text-align: left;">
                  <h4><b>Non Aktif kelas sesuai dengan jumlah data show entry yang ditampilkan</b></h4>
                </div>
                <div class="col-md-2">
                <input type="submit" style="padding-right: 15px" class="btn btn-warning" value="Non Aktif Kelas">
              </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->
            
          </div>
          <table id="jadwaladmin1" class="table table-bordered table-striped">
           <thead>
            <tr>
             <th>No</th>
             <th>Nama Kelas</th>
             <th>Mata Kuliah</th>
             <th>Dosen</th>
             <th>Jml Mhs</th>
             <th>Grup</th>
             <th>Status</th>
             <th>Aksi</th>
           </tr>
         </thead>
         <tbody>
           <?php

           if (!empty($tampilKelasAdminAktif)) {
            $no = 1;
            foreach ($tampilKelasAdminAktif as $record) {
                  # code...

              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $record->namaKelas; ?></td>
                <td><?php echo $record->matkul; ?></td>
                <td><?php echo $record->dosen; ?></td>
                <td><?php echo $record->jumMhs; ?></td>
                <td><?php echo $record->grup; ?></td>
                <td><?php echo $record->statusKelas; ?></td>
                  <td><input type="checkbox" name="nonaktif[]" checked="" value="<?php echo $record->id ?>"></td>
              </tr>
              <?php
              $no=$no+1;
            }
          }
          ?>
        </tbody>
      </table>
    </form>
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