<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lib_date{
    /**
     * output date format: 24-03-12
     */
    public static $DATE_FORMAT_1 = "d-m-y";
    /**
     * output date format: Saturday 24th March 2012
     */
    public static $DATE_FORMAT_2 = "l jS F Y"; 
    /**
     * output date format: 5:45pm on Saturday 24th March 2012
     */
    public static $DATE_FORMAT_3 = "g:ia \o\\n l jS F Y"; 
    /**
     * output date format: 24th March 2012
     */
    public static $DATE_FORMAT_4 = "jS F Y"; 
    /**
     * output date format: 15:12:15
     */
    public static $DATE_FORMAT_5 = "H:i:s"; 
    /**
     * output date format: 15:12
     */
    public static $DATE_FORMAT_6 = "H:i";
    /**
     * output date format: 2014/07/07
     */
    public static $DATE_FORMAT_7 = "Y/m/d";
    /**
     * output date format: 24th March 2012, 5:45pm
     */
    public static $DATE_FORMAT_8 = "jS F Y\, g:ia"; 
    /**
     * output date format: 24th March @ 5:45pm
     */
    public static $DATE_FORMAT_9 = "jS F \@ g:ia"; 
    /**
     * output date format: 24th Mar 2015 5:45pm
     */
    public static $DATE_FORMAT_10 = "d M Y g:ia"; 
    /**
     * output date format: 24th Mar 2015
     */
    public static $DATE_FORMAT_11 = "d M Y"; 
    /**
     * output date format: 24 March 2012
     */
    public static $DATE_FORMAT_12 = "d F Y"; 
    
    //--------------------------------------------------------------------------------
 	// functions
	//--------------------------------------------------------------------------------
    /**
     * checks if the date is a valid date
     * @param type $date
     * @return boolean
     */
    public static function is_date($date){
        if (DateTime::createFromFormat('Y-m-d G:i:s', $date) !== FALSE) {
            return $date;
        }
        return false;
    }
    //-----------------------------------------------------------------------
    public static function strtodate($date = "NOW", $dateformat = CI_DATE) {
        $dt = new DateTime($date);
        return $dt->format($dateformat);
    }
    //-----------------------------------------------------------------------
    public static function strtodatetime($date = "NOW", $dateformat = CI_DATETIME) {
        return Lib_date::strtodate($date, $dateformat);
    }
    //-----------------------------------------------------------------------
}