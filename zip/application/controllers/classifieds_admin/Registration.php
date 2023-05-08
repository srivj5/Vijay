<?php
class Registration extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library(array('form_validation', 'upload'));
		$this->load->library('session');
		$this->load->helper(array('url', 'language', 'text'));
	}

	public function index()
	{
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['register'] = $this->common_model->getTableData('company_registration', array('status'=>'1'), '', '', '', '', '', '', array('id', 'DESC'))->result();
		// print_r($data['register']);exit();
		$this->load->view('admin/registration/registration',$data);
	}
	function add_reg(){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('contract', 'Contract', 'trim|required|xss_clean');
			$this->form_validation->set_rules('feature', 'Feature', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('map', 'Map', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('facebook', 'Facebook', 'trim|required|xss_clean');
			$this->form_validation->set_rules('instagram', 'Instagram', 'trim|required|xss_clean');
			$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email_verify', 'Email Verify', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				$insertData['email'] = $this->db->escape_str($this->input->post('email'));
				$insertData['password'] = $this->db->escape_str($this->input->post('password'));
				$insertData['category'] = $this->db->escape_str($this->input->post('category'));
				$insertData['title'] = $this->db->escape_str($this->input->post('title'));
				$insertData['contract'] = $this->db->escape_str($this->input->post('contract'));
				$insertData['feature'] = $this->db->escape_str($this->input->post('feature'));
				$insertData['address'] = $this->db->escape_str($this->input->post('address'));
				$insertData['map'] = $this->db->escape_str($this->input->post('map'));
				$insertData['phone'] = $this->db->escape_str($this->input->post('phone'));
				$insertData['facebook'] = $this->db->escape_str($this->input->post('facebook'));
				$insertData['instagram'] = $this->db->escape_str($this->input->post('instagram'));
				$insertData['website'] = $this->db->escape_str($this->input->post('website'));
				$insertData['email_verification'] = $this->db->escape_str($this->input->post('email_verify'));
				$insertData['status'] = $this->db->escape_str($this->input->post('status'));
				$insertData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$insertData['created_on'] = date("Y-m-d h:i:sa");
				$insertData['approve_status'] = '1';

				$image = $_FILES['logo_file']['name'];
				if($image!="") 
				{
					$uploadimage=cdn_file_upload($_FILES["logo_file"],'uploads/admin');

					if($uploadimage)
					{
						$image=$uploadimage['secure_url'];
					}
					else
					{
						$this->session->set_flashdata('error','Problem with your image');
						front_redirect('classifieds_admin/registration/add_reg', 'refresh');
					}
				} 
				else 
				{ 
					$image=""; 
				}
				$insertData['logo'] = $image;
				$category = $this->input->post('category');

				$details = $this->db->query("SELECT * FROM `classifieds_company_registration` WHERE `category` = '".$category."'");
				if($details->num_rows()==0)
				{
					$insert = $this->common_model->insertTableData('company_registration', $insertData);
					if($insert){
						$this->session->set_flashdata('success','Data Added Successfully');
						front_redirect('classifieds_admin/registration', 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Unable to add the data !');
						admin_redirect('registration/add_reg');
					}
				}else{
						$this->session->set_flashdata('error', 'Already this category is available.Please edit');
						admin_redirect('registration/add_reg');
					}
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/registration/add_reg', 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/registration/add_reg';
		$this->load->view('admin/registration/add_registration', $data);
	}
	function edit_reg($id){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Is valid
		if ($id == '') {
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('registration');
		}
		$isValid = $this->common_model->getTableData('company_registration', array('id' => $id));
		if ($isValid->num_rows() == 0) {
			$this->session->set_flashdata('error', 'Unable to find this page');
			admin_redirect('registration');
		}
		else
		{
			$data['register'] = $isValid->row();
		}
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('contract', 'Contract', 'trim|required|xss_clean');
			$this->form_validation->set_rules('feature', 'Feature', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('map', 'Map', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('facebook', 'Facebook', 'trim|required|xss_clean');
			$this->form_validation->set_rules('instagram', 'Instagram', 'trim|required|xss_clean');
			$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email_verify', 'Email Verify', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				$updateData['email'] = $this->db->escape_str($this->input->post('email'));
				$updateData['password'] = $this->db->escape_str($this->input->post('password'));
				$updateData['category'] = $this->db->escape_str($this->input->post('category'));
				$updateData['title'] = $this->db->escape_str($this->input->post('title'));
				$updateData['contract'] = $this->db->escape_str($this->input->post('contract'));
				$updateData['feature'] = $this->db->escape_str($this->input->post('feature'));
				$updateData['address'] = $this->db->escape_str($this->input->post('address'));
				$updateData['map'] = $this->db->escape_str($this->input->post('map'));
				$updateData['phone'] = $this->db->escape_str($this->input->post('phone'));
				$updateData['facebook'] = $this->db->escape_str($this->input->post('facebook'));
				$updateData['instagram'] = $this->db->escape_str($this->input->post('instagram'));
				$updateData['website'] = $this->db->escape_str($this->input->post('website'));
				$updateData['email_verification'] = $this->db->escape_str($this->input->post('email_verify'));
				$updateData['status'] = $this->db->escape_str($this->input->post('status'));
				$updateData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$updateData['created_on'] = date("Y-m-d h:i:sa");

				$image = $_FILES['logo_file']['name'];
				if($image!="") 
				{
					$uploadimage=cdn_file_upload($_FILES["logo_file"],'uploads/admin');

					if($uploadimage)
					{
						$image=$uploadimage['secure_url'];
					}
					else
					{
						$this->session->set_flashdata('error','Problem with your image');
						front_redirect('classifieds_admin/edit_reg/' . $id, 'refresh');
					}
				} 
				else 
				{ 
					$image=$this->input->post('oldimage'); 
				}
				$insertData['logo'] = $image;
				// $category = $this->input->post('category');

				$details = $this->common_model->getTableData('company_registration',array('id'=>$id),'','','','');
				if($details->row('id')==$id)
				{
					$condition = array('id' => $id);
					$update = $this->common_model->updateTableData('company_registration', $condition, $updateData);
					if($update){
						$this->session->set_flashdata('success','Data Updated Successfully');
						front_redirect('classifieds_admin/registration', 'refresh');
					}else{
						$this->session->set_flashdata('error', 'hiiiUnable to update the data !');
						admin_redirect('registration/edit_reg/' . $id);
					}
				}else{
						$this->session->set_flashdata('error', 'hi2Unable to update the data !');
						admin_redirect('registration/edit_reg/' . $id);
					}
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/registration/edit_reg/' . $id, 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/registration/edit_reg/' . $id;
		$this->load->view('admin/registration/edit_registration', $data);

	}
	function status_reg($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('registration');
		}
		$isValid = $this->common_model->getTableData('company_registration', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['approve_status'] = $status;
			$update = $this->common_model->updateTableData('company_registration', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Registration Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Registration disabled successfully');
				}
				admin_redirect('registration');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Registration status updation');
				admin_redirect('registration');	
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Registration');
			admin_redirect('registration');
		}
	}

	function add_cat(){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$insertData['title'] = $this->db->escape_str($this->input->post('title'));				
				$insertData['status'] = $this->db->escape_str($this->input->post('status'));
				$insertData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$insertData['created_on'] = date("Y-m-d h:i:sa");
				$insertData['approve_status'] = '1';

				$image = $_FILES['image']['name'];
				if($image!="") 
				{
					$uploadimage=cdn_file_upload($_FILES["image"],'uploads/admin');

					if($uploadimage)
					{
						$image=$uploadimage['secure_url'];
					}
					else
					{
						$this->session->set_flashdata('error','Problem with your image');
						front_redirect('classifieds_admin/registration/add_cat', 'refresh');
					}
				} 
				else 
				{ 
					$image=""; 
				}
				$insertData['image'] = $image;
				$title = $this->input->post('title');

				$details = $this->db->query("SELECT * FROM `classifieds_category` WHERE `title` = '".$title."'");
				if($details->num_rows()==0)
				{
					$insert = $this->common_model->insertTableData('category', $insertData);
					if($insert){
						$this->session->set_flashdata('success','Data Added Successfully');
						front_redirect('classifieds_admin/registration/view_cat', 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Unable to add the data !');
						admin_redirect('registration/add_cat');
					}
				}else{
						$this->session->set_flashdata('error', 'Already this category is available.Please edit');
						admin_redirect('registration/add_cat');
					}
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/registration/add_cat', 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/registration/add_cat';
		$this->load->view('admin/category/add_category', $data);
	}
	function view_cat(){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['category'] = $this->common_model->getTableData('category', array('status'=>'1'), '', '', '', '', '', '', array('id', 'DESC'))->result();
		// print_r($data['register']);exit();
		$this->load->view('admin/category/category',$data);
	}
	function status_cat($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('registration/view_cat');
		}
		$isValid = $this->common_model->getTableData('category', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['approve_status'] = $status;
			$update = $this->common_model->updateTableData('category', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Category Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Category disabled successfully');
				}
				admin_redirect('registration/view_cat');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Category status updation');
				admin_redirect('registration/view_cat');	
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Category');
			admin_redirect('registration/view_cat');
		}
	}
	function edit_cat($id){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Is valid
		if ($id == '') {
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('registration/view_cat');
		}
		$isValid = $this->common_model->getTableData('category', array('id' => $id));
		if ($isValid->num_rows() == 0) {
			$this->session->set_flashdata('error', 'Unable to find this page');
			admin_redirect('registration/view_cat');
		}
		else
		{
			$data['category'] = $isValid->row();
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$updateData['title'] = $this->db->escape_str($this->input->post('title'));				
				$updateData['status'] = $this->db->escape_str($this->input->post('status'));
				$updateData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$updateData['created_on'] = date("Y-m-d h:i:sa");

				$image = $_FILES['image']['name'];
				if($image!="") 
				{
					$uploadimage=cdn_file_upload($_FILES["image"],'uploads/admin');

					if($uploadimage)
					{
						$image=$uploadimage['secure_url'];
					}
					else
					{
						$this->session->set_flashdata('error','Problem with your image');
						front_redirect('classifieds_admin/edit_cat/' . $id, 'refresh');
					}
				} 
				else 
				{ 
					$image=$this->input->post('oldimage'); 
				}
				$updateData['image'] = $image;
				// $category = $this->input->post('category');

				$details = $this->common_model->getTableData('category',array('id'=>$id),'','','','');
				if($details->row('id')==$id)
				{
					$condition = array('id' => $id);
					$update = $this->common_model->updateTableData('category', $condition, $updateData);
					if($update){
						$this->session->set_flashdata('success','Data Updated Successfully');
						front_redirect('classifieds_admin/registration/view_cat', 'refresh');
					}else{
						$this->session->set_flashdata('error', 'hiiiUnable to update the data !');
						admin_redirect('registration/edit_cat/' . $id);
					}
				}else{
						$this->session->set_flashdata('error', 'hi2Unable to update the data !');
						admin_redirect('registration/edit_cat/' . $id);
					}
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/registration/edit_cat/' . $id, 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/registration/edit_cat/' . $id;
		$this->load->view('admin/category/edit_category', $data);

	}

	function add_sub_cat(){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('category', 'category', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$insertData['title'] = $this->db->escape_str($this->input->post('title'));				
				$insertData['status'] = $this->db->escape_str($this->input->post('status'));
				$insertData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$insertData['created_on'] = date("Y-m-d h:i:sa");
				$insertData['approve_status'] = '1';
				$insertData['category_id'] = $this->db->escape_str($this->input->post('category'));

				$image = $_FILES['image']['name'];
				if($image!="") 
				{
					$uploadimage=cdn_file_upload($_FILES["image"],'uploads/admin');

					if($uploadimage)
					{
						$image=$uploadimage['secure_url'];
					}
					else
					{
						$this->session->set_flashdata('error','Problem with your image');
						front_redirect('classifieds_admin/registration/add_sub_cat', 'refresh');
					}
				} 
				else 
				{ 
					$image=""; 
				}
				$insertData['image'] = $image;
				$title = $this->input->post('title');

				$details = $this->db->query("SELECT * FROM `classifieds_sub_category` WHERE `title` = '".$title."'");
				if($details->num_rows()==0)
				{
					$insert = $this->common_model->insertTableData('sub_category', $insertData);
					if($insert){
						$this->session->set_flashdata('success','Data Added Successfully');
						front_redirect('classifieds_admin/registration/view_sub_cat', 'refresh');
					}else{
						$this->session->set_flashdata('error', 'Unable to add the data !');
						admin_redirect('registration/add_sub_cat');
					}
				}else{
						$this->session->set_flashdata('error', 'Already this category is available.Please edit');
						admin_redirect('registration/add_sub_cat');
					}
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/registration/add_sub_cat', 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/registration/add_sub_cat';
		$data['category'] = $this->common_model->getTableData('category', array('status'=>'1'), '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/sub_category/add_sub_category', $data);
	}
	function view_sub_cat(){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['sub_category'] = $this->common_model->getTableData('sub_category', array('status'=>'1'), '', '', '', '', '', '', array('id', 'DESC'))->result();
		// print_r($data['register']);exit();
		$this->load->view('admin/sub_category/sub_category',$data);
	}
	function edit_sub_cat($id){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Is valid
		if ($id == '') {
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('registration/view_sub_cat');
		}
		$isValid = $this->common_model->getTableData('sub_category', array('id' => $id));
		if ($isValid->num_rows() == 0) {
			$this->session->set_flashdata('error', 'Unable to find this page');
			admin_redirect('registration/view_sub_cat');
		}
		else
		{
			$data['sub_category'] = $isValid->row();
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			// $this->form_validation->set_rules('category', 'category', 'trim|required|xss_clean');

			if ($this->form_validation->run())
			{
				
				$updateData['title'] = $this->db->escape_str($this->input->post('title'));				
				$updateData['status'] = $this->db->escape_str($this->input->post('status'));
				$updateData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$updateData['created_on'] = date("Y-m-d h:i:sa");
				// $updateData['category_id'] = $this->db->escape_str($this->input->post('category'));

				$image = $_FILES['image']['name'];
				if($image!="") 
				{
					$uploadimage=cdn_file_upload($_FILES["image"],'uploads/admin');

					if($uploadimage)
					{
						$image=$uploadimage['secure_url'];
					}
					else
					{
						$this->session->set_flashdata('error','Problem with your image');
						front_redirect('classifieds_admin/edit_sub_cat/' . $id, 'refresh');
					}
				} 
				else 
				{ 
					$image=$this->input->post('oldimage'); 
				}
				$updateData['image'] = $image;
				// $category = $this->input->post('category');

				$details = $this->common_model->getTableData('sub_category',array('id'=>$id),'','','','');
				if($details->row('id')==$id)
				{
					$condition = array('id' => $id);
					$update = $this->common_model->updateTableData('sub_category', $condition, $updateData);
					if($update){
						$this->session->set_flashdata('success','Data Updated Successfully');
						front_redirect('classifieds_admin/registration/view_sub_cat', 'refresh');
					}else{
						$this->session->set_flashdata('error', 'hiiiUnable to update the data !');
						admin_redirect('registration/edit_sub_cat/' . $id);
					}
				}else{
						$this->session->set_flashdata('error', 'hi2Unable to update the data !');
						admin_redirect('registration/edit_sub_cat/' . $id);
					}
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/registration/edit_sub_cat/' . $id, 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/registration/edit_sub_cat/' . $id;
		$data['category'] = $this->common_model->getTableData('category', array('status'=>'1'), '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/sub_category/edit_sub_category', $data);

	}
	function status_sub_cat($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('registration/view_sub_cat');
		}
		$isValid = $this->common_model->getTableData('sub_category', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['approve_status'] = $status;
			$update = $this->common_model->updateTableData('sub_category', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Sub Category Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Sub Category disabled successfully');
				}
				admin_redirect('registration/view_sub_cat');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Category status updation');
				admin_redirect('registration/view_sub_cat');	
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Sub Category');
			admin_redirect('registration/view_sub_cat');
		}
	}
}