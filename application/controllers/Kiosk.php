<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiosk extends CI_Controller {

    public function index(){
        
        $data['PatientDetails'] = $this->database_model->getSpecificPatientRelative();
        $PatientId = $data['PatientDetails']['Id'];
        $data['EngagementDetails'] = $this->database_model->getLatestEngagement($PatientId);

        $data['medicineSchedule']=$this->database_model->getMedicineScheduleByRelative();

        $this->load->view('kiosk/index', $data);
    }

    public function saveMedicineActivity(){

        $MedicineScheduleId = $this->input->post('MedicineScheduleId');
        $nurseRemarks = $this->input->post('activity');
        $medicineDescription = $this->database_model->toggleMedicineScheduleRelative($MedicineScheduleId,$nurseRemarks);

        return true;
    }

    function enDetails(){

		$data['NurseActivity'] = $this->database_model->getAllNurseActivityRelative();

		$this->load->view('kiosk/endetails', $data);
    }

    function notifyNurse(){
        $this->load->view('kiosk/notifyNurse');
    }

}