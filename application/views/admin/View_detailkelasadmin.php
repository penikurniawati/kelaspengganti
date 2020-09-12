<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page Header)-->
  <SECTION class="content-header">
    <h1><b>Mahasiswa <?php echo $tampilKelasAdmin[0]->kelas ; ?></b></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Kelas</a></li>
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
          <div class="col-xs-12">
            <div class="box">
              <!-- Box Header -->
              <div class="box-body">
                <div class="row" style="padding: 15px">
                  <div class="col-md-12" style="padding-bottom: 10px; text-align: right;">
                    <div class="col-md-11">
                      <button type="button" style="background-color: #00A65A; border-color: #00A65A color: #fff; padding-right: 15px" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Import Excel
                      </button> 
                    </div>
                    <div class="col-md-1">
                      <button type="button" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">Tambah
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
                      <th>Jenis Kelamin</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (!empty($detailKelasMhs)) {
                      $no = 1;
                      foreach ($detailKelasMhs as $record) {
                # code...

                        ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $record->nim; ?></td>
                          <td><?php echo $record->namaMhs; ?></td>
                          <td><?php echo $record->jkMhs; ?></td>
                          <td><?php echo $record->statusMhs; ?></td>
                          <td>
                            <a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->idkm; ?>"><span data-toogle="tooltip" title="Ubah">
                              <i class="fa fa-edit" style="color: #00a65a"></i></span>
                            </a>
                          </td>
                        </tr>
                        <!-- modal ubah manual -->
                        <div class="modal fade" id="modal-<?php echo $record->idkm; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title"><center>Ubah Kelas Mahasiswa</center></h4>
                                </div>
                                <form id="form" class="form-horizontal" action="<?php echo base_url() ?>ubahKelasMhs" method="POST" >
                                <div class="modal-body">
                                    <div class="box-body">
                                      <div class="form-group" style="padding: 15px 0;">
                                        <label for="nim" class="col-sm-2 control-label">NIM</label>
                                        <div class="col-sm-10">
                                           <input type="text" name="id_mahasiswa" class="form-control" value="<?php echo $record->nim; ?>" readonly>
                                           <input type="hidden" name="id_kelasmahasiswa" class="form-control" value="<?php echo $record->idkm; ?>" readonly>
                                           <input type="hidden" name="id_kelas" value="<?php echo $tampilKelasAdmin[0]->id_kelas ; ?>">
                                        </div>
                                      </div>

                                      <div class="form-group" style="padding: 15px 0;">
                                        <label for="nama" class="col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-10">
                                          <input type="text" name="namaMhs" class="form-control" value="<?php echo $record->namaMhs; ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group" style="padding: 15px 0;">
                                        <label for="status" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">
                                          <select id="status" name="statusMhs" class="form-control required">
                                              <option value="Aktif" <?php if($record->statusMhs == "Aktif") {echo "selected=selected";} ?> >Aktif</option>
                                              <option value="Tidak Aktif" <?php if($record->statusMhs == "Tidak Aktif") {echo "selected=selected";} ?> >Tidak Aktif</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                 <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
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
            <!-- /.modal -->
            <form action="<?php echo base_url() ?>importKelasMahasiswa" method="POST" enctype="multipart/form-data">
              <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><center>Import Kelas Mahasiswa</center></h4>
                      <input type="text" name="id_kelas_import" value="<?php echo $this->uri->segment(2);?>" hidden>
                    </div>
                    <div class="modal-body">
                      <div class="callout callout-danger">
                        <h4>PERHATIAN</h4>
                          <p>Pastikan format penulisan sudah sesuai dengan contoh agar data dapat dibaca oleh sistem. Sistem hanya membaca file dalam format <b> xlsx</b></p>
                          <p>Dokumen excel bisa diunduh <a href="<?php echo base_url('berkas/kelasMahasiswa.xlsx')?>"><b> di sini</b></a></p>
                      </div>
                      <img src="<?php echo base_url('gambar/KelasMahasiswaAdmin.png')?>" style="width: 100%;height: 40%; padding-bottom: 15px;">
                      <label for="importKelasMahasiswa"><b>Jika format sudah sesuai, silahkan unggah file</b></label>
                      <input name="file" type="File" id="importKelasMahasiswa" required="">
                      <p class="help-block">File maksimal 10 MB</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" class="btn btn-primary" name="simpan" value="Simpan" style="background-color: #00A65A; border-color: #00A65A;">
                      <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
            </form>
            <!-- modal tambah manual -->
            <div class="modal fade" id="modal-tambah">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tambah Mahasiswa</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="POST" action="<?php echo base_url() ?>inputKelasMhs">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="nim" class="col-sm-2 control-label">NIM</label>
                            <div class="col-sm-10">
                              <select name="id_mahasiswa" class="form-control required">
                                <option value="" disabled selected=""> <i>---Pilih NIM---</i></option>
                                <?php
                                foreach ($mahasiswa as $record) {
                                  ?>
                                  <option value="<?php echo $record->id_mahasiswa ?>"><?php echo $record->nim ?> - <?php echo $record->nama_mahasiswa ?></option>
                                  <?php   
                                }
                                ?>
                              </select>
                              <input type="hidden" name="id_kelas" value="<?php echo $tampilKelasAdmin[0]->id_kelas ; ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="jk" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                              <select id="Status" name="statusMhs" class="form-control required">
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- /.box-body -->

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
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

          </script>
        </body>
        <footer class="main-footer">
          <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
        </footer>
        </html>