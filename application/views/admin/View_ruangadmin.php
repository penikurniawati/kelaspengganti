<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page Header)-->
  <SECTION class="content-header">
    <h1><b>Ruang Prodi Komputer dan Sistem Informasi</b></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Ruang</a></li>
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
                  <th>Nama Ruang</th>
                  <th>Jenis Ruang</th>
                  <th>Kapasitas</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($tampilRuangAdmin)) {
                  # code...
                  $no = 1;

                  foreach ($tampilRuangAdmin as $record) {
                    # code...
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $record->namaRuang; ?></td>
                  <td><?php echo $record->jenisRuang; ?></td>
                  <td><?php echo $record->kapasitasRuang; ?></td>
                  <td>
                    <a class="btn btn-edit">
                      <span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" data-toggle="modal" data-target="#modal-<?php echo $record->id; ?>" style="color: #00a65a"></i></span>
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
                          <h4 class="modal-title"><center>Ubah Ruang</center></h4>
                        </div>
                        <div class="modal-body">
                           <form id="form" class="form-horizontal" method="POST" action="<?php echo base_url()?>ubahRuang ">
                          <div class="form-group" style="padding: 15px 0;">
                            <label for="inputnip" class="col-sm-2 control-label">Nama Ruang</label>
                            <div class="col-sm-10">
                              <input type="text" name="namaRuang" class="form-control" id="nama" required="" value="<?php echo $record->namaRuang; ?>">
                              <input type="hidden" name="id_ruang" value="<?php echo $record->id; ?>">
                            </div>
                          </div>
                          <div class="form-group" style="padding: 15px 0;">
                            <label for="inputjenis" class="col-sm-2 control-label">Jenis</label>
                            <div class="col-sm-10">
                              <input type="text" name="jenisRuang" class="form-control" id="Jenis" required="" value="<?php echo $record->jenisRuang; ?>">
                            </div>
                          </div>
                          <div class="form-group" style="padding: 15px 0;">
                            <label for="inputkapasitas" class="col-sm-2 control-label">Kapasitas</label>
                            <div class="col-sm-10">
                               <input type="number" name="kapasitasRuang" class="form-control" id="Kapasitas" required="" value="<?php echo $record->kapasitasRuang; ?>">
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
                                  <h4 class="modal-title"><center>Hapus Ruang</center></h4>
                                </div>
                                <form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusRuang" method="POST" >
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-md-12">
                                      <label for="Mahasiswa" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
                                      <!-- input hidden -->
                                      <input type="hidden" name="id_ruang" value="<?php echo $record->id; ?>" >
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
      <form action="<?php echo base_url() ?>importRuang" method="POST" enctype="multipart/form-data">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>Import Ruang</center></h4>
              </div>
              <div class="modal-body">
                <div class="callout callout-danger">
                    <h4>PERHATIAN</h4>
                      <p>Pastikan format penulisan sudah sesuai dengan contoh agar data dapat dibaca oleh sistem. Sistem hanya membaca file dalam format <b> xlsx</b></p>
                      <p>Dokumen excel bisa diunduh <a href="<?php echo base_url('berkas/ruang.xlsx')?>"><b> di sini</b></a></p>
                  </div>
                <img src="<?php echo base_url('gambar/ruang.png')?>" style="width: 100%;height: 40%; padding-bottom: 15px;">
                <label for="importMatkul"><b>Jika format sudah sesuai, silahkan unggah file</b></label>
                <input name="file" type="File" id="inputruang" required="">
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
          <!-- /.modal-dialog -->
        </form>
        </div>
        <!-- /.modal -->
  <!-- modal tambah manual -->
    <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
        <form role="form" class="form-horizontal" action="<?php echo base_url() ?>inputRuang" method="POST" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Ruang</h4>
            </div>
            <div class="modal-body">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputnamaruang" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputnamaruang" name="namaRuang" placeholder="Nama Ruang" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputjenisruang" class="col-sm-2 control-label">Jenis</label>
                  
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenis" name="jenisRuang" placeholder="Jenis Ruang" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputkapasitasruang" class="col-sm-2 control-label">Kapasitas</label>
                  
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputkapasitasruang" name="kapasitasRuang" placeholder="Kapasitas Ruang" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
          </div>
        </form>
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