<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Holiday_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($postdata, $table = NULL) {
        if ($table == NULL) {
            $this->db->insert('holidays', $postdata);
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
            $result = $this->db->update('holidays', $postdata);
        } else {
            $result = $this->db->update($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function delete($where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->delete('holidays');
        } else {
            $result = $this->db->delete($table);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function get_rows($id = NULL, $limit = NULL, $offset = NULL, $dataTable = FALSE, $checkPaging = TRUE) {
        $result = array();
        $this->db->select('t1.*');
        if ($id) {
            $this->db->where('t1.id', $id);
        }

        ####################################################################
        ##################### Display using Data Table #####################
        ####################################################################
        if ($dataTable == TRUE) {
            //set column field database for datatable orderable
            $column_order = array(
                't1.holiday_date',
                't1.holiday_description',
                NULL,
            );            
            //set column field database(table column name) for datatable searchable
            $column_search = array(
                't1.holiday_date',
                't1.holiday_description'
                );
             // default order
            $order = array(
                't1.holiday_date' => 'desc'
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
        $query = $this->db->get('holidays as t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }
	
	function get_holidays($id = NULL, $limit = NULL, $offset = NULL, $dataTable = FALSE, $checkPaging = TRUE) {
        $result = array();
        $this->db->select('t1.*');
        if ($id) {
            $this->db->where('t1.id', $id);
        }
		if($limit){
           $this->db->limit($limit, $offset);
        }
		$this->db->where(
			array(
			'YEAR(`holiday_date`)' => date('Y'),
			)
		);
		$this->db->order_by('t1.holiday_date', 'asc');
        $query = $this->db->get('holidays as t1');
        //print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }
}
