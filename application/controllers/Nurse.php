<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nurse extends CI_Controller {

    public function index(){
        $data['Patient'] = $this->database_model->getAll('R_Patient');
		$this->load->view('nurse/index',$data);
    }

    public function patientAccess(){

		$Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatientByQR($Id);
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($data['PatientDetails']['Id']);
		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');

		$this->load->view('nurse/detail', $data);
    }
    
    public function patientDetail(){
        $Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($Id);
		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');

		$this->load->view('nurse/detail', $data);
    }

    public function card(){
		$Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);
		
		$this->load->view('patient/card',$data);
    }
    
    function enDetails(){
		$Id = $this->uri->segment(3);
		
		$data['EngagementDetails'] = $this->database_model->selectSpecificEngagement($Id);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($data['EngagementDetails']['PatientId']);
		$data['MedicalRecord'] = $this->database_model->getLaboratoryResultbyPatientId($data['EngagementDetails']['PatientId']);
		
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($data['EngagementDetails']['PatientId']);
		$data['ChiefComplaint'] = $this->database_model->getAll('R_ChiefComplaint');
		$data['Disposition'] = $this->database_model->getAll('R_Disposition');
		
		$data['EngagementDetailsFinal'] = $this->database_model->getEngagementDetails($data['EngagementDetails']['Id']);

        
        if($data['EngagementDetailsFinal'] != null){
            $data['NurseActivity'] = $this->database_model->getAllNurseActivity($data['EngagementDetailsFinal']['Id']);
            $data['Allergies'] = $this->database_model->getAllergies($data['EngagementDetailsFinal']['Id']);
        }
        else{
            $data['NurseActivity'] = null;
            $data['Allergies'] = null;
        }

		$this->load->view('nurse/endetails', $data);
    }
    
    public function saveactivity(){
        $ActivityDetails = $this->input->post('activity');
        $EngagementDetailsId = $this->input->post('EngagementDetailsId');

        $this->database_model->saveActivity($ActivityDetails, $EngagementDetailsId);

        return true;
    }
}