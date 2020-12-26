<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    var $data;

    function __construct() {
        parent::__construct();
        //Loggedin user details
        $this->sess_user_id = $this->app_lib->get_sess_user('id');        
        
        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->app_lib->init_template_elements();
        
        // Load required js files for this controller
        $javascript_files = array();
        $this->data['app_js'] = $this->app_lib->add_javascript($javascript_files);
        
        
        
        $this->data['page_title'] = $this->router->class.' : '.$this->router->method;
        
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
            $message_html = '';
            $message_html.='<div id="message_wrapper" style="border-top: 2px solid #5133AB;">';
            $message_html.= $this->config->item('app_email_header');
            $message_html.='<div id="message_body" style="padding-top: 5px; padding-bottom:5px;">';
            $message_html.= '<p>Dear '.$val['user_firstname'].' '.$val['user_lastname'].', <br> Wishing you a very Happy Birthday.</p>';
            $message_html.='</div><!--/#message_body-->';
            $message_html.= $this->config->item('app_email_footer');
            $message_html.='</div><!--/#message_wrapper-->';
            
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($val['user_email']);

            if(isset($val['user_email_secondary'])){
                $this->email->cc($val['user_email_secondary']);
            }
            
            $this->email->from($this->config->item('app_admin_email'), $this->config->item('app_admin_email_name'));
            $this->email->subject('Happy Birthday !');
            $this->email->message($message_html);
            $result = $this->email->send();
            //echo $this->email->print_debugger();
        }

        
    }

    function ueipl_work_anniversary_notification(){
        /**
         * Command in cPanel
         * /usr/local/bin/php /home/unitedeipl/public_html/portal/index.php cronjob ueipl_work_anniversary_notification
         */
        $this->load->model('user_model');
        $result_array = $this->user_model->get_employee_anniversary();
        //print_r($result_array); die();

        foreach($result_array['data_rows'] as $key => $val){
            $message_html = '';
            $message_html.='<div id="message_wrapper" style="border-top: 2px solid #5133AB;">';
            $message_html.= $this->config->item('app_email_header');
            $message_html.='<div id="message_body" style="padding-top: 5px; padding-bottom:5px;">';
            $message_html.= '<p>Dear '.$val['user_firstname'].' '.$val['user_lastname'].', </p> <p>Congratulations on reaching '.$this->get_ordinal_suffix($result_array["anniversary"]). ' service milestone with United Exploration India Pvt Ltd.</p><p>The success of our organization is a direct result of your efforts and dedication.  Your commitment to quality and personal and professional integrity is the differentiating factor that sets us apart from our competition. </p><p>Again, Thank You for your hard work and much dedication. We look forward to your ongoing contributions and a bright and successful future together.</p>';
            $message_html.='</div><!--/#message_body-->';
            $message_html.= $this->config->item('app_email_footer');
            $message_html.='</div><!--/#message_wrapper-->';
            
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->to($val['user_email']);

            if(isset($val['user_email_secondary'])){
                //$this->email->cc($val['user_email_secondary']);
            }
            
            $this->email->from($this->config->item('app_admin_email'), $this->config->item('app_admin_email_name'));
            $this->email->subject('Congratulations on your '.$result_array['anniversary'].' years of Service');
            $this->email->message($message_html);
            //echo $message_html;
            $result = $this->email->send();
            //echo $this->email->print_debugger();
        }
    }

    function get_ordinal_suffix($num){
        $num = $num % 100; // protect against large numbers
        if($num < 11 || $num > 13){
             switch($num % 10){
                case 1: return $num.'st';
                case 2: return $num.'nd';
                case 3: return $num.'rd';
            }
        }
        return $num.'th';
    }

    function update_pl_balance(){
        /**
         * Run per month start of day
         * Command in cPanel
         * /usr/local/bin/php /home/unitedeipl/public_html/portal/index.php cronjob credit_pl_balance
         */
        $this->load->model('leave_model');
        $result_array = $this->leave_model->update_pl_balance();
        //echo $result_array;
    }


    function update_cl_balance(){
        /**
         * Run 1st Jan every year
         * Command in cPanel
         * /usr/local/bin/php /home/unitedeipl/public_html/portal/index.php cronjob update_cl_balance
         */
        $this->load->model('leave_model');
        $result_array = $this->leave_model->update_cl_balance();
        //echo $result_array;
    }

    function update_ol_balance(){
        /**
         * Run 1st Jan every year
         * Command in cPanel
         * /usr/local/bin/php /home/unitedeipl/public_html/portal/index.php cronjob update_ol_balance
         */
        $this->load->model('leave_model');
        $result_array = $this->leave_model->update_ol_balance();
        //echo $result_array;
    }
}

?>
