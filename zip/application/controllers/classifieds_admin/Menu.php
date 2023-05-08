<?php
class Menu extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library(array('form_validation'));
		$this->load->library('session');
		$this->load->helper(array('url', 'language'));
	}

	function index()
	{
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['menu'] = $this->common_model->getTableData('menu', '', '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/menu/menu',$data);
	}


		function sub_menu()
	{
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['menu'] = $this->common_model->getTableData('sub_menu', '', '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/menu/sub_menu',$data);
	}



	function add_menu($id=''){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('cat_menu', 'Cat Menu', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('menu', 'Menu', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$insertData['cat_menu'] = $this->db->escape_str($this->input->post('cat_menu'));				
				$insertData['menu'] = $this->db->escape_str($this->input->post('menu'));
				$insertData['status'] =  $this->db->escape_str($this->input->post('status'));

				$image = $_FILES['image']['name'];

				if(getExtension($_FILES['image']['type']))
					{

				if($image!="") 
				{


					$config['upload_path'] = './uploads/admin';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = 2048000;
					$config['max_width'] = 1024;
					$config['max_height'] = 1024;
					$config['file_name']   = time();
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('image')) 
					{
					    $error = $this->upload->display_errors();
					    $this->session->set_flashdata('error', $error);
						front_redirect('classifieds_admin/menu/add_menu', 'refresh');//coding...

					}
					else 
					{
					    $filename = $this->upload->data();
					    $image= base_url().'uploads/admin/'.$filename['file_name'];
					}



				} 
				else 
				{ 
					$image=""; 
				}
			}	

				$insertData['image'] = $image;
				$menu = $this->input->post('menu');

				$details = $this->db->query("SELECT * FROM `classifieds_menu` WHERE `menu` = '".$menu."'")->row();
				if(isset($details))
				{
					$this->session->set_flashdata('error', 'Already this Menu is available.Please Change the Menu name');
						admin_redirect('menu/add_menu');	
				}
				else
				{
					$exist_id = $this->db->escape_str($this->input->post('exist_id'));

					$reco_check = $this->common_model->getTableData('menu', array('id' => $exist_id))->row();
					if(isset($reco_check))
					{
							$condition = array('id' => $exist_id);
							$update = $this->common_model->updateTableData('menu', $condition, $insertData);
							if($update){
								$this->session->set_flashdata('success','Menu Data Updated Successfully');
								front_redirect('classifieds_admin/menu', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to update the data !');
								front_redirect('classifieds_admin/menu', 'refresh');
							}

					}
					else
					{
							$insert = $this->common_model->insertTableData('menu', $insertData);
							if($insert){
								$this->session->set_flashdata('success','Menu Data Added Successfully');
								front_redirect('classifieds_admin/menu', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to add the data !');
								admin_redirect('menu/add_menu');
							}
					}

				}


					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/menu/add_menu', 'refresh');
			}
		}
		if($id!='')
		{
			$isValid = $this->common_model->getTableData('menu', array('id' => $id));
			if ($isValid->num_rows() > 0) {
				$data['menu_rec'] = $isValid->row();
			}
		}

		$data['action'] = front_url() . 'classifieds_admin/menu/add_menu';
		$this->load->view('admin/menu/add_menu', $data);
	}



	function status_change($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('menu');
		}
		$isValid = $this->common_model->getTableData('menu', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['status'] = $status;
			$update = $this->common_model->updateTableData('menu', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Menu Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Menu disabled successfully');
				}
				admin_redirect('menu');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Menu status updation');
				admin_redirect('menu');	
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Menu');
			admin_redirect('menu');
		}
	}



	function add_Submenu($id=''){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
            		
			$this->form_validation->set_rules('menu', 'Menu', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sub_menu', 'Sub Menu', 'trim|required|xss_clean');	
			
			if ($this->form_validation->run())
			{
				
								
				$insertData['menu'] = $this->db->escape_str($this->input->post('menu'));
				$insertData['sub_menu'] = $this->db->escape_str($this->input->post('sub_menu'));
				$insertData['status'] =  $this->db->escape_str($this->input->post('status'));

				$image = $_FILES['image']['name'];

				if(getExtension($_FILES['image']['type']))
					{

				if($image!="") 
				{


					$config['upload_path'] = './uploads/admin/submenu';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = 2048000;
					$config['max_width'] = 1024;
					$config['max_height'] = 1024;
					$config['file_name']   = time();
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('image')) 
					{
					    $error = $this->upload->display_errors();
					    $this->session->set_flashdata('error', $error);
						front_redirect('classifieds_admin/menu/add_Submenu', 'refresh');//coding...

					}
					else 
					{
					    $filename = $this->upload->data();
					    $image= base_url().'uploads/admin/submenu/'.$filename['file_name'];
					}



				} 
				else 
				{ 
					$image=""; 
				}
			}	

				$insertData['image'] = $image;
				$sub_menu = $this->input->post('sub_menu');

				$details = $this->db->query("SELECT * FROM `classifieds_sub_menu` WHERE `sub_menu` = '".$sub_menu."'")->row();
				if(isset($details))
				{
					$this->session->set_flashdata('error', 'Already this Menu is available.Please Change the Menu name');
						admin_redirect('menu/add_Submenu');	
				}
				else
				{
					$exist_id = $this->db->escape_str($this->input->post('exist_id'));

					$reco_check = $this->common_model->getTableData('sub_menu', array('id' => $exist_id))->row();
					if(isset($reco_check))
					{
							$condition = array('id' => $exist_id);
							$update = $this->common_model->updateTableData('sub_menu', $condition, $insertData);
							if($update){
								$this->session->set_flashdata('success','Menu Data Updated Successfully');
								admin_redirect('menu/sub_menu', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to update the data !');
								admin_redirect('menu/sub_menu', 'refresh');
							}

					}
					else
					{
							$insert = $this->common_model->insertTableData('sub_menu', $insertData);
							if($insert){
								$this->session->set_flashdata('success','Menu Data Added Successfully');
								admin_redirect('menu/sub_menu', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to add the data !');
								admin_redirect('menu/add_Submenu');
							}
					}

				}


					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/menu/add_Submenu', 'refresh');
			}
		}
		if($id!='')
		{
			$isValid = $this->common_model->getTableData('menu', array('id' => $id));
			if ($isValid->num_rows() > 0) {
				$data['menu_rec'] = $isValid->row();
			}
		}
		$data['menus'] = $this->common_model->getTableData('menu', array('status' => 1))->result();
		$data['action'] = front_url() . 'classifieds_admin/menu/add_Submenu';
		$this->load->view('admin/menu/add_Submenu', $data);
	}


	function submenu_status_change($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('menu/sub_menu');
		}
		$isValid = $this->common_model->getTableData('sub_menu', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['status'] = $status;
			$update = $this->common_model->updateTableData('sub_menu', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Sub Menu Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Sub Menu disabled successfully');
				}
				admin_redirect('menu/sub_menu');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Menu status updation');
				admin_redirect('menu/sub_menu');
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Menu');
			admin_redirect('menu/sub_menu');
		}
	}




// City Module Start


		function city()
	{
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['all_city'] = $this->common_model->getTableData('city', '', '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/menu/city',$data);
	}

	function city_status_change($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('menu/city');
		}
		$isValid = $this->common_model->getTableData('city', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['status'] = $status;
			$update = $this->common_model->updateTableData('city', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'City Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'City disabled successfully');
				}
				admin_redirect('menu/city');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Menu status updation');
				admin_redirect('menu/city');
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Menu');
			admin_redirect('menu/city');
		}
	}


	function add_city($id=''){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('arabic_title', 'Arabic Title', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$insertData['city_name'] = $this->db->escape_str($this->input->post('city_name'));				
				$insertData['arabic_title'] = $this->db->escape_str($this->input->post('arabic_title'));
				$insertData['status'] =  $this->db->escape_str($this->input->post('status'));

				$image = $_FILES['image']['name'];

				if(getExtension($_FILES['image']['type']))
					{

				if($image!="") 
				{


					$config['upload_path'] = './uploads/admin/city';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = 2048000;
					$config['max_width'] = 1024;
					$config['max_height'] = 1024;
					$config['file_name']   = time();
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('image')) 
					{
					    $error = $this->upload->display_errors();
					    $this->session->set_flashdata('error', $error);
						front_redirect('classifieds_admin/menu/add_city', 'refresh');//coding...

					}
					else 
					{
					    $filename = $this->upload->data();
					    $image= base_url().'uploads/admin/city/'.$filename['file_name'];
					}



				} 
				else 
				{ 
					$image=""; 
				}
			}	

				$insertData['image'] = $image;
				$city_name = $this->input->post('city_name');

				$details = $this->db->query("SELECT * FROM `classifieds_city` WHERE `city_name` = '".$city_name."'")->row();
				if(isset($details))
				{
					$this->session->set_flashdata('error', 'Already this City is available.Please Change the City name');
						admin_redirect('menu/add_city');	
				}
				else
				{
					$exist_id = $this->db->escape_str($this->input->post('exist_id'));

					$reco_check = $this->common_model->getTableData('city', array('id' => $exist_id))->row();
					if(isset($reco_check))
					{
							$condition = array('id' => $exist_id);
							$update = $this->common_model->updateTableData('city', $condition, $insertData);
							if($update){
								$this->session->set_flashdata('success','City Data Updated Successfully');
								front_redirect('classifieds_admin/city', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to update the data !');
								front_redirect('classifieds_admin/city', 'refresh');
							}

					}
					else
					{
							$insert = $this->common_model->insertTableData('city', $insertData);
							if($insert){
								$this->session->set_flashdata('success','City Data Added Successfully');
								front_redirect('classifieds_admin/city', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to add the data !');
								admin_redirect('menu/add_city');
							}
					}

				}


					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/menu/add_city', 'refresh');
			}
		}
		if($id!='')
		{
			$isValid = $this->common_model->getTableData('city', array('id' => $id));
			if ($isValid->num_rows() > 0) {
				$data['city_rec'] = $isValid->row();
			}
		}

		$data['action'] = front_url() . 'classifieds_admin/menu/add_city';
		$this->load->view('admin/menu/add_city', $data);
	}



// City Module End


}