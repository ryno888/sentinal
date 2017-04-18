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
    public function xlogin() {
        //add the header here
        $per_usernamme = request('per_usernamme');
        $per_password = request('per_password');
        $result = Lib_user::login($per_usernamme, $per_password);
        echo $result ? Http_helper::json(["code"=> 1]) : Http_helper::json(["code"=> 2, "title" => "Username & Password incorrect", "message" => "The username and password combination you have used is incorrect. Please try again."]);
    }
    //--------------------------------------------------------------------------
    public function xregister() {
        //add the header here
        $email = $this->input->get_post('email');
        $firstname = $this->input->get_post('firstname');
        $lastname = $this->input->get_post('lastname');
        $passwd = $this->input->get_post('passwd');
        $icode = $this->input->get_post('icode');
        Http_helper::json(["code"=> 2, "title" => "Username & Password incorrect", "message" => "The username and password combination you have used is incorrect. Please try again."]);
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
}
