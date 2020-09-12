<?php
$this->load->view('Head_akademik');
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
				<!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <center><h3 class="box-title"><b>Filter</b></h3></center>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="POST" action="<?php echo base_url() ?>mahasiswaAkademikR">
            <div class="box-body">
              <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
               <div class="col-md-2" style="padding-top: 4px">
                <label for="angkatanmhs">Angkatan</label>
              </div>
              <div class="col-md-3">
                <select id="angkatanawal" name="angkatan1" class="form-control required">
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
                <select id="angkatanakhir" name="angkatan2" class="form-control required">
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
            </div> -->
            <!-- <div class="col-md-3" style="text-align: left; padding-left: 10px">
              <input type="number" class="form-control" id="nimakhir" placeholder="NIU akhir">
            </div> -->
          </div>
          <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
           <div class="col-md-2" style="padding-top: 4px">
            <label for="ahli">Nama</label>
          </div>
          <div class="col-md-7">
            <input type="text" name="nama" class="form-control" id="inputnamamhs" placeholder="Nama">
          </div>
          <div class="col-md-3">
            <input type="submit" name="Simpan" value=" Tampil" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info">  	
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
   <div class="box-body">
    <div class="row" style="padding: 15px">
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
     </tr>
   </thead>
   <tbody>
    <?php

    if (!empty($tampilMahasiswaAkademik)) {

      $no = 1;

      foreach ($tampilMahasiswaAkademik as $record) {
                    # code...
        
                  # code...
        
        ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $record->nimMahasiswa; ?></td>
          <td><?php echo $record->namaMahasiswa; ?></td>
          <td><?php echo $record->jkMahasiswa; ?></td>
          <td><?php echo $record->angkatanMahasiswa; ?></td>
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