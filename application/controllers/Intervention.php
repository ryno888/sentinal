<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intervention extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $active_id = Lib_user::get_active_id();
        if(!$active_id){
            Http_helper::go_home();
        }
    }
    //--------------------------------------------------------------------------
    public function vadd() {
        $data['person'] = $this->request_db("person");
        $data['intervention'] = Lib_db::load_db_default("intervention");
        $this->load->library("Lib_html");
        $this->load->library("Lib_list");
        $this->load_view('intervention/vadd', "system", $data);
    }
    //--------------------------------------------------------------------------
    public function xadd() {
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('int_type', "Type", "required");
        $this->form_validation->set_rules('int_remark', "Remark", "required");
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        
        $person = $this->request_db("person");
        $intervention = $this->request_obj("intervention");
        $intervention->insert();
        
        return Http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "redirect",
                "url" => "person/vmanage/per_id/$person->id/p/intervention",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
    public function xedit() {
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('int_type', "Type", "required");
        $this->form_validation->set_rules('int_remark', "Remark", "required");
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        
        $intervention = $this->request_obj("intervention", true);
        $intervention->update();
        
        return Http_helper::response("Changes successfully saved", [
            "code" => 3,
        ]);
    }
    //--------------------------------------------------------------------------
    public function xdelete() {
        $intervention = request_db("intervention");
        $intervention->delete();
    }
    //--------------------------------------------------------------------------
}
