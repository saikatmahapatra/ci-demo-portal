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
        $javascript_files = array(
            $this->router->class
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($javascript_files);

        $this->load->model('home_model');
        $this->load->model('cms_model');

        $this->id = $this->uri->segment(3);
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', base_url());
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
        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		// $result_array = $this->cms_model->get_contents(NULL, NULL, NULL, FALSE, FALSE);
		// $total_num_rows = $result_array['num_rows'];
		
		//pagination config
		// $additional_segment = $this->router->directory.$this->router->class.'/index';
		// $per_page = 4;
		// $config['uri_segment'] = 4;
		// $config['num_links'] = 1;
		// $config['use_page_numbers'] = TRUE;
		//$this->pagination->initialize($config);
		
		// $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : 0;
		// $offset = ($page*$per_page);
		// $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page, $additional_segment);
		//end of pagination config
        

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_top_contents(NULL, 5, 0, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
		
        // Dashboard Stats
        $dashboard_stat = array();
        $this->load->model('project_model');
        $stat_user_count = $this->home_model->get_user_count();
        $stat_projects_count = $this->home_model->get_user_projects();
        $stat_timesheet_user = $this->home_model->get_user_of_timesheet();
        $stat_user_applied_leave = $this->home_model->get_user_applied_leave_count();
        $stat_user_approved_leave = $this->home_model->get_user_approved_leave_count();
        $stat_pending_leave_action = $this->home_model->get_pending_leave_action_count($this->sess_user_id);
        $stat_user_timesheet_stat = $this->project_model->get_timesheet_stats(date('Y'), date('m'), $this->sess_user_id);

        $dashboard_stat['user'] = array('target_role' => '1', 'heading'=>'Employees', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-primary', 'icon'=>'', 'count'=>$stat_user_count['data_rows'][0]['total'], 'url' => base_url('user/manage'));

        $dashboard_stat['project'] = array('target_role' => '1', 'heading'=>'Projects', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-secondary', 'icon'=>'', 'count'=>$stat_projects_count['data_rows'][0]['total'], 'url' => base_url('project'));

        $dashboard_stat['timesheet_user'] = array('target_role' => '1', 'heading'=>'Logged Task Current Month', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-success', 'icon'=>'', 'count'=>$stat_timesheet_user['data_rows'][0]['total'], 'url' => base_url('project/timesheet_report'));
        
        $dashboard_stat['user_applied_leave'] = array('target_role' => '1', 'heading'=>'Leave Approved', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-info', 'icon'=>'', 'count'=>$stat_user_approved_leave['data_rows'][0]['total'].'/'.$stat_user_applied_leave['data_rows'][0]['total'], 'url' => base_url('leave/manage'));

        $dashboard_stat['leave_to_approve'] = array('target_role' => '', 'heading'=>'Leave to Approve', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-warning', 'icon'=>'', 'count'=>$stat_pending_leave_action['data_rows'][0]['total'], 'url' => base_url('leave/manage'));

        $dashboard_stat['timesheet_days'] = array('target_role' => '', 'heading'=>'Days You Logged *', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-danger', 'icon'=>'', 'count'=>$stat_user_timesheet_stat['stat_data']['total_days'], 'url' => base_url('timesheet'));

        $dashboard_stat['timesheet_hrs'] = array('target_role' => '', 'heading'=>'Your Logged Hours *', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-primary', 'icon'=>'', 'count'=>$stat_user_timesheet_stat['stat_data']['total_hrs'] ? $stat_user_timesheet_stat['stat_data']['total_hrs'] : 0, 'url' => base_url('timesheet'));

        $dashboard_stat['timesheet_avg_hrs'] = array('target_role' => '', 'heading'=>'Your Average Logged Hours *', 'info_text'=>'','text_css'=>'','bg_css'=>'', 'digit_css'=>'text-secondary', 'icon'=>'', 'count'=>$stat_user_timesheet_stat['stat_data']['avg_hrs'] ? $stat_user_timesheet_stat['stat_data']['avg_hrs'] : 0, 'url' => base_url('timesheet'));

        $this->data['dashboard_stat'] = $dashboard_stat;
        // Dashboard Stats
        
        //User Profile Completion Status Check
        //$profile_completion = $this->home_model->get_user_profile_completion_status($this->sess_user_id);
        //$this->data['profile_msg'] = $profile_completion;
        //$this->data['display_reminder_modal'] = sizeof($profile_completion) > 0 ? 'true' : 'false';
        $this->data['display_reminder_modal'] = 'false';
        
		$this->data['page_title'] = 'Dashboard';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
    
    function all_news() {
        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->cms_model->get_contents(NULL, NULL, NULL, FALSE, FALSE);
		$total_num_rows = $result_array['num_rows'];
		
		//pagination config
		$additional_segment = $this->router->directory.$this->router->class.'/all_news';
		$per_page = 20;
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
        $this->data['page_title'] = 'Organization Announcements';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/all_news', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
    
	function details() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
		
		// Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $id = $this->uri->segment(3);		
		$result_array = $this->cms_model->get_contents($id, NULL, NULL, FALSE, FALSE);
        $this->data['data_rows'] = $result_array['data_rows'];
        $this->data['redirect_back_url'] = site_url('home');
        if($this->uri->segment(4) == 'redirect' && $this->uri->segment(5) != ''){
            $this->data['redirect_back_url'] = site_url('home/'.$this->uri->segment(5));
        }
        if($this->uri->segment(4) == 'all_news') {
            $this->data['redirect_back_url'] = site_url('home/all_news');
            if($this->uri->segment(6) && $this->uri->segment(6) != ''){
                $this->data['redirect_back_url'] = site_url('home/all_news/'.$this->uri->segment(5).'/'.$this->uri->segment(6));
            } else {
                $this->data['redirect_back_url'] = site_url('home/all_news');
            }
        }
        $this->data['page_title'] = 'Organization Announcements';
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

    function get_events(){
        $user_id = $this->sess_user_id;
        $start_date = $this->input->get_post('start');
        $end_date = $this->input->get_post('end');

        $json_response = $this->home_model->get_events($start_date, $end_date, $user_id);
        echo $json_response; die();
    }

    function apply_leave() {
        $this->session->set_userdata('post_leave_apply_redirect_url', base_url('home'));
        redirect(base_url('leave/apply'));
    }

    function log_timesheet() {
        $this->session->set_userdata('post_task_log_redirect_url', base_url('home'));
        redirect(base_url('timesheet'));
    }

    function sidebar_toggle(){
        $result = array('result'=>'error');
        if(isset($this->session->userdata['sess_hide_sidebar_md'])) {
            $this->session->unset_userdata('sess_hide_sidebar_md');
            $result = array('result'=>'session_destroyed');
        } else {
            $this->session->set_userdata('sess_hide_sidebar_md', true);
            $result = array('result'=>'session_started');
        }
        print_r(json_encode($result)); 
        die();
    }

}

?>
