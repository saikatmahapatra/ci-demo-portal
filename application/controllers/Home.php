<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;
    var $id;
    var $sess_user_id;

    function __construct() {
        parent::__construct();

        //Check if any user logged in else redirect to login
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.'user/login');
        }

        //Has logged in user permission to access this page or method?        
        /*$this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));*/

        // Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');

        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();

        // Load required js files for this controller
        $javascript_files = array();
        $this->data['app_js'] = $this->common_lib->add_javascript($javascript_files);

        $this->load->model('home_model');
        $this->load->model('cms_model');
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        $this->id = $this->uri->segment(3);

        //View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/');		
        $this->data['breadcrumbs'] = $this->breadcrumbs->show();
        
        $this->data['content_type'] = array(
            'news'=>array('text'=>'News', 'css'=>'text-warning'),
            'policy'=>array('text'=>'Policy', 'css'=>'text-success'),
            'notice'=>array('text'=>'Notice', 'css'=>'text-primary')
        );

    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
		
		// Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->cms_model->get_contents(NULL, NULL, NULL, FALSE, FALSE);
		$total_num_rows = $result_array['num_rows'];
		
		//pagination config
		$additional_segment = $this->router->directory.$this->router->class.'/index';
		$per_page = 4;
		$config['uri_segment'] = 4;
		$config['num_links'] = 1;
		$config['use_page_numbers'] = TRUE;
		//$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : 0;
		$offset = ($page*$per_page);
		$this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page, $additional_segment);
		//end of pagination config
        

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_contents(NULL, $per_page, $offset, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
		
        // Dashboard Stats
        $this->data['user_count'] = $this->home_model->get_user_count();
        $this->data['projects_count'] = $this->home_model->get_user_projects();
        $this->data['timesheet_user'] = $this->home_model->get_user_of_timesheet();
        $this->data['user_applied_leave'] = $this->home_model->get_user_applied_leave_count();
        $this->data['user_approved_leave'] = $this->home_model->get_user_approved_leave_count();
        // Dashboard Stats
        
        //User Profile Completion Status Check
        $profile_completion = $this->home_model->get_user_profile_completion_status($this->sess_user_id);
        $this->data['profile_msg'] = $profile_completion;
        $this->data['display_reminder_modal'] = sizeof($profile_completion) > 0 ? 'true' : 'false';
        

		//$this->data['page_title'] = 'Welcome to '.$this->config->item('app_company_product');
		$this->data['page_title'] = 'Dashboard';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function details() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
		
		// Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        $id = $this->uri->segment(3);		
		$result_array = $this->cms_model->get_contents($id, NULL, NULL, FALSE, FALSE);
        $this->data['data_rows'] = $result_array['data_rows'];
        $this->data['redirect_back_url'] = site_url('home');
        if($this->uri->segment(4) == 'redirect' && $this->uri->segment(5) != ''){
            $this->data['redirect_back_url'] = site_url('home/'.$this->uri->segment(5));
        }
        $this->data['page_title'] = 'Notice Board';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/details', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function under_construction(){
        $this->data['page_title'] = 'Under Construction';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/under_construction', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function feedback(){
        $this->data['page_title'] = 'Feedback';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/feedback', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function policy() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
		
		// Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition
        $filter = array('content_type' => array('policy'));
		$result_array = $this->cms_model->get_contents(NULL, NULL, NULL, FALSE, FALSE, $filter);
		$total_num_rows = $result_array['num_rows'];
		
		//pagination config
		$additional_segment = $this->router->directory.$this->router->class.'/policy';
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
        $result_array = $this->cms_model->get_contents(NULL, $per_page, $offset, FALSE, TRUE, $filter);
        $this->data['data_rows'] = $result_array['data_rows'];

		$this->data['page_title'] = 'HR Policies';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/policy', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

}

?>
