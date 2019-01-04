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


$config['app_copy_right'] = 'Copyright '.date('Y').' &copy; United Exploration India Pvt. Ltd.';
$config['app_admin_copy_right'] = 'Copyright &copy; '.date('Y').' <a href="http://unitedexploration.co.in/">United Exploration India Pvt. Ltd.</a>. All rights reserved.';
$config['app_version'] = 'App Version '.CI_VERSION.'.07';
