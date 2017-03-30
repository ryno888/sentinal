<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Dbx_role extends Lib_db{
    
    public function __construct() {
        $this->set_key("rol_id");
        $this->set_table("role");
        
        $this->set_fields_arr([
            "rol_id"            => ["name" => "id"      , "default" => "null"   , "type" => DB_INT],
            "rol_name"          => ["name" => "name"    , "default" => ""       , "type" => DB_VARCHAR],
            "rol_code"          => ["name" => "code"    , "default" => ""       , "type" => DB_VARCHAR],
            "rol_level"         => ["name" => "id"      , "default" => "null"   , "type" => DB_INT],
        ]);
    }
    //----------------------------------------------------------------------------
    public static function get_role($code){
        return Lib_db::load_db("role", "rol_code = '$code'");
    }
    //----------------------------------------------------------------------------
}
