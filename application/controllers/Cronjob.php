<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    var $data;

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
        $this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
        
        /**
         * Command in cPanel
         * /usr/local/bin/php /home/unitedeipl/public_html/portal/index.php cronjob test_cron_job
         */
        
    }

    function user_birthday_reminder(){
        /**
         * Command in cPanel
         * /usr/local/bin/php /home/unitedeipl/public_html/portal/index.php cronjob user_birthday_reminder
         */
        $this->load->model('user_model');
        $result_array = $this->user_model->find_birthday();
        //print_r($result_array['data_rows']); die();

        foreach($result_array['data_rows'] as $key => $val){            
            $html = '<p>Dear '.$val['user_firstname'].' '.$val['user_lastname'].', <br> Wishing you a very happy birthday.</p>';
            $html.= '<p style="font-size:10px;">This is a system generated email. Please do not reply.</p>';
            //echo $html;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($val['user_email']);

            if(isset($val['user_email_secondary'])){
                $this->email->cc($val['user_email_secondary']);
            }
            
            $this->email->from($this->config->item('app_admin_email'), $this->config->item('app_admin_email_name'));
            $this->email->subject('Birthday Wishes');
            $this->email->message($html);
            $result = $this->email->send();
            //echo $this->email->print_debugger();
        }

        
    }

}

?>
