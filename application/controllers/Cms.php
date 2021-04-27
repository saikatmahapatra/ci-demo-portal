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
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		
		// Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
			
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Posts';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function index_ci_pagination() {
        //Has logged in user permission to access this page or method?
        $this->common_lib->is_auth(array(
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
            $row[] = character_limiter($result['content_title'], 45);
            $row[] = $result['content_type'];
            $row[] = $this->common_lib->display_date($result['content_created_on'], true);
            $row[] = '<span title="'.$result['user_firstname'].' '.$result['user_lastname'].'">'.$result['user_emp_id'].'</span>';
            $row[] = '<span class="'.$this->data['arr_status_flag'][$result['content_status']]['css'].'"> '.$this->data['arr_status_flag'][$result['content_status']]['text'].'</span>';
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' .$result['id']), $this->common_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'btn btn-datatable btn-icon btn-transparent-dark ',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), $this->common_lib->get_icon('delete','dt_action_icon'), array(
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
        $this->common_lib->is_auth(array(
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
                    'content_display_from_date' => $this->common_lib->convert_to_mysql($this->input->post('content_display_from_date')),
                    'content_display_to_date' => $this->common_lib->convert_to_mysql($this->input->post('content_display_to_date')),
                    'content_meta_author' => $this->input->post('content_meta_author'),
                    'content_created_by' => $this->sess_user_id,
					'content_status' => $this->input->post('content_status'),
					'content_created_on' => date('Y-m-d H:i:s')
                );
                $insert_id = $this->cms_model->insert($postdata);
                
                if ($insert_id) {
                    $this->common_lib->set_flash_message('Data Added Successfully.','alert-success');
                    
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
        $this->common_lib->is_auth(array(
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
					'content_display_from_date' => $this->common_lib->convert_to_mysql($this->input->post('content_display_from_date')),
                    'content_display_to_date' => $this->common_lib->convert_to_mysql($this->input->post('content_display_to_date')),
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
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
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
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
        $where_array = array('id' => $this->id);
        $res = $this->cms_model->delete($where_array);
        if ($res) {
            $this->common_lib->set_flash_message('Data has been deleted successfully.','alert-success');
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

    function manage_holidays() {
        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
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
        $this->common_lib->is_auth(array(
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
            $row[] = $this->common_lib->display_date($result['holiday_date'], null, null, 'd-M-Y');
            $row[] = $this->common_lib->display_date($result['holiday_date'], null, null, 'D');
            $row[] = $result['holiday_description'];
            $row[] = $this->data['arr_holiday_type'][$result['holiday_type']];
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_holiday/' . $result['id']), $this->common_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'btn btn-datatable btn-icon btn-transparent-dark ',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete_holiday/' . $result['id']), $this->common_lib->get_icon('delete','dt_action_icon'), array(
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
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
		$this->breadcrumbs->push('Add','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_holiday_form_data('add') == true) {
                $postdata = array(
                    'holiday_date' => $this->common_lib->convert_to_mysql($this->input->post('holiday_date')),
                    'holiday_description' => $this->input->post('holiday_description'),
                    'holiday_type' => $this->input->post('holiday_type')
                );
                $insert_id = $this->cms_model->insert($postdata, 'holidays');
                if ($insert_id) {
                    $this->common_lib->set_flash_message('Data Added Successfully.','alert-success');
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
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
		$this->breadcrumbs->push('Edit','/');
        $this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_holiday_form_data('edit') == true) {
                $postdata = array(
                    'holiday_date' => $this->common_lib->convert_to_mysql($this->input->post('holiday_date')),
                    'holiday_description' => $this->input->post('holiday_description'),
                    'holiday_type' => $this->input->post('holiday_type')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->cms_model->update($postdata, $where_array, 'holidays');
                if ($res) {
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
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
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-holiday-access',
        ));
        $where_array = array('id' => $this->id);
        $res = $this->cms_model->delete($where_array, 'holidays');
        if ($res) {
            $this->common_lib->set_flash_message('Data Deleted Successfully.','alert-success');
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

    #### Banner Slider Section ###
	function render_banner_datatable() {		
        //Total rows - Refer to model method definition
		$cond = array(
			'upload_related_to' => 'slider',
			'upload_related_to_id' => NULL,
			'upload_file_type_name' => NULL
		);
        $result_array = $this->cms_model->get_uploads(NULL, NULL, NULL, FALSE, FALSE, $cond);
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->cms_model->get_uploads(NULL, NULL, NULL, TRUE, FALSE, $cond);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_uploads(NULL, NULL, NULL, TRUE, TRUE, $cond);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
			
			$img_src = "";
			$default_path = "assets/src/img/no-image.png";
			if(isset($result['upload_file_name'])){					
				$banner_img = "assets/uploads/banner_img/".$result['upload_file_name'];					
				if (file_exists(FCPATH . $banner_img)) {
					$img_src = $banner_img;
				}else{
					$img_src = $default_path;
				}
			}else{
				$img_src = $default_path;
			}
            //$row[] = $result['upload_file_name'].'<div>'.$result['upload_mime_type'].'</div>';
            $row[] = '<img class="img banner-img-xs" src="'.base_url($img_src).'"><div>'.$result['upload_mime_type'].'</div>';
            //$row[] = $result['upload_mime_type'];
            //$row[] = $this->common_lib->display_date($result['upload_datetime'], TRUE);
            $row[] = isset($result['upload_status']) ? $this->data['arr_status_flag'][$result['upload_status']]['text'] : '';
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_banner/' .$result['id']), '<i class="fa fa-fw fa-pencil" aria-hidden="TRUE"></i>', array(
                'class' => 'btn btn-sm btn-outline-secondary',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete_banner/' . $result['id'].'/'.$result['upload_file_name']), '<i class="fa fa-fw fa-trash-o" aria-hidden="TRUE"></i>', array(
                'class' => 'btn btn-sm btn-outline-danger btn-delete',
				'data-confirmation'=>TRUE,
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

	function manage_banner() {
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
			
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Image Slider Manager';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/manage_banner', $this->data, TRUE);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function add_banner() {
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Add','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'insert') {
			$this->upload_file();
        }
		$this->data['page_title'] = 'Add New Slider Image';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_banner', $this->data, TRUE);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function edit_banner() {
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Edit','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
			$this->upload_file();
        }
		$result_array = $this->cms_model->get_uploads($this->id, NULL, NULL, FALSE, FALSE, NULL);
        $this->data['rows'] = $result_array['data_rows'];		
		$this->data['page_title'] = 'Edit Slider Image';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_banner', $this->data, TRUE);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function delete_banner(){
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$uploaded_file_id = $this->uri->segment(3);
		$uploaded_file_name = $this->uri->segment(4);
		//if($uploaded_file_name){
			//Unlink previously uploaded file
			$file_path = 'assets/uploads/banner_img/'.$uploaded_file_name;
			//if (file_exists(FCPATH . $file_path)) {
				$this->common_lib->unlink_file(array(FCPATH . $file_path));
				$res = $this->cms_model->delete(array('id'=>$uploaded_file_id),'uploads');
				if($res){
					$this->common_lib->set_flash_message('Banner has been deleted successfully.', 'alert-success');
					redirect($this->router->directory.$this->router->class.'/manage_banner');
				}else{
					$this->common_lib->set_flash_message('Error occured while processing your request.', 'alert-danger');
					redirect($this->router->directory.$this->router->class.'/manage_banner');
				}
			//}
		//}
	}
	
	function validate_banner_form_data($action = NULL) {        
        $this->form_validation->set_rules('upload_status', 'upload status', 'required');
		if(($this->input->post('form_action') == 'insert') && (empty($_FILES['userfile']['name']))){
			$this->form_validation->set_rules('userfile', 'file', 'required');
		}
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	function upload_file() {
        if ($this->validate_banner_form_data() == TRUE) {
            $upload_related_to = 'slider'; // related to user, product, album, contents etc
            $upload_related_to_id = $this->id; // related to id user id, product id, album id etc
            $upload_file_type_name = $this->input->post('upload_file_type_name'); // file type name            
			$upload_text_1 = $this->input->post('upload_text_1');
            $upload_text_2 = $this->input->post('upload_text_2');
            $upload_text_3 = $this->input->post('upload_text_3');
            $upload_status = $this->input->post('upload_status');
			$upload_id = $this->input->post('id');

            //Create directory for object specific
            $upload_path = 'assets/uploads/banner_img';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }
            $allowed_ext = 'png|jpg|jpeg|doc|docx|pdf';
            if ($upload_file_type_name == 'slider_img') {
                $allowed_ext = 'png|jpg|jpeg';
            }
            $upload_param = array(
                'upload_path' => $upload_path, // original upload folder
                'allowed_types' => $allowed_ext, // allowed file types,
                'max_size' => '2048', // max 2MB size,
                'file_new_name' => $upload_related_to_id . '_' . $upload_file_type_name . '_' . time(),
				'check_img_size'=> FALSE, //only specific dimention image are uploadable
				'allowed_img_width'=> 1200, // int img dimention
				'allowed_img_height'=>300 // int img dimention
            );
			
			// If user chhose file to upload
			if(!empty($_FILES['userfile']['name'])){
				$upload_result = $this->common_lib->upload_file('userfile', $upload_param);
				if (isset($upload_result['file_name']) && empty($upload_result['upload_error'])) {
					$uploaded_file_name = $upload_result['file_name'];
					$postdata = array(
						'upload_related_to' => $upload_related_to,
						'upload_related_to_id' => $upload_related_to_id,
						'upload_file_type_name' => $upload_file_type_name,
						'upload_file_name' => $uploaded_file_name,
						'upload_mime_type' => $upload_result['file_type'],									
						'upload_by_user_id' => $this->sess_user_id,
						'upload_is_featured'=>'N',
						'upload_is_verified' => 'N',
						//'upload_status'=>$upload_status,
						'upload_datetime' => date('Y-m-d H:i:s'),
						'upload_text_1' => $upload_text_1,
						'upload_text_2' => $upload_text_2,
						'upload_text_3' => $upload_text_3,					
					);

					
					if($this->input->post('form_action') == 'update'){
						$upload_data = $this->cms_model->get_uploads($upload_id, NULL, NULL, FALSE, FALSE, NULL);
						$uploads = $upload_data['data_rows'];
					}else{
						// Allow mutiple file upload for a file type.
						$multiple_allowed_upload_file_type = array('slider_img');
						if (!in_array($upload_file_type_name, $multiple_allowed_upload_file_type)) {
							$cond = array(
								'upload_related_to' => $upload_related_to,
								'upload_related_to_id' => $upload_related_to_id,
								'upload_file_type_name' => $upload_file_type_name
							);
							$upload_data = $this->cms_model->get_uploads(NULL, NULL, NULL, FALSE, FALSE, $cond);
							$uploads = $upload_data['data_rows'];
						}
					}
					//print_r($uploads); die();
					
					if (isset($uploads[0]) && ($uploads[0]['id'] != '')) {
						//Unlink previously uploaded file                    
						$file_path = $upload_param['upload_path'] . '/' . $uploads[0]['upload_file_name'];
						if (file_exists(FCPATH . $file_path)) {
							$this->common_lib->unlink_file(array(FCPATH . $file_path));
						}
						// Now update table
						$update_upload = $this->cms_model->update($postdata, array('id' => $uploads[0]['id']), 'uploads');
						$this->common_lib->set_flash_message('File uploaded successfully.', 'alert-success');
						redirect(current_url());
					} else {
						$upload_insert_id = $this->cms_model->insert($postdata, 'uploads');
						$this->common_lib->set_flash_message('File uploaded successfully.', 'alert-success');
						redirect(current_url());
					}
				} else if (sizeof($upload_result['upload_error']) > 0) {
					$error_message = $upload_result['upload_error'];
					$this->common_lib->set_flash_message($error_message, 'alert-danger');
					redirect(current_url());
				}
			}
			//if user only update text etc not changing images
			else{
				$postdata = array(
						'upload_status'=>$upload_status,						
						'upload_text_1' => $upload_text_1,
						'upload_text_2' => $upload_text_2,
						'upload_text_3' => $upload_text_3,					
					);
				$id = $this->input->post('id');
				$update_upload = $this->cms_model->update($postdata, array('id' => $id), 'uploads');
				$this->common_lib->set_flash_message('Data updated successfully.', 'alert-success');
				redirect(current_url());
			}
			
            
        }
    }

    function image_crop_upload() {
        print_r($_POST);
        die();
    }
}
?>