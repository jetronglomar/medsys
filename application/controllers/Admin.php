<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function user(){


        $data['User']=$this->database_model->getAllUser();

        $this->load->view('admin/user', $data);
    }


    public function editUser(){
        $Id = $this->uri->segment(3);

        $data['Role'] = $this->database_model->getAll('R_Role');
        $data['UserDetails'] = $this->database_model->getSpecificUser($Id);

        $this->load->view('admin/editUser', $data);
    }

    public function updateUser(){
        $Id = $this->uri->segment(3);

        $Password = $this->input->post('Password');
        $Name = $this->input->post('Name');
        $EmailAddress = $this->input->post('EmailAddress');
        $RoleId = $this->input->post('RoleId');


        $secretCode = $this->generateRandomString(32);
        $Password = $this->encryptor($Password,$secretCode);


        //create database model for update user
        $result = $this->database_model->updateUser($Id, $Name, $EmailAddress, $Password, $secretCode, $RoleId);

        if($result){
            //Redirect to index then fire swal

            redirect('admin/user');
        }
        else{
            //Do something
            redirect('admin/user');
        }
    }

    public function addUser(){

        $data['Role'] = $this->database_model->getAll('R_Role');
        $this->load->view('admin/addUser', $data);
    }


    function encryptor($plainText, $encryptionCode){

        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => $encryptionCode
            )
        );

        $ciphertext = $this->encryption->encrypt($plainText);

        return $ciphertext;
    }

    function decryptor($encryptedText, $encryptionCode){

        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => $encryptionCode
            )
        );

        $decryptedText = $this->encryption->encrypt($encryptedText);

        return $decryptedText;
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}