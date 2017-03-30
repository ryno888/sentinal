<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Db_person extends Dbx_person{
    
    public function __construct() {
        
        parent::__construct();
        
        $this->set_key("per_id");
        $this->set_table("person");
        
        $this->set_fields_arr([
            "per_id"            => ["name" => "id"          , "default" => "null"   , "type" => DB_INT],
            "per_gender"        => ["name" => "gender"      , "default" => 0        , "type" => DB_TINYINT],
            "per_firstname"     => ["name" => "firstname"   , "default" => ""       , "type" => DB_VARCHAR],
            "per_lastname"      => ["name" => "surname"     , "default" => ""       , "type" => DB_VARCHAR],
            "per_name"          => ["name" => "name"        , "default" => ""       , "type" => DB_VARCHAR],
            "per_email"         => ["name" => "email"       , "default" => ""       , "type" => DB_VARCHAR],
            "per_type"          => ["name" => "type"        , "default" => 0        , "type" => DB_TINYINT],
            "per_telnr"         => ["name" => "tel nr"      , "default" => ""       , "type" => DB_VARCHAR],
            "per_cellnr"        => ["name" => "cell nr"     , "default" => ""       , "type" => DB_VARCHAR],
            "per_username"      => ["name" => "username"    , "default" => ""       , "type" => DB_VARCHAR],
            "per_password"      => ["name" => "password"    , "default" => ""       , "type" => DB_ENCRYPT],
            "per_online"        => ["name" => "is online"   , "default" => 0        , "type" => DB_TINYINT],
            "per_date_created"  => ["name" => "date created", "default" => ""       , "type" => DB_DATETIME],
            
            "per_birthday"          => ["name" => "birthday"        , "default" => ""       , "type" => DB_DATE],
            "per_year_in_class"     => ["name" => "year"            , "default" => ""       , "type" => DB_YEAR],
            "per_cemis_nr"          => ["name" => "cms number"      , "default" => ""       , "type" => DB_VARCHAR],
            "per_grade"             => ["name" => "grade"           , "default" => 0       , "type" => DB_TINYINT],
            "per_previous_grade"    => ["name" => "previous grade"  , "default" => 0       , "type" => DB_TINYINT],
            "per_grade_repeated"    => ["name" => "grade repeated"  , "default" => 0       , "type" => DB_TINYINT],
            "per_year_in_phase"     => ["name" => "year in phase"   , "default" => ""       , "type" => DB_VARCHAR],
            "per_prev_school"       => ["name" => "previous school" , "default" => ""       , "type" => DB_VARCHAR],
        ]);
    }
    //----------------------------------------------------------------------------------------
    public $per_grade = [
        "" => "-- Not Selected --",
        -2 => "Pre-Primary",
        -1 => "Grade R",
        1 => "Grade 1",
        2 => "Grade 2",
        3 => "Grade 3",
        4 => "Grade 4",
        5 => "Grade 5",
        6 => "Grade 6",
        7 => "Grade 7",
    ];
    //----------------------------------------------------------------------------------------
    public $per_grade_repeated = [
        "" => "-- Not Selected --",
        -2 => "Pre-Primary",
        -1 => "Grade R",
        1 => "Grade 1",
        2 => "Grade 2",
        3 => "Grade 3",
        4 => "Grade 4",
        5 => "Grade 5",
        6 => "Grade 6",
        7 => "Grade 7",
    ];
    //----------------------------------------------------------------------------------------
    public $per_previous_grade = [
        "" => "-- Not Selected --",
        -2 => "Pre-Primary",
        -1 => "Grade R",
        1 => "Grade 1",
        2 => "Grade 2",
        3 => "Grade 3",
        4 => "Grade 4",
        5 => "Grade 5",
        6 => "Grade 6",
        7 => "Grade 7",
    ];
    //----------------------------------------------------------------------------------------
    public function on_update(&$obj) {
        parent::on_update($obj);
    }
}
