<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    $observation_item = lib_db::load_db_default("observation_item");
    $html = new lib_html();
    $html->container_fluid = true;
    $html->header("Observation Item", 3);
    $html->form("observation_item/xadd");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage?per_id=$person->id&p=observation');", ["btn" => "btn-danger"]);
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("half");
                $html->ihidden("obv_ref_observation", $observation->id);
                $html->dbinput($observation_item, "obv_content");
                $html->dbinput($observation_item, "obv_date");
            $html->end_column();
    $html->end_form();
    $html->display();
    ?>
