<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $obs_id = request("obs_id");

    $list = new lib_list();
    $list->add_title("Remarks", false, ["type" => 3]);
    $list->add_new_btn("Add new Remark", "system.browser.redirect('person/vmanage/per_id/$person->id/obs_id/$obs_id/p/vadd_obv');");
    $list->sql_key = "obv_id";
    $list->sql_select = "obv_id,  obv_content";
    $list->sql_from = "observation_item";
    $list->sql_limit = 15;
    $list->add_field("Item", "obv_content", ["function" => function($obv_content){ return nl2br($obv_content); }]);
    
    $list->add_action_assoc("person/vmanage", ["per_id" => "$person->id", "obs_id" => $obs_id, "obv_id" => "%obv_id%", "p" => "vedit_obv"]);
    $list->add_action_delete("observation_item/xdelete/obv_id/%obv_id%", ["!complete" => "system.browser.redirect('person/vmanage/per_id/$person->id/obs_id/$obs_id/p/vedit_obs/tab/list');"]);
    $list->display();
?>