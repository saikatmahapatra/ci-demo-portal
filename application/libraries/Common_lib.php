<?php

/**
 * Common Library
 * This library is responsible for all common operation required by controllers
 * @access public
 * @author Saikat Mahapatra <mahapatra.saikat@gmail.com>
 * @copyright (c) 2017, Saikat Mahapatra
 * 
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_lib {

    var $CI;
    var $data;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('user_model');
        $this->CI->data['alert_message'] = NULL;
        $this->CI->data['alert_message_css'] = NULL;
    }

    /**
     * Load common view elements like header, footer, sidebar etc
     * @param type $template_view_elements_dir_name
     * @param type $title
     * @param type $meta_keywords
     * @param type $meta_desc
     * @param type $meta_author
     * @return type
     */
    function init_template_elements($template_view_elements_dir_name = NULL, $title = NULL, $meta_keywords = NULL, $meta_desc = NULL, $meta_author = NULL) {
        $el_type = isset($template_view_elements_dir_name) ? $template_view_elements_dir_name : 'site';

        $this->CI->data['sess_user_name'] = isset($this->CI->session->userdata['sess_user']['user_firstname']) ? ucwords(strtolower($this->CI->session->userdata['sess_user']['user_firstname'])) : 'Guest';
        $this->CI->data['sess_user_id'] = isset($this->CI->session->userdata['sess_user']['id']) ? ucwords(strtolower($this->CI->session->userdata['sess_user']['id'])) : NULL;

        if (strtolower($el_type) == 'site') {
            $this->CI->data['el_html_tag_title'] = isset($title) ? $title : $this->CI->config->item('app_html_title');
			
			//$this->CI->data['el_user_profile_pic'] = isset($this->CI->session->userdata['sess_user']['id'])? $this->get_user_profile_img(): null;
            $this->CI->data['el_html_tag_meta_keywords'] = isset($meta_keyword) ? $meta_keyword : $this->CI->config->item('app_meta_keywords');
            $this->CI->data['el_html_tag_meta_description'] = isset($meta_desc) ? $meta_desc : $this->CI->config->item('app_meta_description');
            $this->CI->data['el_html_tag_meta_author'] = isset($meta_author) ? $meta_author : $this->CI->config->item('app_meta_author');
            $this->CI->data['el_html_head'] = $this->CI->load->view('site/_layouts/elements/html_head', $this->CI->data, true);
            $this->CI->data['el_navbar'] = $this->CI->load->view('site/_layouts/elements/navbar', $this->CI->data, true);
            $this->CI->data['el_footer'] = $this->CI->load->view('site/_layouts/elements/footer', $this->CI->data, true);
            
        }
        if (strtolower($el_type) == 'admin') {
            $this->CI->data['el_html_tag_title'] = isset($title) ? $title : $this->CI->config->item('app_admin_html_title');
			//$this->CI->data['el_user_profile_pic'] = isset($this->CI->session->userdata['sess_user']['id'])? $this->get_user_profile_img(): null;
            $this->CI->data['el_html_head'] = $this->CI->load->view('admin/_layouts/elements/html_head', $this->CI->data, true);
            $this->CI->data['el_navbar'] = $this->CI->load->view('admin/_layouts/elements/navbar', $this->CI->data, true);            
            $this->CI->data['el_footer'] = $this->CI->load->view('admin/_layouts/elements/footer', $this->CI->data, true);
        }
        return $this->CI->data;
    }

    /**
     * This will add javascript(controller and its all view specific) through controller.
     * @param type $app_js
     * @return string
     */
    function add_javascript($app_js = array()) {
        $common_js_src = array(
            'assets/dist/js/ajax.js',            
            'assets/dist/js/app.js'         
        );
        $scripts_src = array_merge($common_js_src, $app_js);
        $script_tag = '';
        $current_timestamp = time();        
        foreach ($scripts_src as $key => $src) {
            $script_tag.='<script src="' . base_url($src.'?t='.$current_timestamp) . '"></script>' . "\n";
        }
        return $script_tag;
    }

    /**
     * Create app log file
     * @param type $path
     * @param type $file_name
     * @param type $data
     * @param type $mode
     */
    function write_log($path = 'log/', $file_name = NULL, $data = NULL, $mode = 'x+') {
        $this->CI->load->helper('file');
        //$data = 'Welcome';
        //$file_name = time() . '.txt';
        //$path = 'app_log/';
        $file = $path . $file_name;
        $res = write_file($file, $data, $mode);
    }

    function render_pagination($total_rows, $limit_per_page = NULL, $additional_segment = NUll) {
        $this->CI->load->library('pagination');
        $directory = $this->CI->router->directory;
        $controller = $this->CI->router->class;
        $method = $this->CI->router->method;
        if (count($_GET) > 0) {
            $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        }
        //$config['base_url'] = base_url() . $directory . $controller . '/' . $method . $additional_segment . '/page/';
        $config['base_url'] = base_url() . $additional_segment . '/page/';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = ($limit_per_page == NULL) ? '20' : $limit_per_page;
        $config['uri_segment'] = $this->CI->uri->total_segments(); #print_r(end($this->CI->uri->segment_array()));
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';


        $config['prev_link'] = '&lt;&lt;';
        $config['prev_tag_open'] = '<li class="page-item prev">';
        $config['prev_tag_close'] = '</li>';


        $config['next_link'] = '&gt;&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';


        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['first_url'] = ''; //An alternative URL to use for the “first page” link.


        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['anchor_class'] = 'page-link';
		$config['attributes'] = array('class' => 'page-link');
        $config['display_pages'] = TRUE; // TRUE = Show number | FALSE = Hide Nos, Show Next, Prev Link
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        $this->CI->pagination->initialize($config);
        return $this->CI->pagination->create_links();
    }

    function upload_file($html_control, $upload_param) {
        $config['upload_path'] = realpath(APPPATH . '../' . $upload_param['upload_path']);
        $config['allowed_types'] = (!empty($upload_param['allowed_types'])) ? $upload_param['allowed_types'] : 'gif|jpg|png|jpeg|pdf|doc|docx|rtf|text|txt';
        $config['max_size'] = isset($upload_param['max_size']) ? $upload_param['max_size'] : '4096'; //4 MB
        $file_name = $_FILES[$html_control]['name'];
        $config['file_name'] = isset($upload_param['file_new_name']) ? $upload_param['file_new_name'] : $file_name;
        $this->CI->load->library('upload', $config);
        if (!$this->CI->upload->do_upload($html_control)) {
            return array('upload_error' => $this->CI->upload->display_errors());
            //$this->CI->form_validation->set_message($html_control, $this->CI->upload->display_errors());
            //return false;
        } else {
            $this->CI->data = array('upload_data' => $this->CI->upload->data());
            $this->file_full_upload_path = $upload_param['upload_path'] . '/' . $this->CI->data['upload_data']['file_name'];
            //For image upload
            if (isset($upload_param['large_img_require']) && ($upload_param['large_img_require'] == TRUE)) {
                $this->large_image_path = $upload_param['large_img_path'] . '/' . $this->CI->data['upload_data']['file_name'];
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->file_full_upload_path;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['max_width'] = $upload_param['large_img_width'];
                $config['max_height'] = $upload_param['large_img_height'];
                $config['width'] = $upload_param['large_img_width'];
                $config['height'] = $upload_param['large_img_height'];
                $config['new_image'] = $this->large_image_path;
                $this->CI->load->library('image_lib', $config);
                $this->CI->image_lib->initialize($config);
                $this->CI->image_lib->resize();
                $this->CI->image_lib->clear();
            }
            if (isset($upload_param['thumb_img_require']) && ($upload_param['thumb_img_require'] == TRUE)) {
                $this->thumb_image_path = $upload_param['thumb_img_path'] . '/' . $this->CI->data['upload_data']['file_name'];
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->file_full_upload_path;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['max_width'] = $upload_param['thumb_img_width'];
                $config['max_height'] = $upload_param['thumb_img_height'];
                $config['width'] = $upload_param['thumb_img_width'];
                $config['height'] = $upload_param['thumb_img_height'];
                $config['new_image'] = $this->thumb_image_path;
                $this->CI->load->library('image_lib', $config);
                $this->CI->image_lib->initialize($config);
                $this->CI->image_lib->resize();
                $this->CI->image_lib->clear();
            }
            if (isset($upload_param['small_img_require']) && ($upload_param['small_img_require'] == TRUE)) {
                $this->small_image_path = $upload_param['small_img_path'] . '/' . $this->CI->data['upload_data']['file_name'];
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->file_full_upload_path;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['max_width'] = $upload_param['small_img_width'];
                $config['max_height'] = $upload_param['small_img_height'];
                $config['width'] = $upload_param['small_img_width'];
                $config['height'] = $upload_param['small_img_height'];
                $config['new_image'] = $this->small_image_path;
                $this->CI->load->library('image_lib', $config);
                $this->CI->image_lib->initialize($config);
                $this->CI->image_lib->resize();
                $this->CI->image_lib->clear();
            }
            if (isset($upload_param['check_img_size']) && ($upload_param['check_img_size'] == true)) {
                $image_width = $this->CI->data['upload_data']['image_width'];
                $image_height = $this->CI->data['upload_data']['image_height'];
                $allowed_img_width = $upload_param['allowed_img_width'];
                $allowed_img_height = $upload_param['allowed_img_height'];
                $is_valid = $this->is_valid_dimension($image_width, $image_height, $allowed_img_width, $allowed_img_height);
                if ($is_valid == true) {
                    return $this->CI->data['upload_data'];
                } else {
                    @unlink($this->file_full_upload_path);
                    @unlink($this->large_image_path);
                    @unlink($this->thumb_image_path);
                    @unlink($this->small_image_path);
                    return array('upload_error' => 'Image dimension not matching.');
                }
            }
            if (isset($upload_param['unlink_source_file']) && ($upload_param['unlink_source_file'] == TRUE)) {
                unlink($this->file_full_upload_path);
            }
            //For image upload ends
            return $this->CI->data['upload_data'];
        }
    }

    function is_valid_dimension($image_width, $image_height, $name) {
        $image_valid_dimensions = $this->CI->config->item('image_valid_dimensions');
        $validate_dimension = $image_valid_dimensions[$name];
        $value = explode("|", $validate_dimension);
        if ($value[0] == $image_width and $value[1] == $image_height) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function unlink_file($path) {
        foreach ($path as $key => $value) {
            if (file_exists($value)) {
                unlink($value);
            }
        }
    }

    function generate_rand_number($length = 4, $append_date = true) {
        // We are removine confusing characters
        // Small case    :    i, o,s 
        // Upper case    :    I, O, S
        // Digits        :    1(One), 0(zero), 5(Five)
        $str = "";
        $chars = "2346789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        if ($append_date == true) {
            $str = date('mdy') . $str;
        }
        return $str;
    }

    function generate_password($length = 6) {
        $str = "";
        $chars = "2346789ABCDEFGHJKLMNPQRTUVWX@$%!";    // Remove confuing digits, alphabets
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    function recursive_remove_directory($directory) {
        foreach (glob("{$directory}/*") as $file) {
            if (is_dir($file)) {
                recursive_remove_directory($file);
            } else {
                unlink($file);
            }
        }
        rmdir($directory);
    }

    /**
     * 
     * @param type $key_name
     * @return boolean
     */
    function get_sess_user($key_name = NULL) {
        if (isset($this->CI->session->userdata['sess_user'])) {
            if (isset($key_name)) {
                try {
                    return $this->CI->session->userdata['sess_user'][$key_name];
                } catch (Exception $ex) {
                    return $ex->getMessage();
                }
            } else {
                return $this->CI->session->userdata['sess_user'];
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Is user logged in
     * @return boolean
     */
    function is_logged_in() {
        $result = FALSE;
        if (isset($this->CI->session->userdata['sess_user']) && (isset($this->CI->session->userdata['sess_user']['id']))) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        return $result;
    }

    /**
     * Redirect if user not logged
     * @return type
     */
    function auth_user($login_screen_name = 'site') {
        $is_logged_id = $this->is_logged_in();
        if ($is_logged_id == FALSE) {
            if ($login_screen_name == 'site') {
                redirect('user/login');
            }
            if ($login_screen_name == 'admin') {
                redirect('admin/user/login');
            }
        }
    }

    function get_user_role() {
        $res = array();
        $user_role_id = $this->CI->session->userdata['sess_user']['user_role'];
        $role = $this->CI->user_model->get_user_role($user_role_id);
        if (isset($role)) {
            $res = $role[0];
        }
        return $res;
    }

    /**
     * Check user authorization
     * @param type $check_permissions
     * @param type $redirect
     * @param type $redirect_uri
     */
    function check_user_role_permission($check_permissions, $redirect = TRUE, $redirect_uri = NULL) {
        $match_count = 0;
        $result = array('is_granted' => FALSE, 'status' => '0', 'message' => 'checking permission');
        $user_role_id = $this->CI->session->userdata['sess_user']['user_role'];
        $arr_user_permissions = $this->CI->user_model->get_user_role_permission($user_role_id);
        if (isset($check_permissions) && count($check_permissions) > 0) {
            if (isset($arr_user_permissions) && count($arr_user_permissions) > 0) {
                $match_count = count(array_intersect($arr_user_permissions, $check_permissions));
                if ($match_count > 0) {
                    $result = array('is_granted' => TRUE, 'status' => '2', 'message' => 'some of the permissions match found and validated');
                } else {
                    $this->CI->session->unset_userdata('sess_user');
                    $result = array('is_granted' => FALSE, 'status' => '3', 'message' => 'no permissions match found or validated');
                }
            } else {
                $this->CI->session->unset_userdata('sess_user');
                $result = array('is_granted' => FALSE, 'status' => '5', 'message' => 'user role and permission list not found in database');
            }
        } else {
            $result = array('is_granted' => TRUE, 'status' => '6', 'message' => 'no permissions checking array passed');
        }
        //print_r($result);
        //die();
        if ($redirect == TRUE && $result['is_granted'] == FALSE) {
            $uri = isset($redirect_uri) ? $redirect_uri : $this->router->directory.'/user/auth_error';
            redirect($uri);
        }
        //return $result;
    }
	
	/*Get User profile Image*/
	function get_user_profile_img() {
		//$res = array();
        $data = $this->CI->user_model->get_user_profile_pic($this->CI->session->userdata['sess_user']['id']);
		return $data[0]['user_profile_pic'];
    }

}

?>