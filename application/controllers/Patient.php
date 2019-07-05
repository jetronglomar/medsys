<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {


	public function index(){

		$data['Patient'] = $this->database_model->getAll('R_Patient');
		$this->load->view('patient/index',$data);
	}

	public function register()
	{ 
		
		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');
		
		$this->load->view('patient/register',$data);
	}

	public function edit(){
		$Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);

		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');

		$this->load->view('patient/edit', $data);
	}

	public function detail(){
		$Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($Id);
		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');

		$this->load->view('patient/detail', $data);
	}

	public function savePatient(){
		
		$Id= $this->uri->segment(3);

		$FirstName = $this->input->post('FirstName');
		$MiddleName = $this->input->post('MiddleName');
		$LastName = $this->input->post('LastName');
		$Gender = $this->input->post('Gender');
		$Birthday = $this->input->post('Birthday');
		$Address1 = $this->input->post('Address1');
		$Address2 = $this->input->post('Address2');
		$CityVillage = $this->input->post('CityVillage');
		$StateProvince = $this->input->post('StateProvince');
		$Country = $this->input->post('Country');
		$PostalCode = $this->input->post('PostalCode');
		$PhoneNumber = $this->input->post('PhoneNumber');
		$CellPhoneNumber = $this->input->post('CellPhoneNumber');

		$QRCode = $this->randomizer();
		 $QRCode;
 
		$result= 	$this->database_model->savePatient($Id, $FirstName,$MiddleName, $LastName,$QRCode, $Gender, $Birthday, $Address1, $Address2, $CityVillage, $StateProvince, $Country, $PostalCode, $PhoneNumber, $CellPhoneNumber);
		if($result == true){
			redirect('patient/index');
		}
	}

	function toggleStatus(){
		$status = $this->uri->segment(3);
		$Id = $this->uri->segment(4);
		$result = $this->database_model->toggleStatus($status,$Id);
		redirect('patient/index');
	}

	function randomizer(){

		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$alpha=substr(str_shuffle($chars), 0, 50);
		return $alpha;
	}

	function engagement(){
		
		$Id = $this->uri->segment(3);	

		$data['Id'] = $Id;
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);
		$data['Purpose'] = $this->database_model->getAll('R_Purpose');
		$data['Patient'] = $this->database_model->getAll('R_Patient');
		$data['Room'] = $this->database_model->getAll('R_Room');
		$this->load->view('patient/engagement', $data);

	}

	function saveEngagement(){

		$PatientId = $this->input->post('PatientId');
		$PurposeId = $this->input->post('PurposeId');
		$PatientType = $this->input->post('PatientType');
		$RoomId = $this->input->post('RoomId');

		$currentDate = date('Y-m-d h:i:sa');
		$result = $this->database_model->saveEngagement($PatientId, $PurposeId, $PatientType, $RoomId, $currentDate);

		$EngagementId = $result['Id'];

		redirect('patient/enDetails/'.$EngagementId);		
	}

	function enDetails(){
		$Id = $this->uri->segment(3);
		$data['EngagementDetails'] = $this->database_model->selectSpecificEngagement($Id);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($data['EngagementDetails']['PatientId']);
		$data['MedicalRecord'] = $this->database_model->getLaboratoryResultbyPatientId($data['EngagementDetails']['PatientId']);
		
		$data['RecentEngagement'] = $this->database_model->getRecentVisit($data['EngagementDetails']['PatientId']);
		$data['ChiefComplaint'] = $this->database_model->getAll('R_ChiefComplaint');

		$data['EngagementDetailsFinal'] = $this->database_model->getEngagementDetails($Id);
		if($data['EngagementDetailsFinal'] != null)
			$data['Allergies'] = $this->database_model->getAllergies($data['EngagementDetailsFinal']['Id']);
		else
			$data['Allergies'] = null;

		$this->load->view('patient/endetails', $data);
	}

	function saveEnDetails(){

		// echo "its working";
		$Height =  $this->input->post('Height');
		$Pulse =  $this->input->post('Pulse'); 
		$Weight =  $this->input->post('Weight');
		$Respiratory =  $this->input->post('Respiratory');
		$BMI =  $this->input->post('BMI');
		$BPNum =  $this->input->post('BPNum');
		$BPDen =  $this->input->post('BPDen');
		$chiefComplaint = $this->input->post('chiefComplaint');
		$chiefComplaintRemarks = $this->input->post('chiefComplaintRemarks');
		$EngagementId = $this->input->post('EngagementId');

		$engagementDetailsId = $this->database_model->saveEngagementDetails(
			$Height,
			$Pulse,
			$Weight,
			$Respiratory,
			$BMI,
			$BPNum,
			$BPDen,
			$chiefComplaint,
			$chiefComplaintRemarks,
			$EngagementId
		);


		

		$allergy = $_POST['allergy'];
		// print_r($allergy);

		for($i = 0; $i<count($allergy); $i++){
			// create functionality for saving allergyu
			$this->database_model->saveAllergies($allergy[$i], $engagementDetailsId);
		}
	}


	public function card(){
		$Id = $this->uri->segment(3);
		$data['PatientDetails'] = $this->database_model->getSpecificPatient($Id);
		
		$this->load->view('patient/card',$data);
	}
}
