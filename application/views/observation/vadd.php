<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//    $data['person'] = $this->request_db("person");
    $observation = lib_db::load_db_default("observation");
    $html = new lib_html();
    $html->container_fluid = true;
    $html->header("General Details", 3);
    $html->form("observation/xadd");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage?per_id=$person->id&p=observation');", ["btn" => "btn-danger"]);
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("third");
                    $html->ihidden("per_id", $person->id);
                    $html->dbinput($observation, "obs_term", ["required" => true, "!change" => "
                            var term = $(this).val();
                            if(term == '1'){
                                $('#__obs_adjustment').removeClass('hidden');
                                $('#__obs_neatness').removeClass('hidden');
                            }else{
                                $('#__obs_adjustment').addClass('hidden');
                                $('#__obs_neatness').addClass('hidden');
                            }
                    "]);
                    $html->iradio_multi("Info Evening", "obs_info_evening", $observation->obs_info_evening, false, ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Report Discuss", "obs_report_discuss", $observation->obs_report_discuss, false, ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Other Meetings", "obs_other_meetings", $observation->obs_other_meetings, false, ["required" => true, "exclude" => [""]]);
            $html->end_column();
            $html->add_column("third");
                    $html->iradio_multi("Message Book Signed", "obs_message_book_signed", $observation->obs_message_book_signed, false, ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Work Book Signed", "obs_work_book_signed", $observation->obs_work_book_signed, false, ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Homework", "obs_homework", $observation->obs_homework, false, ["required" => true, "exclude" => [""]]);
            $html->end_column();
            $html->add_column("third");
                    $html->iradio_multi("Discipline", "obs_discipline", $observation->obs_discipline, false, ["required" => true, "exclude" => [""]]);
                    $html->iradio_multi("Adjustment", "obs_adjustment", $observation->obs_adjustment, false, ["required" => true, "exclude" => [""], "hidden" => true]);
                    $html->iradio_multi("Neatness", "obs_neatness", $observation->obs_neatness, false, ["required" => true, "exclude" => [""], "hidden" => true]);
            $html->end_column();
    $html->end_form();
    $html->display();
    ?>
