<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $html = new lib_html();
    $html->header("Edit Profile");
    $html->form("person/xedit");
        $html->add_menu_button("Cancel", "requestUpdate('person/vlist')");
        $html->add_menu_submitbutton("Save Changes");
        $html->add_column("half");
            $html->fieldset_open("test header");
            $html->ihidden("per_id", $person->id);
            $html->dbinput($person, "per_firstname");
            $html->dbinput($person, "per_lastname");
            
            $html->fieldset_open("Account Details");
                $html->dbinput($person, "per_email");
                $html->dbinput($person, "per_password", ["dbtype" => "password"]);
                $html->itext("Confirm Password", "per_password_confirm", false, ["dbtype" => "password"]);
            $html->fieldset_close();
            
            $html->itext("Grade", "per_grade");
            $html->iselect("test select", "teat_select", $result_arr, 2);
            $html->fieldset_close();
        $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
