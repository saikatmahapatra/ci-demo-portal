<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_user_count() {
        $result = array();
        $this->db->select('count(*) as total');     
		$this->db->where('t1.user_archived', 'N');
        $query = $this->db->get('users t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function get_user_projects() {
        $result = array();
        $this->db->select('count(*) as total');     
		//$this->db->where('t1.project_status', 'N');
        $query = $this->db->get('projects t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function get_user_of_timesheet() {
        $result = array();
        $this->db->select('count(distinct(t1.timesheet_created_by)) as total');        
        $this->db->where(
			array(
			'YEAR(`timesheet_date`)' => date('Y'),
            'MONTH(`timesheet_date`)' => date('m')
			)
		);     
		//$this->db->where('t1.project_status', 'N');
        $query = $this->db->get('timesheet t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }
}
