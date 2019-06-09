<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab extends CI_Controller {

    public function index(){
        $data['Laboratory'] = $this->database_model->getLaboratoryResult();
		$this->load->view('lab/index',$data);
    }

    public function new(){
        $data['Patient'] = $this->database_model->getAll('R_Patient');
        $data['Doctor'] = $this->database_model->getAll('R_Doctor');
        $data['LabCategory'] = $this->database_model->getAll('R_LaboratoryCategory');
        $this->load->view('lab/new',$data);
    }

    public function edit(){
        $Id = $this->uri->segment(3);
        $data['LabDetails'] = $this->database_model->getSpecificLabResult($Id);
        $data['Patient'] = $this->database_model->getAll('R_Patient');
        $data['Doctor'] = $this->database_model->getAll('R_Doctor');
        $data['LabCategory'] = $this->database_model->getAll('R_LaboratoryCategory');
        $this->load->view('lab/edit',$data);
    }

    public function saveResult(){

        $Id = $this->uri->segment(3);

        $randomFileName = $this->randomString(8);
        $extension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        $finalFileName = $randomFileName.'.'.$extension;
        $config['upload_path']          = './uploads/';
        $config['file_name'] = $finalFileName;
        $config['file_ext'] = '.'.$extension;
        $config['allowed_types']        = 'gif|jpg|png|pdf';

        $this->load->library('upload', $config);
        // Upload function
        
        if($extension != ""){   
            $this->upload->do_upload('attachment');
        }
        else{
            $finalFileName = $this->input->post('TempAttachment');
        }

        $Id = $this->uri->segment(3);
        $TestDate = $this->input->post('TestDate');
        $ResultDate = $this->input->post('ResultDate');
        $Findings = $this->input->post('Findings');
        $PatientId = $this->input->post('PatientId');
        $RequestedBy = $this->input->post('RequestedBy');
        $CategoryId = $this->input->post('CategoryId');
        
        //Change this if log-in is working 
        $currentUserId = 1;
        $ExecutedBy = $currentUserId;

        $result = $this->database_model->saveLabResult($Id,$TestDate, $ResultDate, $Findings, $RequestedBy, $PatientId, $CategoryId, $finalFileName, $ExecutedBy);
        if($result){
            redirect('Lab/index');
        }
    }

    public function randomString($length)
    {
        $characters = implode([
            'ABCDEFGHIJKLMNOPORRQSTUWVXYZ',
            'abcdefghijklmnoprqstuwvxyz',
            '0123456789',
            //'!@#$%^&*?'
        ]);

        $charactersLength = strlen($characters) - 1;
        $string           = '';

        while ($length) {
            $string .= $characters[mt_rand(0, $charactersLength)];
            --$length;
        }

        return $string;
    }

}