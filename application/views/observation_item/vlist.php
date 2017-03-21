<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $observation = request_db("observation");

    $list = new lib_list();
    $list->add_title("Observation Item", false, ["type" => 3]);
    $list->add_new_btn("Add new Observation Item", "system.browser.redirect('person/vmanage?per_id=$person->id&obs_id=$observation->id&p=vadd_obv');");
    $list->sql_key = "obv_id";
    $list->sql_select = "obv_id,  obv_content";
    $list->sql_from = "observation_item";
    $list->sql_limit = 15;
    $list->add_field("Item", "obv_content", ["function" => function($obv_content){ return nl2br($obv_content); }]);
    
    $list->add_action_edit("system.browser.redirect('person/vmanage?int_id=%obs_id%&per_id=$person->id&p=vedit_obs')");
    $list->add_action_delete("system.ajax.requestFunction('person/xdelete?id=%obs_id%', function(){}, {confirm:true})");
    $list->display();
?>
