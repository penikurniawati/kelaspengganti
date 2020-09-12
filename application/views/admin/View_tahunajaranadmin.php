<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Tahun Ajaran Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Tahun Ajaran</a></li>
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
											<th>Tahun Ajaran</th>
											<th>Periode Mulai</th>
											<th>Periode Terakhir</th>
											<th>Status</th>
											<th>Aksi</th>
											<th>Aktifasi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!empty($tampilTahunAjaranAdmin)) {

											$no = 1;
											foreach ($tampilTahunAjaranAdmin as $record) {
												
												?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $record->namaTa; ?></td>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_mulai)); ?></td>
													<td><?php echo date("d - F - Y", strtotime($record->tgl_terakhir)); ?></td>
													<td><?php 
														if($record->statusTa == "Aktif") echo '<span class="label label-success">Aktif</span>';
														else echo '<span class="label label-danger">Tidak  Aktif</span>';
													?></td>
													<td>
														<a class="btn btn-edit" href="<?php echo base_url() ?>detailTahunAjaran/<?php echo $record->idTa; ?>" >
															<span data-toogle="tooltip" title="Detail"><i class="fa fa-eye" style="color: #3C8DBC"></i></span>
														</a>
														<a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->idTa; ?>">
															<span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
														</a>
														<a class="btn btn-edit" data-toggle="modal" data-target="#modalhapus-<?php echo $record->idTa; ?>">
															<span data-toogle="tooltip" title="Hapus"><i class="fa fa-trash" style="color: #ff7849"></i></span>
														</a>
													</td>
													<td>
														<a href="<?php echo base_url() ?>aktifasiTahunAjaran/<?php echo $record->idTa ?>" class="btn btn-edit">
															<span data-toogle="tooltip" title="Aktifkan TA"><i class="fa fa-check-circle" style="color: #3C8DBC"></i></span>
														</a>
													</td>
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
																				<input type="text" name="namaTa" class="form-control" value="<?php echo $record->namaTa; ?>" readonly>
																				
																				<!-- Get id Matkul (hidden) -->
																				<input type="hidden" name="id_ta" value="<?php echo $record->idTa; ?>" >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="tglmulai" class="col-sm-2 control-label" style="text-align: left;">Periode</label>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglmulai" name="tglMulai" value="<?php echo $record->tgl_mulai; ?>" required >
																			</div>
																			<div class="col-sm-2">
																				<label style="margin-left: 25px; margin-top: 5px;">s/d</label>
																			</div>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglterakhir" name="tglTerakhir" value="<?php echo $record->tgl_terakhir; ?>"required >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="uts" class="col-sm-2 control-label" style="text-align: left;">UTS</label>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglmulaiuts" name="tglUts" value="<?php echo $record->tgl_mulai_uts; ?>" required >
																			</div>
																			<div class="col-sm-2">
																				<label style="margin-left: 25px; margin-top: 5px;">s/d</label>
																			</div>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglterakhiruts" name="terakhirUts" value="<?php echo $record->tgl_terakhir_uts; ?>" required >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="responsi" class="col-sm-2 control-label" style="text-align: left;">Responsi</label>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglmulairesponsi" name="tglResponsi" value="<?php echo $record->tgl_mulai_responsi; ?>" required >
																			</div>
																			<div class="col-sm-2">
																				<label style="margin-left: 25px; margin-top: 5px;">s/d</label>
																			</div>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglterakhirresponsi" name="terakhirResponsi" value="<?php echo $record->tgl_terakhir_responsi; ?>" required >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="responsi" class="col-sm-2 control-label" style="text-align: left;">Minggu Tenang</label>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglmulaiminggutenang" name="tglMingguTenang" value="<?php echo $record->tgl_mulai_minggutenang; ?>" required >
																			</div>
																			<div class="col-sm-2">
																				<label style="margin-left: 25px; margin-top: 5px;">s/d</label>
																			</div>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglterakhirminggutenang" name="terakhirMingguTenang" value="<?php echo $record->tgl_terakhir_minggutenang; ?>" required >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="uas" class="col-sm-2 control-label" style="text-align: left;">UAS</label>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglmulaiuas" name="tglUas" value="<?php echo $record->tgl_mulai_uas; ?>" required >
																			</div>
																			<div class="col-sm-2">
																				<label style="margin-left: 25px; margin-top: 5px;">s/d</label>
																			</div>
																			<div class="col-sm-4">
																				<input type="date" class="form-control" id="inputtglterakhiruas" name="terakhirUas" value="<?php echo $record->tgl_terakhir_uas; ?>" required >
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