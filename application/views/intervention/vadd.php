<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $html = new lib_html();
    $html->header("New Intervention", 1);
    $html->form("intervention/xadd");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage?per_id=$person->id');");
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("half");
                $html->fieldset_open("General Details");
                    $html->dbinput($intervention, "int_type");
                    $html->dbinput($intervention, "int_remark");
//                    $html->idate("Year in class", "per_year_in_class", false, ["type" => "year"]);
                $html->fieldset_close();
            $html->end_column();
//            $html->add_column("half");
//                $html->fieldset_open("History");
//                    $html->dbinput($person, "per_previous_grade");
//                    $html->dbinput($person, "per_grade_repeated");
//                    $html->dbinput($person, "per_year_in_phase");
//                $html->fieldset_close();
//            $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
