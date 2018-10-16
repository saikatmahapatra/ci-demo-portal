<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timesheet extends CI_Controller {

    var $data;
	var $id;
    var $sess_user_id;

    function __construct() {
        parent::__construct();
        //Loggedin user details
        $this->sess_user_id = $this->common_lib->get_sess_user('id');        
        
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
		
		$this->load->model('timesheet_model');
		$this->id = $this->uri->segment(3);
		
		//Dropdown
		$this->data['project_arr'] = $this->timesheet_model->get_project_dropdown();
		$this->data['task_task_activity_type_array'] = $this->timesheet_model->get_activity_dropdown();
		$this->data['timesheet_hours'] = $this->timesheet_model->get_timesheet_hours_dropdown();
		
		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
        
    }
	
	function index() {
		$year = $this->uri->segment(3) ? $this->uri->segment(3) : date('Y');
		$month = $this->uri->segment(4) ? $this->uri->segment(4) : date('m');
		$day = date('d');
		
		$template='';
		$template.='{table_open}<table class="table ci-calendar table-sm" border="0" cellpadding="" cellspacing="">{/table_open}';
		$template.='{heading_row_start}<tr class="mn">{/heading_row_start}';
		$template.='{heading_previous_cell}<th class="prevcell"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}';
		$template.='{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}';
		$template.='{heading_next_cell}<th class="nextcell"><a href="{next_url}" >&gt;&gt;</a></th>{/heading_next_cell}';
		$template.='{heading_row_end}</tr>{/heading_row_end}';
		$template.='{week_row_start}<tr class="wk_nm">{/week_row_start}';
		$template.='{week_day_cell}<td>{week_day}</td>{/week_day_cell}';
		$template.='{week_row_end}</tr>{/week_row_end}';
		
		$css_days_rows = ($month != date('m'))? 'disabled_m': 'allowed_m';
		$template.='{cal_row_start}<tr class="'.$css_days_rows.'">{/cal_row_start}';
		
		$template.='{cal_cell_start}<td class="day">{/cal_cell_start}';
		$template.='{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}';
		$template.='{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}';
		$template.='{cal_cell_no_content}{day}{/cal_cell_no_content}';
		$template.='{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}';
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
		$this->data['page_heading'] = 'Timesheet : '.$month_name.' '.$year;
		
		$this->add();
		
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function add() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('timesheet-add');
        
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_form_data('add') == true) {
                
				$selected_date_arr = explode(',', $this->input->post('selected_date'));
				//print_r($selected_date_arr); die();
				$batch_post_data = array();
				foreach($selected_date_arr as $key=>$day){
					$year = $this->uri->segment(3) ? $this->uri->segment(3) : date('Y');
					$month = $this->uri->segment(4) ? $this->uri->segment(4) : date('m');
					$batch_post_data[$key] = array(
						'timesheet_date' => $year.'-'.$month.'-'.$day,
						'project_id' => $this->input->post('project_id'),
						'activity_id' => $this->input->post('activity_id'),
						'timesheet_hours' => $this->input->post('timesheet_hours'),
						'timesheet_description' => $this->input->post('timesheet_description'),
						'timesheet_created_by' => $this->sess_user_id					
					);
				}
                $insert_id = $this->timesheet_model->insert_batch($batch_post_data);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', 'Timesheet Entry Added Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
    }
	
	function validate_form_data($action = NULL) {
        $this->form_validation->set_rules('selected_date', 'calendar date selection', 'required');
        $this->form_validation->set_rules('project_id', 'project selection', 'required');
        $this->form_validation->set_rules('activity_id', 'activity selection', 'required');
        $this->form_validation->set_rules('timesheet_hours', 'time spent', 'required|numeric|less_than[18]|greater_than[0]');
        $this->form_validation->set_rules('timesheet_description', 'description', 'required|max_length[200]');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
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
			$result_array = $this->timesheet_model->get_timesheet_stats($year, $month, $user_id);			
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
	
	function render_datatable() {
		$year = $this->input->get_post('year') ? $this->input->get_post('year') : date('Y');
        $month = $this->input->get_post('month') ? $this->input->get_post('month') : date('m');
        $current_year = date('Y');
        $current_month = date('m');
        $user_id = $this->sess_user_id;
        //Total rows - Refer to model method definition
        $result_array = $this->timesheet_model->get_rows(NULL, NULL, NULL, FALSE, FALSE, TRUE, $year, $month, $user_id);
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->timesheet_model->get_rows(NULL, NULL, NULL, TRUE, FALSE, TRUE, $year, $month, $user_id);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->timesheet_model->get_rows(NULL, NULL, NULL, TRUE, TRUE, TRUE, $year, $month, $user_id);
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
			
			$html = '<div class="font-weight-bold">'.$this->common_lib->display_date($result['timesheet_date']).' <span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$result['timesheet_hours'].' hrs</span></div>';			
			$html.= '<div class="">'.$result['project_name'].'<span class="float-right">'.$result['task_activity_name'].'</span></div>';			
			
            
                //add html for action
                $action_html = '<span class="float-right">';
                if(($year == $current_year) && ($month == $current_month)){
                $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' . $result['id']), '<i class="fa fa-edit" aria-hidden="true"></i> Edit', array(
                    'class' => 'btn btn-sm btn-outline-secondary mr-2',
                    'data-toggle' => 'tooltip',
                    'data-original-title' => 'Edit',
                    'title' => 'Edit',
                ));            
                $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), '<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                    'class' => 'btn btn-sm btn-outline-danger btn-delete',
                    'data-confirmation'=>false,
                    'data-confirmation-message'=>'Are you sure, you want to delete this?',
                    'data-toggle' => 'tooltip',
                    'data-original-title' => 'Delete',
                    'title' => 'Delete',
                ));
                }
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
    
    function edit() {        					
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        
        $year = $this->input->get_post('year') ? $this->input->get_post('year') : date('Y');
        $month = $this->input->get_post('month') ? $this->input->get_post('month') : date('m');
        $current_year = date('Y');
        $current_month = date('m');

        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_form_data('edit') == true) {
                $postdata = array(                    
                    'project_id' => $this->input->post('project_id'),
                    'activity_id' => $this->input->post('activity_id'),
                    'timesheet_hours' => $this->input->post('timesheet_hours'),
                    'timesheet_description' => $this->input->post('timesheet_description')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->timesheet_model->update($postdata, $where_array);

                if ($res) {
                    $this->session->set_flashdata('flash_message', 'Data Updated Successfully.');
                    $this->session->set_flashdata('flash_message_css', 'alert-success');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->timesheet_model->get_rows($this->id, NULL, NULL, TRUE, TRUE, TRUE, $current_year, $current_month);
        $this->data['rows'] = $result_array['data_rows'];
        if(sizeof($this->data['rows'])<=0){
            redirect($this->router->directory.$this->router->class);
        }
		$this->data['page_heading'] = 'Edit Timesheet Entry for ';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }


	function delete() {
		$this->id= $this->uri->segment(3);
        $where_array = array('id' => $this->id);
        $res = $this->timesheet_model->delete($where_array);
        if ($res) {
            $this->session->set_flashdata('flash_message', 'Timesheet Entry Deleted Successfully.');
            $this->session->set_flashdata('flash_message_css', 'alert-success');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

    function report() {

        // Check user permission by permission name mapped to db
        $is_authorized = $this->common_lib->is_auth(array(
            'view-employee-timesheet-report'
        ));
        $this->data['project_arr'] = $this->timesheet_model->get_project_dropdown();		
        $this->data['user_arr'] = $this->timesheet_model->get_user_dropdown();		
				
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
        $filter_by_condition = array(
            'q_emp' => $this->input->get_post('q_emp'),
            'q_project' => $this->input->get_post('q_project'),
            'from_date' => $this->input->get_post('from_date'),
            'to_date' => $this->input->get_post('to_date')
        );

        if($this->input->get_post('form_action') == 'search'){
            $result_array = $this->timesheet_model->get_report_data(NULL, NULL, NULL, $filter_by_condition);
            $total_num_rows = $result_array['num_rows'];
            
            //pagination config
            $additional_segment = $this->router->directory.$this->router->class.'/'.$this->router->method;
            $per_page = 30;
            $config['uri_segment'] = 4;
            $config['num_links'] = 1;
            $config['use_page_numbers'] = TRUE;
            //$this->pagination->initialize($config);
            
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : 0;
            $offset = ($page*$per_page);
            $this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page, $additional_segment);
            //end of pagination config
            

            // Data Rows - Refer to model method definition
            $result_array = $this->timesheet_model->get_report_data(NULL, NULL, NULL, $filter_by_condition);
            $this->data['data_rows'] = $result_array['data_rows'];
        }

		$this->data['page_heading'] = 'Timesheet Report';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/report', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

}

?>
