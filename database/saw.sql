# Host: localhost  (Version 5.1.72-community)
# Date: 2020-01-20 12:21:50
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "absensi"
#

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodematkul` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nim` varchar(50) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `ket` varchar(4) NOT NULL,
  `status` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kodematkul` (`kodematkul`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

#
# Data for table "absensi"
#

INSERT INTO `absensi` VALUES (1,'KA12-101','2015-11-02','142510030021',1,'v',''),(2,'KA12-101','2015-11-02','142510030068',1,'v',''),(3,'KA12-101','2015-11-02','142510030153',1,'v',''),(4,'KA12-101','2015-11-02','142510030136',1,'v',''),(5,'KA12-101','2015-11-02','142510030046',1,'v',''),(6,'KA12-101','2015-11-02','142510030041',1,'v',''),(7,'KA12-101','2015-11-02','142510030059',1,'v',''),(8,'KA12-101','2015-11-02','142510030142',1,'v',''),(9,'KA12-101','2015-11-02','142510030052',1,'v',''),(10,'KA12-101','2015-11-02','142510030015',1,'v',''),(11,'KA12-101','2015-11-02','142510030024',1,'v',''),(12,'KA12-101','2015-11-02','142510030058',1,'v',''),(13,'KA12-101','2015-11-02','142510030138',1,'v',''),(14,'KA12-101','2015-11-02','142510030038',1,'v',''),(15,'KA12-101','2015-11-02','142510030035',1,'v',''),(16,'KA12-101','2015-11-02','142510030056',1,'v',''),(17,'KA12-101','2015-11-02','142510030154',1,'v',''),(18,'KA12-101','2015-11-02','142510030106',1,'v',''),(19,'KA12-101','2015-11-02','142510030033',1,'v',''),(20,'KA12-101','2015-11-02','142510030155',1,'v',''),(21,'KA12-101','2015-11-02','142510030078',1,'v',''),(22,'KA12-101','2015-11-02','142510030008',1,'v',''),(23,'KA12-101','2015-11-02','142510030109',1,'v',''),(24,'KA12-101','2015-11-02','142510030162',1,'v',''),(25,'KA12-101','2015-11-02','142510030101',1,'v',''),(26,'KA12-101','2015-11-02','142510030095',1,'v',''),(27,'KA12-101','2015-11-02','142510030103',1,'v',''),(28,'KA12-101','2015-11-02','142510030127',1,'v',''),(29,'KA12-101','2015-11-02','142510030023',1,'v',''),(30,'KA12-101','2015-11-02','142510030120',1,'v',''),(31,'KA12-101','2015-11-02','142510030104',1,'v','');

#
# Structure for table "admin"
#

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT 'administrator',
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES (1,'administrator','200ceb26807d6bf99fd6f4f0d1ca54d4','admin E-Muhdela','admin','jl.kenari no 145.B ','085228482669','almazari@ymail.com','N','2r5327o6g3q0aqsjnirj9g4840'),(3,'admin','21232f297a57a5a743894a0e4a801fc3','Adam Abdi A','admin','Depoan Kg 2 No.0 Rt 0 Rw 2 Yogyakarta','085228482669','adam@gmail.com','N','vce9767im409ogt7rv6p4ia9h1'),(4,'Fitri','77c796ee460fecfb87f038f1bb6fb248','Fitriani Nurhidayah','admin','Baregbeg','089649071508','fitri@gmail.com','Y','77c796ee460fecfb87f038f1bb6fb248'),(5,'donsabda','fb74f3071f62149678359c5a4de080b8','Don Aria Sabda','admin','legok','087883983643','don@gmail.com','N','gqofmec3doaamv85lpq3a4sfq3');

#
# Structure for table "kelas"
#

CREATE TABLE `kelas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_kelas` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

#
# Data for table "kelas"
#

INSERT INTO `kelas` VALUES (4,'14-01','12'),(31,'14-02','11'),(32,'15-01','10');

#
# Structure for table "modul"
#

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('pengajar','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Type` varchar(10) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# Data for table "modul"
#

INSERT INTO `modul` VALUES (2,'Manajemen Admin','?module=admin','','','N','admin','N',2,'',''),(37,'Data Siswa','?module=siswa','','gedungku.jpg','Y','admin','Y',1,'profil-kami.html',''),(68,'Laporan Hasil Analisa ','?module=matapelajaran&act=analisa','','','Y','admin','Y',9,'','Report'),(78,'Data Kriteria','?module=matapelajaran&act=himpunankriteria','','','Y','admin','Y',11,'',''),(79,'Data Klasifikasi','?module=matapelajaran&act=klasifikasi','','','Y','admin','Y',12,'',''),(81,'Pembobotan Kriteria','?module=matapelajaran','','','N','admin','Y',5,'','');

#
# Structure for table "pengajar"
#

CREATE TABLE `pengajar` (
  `id_pengajar` int(9) NOT NULL AUTO_INCREMENT,
  `kodedosen` char(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alias_d` varchar(50) NOT NULL,
  `username_login` varchar(100) NOT NULL,
  `password_login` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'pengajar',
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `jabatan` varchar(200) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  `honor` int(11) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `kewajiban` int(11) DEFAULT NULL,
  `bidang` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_pengajar`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

#
# Data for table "pengajar"
#


#
# Structure for table "registrasi_siswa"
#

CREATE TABLE `registrasi_siswa` (
  `id_registrasi` int(9) NOT NULL AUTO_INCREMENT,
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa',
  PRIMARY KEY (`id_registrasi`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "registrasi_siswa"
#


#
# Structure for table "siswa"
#

CREATE TABLE `siswa` (
  `id_siswa` int(9) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL DEFAULT 'L',
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa',
  PRIMARY KEY (`id_siswa`)
) ENGINE=MyISAM AUTO_INCREMENT=741 DEFAULT CHARSET=latin1;

#
# Data for table "siswa"
#

INSERT INTO `siswa` VALUES (734,'2011256','Maman Abdurahman','14-01','','Cirebon','Cirebon','0000-00-00','L','','ibrahim.ahmad58@gmail.com','0872636828773','maman.jpg','N','2011256','2011256','siswa'),(736,'1611502376','Ibrahim Ahmad','14-01','','Legok Indah','Jakarta','0000-00-00','L','','','','','N','1611502376','1611502376','siswa'),(737,'12312312','Nanda Laksana Muhammad','15-01','','cakung','jakarta','2004-01-01','L','1','nanda@gmail.com','91273927312312','unnamed.jpg','N','12312312','12312312','siswa'),(740,'1711501212','Jack Grealish','14-01','','birmingham','birmingham','0000-00-00','L','','jack.grealish@gmail.com','0872636828773','','N','1711501212','1711501212','siswa'),(741,'171152555','Eko Suprianto','14-01','','jl. pasar baru','Jakarta','0000-00-00','L','','jack.eko@gmail.com','08980798035','','N','171152555','171152555','siswa');

#
# Structure for table "tbl_himpunankriteria"
#

CREATE TABLE `tbl_himpunankriteria` (
  `id_hk` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_hk`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_himpunankriteria"
#

INSERT INTO `tbl_himpunankriteria` VALUES (7,4,'86-100','Sangat Baik',5),(8,4,'76-85','Baik',4),(9,4,'66-75','Cukup',3),(10,4,'51-65','Kurang',2),(11,4,'0-50','Sangat Kurang',1),(12,5,'86-100','Sangat Baik',5),(13,5,'76-85','Baik',4),(14,5,'66-75','Cukup Baik',3),(15,5,'51-65','Kurang',2),(16,5,'0-50','Sangat Kurang',1),(17,6,'86-100','Sangat Baik',5),(18,6,'76-85','Baik',4),(19,6,'66-75','Cukup',3),(20,10,'86-100','Sangat Baik',5),(21,10,'76-85','Baik',4),(22,10,'66-75','Cukup',3),(23,10,'51-65','Kurang',2),(24,10,'0-50','Sangat Kurang',1),(25,12,'86-100','Sangat Baik',5),(26,12,'76-85','Baik',4),(27,12,'66-75','Cukup',3),(28,12,'51-65','Kurang',2),(29,12,'0-50','Sangat Kurang',1),(30,6,'51-65','Kurang',2),(31,6,'0-50','Sangat Kurang',1),(32,11,'86-100','Sangat Baik',5),(33,11,'76-85','Baik',4),(34,11,'66-75','Cukup',3),(35,11,'51-65','Kurang',2),(36,11,'0-50','Sangat Kurang',1),(37,14,'86-100','Sangat Baik',5),(38,14,'76-85','Baik',4),(39,14,'60-75','Cukup',3),(40,14,'55-60','Kurang',2),(41,14,'0-54','Sangat Kurang',1),(42,0,'80-100','Sangat Baik',5),(45,16,'0-54','Sangat Kurang',1),(46,16,'51-65','Kurang',2),(47,16,'65-100','Sangat Baik',5),(48,17,'0-50','Sangat Kurang',1),(49,17,'51-100','Sangat Baik',5);

#
# Structure for table "tbl_klasifikasi"
#

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `id_hk` int(11) NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_klasifikasi"
#


#
# Structure for table "tbl_kriteria"
#

CREATE TABLE `tbl_kriteria` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `jenis` enum('umum','penjurusan') DEFAULT 'umum',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_kriteria"
#

INSERT INTO `tbl_kriteria` VALUES (4,'kreteria 3',5,'umum'),(5,'kreteria 4',5,'umum'),(6,'kreteria 5',5,'umum'),(10,'kreteria 6',5,'umum'),(11,'Kreteria 1',5,'umum'),(12,'kreteria 7',5,'umum'),(14,'kreteria 8',5,'umum'),(16,'Sistem Operasi Jaringan',5,'penjurusan'),(17,'Teknik Komputer jaringan',5,'penjurusan');

#
# View "v_analisa"
#

CREATE
  ALGORITHM = UNDEFINED
  VIEW `v_analisa`
  AS
  SELECT
    `tbl_klasifikasi`.`id_klasifikasi`,
    `tbl_klasifikasi`.`id_siswa`,
    `siswa`.`nama_lengkap`,
    `tbl_klasifikasi`.`id_hk`,
    `tbl_himpunankriteria`.`id_kriteria`,
    `tbl_kriteria`.`kriteria`,
    `tbl_himpunankriteria`.`nama`,
    `tbl_himpunankriteria`.`keterangan`,
    `tbl_himpunankriteria`.`nilai`
  FROM
    (((`tbl_himpunankriteria`
      JOIN `tbl_kriteria` ON ((`tbl_himpunankriteria`.`id_kriteria` = `tbl_kriteria`.`id`)))
      JOIN `tbl_klasifikasi` ON ((`tbl_klasifikasi`.`id_hk` = `tbl_himpunankriteria`.`id_hk`)))
      JOIN `siswa` ON ((`tbl_klasifikasi`.`id_siswa` = `siswa`.`id_siswa`)));
