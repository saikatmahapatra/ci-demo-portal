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
		$this->db->where('t1.user_type', 'U');
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
            'MONTH(`timesheet_date`)' => date('m'),
            'DAY(`timesheet_date`)' => date('d')
			)
		);     
		//$this->db->where('t1.project_status', 'N');
        $query = $this->db->get('timesheet t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function get_user_profile_completion_status($user_id){
        return $message = array();
        $strength = 0;

        // address
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_addresses');
        $num_rows = $query->num_rows();
        if($num_rows <= 0 ){
            $message['address'] = 'Add your permanent, residential address.';
        }

        // emergency contacts
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_emergency_contacts');
        $num_rows = $query->num_rows();
        if($num_rows <= 0 ){
            $message['emergency_contacts'] = 'Add emergency contacts. You can add up to 3 contacts.';
        }

        // education
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_academics');
        $num_rows = $query->num_rows();
        if($num_rows <= 0 ){
            $message['education'] = 'Add academics records.';
        }

        // user approvers
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_approvers');
        $num_rows = $query->num_rows();
        if($num_rows <= 0 ){
            $message['leave_approvers'] = 'Set your Leave approvers.';
        }
        // user_bank_account
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_bank_account');
        $num_rows = $query->num_rows();
        if($num_rows <= 0 ){
            //$message['bank'] = 'Salary Account, PAN etc details.';
        }

        // user_work_exp
        $this->db->select('id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_work_exp');
        $num_rows = $query->num_rows();
        if($num_rows <= 0 ){
            $message['work'] = 'Add your previous work experiences (if any).';
        }

        return $message;
    }
}
