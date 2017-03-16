<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $list = new lib_list();
    $list->add_title("Observation", false, ["type" => 3]);
    $list->add_new_btn("Add new Observation", "system.browser.redirect('observation/vadd?per_id=$person->id&p=observation');");
    $list->sql_key = "obs_id";
    $list->sql_select = "obs_id, obs_type, obs_value, obs_term";
    $list->sql_from = "observation";
    $list->sql_limit = 15;
    $list->add_field("Type", "obs_type", ["function" => function($obs_type){ return lib_db::get_enum_value("observation", "obs_type", $obs_type); }]);
    
    $list->add_action_edit("system.browser.redirect('person/vmanage?int_id=%int_id%&per_id=$person->id&p=vedit_int')");
    $list->add_action_delete("system.ajax.requestFunction('person/xdelete?id=%int_id%', function(){}, {confirm:true})");
    $list->display();
?>
