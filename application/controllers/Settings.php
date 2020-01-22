<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

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
            'default-admin-access'
        ));
        // Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();
        $this->load->model('settings_model');
    }

    function index() {
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
        $this->data['page_title'] = 'Site Settings';
        $this->data['rows'] = $this->settings_model->get_option();
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function timesheet_settings() {
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
        $this->data['page_title'] = 'Timesheet Settings';
        $options = array(
            'timesheet_apply_settings',
            'timesheet_disable_prev_month',
            'timesheet_disable_next_month',
            'timesheet_enable_prev_days',
            'timesheet_enable_next_days'
        );
        $this->data['options'] = $this->settings_model->get_option($options);
        $this->data['maincontent'] = $this->load->view($this->router->class.'/timesheet_settings', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
}

?>
