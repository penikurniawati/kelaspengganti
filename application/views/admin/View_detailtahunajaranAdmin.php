<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b><?php echo $tampilTahunAjaran[0]->nama_ta ; ?></b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Tahun Ajaran</a></li>
		</ol>
	</SECTION>

	<!-- Main Content -->
	<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<!-- Box Header -->
							<div class="box-body">
								<table id="matkuladmin" class="table table-bordered table-striped">
									<!-- <thead>
										<tr>
											<th>No</th>
											<th>Tahun Ajaran</th>
											<th>Periode Mulai</th>
											<th>PeriodeTerakhir</th>
											<th>Status</th>
											<th>Aksi</th>
											<th>Aktifasi</th>
										</tr>
									</thead> -->
									<tbody>
										<?php
										if (!empty($detailTahunAjaranAdmin)) {

											$no = 1;
											foreach ($detailTahunAjaranAdmin as $record) {
												
												?>
												<tr>
													<th>Tahun Ajaran</th>
													<td><?php echo $record->namaTa; ?></td>
												</tr>
												<tr>
													<th>Periode Mulai</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_mulai)); ?></td>
												</tr>
												<tr>
													<th>Periode Terakhir</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_terakhir)); ?></td>
												</tr>
												<tr>
													<th>Mulai UTS</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_mulai_uts)); ?></td>
												</tr>
												<tr>
													<th>Terakhir UTS</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_terakhir_uts)); ?></td>
												</tr>
												<tr>
													<th>Mulai Responsi</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_mulai_responsi)); ?></td>
												</tr>
												<tr>
													<th>Terakhir Responsi</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_terakhir_responsi)); ?></td>
												</tr>
												<tr>
													<th>Mulai Minggu Tenang</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_mulai_minggutenang)); ?></td>
												</tr>
												<tr>
													<th>Terakhir Minggu Tenang</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_terakhir_minggutenang)); ?></td>
												</tr>
												<tr>
													<th>Mulai UAS</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_mulai_uas)); ?></td>
												</tr>
												<tr>
													<th>Terakhir UAS</th>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_terakhir_uas)); ?></td>
												</tr>
												<!-- modal untuk ubah manual -->
												<div class="modal fade" id="modal-<?php echo $record->idTa; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span></button>
																	<h4 class="modal-title"><center>Ubah Tahun Ajaran</center></h4>
																</div>
																<form id="form" class="form-horizontal" action="<?php echo base_url() ?>editTahunAjaran" method="POST" >
																	<div class="modal-body">
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputkode" class="col-sm-2 control-label">Nama</label>
																			<div class="col-sm-10">
																				<input type="text" name="namaTa" class="form-control" value="<?php echo $record->namaTa; ?>">
																				
																				<!-- Get id Matkul (hidden) -->
																				<input type="hidden" name="id_ta" value="<?php echo $record->idTa; ?>" >
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
																		<input type="submit" class="btn btn-primary" value="Simpan">
																	</div>
																</form>
															</div>
															<!-- /.modal-content -->
														</div>
														<!-- /.modal-dialog -->
													</div>
													<!-- /.modal -->
													<!-- modal untuk hapus manual -->
	                        <div class="modal fade" id="modalhapus-<?php echo $record->idTa; ?>">
	                          <div class="modal-dialog">
	                            <div class="modal-content">
	                              <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                  <span aria-hidden="true">&times;</span></button>
	                                  <h4 class="modal-title"><center>Hapus Tahun Ajaran</center></h4>
	                                </div>
	                                <form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusTahunAjaran" method="POST" >
	                                  <div class="modal-body">
	                                    <div class="form-group">
	                                      <div class="row">
	                                        <div class="col-md-12">
	                                      <label for="Mahasiswa" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
	                                      <!-- input hidden -->
	                                      <input type="hidden" name="id_ta" value="<?php echo $record->idTa; ?>" >
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
						<!-- modal untuk tambah manual -->
						<div class="modal fade" id="modal-tambah">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title"><center>Tambah Tahun Ajaran</center></h4>
										</div>
										<form id="form" class="form-horizontal" method="POST" action="<?php echo base_url() ?>inputTahunAjaran">
											<div class="modal-body">
												<div class="form-group">
													<label for="inputkode" class="col-sm-2 control-label" style="text-align: left;">Nama</label>
													<div class="col-sm-10">
														 <input type="text" class="form-control" id="inputnamata" name="namaTa" placeholder="Contoh : Genap 2017/2018" required >
													</div>
												</div>
												<div class="form-group">
													<label for="tglmulai" class="col-sm-2 control-label" style="text-align: left;">Periode</label>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglmulai" name="tglMulai" required >
													</div>
													<div class="col-sm-2">
														 <label style="margin-left: 25px; margin-top: 5px;">s/d</label>
													</div>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglterakhir" name="tglTerakhir" required >
													</div>
												</div>
												<div class="form-group">
													<label for="uts" class="col-sm-2 control-label" style="text-align: left;">UTS</label>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglmulaiuts" name="tglUts" required >
													</div>
													<div class="col-sm-2">
														 <label style="margin-left: 25px; margin-top: 5px;">s/d</label>
													</div>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglterakhiruts" name="terakhirUts" required >
													</div>
												</div>
												<div class="form-group">
													<label for="responsi" class="col-sm-2 control-label" style="text-align: left;">Responsi</label>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglmulairesponsi" name="tglResponsi" required >
													</div>
													<div class="col-sm-2">
														 <label style="margin-left: 25px; margin-top: 5px;">s/d</label>
													</div>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglterakhirresponsi" name="terakhirResponsi" required >
													</div>
												</div>
												<div class="form-group">
													<label for="responsi" class="col-sm-2 control-label" style="text-align: left;">Minggu Tenang</label>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglmulaiminggutenang" name="tglMingguTenang" required >
													</div>
													<div class="col-sm-2">
														 <label style="margin-left: 25px; margin-top: 5px;">s/d</label>
													</div>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglterakhirminggutenang" name="terakhirMingguTenang" required >
													</div>
												</div>
												<div class="form-group">
													<label for="uas" class="col-sm-2 control-label" style="text-align: left;">UAS</label>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglmulaiuas" name="tglUas" required >
													</div>
													<div class="col-sm-2">
														 <label style="margin-left: 25px; margin-top: 5px;">s/d</label>
													</div>
													<div class="col-sm-4">
														 <input type="date" class="form-control" id="inputtglterakhiruas" name="terakhirUas" required >
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
												<input class="btn btn-primary" type="submit" value="Simpan" >
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
							$('#matkuladmin').DataTable()
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