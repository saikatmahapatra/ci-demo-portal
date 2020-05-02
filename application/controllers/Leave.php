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
        
        // Load required js files for this controller
        $javascript_files = array(
            $this->router->class
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($javascript_files);
		
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
        $this->load->library('excel');
		
		
        $this->data['leave_type_arr'] = array(''=>'-Select-',
            'CL'=>'Casual Leave',
            'PL'=>'Privileged Leave',
            'SL'=>'Sick Leave',
            'CO'=>'Compensatory Off',
            //'OL'=>'Optional Leave',
            //'SP'=>'Special Leave'
        );
        // Leave Terms
        $this->data['leave_term_arr'] = array(
            'FD' => 'Full Day (FD)',
            'HD1' => 'Half Day - First Half (HD1)',
            'HD2' => 'Half Day - Second Half (HD2)'
        );
		$this->data['leave_status_arr'] = array(
            'B'=>array('text'=>'Applied', 'css'=>'text-primary'),
            'P'=>array('text'=>'Pending', 'css'=>'text-secondary'),
            'C'=>array('text'=>'Cancelled', 'css'=>'text-warning'),
            'R'=>array('text'=>'Rejected', 'css'=>'text-danger'),
            'A'=>array('text'=>'Approved', 'css'=>'text-success'),
            'O'=>array('text'=>'Processing', 'css'=>'text-info'),
            'X'=>array('text'=>'Cancel Requested', 'css'=>'text-warning'),
        );
		
		
		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_title'] = $this->router->class.' : '.$this->router->method;
        
    }

    function index(){
        $this->apply();
    }
	
	function apply() {
		$this->data['page_title'] = 'Apply Leave';
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

        // Initial/ L1 Approver
        if($supervisor_approver_id == NULL || $supervisor_approver_id == 0){
            $system_msg['supervisor'] = array('txt'=>'Please add your L1 approver (initial). Click '.anchor(base_url('user/edit_approvers'),' here').' to update.', 'css'=>'text-danger', 'has_error'=> true);
        }else{
            $system_msg['supervisor'] = array('txt'=>'Your L1 approver (initial) is '.$supervisor_approver_name.' ('.$this->data['approvers'][0]['supervisor_emp_id'].') . Click '.anchor(base_url('user/edit_approvers'),' here').' to change.', 'css'=>'', 'has_error'=> false);
        }

        // Final / L2 Approver
        if($director_approver_id == NULL || $director_approver_id == 0){
            $system_msg['director'] = array('txt'=>'Please add your L2 approver (final). Click '.anchor(base_url('user/edit_approvers'),' here').' to update.', 'css'=>'text-danger', 'has_error'=> true);
        }else{
            $system_msg['director'] = array('txt'=>'Your L2 approver (final) is '.$director_approver_name.' ('.$this->data['approvers'][0]['director_emp_id'].') . Click '.anchor(base_url('user/edit_approvers'),' here').' to change.', 'css'=>'', 'has_error'=> false);
        }

        /*if($hr_approver_id == NULL || $hr_approver_id == 0){
            $system_msg['hr'] = array('txt'=>'No HR is tagged. Click '.anchor(base_url('user/edit_approvers'),' here').' to update.', 'css'=>'text-danger', 'has_error'=> true);
        }else{
            $system_msg['hr'] = array('txt'=>'Your HR Approver is '.$hr_approver_name.' ('.$this->data['approvers'][0]['hr_emp_id'].') . Click '.anchor(base_url('user/edit_approvers'),' here').' to change.', 'css'=>'', 'has_error'=> false);
        }*/

        if(sizeof($this->data['leave_balance'])<=0){
            $system_msg['leave']= array('txt'=>'You don\'t have leave balance. Please contact with your HR to add leave balance.', 'css'=>'text-danger', 'has_error'=> true);   
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
            //print_r($_POST);die();
            if ($this->validate_form_data('add') == true && $system_msg_error_counter == 0) {  
                $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_from_date'))); // or your date as well
                $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('leave_to_date')));
                $datediff = ($to_date - $from_date);
                $no_day = round($datediff / (60 * 60 * 24));
                //die();
                $leave_request_id = date('mdy').$this->common_lib->generate_rand_id(4, FALSE);
				$postdata = array(
                    'leave_req_id' => $leave_request_id,
                    'leave_type' => $this->input->post('leave_type'),
                    'leave_reason' => $this->input->post('leave_reason'),
                    'leave_from_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_from_date')),
                    'leave_to_date' => $this->common_lib->convert_to_mysql($this->input->post('leave_to_date')),
                    'applied_for_days_count' => ($no_day+1),
                    'user_id' => $this->sess_user_id,
                    'leave_created_on' => date('Y-m-d H:i:s'),
                    'leave_status' => 'B',
                    'leave_term' => $this->input->post('leave_term') ? $this->input->post('leave_term') : 'FD',
                    'supervisor_approver_id'=> $supervisor_approver_id,
                    'supervisor_approver_status'=>'P',
                    'director_approver_id'=>$director_approver_id,
                    'director_approver_status'=>'P',
                    'hr_approver_id'=>$hr_approver_id,
                    'hr_approver_status'=>'P',
                    'on_apply_cl_bal'=> isset($this->data['leave_balance'][0]['cl']) ? $this->data['leave_balance'][0]['cl'] : '',
                    'on_apply_pl_bal'=> isset($this->data['leave_balance'][0]['pl']) ? $this->data['leave_balance'][0]['pl'] : '',
                    'on_apply_ol_bal'=> isset($this->data['leave_balance'][0]['ol']) ? $this->data['leave_balance'][0]['ol'] : '',
                    'on_apply_sl_bal'=> isset($this->data['leave_balance'][0]['sl']) ? $this->data['leave_balance'][0]['sl'] : '',
                    'on_apply_co_bal'=> isset($this->data['leave_balance'][0]['co']) ? $this->data['leave_balance'][0]['co'] : ''

                );
                $insert_id = $this->leave_model->insert($postdata);
                if ($insert_id) {
                    $this->common_lib->set_flash_message('You have applied leave successfully. Please note your leave request no <strong>'.$leave_request_id.'</strong> for future references. You will get email notification informing leave status. For more details go to '.anchor(base_url('leave/history'),'My Leave History'),'alert-success');

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
                    $leave_term = $this->data['leave_term_arr'][$data['leave_term']];
                    $leave_from_to = $this->common_lib->display_date($data['leave_from_date']).' to '.$this->common_lib->display_date($data['leave_to_date']);
                    $leave_reason = $data['leave_reason'];
                    $applied_for_days_count = $data['applied_for_days_count'];
                    
                    $subject= $this->config->item('app_email_subject_prefix').' Leave Request No '.$leave_request_id.' - '.$leave_status;
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
                    $message_table.='<td>'.$leave_type.' '.$leave_term.'</td>';
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
                    $leave_term = $this->data['leave_term_arr'][$data['leave_term']];
                    $applicant_name = $data['user_firstname'].' '.$data['user_lastname'];
                    $leave_from_to = $this->common_lib->display_date($data['leave_from_date']).' to '.$this->common_lib->display_date($data['leave_to_date']);
                    $leave_reason = $data['leave_reason'];
                    $applied_for_days_count = $data['applied_for_days_count'];

                    $subject= $this->config->item('app_email_subject_prefix').' Leave Notification : Applied By '.$applicant_name.' - Leave Req No '.$leave_request_id.' - '.$leave_status;
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
        $this->data['page_title'] = 'Leave History';
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
        $this->data['page_title'] = 'Leave Requests Management';
        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition
        $cond = array();
        $cond['assigned_to_user_id'] = $this->sess_user_id;
        
        if($this->uri->segment(3) == 'pending'){
            $this->data['page_title'] = 'Leave Requests Management - Pending Leave';
            $cond['leave_status'] = array('B');
            $cond['assigned_to_user_id'] = $this->sess_user_id;
        }

        if($this->uri->segment(3) == 'approved'){
            $cond['leave_status'] = array('A');
            $cond['assigned_to_user_id'] = $this->sess_user_id;
        }

        if($this->uri->segment(3) == 'cancelled'){
            $cond['leave_status'] = array('C');
            $cond['assigned_to_user_id'] = $this->sess_user_id;
        }

        if($this->uri->segment(3) == 'rejected'){
            $cond['leave_status'] = array('R');
            $cond['assigned_to_user_id'] = $this->sess_user_id;
        }

        if($this->uri->segment(3) == 'all'){
            $is_authorized = $this->common_lib->is_auth(array(
                'crud-leave-balance'
            ));
            $cond['leave_status'] = NULL;
            $cond['assigned_to_user_id'] = NULL;
        }

        if($this->uri->segment(3)== ''){
            redirect($this->router->directory.$this->router->class.'/'.$this->router->method.'/assigned_to_me');
        }
        
        if($this->input->get_post('form_action') == 'search'){
            $cond['leave_status'] = $this->input->get_post('leave_status');
            $cond['leave_from_date'] = $this->input->get_post('leave_from_date');
            $cond['leave_to_date'] = $this->input->get_post('leave_to_date');
        }

        

		$result_array = $this->leave_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, $cond);
		$total_num_rows = $result_array['num_rows'];
		
		//Pagination config starts here		
        $per_page = 30;
        $config['uri_segment'] = 5; //which segment of your URI contains the page number
        $config['num_links'] = 2;
        $page = ($this->uri->segment($config['uri_segment'])) ? ($this->uri->segment($config['uri_segment'])-1) : 0;
        $offset = ($page*$per_page);
        $additional_segment = $this->router->directory.$this->router->class.'/'.$this->router->method.'/'.$this->uri->segment(3);
        $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page, $additional_segment);
        //Pagination config ends here
        

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE, $cond);
        $this->data['data_rows'] = $result_array['data_rows'];

        $this->data['maincontent'] = $this->load->view($this->router->class.'/manage', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function validate_form_data($action = NULL) {
        if($this->input->post('leave_type') == 'CO'){
            $this->form_validation->set_rules('leave_type', ' ', 'required|callback_validate_comp_off_eligibility');
        }else{
            $this->form_validation->set_rules('leave_type', ' ', 'required');
        }
        $this->form_validation->set_rules('leave_term', ' ', 'required|callback_validate_leave_term');
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

    function validate_comp_off_eligibility(){
        if($this->input->post('leave_type') == 'CO'){
            $this->form_validation->set_message('validate_comp_off_eligibility', 'Applying comp off is currently not allowed by system.');
            return false;
        }else{
            return true;
        }
    }

    function validate_leave_term(){
        if(($this->input->post('leave_term') == 'HD1' || $this->input->post('leave_term') == 'HD2') && $this->input->post('leave_type') != 'CL'){
            $this->form_validation->set_message('validate_leave_term', 'Half Day is applicable for CL only.');
            return false;
        }else{
            return true;
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
            'user_id' => $this->sess_user_id,
            'leave_status' => array('O', 'A')
        );
        $res = $this->leave_model->check_leave_date_range($cond);

        if($res['num_rows'] > 0){
            $this->form_validation->set_message('is_leave_exists_in_date_range', 'Leave req # '.$res['data_rows'][0]['leave_req_id'].' already exists in the selected date range.');
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
            //$row[] = $result['task_name'];
            //$row[] = $result['timesheet_hours'];
            //$row[] = $result['timesheet_review_status'];
			
			$html = '<div class="font-weight-bold">'.$this->common_lib->display_date($result['timesheet_date']).' <span class="float-right">'.$result['timesheet_hours'].' hrs</span></div>';			
			$html.= '<div class="small">'.$result['project_name'].'<span class="float-right">'.$result['task_name'].'</span></div>';			
			
            
            //add html for action
            $action_html = '<span class="float-right">';
            /*$action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' . $result['id']), $this->common_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'text-dark',
                'title' => 'Edit',
            ));*/            
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), $this->common_lib->get_icon('delete','dt_action_icon'), array(
                'class' => 'text-danger',
				'data-confirmation'=>false,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
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
            $this->common_lib->set_flash_message('Leave Entry Deleted Successfully','alert-success');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

    function details() {
        $this->data['page_title'] = 'Leave Details';
        $result_array = $this->leave_model->get_rows($this->id, NULL, NULL, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
        $this->data['maincontent'] = $this->load->view($this->router->class.'/details', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function details_process() {
        $this->data['page_title'] = 'Manage Leave Request';
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
        $this->data['page_title'] = 'Leave Balance';
        $record_exists = FALSE;
        if ($this->input->post('form_action') == 'leave_balance_update') {
            if ($this->validate_leave_balance_form_data() == true) {
                $user_id = $this->input->post('user_id');
                $record_exists = $this->leave_model->is_leave_balance_exists($user_id);
                if($record_exists == TRUE){
                    $postdata = array(
                        'user_id' => $user_id,
                        'cl' => $this->input->post('cl'),
                        'sl' => $this->input->post('sl'),
                        'pl' => $this->input->post('pl'),
                        'ol' => $this->input->post('ol'),
                        'co' => $this->input->post('co'),
                        'updated_by' => $this->sess_user_id,
                        'updated_on' => date('Y-m-d H:i:s')
                    );
                    $where = array('id' => $this->input->post('id'));
                    $insert_id = $this->leave_model->update($postdata, $where, 'leave_balance');
                    if ($insert_id) {
                        $this->common_lib->set_flash_message('Leave Balance Updated Successfully.','alert-success');
                        redirect(current_url());
                    }
                }else{
                    $postdata = array(
                        'user_id' => $this->input->post('user_id'),
                        'cl' => $this->input->post('cl'),
                        'sl' => $this->input->post('sl'),
                        'pl' => $this->input->post('pl'),
                        'ol' => $this->input->post('ol'),
                        'co' => $this->input->post('co'),
                        'created_by' => $this->sess_user_id,
                        'created_on' => date('Y-m-d H:i:s')
                    );
                    $insert_id = $this->leave_model->insert($postdata, 'leave_balance');
                    if ($insert_id) {
                        $this->common_lib->set_flash_message('Leave Balance Added Successfully.','alert-success');
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


    function import_data() {
        // Check user permission by permission name mapped to db
        $is_authorized = $this->common_lib->is_auth(array(
            'crud-leave-balance'
        ));  
        $this->data['page_title'] = 'Leave Balance Import/Export';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/import_data', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function import(){
		if(isset($_FILES["userfile"]["name"])){
            $path = $_FILES["userfile"]["tmp_name"];
            @PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
                //print_r($worksheet); die();
				$highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $data = array();
				for($row=2; $row<=$highestRow; $row++){
					$user_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$cl_balance = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $pl_balance = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $sl_balance = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $co_balance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $balance_date = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $balance_table_pk_index = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$data[] = array(
                        'id' => ($balance_table_pk_index!="") ? $balance_table_pk_index : NULL,
						'user_id' => $user_id,
						'cl' =>	($cl_balance != "") ? $cl_balance : NULL,
						'sl' =>	($sl_balance != "") ? $sl_balance : NULL,
                        'pl' =>	($pl_balance != "") ? $pl_balance : NULL,
                        'co' =>	($pl_balance != "") ? $co_balance : NULL,
						'balance_date' =>	date('Y-m-d H:i:s'),
						'created_on' =>	date('Y-m-d H:i:s'),
						'created_by' =>	$this->sess_user_id,
					);
				}
            }
            //print_r($data);
            $res = $this->leave_model->import_batch_leave_balance_data($data);
			echo json_encode($res); die();
		}	
    }
    
    function validate_leave_balance_form_data($action = NULL) {
        $this->form_validation->set_rules('user_id', ' ', 'required');
        $this->form_validation->set_rules('cl', ' ', 'required|max_length[6]|numeric|less_than_equal_to[10]
        ');
        $this->form_validation->set_rules('sl', ' ', 'required|max_length[6]|numeric|less_than_equal_to[10]
        ');
        $this->form_validation->set_rules('pl', ' ', 'required|max_length[6]|numeric|less_than_equal_to[100]');
        $this->form_validation->set_rules('ol', ' ', 'max_length[6]|numeric|less_than_equal_to[2]');
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
        $leave_data = array();
        $messageTxt = '';
        $final_leave_status = '';
        $current_leave_status = '';
        $current_supervisor_approver_status = '';
        $current_director_approver_status = '';
        $is_cancel_requested = 'N';
        $send_email = false;
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
                ### Get Current Status
                $result_array = $this->leave_model->get_rows($leave_id, NULL, NULL, FALSE, TRUE);
                $leave_data = $result_array['data_rows'][0];
                $current_leave_status = isset($leave_data['leave_status']) ? $leave_data['leave_status']: $current_leave_status;
                $current_supervisor_approver_status = isset($leave_data['supervisor_approver_status']) ? $leave_data['supervisor_approver_status']: $current_supervisor_approver_status;
                $current_director_approver_status = isset($leave_data['director_approver_status']) ? $leave_data['director_approver_status']: $current_director_approver_status;
                $is_cancel_requested = isset($leave_data['cancel_requested']) ? $leave_data['cancel_requested']: $is_cancel_requested;

                ### By Applicant
                if($action_by_approver == 'applicant'){
                    if($leave_status == 'C' && $current_leave_status != 'A'){
                        $postdata = array(
                            'leave_status' => 'C',// If not approved
                            'cancelled_by' => $action_by_approver_id,
                            'cancellation_reason'=>$leave_comments,
                            'cancellation_datetime' => date('Y-m-d H:i:s')
                        );
                        $final_leave_status = 'X';
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                        $is_update = $this->leave_model->update($postdata, $where, 'leave_applications');
                        if($is_update>=1){
                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>'request has been cancelled.', 'css'=>'alert alert-success');
                        }
                    }
                    else if($leave_status == 'C' && $current_leave_status == 'A'){
                        $postdata = array(
                            'cancel_requested' => 'Y',// If not approved
                            'cancel_requested_by' => $action_by_approver_id,
                            'cancel_request_reason'=>$leave_comments,
                            'cancel_request_datetime' => date('Y-m-d H:i:s')
                        );
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                        $is_update = $this->leave_model->update($postdata, $where, 'leave_applications');
                        if($is_update>=1){
                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>'Your leave cancellation request has been taken.', 'css'=>'alert alert-success');
                        }
                    }
                    else if($leave_status == 'C' && $is_cancel_requested == 'Y'){
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You have already requested cancellation', 'css'=>'alert alert-danger');
                    }
                    else{
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Cancel this request.', 'css'=>'alert alert-danger');
                    }
                }

                ### By L1 Approver
                if($action_by_approver == 'supervisor'){
                    $final_leave_status = '';
                    if($leave_status == 'R' && $is_cancel_requested != 'Y'){
                        $final_leave_status = 'R'; // rejected
                    }
                    if($leave_status == 'A' && $is_cancel_requested != 'Y'){
                        $final_leave_status = 'O'; // processing
                    }
                    if($leave_status == 'C' && $is_cancel_requested == 'Y'){
                        $final_leave_status = 'C'; // Cancel the leave
                    }
                    if($leave_status == 'C' && $is_cancel_requested != 'Y'){
                        $final_leave_status = ''; // Cancel the leave
                    }
                    if($final_leave_status != '' && $current_supervisor_approver_status != 'C'){
                        $postdata = array(					
                            'leave_status' => $final_leave_status,
                            'supervisor_approver_status' => $leave_status,
                            'supervisor_approver_id' => $action_by_approver_id,
                            'supervisor_approver_comment'=>$leave_comments,
                            'supervisor_approver_datetime' => date('Y-m-d H:i:s')
                        );
                        //print_r($postdata);die();
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                        $is_update = $this->leave_model->update($postdata, $where, 'leave_applications');
                        if($is_update){
                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=>'Leave request has been updated successfully.', 'css'=>'alert alert-success');
                            $send_email = true;
                        }
                    }
                    /*else if($final_leave_status != '' && ($current_director_approver_status != 'P')){
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can not modify this request. Status has already been updated to <strong>'.$current_director_approver_status.' </strong>by L2 approver', 'css'=>'alert alert-danger');
                    }*/
                    else{
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Approve / Reject. You would be able to cancel this once applicant request for cancellation.', 'css'=>'alert alert-danger');
                    }
                    
                }

                ### By L2 Approver
                if($action_by_approver == 'director'){
                    $final_leave_status = '';
                    if($leave_status == 'R' && $is_cancel_requested != 'Y'){
                        $final_leave_status = 'R'; // rejected
                    }
                    if($leave_status == 'A' && $is_cancel_requested != 'Y'){
                        $final_leave_status = 'A'; // approved
                    }
                    if($leave_status == 'C' && $is_cancel_requested == 'Y'){
                        $final_leave_status = 'C'; // Cancel the leave
                    }
                    if($leave_status == 'C' && $is_cancel_requested != 'Y'){
                        $final_leave_status = ''; // Cancel the leave
                    }

                    if($final_leave_status != '' && ($current_director_approver_status != 'C' || $current_leave_status != 'A')){
                        $postdata = array(
                            'leave_status' => $final_leave_status,
                            'director_approver_status' => $leave_status,
                            'director_approver_id' => $action_by_approver_id,
                            'director_approver_comment'=>$leave_comments,
                            'director_approver_datetime' => date('Y-m-d H:i:s')
                        );
                        $where = array('id'=>$leave_id, 'leave_req_id'=>$leave_req_id);
                        $is_update = $this->leave_model->update($postdata, $where, 'leave_applications');
                        if($is_update >=1 ){
                            $messageTxt = 'Leave request has been updated successfully.';
                            // If Approved deduct balance
                            $balance_updated = '';
                            if($final_leave_status == 'A'){
                                $balance_updated = $this->update_user_leave_balance($leave_id);
                                if($balance_updated>=1){
                                    $messageTxt.= ' Leave balance deducted.';
                                }
                            }

                            if($final_leave_status == 'C'){
                                $balance_updated = $this->adjust_user_leave_balance($leave_id);
                                if($balance_updated>=1){
                                    $messageTxt.= ' Leave balance adjusted.';
                                }
                            }

                            $message = array('is_valid'=>true, 'updated'=>true, 'insert_id'=>'','msg'=> $messageTxt, 'css'=>'alert alert-success');
                            $send_email = true;
                        }
                        // if($final_leave_status != '' && $current_leave_status == 'A'){
                        //     $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You cann\'t modify a Approved leave.', 'css'=>'alert alert-danger');
                        // }
                        else{
                            $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Approve / Reject. You would be able to cancel this once applicant request for cancellation.', 'css'=>'alert alert-danger');
                        }
                    }else{
                        $message = array('is_valid'=>true, 'updated'=>false, 'insert_id'=>'','msg'=>'You can only Approve / Reject. You would be able to cancel this request once applicant request for cancellation.', 'css'=>'alert alert-danger');
                    }
                }

                ### Send Email to Applicant & L1, L2 Approver
                
                if($send_email == true){
                    $this->send_leave_status_update_email($leave_id, $final_leave_status);
                }
            }else{
                $message = array('is_valid'=>false, 'updated'=>false, 'insert_id'=>'','msg'=>validation_errors(),'css'=>''); 
            }
        }
        $this->common_lib->set_flash_message($message['msg'],$message['css']);
        echo json_encode($message); die();
    }

    function validate_update_leave_status_form_data($action = NULL) {
        $this->form_validation->set_rules('action_by_approver_id', '', 'required|callback_validate_approver_authorization');
        $this->form_validation->set_rules('leave_status', 'status', 'required');
        //$this->form_validation->set_rules('leave_comments', 'comment', 'required|max_length[100]');
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

    function update_user_leave_balance($leave_id){
        $result_array = $this->leave_model->get_rows($leave_id, NULL, NULL, FALSE, TRUE);
        $leave_data = $result_array['data_rows'][0];
        $applicant_user_id = $leave_data['user_id'];
        $applied_for_days_count = $leave_data['applied_for_days_count'];
        $leave_type = $leave_data['leave_type'];
        $leave_term = $leave_data['leave_term'];
        $leave_term_multiplier = ($leave_term == 'FD') ? 1 : 0.5;
        $leave_balance = $this->leave_model->get_leave_balance(NULL, NULL, NULL, FALSE, FALSE, $applicant_user_id);
        $leave_balance_id = $leave_balance[0]['id'];
        $available_leave_balance = $leave_balance[0][strtolower($leave_type)];
        //print_r($leave_balance);die();
        $updated_leave_balance = ($available_leave_balance - ($applied_for_days_count * $leave_term_multiplier));

        //Update Leave Table with Number of approved days 
        $postdata = array();
        $postdata['approved_for_days_count'] = $applied_for_days_count * $leave_term_multiplier;
        if(strtolower($leave_type) == 'cl'){
            $postdata['debited_cl'] = $applied_for_days_count * $leave_term_multiplier;
        }
        if(strtolower($leave_type) == 'pl'){
            $postdata['debited_pl'] = $applied_for_days_count * $leave_term_multiplier;
        }
        if(strtolower($leave_type) == 'ol'){
            $postdata['debited_ol'] = $applied_for_days_count * $leave_term_multiplier;
        }
        if(strtolower($leave_type) == 'sl'){
            $postdata['debited_sl'] = $applied_for_days_count * $leave_term_multiplier;
        }
        if(strtolower($leave_type) == 'co'){
            $postdata['debited_co'] = $applied_for_days_count * $leave_term_multiplier;
        }
        $where = array('id'=>$leave_id);
        $this->leave_model->update($postdata, $where, 'leave_applications');

        // Update Leave Balance Table
        $postdata = array(
            strtolower($leave_type) => $updated_leave_balance,
            'updated_on' => date('Y-m-d H:i:s'),
            'updated_by' => $this->sess_user_id
        );
        //print_r($postdata); die();
        $where = array('id'=>$leave_balance_id, 'user_id'=>$applicant_user_id);
        $is_update_balance = $this->leave_model->update($postdata, $where, 'leave_balance');
        return $is_update_balance;
    }

    function adjust_user_leave_balance($leave_id){
        $result_array = $this->leave_model->get_rows($leave_id, NULL, NULL, FALSE, TRUE);
        $leave_data = $result_array['data_rows'][0];
        $applicant_user_id = $leave_data['user_id'];
        $leave_balance = $this->leave_model->get_leave_balance(NULL, NULL, NULL, FALSE, FALSE, $applicant_user_id);
        $leave_balance_id = $leave_balance[0]['id'];
        // Update Leave Balance Table
        $postdata = array();
        if(isset($leave_data['debited_cl'])){
            $postdata['credited_cl'] = $leave_data['debited_cl'];
        }
        if(isset($leave_data['debited_pl'])){
            $postdata['credited_pl'] = $leave_data['debited_pl'];
        }
        if(isset($leave_data['debited_ol'])){
            $postdata['credited_ol'] = $leave_data['debited_ol'];
        }
        if(isset($leave_data['debited_sl'])){
            $postdata['credited_sl'] = $leave_data['debited_sl'];
        }
        if(isset($leave_data['debited_co'])){
            $postdata['credited_co'] = $leave_data['debited_co'];
        }
        $where = array('id' => $leave_balance_id, 'user_id' => $applicant_user_id);
        $is_update_balance = $this->leave_model->adjust_leave_balance($postdata, $where);

        // Also update user leave table
        $where = array('id' => $leave_id);
        $is_user_leave_updated = $this->leave_model->update($postdata, $where, 'leave_applications');

        return $is_update_balance;
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

    function send_leave_status_update_email($leave_id, $final_leave_status){
        $result_array = $this->leave_model->get_rows($leave_id, NULL, NULL, FALSE, TRUE);
        $data = $result_array['data_rows'][0];
        ///echo '<pre>';
        //print_r($data);
        //die();
        $to = $this->common_lib->get_sess_user('user_email');
        $from = $this->config->item('app_admin_email');
        $from_name = $this->config->item('app_admin_email_name');
        $applicant_name = $data['user_firstname'].' '.$data['user_lastname'];
        $leave_status = $this->data['leave_status_arr'][$data['leave_status']]['text'];
        $leave_type = $this->data['leave_type_arr'][$data['leave_type']];
        $leave_term = $this->data['leave_term_arr'][$data['leave_term']];
        $leave_from_to = $this->common_lib->display_date($data['leave_from_date']).' to '.$this->common_lib->display_date($data['leave_to_date']);
        $leave_reason = $data['leave_reason'];
        $leave_request_id = $data['leave_req_id'];
        $applied_for_days_count = $data['applied_for_days_count'];
        
        $L1_supervisior_email = $data['supervisor_email'];
        $L2_director_email = $data['director_email'];
        $L3_hr_email = $data['hr_email'];
        
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
        $message_table.='<td>Leave Term</td>';
        $message_table.='<td>:</td>';
        $message_table.='<td>'.$leave_term.'</td>';
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
        $message_table.='<tr>';

        
        $message_table.='<td>L1 Approver </td>';
        $message_table.='<td>:</td>';
        $message_table.='<td>'.$this->data['leave_status_arr'][$data['supervisor_approver_status']]['text'].'<br>'.$data['supervisor_approver_firstname'].' '.$data['supervisor_approver_lastname'].'<br>'.$data['supervisor_approver_comment'].'<br>'.$this->common_lib->display_date($data['supervisor_approver_datetime'], true).'</td>';
        $message_table.='</tr>';

        $message_table.='<td>L2 Approver </td>';
        $message_table.='<td>:</td>';
        $message_table.='<td>'.$this->data['leave_status_arr'][$data['director_approver_status']]['text'].'<br>'.$data['director_approver_firstname'].' '.$data['director_approver_lastname'].'<br>'.$data['director_approver_comment'].'<br>'.$this->common_lib->display_date($data['director_approver_datetime'], true).'</td>';
        $message_table.='</tr>';
        $message_table.='<tr>';

        $message_table.='<td>Cancel Requested </td>';
        $message_table.='<td>:</td>';
        $message_table.='<td>'.($data['cancel_requested'] == 'Y' ? 'Leave Cancel Requested' : 'No').'<br>'.$this->common_lib->display_date($data['cancel_request_datetime'], true).'</td>';
        $message_table.='</tr>';

        $message_table.='</tbody>';
        $message_table.='</table>';

        // Send to Applicant
        if($data['leave_status'] == 'A' || $data['leave_status'] == 'R' || $data['leave_status'] == 'C'){
            $subject= $this->config->item('app_email_subject_prefix').' Leave Request No '.$leave_request_id.' - '.$leave_status;
            $message_body_applicant = 'You can track your leave history from '.anchor(base_url('leave/details/'.$data['id'].'/'.$data['leave_req_id'].'/history'));
            $email_message_body = $message_body_applicant.$message_table;
            //die();
            $this->send_notification($to, $from, $from_name, $subject, $email_message_body);

            $message_body_hr = 'You can track leave from '.anchor(base_url('leave/manage/'));
            if($data['cancel_requested'] == 'Y' && $data['leave_status'] == 'C'){
                $message_body_hr.= '. Please adjust leave balance for the below leave request from '.anchor(base_url('leave/leave_balance'));
            }
            $email_message_body = $message_body_hr.$message_table;
            //die();
            $this->send_notification($L3_hr_email, $from, $from_name, $subject, $email_message_body);
        }
        
        // Send to L2 approver, if L1 approve i.e Status = Processing
        if($data['leave_status'] == 'O'){
            $subject= $this->config->item('app_email_subject_prefix').' Need Approval - Leave Request No '.$leave_request_id.' - '.$leave_status;
            $message_body_approver = 'Track all leave requests pending for approval from your end '.anchor(base_url('leave/details/'.$data['id'].'/'.$data['leave_req_id'].'/manage'));
            $email_message_body = $message_body_approver.$message_table;
            //die();
            $this->send_notification($L2_director_email, $from, $from_name, $subject, $email_message_body);
        }

        // Send to L2 approver, if L1 approve i.e Status = Processing
        if($data['cancel_requested'] == 'Y'){
            $subject= $this->config->item('app_email_subject_prefix').' Cancel Requested for Leave Request No '.$leave_request_id.' - '.$leave_status;
            $message_body_approver = 'You can cancel the leave request '.anchor(base_url('leave/details/'.$data['id'].'/'.$data['leave_req_id'].'/manage').'. Leave balance should be adjusted.');
            $email_message_body = $message_body_approver.$message_table;
            //die();
            $this->send_notification($L2_director_email, $from, $from_name, $subject, $email_message_body);
        }
        
    }

    function view_leave_balance() {
        $is_authorized = $this->common_lib->is_auth(array(
            'crud-leave-balance'
        ));
		if($this->input->post('form_action') == 'download'){
            $this->download_to_excel();
        }
		$this->data['page_title'] = 'Leave Balance Table';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/view_leave_balance', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_leave_bal_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->leave_model->get_leave_bal_datatable();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->leave_model->get_leave_bal_datatable(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->leave_model->get_leave_bal_datatable(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $result['user_emp_id'];
            $row[] = $result['user_firstname'].' '.$result['user_lastname'];
            $row[] = ($result['cl'] == NULL) ? '--' : $result['cl'];
            $row[] = ($result['pl'] == NULL) ? '--' : $result['pl'];
            $row[] = ($result['sl'] == NULL) ? '--' : $result['sl'];
            $row[] = ($result['co'] == NULL) ? '--' : $result['co'];
            //$row[] = ($result['ol'] == NULL) ? '--' : $result['ol'];
            $row[] = $this->common_lib->display_date($result['balance_date'], false);
            $row[] = $this->common_lib->display_date($result['created_on'], true);
            $row[] = $this->common_lib->display_date($result['updated_on'], true);
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

    function download_to_excel(){
        $excel_heading = array(
            'A' => 'user_index',
            'B' => 'employee_id',
            'C' => 'employee_name',
            'D' => 'casual_leave',
            'E' => 'priviledge_leave',
            'F' => 'sick_leave',
            'G' => 'comp_off',
            'H' => 'time_stamp',
            'I' => 'bal_index'
        );
        $this->data['xls_col'] = $excel_heading;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        $sheet = $this->excel->getActiveSheet();
        //name the worksheet
        $sheet->setTitle('Leave_Balance');

        $result_array = $this->leave_model->get_leave_bal_datatable(NULL, NULL, NULL, TRUE, FALSE);
        $data_rows = $result_array['data_rows'];

        $range = range('A', 'Z');
        $heading_row = 1;
        $index = 0;
        foreach ($excel_heading as $column => $heading_display) {
            $sheet->setCellValue($range[$index] . $heading_row, $heading_display);
            $index++;
        }
        $excel_row = 2;
        foreach ($data_rows as $index => $row) {
            $sheet->setCellValue('A' . $excel_row, $row['user_id']);
            $sheet->setCellValue('B' . $excel_row, $row['user_emp_id']);
            $sheet->setCellValue('C' . $excel_row, $row['user_firstname'].' '.$row['user_lastname']);
            $sheet->setCellValue('D' . $excel_row, $row['cl']);
            $sheet->setCellValue('E' . $excel_row, $row['pl']);
            $sheet->setCellValue('F' . $excel_row, $row['sl']);
            $sheet->setCellValue('G' . $excel_row, $row['co']);
            $sheet->setCellValue('H' . $excel_row, date('Y-m-d'));
            $sheet->setCellValue('I' . $excel_row, $row['bal_pk_index']);
            $excel_row++;
        }


        // Color Config
        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '0')
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '80bfff'),
            ),
            'font' => array(
                'bold' => true
            )
        );
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4d4d4d')
                )
            )
        );
        //$sheet->getDefaultStyle()->applyFromArray($styleArray);
        $sheet->getStyle('A1:I1')->applyFromArray($style_header);
        //$sheet->getStyle('A1:G1')->getFont()->setSize(9);
        //$sheet->getDefaultStyle()->getFont()->setSize(10);
        $sheet->getDefaultColumnDimension()->setWidth('17');
        $filename = 'Leave_Balance_' . date('d-m-Y_H:i:s') . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}

?>
