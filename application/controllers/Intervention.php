<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intervention extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $active_id = lib_user::get_active_id();
        if(!$active_id){
            http_helper::go_home();
        }
    }
    //--------------------------------------------------------------------------
    public function vadd() {
        $data['person'] = $this->request_db("person");
        $data['intervention'] = lib_db::load_db_default("intervention");
        $this->load->library("lib_html");
        $this->load->library("lib_list");
        $this->load_view('intervention/vadd', "system", $data);
    }
    //--------------------------------------------------------------------------
}
