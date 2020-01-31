<script>
	function confirmdelete(delUrl) {
		if (confirm("Anda yakin ingin menghapus?")) {
			document.location = delUrl;
		}
	}
</script>

<script language="JavaScript" type="text/JavaScript">

	function showpel()
 {
 <?php

	// membaca semua kelas
	$query = "SELECT * FROM kelas";
	$hasil = mysql_query($query);

	// membuat if untuk masing-masing pilihan kelas beserta isi option untuk combobox kedua
	while ($data = mysql_fetch_array($hasil)) {
		$idkelas = $data['id_kelas'];

		// membuat IF untuk masing-masing kelas
		echo "if (document.form_materi.id_kelas.value == \"" . $idkelas . "\")";
		echo "{";

		// membuat option matapelajaran untuk masing-masing kelas
		$query2 = "SELECT * FROM mata_kuliah WHERE id_kelas = '$idkelas' AND id_pengajar = '0'";
		$hasil2 = mysql_query($query2);
		$content = "document.getElementById('pelajaran').innerHTML = \"<select name='" . kodematkul . "'>";
		while ($data2 = mysql_fetch_array($hasil2)) {
			$content .= "<option value='" . $data2['kodematkul'] . "'>" . $data2['nama'] . "</option>";
		}
		$content .= "</select>\";";
		echo $content;
		echo "}\n";
	}

	?>
 }
</script>

<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href=../css/style.css rel=stylesheet type=text/css>";
	echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
} else {

	$aksi = "modul/mod_matapelajaran/aksi_matapelajaran.php";
	switch ($_GET[act]) {
			// Tampil Mata Kuliah
		default:
			if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {

				$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");

?>
				<div class="col-md-12">
					<div class="box-danger box-solid">
						<div class="box-header">
							<div class="callout callout-danger">
								<h4>Pembobotan kriteria</h4>
								<p>Tekan tombol Tambah Data kriteria untuk tambah kriteria baru.</p>
							</div>
						</div>
						<div class="box-body">
							<a class='btn  btn-danger' href='?module=matapelajaran&act=tambahkriteria'>Tambah Data Kriteria</a>
							<br><br>


							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>

										<th>No</th>
										<th>Nama Kriteria</th>
										<th>Jenis Kriteria</th>
										<th>Bobot</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									while ($r = mysql_fetch_array($tampil_kriteria)) {
										echo "
								<tr>
									<td>$no</td>
									<td>$r[kriteria]</td>
									<td>$r[jenis]</td>
									<td>$r[bobot]</td>
									<td>
										<center>
										<a href='?module=matapelajaran&act=editkriteria&id=$r[id]' title='Edit' class='btn btn-primary btn-xs'>Edit</a>
										<a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Hapus'  class='btn btn-danger btn-xs'>Hapus</a>
										</center>
									</td>
								</tr>";
										$no++;
									}
									echo "</tbody></table>";
									?>
						</div>
					</div>

				<?php

			}


			break;

		case "tambahkriteria":
			if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {
				echo "
				<div class='row'>
		  <div class='col-md-12'>
			<div class='box-danger box-solid'>
					<div class='box-header'>
						<div class='callout callout-danger'>
							<h4>Tambah Data Kriteria</h4>
							<p>Silahkan isi Nama kriteria / Mata pelajaran dan bobot yang di inginkan, Pilih Bobot Kriteria di antara 1 sampai dengan 5</p>
						</div>
					</div>
					<div class='box-body'>
							<form method=POST action='$aksi?module=matapelajaran&act=input_matapelajaran' enctype='multipart/form-data' class='form-horizontal'>
								<div class='form-row'>
									<div class='col-md-3'></div>
									<div class='col-md-6'>
										<div class='form-group' style='margin-left:10px; margin-right:10px;>
											<label class='control-label'>Nama Kriteria</label>
											<input type=text name='nm_kriteria' class='form-control' Placeholder='Nama Kriteria' required='required'>
										</div>
										<div class='form-group' style='margin-left:10px; margin-right:10px;>
											<label class='control-label'>Jenis Kriteria</label>
											<select class='form-control' name='jenis_kriteria'>
												<option value=''> Pilih Jenis Kriteria </option>
												<option value='umum'>Umum</option>
												<option value='penjurusan'>Penjurusan</option>
											</select>
										</div>
										<div class='form-group' style='margin-left:10px; margin-right:10px;>
											<label class='control-label'>Bobot</label>
											<select class='form-control' name='bobot'>
												<option value=''> Pilih Bobot Kriteria</option>
												<option value='1'>1</option>
												<option value='2'>2</option>	
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
											</select>
										</div>
										<div class='buttons pull-right' style='margin-right: 10px;'>
											<input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
											<input class='btn btn-danger' type=submit value=Simpan>
										</div>
									</div>
									<div class='col-md-3'></div>
								</div>
							</form>	
					</div> 
					
				</div>
			</div>";
			}
			// <div class='col-md-6'>
			// 	<div class='form-group' style='margin-left:10px; margin-right:10px;>
			// 		<label class='control-label'>Bobot</label>
			// 		<input type='number' name='bobot' class='form-control' Placeholder='Bobot' required='required' min='1' max='5'>
			// 	</div>
			// </div>


			break;

		case "editkriteria":
			if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {
				$kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$_GET[id]'");
				$m = mysql_fetch_array($kriteria);


				echo "
		<div class='col-md-12'>
			<div class='box-danger box-solid'>
				<div class='box-header'>
					<div class='callout callout-danger'>
						<h4>Edit Data Kriteria</h4>
					</div>
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=update_matapelajaran'  class='form-horizontal'>
							<input type=hidden name=id value='$m[id]'>
							<div class='form-row'>
								<div class='col-md-3'></div>
								<div class='col-md-6'>
									<div class='form-group' style='margin-left:10px; margin-right:10px;>
										<label class='control-label'>Nama Kriteria</label>
										<input type=text name='nm_kriteria' class='form-control' Placeholder='Nama Kriteria' required='required' value='$m[kriteria]'>
									</div>
									<div class='form-group' style='margin-left:10px; margin-right:10px;>
										<label class='control-label'>Jenis Kriteria</label>
										<select class='form-control' name='jenis_kriteria'>
											<option value='$m[jenis_kriteria]'>$m[jenis_kriteria]</option>
											<option value='umum'>Umum</option>
											<option value='penjurusan'>Penjurusan</option>
										</select>
									</div>
									<div class='form-group' style='margin-left:10px; margin-right:10px;>
										<label class='control-label'>Bobot</label>
										<select class='form-control' name='bobot'>
											<option selected value='$m[bobot]'> $m[bobot]</option>
											<option value='1'>1</option>
											<option value='2'>2</option>	
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
										</select>
									</div>
									<div class='buttons pull-right' style='margin-right: 10px;'>
										<input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
										<input class='btn btn-danger' type=submit value=Simpan>
									</div>
								</div>
								<div class='col-md-3'></div>
							</div>
							
							</form>
				</div> 
				
			</div>";
			}
			break;
		case "detailpelajaran":
			if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {
				$detail = mysql_query("SELECT * FROM mata_kuliah WHERE kodematkul = '$_GET[id]'");
				echo "<div class='information msg'>Detail Mata Kuliah</div>
          <br><table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>Id Mapel</th><th>Nama</th><th>Kelas</th><th>Pengajar</th><th>Deskripsi</th><th>Aksi</th></tr></thead>";
				$no = 1;
				while ($r = mysql_fetch_array($detail)) {
					echo "<tr><td>$no</td>
             <td>$r[kodematkul]</td>
             <td>$r[nama]</td>";
					$kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
					$cek_kelas = mysql_num_rows($kelas);
					if (!empty($cek_kelas)) {
						while ($k = mysql_fetch_array($kelas)) {
							echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
						}
					} else {
						echo "<td></td>";
					}
					$pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
					$cek_pengajar = mysql_num_rows($pengajar);
					if (!empty($cek_pengajar)) {
						while ($p = mysql_fetch_array($pengajar)) {
							echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
						}
					} else {
						echo "<td></td>";
					}
					echo "<td>$r[deskripsi]</td>
             <td><a href='?module=matapelajaran&act=editmatapelajaran&id=$r[id]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a> |
                 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a></td></tr>";
					$no++;
				}
				echo "</table>
    <div class='buttons'>
    <br><input class='button blue' type=button value=Kembali onclick=self.history.back()>
    </div>";
			} else {
				$detail = mysql_query("SELECT * FROM mata_kuliah WHERE kodematkul = '$_GET[id]'");
				echo "<span class='judulhead'><p class='garisbawah'>Detail Mata Kuliah</p></span>
          <table>
          <tr><th>no</th><th>nama</th><th>kelas</th><th>pengajar</th><th>deskripsi</th></tr>";
				$no = 1;
				while ($r = mysql_fetch_array($detail)) {
					echo "<tr><td>$no</td>             
             <td>$r[nama]</td>";
					$kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
					$cek_kelas = mysql_num_rows($kelas);
					if (!empty($cek_kelas)) {
						while ($k = mysql_fetch_array($kelas)) {
							echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</td>";
						}
					} else {
						echo "<td></td>";
					}
					$pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
					$cek_pengajar = mysql_num_rows($pengajar);
					if (!empty($cek_pengajar)) {
						while ($p = mysql_fetch_array($pengajar)) {
							echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pengajar'>$p[nama_lengkap]</a></td>";
						}
					} else {
						echo "<td></td>";
					}
					echo "<td>$r[deskripsi]</td></tr>";

					$no++;
				}
				echo "</table>
    <input type=button value=Kembali onclick=self.history.back()>";
			}
			break;

		case "himpunankriteria":
			if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {

				$tampil_kriteria_umum = mysql_query("SELECT * FROM tbl_kriteria where jenis = 'umum'");
				$tampil_kriteria_penjurusan = mysql_query("SELECT * FROM tbl_kriteria where jenis = 'penjurusan'");

				?>
					<div class="col-md-12">
						<div class="box-danger box-solid">
							<div class="box-header">
								<div class="callout callout-danger">
									<h4>Data Kriteria</h4>
									<p>Silahkan tekan tombol Input Data kriteria pada data kriteria yang di pilih.</p>
								</div>

								<div class="box box-danger box-solid">
									<div class="box-header with-border">
										<h3 class="box-title">Mata Pelajaran Umum</h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										</div><!-- /.box-tools -->
									</div>
									<div class="box-body">
										<table class="example1 table table-bordered table-striped">
											<thead>
												<tr>

													<th>No</th>
													<th>Nama Kriteria</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												while ($r = mysql_fetch_array($tampil_kriteria_umum)) {
													echo "
								
										<td>$no</td>
										<td>$r[kriteria]</td>
										
									
										
										<td>
											<center>
												<a href='?module=matapelajaran&act=listhimpunankriteria&id=$r[id]' title='input Data Kriteria' class='btn btn-danger btn-xs'>Input Data Kriteria</a> 
											</center>
										</td>
									</tr>";
													$no++;
												}
												echo "</tbody></table>";
												?>
									</div>
								</div>

								<div class="box box-danger box-solid">
									<div class="box-header with-border">
										<h3 class="box-title">Mata Pelajaran Penjurusan</h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										</div><!-- /.box-tools -->
									</div>
									<div class="box-body">
										<table class="example1 table table-bordered table-striped">
											<thead>
												<tr>

													<th>No</th>
													<th>Nama Kriteria</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												while ($r = mysql_fetch_array($tampil_kriteria_penjurusan)) {
													echo "
								
										<td>$no</td>
										<td>$r[kriteria]</td>
										
									
										
										<td>
											<center>
												<a href='?module=matapelajaran&act=listhimpunankriteria&id=$r[id]' title='input Data Kriteria' class='btn btn-danger btn-xs'>Input Data Kriteria</a> 
											</center>
										</td>
									</tr>";
													$no++;
												}
												echo "</tbody></table>";
												?>
									</div>
								</div>




							</div>

						<?php

					}
					break;


				case "listhimpunankriteria":
					if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {

						$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$_GET[id]'");
						$a = mysql_fetch_array($tampil_kriteria);

						$tampil_himpunankriteria = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$_GET[id]'");
						?>
							<div class="col-md-12">
								<div class="box-danger box-solid">
									<div class="box-header">
										<div class="callout callout-danger">
											<h4>Data Himpunan <?php echo $a['kriteria']; ?></h4>
											<!-- <p>Silahkan Gunakan Menu Quick Access di bawah ini.</p> -->
										</div>
									</div>
									<div class="box-body">

										<a class='btn  btn-danger' href='?module=matapelajaran&act=tambahhimpunan&id=<?php echo $a['id']; ?> '>Tambah Data </a>
										<br><br>

										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>

													<th>No</th>
													<th>List Nilai</th>
													<th>Bobot</th>
													<th>Keterangan</th>

													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												while ($r = mysql_fetch_array($tampil_himpunankriteria)) {
													echo "
								
								<td>$no</td>
								<td>$r[nama]</td>
								<td>$r[nilai]</td>
								<td>$r[keterangan]</td>
								
							
								
								<td>
									<center>
										<a href='?module=matapelajaran&act=edithimpunankriteria&id=$r[id_hk]' title='Edit' class='btn btn-danger btn-xs'>Edit</a>
										<a href='$aksi?module=matapelajaran&act=hapus_himpunan&id=$r[id_hk]&id_kriteria=$r[id_kriteria]' title='Hapus'  class='btn btn-danger btn-xs'>Hapus</a>
									</center>
								</td></tr>";
													$no++;
												}
												echo "</tbody></table>";
												?>
									</div>
								</div>

							<?php

						}
						break;

					case "tambahhimpunan":
						if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {

							$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$_GET[id]'");
							$a = mysql_fetch_array($tampil_kriteria);


							echo "
		  <div class='col-md-12'>
		  <div class='box-danger box-solid'>
				<div class='box-header'>
					<div class='callout callout-danger'>
						<h4>Tambah Data Himpunan $a[kriteria]</h4>
						<p>Silahkan input data dengan benar.</p>
					</div>
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=input_himpunan' class='form-horizontal'>
							<input type=hidden name='id_kriteria' class='form-control' Placeholder='Masukan Data' value='$a[id]'>

							<div class='form-row'>
								<div class='col-md-3'></div>
								<div class='col-md-6'>
									<div class='form-group'>
										<label class='control-label'>List Nilai</label>
											<input type=text name='nama' class='form-control' Placeholder='Masukan Data' required='required'>
									</div>
									<div class='form-group'>
										<label class='control-label'>Bobot</label>
										<select class='form-control' name='nilai' required='required'>
											<option value=''> Pilih Bobot</option>
											<option value='1'>1</option>
											<option value='2'>2</option>	
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
										</select>
									</div>
									<div class='form-group'>
											<label class='control-label'>Keterangan</label>
											<input type=text name='ket' class='form-control' Placeholder='Keterangan' required='required'>
									</div>
									<div class='form-group pull-right'>
										<input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
										<input class='btn btn-danger' type=submit value=Simpan>
									</div>
								</div>
								<div class='col-md-3'></div>
							</div>

							
							  </form>
							  
				</div> 
				
			</div>";
						}


						break;


					case "edithimpunankriteria":
						if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {

							$tampil_hk = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk = '$_GET[id]'");
							$f = mysql_fetch_array($tampil_hk);

							$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$f[id_kriteria]'");
							$a = mysql_fetch_array($tampil_kriteria);


							echo "
		  <div class='col-md-12'>
		  <div class='box-danger box-solid'>
				<div class='box-header'>
					<div class='callout callout-danger'>
						<h4>Edit Data Himpunan $a[kriteria]</h4>
						<p>Silahkan Gunakan Menu Quick Access di bawah ini.</p>
					</div>
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=update_himpunan' class='form-horizontal'>
							<input type=hidden name='id_kriteria' class='form-control' Placeholder='Masukan Data' value='$a[id]'>							 
							<input type=hidden name='id_hk' class='form-control' Placeholder='Masukan Data' value='$f[id_hk]'>							 
						
										
							<div class='form-row'>
								<div class='col-md-3'></div>
								<div class='col-md-6'>
									<div class='form-group'>
										<label class='control-label'>List nilai</label>
										<input type=text name='nama' class='form-control' Placeholder='List Nilai' value='$f[nama]'>
									</div>
									<div class='form-group'>
										<label class='control-label'>Bobot</label>
										<select class='form-control' name='nilai' required='required'>
											<option value='$f[nilai]'>$f[nilai]</option>
											<option value='1'>1</option>
											<option value='2'>2</option>	
											<option value='3'>3</option>
											<option value='4'>4</option>
											<option value='5'>5</option>
										</select>
									</div>
									<div class='form-group'>
										<label class='control-label'>Keterangan</label>
										<input type=text name='ket' class='form-control' Placeholder='Keterangan' value='$f[keterangan]'>
									</div>
									<div class='form-group pull-right'>
										<input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
										<input class='btn btn-danger' type=submit value=Simpan>
									</div>
								</div>
								<div class='col-md-3'></div>
							</div>	
							</form>
				</div> 
				
			</div>";
						}


						break;


					case "klasifikasi":
						if ($_SESSION[leveluser] == 'admin' or $_SESSION[leveluser] == 'pendidikan') {


							$tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_kelas ");

							?>

								<div class='col-md-12'>
									<div class="box-danger box-solid">
										<div class="box-header">
											<div class="callout callout-danger">
												<h4>Data Klasifikasi</h4>
												<p>Silahkan tekan tombol Input Klasifikasi pada data yang dipilih.</p>
											</div>
										</div>
										<div class="box-body">



											<table id="example1" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nomor Induk Siswa</th>
														<th>Nama</th>
														<th>Kelas</th>

														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													while ($r = mysql_fetch_array($tampil_siswa)) {
														echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[nim]</td>
											<td>$r[nama_lengkap]</td>";
														$kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
														while ($k = mysql_fetch_array($kelas)) {
															echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</a></td>";
														}
														echo "
											<td>
												<center>
													<a href=?module=matapelajaran&act=editklasifikasi&id=$r[id_siswa] class='btn btn-danger btn-xs'>Input Klasifikasi</a> 
												</center>
											</td>
										</tr>";
														$no++;
													}
													echo "</tbody></table>";
													?>
										</div>
									</div>
								<?php

							}
							break;

						case "editklasifikasi":
							if ($_SESSION[leveluser] == 'admin'  or $_SESSION[leveluser] == 'pendidikan') {
								$detail = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
								$siswa = mysql_fetch_array($detail);
								$tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

								$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
								$kelas = mysql_fetch_array($get_kelas);

								$friends = mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_kelas='$siswa[id_kelas]'"));
								echo "
		  <div class='box-danger box-solid'>
				<div class='box-header'>
					<div class='callout callout-danger'>
						<h4>Edit Klasifikasi</h4>
					</div>
				</div>
				<div class='box-body'>
					<div class='col-md-3' style='margin-top: 45px;'>
						<div class='box box-danger'>
							<div class='box-body box-profile'>";
								if ($siswa[foto] != '') {
									echo "<img class='profile-user-img img-responsive img-circle' src='../foto_siswa/medium_$siswa[foto]' alt='User profile picture'>";
								}





								echo "		 
							  <h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>

							  <ul class='list-group list-group-unbordered'>
							  	<li class='list-group-item'>
								  <b>Nomor Induk Siswa</b> <a class='pull-right'>$siswa[nim]</a>
								</li>
								<li class='list-group-item'>
								  <b>Username </b> <a class='pull-right'>$siswa[username_login]</a>
								</li>
								<li class='list-group-item'>
								  <b>Kelas</b> <a href=?module=kelas&act=detailkelas&id=$siswa[id_kelas] class='pull-right'>$kelas[nama]</a>
								</li>
								<li class='list-group-item'>
								  <b>Teman</b> <a class='pull-right'>$friends</a>
								</li>
								
							  </ul>
							  <input class='btn btn-danger btn-block' type=button value=Kembali onclick=self.history.back()>
							  
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class='col-md-9'>	
						<div class=''>
								<div class=''>
									<div class='' id='activity'>
										<div class='post'>
										<form method=POST action='$aksi?module=matapelajaran&act=input_klasifikasi' ' class='form-horizontal'>
										<input type='hidden' value ='$siswa[id_siswa]' name='id_siswa'>
										";
								echo "<center><b>Mata Pelajaran Umum</b></center>";
								$kriteria_umum = mysql_query("SELECT * FROM tbl_kriteria where jenis='umum'");
								$i = 1;
								while ($f = mysql_fetch_array($kriteria_umum)) {

									$forms = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$f[id]'");

									echo "<p>
												<div class='form-group'  style='margin-left:10px; margin-right:10px;'>
													<label class='control-label'>$f[kriteria]</label> 
													<div class=''>
													
													<select name='id_hk$i' class=' form-control  '  >
													<option selected value=''$r[id_hk]''>Pilih Kategori Nilai</option>
														 ";

									while ($r = mysql_fetch_array($forms)) {
										echo "<option value=$r[id_hk]>$r[nama]</option>";
									}

									echo "</select>
													
												</div>
												</div>
												</p>
												
												";
									$i++;
								}
								echo "<hr><center><b>Mata Pelajaran Penjurusan</b></center>";
								$kriteria_penjurusan = mysql_query("SELECT * FROM tbl_kriteria where jenis='penjurusan'");
								$j = $i;
								while ($f = mysql_fetch_array($kriteria_penjurusan)) {

									$forms = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$f[id]'");

									echo "<p>
												<div class='form-group' style='margin-left:10px; margin-right:10px;'>
													<label class='control-label'>$f[kriteria]</label> 
													<div class=''>
													
													<select name='id_hk$j' class=' form-control  '  >
													<option selected value=''$r[id_hk]''>Pilih Kategori Nilai</option>
														 ";

									while ($r = mysql_fetch_array($forms)) {
										echo "<option value=$r[id_hk]>$r[nama]</option>";
									}

									echo "</select>
													
												</div>
												</div>
												</p>
												
												";
									$j++;
								}

								$jumkriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria"));

								echo "
											<div class='form-group pull-right' style='margin-right: 10px;'>
												<input type='hidden' value='$jumkriteria' name='jumkriteria' >
												<input class='btn btn-danger' type=submit value=Prosess>
											</div>
											</form>
											
													
											
										   		
		
										</div>	
								
								    </div>
									
						</div>
					</div>
				
				</div>
			</div>";
							}
							break;

						case "analisa":
							if ($_SESSION[leveluser] == 'admin' || $_SESSION['leveluser'] == 'pendidikan') {

								$tampil_siswa = mysql_query("SELECT * FROM siswa");
								$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
								$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")

								//Matrik Awal
								?>

									<div class="box box-danger box-solid">
										<div class="box-header with-border">
											<h3 class="box-title">Matrik Awal</h3>
											<div class="box-tools pull-right">
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											</div><!-- /.box-tools -->
										</div>
										<div class="box-body">

											<div class="table-responsive">
											<table class="example1 table table-bordered table-striped">
												<thead>
													<tr>

														<th>No</th>
														<th>Nomor Induk Siswa</th>
														<th>Nama</th>
														<?php
														$a = 1;
														while ($f = mysql_fetch_array($tampil_kriteria)) {

															echo "<th>$f[kriteria]</th>";

															$a++;
														}

														?>

													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													while ($r = mysql_fetch_array($tampil_klasifikasi)) {
														$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));


														echo "
								
								<td>$no</td>
								<td>$h[nim]</td>
								<td>$h[nama_lengkap]</td>";

														$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_siswa = '$r[id_siswa]'");
														while ($n = mysql_fetch_array($klasifikasi)) {

															$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));

															echo "<td>$himpunankriteria[nama]</td>";
														}

														echo "
								
								
								
								</tr>";
														$no++;
													}
													echo "</tbody></table>";
													?>
										</div>
									</div>

									<?php





									$tampil_siswa = mysql_query("SELECT * FROM siswa");
									$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria");
									$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
									?>

									<div class="box box-danger box-solid">
										<div class="box-header with-border">
											<h3 class="box-title">Konversi Matrik Awal</h3>
											<div class="box-tools pull-right">
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											</div><!-- /.box-tools -->
										</div>
										<div class="box-body">


											<div class="table-responsive">
											<table id="example2" class="table table-bordered table-striped">
												<thead>
													<tr>

														<th>No</th>
														<th>Nomor Induk Siswa</th>
														<th>Nama</th>
														<?php
														$a = 1;
														while ($f = mysql_fetch_array($tampil_kriteria)) {

															echo "<th>$f[kriteria]</th>";

															$a++;
														}

														?>

													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													while ($r = mysql_fetch_array($tampil_klasifikasi)) {
														$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));


														echo "
								
								<td>$no</td>
								<td>$h[nim]</td>
								<td>$h[nama_lengkap]</td>";

														$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_siswa = '$r[id_siswa]'");
														while ($n = mysql_fetch_array($klasifikasi)) {

															$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));

															echo "<td>$himpunankriteria[nilai]</td>";
														}

														echo "
								
								
								
								</tr>";
														$no++;
													}
													echo "</tbody></table></div>";
													?>
										</div>
									</div>


									<?php




									//Normalisai

									$tampil_siswa = mysql_query("SELECT * FROM siswa");
									$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
									$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
									?>

									<div class="box box-danger box-solid">
										<div class="box-header with-border">
											<h3 class="box-title">Normalisasi</h3>
											<div class="box-tools pull-right">
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											</div><!-- /.box-tools -->
										</div>
										<div class="box-body">


											<div class="table-responsive">
											<table id="example3" class="table table-bordered table-striped">
												<thead>
													<tr>

														<th>No</th>
														<th>Nomor Induk Siswa</th>
														<th>Nama</th>
														<?php
														$a = 1;
														while ($f = mysql_fetch_array($tampil_kriteria)) {

															echo "<th>$f[kriteria]</th>";

															$a++;
														}

														?>

													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													while ($r = mysql_fetch_array($tampil_klasifikasi)) {
														$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));


														echo "
								
								<td>$no</td>
								<td>$h[nim]</td>
								<td>$h[nama_lengkap]</td>";

														$klasifikasi = mysql_query("SELECT * FROM v_analisa WHERE id_siswa = '$r[id_siswa]'");
														while ($n = mysql_fetch_array($klasifikasi)) {
															$crmax = mysql_fetch_array(mysql_query("SELECT max(nilai) as nilaimax FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
															$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));

															$nilaiok = $himpunankriteria['nilai'] / $crmax['nilaimax'];

															echo "<td>$nilaiok</td>";
														}

														echo "
								
								
								
								</tr>";
														$no++;
													}
													echo "</tbody></table></div>";
													?>
										</div>
									</div>



									<?php




									//Rangking

									$tampil_siswa = mysql_query("SELECT * FROM siswa");
									$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
									$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_siswa")
									?>

									<div class="box box-danger box-solid">
										<div class="box-header with-border">
											<h3 class="box-title">Rangking</h3>
											<div class="box-tools pull-right">
												<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											</div><!-- /.box-tools -->
										</div>
										<div class="box-body">
											<!-- <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
											<table id="datatable-buttons" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>Nomor Induk Siswa</th>
														<th>Nama</th>
														<th>Total Nilai</th>
													</tr>
												</thead>
												<tbody class="rangkingg">
													<?php
													$no = 1;
													while ($r = mysql_fetch_array($tampil_klasifikasi)) {
														$h = mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa ='$r[id_siswa]'"));
														echo "<tr> 
														<td>$h[nim]</td>
														<td>$h[nama_lengkap]</td>";
														$klasifikasi = mysql_query("SELECT * FROM v_analisa WHERE id_siswa = '$r[id_siswa]'");
														$totalnilai = 0;
														while ($n = mysql_fetch_array($klasifikasi)) {
															$crmax = mysql_fetch_array(mysql_query("SELECT max(nilai) as nilaimax FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
															$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
															$bobot = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$n[id_kriteria]'"));
															$nilaiok = $himpunankriteria['nilai'] / $crmax['nilaimax'];
															$rank = $nilaiok * $bobot['bobot'];
															$totalnilai = $totalnilai + $rank;
														}
														echo "<td>$totalnilai</td>";
														echo "</tr>";
														$no++;
													}
													echo "</tbody></table>";
													?>
										</div>
									</div>
					<?php
							}
							break;
					}
				}
					?>