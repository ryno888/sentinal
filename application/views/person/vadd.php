<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $attributes = array("name" => "comment-form");
    
    $html = new lib_html();
    $html->header("New form");
    $html->form("person/xedit");
        $html->add_menu_button("Cancel", "requestUpdate('person/vlist')");
        $html->add_menu_submitbutton("Save Changes");
        $html->add_column("half");
            $html->fieldset_open("test header");
            $html->itext("Firstname", "per_firstname");
            $html->itext("Surname", "per_lastname");
            $html->itext("E-mail", "email");
            $html->iselect("test select", "teat_select", [1 => "test1", 2 => "test2"], 2);
            $html->fieldset_close();
        $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
