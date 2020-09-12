<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Waktu Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Waktu</a></li>
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
											<button type="button" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
												Tambah
											</button>		
									</div>
									<!-- </div> -->
								</div>
								<table id="matkuladmin" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Hari</th>
											<th>Sesi</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!empty($tampilWaktuAdmin)) {

											$no = 1;
											foreach ($tampilWaktuAdmin as $record) {
												
												?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $record->hari; ?></td>
													<td><?php echo $record->sesi; ?></td>
													<td>
														<a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->idWaktu; ?>">
															<span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
														</a>
														<a class="btn btn-edit" data-toggle="modal" data-target="#modalhapus-<?php echo $record->idWaktu; ?>">
                      				<span data-toogle="tooltip" title="Hapus"><i class="fa fa-trash" style="color: #ff7849"></i></span>
                    				</a>
													</td>
												</tr>
												<!-- modal untuk ubah manual -->
												<div class="modal fade" id="modal-<?php echo $record->idWaktu; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span></button>
																	<h4 class="modal-title"><center>Ubah Waktu</center></h4>
																</div>
																<form id="form" class="form-horizontal" action="<?php echo base_url() ?>editWaktu" method="POST" >
																	<div class="modal-body">
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputkode" class="col-sm-2 control-label">Hari</label>
																			<div class="col-sm-10">
																				<input type="text" name="hari" class="form-control" value="<?php echo $record->hari; ?>" readonly>
																				
																				<!-- Get id Matkul (hidden) -->
																				<input type="hidden" name="id_waktu" value="<?php echo $record->idWaktu; ?>" >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputnama" class="col-sm-2 control-label">Sesi</label>
																			<div class="col-sm-10">
																				<input type="text" class="form-control" name="sesi" value="<?php echo $record->sesi; ?>" required>
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
	                        <div class="modal fade" id="modalhapus-<?php echo $record->idWaktu; ?>">
	                          <div class="modal-dialog">
	                            <div class="modal-content">
	                              <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                  <span aria-hidden="true">&times;</span></button>
	                                  <h4 class="modal-title"><center>Hapus Waktu</center></h4>
	                                </div>
	                                <form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusWaktu" method="POST" >
	                                  <div class="modal-body">
	                                    <div class="form-group">
	                                      <div class="row">
	                                        <div class="col-md-12">
	                                      <label for="Mahasiswa" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
	                                      <!-- input hidden -->
	                                      <input type="hidden" name="id_waktu" value="<?php echo $record->idWaktu; ?>" >
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
											<h4 class="modal-title"><center>Tambah Waktu</center></h4>
										</div>
										<form id="form" class="form-horizontal" method="POST" action="<?php echo base_url() ?>inputWaktu">
											<div class="modal-body">
												<div class="form-group">
													<label for="inputkode" class="col-sm-2 control-label">Hari</label>
													<div class="col-sm-10">
														 <select id="hari" name="hari" class="form-control required">
															<option value="" disabled selected=""> <i>---Pilih Hari---</i></option>
															<option value="Senin">Senin</option>
															<option value="Selasa">Selasa</option>
															<option value="Rabu">Rabu</option>
															<option value="Kamis">Kamis</option>
															<option value="Jumat">Jumat</option>
															<option value="Sabtu">Sabtu</option>
															<option value="Minggu">Minggu</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="inputnama" class="col-sm-2 control-label">Sesi</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="inputnama" name="sesi" placeholder="Contoh : 07:00-08:40" required >
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