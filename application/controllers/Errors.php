<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Errors extends CI_Controller {

    var $data;

    function __construct() {
        parent::__construct();
        
        //Loggedin user details
        //$this->sess_user_id = $this->common_lib->get_sess_user('id');        
        
        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();
        
        //add required js files for this controller
        $app_js_src = array();
        $this->data['app_js'] = $this->common_lib->add_javascript($app_js_src);
		
		//View Page Config
		$this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
    }

    function index() {
        $this->page_not_found();
    }

    function page_not_found() {
        $data = array();
		$this->data['page_heading'] = "Oops! 404 Not Found";
        $this->data['maincontent'] = $this->load->view('errors/error_404', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function auth() {
		$data = array();
		$this->data['page_heading'] = "Oops! Authorization Error";
        $this->data['maincontent'] = $this->load->view('errors/auth_error', $this->data, true);
        $this->load->view('_layouts/layout_login', $this->data);
    }

}
