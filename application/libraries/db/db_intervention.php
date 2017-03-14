<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class db_intervention extends lib_db{
    
    public function __construct() {
        $this->set_key("int_id");
        $this->set_table("intervention");
        
        $this->set_fields_arr([
            "int_id"            => ["name" => "id"          , "default" => "null"   , "type" => DB_INT],
            "int_year"          => ["name" => "year"        , "default" => ""       , "type" => DB_TINYINT],
            "int_remark"        => ["name" => "remark"      , "default" => ""       , "type" => DB_TEXT],
            "int_type"          => ["name" => "type"        , "default" => 0        , "type" => DB_TINYINT],
        ]);
    }
    //----------------------------------------------------------------------------------------
    public $int_type = [
        0 => "-- Not Selected --",
        1 => "Class Tutoring",
        2 => "OT",
        3 => "REM",
        4 => "Language/Speech",
        5 => "Psychologist",
        6 => "Social/Welfare",
        7 => "Medical",
        8 => "Learnsupp-team",
        9 => "Other",
    ];
    //----------------------------------------------------------------------------------------
}
