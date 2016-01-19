<?php

class SiswaController extends BaseController{

	public function __construct($registry){
			parent::__construct($registry);
			$this->model = new Siswa($registry);
	}
	
	public function index(){
		$this->view->siswas = $this->model->get();
		$this->view->render('siswa/siswa');
	}
}