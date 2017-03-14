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
    
    public $id = false;
    public $obj = false;
    private $new = false;

    //--------------------------------------------------------------------------
    public function on_update(&$obj) {}
    public function on_update_complete() {}
    public function on_insert() {}
    public function on_insert_complete() {}
    public function on_delete() {}
    public function on_delete_complete() {}
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
    public function get_fields_arr() {
        return $this->fields_arr;
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
    public function get_field_value($field_name) {
        return $this->obj->{$field_name};
    }
    //--------------------------------------------------------------------------
    public function get($field_name, $function = false) {
        $return = false;
        if($function){
            $return = call_user_func($function, $this->obj, $field_name);
        }else{
            $return = $this->obj->{$field_name};
        }
        
        return $return;
    }
    //--------------------------------------------------------------------------
    public function get_field_type($field_name) {
        return $this->fields_arr[$field_name]["type"];
    }
    //--------------------------------------------------------------------------
    public function get_fromdb($sql_where) {
        $this->set_new();
        
        if(is_numeric($sql_where)){
            $this->obj = lib_database::query("SELECT * FROM $this->table WHERE $this->key = $sql_where", 1);
        }else{
            $this->obj = lib_database::query("SELECT * FROM $this->table WHERE $sql_where", 1);
        }
        
        $this->id = $this->obj->{$this->key};
        
        return $this->obj;
    }
    //--------------------------------------------------------------------------
    private function set_new() {
        $this->new = new stdClass();
        
        foreach ($this->fields_arr as $field => $field_data_arr) {
            $this->new->{$field} = $this->get_field_default($field);
        }
        
        return $this->new;
    }
    //--------------------------------------------------------------------------
    public function get_fromdefault() {
        $this->obj = clone($this->set_new());
        return $this->obj;
    }
    //--------------------------------------------------------------------------
    public function insert() {
        $database = new lib_database();
        $database->insert($this->table, $this->obj);
    }
    //--------------------------------------------------------------------------
    public function update() {
        $database = new lib_database();
        $this->on_update($this->obj);
        $database->update($this->table, $this->key, $this->clean_obj());
    }
    //--------------------------------------------------------------------------
    public function clean_obj() {
        $clean_object = clone($this->obj);
        foreach ($clean_object as $key => $value) {
            if($value == $this->get_field_default($key)){
                unset($clean_object->{$key});
            }else{
                switch ($this->get_field_type($key)) {
                    case DB_DATETIME: $clean_object->{$key} = lib_date::strtodatetime($clean_object->{$key}); break;
                }
            }
        }
        return $clean_object;
    }
    //--------------------------------------------------------------------------
    public function is_empty($field) {
        $default = $this->get_field_default($field);
        return $this->obj->{$field} !== $default ? false : true;
    }
    //--------------------------------------------------------------------------
    //static
    //--------------------------------------------------------------------------
    public static function load_db($table, $sql){
        $class = "db_{$table}";
        $ci = & get_instance();
        $ci->load->library("lib_db");
        $ci->load->library("db/$class");
        
        $db = new $class;
        if($sql){
            $db->get_fromdb($sql);
        }
        
        return $db;
    }
    //--------------------------------------------------------------------------
    public static function load_db_default($table){
        $class = "db_{$table}";
        $ci = & get_instance();
        $ci->load->library("lib_db");
        $ci->load->library("db/$class");
        
        $db = new $class;
        $db->get_fromdefault();
        
        return $db;
    }
    //--------------------------------------------------------------------------
}
