<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    var $data;

    function __construct() {
        parent::__construct();
        
        $this->load->model('user_model');
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;

        // Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');

        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();

        // Load required js files for this controller
        $javascript_files = array(
            $this->router->class
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($javascript_files);

        //View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
        $this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
        $this->data['datatable']['dt_id']= array('heading'=>'Data Table','cols'=>array());
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/home');
		//$this->breadcrumbs->push('User', '/user/manage');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
		// Address Types
		$this->data['address_type'] = array('P'=>'Permanent Address','C'=>'Present Address');
		
		// DOB - DD MM YYYY drop down
        $this->data['day_arr'] = $this->calander_days();
        $this->data['month_arr'] = $this->calander_months();
        $this->data['year_arr'] = $this->calander_years();
		
		//User Roles drop down
		$this->data['arr_roles'] = $this->user_model->get_user_role_dropdown();
		$this->data['arr_designations'] = $this->user_model->get_designation_dropdown('Y');
		$this->data['arr_departments'] = $this->user_model->get_department_dropdown();
		$this->data['arr_user_title'] = array(''=>'Select Title','Mr.'=>'Mr.','Mrs.'=>'Mrs.','Dr.'=>'Dr.','Ms.'=>'Ms.');
        $this->data['blood_group'] = array(''=>'Select','O+'=>'O+','O-'=>'O-','A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-');
        $this->data['bank_ac_type'] = array('SB'=>'Savings','CU'=>'Current');
        $this->data['account_uses'] = array('SAL'=>'Salary Credit','REI'=>'Reimbursement');
        $this->data['arr_gender'] = array('M'=>'Male','F'=>'Female');

        $this->data['arr_upload_file_type_name'] = array(
            "" => "Select",
            "aadhar_card" => "Aadhar Card",
            "pan_card" => "PAN Card",
            "driving_license" => "Driving License",
            "voter_card" => "Voter Card",
            "medical_fit_certificate" => "Medical Fit Certificate",
            "school_certificate" => "School Certificate",
            "10_marksheet" => "10th Equivallent Mark Sheet",
            "10_certificate" => "10th Certificate",
            "12_marksheet" => "12th Equivallent Mark Sheet",
            "12_certificate" => "12th Certificate",
            "graduation_marksheet" => "Graduation Mark Sheet (Final Semistar)",
            "pg_marksheet" => "Post Graduation Marksheet (Final Semistar)",
            "work_exp_letter" => "Work Experience Letter",
            "permanent_addr_proof" => "Premanent Address Proof",
            "current_addr_proof" => "Current Address Proof",
        );
        ksort($this->data['arr_upload_file_type_name']);

        $this->data['char_doc_verification'] = array(
            'P'=>'Verification Pending',
            'N' => 'Not verified',
            'Y' =>'Verified',
            'R' => 'Document Rejected'
        );
    }

    function index() {
        $this->login();
    }

    function manage() {        
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));     
        
        //Download Data 
        if($this->input->post('form_action') == 'download'){
            $this->download_to_excel();
        }
        
		$this->breadcrumbs->push('View', '/');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		
		$this->data['page_heading'] = 'Manage Employees';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/manage', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function people() {        
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }               
		$this->breadcrumbs->push('People', '/');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $search_keywords = NULL;
        if($this->input->get_post('form_action') == 'search'){
            $search_keywords = $this->input->get_post('user_search_keywords');
        }
        //die($search_keywords);

		// Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->user_model->get_users(NULL, NULL, NULL, $search_keywords, 'U');
		$total_num_rows = $result_array['num_rows'];
		
		//pagination config
		$additional_segment = $this->router->class.'/'.$this->router->method;
		$per_page = 30;
		$config['uri_segment'] = 4;
		$config['num_links'] = 1;
		$config['use_page_numbers'] = TRUE;
		//$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : 0;
		$offset = ($page*$per_page);
		$this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page, $additional_segment);
		//end of pagination config
        

        // Data Rows - Refer to model method definition
        $result_array = $this->user_model->get_users(NULL, $per_page, $offset, $search_keywords, 'U');
        $this->data['data_rows'] = $result_array['data_rows'];
		
		$this->data['page_heading'] = 'People';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/people', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->user_model->get_rows(NULL, NULL, NULL, FALSE, TRUE, 'U');
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->user_model->get_rows(NULL, NULL, NULL, TRUE, FALSE, 'U');
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->user_model->get_rows(NULL, NULL, NULL, TRUE, TRUE, 'U');
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $html_name='';
            $status_indicator = 'text-secondary';            
            if($result['user_archived'] == 'Y'){
                $status_indicator = 'text-danger';
            }else{
                if($result['user_account_active'] == 'Y'){
                    $status_indicator = 'text-success';
                }
                if($result['user_account_active'] == 'N'){
                    $status_indicator = 'text-warning';
                }
            }
            $html_name.= $result['user_firstname'] . '&nbsp;' . $result['user_lastname'];
            //$html_name.= '<div> DOB : '.$this->common_lib->display_date($result['user_dob']).'</div>';
            //$html_name.= '<div> Gender : '.$result['user_gender'].'</div>';
            //$html_name.= '<div> Blood Gr : '.$result['user_blood_group'].'</div>';
            //$html_name.= '<div class="small"> Reg. On : '.$this->common_lib->display_date($result['user_registration_date'], true).'</div>';
            //$html_name.= '<div class="small"> Last Login : '.($result['user_login_date_time'] != NULL ? $this->common_lib->display_date($result['user_login_date_time'], true) : '').'</div>';
            //$html_name.= ($result['user_account_active'] == 'Y') ? '<span data-user-id="'.$result['id'].'" class="account-status badge badge-success">Active Account</span>' : '<span data-user-id="'.$result['id'].'" class="account-status badge badge-danger">Inactive Account</span>';
            $row[] = $html_name;           
            $row[] = $result['user_emp_id'];           
            $row[] = $result['designation_name'];           

            // $html_corp=''; 
            // $html_corp.= '<div class=""> Emp # : '.$result['user_emp_id'].'</div>';
            // $html_corp.= '<div> DOJ : '.($result['user_doj'] != NULL ? $this->common_lib->display_date($result['user_doj']) : '').'</div>';
            // $html_corp.= '<div class=""> Designation : '.$result['designation_name'].'</div>';
            // $html_corp.= '<div class=""> RBAC Group : '.$result['role_name'].'</div>';
            // $row[] = $html_corp;
            
            $row[] = '<span class="">'.$result['user_email'].'</span>';

            // $html_contact=''; 
            // $html_contact.= '<div class=""> Email (W) : '.$result['user_email'].'</div>';
            // $html_contact.= '<div> Mobile (P) : '.$result['user_phone1'].'</div>';
            // $html_contact.= '<div> Email (P) : '.$result['user_email_secondary'].'</div>';            
            // $html_contact.= '<div> Mobile (W) : '.$result['user_phone2'].'</div>';
            // $row[] = $html_contact;
            $row[] = $result['user_phone1'];
            $row[] = '<span class=""><i class="fa fa-circle '.$status_indicator.'" aria-hidden="true"></i></span>';

            //$row[] = ($result['user_account_active'] == 'Y') ? '<span data-user-id="'.$result['id'].'" class="account-status badge badge-success">Active</span>' : '<span data-user-id="'.$result['id'].'" class="account-status badge badge-danger">Inactive</span>';
            //add html for action
            $action_html = '';


            $acc_status_icon = ($result['user_account_active'] == 'Y') ? '' : '';
            $acc_status_text = ($result['user_account_active'] == 'Y') ? 'Deactivate' : 'Activate';
            $acc_status_class = ($result['user_account_active'] == 'Y') ? 'btn btn-sm btn-outline-danger' : 'btn btn-sm btn-outline-success';
            $acc_status_set = ($result['user_account_active'] == 'Y') ? 'N' : 'Y';
            
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/profile/' . $result['id']), '<i class="fa fa-info" aria-hidden="true"></i> Details', array(
                'class' => 'btn btn-sm btn-outline-secondary mr-1',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'View Profile',
                'title' => 'View Profile'
                
            ));
            if($result['user_archived'] != 'Y'){
                $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_user_profile/' . $result['id']), '<i class="fa fa-edit" aria-hidden="true"></i> Edit', array(
                    'class' => 'btn btn-sm btn-outline-secondary mr-1',
                    'data-toggle' => 'tooltip',
                    'data-original-title' => 'Edit Profile',
                    'title' => 'Edit Profile'
                ));
            }
            
			/*$action_html.= anchor(base_url($this->router->directory.$this->router->class.'/manage'), $acc_status_text, array(
                'class' => 'change_account_status ' . $acc_status_class,
                'data-toggle' => 'tooltip',
                'data-original-title' => $acc_status_text,
                'title' => $acc_status_text,
                'data-status' => $acc_status_set,
                'data-id' => $result['id'],
            ));
            /* $action_html.='&nbsp;';
              $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), 'Delete', array(
              'class' => 'btn btn-sm btn-danger btn-delete',
			  'data-confirmation'=>true,
			  'data-confirmation-message'=>'Are you sure, you want to delete this?',
              'data-toggle' => 'tooltip',
              'data-original-title' => 'Delete',
              'title' => 'Delete',
              )); */

            $row[] = $action_html;
            $data[] = $row;
        }

        /* jQuery Data Table JSON format */
        $output = array(
            'draw' => isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '',
            'recordsTotal' => $total_rows,
            'recordsFiltered' => $total_filtered,
            'data' => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function login() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == TRUE) {
            redirect($this->router->directory.'home');
        }
        ########### Validate User Auth End #############
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'login') {
            if ($this->validate_login_form_data() == true) {
                $email = $this->input->post('user_email');
                $password = md5($this->input->post('user_password'));
                $login_result = $this->user_model->authenticate_user($email, $password);
                //print_r($login_result);
                //die();
                if (isset($login_result)) {
                    $login_status = $login_result['status'];
                    $message = $login_result['message'];
                    $login_data = $login_result['data'];
                    if ($login_status == 'error') {
                        $this->session->set_flashdata('flash_message', $message);
                        $this->session->set_flashdata('flash_message_css', 'alert-danger');
                        redirect(current_url());
                    }
                    if ($login_status == 'success') {
                        $this->session->set_userdata('sess_user', $login_data);
                        if($this->session->userdata('sess_post_login_redirect_url')){
                            redirect($this->session->userdata('sess_post_login_redirect_url'));
                        }else{
                            redirect($this->router->directory.'home');
                        }
                        
                    }
                }
            }
        }
		$this->data['page_heading'] = 'Please sign in';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/login', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

    function home() {
        $this->profile();
    }

    function auth_error() {        
		$this->data['page_heading'] = 'Authorization Error Occured';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/auth_error', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

    function validate_login_form_data() {
        $this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_password', 'password', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function create_account() {
		########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));
        ########### Validate User Auth End #############
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'create_account') {
            if ($this->validate_create_account_form_data() == true) {
                //$activation_token = md5(time('Y-m-d h:i:s'));
                $activation_token = $this->common_lib->generate_rand_id(6, FALSE);
                $dob = $this->input->post('dob_year') . '-' . $this->input->post('dob_month') . '-' . $this->input->post('dob_day');
				$user_emp_id = $this->user_model->get_new_emp_id();
				$password = $this->common_lib->generate_rand_id();
                $postdata = array(
                    'user_title' => $this->input->post('user_title'),
                    'user_firstname' => ucwords(strtolower($this->input->post('user_firstname'))),
                    'user_lastname' => ucwords(strtolower($this->input->post('user_lastname'))),
                    'user_gender' => $this->input->post('user_gender'),
                    'user_email' => strtolower($this->input->post('user_email')),
                    'user_email_secondary' => strtolower($this->input->post('user_email_secondary')),
                    'user_dob' => $dob,
                    'user_doj' => $this->common_lib->convert_to_mysql($this->input->post('user_doj')),
                    'user_role' => $this->input->post('user_role'),
                    'user_department' => $this->input->post('user_department'),
                    'user_designation' => $this->input->post('user_designation'),
                    'user_phone1' => $this->input->post('user_phone1'),
                    'user_phone2' => $this->input->post('user_phone2'),
                    'user_password' => md5($password),
                    'user_activation_key' => md5($activation_token),
                    'user_registration_ip' => $_SERVER['REMOTE_ADDR'],
                    'user_account_active' => 'N',
                    'user_registration_date' => date('Y-m-d H:i:s'),
                    'user_emp_id' => $user_emp_id
                );
				//print_r($postdata); die();
                $insert_id = $this->user_model->insert($postdata);
                if ($insert_id) {
                    $message_html = '';
                    $message_html.='<div id="message_wrapper" style="border-top: 2px solid #5133AB;">';
                    $message_html.= $this->config->item('app_email_header');
                    $message_html.='<div id="message_body" style="padding-top: 5px; padding-bottom:5px;">';
                    $message_html.='<h4>Hi '. ucwords(strtolower($this->input->post('user_firstname'))).' '.ucwords(strtolower($this->input->post('user_lasttname'))) .' ,</h4>';
                    $message_html.='<p>Welcome to United Exploration India Pvt. Ltd. employee portal. Please activate your account to login.</p>';
                    //$message_html.='<p>'.anchor(base_url($this->router->class.'/activate_account/'.$insert_id.'/'.$activation_token)).'</p>';
                    $message_html.='<p>Employee Portal Details:</p>';
                    $message_html.='<p>Employee Portal URL : '.anchor(base_url()).' <br> Username/Email : '.strtolower($this->input->post('user_email')).'<br> Login Password : '. $password .' <br> Activation OTP: '.$activation_token.'</p>';
                    $message_html.='</div><!--/#message_body-->';
                    $message_html.= $this->config->item('app_email_footer');
                    $message_html.='</div><!--/#message_wrapper-->';
                    //echo $message_html; die();
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->to($this->input->post('user_email'));
                    $this->email->from($this->config->item('app_admin_email'), $this->config->item('app_admin_email_name'));
                    $this->email->subject('Welcome to United Exploration India Pvt Ltd - Your Employee Portal Account Details');
                    $this->email->message($message_html);
                    $this->email->send();
                    //echo $this->email->print_debugger();
                    $this->session->set_flashdata('flash_message', 'You have added employee successfully. System generated Emp ID <span class="font-weight-bold h5">'.$user_emp_id.'</span>.<br> Account activation OTP has been sent to <span class="font-weight-bold">'.$postdata['user_email'].'</span><br> Employee need to  activate employee portal account before first time login.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
		$this->data['page_heading'] = "Add New Employee";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/create_account', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_create_account_form_data() {
        $this->form_validation->set_rules('user_title', 'title', 'required');
        $this->form_validation->set_rules('user_firstname', 'first name', 'required|alpha|min_length[3]|max_length[25]');
        $this->form_validation->set_rules('user_lastname', 'last name', 'required|alpha_numeric_spaces|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('user_gender', 'gender selection', 'required');
        $this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email|callback_valid_email_domain|callback_is_email_registered');
        $this->form_validation->set_rules('user_email_secondary', 'personal email', 'valid_email|differs[user_email]');
        //$this->form_validation->set_rules('user_password', 'password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('user_phone1', 'mobile (personal)', 'required|trim|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('user_phone2', 'mobile (work)', 'trim|min_length[10]|max_length[10]|numeric|differs[user_phone1]');
        //$this->form_validation->set_rules('user_password_confirm', 'confirm password', 'required|matches[user_password]');
        $this->form_validation->set_rules('dob_day', 'birth day selection', 'required');
        $this->form_validation->set_rules('dob_month', 'birth month selection', 'required');
        $this->form_validation->set_rules('dob_year', 'birth year selection', 'required');
        //$this->form_validation->set_rules('user_dob', 'date of birth', 'required');
        //$this->form_validation->set_rules('user_doj', 'date of joining', 'required');
        $this->form_validation->set_rules('user_role', 'access group', 'required');
        //$this->form_validation->set_rules('user_designation', 'designation', 'required');
        //$this->form_validation->set_rules('user_department', 'department', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function registration_x() {		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'self_registration') {
            if ($this->validate_registration_form_data() == true) {
                $activation_token = md5(time('Y-m-d h:i:s'));
                $dob = $this->input->post('dob_year') . '-' . $this->input->post('dob_month') . '-' . $this->input->post('dob_day');
				$user_emp_id = $this->user_model->get_new_emp_id();				
                $postdata = array(
                    'user_title' => $this->input->post('user_title'),                    
                    'user_firstname' => ucwords(strtolower($this->input->post('user_firstname'))),                   
                    'user_lastname' => ucwords(strtolower($this->input->post('user_lastname'))),
                    'user_gender' => $this->input->post('user_gender'),
                    'user_email' => strtolower($this->input->post('user_email')),
					'user_role' => $this->input->post('user_role'),
                    'user_email_secondary' => strtolower($this->input->post('user_email_secondary')),
                    'user_dob' => $dob,
					'user_phone1' => $this->input->post('user_phone1'),                    
                    'user_password' => md5($this->input->post('user_password')),
                    'user_activation_key' => $activation_token,
                    'user_registration_ip' => $_SERVER['REMOTE_ADDR'],
                    'user_account_active' => 'N',
                    'user_registration_date' => date('Y-m-d H:i:s'),
                    'user_emp_id' => $user_emp_id
                );
				//print_r($postdata); die();
                $insert_id = $this->user_model->insert($postdata);
                if ($insert_id) {
                    $message_html = '';
                    $message_html.='<div id="message_wrapper" style="font-family:Arial, Helvetica, sans-serif; border: 3px solid #5133AB; border-left:0px; border-right: 0px; font-size:13px;">';
                    $message_html.='<div id="message_header" style="display:none;background-color:#5133AB; padding: 10px;"></div>';
                    $message_html.='<div id="message_body" style="padding: 10px;">';
                    $message_html.='<h4>Hi '. ucwords(strtolower($this->input->post('user_firstname'))).' '.ucwords(strtolower($this->input->post('user_lasttname'))) .' ,</h4>';
                    $message_html.='<p>Welcome to United Exploration India Pvt Ltd Employee Portal. Your have been successfully registered. Please click on the below link to activate your account. Once your account is activated you will be able to login.</p>';
                    $message_html.='<p>'.anchor(base_url($this->router->class.'/activate_account/'.$insert_id.'/'.$activation_token),NULL).'</p>';
                    $message_html.='<p>Here is your details -</p>';
                    $message_html.='<p>Portal URL : '.anchor(base_url()).' <br> Username/Email : '.strtolower($this->input->post('user_email')).'<br> Password : '.$this->input->post('user_password').'</p>';
                    $message_html.='</div><!--/#message_body-->';
                    $message_html.='<div id="message_footer" style="padding: 10px; font-size: 11px;">';
                    $message_html.='<p>* Please do not reply.</p>';
                    $message_html.='</div><!--/#message_footer-->';
                    $message_html.='</div><!--/#message_wrapper-->';
                    //echo $message_html; die();
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->to($this->input->post('user_email'));
                    $this->email->from($this->config->item('app_admin_email'), $this->config->item('app_admin_email_name'));
                    $this->email->subject('Welcome to '.$this->config->item('app_email_subject_prefix') . 'Your Account Details');
                    $this->email->message($message_html);
                    $this->email->send();
                    //echo $this->email->print_debugger();
                    $this->session->set_flashdata('flash_message', 'Your account has been created successfully.<br>Your System generated Employee ID is <span class="font-weight-bold h5">'.$user_emp_id.'</span>. <br>You will receive account activation link in your registered email. Please activate your account to login.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
		$this->data['page_heading'] = "Create Employee Portal Account";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/registration', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

    function validate_registration_form_data() {
        $this->form_validation->set_rules('user_title', 'title', 'required');
        $this->form_validation->set_rules('user_firstname', 'first name', 'required|alpha|min_length[3]|max_length[25]');
        $this->form_validation->set_rules('user_lastname', 'last name', 'required|alpha_numeric_spaces|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('user_gender', 'gender selection', 'required');
        $this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email|callback_valid_email_domain|callback_is_email_registered');        
        $this->form_validation->set_rules('user_password', 'password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('user_phone1', 'mobile number', 'required|trim|min_length[10]|max_length[10]|numeric');        
        $this->form_validation->set_rules('user_password_confirm', 'confirm password', 'required|matches[user_password]');
        $this->form_validation->set_rules('dob_day', 'birth day selection', 'required');
        $this->form_validation->set_rules('dob_month', 'birth month selection', 'required');
        $this->form_validation->set_rules('dob_year', 'birth year selection', 'required');
        //$this->form_validation->set_rules('user_dob', 'date of birth', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function valid_email_domain($str){
		if($str){
			if(stristr($str,'@unitedexploration.co.in') !== false){
				return true;
			}else{
				$this->form_validation->set_message('valid_email_domain', 'Please provide an acceptable email address.');
				return false;
			}
		}
	}
	
    function is_email_registered($user_email, $action_type = NULL) {
        //echo $user_email;die();
        $result = $this->user_model->check_is_email_registered($user_email);
        if ($result) {
            $this->form_validation->set_message('is_email_registered', $user_email . ' is already registered !');
            if ($action_type == 'forgot_password') {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    function activate_account() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        if ($this->input->post('form_action') == 'activate_account') {
            if ($this->validate_activate_account_form() == true) {
                $user_id = $this->input->post('user_email');
                $activation_key = $this->input->post('activation_otp');
                $found = $this->user_model->check_user_activation_key($user_id, $activation_key);
                if ($found) {
                    $postdata = array(
                        'user_account_active' => 'Y',
                        'user_activation_key' => NULL
                    );
                    $where = array('user_email' => $user_id, 'user_activation_key' => $activation_key);
                    $act_res = $this->user_model->update($postdata, $where);
                    if ($act_res) {
                        $this->session->set_flashdata('flash_message', 'Account has been activated successfully.');
                        $this->session->set_flashdata('flash_message_css', 'alert-success');
                        redirect($this->router->directory.$this->router->class.'/login');
                    } else {
                        $this->session->set_flashdata('flash_message', 'Sorry! We\'re unable to process your request. Please try again.');
                        $this->session->set_flashdata('flash_message_css', 'alert-danger');
                        redirect(current_url());
                    }
                }else{
                    $this->session->set_flashdata('flash_message', 'Sorry! We\'re unable validate & process your request.');
                    $this->session->set_flashdata('flash_message_css', 'alert-danger');
                    redirect(current_url());
                }
            }
        }
        $this->data['page_heading'] = 'Activate Account';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/activate_account', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

    function validate_activate_account_form() {
        $this->form_validation->set_rules('user_email', 'email address', 'required|valid_email|callback_is_email_valid');
        $this->form_validation->set_rules('activation_otp', 'activation otp', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function forgot_password() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $this->session->unset_userdata('sess_forgot_password_username');
        if ($this->input->post('form_action') == 'forgot_password') {
            if ($this->validate_forgot_password_form() == true) {
				//print_r($_POST);die();
                $email = $this->input->post('user_email');
                $password_reset_key = $this->common_lib->generate_rand_id(6, FALSE);
                //echo $password_reset_key; die();

                $postdata = array('user_reset_password_key' => md5($password_reset_key));
                $where = array('user_email' => $email);

                $result = $this->user_model->update($postdata, $where);
                if ($result) {
                    $to_email = $email;
                    $message_html = '';
                    $message_html.='<div id="message_wrapper" style="border-top: 2px solid #5133AB;">';
                    $message_html.= $this->config->item('app_email_header');
                    $message_html.='<div id="message_body" style="padding-top: 5px; padding-bottom:5px;">';
                    $message_html.='<p>Dear User,</p>';
                    $message_html.='<p>Your password reset OTP is '.$password_reset_key.'</p>';
                    //$message_html.='<p>Please click on the below link to set a new password.</p>';
                    //$message_html.='<p>'.anchor(base_url($this->router->directory.$this->router->class.'/reset_password/' . md5($password_reset_key))).'</p>';
                    $message_html.='</div><!--/#message_body-->';
                    $message_html.= $this->config->item('app_email_footer');
                    $message_html.='</div><!--/#message_wrapper-->';

                    // load email lib and email results
                    //die($message_html);
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->to($email);
                    $this->email->from($this->config->item('app_admin_email'), $this->config->item('app_admin_email_name'));
                    $this->email->subject($this->config->item('app_email_subject_prefix') . ' Password Reset OTP is '.$password_reset_key);
                    $this->email->message($message_html);
                    $this->email->send();
                    //echo $this->email->print_debugger();

                    $this->session->set_flashdata('flash_message', 'OTP has been sent to ' . $email);
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    $this->session->set_userdata('sess_forgot_password_username', $email);
                    redirect($this->router->directory.$this->router->class.'/reset_password');
                }
            }
        }
		$this->data['page_heading'] = 'Forgot Password?';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/forgot_password', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

    function validate_forgot_password_form() {		
        $this->form_validation->set_rules('user_email', 'email address', 'required|valid_email|callback_is_email_valid');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function reset_password() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if(!$this->session->userdata('sess_forgot_password_username')){
            $this->session->set_flashdata('flash_message', 'Please enter your email.');
            $this->session->set_flashdata('flash_message_css', 'alert-danger');
            redirect($this->router->directory.$this->router->class.'/forgot_password');
        }
        if ($this->input->post('form_action') == 'reset_password') {
            if ($this->validate_reset_password_form() == true) {
                $email = $this->input->post('user_email');
                $password_reset_key = md5($this->input->post('password_reset_key'));
                $new_password = $this->input->post('user_new_password');
                $is_valid_password_key = $this->user_model->check_user_password_reset_key($email, $password_reset_key);
                if ($is_valid_password_key == TRUE) {
                    $postdata = array('user_password' => md5($new_password),);
                    $where = array('user_email' => $email, 'user_reset_password_key' => $password_reset_key,);
                    $result = $this->user_model->update($postdata, $where);
                    if ($result) {
                        // Set user_reset_password_key to NULL on password update
                        $postdata = array('user_reset_password_key' => NULL);
                        $where = array('user_email' => $email,);
                        $result2 = $this->user_model->update($postdata, $where);
                        // End Set user_reset_password_key to NULL on password update
                        
                        $this->session->set_flashdata('flash_message', 'Password has been changed successfully.');
                        $this->session->set_flashdata('flash_message_css', 'alert-success');
                        $this->session->unset_userdata('sess_forgot_password_username');
                        redirect($this->router->directory.$this->router->class.'/login');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', 'The OTP is either invalid or expired.');
                    $this->session->set_flashdata('flash_message_css', 'alert-danger');
                    redirect(current_url());
                }
            }
        }
		$this->data['page_heading'] = 'Reset Password';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/reset_password', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

    function validate_reset_password_form() {
        $this->form_validation->set_rules('user_email', 'email address', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_new_password', 'new password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password_reset_key', 'OTP', 'required');
        $this->form_validation->set_rules('confirm_user_new_password', 'confirm password', 'required|matches[user_new_password]');

        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
    
    function is_email_valid($user_email) {		
        if($user_email){
            $result = $this->user_model->check_is_email_registered($user_email);			
            if ($result == true) {
                return true;
            }else{
				$this->form_validation->set_message('is_email_valid', $user_email . ' is not a registered email address.');
				return false;
			}
        }
    }

    function change_password() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        
        ########### Validate User Auth End #############

        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'change_password') {
            if ($this->validate_changepassword_form() == true) {
                $postdata = array('user_password' => md5($this->input->post('user_new_password')));
                $where = array('id' => $this->sess_user_id);
                $this->user_model->update($postdata, $where);
                $this->session->set_flashdata('flash_message', 'Password changed successfully.');
                $this->session->set_flashdata('flash_message_css', 'alert-success');
                redirect(current_url());
            }
        }
		$this->data['page_heading'] = 'Change Password';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/change_password', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_changepassword_form() {
        $this->form_validation->set_rules('user_current_password', 'current password', 'required|callback_check_current_password');        
        $this->form_validation->set_rules('user_new_password', 'new password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_user_new_password', 'confirm password', 'required|matches[user_new_password]');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function check_current_password($password) {
        if($password){
            $result = $this->user_model->check_user_password_valid(md5($password), $this->sess_user_id);
            if ($result == false) {
                $this->form_validation->set_message('check_current_password', 'The {field} field is invalid');
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    function logout() {
        if (isset($this->session->userdata['sess_user'])) {
            $this->session->unset_userdata('sess_user');
            $this->session->unset_userdata('sess_post_login_redirect_url');
            $this->session->set_flashdata('flash_message', 'You have been logged out successfully.');
            $this->session->set_flashdata('flash_message_css', 'alert-success');
            redirect($this->router->directory.$this->router->class.'/login');
        } else {
            redirect($this->router->directory.'home');
        }
    }

    function my_profile() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        /*$this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));*/
        ########### Validate User Auth End #############
		
		//View Page Config
        $this->data['page_heading'] = "My Profile";
        $this->breadcrumbs->push('Profile','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();

        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$user_id =  $this->sess_user_id;		
        $rows = $this->user_model->get_rows($user_id);		
		$res_pic = $this->user_model->get_user_profile_pic($user_id);
		$this->data['profile_pic'] = $res_pic[0]['user_profile_pic'];
        $this->data['row'] = $rows['data_rows'];
		$this->data['address'] = $this->user_model->get_user_address(NULL,$user_id,NULL);
		$this->data['econtact'] = $this->user_model->get_user_emergency_contacts(NULL,$user_id);
        $this->data['education'] = $this->user_model->get_user_education(NULL, $user_id);
        $this->data['job_exp'] = $this->user_model->get_user_work_experience(NULL, $user_id);
        $this->data['user_national_identifiers'] = $this->user_model->get_user_national_identifiers($this->sess_user_id);
        $this->data['bank_details'] = $this->user_model->get_user_bank_account_details(NULL, $user_id);
        
        $this->data['approvers'] = $this->user_model->get_user_approvers($this->sess_user_id);
        //print_r($this->data['approvers']); 
		$this->data['page_heading'] = 'My Profile';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/my_profile', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	
	function profile() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        /*$this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));*/
        ########### Validate User Auth End #############
		
		//View Page Config
        $this->data['page_heading'] = "Profile";
        $this->breadcrumbs->push('Profile','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();

        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$user_id = $this->uri->segment(3)? $this->uri->segment(3): $this->sess_user_id;	
        $rows = $this->user_model->get_rows($user_id);		
		$res_pic = $this->user_model->get_user_profile_pic($user_id);
		$this->data['profile_pic'] = $res_pic[0]['user_profile_pic'];
        $this->data['row'] = $rows['data_rows'];
        $this->data['address'] = $this->user_model->get_user_address(NULL,$user_id,NULL);
        $this->data['econtact'] = $this->user_model->get_user_emergency_contacts(NULL,$user_id);
        $this->data['education'] = $this->user_model->get_user_education(NULL, $user_id);
        $this->data['job_exp'] = $this->user_model->get_user_work_experience(NULL, $user_id);
        $this->data['user_national_identifiers'] = $this->user_model->get_user_national_identifiers($user_id);        
        $this->data['bank_details'] = $this->user_model->get_user_bank_account_details(NULL, $user_id);
        
        if($this->common_lib->is_auth(array('view-user-uploads'),false) == true){
            $this->load->model('upload_model');
            $upload_related_to = 'user';
            $this->data['upload_related_to'] = $upload_related_to;
            $this->data['upload_object_user_id'] = $user_id;
            $this->data['all_uploads'] = $this->upload_model->get_uploads($upload_related_to, $user_id, NULL, NULL);
        }
        

		$this->data['page_heading'] = 'Profile';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/profile', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function validate_edit_profile_form() {
        //$this->form_validation->set_rules('user_firstname', 'first name', 'required');
        //$this->form_validation->set_rules('user_lastname', 'last name', 'required');
        //$this->form_validation->set_rules('user_gender', 'gender selection', 'required');        
        $this->form_validation->set_rules('user_phone1', 'personal mobile', 'required|trim|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('user_phone2', 'office mobile', 'trim|min_length[10]|max_length[10]|numeric|differs[user_phone1]
');
        $this->form_validation->set_rules('user_bio', 'about you', 'max_length[100]');
        $this->form_validation->set_rules('user_email', 'registered email (work)', 'required|valid_email');
        $this->form_validation->set_rules('user_email_secondary', 'personal email', 'required|valid_email|differs[user_email]');
        $this->form_validation->set_rules('user_blood_group', 'blood group', 'required');
        /* $this->form_validation->set_rules('dob_day', 'birth day selection', 'required');
          $this->form_validation->set_rules('dob_month', 'birth month selection', 'required');
          $this->form_validation->set_rules('dob_year', 'birth year selection', 'required'); */
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function change_account_status() {
        $response = array(
            'status' => 'init',
            'message' => '',
            'message_css' => '',
            'data' => array(),
        );
        $is_active = $this->input->post('active');
        $postdata = array('user_account_active' => $is_active);
        $where = array('id' => $this->input->post('user_id'));
        $res = $this->user_model->update($postdata, $where);
        if ($res == true) {
            $response = array(
                'status' => 'success',
                'message' => 'Account Status Changed',
                'message_css' => 'alert alert-success',
                'data' => array(),
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error Occured',
                'message_css' => 'alert alert-danger',
                'data' => array(),
            );
        }
        echo json_encode($response);
    }

    function add_address() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $this->data['arr_states'] = $this->user_model->get_state_dropdown();		
        if ($this->input->post('form_action') == 'insert_address') {
            if ($this->validate_user_address_form_data('add') == true) {
                $postdata = array(
					'user_id' => $this->sess_user_id,
                    'address_type' => $this->input->post('address_type'),
                    //'name' => $this->input->post('name'),
                    'phone1' => $this->input->post('phone1'),                    
                    'zip' => $this->input->post('zip'),                    
                    'locality' => $this->input->post('locality'),                    
                    'address' => $this->input->post('address'),                    
                    'city' => $this->input->post('city'),                    
                    'state' => $this->input->post('state'),                    
                    //'country' => $this->input->post('country'),                    
                    'landmark' => $this->input->post('landmark'),                    
                    'phone2' => $this->input->post('phone2'),                    
                );                
                $res = $this->user_model->insert($postdata,'user_addresses');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Address has been added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = 'Add Address';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_address', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function edit_address() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$address_id = $this->uri->segment(3);        
        $this->data['address'] = $this->user_model->get_user_address($address_id, $this->sess_user_id,NULL);
        $this->data['arr_states'] = $this->user_model->get_state_dropdown();
        //print_r($this->data['address']);die();
        if ($this->input->post('form_action') == 'update_address') {
            if ($this->validate_user_address_form_data('edit') == true) {
                $postdata = array(
					//'user_id' => $this->sess_user_id,
                    //'address_type' => $this->input->post('address_type'),
                    //'name' => $this->input->post('name'),
                    'phone1' => $this->input->post('phone1'),                    
                    'zip' => $this->input->post('zip'),                    
                    'locality' => $this->input->post('locality'),                    
                    'address' => $this->input->post('address'),                    
                    'city' => $this->input->post('city'),                    
                    'state' => $this->input->post('state'),                    
                    //'country' => $this->input->post('country'),                    
                    'landmark' => $this->input->post('landmark'),                    
                    'phone2' => $this->input->post('phone2'),                   
                );
                $where = array('id'=>$address_id, 'user_id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata, $where,'user_addresses');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Address has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		
		$this->data['page_heading'] = 'Edit Address';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_address', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	/*function delete_address() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$address_id = $this->uri->segment(3);        
        $this->data['address'] = $this->user_model->get_user_address($address_id, $this->sess_user_id,NULL);
		$where = array('id'=>$address_id, 'user_id' => $this->sess_user_id);
		$res = $this->user_model->delete($where,'user_addresses');
		if ($res) {
			$this->session->set_flashdata('flash_message', 'Address has been deleted successfully.');
			$this->session->set_flashdata('flash_message_css', 'alert-success');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}else{
			$this->session->set_flashdata('flash_message', 'We\'re unable to process your request.');
			$this->session->set_flashdata('flash_message_css', 'alert-danger');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}
    }*/
	
	function get_address_types($char_address_type){
		if(isset($char_address_type)){
			return $this->data['address_type'][$char_address_type];
		}else{
			return '';
		}		
    }
    
    function validate_user_address_form_data($mode) {
        if($mode == 'add'){
            $this->form_validation->set_rules('address_type', 'address type selection', 'required|callback_check_is_address_added');            
        }
        if($mode=="edit"){
            //$this->form_validation->set_rules('address_type', 'address type selection', 'required');        		            
        }    

        //$this->form_validation->set_rules('name', ' ', 'required|min_length[3]|alpha_numeric_spaces');        
        $this->form_validation->set_rules('phone1', ' ', 'trim|min_length[10]|max_length[15]|numeric');        
        $this->form_validation->set_rules('zip', ' ', 'required|min_length[6]|max_length[6]|numeric');        
        $this->form_validation->set_rules('locality', ' ', 'required|min_length[3]');        
        $this->form_validation->set_rules('address', ' ', 'required|max_length[120]');               
        $this->form_validation->set_rules('city', ' ', 'required|max_length[20]');        
        $this->form_validation->set_rules('state', ' ', 'required|max_length[30]');        
        //$this->form_validation->set_rules('country', ' ', 'required');        
        $this->form_validation->set_rules('landmark', ' ', 'max_length[100]');        
        //$this->form_validation->set_rules('phone2', ' ', 'min_length[10]|max_length[10]|numeric');    

        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function check_is_address_added($str) {      
        //die($str);  
        $result = $this->user_model->check_address_type_exists($this->sess_user_id, $str);
        if ($result) {
            $this->form_validation->set_message('check_is_address_added', 'This address type is already added by you. Please choose another.');
            return false;
        }
        return true;
    }
    	
	function calander_days() {
        $result = array();
        $result[''] = 'Day';
        for ($i = 0; $i < 31; $i++) {
            $result[$i + 1] = sprintf('%02d', $i + 1);
        }
        return $result;
    }

    function calander_months() {
        $result = array(
            '' => 'Month',
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        );
        return $result;
    }

    function calander_years() {
        $result = array();
        $result[''] = 'Year';
        $current_year = (date('Y')-18); // 18 years age
        $start_year = ($current_year - 100);
        for ($i = $current_year; $i > $start_year; $i--) {
            $result[$i] = $i;
        }
        return $result;
    }
	
	function add_education() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $this->data['arr_academic_qualification'] = $this->user_model->get_qualification_dropdown();
        $this->data['arr_academic_degree'] = $this->user_model->get_degree_dropdown();
		$this->data['arr_academic_inst'] = $this->user_model->get_institute_dropdown();
		$this->data['arr_academic_specialization'] = $this->user_model->get_specialization_dropdown();
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_user_education_form_data('add') == true) {
                $postdata = array(
					'user_id' => $this->sess_user_id,
                    'academic_qualification' => $this->input->post('academic_qualification'),
                    'academic_degree' => $this->input->post('academic_degree'),
                    'academic_specialization' => $this->input->post('academic_specialization'),
                    'academic_institute' => $this->input->post('academic_institute'), 
                    'academic_from_year' => $this->input->post('academic_from_year'),
                    'academic_to_year' => $this->input->post('academic_to_year'),
                    'academic_marks_percentage' => $this->input->post('academic_marks_percentage')                    
                );                
                $res = $this->user_model->insert($postdata,'user_academics');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Education has been added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = "Add Educational Qualification";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_education', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function edit_education() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$education_id = $this->uri->segment(3);
		$this->data['arr_academic_qualification'] = $this->user_model->get_qualification_dropdown();
		$this->data['arr_academic_inst'] = $this->user_model->get_institute_dropdown();
        $this->data['arr_academic_specialization'] = $this->user_model->get_specialization_dropdown();
        $this->data['arr_academic_degree'] = $this->user_model->get_degree_dropdown();
        $this->data['education'] = $this->user_model->get_user_education($education_id, $this->sess_user_id);

        if ($this->input->post('form_action') == 'edit') {
            if ($this->validate_user_education_form_data('edit') == true) {
                $postdata = array(                    
                    'academic_qualification' => $this->input->post('academic_qualification'),
                    'academic_degree' => $this->input->post('academic_degree'),
                    'academic_specialization' => $this->input->post('academic_specialization'),
                    'academic_institute' => $this->input->post('academic_institute'), 
                    'academic_from_year' => $this->input->post('academic_from_year'),
                    'academic_to_year' => $this->input->post('academic_to_year'),
                    'academic_marks_percentage' => $this->input->post('academic_marks_percentage')                    
                );
                $where = array('id'=>$education_id, 'user_id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata, $where,'user_academics');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Education has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = "Edit Educational Qualification";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_education', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	/*function delete_education() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$id = $this->uri->segment(3);
		$where = array('id'=>$id, 'user_id' => $this->sess_user_id);
		$res = $this->user_model->delete($where,'user_academics');
		if ($res) {
			$this->session->set_flashdata('flash_message', 'Education details has been deleted successfully.');
			$this->session->set_flashdata('flash_message_css', 'alert-success');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}else{
			$this->session->set_flashdata('flash_message', 'We\'re unable to process your request.');
			$this->session->set_flashdata('flash_message_css', 'alert-danger');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}
    }*/
	
	function validate_user_education_form_data($mode) {	
        $max_year = (date('Y')+4);	
        $this->form_validation->set_rules('academic_qualification', 'qualification', 'required'); 
        $this->form_validation->set_rules('academic_degree', 'degree', 'required|greater_than_equal_to[0]',array('greater_than_equal_to' => 'The %s field is required.')); 
		$this->form_validation->set_rules('academic_from_year', 'from year', 'required|min_length[4]|max_length[4]|numeric|greater_than_equal_to[1970]|less_than_equal_to['.date('Y').']');        
        $this->form_validation->set_rules('academic_to_year', 'to year', 'required|min_length[4]|max_length[4]|numeric|greater_than_equal_to[1970]|less_than_equal_to['.$max_year.']'); 
        $this->form_validation->set_rules('academic_institute', 'academic institute', 'required|greater_than_equal_to[0]',array('greater_than_equal_to' => 'The %s field is required.'));
        $this->form_validation->set_rules('academic_specialization', 'specialization', 'required|greater_than_equal_to[0]',array('greater_than_equal_to' => 'The %s field is required.'));
        $this->form_validation->set_rules('academic_marks_percentage', 'marks in percentage', 'required|less_than_equal_to[100]|decimal');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function edit_profile() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        /*$this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));*/
        ########### Validate User Auth End #############
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $rows = $this->user_model->get_rows($this->sess_user_id);
        $this->data['row'] = $rows['data_rows'];

        if ($this->input->post('form_action') == 'update_profile') {
            if ($this->validate_edit_profile_form() == true) {
                $postdata = array(
                    //'user_firstname' => $this->input->post('user_firstname'),
                    //'user_lastname' => $this->input->post('user_lastname'),
                    //'user_bio' => $this->input->post('user_bio'),
                    //'user_gender' => $this->input->post('user_gender'),                   
                    //'user_dob' => $dob,
                    'user_phone1' => $this->input->post('user_phone1'),
                    'user_phone2' => $this->input->post('user_phone2'),                  
                    'user_email_secondary' => $this->input->post('user_email_secondary'),                  
                    'user_blood_group' => $this->input->post('user_blood_group'),                  
                );
                $where = array('id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata, $where);
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Basic information has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
	
		$this->data['page_heading'] = 'Edit My Profile';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_profile', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function edit_user_profile() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'update-emp-profile'
        ));
        ########### Validate User Auth End #############
        $user_id = $this->uri->segment(3);
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $rows = $this->user_model->get_rows($user_id);
        $this->data['row'] = $rows['data_rows'];
        if(isset($this->data['row'][0]) && $this->data['row'][0]['user_archived']=='Y'){
            $this->session->set_flashdata('flash_message', 'Unable to process your request.');
            $this->session->set_flashdata('flash_message_css', 'alert-danger');
            redirect($this->router->directory.$this->router->class.'/manage');
        }
        $res_pic = $this->user_model->get_user_profile_pic($user_id);
        $this->data['profile_pic'] = $res_pic[0]['user_profile_pic'];
        $this->data['user_arr'] = $this->user_model->get_user_dropdown();
        $this->data['approvers'] = $this->user_model->get_user_approvers($user_id);
        //print_r($this->data['approvers'][0]); die();

        if ($this->input->post('form_action') == 'update_profile') {
            if ($this->validate_edit_user_profile_form() == true) {
                $dob = $this->input->post('dob_year') . '-' . $this->input->post('dob_month') . '-' . $this->input->post('dob_day');
                $postdata = array(
                    'user_title' => $this->input->post('user_title'),                    
                    'user_firstname' => ucwords(strtolower($this->input->post('user_firstname'))),
                    'user_lastname' => ucwords(strtolower($this->input->post('user_lastname'))),
                    'user_gender' => $this->input->post('user_gender'),
                    'user_dob' => $dob,
                    'user_doj' => $this->common_lib->convert_to_mysql($this->input->post('user_doj')),
                    //'user_role' => $this->input->post('user_role'),
                    'user_department' => $this->input->post('user_department'),
                    'user_designation' => $this->input->post('user_designation'),
                    'user_account_active' => $this->input->post('user_account_active')
                );
                $where = array('id' => $user_id);
                $res = $this->user_model->update($postdata, $where);
                $this->update_user_approvers($user_id);
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Employee information has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
	
		$this->data['page_heading'] = 'Edit Employee Profile';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_user_profile', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function update_user_approvers($user_id = NULL){
        $postdata = array(
            'user_supervisor_id' => $this->input->post('user_supervisor_id'),
            'user_hr_approver_id' => $this->input->post('user_hr_approver_id'),
            'user_director_approver_id' => $this->input->post('user_director_approver_id'),
            'user_finance_approver_id' => $this->input->post('user_finance_approver_id')
        );

        $has_approver = $this->user_model->has_user_approvers($user_id);
        //print_r($has_approver);die();
        if(isset($has_approver) && sizeof($has_approver) > 0){
            $where = array('id'=> $has_approver[0]['id'], 'user_id' => $user_id);
            $res = $this->user_model->update($postdata, $where, 'user_approvers');
        }else{
            $postdata['user_id'] = $user_id;
            $res = $this->user_model->insert($postdata, 'user_approvers');
        }
        return $res;
    }

    function edit_approvers(){
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $user_id = $this->sess_user_id;
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        
        $this->data['user_arr'] = $this->user_model->get_user_dropdown();
        $this->data['approvers'] = $this->user_model->get_user_approvers($user_id);
        if ($this->input->post('form_action') == 'update_approvers') {
            //print_r($_POST); die();
            if ($this->validate_edit_approver_form() == true) {
                $res = $this->update_user_approvers($user_id);
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Information has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
		$this->data['page_heading'] = 'Update Leave Approvers';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_approvers', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_edit_approver_form() {
        $this->form_validation->set_rules('user_supervisor_id', ' ', 'required');
        $this->form_validation->set_rules('user_hr_approver_id', ' ', 'required');
        $this->form_validation->set_rules('user_director_approver_id', ' ', 'required');
        //$this->form_validation->set_rules('user_finance_approver_id', ' ', 'required'); 
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_edit_user_profile_form() {
        $this->form_validation->set_rules('user_title', 'title', 'required');
        $this->form_validation->set_rules('user_firstname', 'first name', 'required|alpha|min_length[3]|max_length[25]');
        $this->form_validation->set_rules('user_lastname', 'last name', 'required|alpha_numeric_spaces|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('user_gender', 'gender selection', 'required');
        $this->form_validation->set_rules('dob_day', 'birth day selection', 'required');
        $this->form_validation->set_rules('dob_month', 'birth month selection', 'required');
        $this->form_validation->set_rules('dob_year', 'birth year selection', 'required');
        //$this->form_validation->set_rules('user_dob', 'date of birth', 'required');
        //$this->form_validation->set_rules('user_doj', 'date of joining', 'required');
        //$this->form_validation->set_rules('user_role', 'access group', 'required');
        //$this->form_validation->set_rules('user_designation', 'designation', 'required');
        //$this->form_validation->set_rules('user_department', 'department', 'required');
        //$this->form_validation->set_rules('user_account_active', 'account status', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function profile_pic() {
        ########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        /*$this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));*/
        ########### Validate User Auth End #############
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        
		$this->data['user_id'] = $this->sess_user_id;
		
		$res_pic = $this->user_model->get_user_profile_pic($this->sess_user_id);
		$this->data['profile_pic'] = $res_pic[0]['user_profile_pic'];
		
        if ($this->input->post('form_action') == 'file_upload') {
            $this->upload_file();
        }
	
		$this->data['page_heading'] = 'Profile Photo';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/profile_pic', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function validate_uplaod_form_data() {
        //$this->form_validation->set_rules('userfile', 'file selection field', 'required');        
        //$this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        //if ($this->form_validation->run() == true) {
            return true;
        //} else {
            //return false;
        //}
    }
	
	function upload_file() {
        if ($this->validate_uplaod_form_data() == true) {
            $upload_related_to = 'user'; // related to user, product, album, contents etc
            $upload_related_to_id = $this->sess_user_id; // related to id user id, product id, album id etc
            $upload_file_type_name = 'profile_pic'; // file type name

            //Create directory for object specific
            $upload_path = 'assets/uploads/user/profile_pic';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }
            $allowed_ext = 'png|jpg|jpeg|doc|docx|pdf';
            if ($upload_file_type_name == 'profile_pic') {
                $allowed_ext = 'jpg|jpeg';
            }
            $upload_param = array(
                'upload_path' => $upload_path, // original upload folder
                'allowed_types' => $allowed_ext, // allowed file types,
                'max_size' => '2048', // max 1MB size,
                'file_new_name' => $upload_related_to_id . '_' . md5($upload_file_type_name . '_' . time()),
				'thumb_img_require' => TRUE,
				'thumb_img_path'=>$upload_path,
				'thumb_img_width'=>'250',
				'thumb_img_height'=>'300'
            );
            $upload_result = $this->common_lib->upload_file('userfile', $upload_param);
            if (isset($upload_result['file_name']) && empty($upload_result['upload_error'])) {
                $uploaded_file_name = $upload_result['file_name'];
                /*$postdata = array(
                    'upload_related_to' => $upload_related_to,
                    'upload_related_to_id' => $upload_related_to_id,
                    'upload_file_type_name' => $upload_file_type_name,
                    'upload_file_name' => $uploaded_file_name,
                    'upload_mime_type' => $upload_result['file_type'],
                    'upload_by_user_id' => $this->sess_user_id
                );*/
				
				$postdata = array(                    
                    'user_profile_pic' => $uploaded_file_name
                );
				$where_array = array('id'=>$this->sess_user_id);
				

                // Allow mutiple file upload for a file type.
                $multiple_allowed_upload_file_type = array();
                if (!in_array($upload_file_type_name, $multiple_allowed_upload_file_type)) {
                    $uploads = $this->user_model->get_uploads($upload_related_to, $upload_related_to_id, NULL, $upload_file_type_name);
                }
                if (isset($uploads[0]) && ($uploads[0]['id'] != '')) {
                    //Unlink previously uploaded file                    
                    $file_path = $upload_param['upload_path'] . '/' . $uploads[0]['upload_file_name'];
                    if (file_exists(FCPATH . $file_path)) {
                        $this->common_lib->unlink_file(array(FCPATH . $file_path));
                    }
                    // Now update table
                    //$update_upload = $this->user_model->update($postdata, array('id' => $uploads[0]['id']), 'uploads');
                    $update_upload = $this->user_model->update($postdata, $where_array);
                    $this->session->set_flashdata('flash_message', 'Profile photo uploaded successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                } else {
                    //$upload_insert_id = $this->user_model->insert($postdata, 'uploads');
                    $update_upload = $this->user_model->update($postdata, $where_array);
                    $this->session->set_flashdata('flash_message', 'Profile photo uploaded successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            } else if (sizeof($upload_result['upload_error']) > 0) {
                $error_message = $upload_result['upload_error'];
                $this->session->set_flashdata('flash_message',$error_message);
                $this->session->set_flashdata('flash_message_css', 'alert-danger');
                redirect(current_url());
            }
        }
    }
	
	function delete_profile_pic(){
		//$uploaded_file_id = $this->uri->segment(3);
		$uploaded_file_name = $this->uri->segment(3);
		//if($uploaded_file_name){
			//Unlink previously uploaded file                    
			$file_path = 'assets/uploads/user/profile_pic/'.$uploaded_file_name;
			if (file_exists(FCPATH . $file_path)) {
				$this->common_lib->unlink_file(array(FCPATH . $file_path));
				//$res = $this->user_model->delete(array('id'=>$uploaded_file_id),'uploads');
				$postdata = array(                    
                    'user_profile_pic' => NULL
                );
				$where_array = array('id'=>$this->sess_user_id);
				$res = $this->user_model->update($postdata, $where_array);
				if($res){
					$this->session->set_flashdata('flash_message', 'Profile photo has been deleted successfully.');
					$this->session->set_flashdata('flash_message_css', 'alert-success');
					redirect($this->router->directory.$this->router->class.'/profile_pic');
				}else{
					$this->session->set_flashdata('flash_message', 'Error occured while processing your request.');
					$this->session->set_flashdata('flash_message_css', 'alert-danger');
					redirect($this->router->directory.$this->router->class.'/profile_pic');
				}
			}
		//}
	}
	
	
	function allocate_projects() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
		$this->load->model('project_model');
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$this->data['arr_projects'] = $this->project_model->get_project_dropdown();
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_user_project_assign_form_data('add') == true) {
                $postdata = array(					
                    'academic_qualification' => $this->input->post('academic_qualification')                 
                );                
                $res = $this->user_model->insert($postdata,'user_projects');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Project has been added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/profile');
                }
            }
        }
		$this->data['page_heading'] = "Allocate Projects";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/allocate_projects', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function validate_user_project_assign_form_data(){
		$this->form_validation->set_rules('project_id', 'project', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
	}
	
	function administrator() {
		########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));
        ########### Validate User Auth End #############
		$this->data['page_heading'] = "Administrator Control Panel";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/administrator', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
    
    function add_user_input_specialization(){
        $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>'');
        if(($this->input->post('action')=='add')){
            if ($this->validate_add_user_input_specialization_data() == true) {
                $postdata = array(					
                    'specialization_name' => ucwords(strtolower($this->input->post('specialization_name')))
                );                
                $insert_id = $this->user_model->insert($postdata,'academic_specialization');
                if ($insert_id) {
                    $message = array('is_valid'=>true, 'insert_id'=>$insert_id,'msg'=>'<div class="alert alert-success">Specialization has been added succesfully.</div>'); 
                }
            }else{
                $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>validation_errors()); 
            }
        }
        echo json_encode($message); die();
    }


    function validate_add_user_input_specialization_data(){        
		$this->form_validation->set_rules('specialization_name', 'specialization name', 'required|alpha_numeric_spaces|min_length[5]|max_length[100]|is_unique[academic_specialization.specialization_name]',
        array(                
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
    

    function add_user_input_degree(){
        $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>'');
        if(($this->input->post('action')=='add')){
            if ($this->validate_add_user_input_degree_data() == true) {
                $postdata = array(					
                    'degree_name' => ucwords(strtolower($this->input->post('degree_name')))
                );                
                $insert_id = $this->user_model->insert($postdata,'academic_degree');
                if ($insert_id) {
                    $message = array('is_valid'=>true, 'insert_id'=>$insert_id,'msg'=>'<div class="alert alert-success">degree has been added succesfully.</div>'); 
                }
            }else{
                $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>validation_errors()); 
            }
        }
        echo json_encode($message); die();
    }


    function validate_add_user_input_degree_data(){        
		$this->form_validation->set_rules('degree_name', 'degree name', 'required|alpha_numeric_spaces|min_length[5]|max_length[50]|is_unique[academic_degree.degree_name]',
        array(                
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
    

    function add_user_input_institute(){
        $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>'');
        if(($this->input->post('action')=='add')){
            if ($this->validate_add_user_input_institute_data() == true) {
                $postdata = array(					
                    'institute_name' => ucwords(strtolower($this->input->post('institute_name')))
                );                
                $insert_id = $this->user_model->insert($postdata,'academic_institute');
                if ($insert_id) {
                    $message = array('is_valid'=>true, 'insert_id'=>$insert_id,'msg'=>'<div class="alert alert-success">institute has been added succesfully.</div>'); 
                }
            }else{
                $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>validation_errors()); 
            }
        }
        echo json_encode($message); die();
    }


    function validate_add_user_input_institute_data(){
		$this->form_validation->set_rules('institute_name', 'institute name', 'required|alpha_numeric_spaces|min_length[5]|max_length[200]|is_unique[academic_institute.institute_name]',
        array(                
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
    
    function add_work_experience() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        		
        $this->data['arr_company'] = $this->user_model->get_company_dropdown();
        $this->data['arr_designation_prev_work'] = $this->user_model->get_designation_dropdown();
        
		
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_user_work_exp_form_data('add') == true) {
                $postdata = array(
					'user_id' => $this->sess_user_id,
                    'company_id' => $this->input->post('company_id'),
                    'from_date' => $this->common_lib->convert_to_mysql($this->input->post('from_date')),
                    'to_date' => $this->common_lib->convert_to_mysql($this->input->post('to_date')),
                    'designation_id' => $this->input->post('designation_id'), 
                    'job_description' => $this->input->post('job_description')
                );                
                $res = $this->user_model->insert($postdata,'user_work_exp');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Job experience has been added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = "Add Previous Work Experiences";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_work_experience', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function edit_work_experience() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$id = $this->uri->segment(3);
		$this->data['arr_company'] = $this->user_model->get_company_dropdown();
        $this->data['arr_designation_prev_work'] = $this->user_model->get_designation_dropdown();
        $this->data['job_exp'] = $this->user_model->get_user_work_experience($id, $this->sess_user_id);

        if ($this->input->post('form_action') == 'edit') {
            if ($this->validate_user_work_exp_form_data('edit') == true) {
                $postdata = array(                    
                    'company_id' => $this->input->post('company_id'),
                    'from_date' => $this->common_lib->convert_to_mysql($this->input->post('from_date')),
                    'to_date' => $this->common_lib->convert_to_mysql($this->input->post('to_date')),
                    'designation_id' => $this->input->post('designation_id'), 
                    'job_description' => $this->input->post('job_description')                    
                );
                $where = array('id'=>$id, 'user_id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata, $where,'user_work_exp');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Job experience has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = "Edit Previous Work Experiences";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_work_experience', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	/*function delete_education() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$id = $this->uri->segment(3);
		$where = array('id'=>$id, 'user_id' => $this->sess_user_id);
		$res = $this->user_model->delete($where,'user_academics');
		if ($res) {
			$this->session->set_flashdata('flash_message', 'Education details has been deleted successfully.');
			$this->session->set_flashdata('flash_message_css', 'alert-success');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}else{
			$this->session->set_flashdata('flash_message', 'We\'re unable to process your request.');
			$this->session->set_flashdata('flash_message_css', 'alert-danger');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}
    }*/
	
	function validate_user_work_exp_form_data($mode) {	
        $max_year = (date('Y')+4);	
        $this->form_validation->set_rules('company_id', 'company selection', 'required|greater_than_equal_to[0]',array('greater_than_equal_to' => 'The %s field is required.')); 
        $this->form_validation->set_rules('from_date', 'from date', 'required'); 
		$this->form_validation->set_rules('to_date', 'to date', 'required');        
        $this->form_validation->set_rules('designation_id', 'designation', 'required|greater_than_equal_to[0]',array('greater_than_equal_to' => 'The %s field is required.')); 
        $this->form_validation->set_rules('job_description', 'job description', 'max_length[400]');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function add_user_input_company(){
        $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>'');
        if(($this->input->post('action')=='add')){
            if ($this->validate_add_user_input_company_data() == true) {
                $postdata = array(					
                    'company_name' => $this->input->post('company_name')
                );                
                $insert_id = $this->user_model->insert($postdata,'companies');
                if ($insert_id) {
                    $message = array('is_valid'=>true, 'insert_id'=>$insert_id,'msg'=>'<div class="alert alert-success">institute has been added succesfully.</div>'); 
                }
            }else{
                $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>validation_errors()); 
            }
        }
        echo json_encode($message); die();
    }


    function validate_add_user_input_company_data(){
		$this->form_validation->set_rules('company_name', 'company name', 'required|min_length[5]|max_length[200]|is_unique[companies.company_name]',
        array(                
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function add_user_input_designation(){
        $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>'');
        if(($this->input->post('action')=='add')){
            if ($this->validate_add_user_input_designation_data() == true) {
                $postdata = array(					
                    'designation_name' => $this->input->post('designation_name'),
                    'designation_status' => 'N'
                );                
                $insert_id = $this->user_model->insert($postdata,'designations');
                if ($insert_id) {
                    $message = array('is_valid'=>true, 'insert_id'=>$insert_id,'msg'=>'<div class="alert alert-success">institute has been added succesfully.</div>'); 
                }
            }else{
                $message = array('is_valid'=>false, 'insert_id'=>'','msg'=>validation_errors()); 
            }
        }
        echo json_encode($message); die();
    }


    function validate_add_user_input_designation_data(){
		$this->form_validation->set_rules('designation_name', 'designation name', 'required|min_length[3]|max_length[200]|is_unique[designations.designation_name]',
        array(                
                'is_unique'     => 'This %s already exists.'
        ));
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function add_bank_account() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $this->data['arr_banks'] = $this->user_model->get_bank_dropdown();
        $this->data['user_national_identifiers'] = $this->user_model->get_user_national_identifiers($this->sess_user_id);
		
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_user_bank_account_form_data('add') == true) {
                $postdata_user = array(					
                    'user_pan_no' => strtoupper($this->input->post('user_pan_no')),
                    'user_aadhar_no' => $this->input->post('user_aadhar_no'),                    
                    'user_passport_no' => strtoupper($this->input->post('user_passport_no')), 
                    'user_uan_no' => $this->input->post('user_uan_no')
                );                
                $where = array('id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata_user, $where);

                $postdata = array(
					'user_id' => $this->sess_user_id,
                    'account_uses' => $this->input->post('account_uses'),                    
                    'account_type' => $this->input->post('account_type'),                    
                    'bank_id' => $this->input->post('bank_id'), 
                    'bank_account_no' => $this->input->post('bank_account_no'),
                    'ifsc_code' => strtoupper($this->input->post('ifsc_code'))
                );                
                $res = $this->user_model->insert($postdata,'user_bank_account');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Bank account details has been added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = "Add Salary Account";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_bank_account', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }


    function edit_bank_account() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$id = $this->uri->segment(3);
        $this->data['arr_banks'] = $this->user_model->get_bank_dropdown();        
        $this->data['bank_details'] = $this->user_model->get_user_bank_account_details($id, $this->sess_user_id);
        $this->data['user_national_identifiers'] = $this->user_model->get_user_national_identifiers($this->sess_user_id);

        if ($this->input->post('form_action') == 'edit') {
            if ($this->validate_user_bank_account_form_data('edit') == true) {
                $postdata_user = array(					
                    'user_pan_no' => strtoupper($this->input->post('user_pan_no')),
                    'user_aadhar_no' => $this->input->post('user_aadhar_no'),                    
                    'user_passport_no' => strtoupper($this->input->post('user_passport_no')), 
                    'user_uan_no' => $this->input->post('user_uan_no')
                );                
                $where = array('id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata_user, $where);

                $postdata = array(
                    //'account_uses' => $this->input->post('account_uses'),                    
                    'account_type' => $this->input->post('account_type'),                    
                    'bank_id' => $this->input->post('bank_id'), 
                    'bank_account_no' => $this->input->post('bank_account_no'),
                    'ifsc_code' => strtoupper($this->input->post('ifsc_code'))
                );
                $where = array('id'=>$id, 'user_id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata, $where,'user_bank_account');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Bank account details has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = "Edit Salary Account";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_bank_account', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_user_bank_account_form_data($mode) {	 
        if($mode == 'add'){
            $this->form_validation->set_rules('account_uses', 'account for', 'required|callback_check_is_account_uses_exists'); 
        }  
        $this->form_validation->set_rules('user_pan_no', 'PAN no', 'required|regex_match[/^[A-Za-z]{5}\d{4}[A-Za-z]{1}$/]'); 
        //$this->form_validation->set_rules('user_aadhar_no', 'Aadhar no', 'required'); 
        $this->form_validation->set_rules('user_passport_no', 'passport', 'alpha_numeric'); 
        $this->form_validation->set_rules('user_uan_no', 'UAN no', 'numeric'); 
        
        $this->form_validation->set_rules('bank_id', 'bank selection', 'required'); 
        $this->form_validation->set_rules('bank_account_no', 'account no', 'required|numeric'); 
        $this->form_validation->set_rules('confirm_bank_account_no', 'confirm account no', 'required|numeric|matches[bank_account_no]'); 		
        $this->form_validation->set_rules('ifsc_code', 'ifsc code', 'required|regex_match[/^[A-Za-z]{4}\d{7}$/]'); 
        $this->form_validation->set_rules('account_type', 'account type', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function check_is_account_uses_exists($str) {      
        //die($str);  
        $result = $this->user_model->check_is_account_uses_exists($this->sess_user_id, $str);
        if ($result) {
            $this->form_validation->set_message('check_is_account_uses_exists', $this->data['account_uses'][$str].' is already added by you.');
            return false;
        }
        return true;
    }

    function download_to_excel(){        
        $excel_heading = array(
            'A' => 'Sr No.',
            'B' => 'Employee ID',
            'C' => 'Name',
            'D' => 'Email (Work)',
            'E' => 'Email (Personal)',
            'F' => 'Mobile (Work)',
            'G' => 'Mobile (Personal)',
            'H' => 'DOB',
            'I' => 'Gender',
            'J' => 'Blood Group',
            'K' => 'Department',
            'L' => 'Designation',
            'M' => 'Date of Joining',
            'N' => 'Date of Release',
            'O' => 'Account Status'
        );
        $this->data['xls_col'] = $excel_heading;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        $sheet = $this->excel->getActiveSheet();
        //name the worksheet
        $sheet->setTitle('Users');

        $result_array = $this->user_model->get_rows(NULL, NULL, NULL, FALSE, TRUE, 'U');
        $data_rows = $result_array['data_rows'];

        // echo '<pre>';
        // print_r($data_rows);
        // die();
        // read data to active sheet
        //$sheet->fromArray($data_rows);
        
        // Static Fields
        $sheet->setCellValue('A1', 'Active Account');
        $sheet->getStyle('A1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'a8ef81'))));
        
        $sheet->setCellValue('A2', 'Inactive Account');
        $sheet->getStyle('A2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'f9eb7f'))));
        //End Static Fields

        $range = range('A', 'Z');
        $heading_row = 5;
        $index = 0;
        foreach ($excel_heading as $column => $heading_display) {
            $sheet->setCellValue($range[$index] . $heading_row, $heading_display);
            $index++;
        }


        $excel_row = 6;
        $serial_no = 1;
        foreach ($data_rows as $index => $row) {
            $sheet->setCellValue('A' . $excel_row, $serial_no);
            $sheet->setCellValue('B' . $excel_row, '# '.str_pad($row['user_emp_id'], 4, '0', STR_PAD_LEFT));
            $sheet->setCellValue('C' . $excel_row, $row['user_firstname'].' '.$row['user_lastname']);
            $sheet->setCellValue('D' . $excel_row, $row['user_email']);
            $sheet->setCellValue('E' . $excel_row, $row['user_email_secondary']);
            $sheet->setCellValue('F' . $excel_row, $row['user_phone1']);
            $sheet->setCellValue('G' . $excel_row, $row['user_phone2']);

            $sheet->setCellValue('H' . $excel_row, $this->common_lib->display_date($row['user_dob']));
            $sheet->setCellValue('I' . $excel_row, $this->data['arr_gender'][$row['user_gender']]);
            $sheet->setCellValue('J' . $excel_row, $row['user_blood_group']);
            $sheet->setCellValue('K' . $excel_row, $row['department_name']);
            $sheet->setCellValue('L' . $excel_row, $row['designation_name']);
            $sheet->setCellValue('M' . $excel_row, $this->common_lib->display_date($row['user_doj']));
            $sheet->setCellValue('N' . $excel_row, $this->common_lib->display_date($row['user_dor']));
            
            $sheet->setCellValue('O' . $excel_row, ($row['user_account_active']=='Y' ? 'Active Account' : 'Inactive Account'));
            if($row['user_account_active'] == 'N'){
                $sheet->getStyle('A2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'f9eb7f'))));
                $color = 'f9eb7f'; //warning
            }  
            if($row['user_account_active'] == 'Y'){
                $color = 'a8ef81'; //success
            }        
            
            if ($color) {
                $sheet->getStyle('O' . $excel_row)->applyFromArray(array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '4d4d4d')
                        )
                    ),
                    'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => $color))));
            }                     
            $excel_row++;
            $serial_no++;
        }


        // Color Config
        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '0')
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '80bfff'),
            ),
            'font' => array(
                'bold' => true
            )
        );
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4d4d4d')
                )
            )
        );
        $sheet->getDefaultStyle()->applyFromArray($styleArray);
        $sheet->getStyle('A5:R5')->applyFromArray($style_header);
        $sheet->getStyle('A5:R5')->getFont()->setSize(9);
        $sheet->getDefaultStyle()->getFont()->setSize(10);
        $sheet->getDefaultColumnDimension()->setWidth('17');

        // // Check box
        // $required_cols = array();
        // if (isset($_POST['columns'])) {
        //     foreach ($_POST['columns'] as $key => $xls_column) {
        //         $required_cols[] = $xls_column;
        //     }
        // }

        // $all_cols = array();
        // if (isset($_POST['all_cols'])) {
        //     foreach ($_POST['all_cols'] as $key => $xls_column) {
        //         $all_cols[] = $xls_column;
        //     }
        // }

        // $removable_cols = array_diff($all_cols, $required_cols);
        // //print_r($removable_cols);

        // if (isset($removable_cols)) {
        //     foreach ($removable_cols as $key => $col) {
        //         $sheet->removeColumn($col);
        //     }
        // }
        // //die();


        $filename = 'Employees_' . date('dmY') . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function close_account() {
		########### Validate User Auth #############
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
        ));
        ########### Validate User Auth End #############

        $user_id = @$this->encrypt->decode($this->uri->segment(3));
        $rows = $this->user_model->get_rows($user_id);
        $this->data['row'] = $rows['data_rows'];

        if(isset($this->data['row'][0]) && $this->data['row'][0]['user_archived']=='Y'){
            $this->session->set_flashdata('flash_message', 'Unable to process your request.');
            $this->session->set_flashdata('flash_message_css', 'alert-danger');
            redirect($this->router->directory.$this->router->class.'/manage');
        }
        
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'close_account') {
            if ($this->validate_close_account_form_data() == true) {
                $postdata = array(
                    'user_archived' => 'Y',
                    'user_dor'=> $this->common_lib->convert_to_mysql($this->input->post('user_dor')),
                    'account_closed_by' => $this->sess_user_id,
                    'account_closed_datetime' => date('Y-m-d H:i:s'),
                    'account_close_comments' => $this->input->post('account_close_comments')
                );
                //print_r($postdata);die();
                $where = array('id' => $this->input->post('user_id'));
                $res = $this->user_model->update($postdata, $where);
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Portal account has been closed successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/manage');
                }
            }
        }
		$this->data['page_heading'] = "Close Employee Portal Account";
        $this->data['maincontent'] = $this->load->view($this->router->class.'/close_account', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_close_account_form_data() {
        $this->form_validation->set_rules('user_dor', 'date of release', 'required');
        $this->form_validation->set_rules('account_close_comments', ' ', 'required');
        $this->form_validation->set_rules('terms', ' ', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function add_emergency_contact() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $this->data['arr_relationship'] = $this->user_model->get_relationship_dropdown();		
        $this->data['has_add_limit'] = $this->user_model->get_user_emergency_contacts_count($this->sess_user_id, 3);		
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_emergency_contact_form('add') == true) {
                $postdata = array(
					'user_id' => $this->sess_user_id,
                    'contact_person_name' => $this->input->post('contact_person_name'),
                    'contact_person_address' => $this->input->post('contact_person_address'),
                    'relationship_with_contact' => $this->input->post('relationship_with_contact'),
                    'contact_person_phone1' => $this->input->post('contact_person_phone1'),
                    'contact_person_phone2' => $this->input->post('contact_person_phone2'),
                );                
                $res = $this->user_model->insert($postdata,'user_emergency_contacts');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Emergency Contact has been added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		$this->data['page_heading'] = 'Add Emergency Contact';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_emergency_contact', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function edit_emergency_contact() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['arr_relationship'] = $this->user_model->get_relationship_dropdown();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$ec_id = $this->uri->segment(3);
        $this->data['econtact'] = $this->user_model->get_user_emergency_contacts($ec_id, $this->sess_user_id);
        //print_r($this->data['contacts']);die();
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_emergency_contact_form('edit') == true) {
                $postdata = array(
                    'user_id' => $this->sess_user_id,
                    'contact_person_name' => $this->input->post('contact_person_name'),
                    'contact_person_address' => $this->input->post('contact_person_address'),
                    'relationship_with_contact' => $this->input->post('relationship_with_contact'),
                    'contact_person_phone1' => $this->input->post('contact_person_phone1'),
                    'contact_person_phone2' => $this->input->post('contact_person_phone2'),
                );
                $where = array('id'=>$ec_id, 'user_id' => $this->sess_user_id);
                $res = $this->user_model->update($postdata, $where,'user_emergency_contacts');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Emergency Contact has been updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/my_profile');
                }
            }
        }
		
		$this->data['page_heading'] = 'Edit Emergency Contact';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_emergency_contact', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function delete_emergency_contact() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
            redirect($this->router->directory.$this->router->class.'/login');
        }
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$id = $this->uri->segment(3);
		$where = array('id'=>$id);
		$res = $this->user_model->delete($where,'user_emergency_contacts');
		if ($res) {
			$this->session->set_flashdata('flash_message', 'Emergency Contact has been deleted successfully.');
			$this->session->set_flashdata('flash_message_css', 'alert-success');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}else{
			$this->session->set_flashdata('flash_message', 'We\'re unable to process your request.');
			$this->session->set_flashdata('flash_message_css', 'alert-danger');
			redirect($this->router->directory.$this->router->class.'/my_profile');
		}
    }
	
    function validate_emergency_contact_form($mode) {
        $this->form_validation->set_rules('contact_person_name', ' ', 'required|min_length[3]|alpha_numeric_spaces');
        $this->form_validation->set_rules('relationship_with_contact', ' ', 'required');
        $this->form_validation->set_rules('contact_person_address', ' ', 'min_length[10]|max_length[200]'); 
        $this->form_validation->set_rules('contact_person_phone1', ' ', 'required|trim|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('contact_person_phone2', ' ', 'min_length[10]|max_length[15]|numeric');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_suggestion(){
        $term = $this->input->get_post('term');
        $type = $this->input->get_post('_type');
        $q = $this->input->get_post('q');
        $json = [];
        if($type == 'query' && strlen($q)>0){
            $result = $this->user_model->search_users($q);
        }
        if(isset($result) && sizeof($result)>0){
            foreach($result as $key => $row){
                $json[] = ['id' => $row['id'], 'text' => $row['user_firstname'].' '.$row['user_lastname'].' - '.$row['designation_name'].' (Emp ID: '.$row['user_emp_id'].')'];
            }
        }
        echo json_encode($json); die();
    }

}

?>
