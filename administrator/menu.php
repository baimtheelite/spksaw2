<?php
include "../configurasi/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' and type <> 'Report' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li ><a href='$m[link]'><i class='fa fa-circle-o'></i> $m[nama_modul]</a></li>";
  }
}
elseif ($_SESSION['leveluser']=='pengajar'){
  $sql=mysql_query("select * from modul where status='pengajar' and aktif='Y' and type <> 'Report' order by urutan");
  echo "<li ><a href='?module=home'><i class='fa fa-circle-o'></i> Daftar Absensi</a></li>";
  while ($m=mysql_fetch_array($sql)){
    echo "<li ><a href='$m[link]'><i class='fa fa-circle-o'></i> $m[nama_modul]</a></li>";
  }
}
?>
