<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href=../css/style.css rel=stylesheet type=text/css>";
	echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
} else {

	include "../../../configurasi/class_paging.php";

	$aksi = "modul/mod_siswa/aksi_siswa.php";
	$aksi_siswa = "administrator/modul/mod_siswa/aksi_siswa.php";
	switch ($_GET[act]) {
			// Tampil Siswa
		default:
			if ($_SESSION[leveluser] == 'admin' or $_SESSION[leveluser] == 'pendidikan') {


				$tampil_siswa = mysql_query("SELECT * FROM siswa ORDER BY id_kelas ");

?>


				<div class="box-danger box-solid">
					<div class="box-header">
						<div class="callout callout-danger">
							<h4>Data siswa</h4>
							<p>Tekan Tombol Tambah Data Siswa untuk menambahkan data siswa, setelah data lengkap makan akan tapil ditabel.</p>
						</div>
					</div>
					<div class="box-body">
						<a class='btn  btn-danger' href='?module=siswa&act=tambahsiswa'>Tambah Data Siswa</a>
						<br><br>


						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nomor Induk Siswa</th>
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>Blokir</th>
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

									echo "<td><p align='center'>$r[jenis_kelamin]</p></td>             
											<td><p align='center'>$r[blokir]</p></td>
											<td>
												<center>
												<a href=?module=detailsiswa&act=detailsiswa&id=$r[id_siswa] class='btn btn-primary btn-xs'> Detail</a>
												<a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' title='Edit' class='btn btn-success btn-xs'>Edit</a> 
												<a href=javascript:confirmdelete('$aksi?module=siswa&act=hapus&id=$r[id_siswa]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
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

		case "lihatmurid":
			if ($_SESSION[leveluser] == 'admin' or $_SESSION[leveluser] == 'pendidikan') {
				$p      = new paging_lihatmurid;
				$batas  = 20;
				$posisi = $p->cariPosisi($batas);

				$tampil = mysql_query("SELECT * FROM siswa WHERE id_kelas = '$_GET[id]' ORDER BY nama_lengkap LIMIT $posisi,$batas");
				$cek_siswa = mysql_num_rows($tampil);
				if (!empty($cek_siswa)) {
				?>
					<div class="box box-danger box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar Konsumen</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div><!-- /.box-tools -->
						</div>
						<div class="box-body">

							<br><br><br>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>NIM</th>
										<th>Nama</th>
										<th>Kelas</th>
										<th>Jenis Kelamin</th>
										<th>Blokir</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									while ($r = mysql_fetch_array($tampil)) {
										echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[nim]</td>
											<td>$r[nama_lengkap]</td>";
										$kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
										while ($k = mysql_fetch_array($kelas)) {
											echo "<td><a href=?module=kelas&act=detailkelas&id=$r[id_kelas] title='Detail Kelas'>$k[nama]</a></td>";
										}
										echo "<td><p align='center'>$r[jenis_kelamin]</p></td>             
											 <td><p align='center'>$r[blokir]</p></td>
											 <td><a href='?module=siswa&act=editsiswa&id=$r[id_siswa]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> 
											 <a href=javascript:confirmdelete('$aksi?module=siswa&act=hapus&id=$r[id_siswa]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
											 <a href=?module=detailsiswa&act=detailsiswa&id=$r[id_siswa] class='btn btn-success btn-xs'> Detail</a>
				  
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
			}
			break;

		case "tambahsiswa":
			if ($_SESSION[leveluser] == 'admin'  or $_SESSION[leveluser] == 'pendidikan') {
				$tampil = mysql_query("SELECT * FROM siswa WHERE id_siswa = '$_GET[id]'");
				if ($_GET['message'] == 'success') {
					$pesan = "
				<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    Data Berhasil Disimpan !!
                </div>
			
			
			";
				}
				echo "
		<div class='box-danger box-solid'>
				<div class='box-header'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='callout callout-danger'>
								<h4>Tambah Data siswa</h4>
								<p>Input Data Siswa dengan benar.</p>
							</div>
						</div>
					</div>
				</div>
				<div class='box-body'>
					<form method=POST action='$aksi?module=siswa&act=input_siswa' enctype='multipart/form-data' class='form-horizontal'>
						<div class='form-row'>
							<div class='col-md-6'>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Nomor Induk Siswa</label>
									<input type=text name='nim' class='form-control' placeholder='NIM' required='required'>
								</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Nama Lengkap</label>
									<input type=text name='nama_lengkap' class='form-control' placeholder='Nama Lengkap' required='required'>
								</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Alamat</label>
									<input type=text name='alamat' class='form-control' placeholder='Alamat'>
								</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Tempat Lahir</label>
									<input type=text name='tempat_lahir' class='form-control' placeholder='Tempat Lahir' >
								</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Tanggal lahir</label>
									<input type='date' name='tgl_lahir' class='form-control' placeholder='Tanggal lahir' >
								</div>
								<div class='form-row'>
									<div class='col-md-6'>
										<div class='form-group' style='margin-left: 1px;>
											<label class='control-label'>Jenis kelamin</label><br>
											<input type=radio name='jk' value='L'> L &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type=radio name='jk' value='P'> P
										</div>
									</div>
									<div class='col-md-6'>
										<div class='form-group' style='margin-left:10px; margin-right:10px;>
											<label class='control-label'>Blokir</label><br>
											<input type=radio name='blokir' value='Y'> Y &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type=radio name='blokir' value='N' checked> N
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-6'>
							<div class='form-group' style='margin-left:10px; margin-right:10px;>
								<label class='control-label'>Kelas</label>
									<select name='id_kelas' class='form-control'>
									<option value=0 selected>--Pilih Kelas--</option>";
				$tampil = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
				while ($r = mysql_fetch_array($tampil)) {
					echo "<option value=$r[id_kelas]>$r[nama]
									</option>";
				}
				echo "</select>
							</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Email</label>
									<input type=text name='email' class='form-control'  placeholder='Email' >
								</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>No HP/Tlp</label>
									<input type=text name='no_telp' class='form-control' placeholder='No HP' required='required'>
								</div>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Foto</label>
									<input type=file name='fupload' size=40 class class='form-control'>
									<small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
								</div>
							</div>
						</div>
				</div> 
				<div class='pull-right' style='margin-right: 35px;'>
					<input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
					<input class='btn btn-danger' type=submit value=Simpan>
				</div>
				</form>
			</div>";
			}
			break;

		case "nis_ada":
			if ($_SESSION[leveluser] == 'admin'  or $_SESSION[leveluser] == 'pendidikan') {
				echo "<span class='judulhead'><p class='garisbawah'>nis SUDAH PERNAH DIGUNAKAN<br>
               <input type=button value=Kembali onclick=self.history.back()></p></span>";
			}
			break;

		case "editsiswa":
			$edit = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
			$r = mysql_fetch_array($edit);


			$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$r[id_kelas]'");
			$kelas = mysql_fetch_array($get_kelas);

			if ($_SESSION[leveluser] == 'admin'  or $_SESSION[leveluser] == 'pendidikan') {

				echo "
		  <div class='box-danger box-solid'>
				<div class='box-header'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='callout callout-danger'>
								<h4>Edit Data siswa</h4>
								<p>Input Data Siswa dengan benar.</p>
							</div>
						</div>
					</div>
				</div>
				<div class='box-body'>
				<form method=POST method=POST action=$aksi?module=siswa&act=update_siswa  enctype='multipart/form-data' class='form-horizontal'>
				<input type=hidden name=id value='$r[id_siswa]'>
				<div class='form-row'>
					<div class='col-md-6'>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Nomor Induk Siswa</label>
							<input type=text name='nim' class='form-control' placeholder='Nomor Induk Siswa' value='$r[nim]'>
						</div>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Nama Lengkap</label>
							<input type=text name='nama' class='form-control' placeholder='Nama Lengkap' value='$r[nama_lengkap]'>
						</div>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Alamat</label>
							<input type=text name='alamat' class='form-control' placeholder='Alamat'  value='$r[alamat]'>
						</div>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Tempat Lahir</label>
							<input type=text name='tempat_lahir' class='form-control' placeholder='Tempat Lahir'  value='$r[tempat_lahir]'>
						</div>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Tanggal lahir</label>
							<input type='date' name='tgl_lahir' class='form-control' placeholder='Tanggal lahir'  value='$r[tgl_lahir]'>
						</div>
						<div class='form-row'>
							<div class='col-md-6'>
								<div class='form-group' style='margin-left: 1px;>
									<label class='control-label'>Jenis kelamin</label><br>
									<input type=radio name='jk' value='L'> L &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type=radio name='jk' value='P'> P
								</div>
							</div>
							<div class='col-md-6'>
								<div class='form-group' style='margin-left:10px; margin-right:10px;>
									<label class='control-label'>Blokir</label><br>
									<input type=radio name='blokir' value='Y'> Y &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type=radio name='blokir' value='N' checked> N
								</div>
							</div>
							<div class='form-group' style='margin-left:10px; margin-right:10px;>
								<label class='control-label'>Kelas</label>
									<select name='id_kelas' class='form-control' required='required'>
									<option value=0 selected>--Pilih Kelas--</option>";
				// echo "<option value=$r[id_kelas]>$r[id_kelas]</option>";
				$tampil = mysql_query("SELECT * FROM kelas ORDER BY id_kelas");
				while ($res = mysql_fetch_array($tampil)) {
					echo "<option value=$res[id_kelas]>$res[nama]</option>";
				}
				echo "</select>
							</div>
						</div>
					</div>
					
					<div class='col-md-6'>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Email</label>
							<input type=text name='email' class='form-control' placeholder='Email' value='$r[email]'>
						</div>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>No HP/Tlp</label>
							<input type=text name='no_telp' class='form-control' placeholder='No HP' value='$r[no_telp]'>
						</div>
						<div class='form-group' style='margin-left:10px; margin-right:10px;>
							<label class='control-label'>Foto</label>
							<input type=file name='fupload' size=40 class class='form-control'>
							<small>Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
						</div>
					</div>
				</div>
		</div> 
		<div class='pull-right' style='margin-right: 35px;'>
			<input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
			<input class='btn btn-danger' type=submit value=Simpan>
		</div>
		</form>
				</div> 
				
			</div>";
			} elseif ($_SESSION[leveluser] == 'siswa') {
				echo "<br><b class='judul'>Edit Profil</b><br><p class='garisbawah'></p>";
				echo "<form method=POST action=$aksi_siswa?module=siswa&act=update_profil_siswa enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_siswa]'>
          <table>
          <tr><td>nis</td>     <td> : <input type=text name=nis value='$r[nis]' ></td></tr>
          <tr><td>Nama</td>     <td> : <input type=text name='nama' value='$r[nama_lengkap]' size=40></td></tr>          
          <tr><td>Alamat</td>       <td> : <input type=text name='alamat' size=80 value='$r[alamat]'></td></tr>
          <tr><td>Tempat Lahir</td> <td> : <input type=text name='tempat_lahir' size=60 value='$r[tempat_lahir]'></td></tr>
          <tr><td>Tanggal Lahir</td><td> : ";
				$get_tgl = substr("$r[tgl_lahir]", 8, 2);
				combotgl(1, 31, 'tgl', $get_tgl);
				$get_bln = substr("$r[tgl_lahir]", 5, 2);
				combonamabln(1, 12, 'bln', $get_bln);
				$get_thn = substr("$r[tgl_lahir]", 0, 4);
				combothn(1950, $thn_sekarang, 'thn', $get_thn);

				echo "</td></tr>";
				if ($r[jenis_kelamin] == 'L') {
					echo "<tr><td>Jenis Kelamin</td><td> : <input type=radio name='jk' value='L' checked>Laki - Laki
                                           <input type=radio name='jk' value='P'>Perempuan</tr></tr>";
				} else {
					echo "<tr><td>Jenis Kelamin</td><td> : <input type=radio name='jk' value='L'>Laki - Laki
                                           <input type=radio name='jk' value='P' checked>Perempuan</tr></tr>";
				}
				echo "<tr><td>Agama</td>        <td> : <select name=agama>
                                           <option value='$r[agama]' selected>$r[agama]</option>
                                           <option value='Islam'>Islam</option>
                                           <option value='Kristen'>Kristen</option>
                                           <option value='Katolik'>Katolik</option>
                                           <option value='Hindu'>Hindu</option>
                                           <option value='Buddha'>Buddha</option>
                                           </select></td></tr>
          <tr><td>Nama Ayah/Wali</td> <td> : <input type=text name='nama_ayah' size=40 value='$r[nama_ayah]'></td></tr>
          <tr><td>Nama Ibu</td>     <td> : <input type=text name='nama_ibu' size=40 value='$r[nama_ibu]'></td></tr>
          <tr><td>Tahun Masuk</td>  <td> : <input type=text name='th_masuk' size=5 value='$r[th_masuk]'> *) Harus Angka</td></tr>
          <tr><td>Email</td>        <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>No Telp/HP</td>   <td> : <input type=text name='no_telp' size=20 value='$r[no_telp]'></td></tr>
          <tr><td>Foto</td>   <td> : ";
				if ($r[foto] != '') {
					echo "<img src='foto_siswa/medium_$r[foto]'>";
				}
				echo "</td></tr>
          <tr><td>Ganti Foto</td>       <td> : <input type=file name='fupload' size=40>
                                           <br>**) Tipe foto harus JPG/JPEG dan ukuran lebar maks: 400 px<br>
                                                ***) Apabila foto tidak diganti, dikosongkan saja</td></tr>";

				echo "<tr><td>Jabatan</td>      <td> : <input type=text name='jabatan' size=70 value='$r[jabatan]'></td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value='Update'>
                            <input type=button class='tombol' value='Batal'
                            onclick=self.history.back()>
                            </td></tr>
          </table></form>";
			}
			break;


		case "detailsiswa":
			if ($_SESSION[leveluser] == 'admin'  or $_SESSION[leveluser] == 'pendidikan') {
				$detail = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
				$siswa = mysql_fetch_array($detail);
				$tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

				$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
				$kelas = mysql_fetch_array($get_kelas);

				$friends = mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_kelas='$siswa[id_kelas]'"));
				echo "
				<div class='box-body'>
				<div class='row'>
					<div class='col-md-12'>
						<div class='callout callout-danger'>
							<h4>Detail Siswa</h4>
						</div>
					</div>
				</div>
					<div class='col-md-3'>
						<div class='box box-danger'>
							<div class='box-body box-profile'>";
				if ($siswa[foto] != '') {
					echo "<img class='profile-user-img img-responsive img-circle' src='../foto_siswa/medium_$siswa[foto]' alt='User profile picture'>";
				}
				echo "		 
							<h3 class='profile-username text-center'>$siswa[nama_lengkap]</h3>

							<ul class='list-group list-group-unbordered'>
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
							<input class='btn btn-danger btn-block' type=button value=Kembali onclick=self.history.back() style='height: 52px;'>
							
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class='col-md-9'>
					<div class='box box-danger'>
					<table class='table table-striped'>
					<tr>
						<td>Nama Lengkap</td>
						<td>$siswa[nama_lengkap]</td>
					</tr>
					<tr>
						<td>Nomor induk</td>
						<td>$siswa[nim]</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>$siswa[alamat]</td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td>$siswa[tempat_lahir]</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>$siswa[tgl_lahir]</td>
					</tr>";


				if ($siswa[jenis_kelamin] == 'P') {
					echo "
					<tr>
						<td>Jenis Kelamin</td>
						<td>Perempuan</td>
					</tr>";
				} else {
					echo "
					<tr>
						<td>Jenis Kelamin</td>
						<td>Laki - laki</td>
					</tr>";
				}
				echo "
											
				<tr>
					<td>Email</td>
					<td>$siswa[email]</td>
				</tr>
				<tr>
					<td>Nomor Hp</td>
					<td>$siswa[no_telp]</td>
				</tr>
				<tr>
					<td>Blokir</td>
					<td>$siswa[blokir]</td>
				</tr>

											
		
										</div>	
								
					</div>
				
				</div>
			</div>
			</table>
			</div>";

				// <p><label class='col-sm-2 control-label'>Agama</label> $siswa[agama]<br></p>     		
				// <p><label class='col-sm-2 control-label'>Tahun Masuk</label> $siswa[th_masuk]<br> </p>   		
				// <p><label class='col-sm-2 control-label'>Email</label> $siswa[email] <br></p>      		
				// <p><label class='col-sm-2 control-label'>No. HP</label> $siswa[no_telp] <br></p>      		
				// <p><label class='col-sm-2 control-label'>Blokir</label> $siswa[blokir] <br></p>    
				// <p><label class='col-sm-2 control-label'>Nama Ayah </label> $siswa[nama_ayah]<br> </p>    		
				// <p><label class='col-sm-2 control-label'>Nama Ibu</label> $siswa[nama_ibu] <br></p>

			} elseif ($_SESSION[leveluser] == 'pengajar') {
				$detail = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
				$siswa = mysql_fetch_array($detail);
				$tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

				$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
				$kelas = mysql_fetch_array($get_kelas);

				echo "<form><fieldset>
             <legend>Detail Siswa</legend>
             <dl class='inline'>
       <table id='table1' class='gtable sortable'>
          <tr><td rowspan='15'>";
				if ($siswa['foto'] != '') {
					echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_siswa/medium_$siswa[foto]'>
                    <div class='links'>
                    <a href='../foto_siswa/medium_$siswa[foto]' rel='facebox'>View</a>
                    <div>
                    </li>
                    </ul>";
				}
				echo "</td><td>NIM</td>        <td> : $siswa[nim]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>          
          <tr><td>Kelas</td>              <td> : <a href=?module=kelas&act=detailkelas&id=$siswa[id_kelas]>$kelas[nama]</td></tr>
          <tr><td>Jabatan</td>            <td> : $siswa[jabatan]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
				if ($siswa[jenis_kelamin] == 'P') {
					echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
				} else {
					echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
				}
				echo "
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $siswa[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $siswa[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$siswa[email]>$siswa[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $siswa[no_telp]</td></tr>
          <tr><td>Aksi</td>               <td> : <input type=button class='button small white' value=Kembali onclick=self.history.back()></td></tr>";
				echo "</table></dl></fieldset</form>";
			} elseif ($_SESSION[leveluser] == 'siswa') {
				$detail = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
				$siswa = mysql_fetch_array($detail);
				$tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

				$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
				$kelas = mysql_fetch_array($get_kelas);

				echo "<br><b class='judul'>Detail Siswa</b><br><p class='garisbawah'></p>
       <table>
             <tr><td rowspan='14'>";
				if ($siswa[foto] != '') {
					echo "<img src='foto_siswa/medium_$siswa[foto]'>";
				}
				echo "</td><td>nis</td>        <td> : $siswa[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>          
          <tr><td>Kelas</td>              <td> : $kelas[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
				if ($siswa[jenis_kelamin] == 'P') {
					echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
				} else {
					echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
				}
				echo "
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $siswa[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $siswa[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$siswa[email]>$siswa[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $siswa[no_telp]</td></tr>
          <tr><Td>Jabatan</td>            <td> : $siswa[jabatan]</td></tr>";
				echo "<tr><td colspan='3'><input type=button class='tombol' value='Kembali'
          onclick=self.history.back()></td></tr></table>";
			}
			break;

		case "detailprofilsiswa":
			if ($_SESSION[leveluser] == 'siswa') {
				$detail = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
				$siswa = mysql_fetch_array($detail);
				$tgl_lahir   = tgl_indo($siswa[tgl_lahir]);

				$get_kelas = mysql_query("SELECT * FROM kelas WHERE id_kelas = '$siswa[id_kelas]'");
				$kelas = mysql_fetch_array($get_kelas);

				echo "<br><b class='judul'>Detail Siswa</b><br><p class='garisbawah'></p>
       <table>
             <tr><td rowspan='14'>";
				if ($siswa[foto] != '') {
					echo "<img src='foto_siswa/medium_$siswa[foto]'>";
				}
				echo "</td><td>nis</td>        <td> : $siswa[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $siswa[nama_lengkap]</td></tr>
          <tr><td>Kelas</td>              <td> : $kelas[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $siswa[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $siswa[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
				if ($siswa[jenis_kelamin] == 'P') {
					echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
				} else {
					echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
				}
				echo "
          <tr><td>Agama</td>              <td> : $siswa[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $siswa[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $siswa[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $siswa[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$siswa[email]>$siswa[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $siswa[no_telp]</td></tr>
          <tr><td>Jabatan</td>            <td> : $siswa[jabatan]</td></tr>";
				echo "<tr><td colspan='3'><input type=button class='tombol' value='Edit Profil' onclick=\"window.location.href='?module=siswa&act=editsiswa&id=$siswa[id_siswa]';\"></td></tr></table>";
			}
			break;

		case "detailaccount":
			if ($_SESSION[leveluser] == 'siswa') {
				$detail = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
				$siswa = mysql_fetch_array($detail);
				echo "<form method=POST action=$aksi_siswa?module=siswa&act=update_account_siswa>";
				echo "<br><b class='judul'>Edit Account Login</b><br><p class='garisbawah'></p>
        <table>
        <tr><td>Username</td><td>:<input type=text name='username' size='40'></td></tr>
        <tr><td>Password</td><td>:<input type=password name='password' size='40'></td></tr>
        <tr><td colspan=2>*) Apabila Username tidak diubah di kosongkan saja.</td></tr>
        <tr><td colspan=2>**) Apabila Password tidak diubah di kosongkan saja.</td></tr>
        <tr><td colspan=2><input type=submit class='tombol' value='Update'></td></tr>
        </table>";
			}
			break;
	}
}
?>