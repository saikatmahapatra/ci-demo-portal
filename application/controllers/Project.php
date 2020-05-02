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
        $this->load->model('project_model');
        $this->id = $this->uri->segment(3);
        //View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
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
            'Y'=>array('text'=>'Active', 'css'=>''),
            'N'=>array('text'=>'Inactive', 'css'=>''),
            'A'=>array('text'=>'Archived', 'css'=>'')
        );
		
    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
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
            //$row[] = $result['tc'];
            $row[] = '<span class="'.$this->data['arr_status_flag'][$result['project_status']]['css'].'">'.$this->data['arr_status_flag'][$result['project_status']]['text'].'</span>';
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' .$result['id']), $this->common_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'btn btn-sm btn-light text-secondary',
                'title' => 'Edit',
            ));
            // $action_html.='&nbsp;';
            // $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/project_tasks/pid/' .$result['id']), $this->common_lib->get_icon('list', 'dt_action_icon'), array(
            //     'class' => 'btn btn-sm btn-light text-secondary',
            //     'title' => 'Tasks',
            // ));
            /*$action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), $this->common_lib->get_icon('delete','dt_action_icon') Delete', array(
                'class' => 'btn btn-sm btn-light text-secondary btn-delete',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'title' => 'Delete',
            ));*/

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
		$this->breadcrumbs->push('Add','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_form_data('add') == true) {

                $postdata = array(
                    'project_number' => $this->input->post('project_number'),
                    'project_name' => $this->input->post('project_name'),
                    'project_desc' => $this->input->post('project_desc'),
                    'project_status' => $this->input->post('project_status')
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
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-edit');
		//$this->data['page_title'] = "Edit Page Content";
		$this->breadcrumbs->push('Edit','/');
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_form_data('edit') == true) {
                $postdata = array(
                    'project_number' => $this->input->post('project_number'),
                    'project_name' => $this->input->post('project_name'),
                    'project_desc' => $this->input->post('project_desc'),
                    'project_status' => $this->input->post('project_status')
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
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-delete');

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
        $this->form_validation->set_rules('project_status', 'project status', 'required');				
		$this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function tasks() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
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
            
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_task/' .$result['id']), $this->common_lib->get_icon('edit', 'dt_action_icon'), array(
                'class' => 'btn btn-sm btn-light text-secondary',
                'title' => 'Edit',
            ));
            /*$action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), $this->common_lib->get_icon('delete','dt_action_icon') Delete', array(
                'class' => 'btn btn-sm btn-light text-secondary btn-delete',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'title' => 'Delete',
            ));*/

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

    function validate_task_form_data($action = NULL) {		
        $this->form_validation->set_rules('task_name', ' ', 'required');
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
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-edit');
		//$this->data['page_title'] = "Edit Page Content";
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

}

?>
