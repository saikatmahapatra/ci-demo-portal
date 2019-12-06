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
		
		$this->load->model('timesheet_model');
		$this->id = $this->uri->segment(3);
		
		//Dropdown
		$this->data['project_arr'] = $this->timesheet_model->get_project_dropdown();
		$this->data['task_task_activity_type_array'] = $this->timesheet_model->get_activity_dropdown();
		$this->data['timesheet_hours'] = $this->timesheet_model->get_timesheet_hours_dropdown();
		
		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_title'] = $this->router->class.' : '.$this->router->method;
        
    }
	
	function index() {
		$year = $this->uri->segment(3) ? $this->uri->segment(3) : date('Y');
		$month = $this->uri->segment(4) ? $this->uri->segment(4) : date('m');
		$day = date('d');
		
		$template='';
		$template.='{table_open}<table id="timesheet_calendar" class="table ci-calendar table-sm" border="0" cellpadding="" cellspacing="" data-today="'.date('Y-m-d').'" data-current-year="'.date('Y').'" data-current-month="'.date('m').'" data-cal-year="'.$year.'" data-cal-month="'.$month.'" >{/table_open}';
		$template.='{heading_row_start}<tr class="mn">{/heading_row_start}';
		$template.='{heading_previous_cell}<th class="prevcell"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}';
		$template.='{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}';
		$template.='{heading_next_cell}<th class="nextcell"><a href="{next_url}" >&gt;&gt;</a></th>{/heading_next_cell}';
		$template.='{heading_row_end}</tr>{/heading_row_end}';
		$template.='{week_row_start}<tr class="wk_nm">{/week_row_start}';
		$template.='{week_day_cell}<td>{week_day}</td>{/week_day_cell}';
		$template.='{week_row_end}</tr>{/week_row_end}';
        
        $css_days_rows = '';
        //$css_days_rows = ($month != date('m'))? 'disabled_m': 'allowed_m';
        
        $day_css = 'disabled_day';
        $prev_month = date('m', strtotime("last month"));
        //if( ($month == date('m') && $year == date('Y')) || ($day <= '03' && $month == $prev_month) ){
        if( ($month == date('m') && $year == date('Y')) ){
            $day_css = 'allowed_day';
        }
        
		$template.='{cal_row_start}<tr class="'.$css_days_rows.'">{/cal_row_start}';
        $template.='{cal_cell_start}<td data-calday="'.$day_css.'" class="day">{/cal_cell_start}';
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
		$this->data['page_title'] = 'Timesheet';
		
		$this->add();
		
        $this->data['maincontent'] = $this->load->view($this->router->class.'/index', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }
	
	function add() {
        //Check user permission by permission name mapped to db
        //$is_authorized = $this->common_lib->is_auth('timesheet-add');
        if ($this->input->post('form_action') == 'add') {
			//$this->data['remaining_description_length'] = (200 - strlen($this->input->post('timesheet_description')));
            if ($this->validate_form_data('add') == true) {
				$selected_date_arr = explode(',', $this->input->post('selected_date'));
				//print_r($selected_date_arr); die();
				$batch_post_data = array();
				
				foreach($selected_date_arr as $key=>$date){
					$batch_post_data[$key] = array(
						'timesheet_date' => $date,
						'project_id' => $this->input->post('project_id'),
						'activity_id' => $this->input->post('activity_id'),
						'timesheet_hours' => $this->input->post('timesheet_hours'),
						'timesheet_description' => $this->input->post('timesheet_description'),
						'timesheet_created_by' => $this->sess_user_id,					
						'timesheet_created_on' => date('Y-m-d H:i:s')					
					);
				}
                $insert_id = $this->timesheet_model->insert_batch($batch_post_data);
                if ($insert_id) {
                    $this->common_lib->set_flash_message('Timesheet Entry Added Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }
    }
	
	function validate_form_data($action = NULL) {
        if($action != 'edit'){
            $this->form_validation->set_rules('selected_date', 'calendar date selection', 'required|callback_check_selected_days');
        }
        $this->form_validation->set_rules('project_id', 'project selection', 'required');
        $this->form_validation->set_rules('activity_id', 'activity selection', 'required');
        $this->form_validation->set_rules('timesheet_hours', 'hours', 'required|numeric|less_than[18]|greater_than[0]');
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
            $row[] = $this->common_lib->display_date($result['timesheet_date']);
            $row[] = $result['project_name'].', '.$result['task_activity_name'];
            $row[] = $result['timesheet_hours'];
            //$row[] = $result['timesheet_description'];
			$html = '';
			//$html.= '<div class="">'.$this->common_lib->display_date($result['timesheet_date']).' <span class="mx-3">'.$result['timesheet_hours'].' hrs</span></div>';			
			//$html.= '<div class="">'.$result['project_number'].' '.$result['project_name'].'<span class="mx-3">'.$result['task_activity_name'].'</span></div>';			
			
            
                //add html for action
                $action_html = '<div class="mt-2">';
                if(($year == $current_year) && ($month == $current_month)){
                    $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' . $result['id']), '<i class="fa fa-fw fa-pencil" aria-hidden="true"></i>', array(
                        'class' => 'btn btn-sm btn-outline-secondary',
                        'data-toggle' => 'tooltip',
                        'data-original-title' => 'Edit',
                        'title' => 'Edit',
                    ));
                    $action_html.='&nbsp;';
                    $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $result['id']), '<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>', array(
                        'class' => 'btn btn-sm btn-outline-danger btn-delete',
                        'data-confirmation'=>false,
                        'data-confirmation-message'=>'Are you sure, you want to delete this?',
                        'data-toggle' => 'tooltip',
                        'data-original-title' => 'Delete',
                        'title' => 'Delete',
                    ));
                }
                $action_html.='</div>';

            $row[] = $result['timesheet_description'].$action_html;
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
                    'timesheet_description' => $this->input->post('timesheet_description'),
                    'timesheet_updated_on' => date('Y-m-d H:i:s')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->timesheet_model->update($postdata, $where_array);

                if ($res) {
                    $this->common_lib->set_flash_message('Data Updated Successfully.','alert-success');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->timesheet_model->get_rows($this->id, NULL, NULL, TRUE, TRUE, TRUE, $current_year, $current_month);
        $this->data['rows'] = $result_array['data_rows'];
        if(sizeof($this->data['rows'])<=0){
            redirect($this->router->directory.$this->router->class);
        }
		$this->data['page_title'] = 'Edit Timesheet';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/edit', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }


	function delete() {
		$this->id= $this->uri->segment(3);
        $where_array = array('id' => $this->id);
        $res = $this->timesheet_model->delete($where_array);
        if ($res) {
            $this->common_lib->set_flash_message('Timesheet Entry Deleted Successfully.','alert-success');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

    function report() {
        // Check user permission by permission name mapped to db
        if($this->input->get_post('redirected_from') != 'reportee_id'){
            $is_authorized = $this->common_lib->is_auth(array(
            'view-employee-timesheet-report'
        ));
        }
        $this->data['user_arr'] = array();
        $this->data['project_arr'] = $this->timesheet_model->get_project_dropdown();		
        $this->data['user_arr'] = $this->timesheet_model->get_user_dropdown();
        //redirected_from=reportee_id
        if($this->input->get('redirected_from') == 'reportee_id'){
            $this->load->model('user_model');
            $reportees = $this->user_model->get_reportee_employee($this->sess_user_id, NULL, NULL, NULL);
            $user_arr = array(''=>'Select Employee');
            if(isset($reportees['data_rows']) && sizeof($reportees['data_rows'])>0){
                foreach ($reportees['data_rows'] as $r) {
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
            if ($this->validate_search_form_data($filter_by_condition) == true) {
                $result_array = $this->timesheet_model->get_report_data(NULL, NULL, NULL, $filter_by_condition);
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
                $result_array = $this->timesheet_model->get_report_data(NULL, $per_page, $offset, $filter_by_condition);
                $this->data['data_rows'] = $result_array['data_rows'];

                if($this->input->get_post('form_action_primary') == 'download'){
                    $this->download_to_excel();
                }
            }
        }

		$this->data['page_title'] = 'Timesheet Report';
        $this->data['maincontent'] = $this->load->view($this->router->class.'/report', $this->data, true);
        $this->load->view('_layouts/layout_default', $this->data);
    }

    function validate_search_form_data($data) {        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('q_emp', ' ', 'required');
        $this->form_validation->set_rules('from_date', ' ', 'required');
        $this->form_validation->set_rules('to_date', ' ', 'required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_days_diff(){
        $from_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('from_date'))); // or your date as well
        $to_date = strtotime($this->common_lib->convert_to_mysql($this->input->post('to_date')));
        $datediff = ($to_date - $from_date);
        $no_day = round($datediff / (60 * 60 * 24));
        if($no_day >= 0 ){
            return true;
        }else{
            $this->form_validation->set_message('validate_days_diff', 'Invalid date range.');
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
        $result_array = $this->timesheet_model->get_report_data(NULL, NULL, NULL, $filter_by_condition);
        $data_rows = $result_array['data_rows'];

        $excel_heading = array(
            'A' => 'Sr No.',
            'B' => 'Date',
            'C' => 'Employee',
            'D' => 'Project',
            'E' => 'Activity',
            'F' => 'Hours',
            'G' => 'Task Description',
            'H' => 'Added On',
            'I' => 'Updated On',
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
            $sheet->setCellValue('E' . $excel_row, $row['task_activity_name']);
            $sheet->setCellValue('F' . $excel_row, $row['timesheet_hours']);
            $sheet->setCellValue('G' . $excel_row, $row['timesheet_description']);
            $sheet->setCellValue('H' . $excel_row, $row['timesheet_created_on']);
            $sheet->setCellValue('I' . $excel_row, $row['timesheet_updated_on']);
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
        $sheet->getStyle('A1:I1')->applyFromArray($style_header);
        $sheet->getStyle('A1:I1')->getFont()->setSize(9);
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
            $result = $this->timesheet_model->get_user_dropdown_searchable($query_str);
            $output_format["results"]= $result;
            print_r(json_encode($output_format)); die();
        }
        
    }

    function get_project_dropdown_searchable(){
        if($this->input->get_post('q')){
            $query_str = $this->input->get_post('q');
            $result = $this->timesheet_model->get_project_dropdown_searchable($query_str);
            $output_format["results"]= $result;
            print_r(json_encode($output_format)); die();
        }
        
    }

}

?>