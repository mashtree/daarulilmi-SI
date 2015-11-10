<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CalendarController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->load('ext/calendar');
    }

    public function ds() {
 $json = array();

 // Query that retrieves events
 $requete = "SELECT id, start_date as start, end_date as end, title,
 concat('http://url?id=',id) as url FROM `calendar`";

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



//       $this->view->load('ext/calendar-ds/bhsArab');
    }


    public function __destruct() {
        parent::__destruct();
    }
}