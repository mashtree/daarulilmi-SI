<?php

class KarController extends BaseController{

	public function __construct($registry){
		parent::__construct($registry);
		$this->model = new Karyawan($registry);	
	}
	
	public function index(){
		$data = $this->databasic();
		$this->view->kars = $data['rows'];
		$this->view->render('karyawan/karyawan');
	}
	
	public function get_by_id($id){
		$data = $this->model->getById($id);
		$data[0]['tgl_lahir'] = Tanggal::tgl_indo($data[0]['tgl_lahir']);
		echo json_encode($data);
	}
	
	public function databasic($var=NULL){ 
		$kar = new Karyawan($this->registry);
		$return = $kar->karToJson();
		if($var=='json'){
			echo json_encode($return);
		}
		//var_dump($return['rows']);
		return $return;
	}
	
	public function create_kar(){
		$data = array(
			'nm_karyawan' => $_POST['name'],
			'tmp_lahir' => $_POST['tmp_lahir'],
			'tgl_lahir' => $_POST['tgl_lahir'],
			'alamat' => $_POST['alamat'],
			'sebagai' => $_POST['sebagai']
		);
		
		if($this->model->save($data)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}
		
		echo json_encode($return);
	}

	public function update_kar($id){
		$data = array(
			'nm_karyawan' => $_POST['name'],
			'tmp_lahir' => $_POST['tmp_lahir'],
			'tgl_lahir' => $_POST['tgl_lahir'],
			'alamat' => $_POST['alamat'],
			'sebagai' => $_POST['sebagai']
		);
		
		if($this->model->update($data,$id)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}
		
		echo json_encode($return);
	}

	public function update_kar_guru($id){
		$data = array('sebagai'=>2);
		if($this->model->update($data,$id)) header('location:'.URL.'kar');
	}

	public function kar_aktif($id){
		$kar = $this->model->getById($id);
		//var_dump($kar);
		if($kar[0]['aktif']==0){
			$data = array('aktif'=>1);
		}else{
			$data = array('aktif'=>0);
		}
		if($this->model->update($data,$id)) header('location:'.URL.'kar');
	}
	
	public function remove_kar($id){
		if($this->model->delete($id)){
			header('location:'.URL.'kar');
		}
	}

	public function get_contacts($id_pemilik,$json=true){
		$data = $this->model->getContactsByOwner($id_pemilik);
		$i=0;
		$ref = Referensi::kontak();
		foreach ($data as $key => $value) {
			$data[$i++]['tipe'] = $ref[$value['tipe_kontak']-1];
		}
		if(!$json) return $data;
		echo json_encode(array($data));
	}

	public function get_contact($id_kontak){
		$data = $this->model->getContactsById($id_kontak);
		echo json_encode($data[0]);
	}

	public function create_contact(){
		$kontak = new Kontak($this->registry);
		$data = array(
			'kat_kontak' => 1,
			'id_data_pemilik' => $_POST['id'],
			'tipe_kontak' => $_POST['tipe'],
			'kontak' => $_POST['kontak']
		);

		if($kontak->save($data)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}

		echo json_encode($return);
	}

	public function update_contact($id){
		$kontak = new Kontak($this->registry);
		$data = array(
			'tipe_kontak' => $_POST['tipe'],
			'kontak' => $_POST['kontak']
		);

		if($kontak->update($data,$id)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}

		echo json_encode($return);
	}

	public function delete_contact($id){
		$kontak = new Kontak($this->registry);
		if($kontak->delete($id)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}

		echo json_encode($return);
	}
	
	public function get_jabatan(){
		$jabatans = array(
			0=>array("id"=>1,"jab"=>"karyawan"),
			1=>array("id"=>2,"jab"=>"guru"),
			2=>array("id"=>3,"jab"=>"satpam")
		);
		
		echo json_encode($jabatans);
	}

	public function get_referensi(){

		$agamas = array(
			0=>array('id'=>1, 'agama'=>'Islam')
		);

		$pendidikans = array(
			0=>array("id"=>1,"pend"=>"SD"),
			1=>array("id"=>2,"pend"=>"SLTP"),
			2=>array("id"=>3,"pend"=>"SLTA"),
			3=>array("id"=>4,"pend"=>"DI/DII"),
			4=>array("id"=>5,"pend"=>"DIII"),
			5=>array("id"=>6,"pend"=>"DIV/S1"),
			6=>array("id"=>7,"pend"=>"S2"),
			7=>array("id"=>8,"pend"=>"S3")
		);

		$pekerjaans = array(
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

		$kontaks = Referensi::Kontak();

		$referensi = array(
			'agama' => $agamas,
			'pendidikan' => $pendidikans,
			'pekerjaan' => $pekerjaans,
			'kontak' => $kontaks
		);
		
		echo json_encode($referensi);
	}

	public function get_detil_guru($id){
		$guru = new Guru($this->registry);
		$return = $guru->getDetilGuru($id);
		echo json_encode($return);
	}
	
	
}