<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function Register()
	{ 
		$this->load->model('database_model');

		$data['Countries'] = $this->database_model->getAll('R_Countries');
		$data['Cities'] = $this->database_model->getAll('R_City');
		$data['Provinces'] = $this->database_model->getAll('R_Province');

		$this->load->view('patient/register',$data);
	}

	public function savePatient(){
		
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
 
		$result= 	$this->database_model->savePatient($FirstName,$MiddleName, $LastName,$QRCode, $Gender, $Birthday, $Address1, $Address2, $CityVillage, $StateProvince, $Country, $PostalCode, $PhoneNumber, $CellPhoneNumber);
		if($result == true){
			echo "success saving";
		}
	}

	function randomizer(){

		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$alpha=substr(str_shuffle($chars), 0, 50);
		return $alpha;
	}
}
