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
        $is_logged_in = $this->app_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.'user/login');
        }
        // Get logged  in user id
        $this->sess_user_id = $this->app_lib->get_sess_user('id');
        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->app_lib->init_template_elements();
        // Load required js files for this controller
        $javascript_files = array(
            $this->router->class
        );
        $this->data['app_js'] = $this->app_lib->add_javascript($javascript_files);
        $this->load->model('cms_model');
        $this->id = $this->uri->segment(3);
        $this->data['arr_content_type'] = $this->cms_model->get_pagecontent_type();
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('CMS', '/cms');		
        $this->data['breadcrumbs'] = $this->breadcrumbs->show();
        
        $this->data['arr_status_flag'] = array(
            'Y'=>array('text'=>'Active', 'css'=>'badge badge-success badge-pill'),
            'N'=>array('text'=>'Inactive', 'css'=>'badge badge-warning badge-pill'),
            'A'=>array('text'=>'Archived', 'css'=>'badge badge-danger badge-pill')
        );
		$this->data['arr_holiday_type'] = array(''=>'Select','C'=>'Calendar','O'=>'Optional');
		//Pagination
		 $this->load->library('pagination');
		
    }

    function index() {
        //Has logged in user permission to access this page or method?        
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		
		// Get logged  in user id
        $this->sess_user_id = $this->app_lib->get_sess_user('id');
			
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Posts';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function index_ci_pagination() {
        //Has logged in user permission to access this page or method?
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
			
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();

        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->cms_model->get_rows(NULL, NULL, NULL, FALSE, FALSE);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 3;
        $config['uri_segment'] = 4; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $this->data['pagination_link'] = $this->app_lib->render_pagination($total_num_rows, $per_page);
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
            $row[] = character_limiter($result['content_title'], 45);
            $row[] = $result['content_type'];
            $row[] = $this->app_lib->display_date($result['content_created_on'], true);
            $row[] = '<span title="'.$result['user_firstname'].' '.$result['user_lastname'].'">'.$result['user_emp_id'].'</span>';
            $row[] = '<span class="'.$this->data['arr_status_flag'][$result['content_status']]['css'].'"> '.$this->data['arr_status_flag'][$result['content_status']]['text'].'</span>';
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' .$result['id']), $this->app_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'btn btn-datatable btn-icon btn-transparent-dark ',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), $this->app_lib->get_icon('delete','dt_action_icon'), array(
                'class' => 'btn btn-datatable btn-icon btn-transparent-dark  btn-delete',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
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
        //Has logged in user permission to access this page or method?
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Add','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_form_data('add') == true) {

                $postdata = array(
                    'content_type' => $this->input->post('content_type'),
                    'content_title' => $this->input->post('content_title'),
                    'content_text' => $this->input->post('content_text'),
                    'content_meta_keywords' => $this->input->post('content_meta_keywords'),
                    'content_meta_description' => $this->input->post('content_meta_description'),
                    'content_display_from_date' => $this->app_lib->convert_to_mysql($this->input->post('content_display_from_date')),
                    'content_display_to_date' => $this->app_lib->convert_to_mysql($this->input->post('content_display_to_date')),
                    'content_meta_author' => $this->input->post('content_meta_author'),
                    'content_created_by' => $this->sess_user_id,
					'content_status' => $this->input->post('content_status'),
					'content_created_on' => date('Y-m-d H:i:s')
                );
                $insert_id = $this->cms_model->insert($postdata);
                
                if ($insert_id) {
                    $this->app_lib->set_flash_message('Data Added Successfully.','alert-success');
                    
                    if($this->input->post('send_email_notification') == 'Y' || $this->input->post('send_email_notification_2') == 'Y'){
                        $this->send_email_notification($postdata['content_type'], $postdata['content_title'], $postdata['content_text']);
                    }
                    redirect($this->router->directory.$this->router->class.'/add');
                }
            }
        }
		$this->data['page_title'] = 'New Post';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function edit() {
        //Has logged in user permission to access this page or method?
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Edit','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_form_data('edit') == true) {
                $postdata = array(
                    'content_type' => $this->input->post('content_type'),
                    'content_title' => $this->input->post('content_title'),
                    'content_text' => $this->input->post('content_text'),
                    'content_meta_keywords' => $this->input->post('content_meta_keywords'),
                    'content_meta_description' => $this->input->post('content_meta_description'),
                    'content_meta_author' => $this->input->post('content_meta_author'),
                    'content_status' => $this->input->post('content_status'),
					'content_display_from_date' => $this->app_lib->convert_to_mysql($this->input->post('content_display_from_date')),
                    'content_display_to_date' => $this->app_lib->convert_to_mysql($this->input->post('content_display_to_date')),
                    'content_archived' => $this->input->post('content_archived'),
					'content_updated_by' => $this->sess_user_id,
                    'content_updated_on' => date('Y-m-d H:i:s'),
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->cms_model->update($postdata, $where_array);
                
                if($this->input->post('send_email_notification') == 'Y' || $this->input->post('send_email_notification_2') == 'Y'){
                    $this->send_email_notification($postdata['content_type'], $postdata['content_title'], $postdata['content_text']);
                }

                if ($res) {
                    $this->app_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->cms_model->get_rows($this->id);
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_title'] = 'Edit Post';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function delete() {
        //Has logged in user permission to access this page or method?
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
        $where_array = array('id' => $this->id);
        $res = $this->cms_model->delete($where_array);
        if ($res) {
            $this->app_lib->set_flash_message('Data has been deleted successfully.','alert-success');
            redirect($this->router->directory.$this->router->class);
        }
    }

    function validate_form_data($action = NULL) {
        $this->form_validation->set_rules('content_type', ' ', 'required');
        $this->form_validation->set_rules('content_title', ' ', 'required');
        $this->form_validation->set_rules('content_text', ' ', 'required');
        $this->form_validation->set_rules('content_status', ' ', 'required');

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
        $sess_user_firstname = $this->app_lib->get_sess_user('user_firstname');
        $sess_user_lastname = $this->app_lib->get_sess_user('user_lastname');
        $sess_user_email = $this->app_lib->get_sess_user('user_email');

        $this->email->from($sess_user_email, $sess_user_firstname.' '.$sess_user_lastname);
        $this->email->subject($this->config->item('app_email_subject_prefix').' '.$subject);
        $this->email->message($message_html);
        $this->email->send();
        //echo $this->email->print_debugger();
        //die();
    }

    function manage_holidays() {
        //Has logged in user permission to access this page or method?        
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Manage Holidays';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/manage_holidays', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_holiday_datatable() {
        //Has logged in user permission to access this page or method?        
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
        //Total rows - Refer to model method definition
        $result_array = $this->cms_model->get_holiday_data_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->cms_model->get_holiday_data_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_holiday_data_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $this->app_lib->display_date($result['holiday_date'], null, null, 'd-M-Y');
            $row[] = $this->app_lib->display_date($result['holiday_date'], null, null, 'D');
            $row[] = $result['holiday_description'];
            $row[] = $this->data['arr_holiday_type'][$result['holiday_type']];
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_holiday/' . $result['id']), $this->app_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'btn btn-datatable btn-icon btn-transparent-dark ',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete_holiday/' . $result['id']), $this->app_lib->get_icon('delete','dt_action_icon'), array(
                'class' => 'btn btn-datatable btn-icon btn-transparent-dark  btn-delete',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
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

    function add_holiday() {
        //Has logged in user permission to access this page or method?        
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
		$this->breadcrumbs->push('Add','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_holiday_form_data('add') == true) {
                $postdata = array(
                    'holiday_date' => $this->app_lib->convert_to_mysql($this->input->post('holiday_date')),
                    'holiday_description' => $this->input->post('holiday_description'),
                    'holiday_type' => $this->input->post('holiday_type')
                );
                $insert_id = $this->cms_model->insert($postdata, 'holidays');
                if ($insert_id) {
                    $this->app_lib->set_flash_message('Data Added Successfully.','alert-success');
                    redirect($this->router->directory.$this->router->class.'/manage_holidays');
                }
            }
        }
		$this->data['page_title'] = 'Add New Holiday';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_holiday', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function edit_holiday() {
        //Has logged in user permission to access this page or method?        
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
		$this->breadcrumbs->push('Edit','/');
        $this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_holiday_form_data('edit') == true) {
                $postdata = array(
                    'holiday_date' => $this->app_lib->convert_to_mysql($this->input->post('holiday_date')),
                    'holiday_description' => $this->input->post('holiday_description'),
                    'holiday_type' => $this->input->post('holiday_type')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->cms_model->update($postdata, $where_array, 'holidays');
                if ($res) {
                    $this->app_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect($this->router->directory.$this->router->class.'/manage_holidays');
                }
            }
        }
        $result_array = $this->cms_model->get_holiday_data_rows($this->uri->segment(3));
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_title'] = 'Edit Holiday';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_holiday', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function delete_holiday() {
        //Has logged in user permission to access this page or method?        
        $this->app_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
        $where_array = array('id' => $this->id);
        $res = $this->cms_model->delete($where_array, 'holidays');
        if ($res) {
            $this->app_lib->set_flash_message('Data Deleted Successfully.','alert-success');
            redirect($this->router->directory.$this->router->class.'/manage_holidays');
        }
    }

    function validate_holiday_form_data($action = NULL) {
		if($action == 'add'){			
			$this->form_validation->set_rules('holiday_date', 'holiday date', 'required|is_unique[holidays.holiday_date]',array(
                'is_unique'     => 'This %s already exists.'
        ));
		}
		if($action == 'edit'){
			$this->form_validation->set_rules('holiday_date', 'holiday date', 'required');
		}
        $this->form_validation->set_rules('holiday_description', 'holiday occasion', 'required');
        $this->form_validation->set_rules('holiday_type', 'holiday type', 'required');

        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function list_of_holidays() {
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$result_array = $this->cms_model->get_holidays(NULL, NULL, NULL, FALSE, FALSE);
        $this->data['data_rows'] = $result_array['data_rows'];
		$this->data['page_title'] = 'Holiday List';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/list_of_holidays', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
}
?>