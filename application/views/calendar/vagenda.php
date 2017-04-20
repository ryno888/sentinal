<?php
//    console('No direct script access allowed');
//    $this->load->library("html/Lib_html_calendar");
    
//    $this->load->library("html/Lib_html_calendar", NULL, 'my_calendar');

    // Calendar class is now accessed using:

    $html_calendar = new Lib_html_calendar();
    $html_calendar->set_selected_date();
    
    $date = Lib_date::strtodate();
    $html_calendar->add_event(12, $date, "Teach about food that is healthy", []);
    $html_calendar->add_event(14, $date, "test2", []);
    $html_calendar->add_event(15, $date, "test32", []);
    $html_calendar->add_event(1,$date, "test42", []);
    $html_calendar->add_event(2,$date, "test52", []);
    
    $date = Lib_date::strtodate("NOW - 1 day");
    $html_calendar->add_event(12, $date, "Teach about food that is healthy", []);
    $html_calendar->add_event(14, $date, "test2", []);
    $html_calendar->add_event(15, $date, "test32", []);
    $html_calendar->add_event(1,$date, "test42", []);
    $html_calendar->add_event(2,$date, "test52", []);
    
    
    $lib_modal = new Lib_modal("Add new Event");
    $lib_modal->set_id("modalAddEvent");
    $lib_modal->add_column("half");
        $lib_modal->itext("Event Name", "test");
        $lib_modal->idatetime("date1", "date1");
    $lib_modal->end_column();
    $lib_modal->add_column("half");
        $lib_modal->itext("test", "test");
        $lib_modal->idatetime("date2", "date2");
    $lib_modal->end_column();
    $lib_modal->add_script("
        $('body').on('dblclick','.day', function(e){
            e.preventDefault();
            $('#modalAddEvent').modal('show');
        });
    ");
    $html_calendar->add_modal($lib_modal->display(true));
    
    $lib_modal_edit = new Lib_modal("Edit Event");
    $lib_modal_edit->set_id("modalEditEvent");
    $lib_modal_edit->add_column("half");
        $lib_modal_edit->itext("Event Name", "test");
        $lib_modal_edit->idatetime("Start Time", "start_time");
        $lib_modal_edit->idatetime("End Time", "end_time");
    $lib_modal_edit->end_column();
    $lib_modal_edit->add_column("half");
        $lib_modal_edit->itextarea("Details", "details");
    $lib_modal_edit->end_column();
    $lib_modal_edit->add_script("
        $('body').on('click','.eventItem', function(e){
            e.preventDefault();
            var self = $(this);
            system.ajax.requestFunction('calendar/xget_event', function(response){
                if(response.code == 1){
                    $('#modalEditEvent').modal('show');
                    $('#modalEditEvent #start_time').val(response.date);
                }
            }, {data:{event_id:self.attr('data-id')}});
            
        });
    ");
    $html_calendar->add_modal($lib_modal_edit->display(true));
    
    $html_calendar->display();
?>