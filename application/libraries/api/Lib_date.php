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
    public static function get_start_of_week($date = "NOW", $dateformat = CI_DATE, $week_start = "sunday") {
        $custom_date = strtotime( date('d-m-Y', strtotime($date)) ); 
        return date($dateformat, strtotime("this week last $week_start", $custom_date));
    }
    //-----------------------------------------------------------------------
    public static function get_end_of_week($date = "NOW", $dateformat = CI_DATE, $week_end = "saturday") {
        $custom_date = strtotime( date('d-m-Y', strtotime($date)) ); 
        return date($dateformat, strtotime("this week next $week_end", $custom_date));
    }
    //-----------------------------------------------------------------------
    public static function get_end_of_month($date = "NOW", $dateformat = CI_DATE) {
        $_date = new DateTime($date);
        $_date->modify('last day of this month');
        return $_date->format($dateformat);
    }
    //--------------------------------------------------------------------------------
    /**
     * Takes a nova datetime stamp, and substitutes the year in the timestamp with the new year
     * @param type $date
     * @param type $new_year
     * @return boolean
     */
    public static function get_datetime_range_arr( $start_date, $end_date, $step = '+ 1 hour', $format = "Y-m-d G:i:s" ) {
        $dates = array();
        $current = Lib_date::strtodatetime($start_date);
        $last = Lib_date::strtodatetime($end_date);

        while( $current <= $last ) {
            $dates[] = Lib_date::strtodatetime($current, $format);
            $current = Lib_date::strtodatetime("$current $step");
        }

        return $dates;
    }
    //-----------------------------------------------------------------------
}