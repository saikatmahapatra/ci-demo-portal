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
$config['app_admin_email'] = 'portaladmin@unitedexploration.co.in';
$config['app_admin_email_cc'] = '';
$config['app_admin_email_bcc'] = '';
$config['app_admin_email_name'] = 'UEIPL Portal Admin';
$config['app_email_subject_prefix'] = 'UEIPL Portal - ';


/*
 * Template Config
 */
$config['app_company_product'] = 'United Exploration India Pvt. Ltd.';
$config['app_logo_name_login'] = '<b>Admin</b> Dashboard';
$config['app_logo_name_dashboard'] = '<b>Admin</b>';
$config['app_logo_name_dashboard_xs'] = '<b>CI</b>A';

$config['app_html_title'] = 'Employee Portal - United Exploration India Pvt. Ltd.';
$config['app_admin_html_title'] = 'United Exploration India Pvt. Ltd.';
$config['app_meta_keywords'] = 'Code Igniter project';
$config['app_meta_description'] = '';
$config['app_meta_author'] = 'UEIPL';


$config['app_copy_right'] = 'Copyright '.date('Y').' &copy; United Exploration India Pvt. Ltd.';
$config['app_admin_copy_right'] = 'Copyright &copy; '.date('Y').' <a href="http://unitedexploration.co.in/">United Exploration India Pvt. Ltd.</a>. All rights reserved.';
$config['app_ui_version'] = 'v1.0.1';
$config['app_admin_ui_version'] = '2.3.6';
