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
