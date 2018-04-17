DROP TABLE asset;

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `no_persil` varchar(80) NOT NULL,
  `kelas_desa` varchar(4) NOT NULL,
  `luas_tersedia` int(11) NOT NULL,
  `luas_terpindah` int(11) NOT NULL,
  `luas_sisa` int(11) NOT NULL,
  `ipeda` int(11) NOT NULL,
  `diperoleh` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `no_kohir` varchar(5) NOT NULL,
  `atasnama` varchar(20) NOT NULL,
  `dipindah` varchar(20) NOT NULL,
  `tahun_pindah` varchar(4) NOT NULL,
  `no_kohir_pindah` varchar(5) NOT NULL,
  `atasnama_pindah` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `klasifikasi` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `nocdesa` int(11) NOT NULL,
  `namapemilik` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE assetbaru;

CREATE TABLE `assetbaru` (
  `id` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `no_persil` varchar(80) NOT NULL,
  `kelas_desa` varchar(4) NOT NULL,
  `luas_tersedia` int(11) NOT NULL,
  `luas_terpindah` int(11) NOT NULL,
  `luas_sisa` int(11) NOT NULL,
  `ipeda` int(11) NOT NULL,
  `diperoleh` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `no_kohir` varchar(5) NOT NULL,
  `atasnama` varchar(20) NOT NULL,
  `dipindah` varchar(20) NOT NULL,
  `tahun_pindah` varchar(4) NOT NULL,
  `no_kohir_pindah` varchar(5) NOT NULL,
  `atasnama_pindah` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `klasifikasi` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `nocdesa` varchar(10) NOT NULL,
  `idcdesa` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE download;

CREATE TABLE `download` (
  `id` int(5) NOT NULL auto_increment,
  `no` int(20) NOT NULL,
  `namapemilik` text NOT NULL,
  `name` text NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO download VALUES("1","2323","ssssadasd","Fri19Jan2018_cdesa_backup_data_selo_patean.sql","asdasdasd");
INSERT INTO download VALUES("2","12222","aaa","Fri16Jun2017_cdesa_backup_data_1497602294.sql","aaa");



DROP TABLE download2;

CREATE TABLE `download2` (
  `id` int(5) NOT NULL auto_increment,
  `no` int(20) NOT NULL,
  `namapemilik` varchar(80) NOT NULL,
  `name` text NOT NULL,
  `no_SPPT` text NOT NULL,
  `no_Sertificate` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO download2 VALUES("1","1","","","33.24.030.000.000-0000.23","334234");
INSERT INTO download2 VALUES("2","2","sdfsdf","","33.24.030.000.000-01200.0","123");



DROP TABLE ketbaru;

CREATE TABLE `ketbaru` (
  `id` varchar(5) NOT NULL,
  `k_id` int(11) NOT NULL,
  `no_persil` varchar(20) NOT NULL,
  `kelas_desa` varchar(10) NOT NULL,
  `luas_terpindah` int(11) NOT NULL,
  `ipeda` int(11) NOT NULL,
  `dipindah` varchar(20) NOT NULL,
  `tahun_pindah` varchar(4) NOT NULL,
  `no_kohir_pindah` varchar(5) NOT NULL,
  `atasnama_pindah` varchar(20) NOT NULL,
  `klasifikasi` varchar(20) NOT NULL,
  `cdesaterkait` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE keterangan;

CREATE TABLE `keterangan` (
  `id` varchar(5) NOT NULL,
  `k_id` int(11) NOT NULL,
  `no_persil` varchar(20) NOT NULL,
  `kelas_desa` varchar(10) NOT NULL,
  `luas_terpindah` int(11) NOT NULL,
  `ipeda` int(11) NOT NULL,
  `dipindah` varchar(20) NOT NULL,
  `tahun_pindah` varchar(4) NOT NULL,
  `no_kohir_pindah` varchar(5) NOT NULL,
  `atasnama_pindah` varchar(20) NOT NULL,
  `klasifikasi` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE kopsurat;

CREATE TABLE `kopsurat` (
  `id` int(11) NOT NULL auto_increment,
  `kopkab` varchar(80) NOT NULL,
  `kopkec` varchar(80) NOT NULL,
  `kopdes` varchar(80) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `nosppt` varchar(80) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1235 DEFAULT CHARSET=latin1;

INSERT INTO kopsurat VALUES("1","PEMERINTAH KABUPATEN KENDAL","KECAMATAN LIMBANGAN","DESA TAMPINGAN","Jl. Kode Pos :","E- mail : ","33.24.030.000.000-0000.0");



DROP TABLE pengguna;

CREATE TABLE `pengguna` (
  `ID` varchar(4) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO pengguna VALUES("1221","admtampingan","123456");



DROP TABLE reg;

CREATE TABLE `reg` (
  `idreg` int(11) NOT NULL auto_increment,
  `namadesa` varchar(233) NOT NULL,
  `kodedesa` varchar(233) NOT NULL,
  `provinsi` varchar(233) NOT NULL,
  `kabupaten` varchar(233) NOT NULL,
  `kecamatan` varchar(233) NOT NULL,
  `jalan` varchar(233) NOT NULL,
  `kodepos` varchar(5) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(233) NOT NULL,
  `namakades` varchar(233) NOT NULL,
  `jmlcdesa` int(11) NOT NULL,
  `no` varchar(23) NOT NULL,
  PRIMARY KEY  (`idreg`)
) ENGINE=MyISAM AUTO_INCREMENT=1235 DEFAULT CHARSET=latin1;

INSERT INTO reg VALUES("2","TAMPINGAN","","Jawa Tengah","Kendal","Boja","Jl. Boja - Susukan","","081325220409","","HARJONO","852","33.24.14.09.2015.17-029");



DROP TABLE sejarahbaru;

CREATE TABLE `sejarahbaru` (
  `id` varchar(5) NOT NULL,
  `k_id` int(11) NOT NULL,
  `no_persil` varchar(10) NOT NULL,
  `kelas_desa` varchar(10) NOT NULL,
  `luas_terpindah` int(11) NOT NULL,
  `metode` varchar(80) NOT NULL,
  `tahun` int(11) NOT NULL,
  `dari_no` int(11) NOT NULL,
  `dari_nama` varchar(80) NOT NULL,
  `ke_no` int(11) NOT NULL,
  `ke_nama` varchar(80) NOT NULL,
  `klasifikasi` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




