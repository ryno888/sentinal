<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Dbx_person extends Lib_db{
    
    public function __construct() {
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
            "per_password"      => ["name" => "password"    , "default" => ""       , "type" => DB_VARCHAR],
            "per_online"        => ["name" => "is online"   , "default" => 0        , "type" => DB_TINYINT],
            "per_date_created"  => ["name" => "date created", "default" => ""       , "type" => DB_DATETIME],
            "per_birthday"      => ["name" => "birthday"    , "default" => ""       , "type" => DB_DATE],
        ]);
    }
    //----------------------------------------------------------------------------
    public $per_gender = [
        "" => "-- Not Selected --",
        1 => "Male",
        2 => "Female",
    ];
    //----------------------------------------------------------------------------
    public function on_update(&$obj) {
        parent::on_update($obj);
        
        if(property_exists($obj, "per_password") && !$this->is_empty("per_password")){
            $obj->per_password = Lib_string::encrypt($obj->per_password);
        }
        
        $obj->per_name = "$obj->per_lastname, $obj->per_firstname";
    }
    //----------------------------------------------------------------------------
    public function has_role($obj, $code) {
        
    }
    //----------------------------------------------------------------------------
    public function add_role($code) {
        $role = Dbx_role::get_role($code);
        $person_role = Lib_db::load_db_default("person_role");
        $person_role->obj->pel_ref_person = $this->id;
        $person_role->obj->pel_ref_role = $role->id;
        $person_role->insert();
        return $person_role;
    }
    //----------------------------------------------------------------------------
    public function format_name() {
        return $this->get("per_name", function ($obj, $field){
            return "$obj->per_firstname $obj->per_lastname";
        });
    }
    //----------------------------------------------------------------------------
}
