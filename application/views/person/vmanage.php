<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $html_manage = new lib_html_manage();
    $html_manage->container_fluid = true;
    $html_manage->add_title("Manage", $person->format_name());
    $html_manage->add_item("<i class='fa fa-chevron-left margin-right-5' aria-hidden='true'></i>Back to List", 
        "system.browser.redirect('person/vlist');");
    $html_manage->add_item("<i class='fa fa-info-circle margin-right-5' aria-hidden='true'></i>Details", 
        "system.browser.redirect('person/vmanage?per_id={$person->id}');");
    $html_manage->add_item("<i class='fa fa-file-text-o margin-right-5' aria-hidden='true'></i>Intervention", 
        "system.browser.redirect('person/vmanage?per_id={$person->id}&p=intervention');");
    
    switch ($panel) {
        case "details": $html_manage->set_view("person/vedit", $this->_ci_cached_vars); break;
        case "intervention": $html_manage->set_view("person/vlist_intervention", $this->_ci_cached_vars); break;

        default: $html_manage->set_view("person/vedit", $this->_ci_cached_vars); break;
    }
    
    $html_manage->display();
    
                
