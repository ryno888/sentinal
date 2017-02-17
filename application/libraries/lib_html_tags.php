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
class lib_html_tags {
    private $ci = false;
    //--------------------------------------------------------------------------
    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->helper('html');
        $this->ci->load->helper('form');
    }
    //--------------------------------------------------------------------------
    public static function header($label, $type = 1, $attributes_arr = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        return "<div class='container'>".heading($label, $type, $attributes)."</div>";
    }
    //--------------------------------------------------------------------------
    public static function itext($label, $id, $value = false, $attributes_arr = []) {
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "form-control input-sm",
            'js'         => "",
        ], $attributes_arr);
        
        return self::wrap_form_group($label, $id, form_input($data_arr, '', $data_arr['js']));
    }
    //--------------------------------------------------------------------------
    public static function itextarea($label, $id, $value = false, $attributes_arr = []) {
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "form-control",
            'js'         => "",
        ], $attributes_arr);
        
        return self::wrap_form_group($label, $id, form_textarea($data_arr, '', $data_arr['js']));
    }
    //--------------------------------------------------------------------------
    public static function ipassword($label, $id, $value = false, $attributes_arr = []) {
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "form-control input-sm",
            'js'         => "",
        ], $attributes_arr);
        
        return self::wrap_form_group($label, $id, form_password($data_arr, '', $data_arr['js']));
    }
    //--------------------------------------------------------------------------
    public static function iselect($label, $id, $value_arr = [], $value = false, $attributes_arr = []) {
        $data_arr = array_merge([
            'name'          => $id,
            'id'       => 'shirts',
            'onChange' => '',
            'class' => 'form-control input-sm',
        ], $attributes_arr);
        return self::wrap_form_group($label, $id, form_dropdown('', $value_arr, $value, $data_arr));
    }
    //--------------------------------------------------------------------------
    public static function iselect_multi($label, $id, $value_arr = [], $value = false, $attributes_arr = []) {
        $data_arr = array_merge([
            'name'          => $id,
            'id'       => 'shirts',
            'onChange' => '',
            'class' => 'form-control input-sm',
        ], $attributes_arr);
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
    public static function ifile($label, $id, $value = false, $attributes_arr = []) {
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'value'         => $value,
            'maxlength'     => false,
            'size'          => false,
            'style'         => false,
            'class'         => "hidden",
            'js'         => "",
        ], $attributes_arr);
        
        return self::wrap_form_group(false, $id, "
            <label class='btn btn-primary btn-sm btn-file'>
                Browse ".form_upload($data_arr, '', $data_arr['js'])."
            </label>");
    }
    //--------------------------------------------------------------------------
    public static function form_open($action, $id = false, $attributes_arr = [], $options = []) {
        
        if(!$id){ $id = time().rand(100, 999); }
        
        $options_arr = array_merge([
            'display_inline' => false,
        ], $options);
        
        $class = "";
        
        if($options_arr["display_inline"]){
            $class .= "form-inline ";
        }
        
        $data_arr = array_merge([
            'name'          => $id,
            'id'            => $id,
            'class'         => "",
            'role'         => "form",
        ], $attributes_arr);
        return form_open($action, $data_arr);
    }
    //--------------------------------------------------------------------------
    public static function form_close() {
        return form_close();
    }
    //--------------------------------------------------------------------------
    public static function wrap_form_group($label, $id, $element) {
        if($label !== false){
            $label = '<label for="'.$id.'">'.$label.'</label>';
        }
        return '
            <div class="form-group">
                '.$label.'
                '.$element.'
            </div>
        ';
    }
    //--------------------------------------------------------------------------
}
