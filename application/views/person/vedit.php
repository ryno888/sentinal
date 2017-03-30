<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $html = new Lib_html();
    $html->container_fluid = true;
    $html->header("General Details", 3);
    $html->form("person/xedit");
        $html->add_menu_submitbutton("Save Changes");
        $html->add_menu_button("Export Observation Sheet", "system.browser.new_tab('".Http_helper::build_url("index.php/person/xstream_observation_sheet/per_id/$person->id")."')");
            $html->ihidden("per_id", $person->id);
            $html->add_column("third");
                $html->fieldset_open("General Details");
                    $html->dbinput($person, "per_firstname", ["required" => true]);
                    $html->dbinput($person, "per_lastname", ["required" => true]);
                    $html->dbinput($person, "per_gender", ["required" => true]);
                    $html->dbinput($person, "per_grade", ["required" => true]);
                    $html->dbinput($person, "per_birthday", ["format" => Lib_date::$DATE_FORMAT_12, "required" => true]);
                    $html->dbinput($person, "per_year_in_class", ["required" => true, "format" => "Y"]);
                $html->fieldset_close();
            $html->end_column();
            $html->add_column("third");
                $html->fieldset_open("History");
                    $html->dbinput($person, "per_previous_grade", ["required" => true]);
                    $html->dbinput($person, "per_year_in_phase", ["required" => true]);
                    $html->dbinput($person, "per_prev_school");
                    $html->dbinput($person, "per_grade_repeated");
                $html->fieldset_close();
            $html->end_column();
            $html->add_column("third");
            $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
                

