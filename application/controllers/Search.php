<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller {

    var $data;    
    var $sess_user_id;

    function __construct() {
        parent::__construct();

        //Check if any user logged in else redirect to login
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.'user/login');
        }

        // Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');

        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();

        //add required js files for this controller
        $app_js_src = array(
            //'assets/dist/js/'.$this->router->class.'.js', //create js file name same as controller name
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($app_js_src);

        
        $this->load->model('user_model');
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        

        //View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
        $this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Search', '/search');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
		//Pagination
		 $this->load->library('pagination');
		
    }

    function index() {
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.$this->router->class.'/login');
        }               
		$this->breadcrumbs->push('Search', '/');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        $search_keywords = NULL;
        if($this->input->get_post('form_action') == 'search' && $this->input->get_post('q')){
            $search_keywords = $this->input->get_post('q');
                        
            // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
            $result_array = $this->user_model->get_users(NULL, NULL, NULL, $search_keywords, 'U');
            $total_num_rows = $result_array['num_rows'];
            
            //pagination config
            $additional_segment = $this->router->class.'/'.$this->router->method;
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
            $result_array = $this->user_model->get_users(NULL, $per_page, $offset, $search_keywords, 'U');
            $this->data['data_rows'] = $result_array['data_rows'];
        }
        //die($search_keywords);

		$this->data['page_heading'] = 'Search Result';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
}

?>
