<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    //--------------------------------------------------------------------------
	public function page_not_found() {
        $this->load_view('errors/cli/error_404', "web");
    }
    //--------------------------------------------------------------------------
    public function xhome() {
        $active_id = Lib_user::get_active_id();
        if(!$active_id){
            Http_helper::redirect("index.php/index/vlogin");
        }
        Http_helper::redirect("index.php/person/vlist");
    }
    //--------------------------------------------------------------------------
    public function vlogin() {
        $active_id = Lib_user::get_active_id();
        if($active_id){ Http_helper::go_home(); }
        $this->set_meta_title("Login");
        $this->load_view('index/vlogin', "web");
    }
    //--------------------------------------------------------------------------
    public function verror() {
        $this->load_view('errors/error', "web");
    }
    //--------------------------------------------------------------------------
    public function vview_error() {
        $file = request('file');
        $data["error"] = file_get_contents(DIR_LOGS."$file");
        $this->load->view('errors/view_error', $data);
    }
    //--------------------------------------------------------------------------
    public function xlogin() {
        //add the header here
        $per_usernamme = request('per_usernamme');
        $per_password = request('per_password');
        $result = Lib_user::login($per_usernamme, $per_password);
        echo $result ? Http_helper::json(["code"=> 1]) : Http_helper::json(["code"=> 2, "title" => "Username & Password incorrect", "message" => "The username and password combination you have used is incorrect. Please try again."]);
    }
    //--------------------------------------------------------------------------
    public function xlogin_fb() {
        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');
        $result = com_user::login($username, $password);
        echo $result ? "true" : "false";
    }
    //--------------------------------------------------------------------------
    public function xlogout() {
        $session = Lib_session::get_session();
        $session->sess_destroy();
        Http_helper::go_home();
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
}
