<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$result_arr = lib_database::selectlist("SELECT per_id, per_name FROM person", "per_id", "per_name");

    $person = lib_core::load_db("person", "per_id = 1");
    console($person);
//    console($person->get_fromdb("per_id = 1"));


    $attributes = array("name" => "comment-form");
    $html = new lib_html();
    $html->header("New form");
    $html->form("person/xadd");
        $html->add_menu_button("Cancel", "requestUpdate('person/vlist')");
        $html->add_menu_submitbutton("Save Changes");
        $html->add_column("half");
            $html->fieldset_open("test header");
            $html->itext("Firstname", "per_firstname");
            $html->itext("Surname", "per_lastname");
            $html->itext("Grade", "per_grade");
            $html->iselect("test select", "teat_select", $result_arr, 2);
            $html->fieldset_close();
        $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
