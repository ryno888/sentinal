<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    //get intervention
    $intervention = request_db("intervention");
    
    $html = new lib_html();
    $html->container_fluid = true;
    $html->header("New Intervention", 3);
    $html->form("intervention/xadd");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage?per_id=$person->id&p=intervention');");
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("half");
                $html->fieldset_open("General Details");
                    $html->ihidden("per_id", $person->id);
                    $html->ihidden("int_ref_person", $person->id);
                    $html->dbinput($intervention, "int_type", ["required" => true]);
                    $html->dbinput($intervention, "int_remark", ["required" => true]);
                    $html->idate("Year", "int_year", lib_date::strtodate("NOW", "Y"), ["format" => "Y", "required" => true]);
                $html->fieldset_close();
            $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
