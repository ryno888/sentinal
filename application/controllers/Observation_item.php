<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observation_item extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $active_id = Lib_user::get_active_id();
        if(!$active_id){
            Http_helper::go_home();
        }
    }
    //--------------------------------------------------------------------------
    public function xadd() {
        $per_id = request("per_id");
        $obs_id = request("obv_ref_observation");
        $observation_item = $this->request_obj("observation_item");
        
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('obv_date', "Date", "required");
        $this->form_validation->set_rules('obv_content', "Comment", "required");
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        $observation_item->insert();
        
        return Http_helper::response("Changes successfully saved", [
            "code" => 3,
            "action" => [
                "type" => "redirect",
                "url" => "person/vmanage/per_id/$per_id/obs_id/$obs_id/p/vedit_obs/tab/list",
            ],
        ]);
    }
    //--------------------------------------------------------------------------
    public function xedit() {
        $observation_item = $this->request_obj("observation_item", true);
        
        $this->load->library("Lib_html");
        $this->form_validation->set_rules('obv_date', "Date", "required");
        $this->form_validation->set_rules('obv_content', "Comment", "required");
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        $observation_item->update();
        
        return Http_helper::response("Changes successfully saved", [
            "code" => 3,
        ]);
    }
    //--------------------------------------------------------------------------
    public function xdelete() {
        $observation_item = request_db("observation_item");
        $observation_item->delete();
    }
    //--------------------------------------------------------------------------
}
