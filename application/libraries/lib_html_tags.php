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
class lib_html_tags extends lib_core{
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->helper('html');
        $this->ci->load->helper('form');
    }
    //--------------------------------------------------------------------------
    public static function header($label, $type = 1, $options = []) {
        $options_arr = array_merge([
            'attr_arr'       => [],
        ], $options);
        
        return "<div class='container'>".heading($label, $type, $options_arr['attr_arr'])."</div>";
    }
    //--------------------------------------------------------------------------
    public static function itext($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
            'append'       => false,
            'prepend'       => false,
            'attr_arr'       => [],
        ], $options);
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "form-control input-sm",
            'js'            => "",
        ], $options_arr['attr_arr']);
        
        return self::wrap_form_group($label, $id, form_input($data_arr, '', $data_arr['js']), $options_arr);
    }
    //--------------------------------------------------------------------------
    public static function itextarea($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
            'append'       => false,
            'prepend'       => false,
            'attr_arr'       => [],
        ], $options);
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "form-control",
            'js'         => "",
        ], $options_arr["attr_arr"]);
        
        return self::wrap_form_group($label, $id, form_textarea($data_arr, '', $data_arr['js']), $options_arr);
    }
    //--------------------------------------------------------------------------
    public static function ipassword($label, $id, $value = false, $options = []) {
        $options_arr = array_merge([
            'append'       => false,
            'prepend'       => false,
            'attr_arr'       => [],
        ], $options);
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "form-control input-sm",
            'js'         => "",
        ], $options_arr["attr_arr"]);
        
        return self::wrap_form_group($label, $id, form_password($data_arr, '', $data_arr['js']));
    }
    //--------------------------------------------------------------------------
    public static function iselect($label, $id, $value_arr = [], $value = false, $options = []) {
        $options_arr = array_merge([
            'append'       => false,
            'prepend'       => false,
            'attr_arr'       => [],
        ], $options);
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'       => 'shirts',
            'onChange' => '',
            'class' => 'form-control input-sm',
        ], $options_arr["attr_arr"]);
        return self::wrap_form_group($label, $id, form_dropdown('', $value_arr, $value, $data_arr));
    }
    //--------------------------------------------------------------------------
    public static function iselect_multi($label, $id, $value_arr = [], $value = false, $options = []) {
        $options_arr = array_merge([
            'append'       => false,
            'prepend'       => false,
            'attr_arr'       => [],
        ], $options);
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'       => 'shirts',
            'onChange' => '',
            'class' => 'form-control input-sm',
        ], $options_arr["attr_arr"]);
        return self::wrap_form_group($label, $id, form_multiselect('', $value_arr, $value, $data_arr));
    }
    //--------------------------------------------------------------------------
    public static function fieldset($header, $html) {
        $return = '';
        $return .= form_fieldset($header);
        $return .=  $html;
        $return .=  form_fieldset_close();
        return $return;
    }
    //--------------------------------------------------------------------------
    public static function fieldset_open($header) {
        return form_fieldset($header);
    }
    //--------------------------------------------------------------------------
    public static function fieldset_close() {
        return form_fieldset_close();
    }
    //--------------------------------------------------------------------------
    public static function ifile($label, $id, $value = false, $options = []) {
        
        $options_arr = array_merge([
            'attr_arr'       => [],
        ], $options);
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "hidden",
            'js'         => "",
        ], $options_arr["attr_arr"]);
        
        return self::wrap_form_group(false, $id, "
            <label class='btn btn-primary btn-sm btn-file'>
                $label ".form_upload($data_arr, '', $data_arr['js'])."
            </label>");
    }
    //--------------------------------------------------------------------------
    public static function form_open($action, $id = false, $options = []) {
        $options_arr = array_merge([
            'attr_arr'       => [],
            'display_inline' => false,
        ], $options);
        
        if(!$id){ $id = time().rand(100, 999); }
        
        $class = "";
        
        if($options_arr["display_inline"]){
            $class .= "form-inline ";
        }
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'class'         => $class,
            'role'         => "form",
        ], $options_arr["attr_arr"]);
        return form_open($action, $data_arr);
    }
    //--------------------------------------------------------------------------
    public static function form_close() {
        return form_close();
    }
    //--------------------------------------------------------------------------
    public static function wrap_form_group($label, $id, $element, $options = []) {
        
        $options_arr = array_merge([
            "prepend" => false,
            "append" => false,
        ], $options);
        
        if($label !== false){
            $label = '<label for="'.$id.'">'.$label.'</label>';
        }
        if($options_arr["prepend"]){
            $element = '
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">'.$options_arr["prepend"].'</span>
                    '.$element.'
                </div>
            ';
        }
        if($options_arr["append"]){
            $element = '
                <div class="input-group input-group-sm">
                    '.$element.'
                    <span class="input-group-addon">'.$options_arr["append"].'</span>
                </div>
            ';
        }
        
        return '
            <div class="form-group">
                '.$label.'
                '.$element.'
            </div>
        ';
    }
    //--------------------------------------------------------------------------
    public static function get_html_options($options = []){
        $css = "";
        $attr = "";
        $style = "";
        foreach ($options as $key => $value) {
            $r = substr($key, 0, 1);
            $el = substr($key, 1);
            switch ($r) {
                case ".": 
                    $css .= $css != "" ? " " : "";
                    $css .= "$el"; 
                    break;
                case "@": 
                    $attr .= $attr != "" ? " " : "";
                    $attr .= "$el='$value'"; 
                    break;
                case "#": 
                    $style .= $style != "" ? " " : "";
                    $style .= "$el:$value;"; 
                    break;
                default: break;
            }
        }
        return[
            "css" => $css,
            "attr" => $attr,
            "style" => $style,
        ];
    }
    //--------------------------------------------------------------------------
}
