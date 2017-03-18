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
    $html->form("person/xadd");
        $html->add_menu_button("Cancel", "system.browser.redirect('person/vmanage?per_id=$person->id&p=observation');", ["btn" => "btn-cancel"]);
        $html->add_menu_submitbutton("Save Changes");
            $html->add_column("half");
                $html->fieldset_open("General Details");
                    $html->ihidden("per_id", $person->id);
                    $html->dbinput($observation, "obs_type", ["required" => true]);
                    $html->dbinput($observation, "obs_value", ["required" => true]);
                    $html->dbinput($observation, "obs_term", ["required" => true]);
                $html->fieldset_close();
            $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
