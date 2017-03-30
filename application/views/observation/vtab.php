<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $tab = request("tab", "edit");
    $html_manage = new Lib_html_tab();
    $html_manage->set_view("General Details", "observation/vedit", $this->_ci_cached_vars, ["show" => $tab == "edit" ? true : false]);
    $html_manage->set_view("Observation Item", "observation_item/vlist", $this->_ci_cached_vars, ["show" => $tab == "list" ? true : false]);
    $html_manage->display();
    
                
