<?php

class Referensi{


	public static function KategoriOrtu(){
		return array(
			0=>array("id"=>1,"kat"=>"Bapak"),
			1=>array("id"=>2,"kat"=>"Ibu"),
			2=>array("id"=>3,"kat"=>"Wali")
		);
	}

	public static function Agama(){
		return array(
			0=>array('id'=>1, 'agama'=>'Islam')
		);
	}

	public static function Pekerjaan(){
		return array(
			0=>array('id'=>1,'kerja'=>'MENGURUS RUMAH TANGGA'),
			1=>array('id'=>2,'kerja'=>'PEGAWAI NEGERI SIPIL'),
			2=>array('id'=>3,'kerja'=>'TENTARA NASIONAL INDONESIA'),
			3=>array('id'=>4,'kerja'=>'POLISI'),
			4=>array('id'=>5,'kerja'=>'PEDAGANG'),
			5=>array('id'=>6,'kerja'=>'PETANI/PEKEBUN/PETERNAK'),
			6=>array('id'=>7,'kerja'=>'GURU'),
			7=>array('id'=>8,'kerja'=>'WIRASWASTA'),
			8=>array('id'=>9,'kerja'=>'KARYAWAN SWASTA'),
			9=>array('id'=>10,'kerja'=>'KARYAWAN BUMD/D'),
			
		);
	}

	public static function Pendidikan(){
		return array(
			0=>array("id"=>1,"pend"=>"SD"),
			1=>array("id"=>2,"pend"=>"SLTP"),
			2=>array("id"=>3,"pend"=>"SLTA"),
			3=>array("id"=>4,"pend"=>"DI/DII"),
			4=>array("id"=>5,"pend"=>"DIII"),
			5=>array("id"=>6,"pend"=>"DIV/S1"),
			6=>array("id"=>7,"pend"=>"S2"),
			7=>array("id"=>8,"pend"=>"S3")
		);
	}

	public static function Kontak(){
		return array(
			0=>array('id'=>1,'tipe'=>'phone'),
			1=>array('id'=>2,'tipe'=>'whatsapp'),
			2=>array('id'=>3,'tipe'=>'google'),
			3=>array('id'=>4,'tipe'=>'yahoo'),
			4=>array('id'=>5,'tipe'=>'wechat'),
			5=>array('id'=>6,'tipe'=>'facebook'),
			6=>array('id'=>7,'tipe'=>'twitter')
		);
	}
}