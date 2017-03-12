<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<?php
    $this->load->library("lib_navbar");
    
    $navbar = new lib_navbar();
    $navbar->add_navitem("Students", "person/vlist");
    $navbar->add_navitem("My Profile", "person/vprofile", ["align" => "right"]);
    $navbar->add_navitem("Logout", "index/xlogout", ["align" => "right"]);
    $navbar->display();
    
?>