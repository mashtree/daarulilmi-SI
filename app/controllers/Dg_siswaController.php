<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Dg_siswaController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->load('ext/datagridsiswa');
    }

    public function ds_siswa() {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        
        $Cond ='';
    
         $json = array();

         // Query that retrieves events
         $requete = "SELECT * FROM `siswa` $Cond limit $offset,$rows";
         $reqTotal = "SELECT count(*) as total FROM `siswa` $Cond";

         // connection to the database
         try {
            $bdd = new PDO('mysql:host=localhost;dbname=daarul_ilmi;charset=utf8', 'darulilmi', 'qwerty123!@#');
             } catch(Exception $e) {
              exit('Unable to connect to database.');
             }
         // Execute the query
        $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
        $resulTot = $bdd->query($reqTotal) or die(print_r($bdd->errorInfo()));
        $recordTtl = $resulTot->fetch(PDO::FETCH_NUM);
        $items['total'] =$recordTtl[0];
        $items['rows']=$resultat->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items);
    }

    public function ds_siswa_tracker() {
        $json = array();
        if (isset($_POST['id_siswa']) && !empty($_POST['id_siswa'])){

                $Cond = " where id_siswa = $_POST[id_siswa] ";
        }

         $requete = "SELECT * FROM `siswa_tracker` $Cond";

         // connection to the database
         try {
        $bdd = new PDO('mysql:host=localhost;dbname=daarul_ilmi;charset=utf8', 'darulilmi', 'qwerty123!@#');
         } catch(Exception $e) {
          exit('Unable to connect to database.');
         }
         // Execute the query
         $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

         // sending the encoded result to success page
         echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
    }

    public function ds_siswa_tracker_comment() {
        if (isset($_POST['id_tracker']) && !empty($_POST['id_tracker'])){

                $Cond = " where id_tracker = $_POST[id_tracker] ";
        }
        
        $json = array();
         $requete = "SELECT * FROM `siswa_tracker_comment` $Cond";

         // connection to the database
         try {
        $bdd = new PDO('mysql:host=localhost;dbname=daarul_ilmi;charset=utf8', 'darulilmi', 'qwerty123!@#');
         } catch(Exception $e) {
          exit('Unable to connect to database.');
         }
         // Execute the query
         $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

         // sending the encoded result to success page
         echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
    }
	public function multiset_field() {
        echo json_encode(array('error'=>true, 'Msg'=>'fungsi blm terdefinisi'));
    	}

	public function updateCell() {
        echo json_encode(array('error'=>true, 'Msg'=>'fungsi blm terdefinisi'));
    	}


    public function __destruct() {
        parent::__destruct();
    }
}