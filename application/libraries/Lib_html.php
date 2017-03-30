<?php

/*
 * Class 
 * @filename lib 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 14 Feb 2017 * 
 */

/**
 * Description of lib
 *
 * @author Ryno
 */
class Lib_html extends Lib_core{
    public $container_fluid = false;
    private $form_id = false;
    private $form_success_js = false;
    private $form_error_js = false;
    private $html = [
        "html" => false,
        "form_open" => false,
        "form_close" => false,
        "header" => false,
        "script_ready" => false,
        "script" => false,
    ];
    private $menu_html = [];
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->library("Lib_html_tags");
    }
    //--------------------------------------------------------------------------
    public function form($action, $id = false, $attributes_arr = [], $options = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        if(!$id){ $id = "form_".time(); }
        $this->form_id = $id;
        
        $this->add_html("form_open", Lib_html_tags::form_open($action, $id, $attributes, $options));
    }
    //--------------------------------------------------------------------------
    public function end_form() {
        $this->add_html("form_close", Lib_html_tags::form_close());
    }
    //--------------------------------------------------------------------------
    public function fieldset_open($header = "", $options = []) {
        $options_arr = array_merge([
        ], $options);
        
        $this->add_html("html", Lib_html_tags::fieldset_open($header));
    }
    //--------------------------------------------------------------------------
    public function fieldset_close() {
        $this->add_html("html", Lib_html_tags::fieldset_close());
    }
    //--------------------------------------------------------------------------
    public function header($label, $type = 1, $attributes_arr = []) {
        $attributes = array_merge([
            "container_fluid" => $this->container_fluid
        ], $attributes_arr);
        
        $this->add_html("header", Lib_html_tags::header($label, $type, $attributes));
    }
    //--------------------------------------------------------------------------
    public function add_title($title, $info = false, $options = []) {
        $this->add_html("html", Lib_html_tags::title($title, $info, $options));
    }
    //--------------------------------------------------------------------------
    public function iradio_multi($label, $id, $item_arr = [], $checked = false, $options = []) {
        $options_arr = array_merge([
            "enable_set_value" => false,
        ], $options);
        
        $error = form_error($id);
        if($error){
            $label .= "<div class='form-error-label'>$error</div>";
        }
        $this->add_html("html", Lib_html_tags::iradio_multi($label, $id, $item_arr, $checked, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function iradio($label, $id, $checked = false, $options = []) {
        $options_arr = array_merge([
            "enable_set_value" => false,
        ], $options);
        
        $error = form_error($id);
        if($error){
            $label .= "<div class='form-error-label'>$error</div>";
        }
        $this->add_html("html", Lib_html_tags::iradio($label, $id, $checked, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function icheckbox($label, $id, $checked = false, $options = []) {
        $options_arr = array_merge([
            "enable_set_value" => false,
        ], $options);
        
        $error = form_error($id);
        if($error){
            $label .= "<div class='form-error-label'>$error</div>";
        }
        $this->add_html("html", Lib_html_tags::icheckbox($label, $id, $checked, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function itext($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
            "enable_set_value" => false,
        ], $options);
        
        $error = form_error($id);
        if($error){
            $label .= "<div class='form-error-label'>$error</div>";
        }
        $this->add_html("html", Lib_html_tags::itext($label, $id, $value, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function itextarea($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
            "enable_set_value" => false,
        ], $options);
        
        $error = form_error($id);
        if($error){
            $label .= "<div class='form-error-label'>$error</div>";
        }
        $this->add_html("html", Lib_html_tags::itextarea($label, $id, $value, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function idate($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
            "enable_set_value" => false,
        ], $options);
        $error = form_error($id);
        if($error){
            $label .= "<div class='form-error-label'>$error</div>";
        }
        $this->add_html("html", Lib_html_tags::idate_picker($label, $id, $value, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function dbinput($obj, $field, $options = []) {
        
        $options_arr = array_merge([
            "function" => false
        ], $options);
        switch ($obj->get_field_type($field)) {
            case DB_VARCHAR:
                return $this->itext(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_DATETIME:
                return $this->idate(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_DATE:
                return $this->idate(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_YEAR:
                return $this->idate(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_TINYINT:
                return $this->iselect(ucwords($obj->get_field_display($field)), $field, array_map('ucwords', $obj->{$field}), $obj->get($field, $options_arr["function"], $options), $options);
            case DB_TEXT:
                return $this->itextarea(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_ENCRYPT:
                return $this->ipassword(ucwords($obj->get_field_display($field)), $field, false, $options);

            default:
                break;
        }
    }
    //--------------------------------------------------------------------------
    public function dbvalue($obj, $field, $options = []) {
        
        $options_arr = array_merge([
            "function" => false
        ], $options);
        switch ($obj->get_field_type($field)) {
            case DB_VARCHAR:
                return $this->itext(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
                return $this->itext(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_DATETIME:
                return $this->idate(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_DATE:
                return $this->idate(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_YEAR:
                return $this->idate(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_TINYINT:
                return $this->iselect(ucwords($obj->get_field_display($field)), $field, array_map('ucwords', $obj->{$field}), $obj->get($field, $options_arr["function"], $options), $options);
            case DB_TEXT:
                return $this->itextarea(ucwords($obj->get_field_display($field)), $field, $obj->get($field, $options_arr["function"], $options), $options);
            case DB_ENCRYPT:
                return $this->ipassword(ucwords($obj->get_field_display($field)), $field, false, $options);

            default:
                break;
        }
    }
    //--------------------------------------------------------------------------
    public function value($label, $value = false, $options = []) {
        $options_arr = array_merge([
        ], $options);
        
        $this->add_html("html", Lib_html_tags::value($label, $value, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function ihidden($id, $value = false, $options = []) {
        $options_arr = array_merge([
        ], $options);
        
        $this->add_html("html", form_hidden($id, $value));
    }
    //--------------------------------------------------------------------------
    public function ipassword($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
        ], $options);
        
        $this->add_html("html", Lib_html_tags::ipassword($label, $id, $value, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function iselect($label, $id, $value_arr = [], $value = false, $options = []) {
        $options_arr = array_merge([
        ], $options);
        
        $this->add_html("html", Lib_html_tags::iselect($label, $id, $value_arr, $value, $options_arr));
    }
    //--------------------------------------------------------------------------
    public function add_menu_button($label, $onclick = "javascript:;", $options = []) {
        $options_arr = array_merge([
            "icon" => false,
            "btn" => false,
        ], $options);
        
        if(!$options_arr["btn"]){
            switch (strtolower($label)) {
                case "cancel": $options_arr["btn"] = "btn-danger"; break;
                default: $options_arr["btn"] = "btn-primary"; break;
            }
            
        }
        
        $icon = $options_arr["icon"] ? '<i class="fa '.$options_arr["icon"].'" aria-hidden="true"></i> ' : '';
        $this->menu_html[] = '<button onclick="'.$onclick.'" class="btn '.$options_arr["btn"].' margin-right-5" type="button">'.$icon.$label.'</button>';
    }
    //--------------------------------------------------------------------------
    public function add_menu_submitbutton($label, $onclick = false, $options = []) {
        $options_arr = array_merge([
            "icon" => "fa-save",
            "attributes" => [
                "class" => "btn btn-primary margin-right-5",
                "value" => "Save Changes",
            ],
        ], $options);
        
        $this->set_form_js("success");
        $this->set_form_js("error");
        
        $icon = $options_arr["icon"] ? '<i class="fa '.$options_arr["icon"].'" aria-hidden="true"></i> ' : '';
        if($onclick === false){
            $onclick = "system.ajax.submitForm('$this->form_id', {success: function(data){
                $this->form_success_js
            }, error: function(){
                $this->form_error_js
            }});";
        }
        
        $this->menu_html[] = '<button onclick="'.$onclick.'" class="btn btn-success margin-right-5" type="button">'.$icon.$label.'</button>';
    }
    //--------------------------------------------------------------------------
    public function set_form_js($type = "success", $js = false) {
        switch ($type) {
            case "success":
                $this->form_success_js = $js ? $js : "
                    if(data.code == 1){
                        system.browser.error(data.message);
                    }else if(data.code == 2){
                        system.browser.message('Success', data.message);
                    }else if(data.code == 3){
                        if(data.action.type == 'refresh'){
                            $('.messageModalCloseBtn').click(location.reload());
                        }else if(data.action.type == 'redirect'){
                            $('.messageModalCloseBtn').click(function(){
                                system.browser.redirect(data.action.url);
                            });
                        }
                        system.browser.message('Success', data.message);
                    }else{
                        location.reload();
                    }
                ";
                break;
            case "error":
                $this->form_error_js = $js ? $js : "
                    system.browser.error('An error has occured. If this presists, please contact your system administrator.');
                ";
                break;
        }
        
    }
    //--------------------------------------------------------------------------
    public function build_menu_html() {
        $menu_wrapper= '';
        $container = $this->container_fluid ? "container-fluid" : "container";
        if(count($this->menu_html) > 0){
            $menu = implode(" ", $this->menu_html);
            $menu_wrapper = "
                <div class='$container margin-bottom-10'>
                    <div class='btn-group btn-group-sm' role='group'>
                        $menu
                    </div>
                </div>
            ";
        }
        $this->add_html("header", $menu_wrapper);
    }
    //--------------------------------------------------------------------------
    public function add_html($key, $html) {
        $this->html[$key] .= $html;
    }
    //--------------------------------------------------------------------------
    public function add_script($script, $ready = true) {
        if($ready){
            $this->html["script_ready"] .= $script;
        }else{
            $this->html["script"] .= $script;
        }
    }
    //--------------------------------------------------------------------------
    public function add_column($size) {
        switch ($size) {
            case "full": $this->add_html("html", "<div class='col-md-12'>"); break;
            case "half": $this->add_html("html", "<div class='col-md-6'>"); break;
            case "third": $this->add_html("html", "<div class='col-md-4'>"); break;
            case "quarter": $this->add_html("html", "<div class='col-md-3'>"); break;
        }
    }
    //--------------------------------------------------------------------------
    public function end_column() {
        $this->add_html("html", "</div>");
    }
    //--------------------------------------------------------------------------
    public function container_wrapper($html) {
        $container = $this->container_fluid ? "container-fluid" : "container";
        $script_ready = strlen(trim($html['script_ready'])) > 1 ? "
            <script>
                $(document).ready(fucntion(){
                    {$html['script_ready']}
                });
            </script>
        " : "";
        $script = strlen(trim($html['script'])) > 1 ? "
            <script>
                {$html['script']}
            </script>
        " : "";
        return "
            <div class='$container'>
                <div class='row'>
                    {$html['form_open']}
                    {$html['header']}
                    {$html['html']}
                    {$html['form_close']}
                    {$script_ready}
                    {$script}
                </div>
            </div>
        ";
    }
    //--------------------------------------------------------------------------
    public function display() {
        $this->build_menu_html();
        echo $this->container_wrapper($this->html);
    }
    //--------------------------------------------------------------------------
    public function get() {
        $this->build_menu_html();
        return $this->container_wrapper($this->html);
    }
    //--------------------------------------------------------------------------
    public static function make() {
        $ci = &get_instance();
        $ci->load->library("Lib_database");
        return $this->ci->db;
    }
    //--------------------------------------------------------------------------
}