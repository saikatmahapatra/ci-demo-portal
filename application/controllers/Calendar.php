<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends CI_Controller {

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
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-user-access'
        ));

        // Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');

        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();

        // Load required js files for this controller
        $javascript_files = array(
            $this->router->class
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($javascript_files);
        $this->load->model('calendar_model');
        $this->id = $this->uri->segment(3);
        
        //View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Calendar', '/cms');		
        $this->data['breadcrumbs'] = $this->breadcrumbs->show();        
        $this->data['arr_status_flag'] = array(
            'Y'=>array('text'=>'Active', 'css'=>''),
            'N'=>array('text'=>'Inactive', 'css'=>''),
            'A'=>array('text'=>'Archived', 'css'=>'')
        );
    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
		
		// Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
			
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Calendar';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function get_events(){
        $user_id = $this->sess_user_id;
        $start_date = $this->input->get_post('start');
        $end_date = $this->input->get_post('end');

        $json_response = $this->calendar_model->get_events($start_date, $end_date, $user_id);
        echo $json_response; die();
    }
}
?>