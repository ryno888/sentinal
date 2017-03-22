<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of com_html
 *
 * @author Ryno Laptop
 */
class lib_list extends lib_core{
    
    public $id = false;
    public $sql_key = false;
    
    public $sql_select = false;
    public $sql_from = false;
    public $sql_where = false;
    public $sql_order_by = false;
    public $sql_limit = 20;
    public $sql_offset = 0;
    public $sql_total_items = 0;
    public $sql = false;
    
    public $item_arr = [];
    
    public $searchfield_value = false;
    public $searchfield_label = "Search";
    private $search = false;
    
    private $current_page_index = 1;
    public $pagination_max_pages_to_show = 7;
    
    private $menu_arr = [];
    private $added_arr = [];
    private $legend_arr = [];
    private $action_arr = [];
    private $col_header_arr = [];
    private $field_class_arr = [];
    private $field_style_arr = [];
    private $html = "";
    private $titel = false;
    private $base_url = false;
    private $current_url = false;
    private $current_url_query_string = false;
    
    
    public $ci = false;
    private $action_edit = "";
    private $action_edit_modal = "";
    private $action_delete_modal = "";
    private $action_delete = "";
    
    //--------------------------------------------------------------------------
    /**
     * 
     * @param type $sql
     * @param type $color = green/red/orange/blue
     */
    public function __construct(){
        parent::__construct();
        $this->ci->load->database();
        $this->ci->load->library("lib_database");
        
        $this->current_page_index = request("page", 1);
        
        $this->search = request("__search");
        $current_url_parts = explode("/", str_replace(base_url(), "", current_url()));
        $this->current_url = base_url()."{$current_url_parts[0]}/{$current_url_parts[1]}/{$current_url_parts[2]}";
        $this->base_url = $this->base_url ? $this->base_url : current_url();
        $_url = parse_url(current_url(true));
        $this->current_url_query_string = $_url && isset($_url['query']) ? $_url['query'] : false;
    }
    //--------------------------------------------------------------------------
    /**
     * 
     * @param type $sql
     * @param type $color = green/red/orange/blue
     */
    public function add_legend($color, $description, $sql){
        $css_color = $this->get_legend_color($color);

    	// add to legend array
    	$this->legend_arr[$css_color] = array(
    		"description" => $description,
    		"sql" => $sql,
    	);
    }
    //--------------------------------------------------------------------------
    public function add_action_edit($onclick = "javascript:;", $icon = "fa-pencil", $options = []){
        $options_arr = array_merge([
            "class" => false,
            "style" => false,
            "title" => "Manage",
        ], $options);
        
        
        array_unshift ($this->col_header_arr, "", "<th></th>");
        
        $this->action_arr[] = "
            <td class='list-action'>
                <i title='{$options_arr["title"]}' onclick=\"$onclick\" class='fa {$icon} {$options_arr["class"]} padding-left-5' aria-hidden='true'></i>
            </td>";
    }
    //--------------------------------------------------------------------------
    public function add_action_assoc($url = false, $uri_data = [], $icon = "fa-pencil", $options = []){
        
        $options_arr = array_merge([
            "class" => false,
            "style" => false,
            "title" => "Manage",
        ], $options);
        
        $edit_url = $this->ci->uri->assoc_to_uri($uri_data);
        
        array_unshift ($this->col_header_arr, "", "<th></th>");
        $onclick = !$url ? "javascript:;" : "system.browser.redirect('$url/$edit_url')";
        
        $this->action_arr[] = "
        <td class='list-action'>
            <i title='{$options_arr["title"]}' onclick=\"$onclick\" class='fa {$icon} {$options_arr["class"]} padding-left-5' aria-hidden='true'></i>
        </td>";
    }
    //--------------------------------------------------------------------------
    public function add_action_delete($onclick = false, $icon = "fa-times", $options = []){
        $options_arr = array_merge([
            "class" => false,
            "style" => false,
            "title" => "Delete",
            "confirm" => false,
        ], $options);
        
        array_unshift ($this->col_header_arr, "", "<th></th>");
        
        $onclick_js = "system.browser.confirm('Are you sure you want to delete this entry?',
            function(){ alert('yes'); }
            );";
        
        
        $this->action_arr[] = "
            <td class='list-action'>
                <i title='{$options_arr["title"]}' onclick=\"$onclick_js\" class='fa {$icon} {$options_arr["class"]} padding-left-5' aria-hidden='true'></i>
            </td>";
    }
    //--------------------------------------------------------------------------
    public function add_field($label, $db_field, $options = []){
        
        $options_arr = array_merge([
            "function" => false,
        ], $options);
        
        $this->added_arr [$db_field] = [
            "label" => $label,
            "db_field" => $db_field,
            "function" => $options_arr["function"],
        ];
        
        $html_options = lib_html_tags::get_html_options($options);
        $this->field_class_arr[$db_field] = "{$html_options['css']}";
        $this->field_style_arr[$db_field] = "{$html_options['style']}";
        
        $this->col_header_arr[] = "<th>$label</th>";
    }
    //--------------------------------------------------------------------------
    public function add_title($title, $info = "", $options = []){
        $options_arr = array_merge([
            "class" => "list-page-header",
            "style" => false,
            "type" => 1,
        ], $options);
        $this->titel = "
            <div class='{$options_arr['class']}' style='{$options_arr['style']}'>
				<h{$options_arr['type']}>
					$title <small>$info</small>
				</h{$options_arr['type']}>
			</div>
        ";
    }
    //--------------------------------------------------------------------------
    private function sql_execute(){
        
        $legend_select = $this->get_legend_sql();
        $this->ci->load->database();
        $this->db = $this->ci->db;
        
        $this->db->select("$this->sql_select $legend_select");
        
        $this->db->from($this->sql_from);
        
        if($this->search){
            $this->sql_where .= $this->sql_where ? "AND $this->searchfield_value LIKE '%$this->search%'" : "$this->searchfield_value LIKE '%$this->search%'";
        }
        
        if($this->sql_where){ $this->db->where($this->sql_where); }
        if($this->sql_order_by){
            $this->db->order_by($this->sql_order_by);
        }
        if($this->current_page_index > 1){
            $this->sql_offset = $this->sql_limit * ($this->current_page_index - 1);
        }
        
        $this->db->limit($this->sql_limit, $this->sql_offset);
        $this->item_arr = $this->db->get()->result();
        $this->sql_total_items = $this->db->count_all_results($this->sql_from);
        
        $this->sql = $this->db->last_query();
    }
    //--------------------------------------------------------------------------
    private function build(){
        //execute sql
        $this->sql_execute();
        
        $table_body = "";
        
        if(count($this->item_arr) > 0){
            $col_header_str = implode("\n", $this->col_header_arr);
            foreach ($this->item_arr as $db_key => $db_obj) {
                $legend_class = property_exists($db_obj, "__legend") ? $db_obj->__legend : "";
                $table_body .= "<tr class='$legend_class'>";
                foreach ($this->action_arr as $action_td) {
                    $table_body .= str_replace("%$this->sql_key%", $db_obj->{$this->sql_key}, $action_td);
                }
                foreach ($this->added_arr as $key => $value) {
                    $field_value = $db_obj->{$value['db_field']};
                    if($value['function']){
                        $field_value = call_user_func($value['function'], $field_value);
                    }
                    $class = $this->field_class_arr["{$value['db_field']}"] ? " class='{$this->field_class_arr["{$value['db_field']}"]}' " : "";
                    $style = $this->field_style_arr["{$value['db_field']}"] ? " style='{$this->field_style_arr["{$value['db_field']}"]}' " : "";
                    $table_body .= "<td{$class}{$style}>$field_value</td>";
                }
                $table_body .= "</tr>";
            }
            return $this->html = "
                <table id='$this->id' class='table table-bordred table-striped font-size-12'>
                    <thead> {$col_header_str} </thead>
                    <tbody>
                        $table_body
                    </tbody>
                </table>
            ";
        }else{
            return $this->html = "
                <div class='container-fluid'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <h3 style='color: #777;'>
                                No results found in database.
                            </h3>
                        </div>
                    </div>
                </div>
            ";
        }
    }
    //--------------------------------------------------------------------------
    private function get_legend_sql(){
        // legend
        if ($this->legend_arr) {
        	$this_select = ", (CASE";
        	foreach ($this->legend_arr as $legend_index => $legend_item) {
        		if ($legend_item["sql"] == "ELSE") $this_select .= " ELSE '$legend_index'";
				else $this_select .= " WHEN {$legend_item["sql"]} THEN '$legend_index'";
        	}
        	$this_select .= " END) AS __legend";
            return $this_select;
        }
        return false;
    }
    //--------------------------------------------------------------------------
    private function get_legend_color($color = false){
        $css_arr = [
            "green" => "success",
            "red" => "danger",
            "orange" => "warning",
            "blue" => "info",
        ];
        
        return $color ? $css_arr[$color] : "";
    }
    //--------------------------------------------------------------------------
    public function nav_append($html){
        $this->menu_arr[] = $html;
    }
    //--------------------------------------------------------------------------
    public function add_new_btn($label = "Add", $onclick = "javascript:;"){
        $this->menu_arr[] = '
            <div class="input-group-btn padding-right-5">
                <button onclick="'.$onclick.'" class="btn btn-default" type="button"><i class="fa fa-plus" aria-hidden="true"></i> '.$label.'</button>
            </div>
        ';
    }
    //--------------------------------------------------------------------------
    private function get_menu(){
        
        if($this->searchfield_value){
            $hidden = $this->search ? "" : "hidden";
            $this->menu_arr[] = "
                <input id='__search' name='__search' class='form-control' value='$this->search' type='text'>
                <div class='input-group-btn padding-left-5'>
                    <button class='btn btn-default' type='submit'><i class='fa fa-search' aria-hidden='true'></i> $this->searchfield_label</button>
                </div>
                <div class='input-group-btn padding-left-5'>
                    <button class='btn btn-default $hidden' onclick='document.location=\"$this->current_url\"' type='button'>Clear</button>
                </div>
            ";
        }
        
        if(count($this->menu_arr) > 0){
            $menu_html = implode("\n", $this->menu_arr);
            return "
                <div class='list-menu'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <form role='form' class='form-inline' method='post' action='$this->current_url'>
                                <div class='container-fluid'>
                                    <div class='input-group input-group-sm'>
                                        $menu_html
                                    </div>
                                    <div class='input-group input-group-sm'>
                                        {$this->get_pagination()}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='col-md-6'></div>
                    </div>
                </div>
            ";
        }
    }
    //-----------------------------------------------------------------------
    private function get_pagination() {
        $query = $this->get_url_query_string();
        $params = array(
            "totalItems" => $this->get_total_items(), 
            "itemsPerPage" => $this->sql_limit, 
            "currentPage" => $this->current_page_index, 
            "urlPattern" => "$this->current_url/page/(:num){$query}"
        );
        $this->ci->load->library("lib_paginator", $params);
        $lib_paginator = new lib_paginator($params);
        $lib_paginator->setMaxPagesToShow($this->pagination_max_pages_to_show);
        return $lib_paginator;
    }
    //-----------------------------------------------------------------------
    private function get_url_query_string() {
        $query_parts = $this->ci->uri->uri_to_assoc();
        if(isset($query_parts['page'])){
            unset($query_parts["page"]);
        }
        
        return $this->ci->uri->assoc_to_uri($query_parts);
    }
    //-----------------------------------------------------------------------
    private function get_total_items() {
        return $this->sql_total_items;
    }
    //-----------------------------------------------------------------------
    public function display() {
        $this->build();
        $html = "<div class='container-fluid'>";
            $html .= $this->titel;
            $html .= $this->get_menu();
            $html .= $this->html;
        $html .= "</div>";
        echo $html;
    }
    //--------------------------------------------------------------------------
}
