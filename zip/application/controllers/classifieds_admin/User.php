<?php
class User extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library(array('form_validation'));
		$this->load->library('session');
		$this->load->helper(array('url', 'language'));
	}

	public function index()
	{
		$this->load->view('admin/register');
		// echo "hi";
	}
	function signup(){
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('register_email', 'Email Address', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('register_password', 'Password', 'trim|required|xss_clean');
			if ($this->form_validation->run())
			{
				$email = $this->db->escape_str($this->input->post('register_email'));
				$password = $this->db->escape_str($this->input->post('register_password'));
				$user_name = $this->db->escape_str($this->input->post('username'));
				$check=checkAdminEmail($email);
				$prefix=get_prefix();
				if($check)
				{
					$this->session->set_flashdata('error', 'Entered Email Address Already Exists');
					front_redirect('classifieds_admin/user/signup', 'refresh');
				}else{
					$insert = $this->common_model->insertTableData('admin', array('admin_name'=>$user_name, 'email_id'=>$email, 'password'=>$password, 'status'=>"1",'created_date'=>date("Y-m-d h:i:sa")));
					if($insert){
						$this->session->set_flashdata('success','Signup Successfully');
						front_redirect('classifieds_admin/user/login', 'refresh');
					}
				}
			}else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/user/signup', 'refresh');
			}
		}
		$data['action'] = front_url() . 'classifieds_admin/user/signup';
		$this->load->view('admin/register', $data);
	}
	function email_exist()
	{
		$email = $this->db->escape_str($this->input->get_post('email'));
		$check=checkAdminEmail($email);
		if (!$check)
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	function login(){
		$this->form_validation->set_rules('login_detail', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('login_password', 'Password', 'trim|required|xss_clean');
        if ($this->input->post()) {
        	// print_r($this->input->post());exit();
            if ($this->form_validation->run()) {

                $email = $this->input->post('login_detail');
                $password = $this->input->post('login_password');
                $prefix = get_prefix();
                // print_r($this->input->post());exit();
                $check = $this->common_model->getTableData('admin', array('email_id' => $email))->row();
                if($check){
                	$session_data = array('user_id' => $check->id,'email_id'=>$check->email_id);
                	$this->session->set_userdata($session_data);
                	// print_r($session_data);exit();
                	$this->session->set_flashdata('success','LoggedIn Successfully');
					front_redirect('classifieds_admin/user/dashboard', 'refresh');
                }
            }else{
				$this->session->set_flashdata('error', validation_errors());
				front_redirect('classifieds_admin/user/login', 'refresh');
			}
        }
		$data['action'] = front_url() . 'classifieds_admin/user/login';
		$this->load->view('admin/login',$data);
	}
	function dashboard(){
		$user_id=$this->session->userdata('user_id');
		// echo $user_id;exit();
		if($user_id=="")
		{	
			front_redirect('classifieds_admin/user/login', 'refresh');
		}
		$this->load->view('admin/dashboard');
	}
	function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('email_id');		
		$this->session->set_flashdata('success', 'Logged Out successfully');
		front_redirect('classifieds_admin/user/login','refresh');
	}
	

}