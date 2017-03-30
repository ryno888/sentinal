<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observation extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $active_id = Lib_user::get_active_id();
        if(!$active_id){
            http_helper::go_home();
        }
    }
    //--------------------------------------------------------------------------
    public function vedit() {
        $data['person'] = $this->request_db("person");
        $data['observation'] = $this->request_db("observation");
        $this->load->library("Lib_html");
        $this->load->library("Lib_list");
        $this->load_view('observation/vedit', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function xedit() {
        $person = $this->request_db("person");
        $observation = $this->request_obj("observation", true);
        
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('obs_info_evening', "Info Evening", "required");
        $this->form_validation->set_rules('obs_report_discuss', "Report Discuss", "required");
        $this->form_validation->set_rules('obs_other_meetings', "Other Meetings", "required");
        $this->form_validation->set_rules('obs_message_book_signed', "Message Book Signed", "required");
        $this->form_validation->set_rules('obs_work_book_signed', "Work Book Signed", "required");
        $this->form_validation->set_rules('obs_homework', "Homework", "required");
        $this->form_validation->set_rules('obs_discipline', "Discipline", "required");
        if($observation->get("obs_term") == 1){
            $this->form_validation->set_rules('obs_adjustment', "Adjustment", "required");
            $this->form_validation->set_rules('obs_neatness', "Neatness", "required");
        }
        if($this->form_validation->run() == false){
            return http_helper::error(1, validation_errors());
        }
        $observation->update();
        return http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "reload",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
    public function xadd() {
        $person = $this->request_db("person");
        $observation = $this->request_obj("observation");
        
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('obs_term', "Term", "required");
        $this->form_validation->set_rules('obs_info_evening', "Info Evening", "required");
        $this->form_validation->set_rules('obs_report_discuss', "Report Discuss", "required");
        $this->form_validation->set_rules('obs_other_meetings', "Other Meetings", "required");
        $this->form_validation->set_rules('obs_message_book_signed', "Message Book Signed", "required");
        $this->form_validation->set_rules('obs_work_book_signed', "Work Book Signed", "required");
        $this->form_validation->set_rules('obs_homework', "Homework", "required");
        $this->form_validation->set_rules('obs_discipline', "Discipline", "required");
        if($observation->get("obs_term") == 1){
            $this->form_validation->set_rules('obs_adjustment', "Adjustment", "required");
            $this->form_validation->set_rules('obs_neatness', "Neatness", "required");
        }
        if($this->form_validation->run() == false){
            return http_helper::error(1, validation_errors());
        }
        
        return http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "redirect",
                "url" => "person/vmanage?per_id=$person->id&p=onservation",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
}
