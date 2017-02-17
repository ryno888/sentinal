<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    //--------------------------------------------------------------------------
	public function page_not_found() {
        $this->load->view('layout/system/header');
        $this->load->view('errors/cli/error_404');
        $this->load->view('layout/system/footer');
    }
    //--------------------------------------------------------------------------
    public function studio()
	{
        $this->load->view('layout/system/header');
		$this->load->view('system/studio_example');
        $this->load->view('layout/system/footer');
	}
    //--------------------------------------------------------------------------
    public function xhome() {
        http_helper::go_home();
    }
     //--------------------------------------------------------------------------
    public function verror() {
        $this->load->view('layout/system/header');
		$this->load->view('errors/error');
        $this->load->view('layout/system/footer');
    }
    //--------------------------------------------------------------------------
    public function vview_error() {
        $file = $this->input->get_post('file');
        $data["error"] = file_get_contents(DIR_LOGS."$file");
        $this->load->view('errors/view_error', $data);
    }
    //--------------------------------------------------------------------------
    public function xclear_error() {
        //add the header here
        $file = $this->input->get_post('file');
        if(file_exists(DIR_LOGS."$file")){
            unlink(DIR_LOGS."$file");
        }
        
        $error_html = error_helper::check_errors();
        
        header('Content-Type: application/json');
        echo json_encode( $error_html );
        
    }
    //--------------------------------------------------------------------------
}
