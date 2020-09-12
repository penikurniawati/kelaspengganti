<?php
$this->load->view('Head_admin');
?>

<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page Header)-->
	<SECTION class="content-header">
		<h1><b>Mata Kuliah Prodi Komputer dan Sistem Informasi</b></h1>
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Mata Kuliah</a></li>
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
								<table id="matkuladmin" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode MK</th>
											<th>Mata Kuliah</th>
											<th>SKS</th>
											<th>Kategori</th>
											<th>Batas Pertemuan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!empty($tampilMatkulAdmin)) {

											$no = 1;
											foreach ($tampilMatkulAdmin as $record) {
												
												?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $record->kodeMK; ?></td>
													<td><?php echo $record->namaMK; ?></td>
													<td><?php echo $record->sksMK; ?></td>
													<td><?php echo $record->kategoriMK; ?></td>
													<td><?php echo $record->batasPertemuan; ?></td>
													<td>
														<a class="btn btn-edit" data-toggle="modal" data-target="#modal-<?php echo $record->id; ?>">
															<span data-toogle="tooltip" title="Ubah"><i class="fa fa-edit" style="color: #00a65a"></i></span>
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
																	<h4 class="modal-title"><center>Ubah Matkul</center></h4>
																</div>
																<form id="form" class="form-horizontal" action="<?php echo base_url() ?>editMatkul" method="POST" >
																	<div class="modal-body">
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputkode" class="col-sm-2 control-label">Kode MK</label>
																			<div class="col-sm-10">
																				<input type="text" class="form-control" value="<?php echo $record->kodeMK; ?>" readonly>
																				
																				<!-- Get id Matkul (hidden) -->
																				<input type="hidden" name="id_mk" value="<?php echo $record->id; ?>" >
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputnama" class="col-sm-2 control-label">Nama</label>
																			<div class="col-sm-10">
																				<input type="text" class="form-control" name="namaMK" value="<?php echo $record->namaMK; ?>" required>
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputsks" class="col-sm-2 control-label">SKS</label>
																			<div class="col-sm-10">
																				<input type="number" class="form-control" name="sksMK" value="<?php echo $record->sksMK; ?>" required>
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputsks" class="col-sm-2 control-label">Kategori</label>
																			<div class="col-sm-10">
																				<select id="kategoriMK" name="kategoriMK" class="form-control required">
																					<option value="" disabled selected=""> <i>---Pilih Kategori---</i></option>
																					<option value="Teori" <?php if($record->kategoriMK == "Teori") {echo "selected=selected";} ?> >Teori</option>
																					<option value="Praktikum" <?php if($record->kategoriMK == "Praktikum") {echo "selected=selected";} ?> >Praktikum</option>
																				</select>
																			</div>
																		</div>
																		<div class="form-group" style="padding: 15px 0;">
																			<label for="inputsks" class="col-sm-2 control-label">Batas Pertemuan</label>
																			<div class="col-sm-10">
																				<input type="number" class="form-control" name="batasPertemuan" value="<?php echo $record->batasPertemuan; ?>" required>
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
												<div class="modal fade" id="modalhapus-<?php echo $record->id; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span></button>
																	<h4 class="modal-title"><center>Hapus Matkul</center></h4>
																</div>
																<form id="form" class="form-horizontal" action="<?php echo base_url() ?>hapusMatkul" method="POST" >
																	<div class="modal-body">
																		<div class="form-group">
																			<div class="row">
																				<div class="col-md-12">
																			<label for="inputsks" class="control-label">Apakah Anda Yakin Akan Menghapus Data ?</label>
																			<!-- input hidden -->
																			<input type="hidden" name="id_mk" value="<?php echo $record->id; ?>" >
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
					<form action="<?php echo base_url() ?>importMatkul" method="POST" enctype="multipart/form-data">
					<div class="modal fade" id="modal-default">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"><center>Import Mata Kuliah</center></h4>
								</div>
								<div class="modal-body">
									<div class="callout callout-danger">
                		<h4>PERHATIAN</h4>
                			<p>Pastikan format penulisan sudah sesuai dengan contoh agar data dapat dibaca oleh sistem. Sistem hanya membaca file dalam format <b> xlsx</b></p>
                			<p>Dokumen excel bisa diunduh <a href="<?php echo base_url('berkas/matkul.xlsx')?>"><b> di sini</b></a></p>
              		</div>
									<img src="<?php echo base_url('gambar/matkul.png')?>" style="width: 100%;height: 40%; padding-bottom: 15px;">
									<label for="importMatkul"><b>Jika format sudah sesuai, silahkan unggah file</b></label>
									<input name="file" type="File" id="importMatkul" required="">
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
					
						<!-- modal untuk tambah manual -->
						<div class="modal fade" id="modal-tambah">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title"><center>Tambah Matkul</center></h4>
										</div>
										<form id="form" class="form-horizontal" method="POST" action="<?php echo base_url() ?>inputMatkul">
											<div class="modal-body">
												<div class="form-group">
													<label for="inputkode" class="col-sm-2 control-label">Kode MK</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="inputkode" name="kodeMK" placeholder="Kode MK" required >
													</div>
												</div>
												<div class="form-group">
													<label for="inputnama" class="col-sm-2 control-label">Nama</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="inputnama" name="namaMK" placeholder="Nama" required >
													</div>
												</div>
												<div class="form-group">
													<label for="inputsks" class="col-sm-2 control-label">SKS</label>
													<div class="col-sm-10">
														<input type="number" class="form-control" id="inputsks" name="sksMK" placeholder="SKS" required >
													</div>
												</div>
												<div class="form-group">
													<label for="inputdosen" class="col-sm-2 control-label">Kategori</label>
													<div class="col-sm-10">
														<select id="namasmstr" name="kategoriMK" class="form-control required" required="">
															<option value="" disabled selected=""> <i>---Pilih Kategori---</i></option>
															<option value="Teori">Teori</option>
															<option value="Praktikum">Praktikum</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="inputsks" class="col-sm-2 control-label">Batas Pertemuan</label>
													<div class="col-sm-10">
														<input type="number" class="form-control" id="inputsks" name="batasPertemuan" placeholder="Batas Pertemuan" required >
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