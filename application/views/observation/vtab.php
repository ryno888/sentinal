<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $html_manage = new lib_html_tab();
    
    $html_manage->add_item("__observation_form", "Observation", $this->load->view("observation/vadd", $this->_ci_cached_vars, true), ["show" => true]);
    $html_manage->add_item("__observation_list", "Observation Item", $this->load->view("observation/vlist", $this->_ci_cached_vars, true));
    $html_manage->display();
    
                
