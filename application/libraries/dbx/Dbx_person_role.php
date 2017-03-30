<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Dbx_person_role extends Lib_db{
    
    public function __construct() {
        $this->set_key("pel_id");
        $this->set_table("person_role");
        
        $this->set_fields_arr([
            "pel_id"            => ["name" => "id"      , "default" => "null"   , "type" => DB_INT],
            "pel_ref_person"    => ["name" => "person"  , "default" => "null"   , "type" => DB_REFERENCE, "reference" => "person"],
            "pel_ref_role"      => ["name" => "role"    , "default" => "null"   , "type" => DB_REFERENCE, "reference" => "role"],
        ]);
    }
    //----------------------------------------------------------------------------
}
