<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $html = new Lib_html();
    $html->header("Edit Profile");
    $html->form("person/xprofile");
        $html->add_menu_submitbutton("Save Changes");
        $html->add_column("half");
            $html->fieldset_open("Details");
                $html->ihidden("per_id", $person->id);
                $html->dbinput($person, "per_firstname");
                $html->dbinput($person, "per_lastname");
                $html->dbinput($person, "per_gender");
            $html->fieldset_close();
        $html->end_column();
        $html->add_column("half");
            $html->fieldset_open("Account Details");
                $html->dbinput($person, "per_email");
                $html->dbinput($person, "per_password", ["dbtype" => "password"]);
                $html->ipassword("Confirm Password", "per_password_confirm", false, ["dbtype" => "password"]);
            $html->fieldset_close();
        $html->end_column();
    $html->end_form();
    $html->display();
    
    ?>
