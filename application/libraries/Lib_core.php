<?php
/**
 * Description of lib
 *
 * @author Ryno
 */

//db
require_once(DIR_APPLICATION.'libraries/database/Lib_db.php');
require_once(DIR_APPLICATION.'libraries/database/Lib_database.php');

//html
require_once(DIR_APPLICATION.'libraries/html/Lib_html.php');
require_once(DIR_APPLICATION.'libraries/html/Lib_list.php');
require_once(DIR_APPLICATION.'libraries/html/Lib_html_manage.php');
require_once(DIR_APPLICATION.'libraries/html/Lib_modal.php');
require_once(DIR_APPLICATION.'libraries/html/Lib_html_tab.php');
require_once(DIR_APPLICATION.'libraries/html/Lib_navbar.php');
require_once(DIR_APPLICATION.'libraries/html/Lib_html_calendar.php');

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
