<?php
$this->load->view('Head_akademik');
?>
<!-- Conten Wrapper, Contains page content -->
<div class="content-wrapper">
	<style>
	.custom-size {
		font-size: 18px;
		font-weight: bold;
	}

	.table tbody tr td {
		vertical-align: middle;
	}
</style>

<?php 	
function hari_ini(){
	$hari = date("D");

	switch($hari){
		case 'Sun':
		$hari_ini = "Minggu";
		break;

		case 'Mon':			
		$hari_ini = "Senin";
		break;

		case 'Tue':
		$hari_ini = "Selasa";
		break;

		case 'Wed':
		$hari_ini = "Rabu";
		break;

		case 'Thu':
		$hari_ini = "Kamis";
		break;

		case 'Fri':
		$hari_ini = "Jumat";
		break;

		case 'Sat':
		$hari_ini = "Sabtu";
		break;

		default:
		$hari_ini = "Tidak di ketahui";		
		break;
	}

	return "<b>" . $hari_ini . "</b>";

}

function hari_pada_tanggal($date){
	if ($date=="") {
		return "";
	} else {
		$hari = date("D", strtotime($date));

		switch($hari){
			case 'Sun':
			$hari_ini = "Minggu";
			break;

			case 'Mon':			
			$hari_ini = "Senin";
			break;

			case 'Tue':
			$hari_ini = "Selasa";
			break;

			case 'Wed':
			$hari_ini = "Rabu";
			break;

			case 'Thu':
			$hari_ini = "Kamis";
			break;

			case 'Fri':
			$hari_ini = "Jumat";
			break;

			case 'Sat':
			$hari_ini = "Sabtu";
			break;

			default:
			$hari_ini = "Tidak di ketahui";		
			break;
		}

		return $hari_ini;			
	}
}

		//defaultnya get hari pada hari ini :D
		// $hari = hari_pada_tanggal(date("Y-m-d"));
		//$hari = "Senin";

$hari = hari_pada_tanggal(date('Y-m-d'));
$tanggal = date("Y-m-d");	

if (!empty($tampilRuangAkademik)) {
	$ruangan = array();
	$i = 0;
	foreach ($tampilRuangAkademik as $record) {
		$ruangan[$i]= $record->namaRuang;
		$i=$i+1;
	}
}

$this->load->model('JadwalAkademikM');
		//$hasil = $this->JadwalAkademikM->getJadwalAkademikW("Senin","07.00 - 08.40","HY U-202");
		//echo $hasil[0]->Kelas;

		//ini adalah arrray data sesi
$datasesi = array();

		//apabila ada filter tanggal yang dimasukkan
if(!empty($inputtgl)) {
			//get hari pada tanggal yang diinputkan
	$hari = hari_pada_tanggal($inputtgl);
	$tanggal = $inputtgl;
}
?>
<!-- Content Header (Page Header)-->
<SECTION class="content-header">
	<h1><b>Jadwal Prodi Komputer dan Sistem Informasi</b></h1>
	<ol class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Jadwal</a></li>
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
				<?php
				
				if (!empty($ruangan)) {
					?>
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<center><h3 class="box-title"><b>Filter</b></h3></center>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="<?php echo base_url() ?>jadwalAkademikR" method="POST" >
								<div class="box-body">
									<div class="col-md-12" style="padding-top: 5px; padding-bottom: 5px; padding-left: 130px;">
										<div class="col-md-2" style="padding-top: 4px">
											<label for="inputbulan">Tanggal</label>
										</div>
										<div class="col-md-7">
											<input type="date" class="form-control" id="inputtgl" name="inputtgl" value="<?php echo $tanggal ?>" >
										</div>
										<div class="col-md-3">
											<input type="submit" style="background-color: #3C8DBC; color: #fff; padding-right: 15px" class="btn btn-info" value="Tampil">
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					<div class="col-xs-12">
						<div class="box box-primary">
							<!-- Box Header -->
							<div class="box-header">
								<h3 class="text-center"><b><?php echo $hari . ", " . date("d F Y", strtotime($tanggal)) ?></b></h3>
							</div>
							<div class="box-body" >
								<table class="table table-bordered table-striped">
									<!-- ini untuk melakukan pengecekan apakah tanggal yang dipilih masuk ke dalam periode uts, uas, atau hari biasa -->
									<?php
									if($cekTahunAjaran->tgl_mulai > $inputtgl){
										?>
										<center><label><b><h3>Bukan Periode Tahun Ajaran</h3></b></label></center>
										<?php
										;}
										else if($cekTahunAjaran->tgl_mulai_uts <= $inputtgl && $cekTahunAjaran->tgl_terakhir_uts >= $inputtgl){
											?>
											<center><label><b><h3>Masuk Periode UTS</h3></b></label></center>
											<?php
											;}
											else if($cekTahunAjaran->tgl_mulai_uas <= $inputtgl && $cekTahunAjaran->tgl_terakhir_uas >= $inputtgl){
												?>
												<center><label><b><h3>Masuk Periode UAS</h3></b></label></center>
												<?php
												;}
												else if($cekTahunAjaran->tgl_terakhir < $inputtgl){
													?>
													<center><label><b><h3>Sudah Melewati Tahun Ajaran</h3></b></label></center>
													<?php
													;}
													// mulai minggu tenang
													else if($cekTahunAjaran->tgl_mulai_minggutenang <= $inputtgl && $cekTahunAjaran->tgl_terakhir_minggutenang >= $inputtgl){
														?>
														<center><label><b><h3>Masuk Periode Minggu Tenang</h3></b></label></center>
														<thead>
															<tr>
																<th></th>
																<?php
																foreach ($tampilWaktuAkademik as $dataWaktu) {
																# code...

																	?>
																	<th class="text-center custom-size" ><?php echo $dataWaktu->jam; ?></th>
																	<?php
																	//isi data sesi yang berisi data waktu di mana data waktu itu adalah jam
																	array_push($datasesi,$dataWaktu->jam);
																} 
																?>

															</tr>
														</thead>
														<tbody>
															<?php
															$index = 0;

															//load model JadwalAkademikM
															$this->load->model('JadwalAkademikM');

															foreach ($ruangan as $ruang) {

																?>
																<tr>
																	<td class="text-center custom-size"><?php echo $ruang; ?></td>
																	<!-- Ini kolom mulai sesi pertama -->
																	<?php 
																	foreach ($datasesi as $sesi) {
																		# code...
																		?>
																		<td class="text-center">
																			<?php
																			//tentukan jadwal dulu
																			$jadwal = $this->JadwalAkademikM->getJadwalAkademikW($hari,$sesi,$ruang);

																			if (!empty($jadwal)) {
																			// tampil misal ada kelas pengganti
																				$cek_kelas_pengganti_absen = $this->JadwalAkademikM->getKelasPenggantiCustom($jadwal[0]->id_kelas, $inputtgl);

																				if (!empty($cek_kelas_pengganti_absen)) {
																				// apabila pada jadwal pada cell ini terdapat kelas pengganti absen (rescheduling jadwal)

																					//ini adalah keterangan jadwal tsb melakukan jadwal pengganti karena apa?
																					$keterangan = $cek_kelas_pengganti_absen[0]->keterangan;
																					// $color = "background-color: #ffe7e5;";
																					?>

																					<p style="padding-top: 5px" ><span class="badge bg-red" data-toggle="tooltip" title="<?php echo $keterangan ?>" >Absen</span> <?php echo $jadwal[0]->Kelas."<br>".$jadwal[0]->Dosen; ?></p>
																					<p><i>diganti pada pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_absen[0]->tgl_hadir)) ?></b></font><br>diruang <u><b><?php echo $cek_kelas_pengganti_absen[0]->nama_ruang ?></b></u></p>

																					<?php
																				}
																			}

																		// apabila tidak ada jadwal pada cell ini
																		// echo "gak ada jadwal pada cell ini";

																			// cek apakah pada ruangan dan sesi ini (cell ini) ada kelas pengganti hadir
																			$cek_kelas_pengganti_hadir = $this->JadwalAkademikM->getKelasPenggantiHadirCustom($ruang, $sesi, $inputtgl);

																			if (!empty($cek_kelas_pengganti_hadir)) {
																			// apabila pada pada cell ini terdapat kelas pengganti hadir (pegganti dari pertemuan sebelumnya)

																			// echo "belum presensi";
																				?>

																				<p style="padding-top: 5px" ><span class="badge bg-blue" >Pengganti</span> <?php echo $cek_kelas_pengganti_hadir[0]->nama_kelas ?> <br> <?php echo $cek_kelas_pengganti_hadir[0]->nama_dosen ?></p>
																				<p><i>pengganti dari pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_hadir[0]->tgl_absen)) ?></b></font></p>
																				<?php 
																				$statusPertemuanKelasP = $this->JadwalAkademikM->getPertemuan($cek_kelas_pengganti_hadir[0]->id_kelas_kp, $tanggal,$sesi);

																			//echo $statusPertemuanKelasP[0]->status_pertemuan;
																			//jika status pertemuan sudah ada, atau sudah presensi
																				if(!empty($statusPertemuanKelasP)){
																					?>
																					<p><label class="label label-<?php echo
																					$statusPertemuanKelasP[0]->status_pertemuan == 'Hadir'? 'success' : 'danger'; ?>" <?php if(!empty($statusPertemuanKelasP[0]->keterangan)) {echo "data-toggle='tooltip' title='". $statusPertemuanKelasP[0]->keterangan ."'";} ?> ><?php echo $statusPertemuanKelasP[0]->status_pertemuan; ?></label></p>
																					<?php

																			//echo "sudah presensi";
																				}else {
																			//ini semisal tanggal yang kita pilih itu kurang dari sama dengan tgl skrg maka muncul 2 button INI JADWAL PENGGANTI BIASA
																					if($tanggal <= date('Y-m-d')){
																			//echo "belum";
																						?>
																						<!-- button absen (tidak hadir) -->
																						<a class="btn btn-edit" data-toggle="modal" data-target="#modal_absen<?php echo $cek_kelas_pengganti_hadir[0]->id_pengganti ?>" style="color: #FF0F0F" ><span data-toogle="tooltip" title="Tidak Hadir"><i class="fa fa-times" ></i></span></a>														
																						<!-- modal absen -->
																						<div class="modal fade" id="modal_absen<?php echo $cek_kelas_pengganti_hadir[0]->id_pengganti ?>">
																							<div class="modal-dialog">
																								<div class="modal-content">
																									<form action="<?php echo base_url() ?>presensiAbsenR" method="POST" role="form">
																										<div class="modal-header">
																											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																												<span aria-hidden="true">&times;</span></button>
																												<h4 class="modal-title"><b><?php echo $cek_kelas_pengganti_hadir[0]->nama_kelas ?></b><br>Keterangan Tidak Hadir</h4>
																											</div>
																											<div class="modal-body">
																												<input name="id_kelas" type="hidden" value="<?php echo $cek_kelas_pengganti_hadir[0]->id_kelas_kp ?>" >
																												<input name="tanggal" type="hidden" value="<?php echo $tanggal ?>" >
																												<input name="sesi" type="hidden" value="<?php echo $sesi ?>" >
																												<textarea style="width: 100%" name="keterangan" rows="4" class="form-control" placeholder="Masukkan Keterangan atau Alasan Tidak Hadir" required></textarea>
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

																							<!-- button hadir -->
																							<a href="<?php echo base_url() ?>presensiHadirR/<?php echo $cek_kelas_pengganti_hadir[0]->id_kelas_kp ?>/<?php echo $tanggal ?>/<?php echo $sesi ?>" class="btn btn-edit" style="color: #00a65a" ><span data-toogle="tooltip" title="Hadir"><i class="fa fa-check" ></i></span></a>

																							<?php
																						}
																					}
																				}

																				?>

																			</td>
																			<?php 
																		}
																		?>
																		<!-- ========================================================================= ini adalah akhir dari sesi pertama -->
																	</tr>
																	<?php
																	$index=$index+1;
												} // ini akhir penutup jika miinggu tenang
												
												?>
											</tbody>
											<?php
											;}
											else{ 
												// ini jika hari biasa
												?>
												<thead>
													<tr>
														<th></th>
														<?php
														foreach ($tampilWaktuAkademik as $dataWaktu) {
														# code...

															?>
															<th class="text-center custom-size" ><?php echo $dataWaktu->jam; ?></th>
															<?php
															//isi data sesu yang berisi data waktu di mana data waktu itu adalah jam
															array_push($datasesi,$dataWaktu->jam);
														} 
														?>

													</tr>
												</thead>
												<tbody>
													<?php
													$index = 0;

													//load model JadwalAkademikM
													$this->load->model('JadwalAkademikM');

													foreach ($ruangan as $ruang) {

														?>
														<tr>
															<td class="text-center custom-size"><?php echo $ruang; ?></td>
															<!-- Ini kolom mulai sesi pertama -->
															<?php 
															foreach ($datasesi as $sesi) {
																# code...
																?>
																<td class="text-center">
																	<?php

																	$jadwal = $this->JadwalAkademikM->getJadwalAkademikW($hari,$sesi,$ruang);
																	if (!empty($jadwal)) {
																	// apabila ada jadwal pada cell ini

																	// cek apakah jadwal ini ada kelas pengganti absen
																		$cek_kelas_pengganti_absen = $this->JadwalAkademikM->getKelasPenggantiCustom($jadwal[0]->id_kelas, $inputtgl);

																		if (!empty($cek_kelas_pengganti_absen)) {
																		// apabila pada jadwal pada cell ini terdapat kelas pengganti absen (rescheduling jadwal)

																		//ini adalah keterangan jadwal tsb melakukan jadwal pengganti karena apa?
																			$keterangan = $cek_kelas_pengganti_absen[0]->keterangan;
																		// $color = "background-color: #ffe7e5;";
																			?>

																			<p style="padding-top: 5px" ><span class="badge bg-red" data-toggle="tooltip" title="<?php echo $keterangan ?>" >Absen</span> <?php echo $jadwal[0]->Kelas."<br>".$jadwal[0]->Dosen; ?></p>
																			<p><i>diganti pada pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_absen[0]->tgl_hadir)) ?></b></font><br>diruang <u><b><?php echo $cek_kelas_pengganti_absen[0]->nama_ruang ?></b></u></p>

																			<?php

																		} else {
																			// apabila pada jadwal pada cell ini TIDAK terdapat kelas pengganti absen (rescheduling jadwal)
																			// echo "kelas pengganti kosong";

																			//if (empty($jadwal[0]->statusPertemuan) || (!empty($jadwal[0]->statusPertemuan) && $jadwal[0]->tglPertemuan != $tanggal ) ) {
																			// apabila belum melakukan presensi (belum ada data pada tabel pertemuan)
																			// echo $jadwal[0]->statusPertemuan . " " . $jadwal[0]->tglPertemuan;
																			?>
																			<div class="col-md-12">
																				<p><?php echo $jadwal[0]->Kelas."<br>".$jadwal[0]->Dosen; ?></p>

																				<?php
																				$statusPertemuanJadwal = $this->JadwalAkademikM->getPertemuan($jadwal[0]->id_kelas, $tanggal,$sesi);
																				if(!empty($statusPertemuanJadwal)){
																				//ini jika sudah presensi
																					?>
																					<p><label class="label label-<?php echo $statusPertemuanJadwal[0]->status_pertemuan == 'Hadir'? 'success' : 'danger'; ?>" <?php if(!empty($statusPertemuanJadwal[0]->keterangan)) {echo "data-toggle='tooltip' title='". $statusPertemuanJadwal[0]->keterangan ."'";} ?> ><?php echo $statusPertemuanJadwal[0]->status_pertemuan; ?></label></p>
																					<?php
																				}else{
																				//ini belum presensi

																				//ini semisal tanggal yang kita pilih itu kurang dari sama dengan tgl skrg maka muncul 3 button INI JADWAL BIASA
																					if($tanggal <= date('Y-m-d')){
																						?>
																						<!-- button absen (tidak hadir) -->
																						<a class="btn btn-edit" data-toggle="modal" data-target="#modal_absen<?php echo $jadwal[0]->id ?>" style="color: #FF0F0F" ><span data-toogle="tooltip" title="Tidak Hadir"><i class="fa fa-times" ></i></span></a>														
																						<!-- modal absen -->
																						<div class="modal fade" id="modal_absen<?php echo $jadwal[0]->id ?>">
																							<div class="modal-dialog">
																								<div class="modal-content">
																									<form action="<?php echo base_url() ?>presensiAbsenR" method="POST" role="form">
																										<div class="modal-header">
																											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																												<span aria-hidden="true">&times;</span></button>
																												<h4 class="modal-title"><b><?php echo $jadwal[0]->Kelas ?></b><br>Keterangan Tidak Hadir</h4>
																											</div>
																											<div class="modal-body">
																												<input name="id_kelas" type="hidden" value="<?php echo $jadwal[0]->id_kelas ?>" >
																												<input name="tanggal" type="hidden" value="<?php echo $tanggal ?>" >
																												<input name="sesi" type="hidden" value="<?php echo $sesi ?>" >
																												<textarea style="width: 100%" name="keterangan" rows="4" class="form-control" placeholder="Masukkan Keterangan atau Alasan Tidak Hadir" required></textarea>
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

																							<!-- button hadir -->
																							<a href="<?php echo base_url() ?>presensiHadirR/<?php echo $jadwal[0]->id_kelas ?>/<?php echo $tanggal ?>/<?php echo "$sesi" ?>" class="btn btn-edit" style="color: #00a65a" ><span data-toogle="tooltip" title="Hadir"><i class="fa fa-check" ></i></span></a>
																							<?php 
																						}
																						?>

																						<!-- button kelas_pengganti -->
																						<a href="<?php echo base_url() ?>kelasPenggantiR/<?php echo $jadwal[0]->id ?>/<?php echo $tanggal ?>" class="btn btn-edit" style="color: #3C8DBC" ><span data-toogle="tooltip" title="Buat Jadwal Pengganti"><i class="fa fa-retweet" ></i></span></a>
																					</div>
																					<?php
																				}
																			//} else {
																			//Ini misal sudah absen
																			//if ($jadwal[0]->tglPertemuan == $tanggal) {
																			// apabila sudah melakukan presensi (sudah ada data pada tabel pertemuan) dan tanggal pertemuannya adalah tanggal sekarang.
																				?>	
																				<?php	
																			//	}
																			//}
																			}
																		} else {
																		// apabila tidak ada jadwal pada cell ini
																		// echo "gak ada jadwal pada cell ini";

																		// cek apakah pada ruangan dan sesi ini (cell ini) ada kelas pengganti hadir
																			$cek_kelas_pengganti_hadir = $this->JadwalAkademikM->getKelasPenggantiHadirCustom($ruang, $sesi, $inputtgl);

																			if (!empty($cek_kelas_pengganti_hadir)) {
																		// apabila pada pada cell ini terdapat kelas pengganti hadir (pegganti dari pertemuan sebelumnya)

																		//if (!empty($cek_kelas_pengganti_hadir[0]->statusPertemuan)) {
																		// apabila sudah melakukan presensi (sudah ada data pada tabel pertemuan)

																				?>

																				<?php

																		//} else {
																		// apabila BELUM melakukan presensi (belum ada data pada tabel pertemuan)

																		// echo "belum presensi";
																				?>

																				<p style="padding-top: 5px" ><span class="badge bg-blue" >Pengganti</span> <?php echo $cek_kelas_pengganti_hadir[0]->nama_kelas ?> <br> <?php echo $cek_kelas_pengganti_hadir[0]->nama_dosen ?></p>
																				<p><i>pengganti dari pertemuan tanggal</i><br><font style='font-size: 18px;'><b><?php echo date('d F Y', strtotime($cek_kelas_pengganti_hadir[0]->tgl_absen)) ?></b></font></p>
																				<?php 
																				$statusPertemuanKelasP = $this->JadwalAkademikM->getPertemuan($cek_kelas_pengganti_hadir[0]->id_kelas_kp, $tanggal,$sesi);

																				//echo $statusPertemuanKelasP[0]->status_pertemuan;
																				if(!empty($statusPertemuanKelasP)){
																					?>
																					<p><label class="label label-<?php echo
																					$statusPertemuanKelasP[0]->status_pertemuan == 'Hadir'? 'success' : 'danger'; ?>" <?php if(!empty($statusPertemuanKelasP[0]->keterangan)) {echo "data-toggle='tooltip' title='". $statusPertemuanKelasP[0]->keterangan ."'";} ?> ><?php echo $statusPertemuanKelasP[0]->status_pertemuan; ?></label></p>
																					<?php

																				//echo "sudah presensi";
																				}else {
																				//ini semisal tanggal yang kita pilih itu kurang dari sama dengan tgl skrg maka muncul 2 button INI JADWAL PENGGANTI BIASA
																					if($tanggal <= date('Y-m-d')){
																				//echo "belum";
																						?>
																						<!-- button absen (tidak hadir) -->
																						<a class="btn btn-edit" data-toggle="modal" data-target="#modal_absen<?php echo $cek_kelas_pengganti_hadir[0]->id_pengganti ?>" style="color: #FF0F0F" ><span data-toogle="tooltip" title="Tidak Hadir"><i class="fa fa-times" ></i></span></a>														
																						<!-- modal absen -->
																						<div class="modal fade" id="modal_absen<?php echo $cek_kelas_pengganti_hadir[0]->id_pengganti ?>">
																							<div class="modal-dialog">
																								<div class="modal-content">
																									<form action="<?php echo base_url() ?>presensiAbsenR" method="POST" role="form">
																										<div class="modal-header">
																											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																												<span aria-hidden="true">&times;</span></button>
																												<h4 class="modal-title"><b><?php echo $cek_kelas_pengganti_hadir[0]->nama_kelas ?></b><br>Keterangan Tidak Hadir</h4>
																											</div>
																											<div class="modal-body">
																												<input name="id_kelas" type="hidden" value="<?php echo $cek_kelas_pengganti_hadir[0]->id_kelas_kp ?>" >
																												<input name="tanggal" type="hidden" value="<?php echo $tanggal ?>" >
																												<input name="sesi" type="hidden" value="<?php echo $sesi ?>" >
																												<textarea style="width: 100%" name="keterangan" rows="4" class="form-control" placeholder="Masukkan Keterangan atau Alasan Tidak Hadir" required></textarea>
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

																							<!-- button hadir -->
																							<a href="<?php echo base_url() ?>presensiHadirR/<?php echo $cek_kelas_pengganti_hadir[0]->id_kelas_kp ?>/<?php echo $tanggal ?>/<?php echo $sesi ?>" class="btn btn-edit" style="color: #00a65a" ><span data-toogle="tooltip" title="Hadir"><i class="fa fa-check" ></i></span></a>

																							<?php
																						}
																					}
																				}
																			}
																			?>

																		</td>
																		<?php 
																	}
																	?>
																	<!-- ========================================================================= ini adalah akhir dari sesi pertama -->
																</tr>
																<?php
																$index=$index+1;
															}

															?>
														</tbody>
														<?php
											} // ini penutup dari if ada periode
											?>
										</table>
									</div>
								</div>
							</div>
							<?php
						}else{
							?>
							<div class="col-md-12">
								<div class="box box-primary">
									<div class="box-header with-border">
									</div>
									<div class="box-body">	
										<h4>
											<center>	
												Belum ada ruangan
											</center>
										</h2>
									</div>
								</div>
								<?php }
								?>
							</div>
						</section>
					</div>
					<script>

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
