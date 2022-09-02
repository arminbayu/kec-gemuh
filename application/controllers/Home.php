<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('All_model');
        $this->load->model("user_model");
        // if($this->user_model->isNotLogin()) redirect(site_url('login'));
    }
    public function index() {
        $data = array();
        $this->template->set('title', 'Home');
        $this->template->load('default_layout', 'contents' , 'content/index', $data);
    }

}
