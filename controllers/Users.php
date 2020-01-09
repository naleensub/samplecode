<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
	}

	public function index()
	{
		$this->create();
	}

	/**
	* @func create
	* Displays User Registration Form
	*/
	public function create()
	{
		//Captca
		$this->load->helper('captcha');
		
		$vals = array(
			'img_path'      => './captcha_images/',
	        'img_url'       => base_url().'captcha_images/',
	        'img_width'		=> '250',
	        'img_height'	=> '50',
		);
		$cap = create_captcha($vals);
		//Save Captcha data to the database
		if(!empty($cap))
		{
			$this->load->model('Captcha_model');
			$this->Captcha_model->insert_captcha_data($cap);
		}

		$data['page_title'] = 'Owner Registration';
		$data['vals'] = $vals; //captcha
		$data['captcha_image'] = $cap['image'];

		//Load Header section
		$this->load->view('landingpage/main_header', $data);
		$this->load->view('landingpage/nav');

		//Load User Registration form
		$this->load->view('users');

		//Load Footer Section
		$this->load->view('landingpage/contact.html');
		$this->load->view('landingpage/footer');
	}

	/**
	* @func post
	* Owners registration validation
	* post data to the database
	* redirects to the Restaurants Registration
	*/
	public function post()
	{
		//Session Library
		$this->load->library('session');
		//Captch Model
		$this->load->model('Captcha_model');
		//Form Validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" style="margin-top: 4px;">', '</div>');

		//Set validation rules
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required', array('required'=>'The First Name is required'));
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required', array('required'=>'The Last Name is required'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email_address]', array('required'=>'The Email is required', 'is_unique' => 'This email is already used'));
		$this->form_validation->set_rules('mnumber', 'Mobile Number', 'trim|required|is_natural|min_length[10]|max_length[10]|is_unique[users.mobile_number]', array('required'=>'The Mobile Number is required', 'is_unique' => 'This Mobile Number already exists'));
		$this->form_validation->set_rules('uname', 'Username', 'trim|required|min_length[4]|max_length[12]|is_unique[users.username]', array('required'=>'The Username is required', 'is_unique' => 'The Username already exists'));
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[8]', array('required'=>'The Password is required', 'min_length' => 'The Password must be at least 8 characters'));
		$this->form_validation->set_rules('cpwd', 'Password Confirmation', 'trim|required|matches[pwd]', array('required'=>'The Password Confirmation is required', 'matches' => 'The Password and Confirm Password does not match'));

		//Check whether the validation errors exit
		if ($this->form_validation->run() == FALSE)
		{
			//Check Captcha if only validation error exists
			$this->load->helper('captcha');
			$vals = array(
				'img_path'      => './captcha_images/',
		        'img_url'       => base_url().'captcha_images/',
		        'img_width'		=> '250',
	        	'img_height'	=> '50',
			);
			$cap = create_captcha($vals);

			if(!empty($cap))
			{
				$this->Captcha_model->insert_captcha_data($cap);
			}

			$data['page_title'] = 'Owner Registration';
			$data['vals'] = $vals; //captcha
			$data['captcha_image'] = $cap['image'];
			//Load Header section
			$this->load->view('landingpage/main_header', $data);
			$this->load->view('landingpage/nav');

			$this->load->view('users');

			//Load Footer Section
			$this->load->view('landingpage/contact.html');
			$this->load->view('landingpage/footer');
		}
		else
		{
			//Check Captcha before adding data to the database
			$row = $this->Captcha_model->check_captcha();

			if ($row->count == 0)
			{
				//Load the Page with Captcha Again
				$this->load->helper('captcha');
				$vals = array(
					'img_path'      => './captcha_images/',
			        'img_url'       => base_url().'captcha_images/',
			        'img_width'		=> '250',
	        		'img_height'	=> '50',
				);
				$cap = create_captcha($vals);

				if(!empty($cap))
				{
					$this->Captcha_model->insert_captcha_data($cap);
				}

				$data['page_title'] = 'Owner Registration';
				$data['vals'] = $vals; //captcha
				$data['captcha_image'] = $cap['image'];
				//Load Header section
				$this->load->view('landingpage/main_header', $data);
				$this->load->view('landingpage/nav');

				$err['err1'] = 'You must submit the word that appears in the image.';

				$this->load->view('users', $err);

				//Load Footer Section
				$this->load->view('landingpage/contact.html');
				$this->load->view('landingpage/footer');
			}
			else
			{
				//Save data to the database only when the Captcha matches
				$this->load->model('Users_model');
				$user_id = $this->Users_model->insert_users();
				//Add UserID in the session
				if(isset($user_id) && !empty($user_id))
				{
					$this->session->set_userdata('usr_det', $user_id);
					//Set Flash Data
					$this->session->set_flashdata('usr_add', 'added');
					//Redirect to the Restaurant Controller
					redirect('/restaurants/create');
				}
				else
				{
					$this->create();
				}
			}
		}

		//return FALSE;
	}
}
