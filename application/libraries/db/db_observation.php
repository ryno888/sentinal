<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class db_observation extends lib_db{
    
    public function __construct() {
        $this->set_key("obs_id");
        $this->set_table("observation");
        
        $this->set_fields_arr([
            "obs_id"                    => ["name" => "id"                      , "default" => "null"   , "type" => DB_INT],
            "obs_ref_person"            => ["name" => "person"                  , "default" => "null"   , "type" => DB_REFERENCE],
            "obs_term"                  => ["name" => "term"                    , "default" => 0        , "type" => DB_TINYINT],
            "obs_type"                  => ["name" => "type"                    , "default" => 0        , "type" => DB_TINYINT],
            "obs_value"                 => ["name" => "value"                   , "default" => ""       , "type" => DB_VARCHAR],
        ]);
    }
    //----------------------------------------------------------------------------------------
    public $obs_term = [
        "" => "-- Not Selected --",
        1 => "Term 1",
        2 => "Term 2",
        3 => "Term 3",
        4 => "Term 4",
    ];
    //----------------------------------------------------------------------------------------
    public $obs_term = [
        "" => "-- Not Selected --",
        1 => "attended info evening",
        2 => "neatness",
        3 => "adjustment",
        4 => "discipline",
        5 => "homework",
        6 => "message book signed",
        7 => "work book signed",
        8 => "other meetings",
        9 => "report discuss",
        10 => "discipline",
        11 => "days absent",
    ];
    //----------------------------------------------------------------------------------------
}
