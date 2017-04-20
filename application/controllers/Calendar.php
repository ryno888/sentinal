<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
    //--------------------------------------------------------------------------
	public function page_not_found() {
        $this->load_view('errors/cli/error_404', "web");
    }
    //--------------------------------------------------------------------------
    public function vagenda() {
        $this->load_view('calendar/vagenda', "system");
    }
    //--------------------------------------------------------------------------
    public function xget_event() {
        
        Http_helper::json(["code"=> 1, "date" => Lib_date::strtodate()]);
    }
    //--------------------------------------------------------------------------
}
