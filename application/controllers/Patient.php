<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function Register()
	{
		$this->load->view('patient/register');
	}
}
