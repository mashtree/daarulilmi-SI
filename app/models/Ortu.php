<?php

class Ortu implements Model {
	
	public $registry;
	private $_db;
	private $_table = "ortu_wali";
	
	public function __construct($registry){
		$this->registry = $registry;
		$this->_db = new Database();
	}
	
	public function get(){
		$query = "SELECT id,kat_ortu_wali,nm_ortu_wali,tmp_lahir, tgl_lahir, agama, asal_daerah_suku,
					bahasa,alamat_rumah, pendidikan,pekerjaan,created_at,updated_at
				FROM ".$this->_table;
		return $this->_db->select($query);
	}
	
	public function getById($id){
		$query = "SELECT id,kat_ortu_wali,nm_ortu_wali,nik,tmp_lahir, tgl_lahir, agama, asal_daerah_suku,
					bahasa,alamat_rumah, pendidikan,pekerjaan,foto,created_at,updated_at
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
		$query = 'SELECT * FROM kontak WHERE kat_kontak=2 AND id_data_pemilik='.$id_pemilik.' ORDER BY tipe_kontak ASC';
		if(!is_null($id_kontak)){
			$query = 'SELECT * FROM kontak WHERE kat_kontak=2 AND id_data_pemilik='.$id_pemilik.' AND id='.$id_kontak.' ORDER BY tipe_kontak ASC';
		}
		return $this->_db->select($query);
	}

	public function getContactsById($id){
		$kontak = new Kontak($this->registry);
		return $kontak->getById($id);
	}

	public function getSiswa($id_ortu){
		$siswa = new Siswa($this->registry);
		$data = $siswa->get_siswa_by_ortu($id_ortu);
		return $data;
	}
	
	public function ortuToJson($data = null){
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
			$t['kat_ortu_wali'] = $value['kat_ortu_wali'];
			$t['nm_ortu_wali'] = $value['nm_ortu_wali'];
			$t['tmp_lahir'] = $value['tmp_lahir'];
			$t['tgl_lahir'] = $value['tgl_lahir'];
			$t['agama'] = $value['agama'];
			$t['asal_daerah_suku'] = $value['asal_daerah_suku'];
			$t['bahasa'] = $value['bahasa'];
			$t['alamat_rumah'] = $value['alamat_rumah'];
			$t['pendidikan'] = $value['pendidikan'];
			$t['pekerjaan'] = $value['pekerjaan'];
			$t['created_at'] = $value['created_at'];
			$t['updated_at'] = $value['updated_at'];
			$return['rows'][] = $t;
			$total++;
		}
		$return['total'] = $total;
		return $return;
	}
}