<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {
    //--------------------------------------------------------------------------
    public function vview_error() {
        $file = request('file');
        $data["error"] = file_get_contents(DIR_LOGS."$file");
        $this->load->view('errors/view_error', $data);
    }
    //--------------------------------------------------------------------------
    public function xclear_error() {
        //add the header here
        $file = $this->input->get_post('file');
        if($file == "all"){
            $files_arr = glob(DIR_LOGS."*");
            foreach ($files_arr as $file) {
                if(basename($file) != "index.html"){
                    unlink($file);
                }
            }
        }else{
            if(file_exists(DIR_LOGS."$file")){
                unlink(DIR_LOGS."$file");
            }
        }
        
        $error_html = Error_helper::check_errors();
        
        
        Http_helper::json($error_html);
    }
    //--------------------------------------------------------------------------
    public function xget_calendar() {
        $date = request("date");
        $selected_date = request("selected_date");
        $html_calendar = new Lib_html_calendar($date);
        $html_calendar->set_selected_date($selected_date);
        $html_calendar->display();
    }
    //--------------------------------------------------------------------------
}
