<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data['EngagementList'] =$this->database_model->getAllTodaysEngagement();
        // print_r($data);
		$this->load->view('doctor/index',$data);
	}

	public function patientdetails(){
		$Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($Id);
		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');

		$this->load->view('doctor/patientdetail', $data);
	}

	function enDetails(){
		$Id = $this->uri->segment(3);
		$data['EngagementDetails'] = $this->database_model->selectSpecificEngagement($Id);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($data['EngagementDetails']['PatientId']);
		$data['MedicalRecord'] = $this->database_model->getLaboratoryResultbyPatientId($data['EngagementDetails']['PatientId']);
		
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($data['EngagementDetails']['PatientId']);
		$data['ChiefComplaint'] = $this->database_model->getAll('R_ChiefComplaint');
		$data['Disposition'] = $this->database_model->getAll('R_Disposition');

		$data['EngagementDetailsFinal'] = $this->database_model->getEngagementDetails($Id);
		if($data['EngagementDetailsFinal'] != null)
			$data['Allergies'] = $this->database_model->getAllergies($data['EngagementDetailsFinal']['Id']);
		else
			$data['Allergies'] = null;

		$this->load->view('doctor/endetails', $data);
	}
}
