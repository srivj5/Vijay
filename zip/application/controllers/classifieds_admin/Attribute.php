<?php
class Attribute extends CI_Controller {
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
		$data['attribute'] = $this->common_model->getTableData('attribute', '', '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/attribute/attribute',$data);
	}


	function add_attribute($id=''){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
            $this->form_validation->set_rules('menu', 'Menu', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('attribute', 'Attribute', 'trim|required|xss_clean');
			$this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('required_status', 'Required status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$insertData['attribute'] = $this->db->escape_str($this->input->post('attribute'));				
				$insertData['menu'] = $this->db->escape_str($this->input->post('menu'));
				$insertData['type'] = $this->db->escape_str($this->input->post('type'));
				$insertData['required_status'] = $this->db->escape_str($this->input->post('required_status'));
				$insertData['status'] =  $this->db->escape_str($this->input->post('status'));

				$attribute = $this->input->post('attribute');

				$details = $this->db->query("SELECT * FROM `classifieds_attribute` WHERE `attribute` = '".$attribute."'")->row();
				if(isset($details))
				{
					$this->session->set_flashdata('error', 'Already this Attribute is available.Please Change the Attribute name');
						admin_redirect('attribute/add_attribute');	
				}
				else
				{
					$exist_id = $this->db->escape_str($this->input->post('exist_id'));

					$reco_check = $this->common_model->getTableData('attribute', array('id' => $exist_id))->row();
					if(isset($reco_check))
					{
							$condition = array('id' => $exist_id);
							$update = $this->common_model->updateTableData('attribute', $condition, $insertData);
							if($update){
								$this->session->set_flashdata('success','Attribute Data Updated Successfully');
								front_redirect('classifieds_admin/attribute', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to update the data !');
								front_redirect('classifieds_admin/attribute', 'refresh');
							}

					}
					else
					{
							$insert = $this->common_model->insertTableData('attribute', $insertData);
							if($insert){
								$this->session->set_flashdata('success','Attribute Data Added Successfully');
								front_redirect('classifieds_admin/attribute', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to add the data !');
								admin_redirect('attribute/add_attribute');
							}
					}

				}


					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/attribute/add_attribute', 'refresh');
			}
		}
		if($id!='')
		{
			$isValid = $this->common_model->getTableData('attribute', array('id' => $id));
			if ($isValid->num_rows() > 0) {
				$data['attribute_rec'] = $isValid->row();
			}
		}
		$data['menu'] = $this->common_model->getTableData('attribute', array('status' => 1))->result();
		$data['action'] = front_url() . 'classifieds_admin/attribute/add_attribute';
		$this->load->view('admin/attribute/add_attribute', $data);
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
			admin_redirect('attribute');
		}
		$isValid = $this->common_model->getTableData('attribute', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['status'] = $status;
			$update = $this->common_model->updateTableData('attribute', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Attribute Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Attribute disabled successfully');
				}
				admin_redirect('attribute');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Attribute status updation');
				admin_redirect('attribute');	
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Attribute');
			admin_redirect('attribute');
		}
	}



	// Attribute Value Start


		function attribute_value()
	{
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$data['attribute'] = $this->common_model->getTableData('attribute', '', '', '', '', '', '', '', array('id', 'DESC'))->result();
		$this->load->view('admin/attribute/attribute',$data);
	}


	function attribute_status_change($id,$status){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		// Check is valid data 
		if ($id == '' || $status == '') { 
			$this->session->set_flashdata('error', 'Invalid request');
			admin_redirect('attribute/attribute_value');
		}
		$isValid = $this->common_model->getTableData('attribute_value', array('id' => $id))->num_rows();
		if ($isValid > 0) { // Check is valid banner 
			$condition = array('id' => $id);
			$updateData['status'] = $status;
			$update = $this->common_model->updateTableData('attribute_value', $condition, $updateData);
			if ($update) { // True // Update success
				if ($status == 1) {
					$this->session->set_flashdata('success', 'Attribute Value Enabled successfully');
				} else {
					$this->session->set_flashdata('success', 'Attribute Value disabled successfully');
				}
				admin_redirect('attribute/attribute_value');
			} else { //False
				$this->session->set_flashdata('error', 'Problem occure with Attribute Value status updation');
				admin_redirect('attribute/attribute_value');	
			}
		} else {
			$this->session->set_flashdata('error', 'Unable to find this Attribute Value');
			admin_redirect('attribute/attribute_value');
		}
	}

	function add_attribute_value($id=''){
		$user_id=$this->session->userdata('user_id');
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('attribute', 'Attribute', 'trim|required|xss_clean');
			$this->form_validation->set_rules('attribute_value', 'Attribute', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run())
			{
				
				$insertData['attribute'] = $this->db->escape_str($this->input->post('attribute'));				
				$insertData['attribute_value'] = $this->db->escape_str($this->input->post('attribute_value'));
				$insertData['status'] =  $this->db->escape_str($this->input->post('status'));

				// $attribute = $this->input->post('attribute');

				// $details = $this->db->query("SELECT * FROM `classifieds_attribute` WHERE `attribute` = '".$attribute."'")->row();
				// if(isset($details))
				// {
				// 	$this->session->set_flashdata('error', 'Already this Attribute is available.Please Change the Attribute name');
				// 		admin_redirect('attribute/add_attribute_value');	
				// }
				// else
				// {
					$exist_id = $this->db->escape_str($this->input->post('exist_id'));

					$reco_check = $this->common_model->getTableData('attribute_value', array('id' => $exist_id))->row();
					if(isset($reco_check))
					{
							$condition = array('id' => $exist_id);
							$update = $this->common_model->updateTableData('attribute_value', $condition, $insertData);
							if($update){
								$this->session->set_flashdata('success','Attribute Values Data Updated Successfully');
								front_redirect('classifieds_admin/attribute_value', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to update the data !');
								front_redirect('classifieds_admin/attribute_value', 'refresh');
							}

					}
					else
					{
							$insert = $this->common_model->insertTableData('attribute_value', $insertData);
							if($insert){
								$this->session->set_flashdata('success','Attribute Values Data Added Successfully');
								front_redirect('classifieds_admin/attribute_value', 'refresh');
							}else{
								$this->session->set_flashdata('error', 'Unable to add the data !');
								admin_redirect('attribute/add_attribute_value');
							}
					}

				// }
					
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/attribute/add_attribute_value', 'refresh');
			}
		}
		if($id!='')
		{
			$isValid = $this->common_model->getTableData('attribute_value', array('id' => $id));
			if ($isValid->num_rows() > 0) {
				$data['attribute_rec'] = $isValid->row();
			}
		}
		$data['attributes'] = $this->common_model->getTableData('attribute', array('status' => 1))->result();
		$data['action'] = front_url() . 'classifieds_admin/attribute/add_attribute_value';
		$this->load->view('admin/attribute/add_attribute_value', $data);
	}


	// Attribute Value End



}	