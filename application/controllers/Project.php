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
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
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
            'Y'=>array('text'=>'Active', 'css'=>'text-success'),
            'N'=>array('text'=>'Inactive', 'css'=>'text-warning'),
            'A'=>array('text'=>'Archived', 'css'=>'text-danger')
        );
		
    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		
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
            $row[] = '<i class="fa fa-fw fa-bookmark-o '.$this->data['arr_status_flag'][$result['project_status']]['css'].'" aria-hidden="true"></i> '.$this->data['arr_status_flag'][$result['project_status']]['text'];
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' .$result['id']), '<i class="fa fa-fw fa-edit" aria-hidden="true"></i>', array(
                'class' => 'btn btn-sm btn-outline-secondary',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            /*$action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), '<i class="fa fa-fw fa-trash" aria-hidden="true"></i> Delete', array(
                'class' => 'btn btn-sm btn-outline-danger btn-delete',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Delete',
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
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
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
                    $this->session->set_flashdata('flash_message', 'Data Added Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
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
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
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
                    $this->session->set_flashdata('flash_message', 'Data Updated Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
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
            $this->session->set_flashdata('flash_message', 'Data Deleted Successfully.');
            $this->session->set_flashdata('flash_message_css', 'alert-success');
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

    function activity() {
        // Check user permission by permission name mapped to db
        // $is_authorized = $this->common_lib->is_auth('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		
		$this->data['page_title'] = 'Timesheet Activities';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/activity', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function render_activity_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->project_model->get_activity_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->project_model->get_activity_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->project_model->get_activity_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $result['task_activity_name'];
            $row[] = '<i class="fa fa-fw fa-bookmark-o '.$this->data['arr_status_flag'][$result['task_activity_status']]['css'].'" aria-hidden="true"></i> '.$this->data['arr_status_flag'][$result['task_activity_status']]['text'];
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_activity/' .$result['id']), '<i class="fa fa-fw fa-edit" aria-hidden="true"></i>', array(
                'class' => 'btn btn-sm btn-outline-secondary',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            /*$action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), '<i class="fa fa-fw fa-trash" aria-hidden="true"></i> Delete', array(
                'class' => 'btn btn-sm btn-outline-danger btn-delete',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Delete',
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

    function validate_activity_form_data($action = NULL) {		
        $this->form_validation->set_rules('task_activity_name', ' ', 'required');			
        $this->form_validation->set_rules('task_activity_status', ' ', 'required');
		$this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function add_activity() {        
		$this->breadcrumbs->push('Add','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_activity_form_data('add') == true) {

                $postdata = array(
                    'task_activity_name' => $this->input->post('task_activity_name'),
                    'task_activity_status' => $this->input->post('task_activity_status')
                );
                $insert_id = $this->project_model->insert($postdata,'task_activities');
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', 'Data Added Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect($this->router->directory.$this->router->class.'/add_activity');
                }
            }
        }
		$this->data['page_title'] = 'Add Activity';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/add_activity', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function edit_activity() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('cms-edit');
		//$this->data['page_title'] = "Edit Page Content";
		$this->breadcrumbs->push('Edit','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_activity_form_data('edit') == true) {
                $postdata = array(
                    'task_activity_name' => $this->input->post('task_activity_name'),
                    'task_activity_status' => $this->input->post('task_activity_status')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->project_model->update($postdata, $where_array, 'task_activities');
                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Data Updated Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->project_model->get_activity_rows($this->id);
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_title'] = 'Edit Activity';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit_activity', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

}

?>
