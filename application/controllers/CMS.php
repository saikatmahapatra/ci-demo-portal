<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

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

        // Load required js files for this controller
        $javascript_files = array(
            $this->router->class
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($javascript_files);

        
        $this->load->model('cms_model');
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        $this->id = $this->uri->segment(3);
        $this->data['arr_content_type'] = $this->cms_model->get_pagecontent_type();

        //View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('CMS', '/cms');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
		//Pagination
		 $this->load->library('pagination');
		
    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
		
		// Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		
		$this->data['page_title'] = 'Manage Contents - Recent Updates';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function index_ci_pagination() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->cms_model->get_rows(NULL, NULL, NULL, FALSE, FALSE);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 3;
        $config['uri_segment'] = 4; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page);
        //Pagination config ends here
        

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
		
		$this->data['page_title'] = 'Website Contents (CI Pagination Version)';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index_ci_pagination', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->cms_model->get_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->cms_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();            
            $row[] = $result['pagecontent_title'];
            $row[] = $result['pagecontent_type'];
            $row[] = $this->common_lib->display_date($result['pagecontent_created_on'], true);
            
            $status_indicator = 'text-secondary';            
            if($result['pagecontent_status'] == 'Y'){
                $status_indicator = 'text-success';
            }
            if($result['pagecontent_status'] == 'N'){
                $status_indicator = 'text-warning';
            }
            $row[] = '<i class="fa fa-flash '.$status_indicator.'" aria-hidden="true"></i>';
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' .$result['id']), '<i class="fa fa-edit" aria-hidden="true"></i> Edit', array(
                'class' => 'btn btn-sm btn-outline-secondary mr-1',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), '<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                'class' => 'btn btn-sm btn-outline-danger btn-delete ml-1',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Delete',
                'title' => 'Delete',
            ));

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

    function add() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-add');
        //$this->data['page_title'] = "Add Page Content";
		$this->breadcrumbs->push('Add','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_form_data('add') == true) {

                $postdata = array(
                    'pagecontent_type' => $this->input->post('pagecontent_type'),
                    'pagecontent_title' => $this->input->post('pagecontent_title'),
                    'pagecontent_text' => $this->input->post('pagecontent_text'),
                    'pagecontent_meta_keywords' => $this->input->post('pagecontent_meta_keywords'),
                    'pagecontent_meta_description' => $this->input->post('pagecontent_meta_description'),
                    'pagecontent_display_start_date' => $this->common_lib->convert_to_mysql($this->input->post('pagecontent_display_start_date')),
                    'pagecontent_display_end_date' => $this->common_lib->convert_to_mysql($this->input->post('pagecontent_display_end_date')),
                    'pagecontent_meta_author' => $this->input->post('pagecontent_meta_author'),
                    'pagecontent_user_id' => $this->sess_user_id,
					'pagecontent_status' => $this->input->post('pagecontent_status'),
					'pagecontent_created_on' => date('Y-m-d H:i:s')
                );
                $insert_id = $this->cms_model->insert($postdata);
                
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', 'Data Added Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    
                    if($this->input->post('send_email_notification') == 'Y' || $this->input->post('send_email_notification_2') == 'Y'){
                        $this->send_email_notification($postdata['pagecontent_type'], $postdata['pagecontent_title'], $postdata['pagecontent_text']);
                    }

                    redirect($this->router->directory.$this->router->class.'/add');
                }
            }
        }
		$this->data['page_title'] = 'Add New Content - Recent Updates';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function edit() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-edit');
		//$this->data['page_title'] = "Edit Page Content";
		$this->breadcrumbs->push('Edit','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_form_data('edit') == true) {
                $postdata = array(
                    'pagecontent_type' => $this->input->post('pagecontent_type'),
                    'pagecontent_title' => $this->input->post('pagecontent_title'),
                    'pagecontent_text' => $this->input->post('pagecontent_text'),
                    'pagecontent_meta_keywords' => $this->input->post('pagecontent_meta_keywords'),
                    'pagecontent_meta_description' => $this->input->post('pagecontent_meta_description'),
                    'pagecontent_meta_author' => $this->input->post('pagecontent_meta_author'),
                    'pagecontent_status' => $this->input->post('pagecontent_status'),
					'pagecontent_display_start_date' => $this->common_lib->convert_to_mysql($this->input->post('pagecontent_display_start_date')),
                    'pagecontent_display_end_date' => $this->common_lib->convert_to_mysql($this->input->post('pagecontent_display_end_date')),
                    'pagecontent_archived' => $this->input->post('pagecontent_archived')
					//'pagecontent_user_id' => $this->sess_user_id
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->cms_model->update($postdata, $where_array);
                
                if($this->input->post('send_email_notification') == 'Y' || $this->input->post('send_email_notification_2') == 'Y'){
                    $this->send_email_notification($postdata['pagecontent_type'], $postdata['pagecontent_title'], $postdata['pagecontent_text']);
                }

                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Data Updated Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->cms_model->get_rows($this->id);
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_title'] = 'Edit Content - Recent Updates';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function delete() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-delete');

        $where_array = array('id' => $this->id);
        $res = $this->cms_model->delete($where_array);
        if ($res) {
            $this->session->set_flashdata('flash_message', 'Data Deleted Successfully.');
            $this->session->set_flashdata('flash_message_css', 'alert-success');
            redirect($this->router->directory.$this->router->class);
        }
    }

    function validate_form_data($action = NULL) {
        $this->form_validation->set_rules('pagecontent_type', 'page content type', 'required');
        $this->form_validation->set_rules('pagecontent_title', 'page content title', 'required');
        $this->form_validation->set_rules('pagecontent_text', 'page content text', 'required');
        $this->form_validation->set_rules('pagecontent_status', 'display status', 'required');

        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function send_email_notification($content_type, $subject, $message){
        //print_r($_POST); die();
        //echo "XXXXXXXXX"; die();
        $this->load->model('user_model');
        $send_to_email_arr = $this->user_model->get_user_email(NULL, 'U');
        //print_r($send_to_email_arr['personal']);
        //die();
        $message_html = '';
        $message_html.='<div id="message_wrapper" style="border-top: 2px solid #5133AB;">';
        $message_html.= $this->config->item('app_email_header');
        $message_html.='<div id="message_body" style="padding-top: 5px; padding-bottom:5px;">';
        $message_html.= $message;
        $message_html.='</div><!--/#message_body-->';
        $message_html.= $this->config->item('app_email_footer');
        $message_html.='</div><!--/#message_wrapper-->';
        //echo $message_html; die();
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->to($send_to_email_arr['work']);
        if(isset($_POST['send_email_notification_2']) && $_POST['send_email_notification_2'] == 'Y'){
            //print_r($send_to_email_arr['personal']); die();
            $this->email->cc($send_to_email_arr['personal']);
        }
        //$this->email->to($this->config->item('app_admin_email'));
        //$this->email->bcc($send_to_email_arr);
        $sess_user_firstname = $this->common_lib->get_sess_user('user_firstname');
        $sess_user_lastname = $this->common_lib->get_sess_user('user_lastname');
        $sess_user_email = $this->common_lib->get_sess_user('user_email');

        $this->email->from($sess_user_email, $sess_user_firstname.' '.$sess_user_lastname);
        $this->email->subject($this->config->item('app_email_subject_prefix').' '.$subject);
        $this->email->message($message_html);
        $this->email->send();
        //echo $this->email->print_debugger();
        //die();
    }

}

?>
