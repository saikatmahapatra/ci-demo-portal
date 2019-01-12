<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($postdata, $table = NULL) {
        if ($table == NULL) {
            $this->db->insert('user_leaves', $postdata);
        } else {
            $this->db->insert($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
	
	function insert_batch($postdata, $table = NULL) {
        if ($table == NULL) {
            $this->db->insert_batch('user_leaves', $postdata);
        } else {
            $this->db->insert_batch($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($postdata, $where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->update('user_leaves', $postdata);
        } else {
            $result = $this->db->update($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        return ($this->db->affected_rows() > 0);
    }

    function delete($where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->delete('user_leaves');
        } else {
            $result = $this->db->delete($table);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function get_rows($id = NULL, $limit = NULL, $offset = NULL, $dataTable = FALSE, $checkPaging = TRUE, $cond=NULL) {
        $result = array();
        //(DATEDIFF(t1.leave_to_date, t1.leave_from_date)+1) leave_days
        $this->db->select('t1.*,
        t2.user_firstname as supervisor_approver_firstname,
        t2.user_lastname as supervisor_approver_lastname,
        t2.user_emp_id as supervisor_approver_emp_id,
        t2.user_email as supervisor_email,

        t3.user_firstname as director_approver_firstname,
        t3.user_lastname as director_approver_lastname,
        t3.user_emp_id as director_approver_emp_id,
        t3.user_email as director_email,

        t4.user_firstname as hr_approver_firstname,
        t4.user_lastname as hr_approver_lastname,
        t4.user_emp_id as hr_approver_emp_id,
        t4.user_email as hr_email,

        t5.user_firstname,
        t5.user_lastname,
        t5.user_emp_id,
        t5.user_email,
        t5.user_email_secondary,
        t5.user_phone1,
        t5.user_phone2
        ');        
        if ($id) {
            $this->db->where('t1.id', $id);
        }
        

        ####################################################################
        ##################### Display using Data Table #####################
        ####################################################################
        if ($dataTable == TRUE) {
            //set column field database for datatable orderable
            $column_order = array(
                't1.leave_from_date',
                't1.leave_to_date',
                NULL,
            );            
            //set column field database(table column name) for datatable searchable
            $column_search = array(
                't1.leave_from_date',
                't1.leave_to_date'
                );
             // default order
            $order = array(
                't1.id' => 'desc'
                );
            $i = 0;
            foreach ($column_search as $item) { // loop column
                if (isset($_REQUEST['search']['value'])) { // if datatable send POST for search
                    if ($i === 0) { // first loop
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_REQUEST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_REQUEST['search']['value']);
                    }
                    if (count($column_search) - 1 == $i) { //last loop
                        $this->db->group_end(); //close bracket
                    }
                }
                $i++;
            }
            if (isset($_REQUEST['order'])) { // here order processing
                $this->db->order_by($column_order[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
            } else if (isset($order)) {
                $this->db->order_by(key($order), $order[key($order)]);
            }
            //Paging, checkPaging flag added for counting filtered rows without limit offset
            if (($checkPaging == TRUE) && (isset($_REQUEST['length']) && $_REQUEST['length'] != -1)) {
                $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
            }//End of paging
        }//if $dataTable
        ####################################################################
        ##################### Display using Data Table Ends ################
        ####################################################################
        else {
            if ($limit) {
                $this->db->limit($limit, $offset);
            }
        }
        $this->db->order_by('t1.id','desc');
        $this->db->join('users t2', 't2.id = t1.supervisor_approver_id', 'left');
        $this->db->join('users t3', 't3.id = t1.director_approver_id', 'left');
        $this->db->join('users t4', 't4.id = t1.hr_approver_id', 'left');
        $this->db->join('users t5', 't5.id = t1.user_id', 'left');
        if(isset($cond['applicant_user_id'])){
            $this->db->where('t1.user_id', $cond['applicant_user_id']);
        }

        if(isset($cond['assigned_to_user_id'])){
            //$this->db->where('t1.supervisor_approver_id', $cond['assigned_to_user_id']);
            //$this->db->where('t1.director_approver_id'= $cond['assigned_to_user_id']);
            $this->db->where('(t1.director_approver_id = "'.$cond['assigned_to_user_id'].'" OR t1.supervisor_approver_id = "'.$cond['assigned_to_user_id'].'")');
            
            //$this->db->where('t1.supervisor_approver_status', 'P');
            //$this->db->or_where('t1.director_approver_status', 'P');
        }
        if(isset($cond['leave_status'])){
            $this->db->where_in('t1.leave_status', $cond['leave_status']);
        }
        $query = $this->db->get('user_leaves as t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function check_leave_date_range($cond){
        $this->db->select('t1.id');                
        if($cond['from_date']){
            $this->db->where('t1.leave_from_date >=', $cond['from_date']);
        }
        if($cond['to_date']){
            $this->db->where('t1.leave_to_date <=', $cond['to_date']);
        }
        if($cond['user_id']){
            $this->db->where('t1.user_id', $cond['user_id']);
        }
        $query = $this->db->get('user_leaves as t1');
        //print_r($this->db->last_query()); die();
        return $num_rows = $query->num_rows();
    }


    function get_leave_balance($id = NULL, $limit = NULL, $offset = NULL, $dataTable = FALSE, $checkPaging = TRUE, $user_id=NULL) {
        $result = array();
        $this->db->select('t1.*,
        t2.user_firstname, t2.user_lastname
        ');        
        if ($id) {
            $this->db->where('t1.id', $id);
        }        
        if ($user_id) {
            $this->db->where('t1.user_id', $user_id);
        } 

        ####################################################################
        ##################### Display using Data Table #####################
        ####################################################################
        if ($dataTable == TRUE) {
            //set column field database for datatable orderable
            $column_order = array(
                't1.leave_from_date',
                't1.leave_to_date',
                NULL,
            );            
            //set column field database(table column name) for datatable searchable
            $column_search = array(
                't1.leave_from_date',
                't1.leave_to_date'
                );
             // default order
            $order = array(
                't1.id' => 'desc'
                );
            $i = 0;
            foreach ($column_search as $item) { // loop column
                if (isset($_REQUEST['search']['value'])) { // if datatable send POST for search
                    if ($i === 0) { // first loop
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_REQUEST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_REQUEST['search']['value']);
                    }
                    if (count($column_search) - 1 == $i) { //last loop
                        $this->db->group_end(); //close bracket
                    }
                }
                $i++;
            }
            if (isset($_REQUEST['order'])) { // here order processing
                $this->db->order_by($column_order[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
            } else if (isset($order)) {
                $this->db->order_by(key($order), $order[key($order)]);
            }
            //Paging, checkPaging flag added for counting filtered rows without limit offset
            if (($checkPaging == TRUE) && (isset($_REQUEST['length']) && $_REQUEST['length'] != -1)) {
                $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
            }//End of paging
        }//if $dataTable
        ####################################################################
        ##################### Display using Data Table Ends ################
        ####################################################################
        else {
            if ($limit) {
                $this->db->limit($limit, $offset);
            }
        }
        $this->db->join('users t2', 't2.id = t1.user_id', 'left');        
        $query = $this->db->get('user_leave_balance as t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        return $result = $query->result_array();
        
    }
}
