<?php

class Karyawan implements Model{
	
	public $registry;
	private $_db;
	private $_table = "karyawan";
	
	public function __construct($registry){
		$this->registry = $registry;
		$this->_db = new Database();
	}
	
	public function get(){
		$query = "SELECT id,nm_karyawan,tmp_lahir,tgl_lahir,alamat,sebagai, (case sebagai when 1 then 'karyawan' when 2 then 'guru' else 'satpam' end) as jabatan,aktif,foto,created_at,updated_at
				FROM ".$this->_table;
		return $this->_db->select($query);
	}
	
	public function getById($id){
		$query = "SELECT id,nm_karyawan,tmp_lahir,tgl_lahir,alamat,sebagai,(case sebagai when 1 then 'karyawan' when 2 then 'guru' else 'satpam' end) as jabatan,aktif,foto,created_at,updated_at
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

	public function getContactsByOwner($id_pemilik,$id_kontak=null){
		$query = 'SELECT * FROM kontak WHERE kat_kontak=1 AND id_data_pemilik='.$id_pemilik.' ORDER BY tipe_kontak ASC';
		if(!is_null($id_kontak)){
			$query = 'SELECT * FROM kontak WHERE kat_kontak=1 AND id_data_pemilik='.$id_pemilik.' AND id='.$id_kontak.' ORDER BY tipe_kontak ASC';
		}
		return $this->_db->select($query);
	}

	public function getContactsById($id){
		$kontak = new Kontak($this->registry);
		return $kontak->getById($id);
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