<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $html_manage = new lib_html_tab();
    $html_manage->set_view("General Details", "observation/vedit", $this->_ci_cached_vars, ["show" => true]);
    $html_manage->set_view("Observation Item", "observation/vlist", $this->_ci_cached_vars);
    $html_manage->display();
    
                
