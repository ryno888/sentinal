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
        
        $this->ci->load->library("lib_db");
        $this->ci->load->library("dbx/dbx_person");
    }
    //--------------------------------------------------------------------------
    public function format_options($options = []){
        return lib_html_tags::get_html_options($options);
    }
    //--------------------------------------------------------------------------
}
