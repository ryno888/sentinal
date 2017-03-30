<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $html_manage = new Lib_html_manage();
    $html_manage->container_fluid = true;
    $html_manage->add_title("Manage", $person->format_name());
    $html_manage->add_item("Back to List", "person/vlist", ["icon" => "fa-chevron-left"]);
    $html_manage->add_item("Details", "person/vmanage/per_id/{$person->get("per_id")}", ["icon" => "fa-info-circle"]);
    $html_manage->add_item("Intervention", "person/vmanage/per_id/{$person->get("per_id")}/p/intervention", ["icon" => "fa-file-text-o"]);
    $html_manage->add_item("Observation", "person/vmanage/per_id/{$person->get("per_id")}/p/observation", ["icon" => "fa-calendar-o"]);
    
    switch ($panel) {
        case "details": $html_manage->set_view("person/vedit", $this->_ci_cached_vars); break;
        
        //intervention
        case "intervention": $html_manage->set_view("intervention/vlist", $this->_ci_cached_vars); break;
        case "vadd_int": $html_manage->set_view("intervention/vadd", $this->_ci_cached_vars); break;
        case "vedit_int": $html_manage->set_view("intervention/vedit", $this->_ci_cached_vars); break;
        
        //observation
        case "observation": $html_manage->set_view("observation/vlist", $this->_ci_cached_vars); break;
        case "vadd_obs": $html_manage->set_view("observation/vadd", $this->_ci_cached_vars); break;
        case "vedit_obs": $html_manage->set_view("observation/vtab", $this->_ci_cached_vars); break;
        
        //observation_item
        case "vadd_obv": $html_manage->set_view("observation_item/vadd", $this->_ci_cached_vars); break;
        case "vedit_obv": $html_manage->set_view("observation_item/vedit", $this->_ci_cached_vars); break;
        
        //default
        default: $html_manage->set_view("person/vedit", $this->_ci_cached_vars); break;
    }
    
    $html_manage->display();
    
                
