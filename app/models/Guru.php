<?php

class Guru implements Model{
	
	public $registry; 
	private $_db;
	private $_table = "guru";
	
	public function __construct($registry){
		$this->registry = $registry;
		$this->_db = new Database();
	}
	
	public function get(){
		$query = "SELECT id,id_karyawan, no_induk_guru_lokal, no_induk_guru_nasional,
				b.nm_karyawan,b.tmp_lahir,b.tgl_lahir,b.alamat
				FROM '".$this->_table."' JOIN karyawan b
				ON guru.id_karyawan = b.id";
		return $this->_db->select($query);
	}
	
	public function getById($id){
		$query = "SELECT id,id_karyawan, no_induk_guru_lokal, no_induk_guru_nasional
				,b.nm_karyawan,b.tmp_lahir,b.tgl_lahir,b.alamat
				FROM '".$this->_table."' JOIN karyawan b
				ON guru.id_karyawan = b.id
				WHERE id=".$id;
		return $this->_db->select($query);
	}

	public function getDetilGuru($id){
		$pendidikan = array();
		$pengalaman = array();
		$wali = array();
		$pengampu = array();
		//pendidikan
		$query = "SELECT id_guru,tingkat,nm_lembaga,thn_lulus
				FROM pendidikan_guru
				WHERE id_guru=".$id." ORDER BY thn_lulus asc";
		$pendidikan['data'] = $this->_db->select($query);
		$pendidikan['size'] = count($pendidikan['data']);

		//pengalaman
		$query = "SELECT id_guru, lembaga, thn_awal, thn_akhir, jabatan
				FROM pengalaman_kerja_guru
				WHERE id_guru=".$id." ORDER BY thn_awal asc";
		$pengalaman['data'] = $this->_db->select($query);
		$pengalaman['size'] = count($pengalaman['data']);

		//wali kelas
		$query = "SELECT nm_kelas FROM kelas WHERE wali_kelas=".$id." ORDER BY id asc";
		$wali['data'] = $this->_db->select($query);
		$wali['size'] = count($wali['data']);

		//pengampu mapel
		$query = "SELECT b.nm_mapel as mapel, c.kelas as nm_kelas, e.nm_karyawan
					FROM jadwal_pelajaran a LEFT JOIN mapel b ON a.id_mapel = b.id
					LEFT JOIN kelas c ON a.id_kelas = c.id
					LEFT JOIN guru d ON a.pengampu = d.id
					LEFT JOIN karyawan e ON d.id_karyawan = e.id 
					ORDER BY a.id";
		$pengampu['data'] = $this->_db->select($query);
		$pengampu['size'] = count($pengampu['data']);

		$return = array(
						'pendidikan' => $pendidikan,
						'pengalaman' => $pengalaman,
						'wali' => $wali,
						'pengampu' => $pengampu
					);
		return $return;
	}
	
	public function save($data){
		return $this->_db->insert($this->_table,$data);
	}
	
	public function update($data,$id){
		return $this->_db->update($this->_table,$data,'id='.$id);
	}
	
	public function delete($id){
		return $this->_db->delete($this->_table, "id=".$id);
	}
}