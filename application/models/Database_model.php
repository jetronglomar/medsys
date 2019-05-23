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


    

}