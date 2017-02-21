<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $list = new lib_list();
    $list->add_title("Userlist", "All users", ["class" => "list-page-header"]);
    $list->add_new_btn("Add new Student", "requestUpdate('person/vadd');");
    $list->sql_key = "per_id";
    $list->sql_select = "per_id, per_firstname, per_lastname, per_email, per_username";
    $list->sql_from = "person";
    $list->searchfield_value = "CONCAT(per_firstname, per_lastname, per_email, per_username)";
    
    $list->add_field("Firstname", "per_firstname");
    $list->add_field("Lastname", "per_lastname");
    $list->add_field("Email", "per_email");
    
    $list->add_action_edit("Edit", "index.php/system/person/vlist");
    $list->display();
    
    message("test");
?>
