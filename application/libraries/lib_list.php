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
    public $current_url = false;
    public $sql_select = false;
    public $sql_from = false;
    public $sql_where = false;
    public $sql_limit = 20;
    public $item_arr = [];
    public $searchfield_value = false;
    public $searchfield_label = "Search";
    private $search = false;
    
    private $menu_arr = [];
    private $added_arr = [];
    private $legend_arr = [];
    private $action_arr = [];
    private $col_header_arr = [];
    private $html = "";
    private $titel = false;
    
    
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
        
        $this->search = request("__search");
        $this->current_url = current_url();
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
                <i title='{$options_arr["title"]}' onclick=\"$onclick\" class='fa {$icon} {$options_arr["class"]}' aria-hidden='true'></i>
            </td>";
    }
    //--------------------------------------------------------------------------
    public function add_action_delete($onclick = "javascript:;", $icon = "fa-times", $options = []){
        $options_arr = array_merge([
            "class" => false,
            "style" => false,
            "title" => "Delete",
            "confirm" => false,
        ], $options);
        
        array_unshift ($this->col_header_arr, "", "<th></th>");
        
        $onclick_js = $onclick;
        
        
        $this->action_arr[] = "
            <td class='list-action'>
                <i title='{$options_arr["title"]}' onclick=\"$onclick\" class='fa {$icon} {$options_arr["class"]}' aria-hidden='true'></i>
            </td>";
    }
    //--------------------------------------------------------------------------
    public function add_field($label, $db_field, $options = []){
        $this->added_arr [$db_field] = [
            "label" => $label,
            "db_field" => $db_field,
        ];
        
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
        $comdb = new lib_database();
        $comdb->select("$this->sql_select $legend_select");
        $comdb->from($this->sql_from);
        if($this->search){
            $this->sql_where .= $this->sql_where ? "AND $this->searchfield_value LIKE '%$this->search%'" : "$this->searchfield_value LIKE '%$this->search%'";
        }
        if($this->sql_where){
            $comdb->where($this->sql_where);
        }
        if($this->sql_limit){
            $comdb->limit($this->sql_limit);
        }
        
        $this->item_arr = $comdb->get();
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
                    $table_body .= "<td>$field_value</td>";
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
                    <button class='btn btn-default' type='submit'>$this->searchfield_label</button>
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
                            <div class='col-md-6'>
                                <form role='form' class='form-inline' method='post'>
                                    <div class='container'>
                                        <div class='input-group input-group-sm'>
                                            $menu_html
                                            <ul class='padding-left-5 pagination pagination-sm' style='margin: 0px'>
                                                <li><a href='#'>&laquo;</a></li>
                                                <li><a href='#'>1</a></li>
                                                <li><a href='#'>2</a></li>
                                                <li><a href='#'>3</a></li>
                                                <li><a href='#'>4</a></li>
                                                <li><a href='#'>5</a></li>
                                                <li><a href='#'>&raquo;</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class='col-md-6'></div>
                        </div>
                    </div>
                </div>
            ";
        }
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
