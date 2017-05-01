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
        $calendar = $this->request_db("calendar", "event_id");
                                    
        Http_helper::json([
            "code"=> 1, 
            "event_id"=> $calendar->id, 
            "event_title"=> $calendar->get("cal_name"), 
            "details"=> $calendar->get("cal_description"), 
            "all_day_date" => Lib_date::strtodate($calendar->get("cal_starttime"), Lib_date::$DATE_FORMAT_12),
            "start_time" => Lib_date::strtodatetime($calendar->get("cal_starttime"), Lib_date::$DATE_FORMAT_13),
            "end_time" => Lib_date::strtodatetime($calendar->get("cal_endtime"), Lib_date::$DATE_FORMAT_13),
        ]);
    }
    //--------------------------------------------------------------------------
    public function xadd_event() {
        $add_event_all_day = request("add_event_all_day");
        if($add_event_all_day){
            $this->form_validation->set_rules('add_all_day_date', "Date", "required");
        }else{
            $this->form_validation->set_rules('add_cal_starttime', "Start Time", "required");
            $this->form_validation->set_rules('add_cal_endtime', "End Time", "required");
        }
        $this->form_validation->set_rules('add_cal_name', "Event Name", "required");
        if($this->form_validation->run() == false){
            return Http_helper::error(1, validation_errors());
        }
        $calendar = Lib_db::load_db_default("calendar");
        $calendar->obj->cal_name = request("add_cal_name");
        $calendar->obj->cal_description = request("add_cal_description");
        if($add_event_all_day){
            $all_day_date = request("add_all_day_date");
            $calendar->obj->cal_all_day_event = 1;
            $calendar->obj->cal_starttime = Lib_date::strtodatetime($all_day_date, "Y-m-d 00:00:00");
            $calendar->obj->cal_endtime = Lib_date::strtodatetime($all_day_date, "Y-m-d 23:59:59");
        }else{
            $calendar->obj->cal_starttime = Lib_date::strtodatetime(str_replace(" -", "", request("add_cal_starttime")));
            $calendar->obj->cal_endtime = Lib_date::strtodatetime(str_replace(" -", "", request("add_cal_endtime")));
        }
        $calendar->insert();
    }
    //--------------------------------------------------------------------------
    public function xedit_event() {
        $event_id = request("event_id");
        $event_title = request("event_title");
        $details = request("details");
        $all_day_date = request("all_day_date");
        $start_time = request("start_time");
        $end_time = request("end_time");
        
        $calendar = $this->request_db("calendar", "event_id");
        $calendar->obj->cal_name = $event_title;
        $calendar->obj->cal_description = $details;
        $calendar->obj->cal_starttime = Lib_date::strtodatetime(str_replace(" -", "", $start_time));
        $calendar->obj->cal_endtime = Lib_date::strtodatetime(str_replace(" -", "", $end_time));
        $calendar->update();
    }
    //--------------------------------------------------------------------------
    public function vadd_modal() {
        $lib_modal = new Lib_modal("Add Event");
        $lib_modal->form("calendar/xadd_event", "form_modalAddEvent");
        $lib_modal->add_menu_submitbutton("Save Changes");
        $lib_modal->add_menu_button("Cancel", "javascript:;", ["@data-dismiss" => "modal"]);
        $lib_modal->set_id("modalAddEvent");
        $lib_modal->add_column("half");
            $lib_modal->itext("Event Name", "add_cal_name");
            $lib_modal->idatetime("Start Time", "add_cal_starttime", false, ["start_view" => 1]);
            $lib_modal->idatetime("End Time", "add_cal_endtime", false, ["start_view" => 1]);
        $lib_modal->end_column();
        $lib_modal->add_column("half");
            $lib_modal->itextarea("Details", "add_cal_description");
        $lib_modal->end_column();
        $lib_modal->display();              
    }
    //--------------------------------------------------------------------------
}
