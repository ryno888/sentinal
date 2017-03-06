<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class lib_core {
    public $ci = false;
    //--------------------------------------------------------------------------
    public function __construct(){
        $this->ci =& get_instance();
    }
    //--------------------------------------------------------------------------
    public function format_options($options = []){
        return lib_html_tags::get_html_options($options);
    }
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
