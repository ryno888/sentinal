
<?php
//    console('No direct script access allowed');
//    $this->load->library("html/Lib_html_calendar");
    
//    $this->load->library("html/Lib_html_calendar", NULL, 'my_calendar');

    // Calendar class is now accessed using:

    echo Lib_html_tags::idatetime("date1", "test", Lib_date::strtodatetime("Today - 1 day"), []);
    echo Lib_html_tags::idate_picker("date2", "test", Lib_date::strtodatetime("Today - 1 day"), []);

    $html_calendar = new Lib_html_calendar();
    $html_calendar->set_selected_date();
    $calendar_class = Lib_db::load_db("calendar", false, ["multiple" => true]);
    
    foreach ($calendar_class->obj_arr as $calendar) {
        $html_calendar->add_event(
            $calendar->id, 
            $calendar->cal_starttime, 
            $calendar->cal_name
        );
    }   
    
    $html_calendar->add_event_modal();
    $html_calendar->edit_event_modal(["form_action" => "calendar/xedit_event"]);
    
    $html_calendar->display();
?>

