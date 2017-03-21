<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    $observation = request_db("observation");
    
    $html = new lib_html();
    $html->container_fluid = true;
    $html->add_title("General Details", "Term ".$observation->get("obs_term"), ["type" => 3]);
    $html->form("observation/xedit");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage/per_id/$person->id/p/observation');", ["btn" => "btn-danger"]);
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("third");
                    $html->ihidden("per_id", $person->id);
                    $html->ihidden("obs_id", $observation->id);
                    $html->iradio_multi("Info Evening", "obs_info_evening", $observation->obs_info_evening, $observation->get("obs_info_evening"), ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Report Discuss", "obs_report_discuss", $observation->obs_report_discuss, $observation->get("obs_report_discuss"), ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Other Meetings", "obs_other_meetings", $observation->obs_other_meetings, $observation->get("obs_other_meetings"), ["required" => true, "exclude" => [""]]);
            $html->end_column();
            $html->add_column("third");
                    $html->iradio_multi("Message Book Signed", "obs_message_book_signed", $observation->obs_message_book_signed, $observation->get("obs_message_book_signed"), ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Work Book Signed", "obs_work_book_signed", $observation->obs_work_book_signed, $observation->get("obs_work_book_signed"), ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Homework", "obs_homework", $observation->obs_homework, $observation->get("obs_homework"), ["required" => true, "exclude" => [""]]);
            $html->end_column();
            $html->add_column("third");
                    $html->iradio_multi("Discipline", "obs_discipline", $observation->obs_discipline, $observation->get("obs_discipline"), ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Adjustment", "obs_adjustment", $observation->obs_adjustment, $observation->get("obs_adjustment"), ["required" => true, "exclude" => [""], "hidden" => true]);
                    $html->iradio_multi("Neatness", "obs_neatness", $observation->obs_neatness, $observation->get("obs_neatness"), ["required" => true, "exclude" => [""], "hidden" => true]);
            $html->end_column();
    $html->end_form();
    $html->display();
    ?>
