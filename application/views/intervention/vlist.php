<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $list = new lib_list();
    $list->add_title("Intervention", false, ["type" => 3]);
    $list->add_new_btn("Add new Remark", "system.browser.redirect('person/vmanage/per_id/$person->id/p/vadd_int');");
    $list->sql_key = "int_id";
    $list->sql_select = "int_id, int_year, int_remark, int_type";
    $list->sql_from = "intervention";
    $list->sql_where = "int_ref_person = $person->id";
    $list->sql_limit = 15;
    $list->add_field("Type", "int_type", ["function" => function($int_type){ return lib_db::get_enum_value("intervention", "int_type", $int_type); }]);
    $list->add_field("Remark", "int_remark");
    
    $list->add_action_assoc("person/vmanage", ["per_id" => "$person->id", "int_id" => "%int_id%", "p" => "vedit_int"]);
    $list->add_action_delete("intervention/xdelete/int_id/%int_id%");
    $list->display();
?>
