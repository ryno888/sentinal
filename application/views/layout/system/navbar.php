<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<?php
    $this->load->library("lib_navbar");
    
    $navbar = new lib_navbar();
    $navbar->add_navitem("Students", "person/vlist");
    $navbar->add_navitem_dropdown("<i class='fa fa-user margin-right-5' aria-hidden='true'></i>", [
        "My Profile" => "person/vprofile",
        "Logout" => "index/xlogout"
    ], ["align" => "right"]);
    $navbar->display();
    
?>