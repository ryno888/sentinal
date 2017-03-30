<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->library("html/Lib_navbar");
    $navbar = new Lib_navbar();
    $navbar->add_navitem("Students", "person/vlist");
    $navbar->add_navitem_dropdown("Reports", [
        "Class List" => "person/vprofile",
    ]);
    $navbar->add_navitem_dropdown("<i class='fa fa-user margin-right-5' aria-hidden='true'></i>", [
        "My Profile" => "person/vprofile",
        "Logout" => "index/xlogout"
    ], ["align" => "right"]);
    $navbar->display();
    
?>