<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $list = new lib_list();
    $list->add_title("Observation", false, ["type" => 3]);
    $list->add_new_btn("Add new Observation", "system.browser.redirect('person/vmanage?per_id=$person->id&p=vadd_obs');");
    $list->sql_key = "obs_id";
    $list->sql_select = "obs_id,  obs_term";
    $list->sql_from = "observation";
    $list->sql_limit = 15;
    $list->add_field("Type", "obs_term", ["function" => function($obs_term){ return lib_db::get_enum_value("observation", "obs_term", $obs_term); }]);
    
    $list->add_action_edit("system.browser.redirect('person/vmanage?int_id=%obs_id%&per_id=$person->id&p=vedit_obs')");
    $list->add_action_delete("system.ajax.requestFunction('person/xdelete?id=%obs_id%', function(){}, {confirm:true})");
    $list->display();
?>
