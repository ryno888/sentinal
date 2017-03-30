<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class db_observation_item extends Lib_db{
    
    public function __construct() {
        $this->set_key("obv_id");
        $this->set_table("observation_item");
        
        $this->set_fields_arr([
            "obv_id"                    => ["name" => "id"              , "default" => "null"   , "type" => DB_INT],
            "obv_content"               => ["name" => "content"         , "default" => ""       , "type" => DB_TEXT],
            "obv_ref_observation"       => ["name" => "observation"     , "default" => "null"   , "type" => DB_REFERENCE, "reference" => "person"],
            "obv_date"                  => ["name" => "date"            , "default" => ""       , "type" => DB_DATE],
        ]);
    }
    //----------------------------------------------------------------------------------------
}
