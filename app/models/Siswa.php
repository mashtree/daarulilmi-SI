<?php

class Siswa implements Model{
	
	public $registry;
	private $_db;
	private $_table = "siswa";
	
	public function __construct($registry){
		$this->registry = $registry;
		$this->_db = new Database();
	}
	
	public function get(){
		$query = "SELECT a.id as id,
						a.nm_lengkap as nm_lengkap,
						a.nm_panggilan as nm_panggilan,
						a.nisn as nisn,
						a.nisl as nisl,
						a.tmp_lahir as tmp_lahir,
						a.tgl_lahir as tgl_lahir,
						a.agama as agama, 
						(case a.jk when 1 then 'laki-laki' when 2 then 'perempuan' end) as jk,
						a.kewarganegaraan as kewarganegaraan,
						a.anak_ke as anak_ke,
						c.nm_kelas as nm_kelas,
						d.nm_tahun_ajaran as nm_tahun_ajaran,
						a.created_at as created_at,
						a.updated_at as updated_at
				FROM ".$this->_table." a
				LEFT JOIN siswa_to_kelas b ON a.id= b.id_siswa
				LEFT JOIN kelas c ON b.id_kelas = c.id
				LEFT JOIN tahun_ajaran d ON b.id_thn_ajaran = d.id 
				ORDER BY a.anak_ke ASC";
		return $this->_db->select($query);
	}
	
	public function getById($id){
		$query = "SELECT id,nm_lengkap,nm_panggilan,nisn,nisl,tmp_lahir,tgl_lahir,agama, (case jk when 1 then 'laki-laki' when 2 then 'perempuan' end) as jk,kewarganegaraan,anak_ke,created_at,updated_at
				FROM ".$this->_table."
				WHERE id=".$id; 
		return $this->_db->select($query);
	}
	
	public function save($data){
		return $this->_db->insert($this->_table,$data);
	}
	
	public function update($data,$id){
		return $this->_db->update($this->_table,$data,'id='.$id);
	}
	
	public function delete($id){
		return $this->_db->delete($this->_table,"id=".$id);
	}

	public function get_siswa_by_ortu($id_ortu){
		$query = "SELECT 
					a.nm_lengkap as nm_lengkap,
					a.nm_panggilan as nm_panggilan,
					a.nisn as nisn,
					a.nisl as nisl,
					a.tmp_lahir as tmp_lahir,
					a.tgl_lahir as tgl_lahir,
					(case a.jk when 1 then 'laki laki' when 2 then 'perempuan' end) as jk,
					a.agama as agama,
					a.kewarganegaraan as kewarganegaraan,
					a.anak_ke as anak_ke,
					c.nm_kelas as nm_kelas
					FROM ".$this->_table." a
					LEFT JOIN siswa_to_kelas b ON a.id= b.id_siswa
					LEFT JOIN kelas c ON b.id_kelas = c.id
					LEFT JOIN siswa_to_ortu d ON a.id=d.id_siswa
					LEFT JOIN tahun_ajaran e ON b.id_thn_ajaran = e.id 
					WHERE d.id_ortu=$id_ortu ORDER BY a.anak_ke ASC";
		return $this->_db->select($query);
	}
	
	public function karToJson($data = null){
		if(is_null($data)){
			$data = $this->get();
		}
		$return = [];
		$return['current'] = 1;
		$return['rowCount'] = 10;
		$return['rows'] = [];
		$total = 0;
		foreach($data as $key=>$value){
			$t = [];
			$t['id'] = $value['id'];
			$t['nama'] = $value['nm_karyawan'];
			$t['tmp_lahir'] = $value['tmp_lahir'];
			$t['tgl_lahir'] = $value['tgl_lahir'];
			$t['alamat'] = $value['alamat'];
			$t['sebagai'] = $value['sebagai'];
			$t['jabatan'] = $value['jabatan'];
			$t['aktif'] = $value['aktif'];
			$t['created_at'] = $value['created_at'];
			$t['updated_at'] = $value['updated_at'];
			$return['rows'][] = $t;
			$total++;
		}
		$return['total'] = $total;
		return $return;
	}
}