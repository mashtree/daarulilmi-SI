<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AnggaranController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->load('ext/anggaran');
    }


    public function __destruct() {
        parent::__destruct();
    }
}