<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave extends CI_Controller {

    var $data;
	var $id;
    var $sess_user_id;
    var $sess_user_emp_id;

    function __construct() {
        parent::__construct();
        //Loggedin user details
        $this->sess_user_id = $this->common_lib->get_sess_user('id');
        $this->sess_user_emp_id = $this->common_lib->get_sess_user('user_emp_id'); 
        
        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();
        
        //add required js files for this controller
        $app_js_src = array(
			'assets/dist/js/'.$this->router->class.'.js', //create js file name same as controller name
		);         
        $this->data['app_js'] = $this->common_lib->add_javascript($app_js_src);
		        
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
		
		//Check if any user logged in else redirect to login
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.'user/login');
        }

        //Has logged in user permission to access this page or method?        
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-user-access'			
        ));
		
        $this->load->model('leave_model');
        $this->load->model('user_model');
		$this->id = $this->uri->segment(3);
		
		
		$this->data['leave_type_arr'] = array(''=>'-Select-','CL'=>'Casual Leave','PL'=>'Privileged Leave','OL'=>'Optional Leave');
		$this->data['leave_status_arr'] = array(
            'P'=>array('text'=>'Pending', 'css'=>'text-secondary'),
            'C'=>array('text'=>'Cancelled', 'css'=>'text-warning'),
            'R'=>array('text'=>'Rejected', 'css'=>'text-danger'),
            'A'=>array('text'=>'Approved', 'css'=>'text-success'),
            'O'=>array('text'=>'Processing', 'css'=>'text-info')
        );
		
		
		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
        
    }

    function index(){
        $this->apply();
    }
	
	function apply() {				
		$this->data['page_heading'] = 'Apply Leave';		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');        
        $this->data['approvers'] = $this->user_model->get_user_approvers($this->sess_user_id);
        //print_r($this->data['approvers']);
        $supervisor_approver_id = isset($this->data['approvers'][0]['user_supervisor_id']) ? $this->data['approvers'][0]['user_supervisor_id'] : '';
        $director_approver_id = isset($this->data['approvers'][0]['user_director_approver_id']) ? $this->data['approvers'][0]['user_director_approver_id'] : '';
        $hr_approver_id = isset($this->data['approvers'][0]['user_hr_approver_id']) ? $this->data['approvers'][0]['user_hr_approver_id'] : '';
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_form_data('add') == true) {  
                $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_from_date'))); // or your date as well
                $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_to_date')));
                $datediff = ($to_date - $from_date);
                $no_day = round($datediff / (60 * 60 * 24));
                //die();
                $leave_request_id = 'LR-'.(isset($this->sess_user_emp_id)?$this->sess_user_emp_id:'').time();              
				$postdata = array(                    
                    'leave_req_id' => $leave_request_id,
                    'leave_type' => $this->input->post('leave_type'),
                    'leave_reason' => $this->input->post('leave_reason'),
                    'leave_from_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_from_date')),
                    'leave_to_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_to_date')),
                    'user_id' => $this->sess_user_id,					
                    'leave_created_on' => date('Y-m-d H:i:s'),
                    'leave_status' => 'P',
                    'supervisor_approver_id'=> $supervisor_approver_id,
                    'supervisor_approver_status'=>'P',
                    'director_approver_id'=>$director_approver_id,
                    'director_approver_status'=>'P',
                    'hr_approver_id'=>$hr_approver_id,
                    'hr_approver_status'=>'P'
                );
                $insert_id = $this->leave_model->insert($postdata);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', 'Your Leave Request <strong>#'.$leave_request_id.'</strong> has been generated successfully. Here is the details of your leave request.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/details/'.$insert_id.'/'.$leave_request_id);
                }
            }
        }        
        $this->data['maincontent'] = $this->load->view($this->router->class.'/apply', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function history() {
        $this->data['page_heading'] = 'Leave History';
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');		
        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->leave_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, $this->sess_user_id);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 10;
        $config['uri_segment'] = 4; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page);
        //Pagination config ends here
        

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE, $this->sess_user_id);
        $this->data['data_rows'] = $result_array['data_rows'];

        $this->data['maincontent'] = $this->load->view($this->router->class.'/history', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function manage() {
        $this->data['page_heading'] = 'Leave Management';
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');		
        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->leave_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, NULL);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 10;
        $config['uri_segment'] = 4; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page);
        //Pagination config ends here
        

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE, NULL);
        $this->data['data_rows'] = $result_array['data_rows'];

        $this->data['maincontent'] = $this->load->view($this->router->class.'/manage', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function validate_form_data($action = NULL) {
        $this->form_validation->set_rules('leave_type', ' ', 'required');
        $this->form_validation->set_rules('leave_reason', ' ', 'required|max_length[100]');
        $this->form_validation->set_rules('leave_from_date', ' ', 'required');
        $this->form_validation->set_rules('leave_to_date', ' ', 'required|callback_validate_days_diff|callback_is_leave_exists_in_date_range');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_days_diff(){
        $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_from_date'))); // or your date as well
        $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_to_date')));
        $datediff = ($to_date - $from_date);
        $no_day = round($datediff / (60 * 60 * 24));
        if($no_day >= 0 ){
            return true;
        }else{
            $this->form_validation->set_message('validate_days_diff', 'Invalid date range.');
            return false;
        }
    }

    function is_leave_exists_in_date_range(){       
        $cond = array(
            'from_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_from_date')),
            'to_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_to_date')),
            'user_id' => $this->sess_user_id
        );
        $res = $this->leave_model->check_leave_date_range($cond);
        if($res > 0){
            $this->form_validation->set_message('is_leave_exists_in_date_range', 'Leave date exists.');
            return false;
        }
        else{            
            return true;
        }
    }
	
	function render_datatable() {
		$year = $this->input->get_post('year') ? $this->input->get_post('year') : date('Y');
		$month = $this->input->get_post('month') ? $this->input->get_post('month') : date('m');	
        //Total rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, TRUE, $year, $month);
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, NULL, NULL, TRUE, FALSE, TRUE, $year, $month);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, NULL, NULL, TRUE, TRUE, TRUE, $year, $month);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            //$row[] = $this->common_lib->display_date($result['timesheet_date']);
            //$row[] = $result['project_name'];
            //$row[] = $result['task_activity_name'];
            //$row[] = $result['timesheet_hours'];
            //$row[] = $result['timesheet_review_status'];
			
			$html = '<div class="font-weight-bold">'.$this->common_lib->display_date($result['timesheet_date']).' <span class="float-right">'.$result['timesheet_hours'].' hrs</span></div>';			
			$html.= '<div class="small">'.$result['project_name'].'<span class="float-right">'.$result['task_activity_name'].'</span></div>';			
			
            
            //add html for action
            $action_html = '<span class="float-right">';
            /*$action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' . $result['id']), '<i class="fa fa-edit" aria-hidden="true"></i>', array(
                'class' => 'text-dark mr-2',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));*/            
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), '<i class="fa fa-trash" aria-hidden="true"></i>', array(
                'class' => 'text-danger btn-delete ml-2',
				'data-confirmation'=>false,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Delete',
                'title' => 'Delete',
            ));
			$action_html.='</span>';
			$html.= '<div>'.$result['timesheet_description'].' '.$action_html.'</div>';		
			//$html.=$action_html;

            //$row[] = $action_html;
			$row[] = $html;
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
	
	function delete() {		
        $where_array = array('id' => $this->id);
        $res = $this->leave_model->delete($where_array);
        if ($res) {
            $this->session->set_flashdata('flash_message', 'Leave Entry Deleted Successfully');
            $this->session->set_flashdata('flash_message_css', 'alert-success');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

    function details() {				
        $this->data['page_heading'] = 'Leave Details';   
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');   
        $result_array = $this->leave_model->get_rows($this->id, NULL, NULL, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
        $this->data['maincontent'] = $this->load->view($this->router->class.'/details', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function details_process() {				
        $this->data['page_heading'] = 'Manage Leave Request';   
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');   
        $result_array = $this->leave_model->get_rows($this->id, NULL, NULL, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
        $this->data['maincontent'] = $this->load->view($this->router->class.'/details_process', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function leave_balance() {        
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_form_data() == true) {                                
				$postdata = array(                    
                    'leave_req_id' => $leave_request_id,
                    'leave_type' => $this->input->post('leave_type'),
                    'leave_reason' => $this->input->post('leave_reason'),
                    'leave_from_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_from_date')),
                    'leave_to_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_to_date')),
                    'user_id' => $this->sess_user_id,					
                    'leave_created_on' => date('Y-m-d H:i:s')
                );
                $insert_id = $this->leave_model->insert($postdata);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', 'Your Leave Request <strong>#'.$leave_request_id.'</strong> has been generated successfully. Supervisor and HR will get leave notification and work on it.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
        $this->data['maincontent'] = $this->load->view($this->router->class.'/leave_balance', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function update_leave_status(){
        $message = array('is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>'');
        if(($this->input->post('action')=='update')){
            $leave_id = $this->input->post('leave_id');
            $leave_req_id = $this->input->post('leave_req_id');
            $action_by_approver = $this->input->post('action_by_approver');
            $action_by_approver_id = $this->input->post('action_by_approver_id');
            $leave_staus = $this->input->post('leave_staus');
            $leave_comments = $this->input->post('leave_comments');

            //print_r($_POST);die();

            if ($this->validate_update_leave_status_form_data() == true) {
                
                if($action_by_approver == 'applicant'){                    
                    $postdata = array(					
                        'leave_status' => $leave_staus,
                        'cancelled_by' => $action_by_approver_id,
                        'cancellation_reason'=>$leave_comments,
                        'cancellation_datetime' => date('Y-m-d H:i:s')
                    );
                    $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                    $is_update = $this->leave_model->update($postdata, $where, 'user_leaves');

                }
                if($action_by_approver == 'supervisor'){
                    if($leave_staus == 'R'){
                        $final_leave_status = 'R'; // rejected
                    }
                    if($leave_staus == 'A'){
                        $final_leave_status = 'O'; // processing
                    }
                    $postdata = array(					
                        'leave_status' => $final_leave_status,
                        'supervisor_approver_status' => $leave_staus,
                        'supervisor_approver_id' => $action_by_approver_id,
                        'supervisor_approver_comment'=>$leave_comments,
                        'supervisor_approver_datetime' => date('Y-m-d H:i:s')
                    );
                    $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                    $is_update = $this->leave_model->update($postdata, $where, 'user_leaves');
                }
                if($action_by_approver == 'director'){
                    if($leave_staus == 'R'){
                        $final_leave_status = 'R'; // rejected
                    }
                    if($leave_staus == 'A'){
                        $final_leave_status = 'A'; // approved
                    }
                    $postdata = array(
                        'leave_status' => $final_leave_status,					
                        'director_approver_status' => $leave_staus,
                        'director_approver_id' => $action_by_approver_id,
                        'director_approver_comment'=>$leave_comments,
                        'director_approver_datetime' => date('Y-m-d H:i:s')
                    );
                    $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                    $is_update = $this->leave_model->update($postdata, $where, 'user_leaves');
                }
                
                if ($is_update) {
                    $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>'<div class="alert alert-success">leave has been updated succesfully.</div>'); 
                }
            }else{
                $message = array('is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>validation_errors()); 
            }
        }
        echo json_encode($message); die();
    }

    function validate_update_leave_status_form_data($action = NULL) {
        $this->form_validation->set_rules('action_by_approver_id', '', 'required|callback_validate_approver_authorization');
        $this->form_validation->set_rules('leave_staus', 'status', 'required');
        $this->form_validation->set_rules('leave_comments', 'comment', 'required|max_length[100]');
        $this->form_validation->set_error_delimiters('<li class="validation-error">', '</li>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_approver_authorization(){
        $action_by_approver_id = $this->input->post('action_by_approver_id');
        if ($this->sess_user_id != $action_by_approver_id) {
            $this->form_validation->set_message('validate_approver_authorization', 'You are not authorized to do this action.');
            return false;
        }

        // do logic for status update by supervisor or director
        return true;
    }

}

?>
