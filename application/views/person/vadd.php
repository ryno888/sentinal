<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $attributes = array("name" => "comment-form");
    
    $html = new lib_html();
    $html->header("New form");
    $html->form("welcome/xedit");
        $html->add_menu_button("Cancel", "requestUpdate('person/vlist')");
        $html->add_menu_button("Save Changes");
        $html->add_column("half");
            $html->fieldset_open("test header");
            $html->itext("test", "test");
            $html->iselect("test select", "teat_select", [1 => "test1", 2 => "test2"], 2);
            $html->iselect("test select", "teat_select", [1 => "test1", 2 => "test2"], 2);
            $html->fieldset_close();
        $html->end_column();
        $html->add_column("third");
            $field_set = "";
            $field_set .= lib_html_tags::itext("test", "teat");
            $field_set .= lib_html_tags::itextarea("test3", "teat3");
            $field_set .= lib_html_tags::ipassword("test1", "teat1");
            $field_set .= lib_html_tags::ifile("test2", "teat2");
            $field_set .= lib_html_tags::iselect("test select", "teat_select", [1 => "test1", 2 => "test2"], 2);
            $field_set .= lib_html_tags::iselect_multi("test select", "teat_select", [1 => "test1", 2 => "test2", 3 => "test1", 4 => "test2"], 2);
            $html->add_html("html", lib_html_tags::fieldset("Address Information", $field_set));
            $field_set = "";
            $field_set .= lib_html_tags::itext("test", "teat");
            $field_set .= lib_html_tags::itextarea("test3", "teat3");
            $field_set .= lib_html_tags::ipassword("test1", "teat1");
            $field_set .= lib_html_tags::ifile("test2", "teat2");
            $field_set .= lib_html_tags::iselect("test select", "teat_select", [1 => "test1", 2 => "test2"], 2);
            $field_set .= lib_html_tags::iselect_multi("test select", "teat_select", [1 => "test1", 2 => "test2", 3 => "test1", 4 => "test2"], 2);
            $html->add_html("html", lib_html_tags::fieldset("Address Information", $field_set));
        $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
