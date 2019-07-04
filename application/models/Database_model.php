<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_model extends CI_Model
{
    public function getAll($tableName){
        
        $result = $this->db->get($tableName)->result();
        
        return $result;
    }

    public function getSpecificPatient($Id){

        $query_string = "select * from R_Patient where Id = $Id";
        
        $data = $this->db->query($query_string)->row_array();
        return $data;
    }

    public function savePatient($Id, $FirstName,$MiddleName, $LastName,$QRCode, $Gender, $Birthday, $Address1, $Address2, $CityVillage, $StateProvince, $Country, $PostalCode, $PhoneNumber, $CellPhoneNumber){

        $Birthday = date("Y-m-d", strtotime($Birthday));

        if($Id == 0){
            $data = array(
                'FirstName' => $FirstName,
                'MiddleName' => $MiddleName,
                'LastName' => $LastName,
                'QR' => $QRCode,
                'Gender' => $Gender,
                'Birthday' => $Birthday,
                'Address1' => $Address1,
                'Address2' => $Address2,
                'CityVillage' => $CityVillage,
                'StateProvince' => $StateProvince,
                'Country' => $Country,
                'PostalCode' => $PostalCode,
                'PhoneNumber' => $PhoneNumber,
                'CellPhoneNumber' => $CellPhoneNumber
            );

            $this->db->insert('R_Patient', $data);
        }
        else{
            $data = array(
                'FirstName' => $FirstName,
                'MiddleName' => $MiddleName,
                'LastName' => $LastName,
                'QR' => $QRCode,
                'Gender' => $Gender,
                'Birthday' => $Birthday,
                'Address1' => $Address1,
                'Address2' => $Address2,
                'CityVillage' => $CityVillage,
                'StateProvince' => $StateProvince,
                'Country' => $Country,
                'PostalCode' => $PostalCode,
                'PhoneNumber' => $PhoneNumber,
                'CellPhoneNumber' => $CellPhoneNumber
            );
            $this->db->where('Id', $Id);
            $this->db->update('R_Patient', $data);
        }
        return true;
    }

    public function toggleStatus($status,$Id){

        $data = array(
                'Status'=> $status
        );
        $this->db->where('Id', $Id);
        $this->db->update('R_Patient', $data);
    }

    public function saveLabResult($Id,$TestDate, $ResultDate, $Findings, $RequestedBy, $PatientId, $CategoryId, $Attachment, $ExecutedBy){
        if($Id == 0){
            $data = array(
                'TestDate' => $TestDate,
                'ResultDate' => $ResultDate,
                'Findings' => $Findings,
                'RequestedBy' => $RequestedBy,
                'PatientId' => $PatientId,
                'CategoryId' => $CategoryId,
                'Attachment' => $Attachment,
                'ExecutedBy' => $ExecutedBy
            );

            $this->db->insert('T_LaboratoryResult', $data);
        }
        else{
            $data = array(
                'TestDate' => $TestDate,
                'ResultDate' => $ResultDate,
                'Findings' => $Findings,
                'RequestedBy' => $RequestedBy,
                'PatientId' => $PatientId,
                'CategoryId' => $CategoryId,
                'Attachment' => $Attachment,
                'ExecutedBy' => $ExecutedBy
            );

            $this->db->where('Id', $Id);
            $this->db->update('T_LaboratoryResult', $data);
        }

        return true;
    }

    public function getLaboratoryResult(){

        $query_string = "select t.Id,
                        t.TestDate,
                        t.ResultDate,
                        t.Findings,
                        t.Attachment,
                        concat(p.LastName,', ',
                        p.FirstName,' ',
                        p. MiddleName) as 'PatientName',
                        concat(d.LastName,', ',
                        d.FirstName,' ',
                        d. MiddleName) as 'DoctorName',
                        c.Description as 'CategoryDescription'
                        
                        from T_LaboratoryResult t
                        inner join R_Patient p on t.PatientId = p.Id
                        inner join R_Doctor d on t.RequestedBy = d.Id
                        inner join R_LaboratoryCategory c on t.CategoryId = c.Id";

        return $this->db->query($query_string)->result();
    }


    public function getSpecificLabResult($Id){

        $query_string = "select * from T_LaboratoryResult where Id = $Id";
        
        $data = $this->db->query($query_string)->row_array();
        return $data;
    }


    public function saveEngagement($PatientId, $PurposeId, $PatientType, $RoomId,$DateOfEngagement){
        $data = array(
            'PatientId'=> $PatientId,
            'PurposeId'=> $PurposeId,
            'PatientType' => $PatientType,
            'RoomId' =>$RoomId,
            'DateOfEngagement'=> $DateOfEngagement
        );
        
        $this->db->insert('T_Engagement', $data);


        $query_string = "select * from T_Engagement order by Id desc limit 1";
        $data = $this->db->query($query_string)->row_array();

        return $data;
    }
    

    public function selectSpecificEngagement($Id){

        $query_string = "select * from T_Engagement where Id = $Id";
        $data = $this->db->query($query_string)->row_array();

        return $data;
    }

    public function getDescription($Id,$TableName){
        $query_string = "select * from $TableName where Id = $Id";

        $data = $this->db->query($query_string)->row_array();
        return $data['Description'];        
    }


    public function getLaboratoryResultbyPatientId($PatientId){


        $query_string = "select t.Id,
                        t.TestDate,
                        t.ResultDate,
                        t.Findings,
                        t.Attachment,
                        concat(p.LastName,', ',
                        p.FirstName,' ',
                        p. MiddleName) as 'PatientName',
                        concat(d.LastName,', ',
                        d.FirstName,' ',
                        d. MiddleName) as 'DoctorName',
                        c.Description as 'CategoryDescription'
                        
                        from T_LaboratoryResult t
                        inner join R_Patient p on t.PatientId = p.Id
                        inner join R_Doctor d on t.RequestedBy = d.Id
                        inner join R_LaboratoryCategory c on t.CategoryId = c.Id
                        where p.Id = $PatientId";

        return $this->db->query($query_string)->result();
    }

    public function getRecentVisit($PatientId){

        $query_string = "select * from T_Engagement where PatientId = $PatientId limit 6";
        $data = $this->db->query($query_string)->result();

        return $data;

    }

    public function saveEnagementDetails($Height,$Pulse,$Weight,$Respiratory,$BMI,$BPNum,$BPDen,$chiefComplaint,$chiefComplaintRemarks,$EngagementId)
    {
        $today = date("Y-m-d");

        $data = array(
            'Height'=>$Height,
            'Pulse'=>$Pulse,
            'Weight'=>$Weight,
            'Respiratory'=>$Respiratory,
            'BMI'=>$BMI,
            'BPNum'=>$BPNum,
            'BPDen'=>$BPDen,
            'chiefComplaint'=>$chiefComplaint,
            'chiefComplaintRemarks'=>$chiefComplaintRemarks,
            'DateCreated'=>$today,
            'DateModified'=>$today,
            'ModifiedBy'=>1,
            'EngagementId'=>$EngagementId
        );

        $this->db->insert('T_EngagementDetails', $data);

        $query_string = "select * from T_EngagementDetails order by Id desc limit 1";
        
        $query_result = $this->db->query($query_string)->row_array();
        return $query_result['Id'];

    }

    public function getEngagementDetails($EngagementId){

        $query_string = "select * from T_EngagementDetails where EngagementId=$EngagementId order by Id desc limit 1";
        
        $query_result = $this->db->query($query_string)->row_array();
        return $query_result;

    }

    public function saveAllergies($allergy, $engagementDetailsId){
        $data = array(
            'Description'=>$allergy,
            'EngagementDetailsId'=>$engagementDetailsId,
            'ActiveStatus'=>1
        );
        

        $this->db->insert('T_Allergies',$data);

    }

    public function getAllergies($engagementDetialsId){
        $query_string = "select * from T_Allergies where EngagementDetailsId = $engagementDetialsId";
        $data = $this->db->query($query_string)->result();

        return $data;
    }
}