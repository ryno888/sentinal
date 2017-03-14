<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $list = new lib_list();
    $list->add_title("Userlist", "All users", ["type" => 3]);
    $list->add_new_btn("Add new Student", "system.browser.redirect('person/vadd');");
    $list->sql_key = "per_id";
    $list->sql_select = "per_id, per_firstname, per_lastname, per_email, per_username";
    $list->sql_from = "person";
    $list->searchfield_value = "CONCAT(per_firstname, per_lastname, per_email, per_username)";
    
    $list->add_field("Firstname", "per_firstname");
    $list->add_field("Lastname", "per_lastname");
    $list->add_field("Email", "per_email");
    
    $list->add_action_edit("system.browser.redirect('person/vmanage?per_id=%per_id%')");
    $list->add_action_delete("system.ajax.requestFunction('person/xdelete?id=%per_id%', function(){}, {confirm:true})");
    $list->display();
?>
