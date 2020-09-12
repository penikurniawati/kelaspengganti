<?php
$this->load->view('Head_dosen');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page Header)-->
  <SECTION class="content-header">
    <h1><b>Jadwal Pengganti Prodi Komputer dan Sistem Informasi</b></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Jadwal Pengganti</a></li>
      <li><a href="#">Harian</a></li>
    </ol>
  </SECTION>
    <!-- Main Content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
              <center><h3 class="box-title"><b>Cek Ketersediaan</b></h3></center>
            </div>
            <!-- /.box-header -->
          <!-- Box Header -->
          <div class="box-body">
            <!-- <div class="col-md-3" style="padding-bottom: 10px; padding-top: 10px;">
              <div class="input-group input-group-sm">
                <input type="date" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" style="background-color: #3C8DBC">Tampil</button>
                    </span>
              </div>
            </div> -->
            <div class="col-md-3" style="padding-bottom: 10px; padding-top: 10px;">
              <div class="input-group input-group-sm">
                <input type="date" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" style="background-color: #3C8DBC">Tampil</button>
                    </span>
              </div>
            </div>
            <div class="row" style="padding: 15px">
            </div>
            <table id="jadwaladmin1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Ruang</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Senin</td>
                  <td>07.00 - 09.40</td>
                  <td>HY S-202</td>
                </tr>
                <tr>
                  <td>Senin</td>
                  <td>07.00 - 09.40</td>
                  <td>HY U-123</td>
                </tr>
                <tr>
                  <td>Senin</td>
                  <td>14.00 - 15.40</td>
                  <td>HY U-123</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <center><h3 class="box-title"><b>Kelas Pengganti</b></h3></center>
              <center><div style="font-size: 14px;"><b>Komputasi Numerik</b></div></center>
              <center><div style="font-size: 13px;"><b>Komnum C 2016</b></div></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form role="form">
              <div class="box-body">
                <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 140px">
                  <div class="col-md-3" style="padding-top: 4px">
                    <label for="inputnip">Tanggal</label>
                  </div>
                  <div class="col-md-7">
                    <input type="date" class="form-control" id="inputtgl" placeholder="Tgl">
                  </div>
                </div>
                 <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 140px">
                  <div class="col-md-3" style="padding-top: 4px">
                    <label for="inputnama">Waktu</label>
                  </div>
                  <div class="col-md-7">
                    <select id="pilihkelas" name="namakls" class="form-control required">
                      <option value="" disabled selected=""> <i>---Pilih Waktu---</i></option>
                      <option>07.00 - 09.40</option>
                      <option>09.00 - 10.40</option>
                      <option>12.00 - 13.40</option>
                      <option>14.00 - 15.40</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 140px">
                  <div class="col-md-3" style="padding-top: 4px">
                    <label for="inputnama">Ruang</label>
                  </div>
                  <div class="col-md-7">
                    <select id="pilihkelas" name="namakls" class="form-control required">
                      <option value="" disabled selected=""> <i>---Pilih Ruang---</i></option>
                      <option>HY S-201</option>
                      <option>HY S-202</option>
                      <option>HY U-202</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 50px; padding-top: 20px; padding-bottom: 20px;">
                  <div class="col-md-1">

                  </div>
                  <div class="col-md-7" style="padding-left: 20px;">
                    <button type="button" style="background-color: #A9A9A9; border-color: #A9A9A9; color: #fff; text-align: right;" class="btn btn-info">
                  Batal
                </button>
                  </div>
                  <div class="col-md-2" style="padding-left: 95px;">
                    <button type="button" style="background-color: #3C8DBC; color: #fff; text-align: right;" class="btn btn-info">
                  Simpan
                </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box -->
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
</script>
</body>
 <footer class="main-footer">
    <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
  </footer>
</html>