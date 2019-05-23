<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab extends CI_Controller {

    public function index(){
        $data['Patient'] = $this->database_model->getAll('R_Patient');
		$this->load->view('lab/index',$data);
    }

}