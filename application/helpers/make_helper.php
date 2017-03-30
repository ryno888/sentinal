<?php

/*
 * Class 
 * @filename lib 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 14 Feb 2017 * 
 */

/**
 * Description of lib
 *
 * @author Ryno
 */
class make {
    //--------------------------------------------------------------------------
    public static function database() {
        $ci = &get_instance();
        $ci->load->library("Lib_database");
        return $ci->Lib_database;
    }
    //--------------------------------------------------------------------------
}
