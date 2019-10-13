<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($postdata, $table = NULL) {
        if ($table == NULL) {
            $this->db->insert('event_calendar', $postdata);
        } else {
            $this->db->insert($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($postdata, $where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->update('event_calendar', $postdata);
        } else {
            $result = $this->db->update($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function delete($where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->delete('event_calendar');
        } else {
            $result = $this->db->delete($table);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    /**
     * Get records of user timesheet, leave, holiday, other calendar related activities.
     */
    function get_events(){
        $eventList = array();
        // return '[
        //     {
        //       "title": "All Day Event",
        //       "start": "2019-08-01"
        //     },
        //     {
        //       "title": "Leave ID 26737637 - Maternity leave",
        //       "start": "2019-08-07",
        //       "end": "2019-12-10",
        //       "url": "'.base_url('leave/details/37/0922194959').'"
        //     },
        //     {
        //       "id": "999",
        //       "title": "Repeating Event",
        //       "start": "2019-08-09T16:00:00-05:00"
        //     },
        //     {
        //       "id": "999",
        //       "title": "Repeating Event",
        //       "start": "2019-08-16T16:00:00-05:00"
        //     },
        //     {
        //       "title": "Conference",
        //       "start": "2019-08-11",
        //       "end": "2019-08-13"
        //     },
        //     {
        //       "title": "Meeting",
        //       "start": "2019-08-12T10:30:00-05:00",
        //       "end": "2019-08-12T12:30:00-05:00"
        //     },
        //     {
        //       "title": "Lunch",
        //       "start": "2019-08-12T12:00:00-05:00"
        //     },
        //     {
        //       "title": "Meeting",
        //       "start": "2019-08-12T14:30:00-05:00"
        //     },
        //     {
        //       "title": "Happy Hour",
        //       "start": "2019-08-12T17:30:00-05:00"
        //     },
        //     {
        //       "title": "Dinner",
        //       "start": "2019-08-12T20:00:00"
        //     },
        //     {
        //       "title": "Birthday Party",
        //       "start": "2019-08-13T07:00:00-05:00"
        //     },
        //     {
        //       "title": "Click for Google",
        //       "url": "http://google.com/",
        //       "start": "2019-08-28"
        //     }
        //   ]
        //   ';
        $start = $this->input->get_post('start');
        $end = $this->input->get_post('end');        
        $cond = array(
            'user_id' => $this->common_lib->get_sess_user('id'),
        );

        $data1 = array();
        $rs = $this->get_holidays($start, $end, $cond);
        if(isset($rs['data_rows']) && sizeof($rs['data_rows']) > 0){
          foreach($rs['data_rows'] as $key => $val){
            $data1[$key]['title'] = $val['holiday_description'];
            $data1[$key]['start'] = $val['holiday_date'];
            //$data1[$key]['overlap'] = false;
            //$data1[$key]['rendering'] = 'background';
            $data1[$key]['color'] = '#f8d6d9'; // 80% lighten
            $data1[$key]['textColor'] = '#212529';
          }
        }
        
        $data2 = array();
        $rs = $this->get_timesheet_logs($start, $end, $cond);
        if(isset($rs['data_rows']) && sizeof($rs['data_rows']) > 0){
            foreach($rs['data_rows'] as $key => $val){
              //print_r($val);
              //$data2[$key]['title'] = $val['timesheet_hours'].' hrs';
              //$data2[$key]['description'] = $val['project_name'].' : '.$val['timesheet_description'];
              $data2[$key]['title'] = $val['timesheet_hours'].' hrs '.$val['project_name'].' : '.$val['timesheet_description'];
              $data2[$key]['start'] = $val['timesheet_date'];
              //$data2[$key]['overlap'] = false;
              //$data2[$key]['rendering'] = 'background';
              $data2[$key]['color'] = '#cce4fe';
              $data2[$key]['textColor'] = '#212529';
              $data2[$key]['url'] = base_url('timesheet/edit/'.$val['id']);
              //$data2[$key]['allDay'] = false;
            }
          }

          $data3 = array();
          $rs = $this->get_leave_applications($start, $end, $cond);
          $leave_status_arr = array(
            'B'=>array('text'=>'Applied', 'css'=>'text-primary'),
            'P'=>array('text'=>'Pending', 'css'=>'text-secondary'),
            'C'=>array('text'=>'Cancelled', 'css'=>'text-warning'),
            'R'=>array('text'=>'Rejected', 'css'=>'text-danger'),
            'A'=>array('text'=>'Approved', 'css'=>'text-success'),
            'O'=>array('text'=>'Processing', 'css'=>'text-info'),
            'X'=>array('text'=>'Cancel Requested', 'css'=>'text-warning'),
            );
          if(isset($rs['data_rows']) && sizeof($rs['data_rows']) > 0){
            foreach($rs['data_rows'] as $key => $val){
              $data3[$key]['title'] = $leave_status_arr[$val['leave_status']]['text'].' '.$val['leave_type'].'  '.$val['leave_req_id'].' : '.$val['leave_reason'];
              $data3[$key]['start'] = date('c', strtotime($val['leave_from_date']));
              $data3[$key]['end'] = date('c',strtotime($val['leave_to_date']));
              $data3[$key]['color'] = '#fee5d0';
              $data3[$key]['textColor'] = '#212529';
              $data3[$key]['url'] = base_url('leave/details/'.$val['id'].'/'.$val['leave_req_id'].'/calendar');
            }
          }

        $eventList = array_merge($data1, $data2, $data3);
        return json_encode($eventList);
    }

    function get_holidays($start, $end, $cond){
      $start = date('Y-m-d', strtotime($start));
      $end = date('Y-m-d', strtotime($end));
      $result = array();
      $this->db->select('t1.*');
      $this->db->where('holiday_date >=', $start);
      $this->db->where('holiday_date <=', $end);
      $query = $this->db->get('holidays as t1');
      //print_r($this->db->last_query());
      $num_rows = $query->num_rows();
      $result = $query->result_array();
      return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function get_timesheet_logs($start, $end, $cond){
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));
        $result = array();
        $this->db->select('
        t1.id,
        t1.timesheet_date,
        t1.timesheet_hours,
        t1.timesheet_description,
		t2.project_name,
		t3.task_activity_name,
		t4.user_firstname,
		t4.user_lastname
		');
		$this->db->join('projects as t2', 't2.id = t1.project_id', 'left');
		$this->db->join('task_activities as t3', 't3.id = t1.activity_id', 'left');
		$this->db->join('users as t4', 't4.id = t1.timesheet_created_by', 'left');
        if(isset($cond)){
            if($cond['user_id'] != ""){
                $this->db->where('t1.timesheet_created_by', $cond['user_id']);
            }
        }
        $this->db->where('t1.timesheet_date >=', $start);
        $this->db->where('t1.timesheet_date <=', $end);
        $query = $this->db->get('timesheet as t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function get_leave_applications($start, $end, $cond){
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));
        $result = array();
        $this->db->select('
        t1.id,
        t1.leave_req_id,
        t1.leave_from_date,
        t1.leave_to_date,
		t1.leave_reason,
		t1.leave_type,
		t1.leave_status
		');
        if(isset($cond)){
            if($cond['user_id'] != ""){
                $this->db->where('t1.user_id', $cond['user_id']);
            }
        }
        $this->db->where('t1.leave_from_date >=', $start);
        $this->db->where('t1.leave_to_date <=', $end);	
        $query = $this->db->get(' leave_applications as t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }
}