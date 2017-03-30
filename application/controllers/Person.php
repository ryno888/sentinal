<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $active_id = Lib_user::get_active_id();
        if(!$active_id){
            Http_helper::go_home();
        }
    }
    //--------------------------------------------------------------------------
    public function vlist() {
        
        $data['search'] = $this->request("__search");
        $this->load->library("Lib_list");
        $this->load_view('person/vlist', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vadd() {
        
        $data['result_arr'] = Lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        $data['person'] = Lib_db::load_db_default("person");
        
        $this->load->library("Lib_html");
        $this->load_view('person/vadd', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vedit() {
        
        $data['person'] = $this->request_db("person");
        $data['result_arr'] = Lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        
        $this->load->library("Lib_html");
        $this->load->library("Lib_html_manage");
        
        $data['html'] = $this->load->view('person/vedit', $data, true);
        $this->load_view('person/vmanage', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vmanage() {
        $data['person'] = $this->request_db("person");
        $data['result_arr'] = Lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        $data["panel"] = $this->request("p");
        
        $this->load->library("Lib_html");
        $this->load->library("Lib_html_manage");
        $this->load->library("Lib_html_tab");
        $this->load->library("Lib_list");
        $this->load_view('person/vmanage', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function vprofile() {
        
        $data['person'] = Lib_db::load_db("person", "per_id = ".Lib_user::get_active_id());
        $data['result_arr'] = Lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");
        
        $this->load->library("Lib_html");
        $this->load_view('person/vprofile', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function xadd() {
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('per_firstname', "Firstname", "required");
        $this->form_validation->set_rules('per_lastname', "Surname", "required");
        $this->form_validation->set_rules('per_gender', "Gender", "required");
        $this->form_validation->set_rules('per_grade', "Grade", "required");
        $this->form_validation->set_rules('per_birthday', "Birthday", "required");
        $this->form_validation->set_rules('per_year_in_class', "Year in class", "required");
        $this->form_validation->set_rules('per_previous_grade', "Previous Grade", "required");
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        
        $person = $this->request_obj("person");
        $person->insert();
        $person->add_role("STUDENT");
        
        return Http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "redirect",
                "url" => "person/vmanage/per_id/$person->id",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
    public function xedit() {
        $this->load->library("Lib_html");
        $person = $this->request_obj("person", true);
        
        
        $this->form_validation->set_rule_db($person, 'per_lastname');
        $this->form_validation->set_rule_db($person, 'per_gender');
        $this->form_validation->set_rule_db($person, 'per_grade');
        $this->form_validation->set_rule_db($person, 'per_birthday');
        $this->form_validation->set_rule_db($person, 'per_year_in_class');
        $this->form_validation->set_rule_db($person, 'per_previous_grade');
        $this->form_validation->set_rule_db($person, 'per_year_in_phase');
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        
        $person->update();
        return Http_helper::response("Changes successfully saved");
    }
    //--------------------------------------------------------------------------
    public function xprofile() {
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('per_firstname', "Firstname", "required");
        $this->form_validation->set_rules('per_lastname', "Surname", "required");
        $this->form_validation->set_rules('per_password', "Password", "trim");
        $this->form_validation->set_rules('per_password_confirm', 'Confirm Password', 'trim|matches[per_password]');
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        
        $person = $this->request_obj("person", true);
        $person->update();
        return Http_helper::response("Changes successfully saved");
    }
    //--------------------------------------------------------------------------
    public function xdelete() {
        console($this->request("id"));
        return Http_helper::error(1, ["test"]);
    }
    //--------------------------------------------------------------------------
    public function xstream_observation_sheet() {
        $person = request_db("person");
        $this->load->model("mod_pdf");
        $this->mod_pdf->set_person($person);
        $this->mod_pdf->generate_observation_sheet();
    }
    //--------------------------------------------------------------------------
}
