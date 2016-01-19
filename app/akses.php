<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$akses = array();
$akses['Auth'] = array(
    'login',
    'logout'
);

/*
 * akses akses Home
 */
$akses['Home'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['BBO'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['Inventory'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['Anggaran'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['Calendar'] = array(
    '__construct',
    'index',
	'ds',
    '__destruct'
);

$akses['Penjadwalan'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['Perpustakaan'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['AkumulasiTrend'] = array(
    '__construct',
    'index',
    '__destruct'
);

$akses['Dg_siswa'] = array(
    '__construct',
    'index',
	'ds_siswa',
	'ds_siswa_tracker',
	'ds_siswa_tracker_comment',
	'multiset_field',
	'updateCell',
    '__destruct'
);

$akses['Kar'] = array(
    '__construct',
    'index',
	'karyawan',
	'databasic',
	'get_jabatan',
	'create_kar',
	'remove_kar',
	'get_by_id',
    'update_kar',
    'update_kar_guru',
    'get_detil_guru',
    'kar_aktif',
    'get_contacts',
    'get_contact',
    'create_contact',
    'update_contact',
    'delete_contact',
    'get_referensi',
    '__destruct'
);

$akses['Ortu'] = array(
    '__construct',
    'index',
    'databasic',
    'create',
    'get_referensi',
    'get_by_id',
    'remove_ortu',
    'update',
    'get_contacts',
    'get_contact',
    'get_detil_ortu',
    'create_contact',
    'update_contact',
    'delete_contact',
    '__destruct'
);

$akses['Siswa'] = array(
    '__construct',
    'index',
    '__destruct'
);

/*
 * akses akses Referensi user platinum
 */
$akses['Referensi'] = array(
    '__construct',
    'index',
    'assesment',
    'rekamAssesment',
    'ubahAssesment',
    'hapusAssesment',
    'jenisTes',
    'rekamJenisTes',
    'ubahJenisTes',
    'hapusJenisTes',
    'tesAsses',
    'rekamTesAsses',
    'ubahTesAsses',
    'hapusTesAsses',
    'pegawai',
    'rekamPegawai',
    'ubahPegawai',
    'hapusPegawai',
    'user',
    'rekamUser',
    'uploadDataCsv',
    'ubahUser',
    'hapusUser',
    '__destruct'
);

$akses['Wekdal'] = array(
    '__construct',
    'home',
    'add_task',
    'pegawai',
    'kegiatan',
    '__destruct'
    );

/*
 * akses akses Assesment user platinum dan gold
 */
$akses['Assesment'] = array(
    '__construct',
    'index',
    'assesment',
    'peserta',
    'dataPeserta',
    'rekamPeserta',
    'hapusPeserta',
    'korektorNilai',
    'rekamNilai',
    'hapusNilaiPeserta',
    'get_pegawai',
    'korektor',
    'rekamKorektor',
    'ubahKorektor',
    'hapusKorektor',
    'jenistes',
    'rekamJenisTes',
    'ubahJenisTes',
    'hapusJenisTes',
    'pegawai',
    'laporan',
    '__destruct'
);

/*
 * akses akses Assesment user silver
 */
$akses ['Assesment_silver'] = array(
    '__construct',
    'index',
    'assesment',
    'peserta',
    'dataPeserta',
    'korektorNilai',
    'rekamNilai',
    'get_pegawai',
    'korektor',
    'jenistes',
    'pegawai',
    'laporan',
    '__destruct'
);



?>
