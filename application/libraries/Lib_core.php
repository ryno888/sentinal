<?php
/**
 * Description of lib
 *
 * @author Ryno
 */
class Lib_core {
    public $ci = false;
    //--------------------------------------------------------------------------
    public function __construct(){
        $this->ci =& get_instance();
    }
    //--------------------------------------------------------------------------
    public function format_options($options = []){
        return Lib_html_tags::get_html_options($options);
    }
    //--------------------------------------------------------------------------
    public static function load($library, $data = null){
        $ci = &get_instance();
        $ci->load->library($library, $data);
        return $ci->{$library};
    }
    //--------------------------------------------------------------------------
}