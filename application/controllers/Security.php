<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends CI_Controller {

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
        $data = array(
            'Id','EmailAddress','Password'
        );
        $this->session->unset_userdata($data);
		$this->load->view('security/index');
    }
    
    public function authenticate(){
        $emailAddress = $this->input->post('emailAddress');
        $password = $this->input->post('password');

        $result = $this->database_model->validateUser($emailAddress, $password);

        if($result != null){
            $data = array(
                'Id'=>$result['Id'],
                'EmailAddress'=>$result['EmailAddress'],
                'RoleId'=>$result['RoleId']
            );

            $this->session->set_userdata($data);
            if($this->session->userdata('RoleId') == 1){
                redirect('Home');
            }
            else if($this->session->userdata('RoleId')==2){
                redirect('Doctor');
            }
            else if($this->session->userdata('RoleId')==4){
                redirect('Pharmacist');
            }
            else{
                redirect('Nurse');
            }
        }   
        else{
          redirect('security/index/error');
        }
    }
}
