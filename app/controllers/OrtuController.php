<?php

class OrtuController extends BaseController{

	private $kategoris = array(
		0=>array("id"=>1,"kat"=>"Bapak"),
		1=>array("id"=>2,"kat"=>"Ibu"),
		2=>array("id"=>3,"kat"=>"Wali")
	);

	private $agamas = array(
		0=>array('id'=>1, 'agama'=>'Islam')
	);

	private $pendidikans = array(
		0=>array("id"=>1,"pend"=>"SD"),
		1=>array("id"=>2,"pend"=>"SLTP"),
		2=>array("id"=>3,"pend"=>"SLTA"),
		3=>array("id"=>4,"pend"=>"DI/DII"),
		4=>array("id"=>5,"pend"=>"DIII"),
		5=>array("id"=>6,"pend"=>"DIV/S1"),
		6=>array("id"=>7,"pend"=>"S2"),
		7=>array("id"=>8,"pend"=>"S3")
	);

	private $pekerjaans = array(
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

	private $kontaks = array(
		0=>array('id'=>1,'tipe'=>'phone'),
		1=>array('id'=>2,'tipe'=>'whatsapp'),
		2=>array('id'=>3,'tipe'=>'google'),
		3=>array('id'=>4,'tipe'=>'yahoo'),
		4=>array('id'=>5,'tipe'=>'wechat'),
		5=>array('id'=>6,'tipe'=>'facebook'),
		6=>array('id'=>7,'tipe'=>'twitter')
	);

	public function __construct($registry){
			parent::__construct($registry);
			$this->model = new Ortu($registry);
	}
	
	public function index(){
		$data = $this->databasic();
		$this->view->ortus = $data['rows'];
		$this->view->render('ortu/ortu');
	}

	public function databasic($var=NULL){ 
		$return = $this->model->ortuToJson();
		if($var=='json'){
			echo json_encode($return);
		}
		//var_dump($return['rows']);
		return $return;
	}

	public function get_by_id($id,$json=true){
		$data = $this->model->getById($id);
		if(!$json) return $data;
		echo json_encode($data);
	}

	public function create(){
		$data = array(
			'kat_ortu_wali' => $_POST['kat_ortu_wali'],
			'nm_ortu_wali' => $_POST['nm_ortu_wali'],
			'nik' => $_POST['nik'],
			'tmp_lahir' => $_POST['tmp_lahir'],
			'tgl_lahir' => $_POST['tgl_lahir'],
			'agama' => $_POST['agama'],
			'asal_daerah_suku' => $_POST['asal_daerah_suku'],
			'bahasa' => $_POST['bahasa'],
			'alamat_rumah' => $_POST['alamat_rumah'],
			'pendidikan' => $_POST['pendidikan'],
			'pekerjaan' => $_POST['pekerjaan'],
			'foto' => $_POST['foto']
		);

		if($this->model->save($data)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}
		
		echo json_encode($return);
	}

	public function update($id){

		$data = array(
			'kat_ortu_wali' => $_POST['kat_ortu_wali'],
			'nm_ortu_wali' => $_POST['nm_ortu_wali'],
			'nik' => $_POST['nik'],
			'tmp_lahir' => $_POST['tmp_lahir'],
			'tgl_lahir' => $_POST['tgl_lahir'],
			'agama' => $_POST['agama'],
			'asal_daerah_suku' => $_POST['asal_daerah_suku'],
			'bahasa' => $_POST['bahasa'],
			'alamat_rumah' => $_POST['alamat_rumah'],
			'pendidikan' => $_POST['pendidikan'],
			'pekerjaan' => $_POST['pekerjaan']
		);

		if(!is_null($_FILE['foto']['name']) || $_FILE['foto']['name'] != '') $data['foto'] = $_FILE['foto']['name']; 

		if($this->model->update($data,$id)){
			$return = array('success'=>true);
		}else{
			$return = array('success'=>false);
		}
		
		echo json_encode($return);
	}

	public function remove_ortu($id){
		if($this->model->delete($id)){
			header('location:'.URL.'ortu');
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
			'kat_kontak' => 2,
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

	public function get_detil_ortu($id){
		//detil data ortu
		$detil = $this->get_by_id($id,false);
		$detil = $detil[0];
		if(is_null($detil['foto'])) $detil['foto'] = 'public/image/nopict.jpg';
		$detil['tgl_lahir'] = Tanggal::tgl_indo($detil['tgl_lahir']);
		$detil['kat_ortu_wali'] = $this->kategoris[$detil['kat_ortu_wali']-1];
		$detil['pendidikan'] = $this->pendidikans[$detil['pendidikan']-1];
		$detil['pekerjaan'] = $this->pekerjaans[$detil['pekerjaan']-1];

		//kontak
		$kontak = $this->get_contacts($id,false);
		
		//siswa
		$siswa = $this->model->getSiswa($id);
		$data = array(
				'data' => array('size'=>count($detil),'data'=>$detil),
				'kontak'=>array('size'=>count($kontak),'data'=>$kontak),
				'siswa'=>array('size'=>count($siswa),'data'=>$siswa)
			);
		echo json_encode($data);
	}

	public function get_referensi(){
		$kategoris = array(
			0=>array("id"=>1,"kat"=>"Bapak"),
			1=>array("id"=>2,"kat"=>"Ibu"),
			2=>array("id"=>3,"kat"=>"Wali")
		);

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
			'kategori' => $kategoris,
			'agama' => $agamas,
			'pendidikan' => $pendidikans,
			'pekerjaan' => $pekerjaans,
			'kontak' => $kontaks
		);
		
		echo json_encode($referensi);
	}

}