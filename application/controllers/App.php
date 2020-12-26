<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
    }

	function index() {
        $this->data['title'] = 'Please wait. You will be redirected in <span id="countdown">10</span> seconds...';
        $this->load->view('app', $this->data);
    }
}
?>