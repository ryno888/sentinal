<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $active_id = lib_user::get_active_id();
        if(!$active_id){
            http_helper::go_home();
        }
    }
    //--------------------------------------------------------------------------
    public function vlist() {
        $data['search'] = $this->request("__search");
        $this->load->library("lib_list");
        $this->load_view('person/vlist', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vadd() {
        
        $data['result_arr'] = lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        $data['person'] = lib_core::load_db_default("person");
        
        $this->load->library("lib_html");
        $this->load_view('person/vadd', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vedit() {
        
        $data['person'] = lib_core::load_db("person", "per_id = ".$this->request("per_id"));
        $data['result_arr'] = lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        
        $this->load->library("lib_html");
        $this->load_view('person/vedit', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function xadd() {
        $this->load->library("lib_html");
        $this->form_validation->set_rules('per_grade', "Grade", "required");
        $this->form_validation->set_rules('per_firstname', "Firstname", "required");
        $this->form_validation->set_rules('per_lastname', "Surname", "required");
        if($this->form_validation->run() == false){
            return http_helper::error(1, validation_errors());
        }
        
        $person = $this->request_obj("person");
        $person->insert();
        
        return http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "redirect",
                "url" => "person/vlist",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
    public function xedit() {
        $this->load->library("lib_html");
        $this->form_validation->set_rules('per_firstname', "Firstname", "required");
        $this->form_validation->set_rules('per_lastname', "Surname", "required");
        if($this->form_validation->run() == false){
            return http_helper::error(1, validation_errors());
        }
        
        $person = $this->request_obj("person", true);
        $person->update();
        return http_helper::response("Changes successfully saved");
    }
    //--------------------------------------------------------------------------
    public function xdelete() {
        console($this->request("id"));
        return http_helper::error(1, ["test"]);
    }
    //--------------------------------------------------------------------------
}
