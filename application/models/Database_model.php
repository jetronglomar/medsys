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

    public function getSpecificPatientByQR($Id){

        $query_string = "select * from R_Patient where QR = '$Id'";
        
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
            'DateOfEngagement'=> $DateOfEngagement,
            'IsEnded' => 1
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

    public function getAllTodaysEngagement(){
        $today = date("Y-m-d");
        $query_string = "
            select e.*,
            p.FirstName,
            p.LastName,
            p.MiddleName,
            p.Gender
            from T_Engagement e
            inner join R_Patient p
            on e.PatientId = p.Id
            where e.IsEnded = 0";
            
            // where date(e.DateOfEngagement) = '$today'";

        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function getEngagementForDoctor(){
        $UserId = 1;
        $today = date("Y-m-d");
        $query_string = "
            select e.*,
            p.FirstName,
            p.LastName,
            p.MiddleName,
            p.Gender
            from T_Engagement e
            inner join R_Patient p
            on e.PatientId = p.Id
            where e.IsEnded = 0
            and e.Id in 
            (select td.EngagementId from T_EngagementDetails td where td.Id in (select EngagementId from T_EngagementDetailsDoctor where DoctorId = $UserId ))";
            
            // where date(e.DateOfEngagement) = '$today'";

        $data = $this->db->query($query_string)->result();

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

        $query_string = "select * from T_Engagement where PatientId = $PatientId order by Id desc limit 6";
        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function saveEngagementDetails($Height,$Pulse,$Weight,$Respiratory,$BMI,$BPNum,$BPDen,$chiefComplaint,$chiefComplaintRemarks,$EngagementId)
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
            'EngagementId'=>$EngagementId,
            'EngagementStatus'=> 1
        );

        $this->db->insert('T_EngagementDetails', $data);

        $dataToUpdate = array(
            'IsEnded' => 0
        );

        $this->db->where('Id', $EngagementId);
        $this->db->update('T_Engagement', $dataToUpdate);

        $query_string = "select * from T_EngagementDetails order by Id desc limit 1";
        
        $query_result = $this->db->query($query_string)->row_array();
        return $query_result['Id'];

    }

    public function getEngagementDetails($EngagementId){

        $query_string = "select * from T_EngagementDetails where EngagementId=$EngagementId order by Id desc limit 1";
        
        $query_result = $this->db->query($query_string)->row_array();
        return $query_result;

    }

    public function getEngagementDetailsById($Id){

        $query_string = "select * from T_EngagementDetails where Id=$Id order by Id desc limit 1";
        
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

    public function getAllMedicines($engagementDetialsId){
        $query_string = "select * from T_EngagementMedicine where EngagementDetailsId = $engagementDetialsId";
        $data = $this->db->query($query_string)->result();

        return $data;
    }


    public function getAllDoctors($engagementDetialsId){
        $query_string = "select * from T_EngagementDetailsDoctor where EngagementDetailsId = $engagementDetialsId";
        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function getAllNurseActivity($engagementDetailsId){
        $query_string ="select * from T_NurseActivity where EngagementDetailsId = $engagementDetailsId";
        $data = $this->db->query($query_string)->result();
        return $data;
    }

    public function getDoctorName($DoctorId){

        $query_string ="select * from R_Doctor where Id = $DoctorId";
        $data =  $this->db->query($query_string)->row_array();
        return $data['FirstName'].' '.$data['LastName'];
    }


    public function updateEngagementDetails($Id,$PresentIllnessHistory,$CurrentMedicine,$SystemsReview,$Medicine,$Tests,$Referrals,$DispositionId,$FollowUpDate,$EngagementId)
    {
        $today = date("Y-m-d");
        $FollowUpDate = date("Y-m-d", strtotime($FollowUpDate));

        $DoctorId = 1;
        $data = array(
            'PresentIllnessHistory'=>$PresentIllnessHistory,
            'CurrentMedicine'=>$CurrentMedicine,
            'SystemsReview'=>$SystemsReview,
            'Medicine'=>$Medicine,
            'Tests'=>$Tests,
            'Referrals'=>$Referrals,
            'DispositionId'=>$DispositionId,
            'FollowUpDate'=>$FollowUpDate,
            'DateModified'=>$today,
            'DoctorId'=>$DoctorId,
            'EngagementId'=>$EngagementId
        );
        $this->db->where('Id', $Id);
        $this->db->update('T_EngagementDetails', $data);

        return $Id;
    }

    public function EndEngagement($Id){
        $EngagementStatus = 0;
        $today = date("Y-m-d");

        $data = array(
            'EngagementStatus' => $EngagementStatus,
            'DateEnded' =>$today
        );


        $this->db->where('Id', $Id);
        $this->db->update('T_EngagementDetails', $data);

        return true;
    } 

    public function validateUser($emailAddress,$password){
        $query_string ="select * from R_User where EmailAddress = '$emailAddress' and Password = '$password'";

        $result = $this->db->query($query_string)->row_array();
        return $result;
    }

    public function saveActivity($ActivityDetails, $EngagementDetailsId){
        $NurseId = $this->session->userdata('Id');
        $today = date("Y-m-d h:i a");
        $data = array(
            'ActivityDetails' => $ActivityDetails,
            'EngagementDetailsId' => $EngagementDetailsId,
            'DateCreated' => $today,
            'NurseId' => $NurseId
        );

        $this->db->insert('T_NurseActivity', $data);
        
        return true;
    }

    public function getSpecificMedicine($keyword){
        $query_string = "select Id as 'id', Description as 'text' from R_Medicine where Description like '%$keyword%'";

        $data = $this->db->query($query_string)->result();
        return $data;
    }

    public function getSpecificDoctor($keyword){
        $query_string = "select Id as 'id', CONCAT(FirstName,' ',LastName) as 'text' from R_Doctor where FirstName like '%$keyword%' or LastName like '%$keyword%' or CONCAT(FirstName,' ',LastName) like '%$keyword%'";

        $data = $this->db->query($query_string)->result();
        return $data;
    }

    public function saveEngagementMedicine($engagementDetailsId, $medicine, $qty, $datestart){
        $today = date("Y-m-d H:i");
        $doctorID = $this->session->userdata('Id');
        $doctorData = $this->db->query("select * from R_Doctor where UserId = $doctorID")->row_array();
        
        $doctorID = $doctorData['Id'];
        
        $Status = 1;

        $date = explode('-',$datestart);


        $datestart = date('Y-m-d H:i', strtotime($date[0]));
        $dateend = date('Y-m-d H:i', strtotime($date[1]));
        


        $data = array(
            'EngagementDetailsId'=> $engagementDetailsId,
            'DoctorID'=> $doctorID,
            'MedicineId'=> $medicine,
            'Qty'=> $qty,
            'DateStart'=> $datestart,
            'DateEnd'=> $dateend,
            'Status'=> $Status,
            'DateCreated'=> $today
        );

        $this->db->insert('T_EngagementMedicine', $data);

        return true;
    }

    public function deleteMedicine($engagementDetailsId){

        $this->db->delete('T_EngagementMedicine', array('EngagementDetailsId' => $engagementDetailsId, 'Status' => 1 ));
    }

    public function saveEngagementDetailsDoctor($enagementDetailsId, $doctorId){
        $data = array(
            'DoctorId'=>$doctorId,
            'EngagementDetailsId'=> $enagementDetailsId
        );

        $this->db->insert('T_EngagementDetailsDoctor', $data);

        return true;
    }

    public function deleteDoctor($engagementDetailsId){
        $this->db->delete('T_EngagementDetailsDoctor', array('EngagementDetailsId' => $engagementDetailsId));
    }

    public function getEngagementNotEnded($PatientId){
        $query_string = "select * from T_Engagement where PatientId = $PatientId and IsEnded = 0";
        $result = $this->db->query($query_string)->result();

        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
        
    }


    public function getPendingMedicine(){
        $query_string = "select m.*,r.Description as 'roomDescription',CONCAT(p.FirstName,' ',p.LastName) as 'PatientName' , CONCAT(d.FirstName,' ',d.LastName) as 'DoctorName'
         from T_EngagementMedicine m 
         inner join T_EngagementDetails td on td.Id = m.EngagementDetailsId
         inner join T_Engagement t on td.EngagementId = t.Id 
         inner join R_Room r on t.RoomId = r.Id
         inner join R_Patient p on p.Id = t.PatientId 
         inner join R_Doctor d on d.Id = m.DoctorId order by m.Id desc";

        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function getDisapprovedMedicine(){
        $query_string = "select m.*,r.Description as 'roomDescription',CONCAT(p.FirstName,' ',p.LastName) as 'PatientName' , CONCAT(d.FirstName,' ',d.LastName) as 'DoctorName'
         from T_EngagementMedicine m 
         inner join T_EngagementDetails td on td.Id = m.EngagementDetailsId
         inner join T_Engagement t on td.EngagementId = t.Id 
         inner join R_Room r on t.RoomId = r.Id
         inner join R_Patient p on p.Id = t.PatientId 
         inner join R_Doctor d on d.Id = m.DoctorId 
         where m.Status = 0
         order by m.Id desc";

        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function toggleMedicineStatus($Id, $Status){
        
        $today = date("Y-m-d H:i");

        if($Status == 2){
            $data = array(
                'Status'=> $Status,
                'DateApproved' => $today
            );
        }
        else{
            $data = array(
                'Status'=> $Status
            );
        }

        

        $this->db->where('Id',$Id);
        $this->db->update('T_EngagementMedicine', $data);

        if($Status == 2){
            $query_string = "select * from T_EngagementMedicine where Id = $Id";
            
            $medicine = $this->db->query($query_string)->row_array();

            $dateEnd = strtotime($medicine['DateEnd']); 
            $dateStart = strtotime($medicine['DateStart']);

            $diff = $dateEnd - $dateStart;

            $hours = $diff / ( 60 * 60 );
            $days = round($hours/24);

            $NumberOfReminder = $days * $medicine['Qty'];
            if($today > $medicine['DateStart'])
                $tempToday = $today;
            else
                $tempToday = $medicine['DateStart'];

            $everywhatHour = round(24/$medicine['Qty']);
            for($i=0; $i<$NumberOfReminder; $i++){
                $medicineSchedule = array(
                    'MedicineDetailsId' => $Id,
                    'PlannedSchedule' => $tempToday
                );

                $this->db->insert('T_MedicineSchedule', $medicineSchedule);

                $tempToday = date("Y-m-d H:i", strtotime('+2 hours',strtotime($tempToday)));

                echo $tempToday;
                echo "<br/>";
            }
        }
        
        // return true;
    }

    public function toggleMedicineStatusNurse($Id, $Status){
        
        $today = date("Y-m-d H:i");

        if($Status == 2){
            $data = array(
                'Status'=> $Status,
                'DateApproved' => $today,
                'ProvidedByPatient'=>true
            );
        }

        

        $this->db->where('Id',$Id);
        $this->db->update('T_EngagementMedicine', $data);

        if($Status == 2){
            $query_string = "select * from T_EngagementMedicine where Id = $Id";
            
            $medicine = $this->db->query($query_string)->row_array();

            $dateEnd = strtotime($medicine['DateEnd']); 
            $dateStart = strtotime($medicine['DateStart']);

            $diff = $dateEnd - $dateStart;

            $hours = $diff / ( 60 * 60 );
            $days = round($hours/24);

            $NumberOfReminder = $days * $medicine['Qty'];
            if($today > $medicine['DateStart'])
                $tempToday = $today;
            else
                $tempToday = $medicine['DateStart'];

            $everywhatHour = round(24/$medicine['Qty']);
            for($i=0; $i<$NumberOfReminder; $i++){
                $medicineSchedule = array(
                    'MedicineDetailsId' => $Id,
                    'PlannedSchedule' => $tempToday
                );

                $this->db->insert('T_MedicineSchedule', $medicineSchedule);

                $tempToday = date("Y-m-d H:i", strtotime('+2 hours',strtotime($tempToday)));

                echo $tempToday;
                echo "<br/>";
            }
        }
        
        // return true;
    }
    
    

    public function getPendingMeds(){

        $today = date("Y-m-d H:i");
        $today = date("Y-m-d H:i", strtotime('+10 minutes',strtotime($today)));

        $query_string = "select t.Id as 'EngagementId', t.*,CONCAT(p.FirstName,' ',p.LastName) as 'patientName', m.Description as 'medicineDescription',r.Description as 'roomDescription',
                        (select count(tms.Id) from T_MedicineSchedule tms where tms.MedicineDetailsId = tm.Id and tms.PlannedSchedule<'$today' ) as 'Count'
                        from T_Engagement t
                        inner join T_EngagementDetails td on t.Id = td.EngagementId
                        inner join R_Patient p on p.Id = t.PatientId
                        inner join R_Room r on r.Id = t.RoomId
                        inner join T_EngagementMedicine tm on tm.EngagementDetailsId = td.Id
                        inner join R_Medicine m on m.Id = tm.MedicineId";

                        
                        
        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function getMedicineToBeProvided($EngagementDetailsId){
        
        $today = date("Y-m-d H:i");
        $today = date("Y-m-d H:i", strtotime('+10 minutes',strtotime($today)));


        $query_string = "select tms.*,tm.EngagementDetailsId,m.Description as 'medicineDescription'
        from T_MedicineSchedule tms 
        inner join T_EngagementMedicine tm on tms.MedicineDetailsId = tm.Id
        inner join R_Medicine m on tm.MedicineId = m.Id
        where tms.PlannedSchedule<'$today' and tm.EngagementDetailsId=$EngagementDetailsId";

        $data = $this->db->query($query_string)->result();

        return $data;
    }

    public function toggleMedicineSchedule($medicineScheduleId){
        
        $today = date("Y-m-d H:i");
        $NurseId = $this->session->userdata('Id');

        
        $data = array('');

        $this->db->where('Id', $medicineScheduleId);
        $this->db->update('T_MedicineSchedule', $data);
    }
}