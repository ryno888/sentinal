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
        $data['person'] = lib_db::load_db_default("person");
        
        $this->load->library("lib_html");
        $this->load_view('person/vadd', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vedit() {
        
        $data['person'] = lib_db::load_db("person", "per_id = ".$this->request("per_id"));
        $data['result_arr'] = lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        
        $this->load->library("lib_html");
        $this->load->library("lib_html_manage");
        
        $data['html'] = $this->load->view('person/vedit', $data, true);
        $this->load_view('person/vmanage', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vmanage() {
        $data['person'] = lib_db::load_db("person", "per_id = ".$this->request("per_id"));
        $data['result_arr'] = lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        $data["panel"] = $this->request("p");
        
        $this->load->library("lib_html");
        $this->load->library("lib_html_manage");
        $this->load->library("lib_list");
        
        $this->load_view('person/vmanage', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vprofile() {
        
        $data['person'] = lib_db::load_db("person", "per_id = ".lib_user::get_active_id());
        $data['result_arr'] = lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        
        $this->load->library("lib_html");
        $this->load_view('person/vprofile', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function xadd() {
        $this->load->library("lib_html");
        $this->form_validation->set_rules('per_firstname', "Firstname", "required");
        $this->form_validation->set_rules('per_lastname', "Surname", "required");
        $this->form_validation->set_rules('per_gender', "Gender", "required");
        $this->form_validation->set_rules('per_grade', "Grade", "required");
        $this->form_validation->set_rules('per_birthday', "Birthday", "required");
        $this->form_validation->set_rules('per_year_in_class', "Year in class", "required");
        $this->form_validation->set_rules('per_previous_grade', "Previous Grade", "required");
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
    public function xprofile() {
        $this->load->library("lib_html");
        $this->form_validation->set_rules('per_firstname', "Firstname", "required");
        $this->form_validation->set_rules('per_lastname', "Surname", "required");
        $this->form_validation->set_rules('per_password', "Password", "trim|min_length[8]");
        $this->form_validation->set_rules('per_password_confirm', 'Confirm Password', 'trim|min_length[8]|matches[per_password]');
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
