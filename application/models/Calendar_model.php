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
        $start = $this->input->get_post('start');
        $end = $this->input->get_post('end');
        $eventList = array();
        $cond = array();
        $rs_holidays = $this->get_holidays($start, $end, $cond);
        
        if(isset($rs_holidays['data_rows']) && sizeof($rs_holidays['data_rows']) > 0){
          foreach($rs_holidays['data_rows'] as $key => $val){
            //print_r($val);
            $eventList[$key]['title'] = $val['holiday_description'];
            $eventList[$key]['start'] = $val['holiday_date'];
            //$eventList[$key]['overlap'] = false;
            //$eventList[$key]['rendering'] = 'background';
            $eventList[$key]['color'] = '#dc3545';
            $eventList[$key]['textColor'] = '#fff';
            $eventList[$key]['className'] = 'nnmmm';
          }
        }
        


        return json_encode($eventList);

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

}