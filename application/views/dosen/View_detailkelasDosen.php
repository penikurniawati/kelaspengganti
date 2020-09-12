<?php
$this->load->view('Head_dosen');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page Header)-->
  <SECTION class="content-header">
    <h1><b>Mahasiswa <?php echo $tampilKelasDosen[0]->kelas ; ?></b></h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Kelas</a></li>
      <li><a href="#">Mahasiswa</a></li>
    </ol>
  </SECTION>

  <!-- Main Content -->
  <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <!-- Box Header -->
              <div class="box-body">
                <table id="jadwaladmin1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Status</th>
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

          </script>
        </body>
        <footer class="main-footer">
          <strong><center>Copyright &copy; Sistem Informasi Kelas Pengganti KOMSI</center></strong>
        </footer>
        </html>