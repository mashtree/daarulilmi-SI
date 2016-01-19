-- Dumping database structure for daarulilmi
/*DROP DATABASE IF EXISTS  `daarulilmi`;
CREATE DATABASE IF NOT EXISTS `daarulimi`;*/
use `daarulilmi`;

-- dumping structure for table daarulilmi.ayat
-- untuk menampung text ayat Al Qur'an 
drop table if exists `ayat`;
create table if not exists `ayat`(
	`id` int(11) not null auto_increment,
	`ayat_ke` int (11) not null,
	`id_surat` int(11) not null,
	`ayat` text not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.bahasa
-- untuk menampung jenis bahasa
drop table if exists `bahasa`;
create table if not exists `bahasa` (
	`id` int(11) not null auto_increment,
	`bahasa` varchar(40) not null,
	`kd_bahasa` varchar(5) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.feedback
-- untuk menampung feedback baik ortu/wali maupun guru pada progress siswa atau kegiatan daarulilmi
drop table if exists `feedback`;
create table if not exists `feedback`(
	`id` int(11) not null auto_increment,
	`feedback` text not null,
	`kategori_feedback` int(11) not null,
	`id_obj_feedback` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.guru
-- untuk menampung data guru dari data karyawan
drop table if exists `guru`;
create table if not exists `guru` (
	`id` int(11) not null auto_increment,
	`id_karyawan` int(11) not null,
	`no_induk_guru_lokal` varchar(20) not null,
	`no_induk_guru_nasional` varchar(20) default null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.jadwal_pelajaran
-- untuk menampung jadwal pelajaran per mapel, per kelas dan siapa pengampunya
drop table if exists `jadwal_pelajaran`;
create table if not exists `jadwal_pelajaran` (
	`id` int(11) not null auto_increment,
	`id_mapel` int(11) not null,
	`id_kelas` int(11) not null,
	`pengampu` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.jenis_ujian
-- untuk menampung jenis ujian
drop table if exists `jenis_ujian`;
create table if not exists `jenis_ujian` (
	`id` int(11) not null auto_increment,
	`nm_jenis_ujian` varchar(100) not null,
	`singkat` varchar(5) not null,
	`uraian` text,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kalender_pendidikan
-- untuk menampung item kalender pendidikan
drop table if exists `kalender_pendidikan`;
create table if not exists `kalender_pendidikan` (
	`id` int(11) not null auto_increment,
	`nm_jadwal` varchar(255) not null,
	`keterangan` text,
	`tgl_awal` datetime not null,
	`tgl_akhir` datetime not null,
	`id_thn_ajaran` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.karyawan
-- untuk menampung data karyawan daarulilmi termasuk guru
drop table if exists `karyawan`;
create table if not exists `karyawan` (
	`id` int(11) not null auto_increment,
	`nm_karyawan` varchar(100) not null,
	`tmp_lahir` varchar(50) not null,
	`tgl_lahir` date not null,
	`alamat` text not null,
	`sebagai` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kontak
-- untuk menampung kontak stakeholders daarulilmi baik wa, bbm, telepon, email dsb
drop table if exists `kontak`;
create table if not exists `kontak` (
	`id` int(11) not null auto_increment,
	`kat_kontak` int(11) not null,
	`kontak` varchar(50) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kat_keadaan_jasmani
-- untuk menampung jenis/kategori keadaan jasmani
drop table if exists `kat_keadaan_jasmani`;
create table if not exists `kat_keadaan_jasmani` (
	`id` int(11) not null auto_increment,
	`keadaan_jasmani` varchar(50) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kategori_kegiatan
-- untuk menampung jenis kegiatan yang diselenggarakan daarulilmi
drop table if exists `kategori_kegiatan`;
create table if not exists `kategori_kegiatan` (
	`id` int(11) not null auto_increment,
	`nm_kategori_kegiatan` varchar(100) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.keadaan_jasmani
-- untuk menampung riwayat dan keterangan keadaan jasmani/kesehatan siswa
drop table if exists `keadaan_jasmani`;
create table if not exists `keadaan_jasmani` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`id_kat_keadaan_jasmani` int(11) not null,
	`uraian` varchar(100) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kegiatan
-- untuk menampung kegiatan yang diselenggarakan oleh daarulilmi
drop table if exists `kegiatan`;
create table if not exists `kegiatan` (
	`id` int(11) not null auto_increment,
	`id_kategori_kegiatan` int(11) not null,
	`nm_kegiatan` varchar(150) not null,
	`tgl_awal` datetime default current_timestamp not null,
	`tgl_akhir` datetime not null,
	`uraian` text not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kegiatan_lomba
-- menampung lomba yang diikuti oleh siswa/siswi daarulilmi
-- dengan penyelenggara di luar yayasan
drop table if exists `kegiatan_lomba`;
create table if not exists `kegiatan_lomba` (
	`id` int(11) not null auto_increment,
	`nm_kegiatan` varchar(255) not null,
	`penyelenggara` varchar(200) not null,
	`tmp_kegiatan` text,
	`tgl_kegiatan` date,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.kelas
-- menampung informasi kelas
drop table if exists `kelas`;
create table if not exists `kelas` (
	`id` int(11) not null auto_increment,
	`nm_kelas` varchar(50) not null,
	`wali_kelas` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.korektor
-- menampung korektor ujian
drop table if exists `korektor`;
create table if not exists `korektor` (
	`id` int(11) not null auto_increment,
	`id_guru` int(11) not null,
	`id_ujian` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.mapel
-- menampung informasi mata pelajaran per kelas
drop table if exists `mapel`;
create table if not exists `mapel` (
	`id` int(11) not null auto_increment,
	`nm_mapel` varchar(150) not null,
	`singkat_mapel` varchar(5) not null,
	`deskripsi` text,
	`id_kelas` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.menu
-- menampung informasi menu aplikasi
-- nama menu, deskripsi menu, url, akses per role, aktif
drop table if exists `menu`;
create table if not exists `menu` (
	`id` int(11) not null auto_increment,
	`nm_menu` varchar(30) not null,
	`deskripsi` varchar(150) default null,
	`url` varchar(100) not null,
	`role` int(11) not null,
	`aktif` boolean default '1',
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.metode
-- menampung metode pembobotan penilaian ujian per kategori penilaian
drop table if exists `metode`;
create table if not exists `metode` (
	`id` int(11) not null auto_increment,
	`nm_metode` varchar(50) not null,
	`uraian` text,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table daarulilmi.nilai
-- menampung nilai ujian/tes/tugas/hafalan siswa
drop table if exists `nilai`;
create table if not exists `nilai` (
	`id` int(11) not null auto_increment,
	`id_peserta_ujian` int(11) not null,
	`id_sub_ujian` int(11) not null,
	`nilai` float not null,
	`id_korektor` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table ortu wali
-- menampung informasi orang tua / wali siswa
drop table if exists `ortu_wali`;
create table if not exists `ortu_wali` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`kat_ortu_wali` int(11) not null,
	`nm_ortu_wali` varchar(150) not null,
	`tmp_lahir` varchar(100) not null,
	`tgl_lahir` date not null,
	`agama` int(11) default '1' not null,
	`asal_daerah_suku` varchar(100) default null,
	`bahasa` varchar(50) default 'indonesia',
	`alamat_rumah` text not null,
	`pendidikan` int(11) not null default '1',
	`pekerjaan` int(11) not null default '1',
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table pendidikan
drop table if exists `pendidikan`;
create table if not exists `pendidikan` (
	`id` int(11) not null auto_increment,
	`pendidikan` varchar(50) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table pekerjaan
drop table if exists `pekerjaan`;
create table if not exists `pekerjaan` (
	`id` int(11) not null auto_increment,
	`pekerjaan` varchar(50) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table parent menu
-- menampung hubungan menu sebagai parent dan child
drop table if exists `parent_menu`;
create table if not exists `parent_menu` (
	`id_menu_parent` int(11) not null,
	`id_menu_child` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table pendidikan_guru
-- menampung riwayat pendidikan guru
drop table if exists `pendidikan_guru`;
create table if not exists `pendidikan_guru` (
	`id` int(11) not null auto_increment,
	`id_guru` int(11) not null,
	`tingkat` int(11) not null,
	`nm_lembaga` varchar(255) not null,
	`thn_lulus` varchar(4) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table pengalaman kerja guru
-- menampung riwayat pengalaman kerja guru sebelum di daarulilmi
drop table if exists `pengalaman_kerja_guru`;
create table if not exists `pengalaman_kerja_guru` (
	`id` int(11) not null auto_increment,
	`id_guru` int(11) not null,
	`lembaga` varchar(200) not null,
	`thn_awal` varchar(4) not null,
	`thn_akhir` varchar(4) not null,
	`jabatan` varchar(50) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table peserta_ujian
-- menampung daftar peserta ujian/tugas/tes/quiz
drop table if exists `peserta_ujian`;
create table if not exists `peserta_ujian` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`id_ujian` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table pic_kegiatan
-- menampung daftar person in charge kegiatan
drop table if exists `pic_kegiatan`;
create table if not exists `pic_kegiatan` (
	`id` int(11) not null auto_increment,
	`id_kegiatan` int(11) not null,
	`id_pic` int(11) not null,
	`id_kat_pic` int(11) not null, /*karyawan atau ortu/wali*/
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table prestasi_siswa
-- menampung riwayat prestasi siswa pada perlombaan yg diikuti
drop table if exists `prestasi_siswa`;
create table if not exists `prestasi_siswa` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`id_kegiatan_lomba` int(11) not null,
	`juara_ke` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table progress_mapel
-- menampung kemajuan kegiatan belajar mengajar mapel pada waktu tertentu
drop table if exists `progress_mapel`;
create table if not exists `progress_mapel` (
	`id` int(11) not null auto_increment,
	`id_mapel` int(11) not null,
	`id_kelas` int(11) not null,
	`id_pustaka` int(11) not null,
	`halaman` int(11) not null,
	`keterangan` text not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table pustaka
-- menampung pustaka yg digunakan untuk kegiatan belajar mengajar
drop table if exists `pustaka`;
create table if not exists `pustaka` (
	`id` int(11) not null auto_increment,
	`nm_pustaka` varchar(150) not null,
	`penerbit` varchar(100) not null,
	`id_mapel` int(11) not null,
	`kelas` int(11) not null, -- bukan fk dari tabel kelas, ttp kelas pada umumnya
	`keterangan` text not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table role
-- menampung role/peran user 
drop table if exists `role`;
create table if not exists `role` (
	`id` int(11) not null auto_increment,
	`nm_role` varchar(20) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table siswa
-- menampung data utama siswa
drop table if exists `siswa`;
create table if not exists `siswa` (
	`id` int(11) not null auto_increment,
	`nm_lengkap` varchar(100) not null,
	`nm_panggilan` varchar(30) not null,
	`nisn` varchar(20) default null,
	`nisl` varchar(20) default null,
	`tmp_lahir` varchar(50) not null,
	`tgl_lahir` date not null,
	`jk` boolean not null default '1',
	`agama` int(11) not null default '1',
	`kewarganegaraan` int(11) not null default '1',
	`anak_ke` int(11) not null default '1',
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table siswa_to_kelas
-- menampung riwayat kelas siswa
drop table if exists `siswa_to_kelas`;
create table if not exists `siswa_to_kelas` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`id_kelas` int(11) not null,
	`id_thn_ajaran` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table sub_ujian
-- menampung data sub ujian
drop table if exists `sub_ujian`;
create table if not exists `sub_ujian` (
	`id` int(11) not null auto_increment,
	`id_tes_ujian` int(11) not null,
	`nm_sub_ujian` varchar(100) not null,
	`bobot` float default null,
	`kode_sub_ujian` varchar(5) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table surat
-- menampung nama-nama surat di Al Quran
drop table if exists `surat`;
create table if not exists `surat` (
	`id` int(11) not null auto_increment,
	`nm_surat` varchar(40) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table tahfidz
-- menampung riwayat tahfidz/hafalan siswa
drop table if exists `tahfidz`;
create table if not exists `tahfidz` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`id_ayat` int(11) not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table tahun_ajaran
-- menampung riwayat tahun ajaran
drop table if exists `tahun_ajaran`;
create table if not exists `tahun_ajaran` (
	`id` int(11) not null auto_increment,
	`nm_tahun_ajaran` varchar(20) not null,
	`mulai` date not null,
	`akhir` date not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table terjemahan
-- menampung terjemahan ayat dalam berbagai bahasa
drop table if exists `terjemahan`;
create table if not exists `terjemahan` (
	`id` int(11) not null auto_increment,
	`id_ayat` int(11) not null,
	`id_bahasa` int(11) not null,
	`terjemahan` text not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table tes_ujian
-- menampung informasi pelaksanaan tes ujian,mengenai metode pembobotan, passing grade
drop table if exists `tes_ujian`;
create table if not exists `tes_ujian` (
	`id` int(11) not null auto_increment,
	`id_ujian` int(11) not null,
	`id_jenis_ujian` int(11) not null,
	`pass_grade` float not null,
	`bobot` float not null default '100.00',
	`metode` int(11) not null default '1',
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table tugas_tambahan
-- menampung tugas tambahan bagi siswa tertentu
drop table if exists `tugas_tambahan`;
create table if not exists `tugas_tambahan` (
	`id` int(11) not null auto_increment,
	`id_siswa` int(11) not null,
	`id_mapel` int(11) not null,
	`keterangan` text not null,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table ujian
-- menampung informasi pelaksanaan ujian
drop table if exists `ujian`;
create table if not exists `ujian` (
	`id` int(11) not null auto_increment,
	`nm_ujian` varchar(150) not null,
	`uraian` text not null,
	`tgl_pelaksanaan` date not null,
	`id_kelas` int(11) not null,
	`id_mapel` int(11) not null	,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;

-- table users
-- menampung informasi user
drop table if exists `users`;
create table if not exists `users` (
	`id` int(11) not null auto_increment,
	`username` varchar(50) not null,
	`pass` varchar(100) not null,
	`role` int(11) not null,
	`id_person` int(11) not null,
	`kat_person` int(11) not null,
	`token` varchar(100) not null,
	`last_session` datetime default current_timestamp,
	`whois` int(11) default null,
	`created_at` timestamp default current_timestamp,
	`updated_at` timestamp not null default current_timestamp on update current_timestamp,
	primary key (`id`)
) engine=InnoDB DEFAULT CHARSET=latin1;