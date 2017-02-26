<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class lib_db{
    //put your code here
    private $table = false;
    private $key = false;
    private $fields_arr = false;
    
    public $db_obj = false;
    public $new_obj = false;

    //--------------------------------------------------------------------------
    public function set_table($table) {
        $this->table = $table;
    }
    //--------------------------------------------------------------------------
    public function set_key($key) {
        $this->key = $key;
    }
    //--------------------------------------------------------------------------
    public function set_fields_arr($fields_arr = []) {
        $this->fields_arr = $fields_arr;
    }
    //--------------------------------------------------------------------------
    public function get_table() {
        return $this->table;
    }
    //--------------------------------------------------------------------------
    public function get_key() {
        return $this->key;
    }
    //--------------------------------------------------------------------------
    public function get_field_default($field_name) {
        return $this->fields_arr[$field_name]["default"];
    }
    //--------------------------------------------------------------------------
    public function get_field_display($field_name) {
        return $this->fields_arr[$field_name]["name"];
    }
    //--------------------------------------------------------------------------
    public function get_field_type($field_name) {
        return $this->fields_arr[$field_name]["type"];
    }
    //--------------------------------------------------------------------------
    public function get_fromdb($sql_where) {
        return $this->db_obj = lib_database::query("SELECT * FROM $this->table WHERE $sql_where", 1);
    }
    //--------------------------------------------------------------------------
}
