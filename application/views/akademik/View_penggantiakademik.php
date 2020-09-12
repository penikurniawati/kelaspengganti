<?php
$this->load->view('Head_akademik');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page Header)-->
  <SECTION class="content-header">
    <h1><b>Jadwal Pengganti Prodi Komputer dan Sistem Informasi</b></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Jadwal Pengganti</a></li>
    </ol>
  </SECTION>

  <!-- Main Content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <center><h4><b>Berikut adalah daftar kelas kosong yang harus dilaksanakan jadwal pengganti</b></h4></center>
          <!-- Box Header -->
          <div class="box-body" style="padding-top: 30px;">
            <table id="jadwaladmin1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kelas</th>
                  <th>Dosen</th>
                  <th>Hari</th>
                  <th>Tgl</th>
                  <th>Sesi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                        if (!empty($tampilKelasKosong)) {

                           $no = 1;
                          foreach ($tampilKelasKosong as $record) {
                          $hari = date('D', strtotime($record->tglPertemuan));
                          $listHari = array(
                            'Sun' => 'Minggu',
                            'Mon' => 'Senin',
                            'Tue' => 'Selasa',
                            'Wed' => 'Rabu',
                            'Thu' => 'Kamis',
                            'Fri' => 'Jumat',
                            'Sat' => 'Sabtu');
                          ?>  
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $record->namaKelas; ?></td>
                  <td><?php echo $record->namaDosen; ?></td>
                  <td><?php echo $listHari[$hari]; ?></td>
                  <td><?php echo date("d - F - Y", strtotime($record->tglPertemuan)); ?></td>
                  <td><?php echo $record->sesi; ?></td>
                  <td>
                    <a href="<?php echo base_url() ?>kelasPenggantiPR/<?php echo $record->idJadwal ?>/<?php echo $record->tglPertemuan ?>/<?php echo $record->idPertemuan ?>" class="btn btn-edit" style="color: #3C8DBC" ><span data-toogle="tooltip" title="Buat Jadwal Pengganti"><i class="fa fa-retweet" ></i></span>
                    </a>
                  </td>
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