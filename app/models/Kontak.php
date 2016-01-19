<?php

class Kontak implements Model{ 

	public $registry;
	private $_db;
	private $_table = "kontak";
	
	public function __construct($registry){
		$this->registry = $registry;
		$this->_db = new Database();
	}
	
	public function get(){
		$query = "SELECT id,kat_kontak,id_data_pemilik,tipe_kontak, kontak
				FROM ".$this->_table;
		return $this->_db->select($query);
	}
	
	public function getById($id){
		$query = "SELECT id,kat_kontak,id_data_pemilik,tipe_kontak, kontak
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
}