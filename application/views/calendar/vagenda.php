<?php
//    console('No direct script access allowed');
    $this->load->library("html/Lib_html_calendar");

    $html_calendar = new Lib_html_calendar();
    $html_calendar->display();
    
    ?>

