<?php
error_reporting(0);
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input mapel
if ($module=='matapelajaran' AND $act=='input_matapelajaran'){
    mysql_query("INSERT INTO tbl_kriteria(kriteria, jenis,
                                 bobot
								 )
	                       VALUES('$_POST[nm_kriteria]', '$_POST[jenis_kriteria]',
                                '$_POST[bobot]')");
  header('location:../../media_admin.php?module='.$module);
}


if ($module=='matapelajaran' AND $act=='input_himpunan'){
    mysql_query("INSERT INTO tbl_himpunankriteria(id_kriteria,nama,keterangan, 
                                 nilai
								 )
	                       VALUES(
								'$_POST[id_kriteria]',
								'$_POST[nama]',
								'$_POST[ket]',
                                '$_POST[nilai]')");
  header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_POST['id_kriteria']);
}



elseif ($module=='matapelajaran' AND $act=='update_matapelajaran'){
   mysql_query("UPDATE tbl_kriteria SET kriteria  = '$_POST[nm_kriteria]', jenis = '$_POST[jenis_kriteria]',
                                          bobot   = '$_POST[bobot]' WHERE id='$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}



elseif ($module=='matapelajaran' AND $act=='update_himpunan'){
   mysql_query("UPDATE tbl_himpunankriteria SET nama  = '$_POST[nama]',keterangan  = '$_POST[ket]',  
											nilai   = '$_POST[nilai]' WHERE id_hk='$_POST[id_hk]'");
  header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_POST['id_kriteria']);
}




elseif ($module=='matapelajaran' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_kriteria WHERE id = '$_GET[id]'");
  mysql_query("DELETE FROM tbl_himpunankriteria WHERE id_kriteria = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='matapelajaran' AND $act=='hapus_himpunan'){
  mysql_query("DELETE FROM tbl_himpunankriteria WHERE id_hk = '$_GET[id]'");
  
  header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_GET['id_kriteria']);
}

elseif ($module=='matapelajaran' AND $act=='input_klasifikasi'){
  
  $jumkriteria = $_POST['jumkriteria'];
  echo $jumkriteria;
  mysql_query("DELETE FROM tbl_klasifikasi WHERE id_siswa='$_POST[id_siswa]'");
  for ($i=1; $i<=$jumkriteria; $i++)
	{
		$idhk = $_POST['id_hk'.$i];
		//$idhk = $_POST['idhk'.$i];
		
		echo $idhk.'<br>';
		
		mysql_query("INSERT INTO tbl_klasifikasi(id_siswa,
                                 id_hk
								 
								 
								 )
	                       VALUES('$_POST[id_siswa]',
                                '$idhk'
								 )");
  
		
	}
  // header('location:../../media_admin.php?module='.$module.'&act=listhimpunankriteria&id='.$_GET['id_kriteria']);
  header('location:../../media_admin.php?module='.$module.'&act=klasifikasi');
}












elseif($module=='matapelajaran' AND $act=='input_ujian'){
		
		mysql_query("INSERT INTO jadwalujian(
								 kodematkul,
                                 tglujian,
								 jenis,
                                 tingkat
								 )
	                       VALUES(
								'$_POST[kodematkul]',
                                '$_POST[tglujian]',
								'$_POST[jenis]',
                                '$_POST[tingkat]')");
  header('location:../../media_admin.php?module='.$module.'&act=jadwalujian');

}elseif($module=='matapelajaran' AND $act=='hapusujian'){
	 mysql_query("DELETE FROM jadwalujian WHERE id_jadwalujian = '$_GET[id]'");
	 header('location:../../media_admin.php?module='.$module.'&act=jadwalujian');
}elseif($module=='matapelajaran' AND $act=='editujian'){
	 mysql_query("UPDATE jadwalujian SET tglujian='$_POST[tglujian]' WHERE id_jadwalujian = '$_POST[id]'");
	 header('location:../../media_admin.php?module='.$module.'&act=jadwalujian');

}
}
