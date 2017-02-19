<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<?php
    $this->load->library("lib_navbar");
    
    $navbar = new lib_navbar();
    $navbar->add_navitem("Students", "index.php/person/vlist");
    $navbar->add_navitem("Charl");
    $navbar->add_navitem_dropdown("test2", ["index/url" => "Url"]);
    $navbar->add_navitem("Logout", "index.php/index/xlogout", ["align" => "right"]);
    $navbar->display();
    
?>