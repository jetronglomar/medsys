<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_model extends CI_Model
{
    public function getAll($tableName){
        
        $result = $this->db->get($tableName)->result();
        
        return $result;
    }

    public function savePatient($FirstName,$MiddleName, $LastName,$QRCode, $Gender, $Birthday, $Address1, $Address2, $CityVillage, $StateProvince, $Country, $PostalCode, $PhoneNumber, $CellPhoneNumber){

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

        return true;
    }


}