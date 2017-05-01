<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Db_calendar extends Lib_db{
    
    public function __construct() {
        $this->set_key("cal_id");
        $this->set_table("calendar");
        
        $this->set_fields_arr([
            "cal_id"                => ["name" => "id"              , "default" => "null"   , "type" => DB_INT],
            "cal_name"              => ["name" => "name"            , "default" => ""       , "type" => DB_VARCHAR],
            "cal_description"       => ["name" => "description"     , "default" => ""       , "type" => DB_TEXT],
            "cal_options"           => ["name" => "options"         , "default" => ""       , "type" => DB_TEXT],
            "cal_starttime"         => ["name" => "start time"      , "default" => ""       , "type" => DB_DATETIME],
            "cal_endtime"           => ["name" => "end time"        , "default" => ""       , "type" => DB_DATETIME],
            "cal_all_day_event"     => ["name" => "all day event"   , "default" => 0        , "type" => DB_TINYINT],
        ]);
    }
    //----------------------------------------------------------------------------------------
}
