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
    public function xadd() {
        $this->load->library("lib_html");
        $this->form_validation->set_rules('int_type', "Type", "required");
        $this->form_validation->set_rules('int_remark', "Remark", "required");
        if($this->form_validation->run() == false){
            return http_helper::error(1, validation_errors());
        }
        
        $person = $this->request_db("person");
        $intervention = $this->request_obj("intervention");
        $intervention->insert();
        
        return http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "redirect",
                "url" => "person/vmanage?per_id=$person->id&p=intervention",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
}
