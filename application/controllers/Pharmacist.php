<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacist extends CI_Controller {

    function index(){
        
        $this->load->view('pharma/index');
    }

}
