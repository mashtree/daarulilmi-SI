<?php

interface Model{

	public function get();
	
	public function getById($id);
	
	public function save($data);
	
	public function update($data,$id);
	
	public function delete($id);
	
}