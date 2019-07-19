<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacist extends CI_Controller {

    function index(){

        $data['RequestedMedicine'] = $this->database_model->getPendingMedicine(); 
        $this->load->view('pharma/index', $data);
        
    }

    function toggleStatus(){
        $Id = $this->uri->segment(3);
        $Status = $this->uri->segment(4);

        $result = $this->database_model->toggleMedicineStatus($Id, $Status);

        // redirect('pharmacist/index');
    }

}
