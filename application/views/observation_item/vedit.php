<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    $obs_id = request("obs_id");
    $observation_item = request_db("observation_item");
    $html = new lib_html();
    $html->container_fluid = true;
    $html->header("Observation Item", 3);
    $html->form("observation_item/xedit");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage/per_id/$person->id/obs_id/$obs_id/p/vedit_obs/tab/list');", ["btn" => "btn-danger"]);
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("half");
                $html->ihidden("obv_id", $observation_item->id);
                $html->ihidden("per_id", request("per_id"));
                $html->ihidden("obv_ref_observation", $obs_id);
                $html->dbinput($observation_item, "obv_date", [".input-width-half" => true]);
                $html->dbinput($observation_item, "obv_content", ["label" => "Comment"]);
            $html->end_column();
    $html->end_form();
    $html->display();
    ?>
