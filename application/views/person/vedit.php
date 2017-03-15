<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $html = new lib_html();
    $html->container_fluid = true;
    $html->header("General Details", 3);
    $html->form("person/xedit");
        $html->add_menu_submitbutton("Save Changes");
            $html->ihidden("per_id", $person->id);
            $html->add_column("third");
                $html->fieldset_open("General Details");
                    $html->dbinput($person, "per_firstname", ["required" => true]);
                    $html->dbinput($person, "per_lastname", ["required" => true]);
                    $html->dbinput($person, "per_gender", ["required" => true]);
                    $html->dbinput($person, "per_grade", ["required" => true]);
                    $html->dbinput($person, "per_birthday", ["format" => lib_date::$DATE_FORMAT_12, "required" => true]);
                    $html->dbinput($person, "per_year_in_class", ["required" => true]);
                $html->fieldset_close();
            $html->end_column();
            $html->add_column("third");
                $html->fieldset_open("History");
                    $html->dbinput($person, "per_previous_grade");
                    $html->dbinput($person, "per_grade_repeated");
                    $html->dbinput($person, "per_year_in_phase");
                $html->fieldset_close();
            $html->end_column();
            $html->add_column("third");
            $html->end_column();
    $html->end_form();
    $html->display();
    ?>
                

