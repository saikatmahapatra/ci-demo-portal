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
        $this->data['leave_balance'] = $this->leave_model->get_leave_balance(NULL, NULL, NULL, FALSE, FALSE, $this->sess_user_id);

        //pre apply system requirement check validation
        $system_msg = array();
        //print_r($this->data['leave_balance']);
        $supervisor_approver_id = isset($this->data['approvers'][0]['user_supervisor_id']) ? $this->data['approvers'][0]['user_supervisor_id'] : NULL;
        $supervisor_approver_name = isset($this->data['approvers'][0]['user_supervisor_id']) ? $this->data['approvers'][0]['supervisor_firstname'].' '.$this->data['approvers'][0]['supervisor_lastname'] : NULL;

        $director_approver_id = isset($this->data['approvers'][0]['user_director_approver_id']) ? $this->data['approvers'][0]['user_director_approver_id'] : NULL;
        $director_approver_name = isset($this->data['approvers'][0]['user_director_approver_id']) ? $this->data['approvers'][0]['director_firstname'].' '.$this->data['approvers'][0]['director_lastname']: NULL;

        $hr_approver_id = isset($this->data['approvers'][0]['user_hr_approver_id']) ? $this->data['approvers'][0]['user_hr_approver_id'] : NULL;
        $hr_approver_name = isset($this->data['approvers'][0]['user_hr_approver_id']) ? $this->data['approvers'][0]['hr_firstname'].' '.$this->data['approvers'][0]['hr_lastname'] : NULL;

        
        if($supervisor_approver_id == NULL || $supervisor_approver_id == 0){            
            $system_msg['supervisor'] = array('txt'=>'No supervisor (L1 approver) is tagged. Please contact to your system admin to proceed.', 'css'=>'text-danger', 'has_error'=> true);
        }else{
            $system_msg['supervisor'] = array('txt'=>'Your Supervisor/L1 Approver is '.$supervisor_approver_name.' ('.$this->data['approvers'][0]['supervisor_emp_id'].')', 'css'=>'text-info', 'has_error'=> false);
        }

        if($director_approver_id == NULL || $director_approver_id == 0){
            $system_msg['director'] = array('txt'=>'No director (L2 approver) is tagged. Please contact to your system admin to proceed.', 'css'=>'text-danger', 'has_error'=> true);
        }else{
            $system_msg['director'] = array('txt'=>'Your Director/L2 Approver is '.$director_approver_name.' ('.$this->data['approvers'][0]['director_emp_id'].')', 'css'=>'text-info', 'has_error'=> false);
        }

        if($hr_approver_id == NULL || $hr_approver_id == 0){
            $system_msg['hr'] = array('txt'=>'No HR is tagged. Please contact to your system admin to proceed.', 'css'=>'text-danger', 'has_error'=> true);
        }else{
            $system_msg['hr'] = array('txt'=>'Your HR Approver is '.$hr_approver_name.' ('.$this->data['approvers'][0]['hr_emp_id'].')', 'css'=>'text-info', 'has_error'=> false);
        }

        if(sizeof($this->data['leave_balance'])<=0){
            $system_msg['leave']= array('txt'=>'Your Leave balance is not yet updated in portal database.', 'css'=>'text-danger', 'has_error'=> true);   
        }

        $this->data['system_msg'] = $system_msg;

        $system_msg_error_counter = 0;
        foreach($system_msg as $key=>$val){
            if($val['has_error'] == true){
                $system_msg_error_counter++;
            }
        }
        $this->data['system_msg_error_counter'] = $system_msg_error_counter;
        //pre apply system requirement check validation

        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_form_data('add') == true && $system_msg_error_counter == 0) {  
                $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_from_date'))); // or your date as well
                $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_to_date')));
                $datediff = ($to_date - $from_date);
                $no_day = round($datediff / (60 * 60 * 24));
                //die();
                $leave_request_id = (isset($this->sess_user_id) ? $this->sess_user_id:'').time();
				$postdata = array(                    
                    'leave_req_id' => $leave_request_id,
                    'leave_type' => $this->input->post('leave_type'),
                    'leave_reason' => $this->input->post('leave_reason'),
                    'leave_from_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_from_date')),
                    'leave_to_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_to_date')),
                    'applied_for_days_count' => ($no_day+1),
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

                    ######## Send Email to Applicant ###########
                    $result_array = $this->leave_model->get_rows($insert_id, NULL, NULL, FALSE, TRUE);
                    $data = $result_array['data_rows'][0];
                    //print_r($data);
                    //die();
                    $to = $this->common_lib->get_sess_user('user_email');
                    $from = $this->config->item('app_admin_email');
                    $from_name = $this->config->item('app_admin_email_name');
                    $applicant_name = $data['user_firstname'].' '.$data['user_lastname'];
                    $leave_status = $this->data['leave_status_arr'][$data['leave_status']]['text'];
                    $leave_type = $this->data['leave_type_arr'][$data['leave_type']];
                    $leave_from_to = $this->common_lib->display_date($data['leave_from_date']).' to '.$this->common_lib->display_date($data['leave_to_date']);
                    $leave_reason = $data['leave_reason'];
                    $applied_for_days_count = $data['applied_for_days_count'];
                    
                    $subject= 'Your Leave Request '.$leave_request_id.' is '.$leave_status.' : '.$leave_type .' from '.$leave_from_to;
                    $message = 'You have successfully applied leave. You can track your leave history from '.anchor(base_url('leave/details/'.$data['id'].'/'.$data['leave_req_id'].'/history'));
                    $message_table ='<table border="1">';
                    $message_table.='<tbody>';
                    $message_table.='<tr>';
                    $message_table.='<td>Applicant</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$applicant_name.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Leave Status</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_status.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Leave Type</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_type.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>From - To</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_from_to.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Leave Days</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$applied_for_days_count.' Day(s)</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Reason/Occasion</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_reason.'</td>';
                    $message_table.='</tr>';
                    $message_table.='</tbody>';
                    $message_table.='</table>';
                    
                    $this->send_notification($to, $from, $from_name, $subject, $message.$message_table);

                    ######## Send Email to L1 Approver #########
                    $to = $data['supervisor_email'];
                    $from = $this->config->item('app_admin_email');
                    $from_name = $this->config->item('app_admin_email_name');
                    $leave_status = $this->data['leave_status_arr'][$data['leave_status']]['text'];
                    $leave_type = $this->data['leave_type_arr'][$data['leave_type']];
                    $applicant_name = $data['user_firstname'].' '.$data['user_lastname'];
                    $leave_from_to = $this->common_lib->display_date($data['leave_from_date']).' to '.$this->common_lib->display_date($data['leave_to_date']);
                    $leave_reason = $data['leave_reason'];
                    $applied_for_days_count = $data['applied_for_days_count'];

                    $subject= 'Leave Notification : By '.$applicant_name.' '.$leave_request_id.' is '.$leave_status.' : '.$leave_type .' from '.$leave_from_to;
                    $message = 'You can manage leave request from '.anchor(base_url('leave/manage'));                    
                    $this->send_notification($to, $from, $from_name, $subject, $message.$message_table);

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
        $cond = array(
            'applicant_user_id' =>  $this->sess_user_id
        );
		$result_array = $this->leave_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, $cond);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 30;
        $config['uri_segment'] = 4; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page);
        //Pagination config ends here
        

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE, $cond);
        $this->data['data_rows'] = $result_array['data_rows'];

        $this->data['maincontent'] = $this->load->view($this->router->class.'/history', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function manage() {
        $this->data['page_heading'] = 'Manage Pending Leaves';
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');		
        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition
        $cond = array(
            'assigned_to_user_id' =>  $this->sess_user_id
        );		
		$result_array = $this->leave_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, $cond);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 30;
        $config['uri_segment'] = 4; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page);
        //Pagination config ends here
        

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE, $cond);
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
        // Check user permission by permission name mapped to db
        $is_authorized = $this->common_lib->is_auth(array(
            'crud-leave-balance'
        ));  
        $this->data['page_heading'] = 'Leave Balance Sheet';      
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'leave_balance_update') {
            if ($this->validate_leave_balance_form_data() == true) {
                if($this->input->post('id') != ''){
                    $postdata = array(                    
                        'user_id' => $this->input->post('user_id'),
                        'cl' => $this->input->post('cl'),
                        'pl' => $this->input->post('pl'),
                        'ol' => $this->input->post('ol'),
                        'updated_by' => $this->sess_user_id,					
                        'updated_on' => date('Y-m-d H:i:s')
                    );
                    $where = array('id' => $this->input->post('id'));
                    $insert_id = $this->leave_model->update($postdata, $where, 'user_leave_balance');
                    if ($insert_id) {
                        $this->session->set_flashdata('flash_message', 'Leave Balance Record Updated.');
                        $this->session->set_flashdata('flash_message_css', 'alert-success');
                        redirect(current_url());
                    }
                }else{
                    $postdata = array(                    
                        'user_id' => $this->input->post('user_id'),
                        'cl' => $this->input->post('cl'),
                        'pl' => $this->input->post('pl'),
                        'ol' => $this->input->post('ol'),
                        'created_by' => $this->sess_user_id,					
                        'created_on' => date('Y-m-d H:i:s')
                    );
                    $insert_id = $this->leave_model->insert($postdata, 'user_leave_balance');
                    if ($insert_id) {
                        $this->session->set_flashdata('flash_message', 'Leave Balance Record Created.');
                        $this->session->set_flashdata('flash_message_css', 'alert-success');
                        redirect(current_url());
                    }
                }
            }
        }
        $this->load->model('user_model');
        $this->data['user_dropdwon'] = $this->user_model->get_user_dropdown();
        $this->data['maincontent'] = $this->load->view($this->router->class.'/leave_balance', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_leave_balance_form_data($action = NULL) {
        $this->form_validation->set_rules('user_id', ' ', 'required');
        $this->form_validation->set_rules('cl', ' ', 'required|max_length[6]|numeric|less_than_equal_to[10]
        ');
        $this->form_validation->set_rules('pl', ' ', 'required|max_length[6]|numeric|less_than_equal_to[100]');
        $this->form_validation->set_rules('ol', ' ', 'required|max_length[6]|numeric|less_than_equal_to[5]');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_leave_balance(){
        $message = array('data'=>NULL, 'is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>'');
        if($this->input->post('action') == 'ajax'){
            $applicant_user_id = $this->input->post('user_id');
            $leave_balance = $this->leave_model->get_leave_balance(NULL, NULL, NULL, FALSE, FALSE, $applicant_user_id);
            //echo json_encode($leave_balance[0]);
            if(sizeof($leave_balance)>0){
                $message = array('data'=>$leave_balance[0], 'is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>'');
            }
            
        }
        echo json_encode($message); die();
    }

    function update_leave_status(){
        $messageTxt = '';
        $final_leave_status = '';
        $message = array('is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>'', 'css'=>'alert alert-warning');
        
        if(($this->input->post('action')=='update')){
            $leave_id = $this->input->post('leave_id');
            $leave_req_id = $this->input->post('leave_req_id');
            $action_by_approver = $this->input->post('action_by_approver');
            $action_by_approver_id = $this->input->post('action_by_approver_id');
            $leave_status = $this->input->post('leave_status');
            $leave_comments = $this->input->post('leave_comments');
            //print_r($_POST);die();
            if ($this->validate_update_leave_status_form_data() == true) {
                
                ### By Applicant
                if($action_by_approver == 'applicant'){
                    if($leave_status == 'C'){
                        $postdata = array(
                            'leave_status' => $leave_status,
                            'cancelled_by' => $action_by_approver_id,
                            'cancellation_reason'=>$leave_comments,
                            'cancellation_datetime' => date('Y-m-d H:i:s')
                        );
                        $final_leave_status = 'C';
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                        $is_update = $this->leave_model->update($postdata, $where, 'user_leaves');
                        if($is_update){
                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>'This leave request has been cancelled', 'css'=>'alert alert-success');
                        }
                    }else{
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Cancel Leave request.', 'css'=>'alert alert-danger');
                    }
                }

                ### By L1 Approver
                if($action_by_approver == 'supervisor'){
                    if($leave_status == 'R'){
                        $final_leave_status = 'R'; // rejected
                    }
                    if($leave_status == 'A'){
                        $final_leave_status = 'O'; // processing
                    }
                    if($leave_status == 'C'){
                        $final_leave_status = 'P'; // No Action Required. Move to Pending
                    }
                    if($leave_status != 'C'){
                        $postdata = array(					
                            'leave_status' => $final_leave_status,
                            'supervisor_approver_status' => $leave_status,
                            'supervisor_approver_id' => $action_by_approver_id,
                            'supervisor_approver_comment'=>$leave_comments,
                            'supervisor_approver_datetime' => date('Y-m-d H:i:s')
                        );
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                        $is_update = $this->leave_model->update($postdata, $where, 'user_leaves');
                        if($is_update){
                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>'Leave request has been updated successfully.', 'css'=>'alert alert-success');
                        }
                    }else{
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Approve / Reject', 'css'=>'alert alert-danger');
                    }
                    
                }

                ### By L2 Approver
                if($action_by_approver == 'director'){
                    if($leave_status == 'R'){
                        $final_leave_status = 'R'; // rejected
                    }
                    if($leave_status == 'A'){
                        $final_leave_status = 'A'; // approved
                    }
                    if($leave_status == 'C'){
                        $final_leave_status = 'P'; // No Action Required. Move to Pending
                    }

                    if($leave_status != 'C'){
                        $postdata = array(
                            'leave_status' => $final_leave_status,
                            'director_approver_status' => $leave_status,
                            'director_approver_id' => $action_by_approver_id,
                            'director_approver_comment'=>$leave_comments,
                            'director_approver_datetime' => date('Y-m-d H:i:s')
                        );
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id, 'leave_status' => 'P');
                        $is_update = $this->leave_model->update($postdata, $where, 'user_leaves');
                        if($is_update){
                            $messageTxt = 'Leave request has been updated successfully.';
                        }else{
                            $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'Sorry! You have already updated leave status', 'css'=>'alert alert-success');
                        }
                        //Update leave balance if finally leave approved
                        if($final_leave_status == 'A'){
                            $result_array = $this->leave_model->get_rows($leave_id, NULL, NULL, FALSE, TRUE);
                            $leave_data = $result_array['data_rows'];
                            $applicant_user_id = $leave_data[0]['user_id'];
                            $applied_for_days_count = $leave_data[0]['applied_for_days_count'];
                            $leave_type = $leave_data[0]['leave_type'];;
                            $leave_balance = $this->leave_model->get_leave_balance(NULL, NULL, NULL, FALSE, FALSE, $applicant_user_id);
                            $leave_balance_id = $leave_balance[0]['id'];
                            $available_leave_balance = $leave_balance[0][strtolower($leave_type)];
                            //print_r($leave_balance);die();
                            $updated_leave_balance = ($available_leave_balance-$applied_for_days_count);
    
                            //Update Leave Table with Number of approved days 
                            $postdata = array(                        
                                'approved_for_days_count' => $applied_for_days_count
                            );
                            $where = array('id'=>$leave_id);
    
                            // Update Leave Balance Table
                            $postdata = array(
                                strtolower($leave_type) => $updated_leave_balance,
                                'updated_on' => date('Y-m-d H:i:s'),
                                'updated_by' => $this->sess_user_id
                            );
                            $where = array('id'=>$leave_balance_id, 'user_id'=>$applicant_user_id);
                            $is_update_balance = $this->leave_model->update($postdata, $where, 'user_leave_balance');
                            if($is_update_balance){
                                $messageTxt.= 'Leave Balance has been updated.';
                            }
                        }
                        if($is_update){
                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>$messageTxt, 'css'=>'alert alert-success');
                        }
                    }else{
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Approve / Reject', 'css'=>'alert alert-danger');
                    }
                }

                ### Send Email to Applicant
                if($final_leave_status == 'A' || $final_leave_status == 'R' || $final_leave_status == 'C'){ 
                    $result_array = $this->leave_model->get_rows($leave_id, NULL, NULL, FALSE, TRUE);
                    $data = $result_array['data_rows'][0];
                    //print_r($data);
                    //die();
                    $to = $this->common_lib->get_sess_user('user_email');
                    $from = $this->config->item('app_admin_email');
                    $from_name = $this->config->item('app_admin_email_name');
                    $applicant_name = $data['user_firstname'].' '.$data['user_lastname'];
                    $leave_status = $this->data['leave_status_arr'][$data['leave_status']]['text'];
                    $leave_type = $this->data['leave_type_arr'][$data['leave_type']];
                    $leave_from_to = $this->common_lib->display_date($data['leave_from_date']).' to '.$this->common_lib->display_date($data['leave_to_date']);
                    $leave_reason = $data['leave_reason'];
                    $leave_request_id = $data['leave_req_id'];
                    $applied_for_days_count = $data['applied_for_days_count'];
                    
                    $subject= 'Your Leave Request '.$leave_request_id.' is '.$leave_status.' : '.$leave_type .' from '.$leave_from_to;
                    $message = 'You can track your leave history from '.anchor(base_url('leave/details/'.$data['id'].'/'.$data['leave_req_id'].'/history'));
                    $message_table ='<table border="1">';
                    $message_table.='<tbody>';
                    $message_table.='<tr>';
                    $message_table.='<td>Applicant</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$applicant_name.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Leave Status</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_status.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Leave Type</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_type.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>From - To</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_from_to.'</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Leave Days</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$applied_for_days_count.' Day(s)</td>';
                    $message_table.='</tr>';
                    $message_table.='<tr>';
                    $message_table.='<td>Reason/Occasion</td>';
                    $message_table.='<td>:</td>';
                    $message_table.='<td>'.$leave_reason.'</td>';
                    $message_table.='</tr>';
                    $message_table.='</tbody>';
                    $message_table.='</table>';                    
                    //$this->send_notification($to, $from, $from_name, $subject, $message.$message_table);
                }
            }else{
                $message = array('is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>validation_errors(),'css'=>''); 
            }
        }
        echo json_encode($message); die();
    }

    function validate_update_leave_status_form_data($action = NULL) {
        $this->form_validation->set_rules('action_by_approver_id', '', 'required|callback_validate_approver_authorization');
        $this->form_validation->set_rules('leave_status', 'status', 'required');
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

    function send_notification($to, $from, $from_name, $subject, $message){  
        $message_html = '';
        $message_html.='<div id="message_wrapper" style="border-top: 2px solid #5133AB;">';
        $message_html.= $this->config->item('app_email_header');
        $message_html.='<div id="message_body" style="padding-top: 5px; padding-bottom:5px;">';
        $message_html.=$message;
        $message_html.='</div><!--/#message_body-->';
        $message_html.= $this->config->item('app_email_footer');
        $message_html.='</div><!--/#message_wrapper-->';
        //echo $message_html;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->to($to);
        $this->email->from($from, $from_name);
        $this->email->subject($subject);
        $this->email->message($message_html);
        $this->email->send();
        //echo $this->email->print_debugger();
        //die();
    }

}

?>
