<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class db_person extends lib_db{
    
    public function __construct() {
        $this->set_key("per_id");
        $this->set_table("person");
        
        $this->set_fields_arr([
            "per_id"            => ["name" => "id"          , "default" => "null"   , "type" => DB_INT],
            "per_firstname"     => ["name" => "firstname"   , "default" => ""       , "type" => DB_VARCHAR],
            "per_lastname"      => ["name" => "surname"     , "default" => ""       , "type" => DB_VARCHAR],
            "per_name"          => ["name" => "name"        , "default" => ""       , "type" => DB_VARCHAR],
            "per_email"         => ["name" => "email"       , "default" => ""       , "type" => DB_VARCHAR],
            "per_type"          => ["name" => "type"        , "default" => 0        , "type" => DB_TINYINT],
            "per_telnr"         => ["name" => "tel nr"      , "default" => ""       , "type" => DB_VARCHAR],
            "per_cellnr"        => ["name" => "cell nr"     , "default" => ""       , "type" => DB_VARCHAR],
            "per_username"      => ["name" => "username"    , "default" => ""       , "type" => DB_VARCHAR],
            "per_password"      => ["name" => "password"    , "default" => ""       , "type" => DB_VARCHAR],
            "per_online"        => ["name" => "is online"   , "default" => 0        , "type" => DB_TINYINT],
            "per_date_created"  => ["name" => "date created", "default" => ""       , "type" => DB_DATETIME],
            "per_birthday"      => ["name" => "birthday"    , "default" => ""       , "type" => DB_DATETIME],
        ]);
    }
}
