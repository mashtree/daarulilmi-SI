<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenjadwalanController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->load('ext/penjadwalan');
    }


    public function __destruct() {
        parent::__destruct();
    }
}