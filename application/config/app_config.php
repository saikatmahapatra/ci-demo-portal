<?php
/* 
* Application Specific Custom Config Define Here and Use in Application
* $this->config->item('item_key_name');
* Load this file at autoload.php 
* $autoload['config'] = array('app_config');
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Admin Controller, Site Controller and View Directory Config
*/
$config['site_view_dir'] = 'site/'; //application/views/site/
$config['admin_view_dir'] = 'admin/'; //application/views/admin/

/*
 * Email Config Application Team/Admin
 */
$config['app_admin_email'] = 'portal@unitedexploration.co.in';
$config['app_admin_email_cc'] = '';
$config['app_admin_email_bcc'] = '';
$config['app_admin_email_name'] = 'UEIPL Portal';
$config['app_email_subject_prefix'] = 'ePortal -';

$html_email_header = '';
$config['app_email_header'] = $html_email_header;
$html_email_footer = '<div id="message_footer" style="margin-top: 5px; font-size: 11px;"><p>* To view the message, please use an HTML compatible email viewer. This is a system generated email. Please do not reply.</p></div>';
$config['app_email_footer'] = $html_email_footer;
/*
 * Template Config
 */
$config['app_company_product'] = 'United Exploration India Pvt. Ltd.';
$config['app_logo_name_login'] = '<b>Admin</b> Dashboard';
$config['app_logo_name_admin_dashboard'] = 'Portal Admin';
$config['app_logo_name_dashboard'] = 'Employee Portal';
$config['app_logo_name_dashboard_xs'] = '<b>U</b>Aadmin';

$config['app_html_title'] = 'United Exploration India Private Limited';
$config['app_admin_html_title'] = 'United Exploration India Pvt. Ltd.';

$config['app_meta_keywords'] = 'UEIPL, United Exploration Kolkata, GIS Company Kolkata, Coal Mining Consultancy Kolkata, Web GIS company Kolkata, Mining Company';
$config['app_meta_description'] = 'United Exploration India Pvt Ltd is a Kolkata based Mining and Geological consultation company';
$config['app_meta_author'] = '';

$config['app_faq'] = array(
    array('question'=>'Can I log task details of next or previous month ?', 'answer'=>'No. You can log task details for current month\'s up to current date only.'),
    array('question'=>'What should I do if do not find the project name or proper activity name in time sheet ?', 'answer'=>'You need to contact to your HR / Admin person so that they can add the required project name or tasks.'),
    array('question'=>'What should I do if I can not remember my login password ?', 'answer'=>'You can reset the login password and set a new password for your account. Go to login page you will find a link forgot password. On submitting that form with registered email address, you will get a reset password link in your registered email. On clicking that link you will see reset password form.'),
    array('question'=>'How often can I change login password ?', 'answer'=>'You can change your password any time if you want.'),
    array('question'=>'Can I edit the task details I have logged ?', 'answer'=>'Yes. You can update the task details, project, activity, hours etc details.'),
);

$config['app_copy_right'] = 'Copyright '.date('Y').' &copy; United Exploration India Pvt. Ltd.';
$config['app_admin_copy_right'] = 'Copyright &copy; '.date('Y').' <a href="http://unitedexploration.co.in/">United Exploration India Pvt. Ltd.</a>. All rights reserved.';
$config['app_version'] = 'Version '.CI_VERSION.'.15';


