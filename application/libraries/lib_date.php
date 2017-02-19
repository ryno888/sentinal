<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class lib_date{

    //-----------------------------------------------------------------------
    public static function strtodate($date = "NOW", $dateformat = CI_DATE) {
        $dt = new DateTime($date);
        return $dt->format($dateformat);
    }
    //-----------------------------------------------------------------------
    public static function strtodatetime($date = "NOW", $dateformat = CI_DATETIME) {
        return lib_date::strtodate($date, $dateformat);
    }
    //-----------------------------------------------------------------------
}