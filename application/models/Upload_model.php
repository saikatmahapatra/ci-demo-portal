<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($postdata, $table = NULL) {
        if ($table == NULL) {
            $this->db->insert('uploads', $postdata);
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
            $result = $this->db->update('uploads', $postdata);
        } else {
            $result = $this->db->update($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function delete($where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->delete('uploads');
        } else {
            $result = $this->db->delete($table);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function get_uploads($upload_related_to = NULL, $upload_related_to_id = NULL, $id = NULL, $upload_file_document_type_name = NULL) {
        $this->db->select('t1.*');
        if ($id) {
            $this->db->where('id', $id);
        }
        if ($upload_related_to) {
            $this->db->where('upload_related_to', $upload_related_to);
        }

        if ($upload_related_to_id) {
            $this->db->where('upload_related_to_id', $upload_related_to_id);
        }
        if ($upload_file_document_type_name) {
            $this->db->where('upload_file_type_name', $upload_file_document_type_name);
        }
        $query = $this->db->get('uploads t1');
        $result = $query->result_array();
        return $result;
    }
    

}
