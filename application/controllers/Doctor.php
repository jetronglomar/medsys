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

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	if($this->session->userdata('RoleId') !=4)
	// 		redirect('security');
	// }
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
		
		$data['EngagementDetailsFinal'] = $this->database_model->getEngagementDetails($data['EngagementDetails']['Id']);

		if($data['EngagementDetailsFinal'] != null){
			$data['Allergies'] = $this->database_model->getAllergies($data['EngagementDetailsFinal']['Id']);
			$data['Medicines'] = $this->database_model->getAllMedicines($data['EngagementDetailsFinal']['Id']);
			$data['NurseActivity'] = $this->database_model->getAllNurseActivity($data['EngagementDetailsFinal']['Id']);
		}
		else{
			$data['Allergies'] = null;
			$data['NurseActivity'] = null;
		}
		$this->load->view('doctor/endetails', $data);
	}

	function saveEnDetails(){

		// echo "its working";
		$Id = $this->uri->segment(3);
		$PresentIllnessHistory = $this->input->post('presentIllnessHistory');
		$CurrentMedicine = $this->input->post('CurrentMedicine');
		$SystemsReview = $this->input->post('systemsReview');
		$Medicine = "";
		$Tests = $this->input->post('tests');
		$Referrals = $this->input->post('referrals');
		$DispositionId = $this->input->post('dispositionId');
		$FollowUpDate = $this->input->post('followUpDate');
		$EngagementId = $this->input->post('EngagementId');

		$engagementDetailsId = $this->database_model->updateEngagementDetails(
			$Id,
			$PresentIllnessHistory,
			$CurrentMedicine,
			$SystemsReview,
			$Medicine,
			$Tests,
			$Referrals,
			$DispositionId,
			$FollowUpDate,
			$EngagementId
		);
		$medicine = $_POST['medName'];
		$qty = $_POST['qty'];
		$datestart = $_POST['datestart'];

		if($medicine[0]!= null){
			$this->database_model->deleteMedicine($engagementDetailsId);
			for($i = 0; $i<count($medicine); $i++){
				$this->database_model->saveEngagementMedicine($engagementDetailsId, $medicine[$i], $qty[$i], $datestart[$i]);
			}
		}

		return true;
	}

	function endEngagement(){
		$EngagementDetailsId = $this->uri->segment(3);


		$result = $this->database_model->EndEngagement($EngagementDetailsId);

		return $result;
	}

	function printReport(){
		// $this->uri->segment
		$Id = $this->uri->segment(3);
		$data['EngagementDetailsFinal'] = $this->database_model->getEngagementDetailsById($Id);
		$data['EngagementDetails'] = $this->database_model->selectSpecificEngagement($data['EngagementDetailsFinal']['EngagementId']);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($data['EngagementDetails']['PatientId']);
		$data['MedicalRecord'] = $this->database_model->getLaboratoryResultbyPatientId($data['EngagementDetails']['PatientId']);
		
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($data['EngagementDetails']['PatientId']);
		$data['ChiefComplaint'] = $this->database_model->getAll('R_ChiefComplaint');
		$data['Disposition'] = $this->database_model->getAll('R_Disposition');


		
		$this->load->view('doctor/report', $data);
	}

	public function GetMedicine(){
		$json = [];
		
		$this->load->database();

		if(!empty($this->input->get("q"))){
            $keyword =  $this->input->get("q");
            $json = $this->database_model->getSpecificMedicine($keyword);
		}
		echo json_encode($json);
    }
}
