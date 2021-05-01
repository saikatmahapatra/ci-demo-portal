<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller {

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
        $this->load->model('project_model');
        $this->id = $this->uri->segment(3);
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Project', '/project');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
		//Pagination
         $this->load->library('pagination');
         
         $this->data['arr_status_flag'] = array(
            'Y'=>array('text'=>'Active', 'css'=>'badge badge-success badge-pill'),
            'N'=>array('text'=>'Inactive', 'css'=>'badge badge-warning badge-pill'),
            'A'=>array('text'=>'Archived', 'css'=>'badge badge-danger badge-pill')
        );
		
    }

    function index() {
        //Has logged in user permission to access this page or method?
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Projects';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->project_model->get_rows();
        $total_rows = $result_array['num_rows'];
        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->project_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];
        // Data Rows - Refer to model method definition
        $result_array = $this->project_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            
            $row[] = $result['project_name'];
            $row[] = $result['project_number'];
            $row[] = $this->common_lib->display_date($result['project_start_date']);
            $row[] = $this->common_lib->display_date($result['project_end_date']);
            //$row[] = $result['tc'];
            $row[] = '<span class="'.$this->data['arr_status_flag'][$result['project_status']]['css'].'">'.$this->data['arr_status_flag'][$result['project_status']]['text'].'</span>';
            $row[] = '<div class="data-table-action-dropdown dropdown">
                <button class="btn btn-dt-action btn-light dropdown-toggle" type="button" id="dropdownMenuButton_'.$result['id'].'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$this->common_lib->get_icon('ellipsis','dt_action_icon').'</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_'.$result['id'].'">
                <a class="dropdown-item" href="'.base_url($this->router->directory.$this->router->class.'/edit/' . $result['id']).'">Edit</a>
                </div>
            </div>';
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
                    'project_number' => $this->input->post('project_number'),
                    'project_name' => $this->input->post('project_name'),
                    'project_desc' => $this->input->post('project_desc'),
                    'project_status' => $this->input->post('project_status'),
                    'project_start_date' => $this->common_lib->convert_to_mysql($this->input->post('project_start_date')),
                    'project_end_date' => $this->common_lib->convert_to_mysql($this->input->post('project_end_date')),
                    'created_on' => date('Y-m-d H:i:s'),
                    'created_by' => $this->sess_user_id
                );
                $insert_id = $this->project_model->insert($postdata);
                if ($insert_id) {
                    $this->common_lib->set_flash_message('Data Added Successfully.','alert-success');
                    redirect($this->router->directory.$this->router->class.'/add');
                }
            }
        }
		$this->data['page_title'] = 'Add Project';
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
                    'project_number' => $this->input->post('project_number'),
                    'project_name' => $this->input->post('project_name'),
                    'project_desc' => $this->input->post('project_desc'),
                    'project_status' => $this->input->post('project_status'),
                    'project_start_date' => $this->common_lib->convert_to_mysql($this->input->post('project_start_date')),
                    'project_end_date' => $this->common_lib->convert_to_mysql($this->input->post('project_end_date')),
                    'updated_on' => date('Y-m-d H:i:s'),
                    'updated_by' => $this->sess_user_id
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->project_model->update($postdata, $where_array);
                if ($res) {
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->project_model->get_rows($this->id);
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_title'] = 'Edit Project';
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
        $res = $this->project_model->delete($where_array);
        if ($res) {
            $this->common_lib->set_flash_message('Data Deleted Successfully.','alert-success');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

    function validate_form_data($action = NULL) {		
        $this->form_validation->set_rules('project_number', 'project code', 'required');			
        $this->form_validation->set_rules('project_name', 'project name', 'required');			
        $this->form_validation->set_rules('project_start_date', 'start date', 'required');			
        $this->form_validation->set_rules('project_end_date', 'end date', 'required|callback_validate_days_diff');			
        $this->form_validation->set_rules('project_status', 'project status', 'required');				
		$this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_days_diff(){
        $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('project_start_date'))); // or your date as well
        $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('project_end_date')));
        $datediff = ($to_date - $from_date);
        $no_day = round($datediff / (60 * 60 * 24));
        if($no_day >= 0 ){
            return true;
        }else{
            $this->form_validation->set_message('validate_days_diff', 'Invalid date range.');
            return false;
        }
    }

    function tasks() {
        //Has logged in user permission to access this page or method?
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('View','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['page_title'] = 'Project Tasks';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/tasks', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_task_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->project_model->get_task_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->project_model->get_task_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->project_model->get_task_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = (isset($result['subtask_parent_name']) ? $result['subtask_parent_name'].' > ' : '').$result['task_name'];
            $row[] = ($result['level'] == '1') ? 'Task' : 'Subtask';
            $row[] = '<span class="'.$this->data['arr_status_flag'][$result['task_status']]['css'].'">'.$this->data['arr_status_flag'][$result['task_status']]['text'].'</span>';
            $row[] = '<div class="data-table-action-dropdown dropdown">
                <button class="btn btn-dt-action btn-light dropdown-toggle" type="button" id="dropdownMenuButton_'.$result['id'].'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$this->common_lib->get_icon('ellipsis','dt_action_icon').'</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_'.$result['id'].'">
                <a class="dropdown-item" href="'.base_url($this->router->directory.$this->router->class.'/edit_task/' . $result['id']).'">Edit</a>
                </div>
            </div>';
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

    function validate_task_form_data($action = NULL) {		
        $this->form_validation->set_rules('task_name', ' ', 'required|callback_validate_unique_task_name');
        if($action == 'edit'){
            $this->form_validation->set_rules('task_status', ' ', 'required');
            $this->form_validation->set_rules('task_parent_id', ' ', 'callback_parent_must_not_same_as_child');
        }
		$this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_unique_task_name($str){
        $task_id = $this->input->post('id');
		if($str){
            $is_unique = $this->project_model->is_unique_value($str, $task_id);
			if($is_unique == false){
                $this->form_validation->set_message('validate_unique_task_name', 'This is already exists.');
				return false;
			}else{
				return true;
			}
		}
    }

    function parent_must_not_same_as_child($str){
        $task_id = $this->input->post('id');
		if($str){
			if($task_id == $str){
                $this->form_validation->set_message('parent_must_not_same_as_child', 'Same task can\'t be a parent task. Please select a different task.');
				return false;
			}else{
				return true;
			}
		}
	}

    function add_task() {
        //Has logged in user permission to access this page or method?
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Add','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_task_form_data('add') == true) {
                $task_parent_id_dd = $this->input->post('task_parent_id');
                $level = 1;
                $level_data = array();
                if($task_parent_id_dd){
                    $level_data = $this->project_model->get_task_level($task_parent_id_dd);
                }
                if(isset($level_data) && sizeof($level_data)>0){
                    $level = $level_data[0]['level']+1;
                }
                //die();
                $postdata = array(
                    'task_parent_id' => $task_parent_id_dd,
                    'level' => $level,
                    'task_name' => $this->input->post('task_name'),
                    'task_status' => 'Y'
                );
                $insert_id = $this->project_model->insert($postdata,'project_tasks');
                if ($insert_id) {
                    $this->common_lib->set_flash_message('Data Added Successfully.','alert-success');
                    redirect($this->router->directory.$this->router->class.'/tasks');
                }
            }
        }
        $this->data['page_title'] = 'Add Task';
        $this->data['task_parent_drop_down'] = $this->project_model->get_task_nested_dropdown(1);
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_task', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function edit_task() {
        //Has logged in user permission to access this page or method?
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Edit','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_task_form_data('edit') == true) {
                //print_r($_POST);die();
                $task_parent_id_dd = $this->input->post('task_parent_id');
                $level = $task_parent_id_dd ? 2 : 1;
                $postdata = array(
                    'task_parent_id' => $task_parent_id_dd,
                    'level' => $level,
                    'task_name' => $this->input->post('task_name'),
                    'task_status' => $this->input->post('task_status')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->project_model->update($postdata, $where_array, 'project_tasks');
                if ($res) {
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect($this->router->directory.$this->router->class.'/tasks');
                }
            }
        }
        $result_array = $this->project_model->get_task_rows($this->id);
        $this->data['rows'] = $result_array['data_rows'];
        $this->data['page_title'] = 'Edit Task';
        $this->data['task_parent_drop_down'] = $this->project_model->get_task_nested_dropdown(1);
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_task', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function project_tasks() {
        //Has logged in user permission to access this page or method?
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access'
        ));
		$this->breadcrumbs->push('Edit','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
            //print_r($_POST);
            if ($this->validate_project_tasks_form_data('edit') == true) {
                foreach($_POST['project_tasks'] as $key=>$val){
                    //echo $val;
                    $postdata[] = array(
                        'project_id' => $this->input->post('project_id'),
                        'task_id_1' => $val
                    );
                }
                $res = $this->project_model->save_project_tasks($postdata, $this->input->post('project_id'));
                if ($res) {
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }
        $this->data['arr_project'] = $this->project_model->get_project_dropdown(1);
        $this->data['arr_task_id_1'] = $this->project_model->get_task_dd(1);
        $this->data['tagged_tasks'] = array();
        if($this->uri->segment(4)){
            $this->data['tagged_tasks'] = $this->project_model->get_tagged_tasks($this->uri->segment(4));
        }
		$this->data['page_title'] = 'Add or Modify Project Tasks';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/project_tasks', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_project_tasks_form_data($action = NULL){
        $this->form_validation->set_rules('project_id', 'project', 'required');
        $this->form_validation->set_rules('project_tasks[]', 'tasks', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function timesheet() {
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-user-access'
        ));
		$year = $this->uri->segment(3) ? $this->uri->segment(3) : date('Y');
		$month = $this->uri->segment(4) ? $this->uri->segment(4) : date('m');
		$day = date('d');
		$options = array(
            'timesheet_apply_settings',
            'timesheet_disable_prev_month',
            'timesheet_disable_next_month',
            'timesheet_enable_prev_days',
            'timesheet_enable_next_days'
        );
        $this->load->model('settings_model');
        $this->data['options'] = $this->settings_model->get_option($options);
		$template='';
		$template.='{table_open}<table id="timesheet_calendar" class="table ci-calendar table-sm" border="0" cellpadding="" cellspacing="" data-today="'.date('Y-m-d').'" data-current-year="'.date('Y').'" data-current-month="'.date('m').'" data-cal-year="'.$year.'" data-cal-month="'.$month.'" data-disable-prev-month="'.$this->data['options']['timesheet_disable_prev_month'].'" data-disable-next-month="'.$this->data['options']['timesheet_disable_next_month'].'" data-enable-prev-days="'.$this->data['options']['timesheet_enable_prev_days'].'" data-enable-next-days="'.$this->data['options']['timesheet_enable_next_days'].'">{/table_open}';
		$template.='{heading_row_start}<tr class="mn">{/heading_row_start}';
		$template.='{heading_previous_cell}<th class="prevcell"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}';
		$template.='{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}';
		$template.='{heading_next_cell}<th class="nextcell"><a href="{next_url}" >&gt;&gt;</a></th>{/heading_next_cell}';
		$template.='{heading_row_end}</tr>{/heading_row_end}';
		$template.='{week_row_start}<tr class="wk_nm">{/week_row_start}';
		$template.='{week_day_cell}<td>{week_day}</td>{/week_day_cell}';
		$template.='{week_row_end}</tr>{/week_row_end}';
        
        $css_days_rows = '';
        $day_css = 'allowed_day';
        
        if(isset($this->data['options']) && $this->data['options']['timesheet_disable_prev_month'] == 'true') {
            if(strtotime(date('Y-m')) > strtotime($year.'-'.$month)){
                $day_css = 'disabled_day';
            }
        }
        if(isset($this->data['options']) && $this->data['options']['timesheet_disable_next_month'] == 'true') {
            if(strtotime(date('Y-m')) < strtotime($year.'-'.$month)){
                $day_css = 'disabled_day';
            }
        }

		$template.='{cal_row_start}<tr class="'.$css_days_rows.'">{/cal_row_start}';
        $template.='{cal_cell_start}<td data-calday="'.$day_css.'" class="day">{/cal_cell_start}';
		$template.='{cal_cell_content}<a href="{content}"><span class="date_value" data-date="'.$year.'-'.$month.'-{day}">{day}</span></a>{/cal_cell_content}';
		$template.='{cal_cell_content_today}<div class="highlight"><a href="{content}"><span class="date_value" data-date="'.$year.'-'.$month.'-{day}">{day}</span></a></div>{/cal_cell_content_today}';
		$template.='{cal_cell_no_content}<span class="date_value" data-date="'.$year.'-'.$month.'-{day}">{day}</span>{/cal_cell_no_content}';
		$template.='{cal_cell_no_content_today}<div class="highlight"><span class="date_value" data-date="'.$year.'-'.$month.'-{day}">{day}</span></div>{/cal_cell_no_content_today}';
		$template.='{cal_cell_blank}&nbsp;{/cal_cell_blank}';
		$template.='{cal_cell_end}</td>{/cal_cell_end}';		
		$template.='{cal_row_end}</tr>{/cal_row_end}';
		$template.='{table_close}</table>{/table_close}';
		$prefs = array (
               'start_day'    => 'monday',
               'month_type'   => 'short',
               'day_type'     => 'short',
			   'show_next_prev'=>TRUE,
			   'template'	  =>  $template
             );
		$this->load->library('calendar',$prefs);
		$this->data['entry_for'] = date('Y/m/d');		
		$data = array();
		$this->data['cal'] = $this->calendar->generate($year,$month,$data);
		$month_name = date('M', mktime(0, 0, 0, $month, 10));		
		$this->data['page_title'] = 'Timesheet';
		
        $this->add_timesheet_log();
        
        $this->data['project_arr'] = $this->project_model->get_project_dropdown();
		
        $this->data['maincontent'] = $this->load->view($this->router->class.'/timesheet', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function add_timesheet_log() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('timesheet-add');
        //$this->data['arr_task_id_1'] = array(''=>'-Select-');
        $this->data['arr_task_id_1'] = $this->project_model->get_task_dropdown('1');
        $this->data['arr_task_id_2'] = array(''=>'-Select-');
        if ($this->input->post('form_action') == 'add') {
            //$this->data['remaining_description_length'] = (200 - strlen($this->input->post('timesheet_description')));
            // if($this->input->post('project_id')){
            //     $this->data['arr_task_id_1'] = $this->project_model->get_project_task_tagging_dropdown($this->input->post('project_id'));
            // }

            if($this->input->post('task_id_1')){
                $this->data['arr_task_id_2'] = $this->project_model->get_task_dropdown('2', $this->input->post('task_id_1'));
            }
            //print_r($this->data['arr_task_id_2']);

            if ($this->validate_timesheet_log_form_data('add') == true) {
				$selected_date_arr = explode(',', $this->input->post('selected_date'));
				//print_r($selected_date_arr); die();
				$batch_post_data = array();
				
				foreach($selected_date_arr as $key=>$date){
					$batch_post_data[$key] = array(
						'timesheet_date' => $date,
						'project_id' => $this->input->post('project_id'),
						'task_id_1' => $this->input->post('task_id_1'),
						'task_id_2' => $this->input->post('task_id_2'),
						'timesheet_hours' => $this->input->post('timesheet_hours'),
						'timesheet_description' => $this->input->post('timesheet_description'),
						'timesheet_created_by' => $this->sess_user_id,					
						'timesheet_created_on' => date('Y-m-d H:i:s')					
					);
				}
                $insert_id = $this->project_model->insert_batch($batch_post_data, 'timesheet');
                if ($insert_id) {
                    $this->common_lib->set_flash_message('Timesheet Entry Added Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }
    }
	
	function validate_timesheet_log_form_data($action = NULL) {
        //print_r($this->data['arr_task_id_2']);
        if($action != 'edit'){
            $this->form_validation->set_rules('selected_date', 'date selection', 'required|callback_check_selected_days');
        }
        $this->form_validation->set_rules('project_id', 'project', 'required|callback_check_project_end_date');
        $this->form_validation->set_rules('task_id_1', 'task', 'required');

        // gt 2 as -Select- also treating as array
        //print_r(array_filter( $this->data['arr_task_id_2'], 'strlen' ));
        if(sizeof($this->data['arr_task_id_2']) >= 2 ){
            $this->form_validation->set_rules('task_id_2', 'sub task', 'required'); // subtask required
        }

        $this->form_validation->set_rules('timesheet_hours', 'hours', 'required|numeric|less_than_equal_to[9]|greater_than[0]');
        $this->form_validation->set_rules('timesheet_description', 'description', 'required|max_length[200]');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }
	
	function check_selected_days(){
		$not_allowed_dates = array();
        $selected_dates = explode(',',$this->input->post('selected_date'));
        $today = date('Y-m-d');
		foreach($selected_dates as $key=>$selected_date){
			if(strtotime($selected_date) > strtotime($today)){
				$not_allowed_dates[] = date('d/m/Y', strtotime($selected_date));
			}
		}
        if(sizeof($not_allowed_dates) <= 0 ){
            return true;
        }else{
            //print_r($not_allowed_dates);
			sort($not_allowed_dates);
			$not_allowed_days_str = implode($not_allowed_dates, ', ');
            $this->form_validation->set_message('check_selected_days', 'You are not allowed to log task for '.$not_allowed_days_str.'. Please unselect the date(s).');
            return false;
        }
    }

    function check_project_end_date($id){
        if($id){
            $data = array();
            $data = $this->project_model->validate_project_end_date($id);
            if($data['allow_timesheet_entry']){
                return true;
            }else{
                $this->form_validation->set_message('check_project_end_date', 'You are not allowed to log tasks for the selected project. This project was ended by '.$this->common_lib->display_date($data['project_end_date']).'. Please contact to your HR/admin for any clarification.');
                return false;
            }
        } else {
            return true;
        }
		
    }
		
	function timesheet_stats(){		
		$year = $this->input->get_post('year') ? $this->input->get_post('year') : date('Y');
        $month = $this->input->get_post('month') ? $this->input->get_post('month') : date('m');
        $user_id =  $this->sess_user_id;		
		$response = array(
            'status' => 'init',
            'message' => '',
            'message_css' => '',
            'data' => array(),
        );		
		if($this->input->post('via')=='ajax'){			
			$result_array = $this->project_model->get_timesheet_stats($year, $month, $user_id);			
			if($result_array['num_rows']>0){
				$response = array(
					'status' => 'ok',
					'message' => 'Records fetched',
					'message_css' => 'alert alert-success',
					'data' => $result_array,
				);
			}else{
				$response = array(
					'status' => 'ok',
					'message' => 'No records found',
					'message_css' => 'alert alert-danger',
					'data' => $result_array,
				);
			}
			echo json_encode($response);die();
		}else{
			die("404: Not Found");
		}
	}
	
	function render_timesheet_datatable() {
		$year = $this->input->get_post('year') ? $this->input->get_post('year') : date('Y');
        $month = $this->input->get_post('month') ? $this->input->get_post('month') : date('m');
        $current_year = date('Y');
        $current_month = date('m');
        $user_id = $this->sess_user_id;
        //Total rows - Refer to model method definition
        $result_array = $this->project_model->get_timesheet_rows(NULL, NULL, NULL, FALSE, FALSE, TRUE, $year, $month, $user_id);
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->project_model->get_timesheet_rows(NULL, NULL, NULL, TRUE, FALSE, TRUE, $year, $month, $user_id);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->project_model->get_timesheet_rows(NULL, NULL, NULL, TRUE, TRUE, TRUE, $year, $month, $user_id);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $this->common_lib->display_date($result['timesheet_date']);
            $row[] = $result['project_name'];
            $row[] = '<span>'.$result['task_name'].'</span>';
            $row[] = $result['timesheet_hours'];
            $row[] = character_limiter($result['timesheet_description'], 30);
			
            $action_html = '<div class="data-table-action-dropdown dropdown">
                <button class="btn btn-dt-action btn-light dropdown-toggle" type="button" id="dropdownMenuButton_'.$result['id'].'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$this->common_lib->get_icon('ellipsis','dt_action_icon').'</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_'.$result['id'].'">
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#timesheetDetailsInfoModal" data-date="'.$this->common_lib->display_date($result['timesheet_date']).'" data-emp="'.$this->common_lib->get_sess_user('user_firstname').' '.$this->common_lib->get_sess_user('user_lastname').'" data-project="'.$result['project_name'].'-'.$result['project_number'].'" data-task="'.$result['task_name'].'" data-hour="'.$result['timesheet_hours'].'" data-desc="'.$result['timesheet_description'].'">View Details</a>';
                if(($year == $current_year) && ($month == $current_month)){
                    $action_html.= '<a class="dropdown-item" href="'.base_url($this->router->directory.$this->router->class.'/edit_timesheet/' . $result['id']).'">Edit</a>
                    <a class="dropdown-item" href="'.base_url($this->router->directory.$this->router->class.'/delete_timesheet/' . $result['id']).'">Delete</a>'; 
                }

            $action_html.='</div>
            </div>';
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

    function get_data($id) {
        $current_year = date('Y');
        $current_month = date('m');
        //$row = array('is_editable'=> true, 'data'=>array());
        $row['is_editable'] = false;
        $row['data'] = array();
        $result_array = $this->project_model->get_timesheet_rows($id, NULL, NULL, TRUE, TRUE, FALSE, NULL, NULL);
        $this->data['rows'] = $result_array['data_rows'];
        //print_r($this->data['rows']); die();
        if(sizeof($this->data['rows']) > 0 ) {
            $timesheet_month = date('m', strtotime($this->data['rows'][0]['timesheet_date']));
            $timesheet_year = date('Y', strtotime($this->data['rows'][0]['timesheet_date']));
            if(($timesheet_month == $current_month) && ($timesheet_year == $current_year)) {
                $row['is_editable'] = true;
            }else {
                $row['is_editable'] = false;
            }
            $row['data'] = $this->data['rows'];
        }
        return $row;
    }
    
    function edit_timesheet() {
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-user-access'
        ));
        $this->data['project_arr'] = $this->project_model->get_project_dropdown();
        //$this->data['arr_task_id_1'] = array(''=>'-Select-');
        $this->data['arr_task_id_1'] = $this->project_model->get_task_dropdown('1');
        $this->data['arr_task_id_2'] = array(''=>'-Select-');
        
        $data = $this->get_data($this->id);
        $this->data['rows'] = $data['data'];
        $is_editable = $data['is_editable'];
        if ($is_editable == true && $this->input->post('form_action') == 'update') {
            // if($this->input->post('project_id')){
            //     $this->data['arr_task_id_1'] = $this->project_model->get_project_task_tagging_dropdown($this->input->post('project_id'));
            // }

            if($this->input->post('task_id_1')){
                $this->data['arr_task_id_2'] = $this->project_model->get_task_dropdown('2', $this->input->post('task_id_1'));
            }
            if ($this->validate_timesheet_log_form_data('edit') == true) {
                $postdata = array(
                    'project_id' => $this->input->post('project_id'),
                    'task_id_1' => $this->input->post('task_id_1'),
                    'task_id_2' => $this->input->post('task_id_2'),
                    'timesheet_hours' => $this->input->post('timesheet_hours'),
                    'timesheet_description' => $this->input->post('timesheet_description'),
                    'timesheet_updated_on' => date('Y-m-d H:i:s')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->project_model->update($postdata, $where_array, 'timesheet');

                if ($res) {
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }

        // if(isset($this->data['rows'][0]['project_id'])){
        //     $this->data['arr_task_id_1'] = $this->project_model->get_project_task_tagging_dropdown($this->data['rows'][0]['project_id']);
        // }
        
        if(!$this->input->post('form_action') && isset($this->data['rows'][0]['task_id_1'])){
            $this->data['arr_task_id_2'] = $this->project_model->get_task_dropdown('2', $this->data['rows'][0]['task_id_1']);
        }

        if($is_editable == false) {
            $this->common_lib->set_flash_message('You will not be able to edit the selected work log.','alert-danger');
            redirect($this->router->directory.$this->router->class.'/timesheet');
        }
		$this->data['page_title'] = 'Edit Timesheet';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_timesheet', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

	function delete_timesheet() {
        $this->common_lib->is_auth(array(
            'default-super-admin-access',
            'default-admin-access',
            'default-user-access'
        ));
        $this->id = $this->uri->segment(3);
        $data = $this->get_data($this->id);
        $is_editable = $data['is_editable'];
        if($is_editable == false) {
            $this->common_lib->set_flash_message('You will not be able to delete the selected work log.','alert-danger');
            redirect($this->router->directory.$this->router->class.'');
        } else{
            $where_array = array('id' => $this->id);
            $res = $this->project_model->delete($where_array, 'timesheet');
            if ($res) {
                $this->common_lib->set_flash_message('Timesheet Entry Deleted Successfully.','alert-success');
                redirect($this->router->directory.$this->router->class.'/timesheet');
            }
        }
    }

    function timesheet_report() {
        // Check user permission by permission name mapped to db
        if($this->input->get_post('redirected_from') != 'reportee_id'){
            $is_authorized = $this->common_lib->is_auth(array(
            'view-employee-timesheet-report'
        ));
        }
        $this->data['user_arr'] = array();
        $this->data['project_arr'] = $this->project_model->get_project_dropdown();		
        $this->data['user_arr'] = $this->project_model->get_user_dropdown();
        //redirected_from=reportee_id
        if($this->input->get('redirected_from') == 'reportee_id'){
            $this->load->model('user_model');
            $reportees = $this->user_model->get_reportee_employee($this->sess_user_id, NULL, NULL, NULL);
            $user_arr = array(''=>'Select Employee');
            $reportess_emp_id_array = array();
            if(isset($reportees['data_rows']) && sizeof($reportees['data_rows'])>0){
                foreach ($reportees['data_rows'] as $r) {
                    $reportess_emp_id_array[] = $r['user_id'];
                    $user_arr[$r['user_id']] = $r['user_firstname'].' '.$r['user_lastname'].' ('.$r['user_emp_id'].')';
                }
            }
            $this->data['user_arr'] = $user_arr;
        }
        

        if($this->input->get_post('form_action') == 'search'){
            //print_r($_REQUEST); die();
            // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
            $filter_by_condition = array(
                'q_emp' => $this->input->get_post('q_emp'),
                'q_project' => $this->input->get_post('q_project'),
                'from_date' => $this->input->get_post('from_date'),
                'to_date' => $this->input->get_post('to_date')
            );

            if($this->input->get_post('redirected_from') == 'reportee_id'){
                if(isset($filter_by_condition['q_emp']) && $filter_by_condition['q_emp'] == '') {
                    $filter_by_condition['q_emp'] = $reportess_emp_id_array;
                }
            }

            if ($this->validate_search_form_data($filter_by_condition) == true) {
                $result_array = $this->project_model->get_report_data(NULL, NULL, NULL, $filter_by_condition);
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
                $result_array = $this->project_model->get_report_data(NULL, $per_page, $offset, $filter_by_condition);
                $this->data['data_rows'] = $result_array['data_rows'];

                if($this->input->get_post('form_action_primary') == 'download'){
                    $this->download_to_excel();
                }
            }
        }

		$this->data['page_title'] = 'Timesheet Report';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/timesheet_report', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_search_form_data($data) {
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('from_date', 'from date', 'required');
        $this->form_validation->set_rules('to_date', 'to date', 'required|callback_validate_timesheet_days_diff');
        //$this->form_validation->set_rules('q_emp', ' ', 'required');
        $this->form_validation->set_error_delimiters('<li class="validation-error">', '</li>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_timesheet_days_diff(){
        $options = array(
            'timesheet_report_max_date_range'
        );
        $this->load->model('settings_model');
        $settings = $this->settings_model->get_option($options);
        if(isset($settings['timesheet_report_max_date_range'])){
            $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->get_post('from_date')));
            $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->get_post('to_date')));
            $datediff = ($to_date - $from_date);
            $no_day = round($datediff / (60 * 60 * 24))+1;
            if($no_day >= 1 ){
                if($no_day > $settings['timesheet_report_max_date_range']){
                    $this->form_validation->set_message('validate_timesheet_days_diff', 'Date range should be less than '. $settings['timesheet_report_max_date_range'].' days.');
                    return false;
                }else{
                    return true;
                }
                
            }else{
                $this->form_validation->set_message('validate_timesheet_days_diff', 'Invalid date range.');
                return false;
            }
        }else{
            $this->form_validation->set_message('validate_timesheet_days_diff', 'Filter range not found in DB');
            return false;
        }
        
    }

    function download_to_excel(){
        $filter_by_condition = array(
            'q_emp' => $this->input->get_post('q_emp'),
            'q_project' => $this->input->get_post('q_project'),
            'from_date' => $this->input->get_post('from_date'),
            'to_date' => $this->input->get_post('to_date')
        );
        $result_array = $this->project_model->get_report_data(NULL, NULL, NULL, $filter_by_condition);
        $data_rows = $result_array['data_rows'];

        $excel_heading = array(
            'A' => 'Sr No.',
            'B' => 'Date',
            'C' => 'Employee',
            'D' => 'Project',
            'E' => 'Task',
            'F' => 'Sub Task',
            'G' => 'Hours',
            'H' => 'Task Description',
            'I' => 'Added On',
            'J' => 'Updated On',
        );
        $this->data['xls_col'] = $excel_heading;
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        $sheet = $this->excel->getActiveSheet();
        //name the worksheet
        $sheet->setTitle('TimeSheet');
        // echo '<pre>';
        // print_r($data_rows);
        // die();
        // read data to active sheet
        //$sheet->fromArray($data_rows);
        
        // Static Fields
        //$sheet->setCellValue('A1', 'Active Account');
        //$sheet->getStyle('A1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'a8ef81'))));
        
        //$sheet->setCellValue('A2', 'Inactive Account');
        //$sheet->getStyle('A2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'f9eb7f'))));
        //End Static Fields

        $range = range('A', 'Z');
        $heading_row = 1;
        $index = 0;
        foreach ($excel_heading as $column => $heading_display) {
            $sheet->setCellValue($range[$index] . $heading_row, $heading_display);
            $index++;
        }


        $excel_row = 2;
        $serial_no = 1;
        foreach ($data_rows as $index => $row) {
            $sheet->setCellValue('A' . $excel_row, $serial_no);
            $sheet->setCellValue('B' . $excel_row, $this->common_lib->display_date($row['timesheet_date']));
            $sheet->setCellValue('C' . $excel_row, $row['user_firstname'].' '.$row['user_lastname']);
            $sheet->setCellValue('D' . $excel_row, $row['project_number'].'-'.$row['project_name']);
            $sheet->setCellValue('E' . $excel_row, $row['task_name']);
            $sheet->setCellValue('F' . $excel_row, $row['task_name']);
            $sheet->setCellValue('G' . $excel_row, $row['timesheet_hours']);
            $sheet->setCellValue('H' . $excel_row, $row['timesheet_description']);
            $sheet->setCellValue('I' . $excel_row, $row['timesheet_created_on']);
            $sheet->setCellValue('J' . $excel_row, $row['timesheet_updated_on']);
            $excel_row++;
            $serial_no++;
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
        $sheet->getDefaultStyle()->applyFromArray($styleArray);
        $sheet->getStyle('A1:J1')->applyFromArray($style_header);
        $sheet->getStyle('A1:J1')->getFont()->setSize(9);
        $sheet->getDefaultStyle()->getFont()->setSize(10);
        $sheet->getDefaultColumnDimension()->setWidth('17');

        $filename = 'Timesheet_' . date('dmY') . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        //echo "ok"; die();
    }

    function get_user_dropdown_searchable(){
        if($this->input->get_post('q')){
            $query_str = $this->input->get_post('q');
            $result = $this->project_model->get_user_dropdown_searchable($query_str);
            $output_format["results"]= $result;
            print_r(json_encode($output_format)); die();
        }
        
    }

    function get_project_dropdown_searchable(){
        if($this->input->get_post('q')){
            $query_str = $this->input->get_post('q');
            $result = $this->project_model->get_project_dropdown_searchable($query_str);
            $output_format["results"]= $result;
            print_r(json_encode($output_format)); die();
        }
        
    }

    function get_project_task(){
        $data_order=$this->input->get_post('data_order');
        $id = $this->input->get_post('id');
        $data_render_target=$this->input->get_post('data_render_target');
        $current_control = $this->input->get_post('current_control');
        $via = $this->input->get_post('via');
        $req_empty_opt = (isset($via) && $via === 'ajax') ?  false :  true;
        //print_r(json_encode($_REQUEST));
        $response = array();
        if($current_control == 'project_id'){
            $res = $this->project_model->get_project_task_tagging_dropdown($id);
        }else{
            $res = $this->project_model->get_task_dropdown($data_order, $id, $req_empty_opt);
        }
        //print_r($res);
        $response['req_param'] = $_REQUEST;
        $response['resp_data'] = $res;
        //sort($response['resp_data']);
        print_r(json_encode($response));
        die();
    }

}

?>
