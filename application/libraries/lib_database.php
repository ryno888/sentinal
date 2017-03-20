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
class lib_database extends lib_core{
    //put your code here
    private $db = false;
    
    private $select = false;
    private $from = false;
    private $where = false;
    private $limit = false;
    private $join = false;
    //--------------------------------------------------------------------------
    public function __construct(){
        parent::__construct();
        $this->ci->load->database();
        $this->db = $this->ci->db;
    }
    //--------------------------------------------------------------------------
    public function select($select){
        $this->select = $select;
        $this->db->select($select);
    }
    //--------------------------------------------------------------------------
    public function from($from){
        $this->from = $from;
        $this->db->from($from);
    }
    //--------------------------------------------------------------------------
    public function join($table, $on){
        $this->join .= " $table ON ($on) ";
        $this->db->join($table, $on);
    }
    //--------------------------------------------------------------------------
    public function insert($table, $db_obj = false){
        if($db_obj && is_object($db_obj)){
            $this->db->insert($table, $db_obj);
        }
    }
    //--------------------------------------------------------------------------
    public function update($table, $key, $db_obj = false){
        if($db_obj && is_object($db_obj)){
            $this->db->where($key, $db_obj->{$key});
            $this->db->update($table, $db_obj);
        }
    }
    //--------------------------------------------------------------------------
    public function where($where){
        $this->where = $where;
        $this->db->where($where);
    }
    //--------------------------------------------------------------------------
    public function limit($limit){
        $this->limit = $limit;
        $this->db->limit($limit);
    }
    //--------------------------------------------------------------------------
    public function get(){
        $result = $this->db->get()->result();
        if($this->limit == 1 && array_key_exists(0, $result)){
            return $result[0];
        }
        return $result;
    }
    //--------------------------------------------------------------------------
    public function get_query_string(){
        $sql = "SELECT $this->select FROM $this->from";
        if($this->where){ $sql .= " WHERE $this->where"; }
        if($this->limit){ $sql .= " LIMIT $this->limit"; }
        return "$sql";
    }
    //--------------------------------------------------------------------------
    public function get_calc_rows(){
        $sql = "SELECT COUNT(*) AS total FROM $this->from";
        $result = lib_database::query($sql, 1);
        return $result->total;
    }
    //--------------------------------------------------------------------------
    public static function query($sql, $limit = false){
        $ci =& get_instance();
        $ci->load->database();
        $resultSet = $ci->db->query($limit ? "$sql LIMIT $limit " : $sql);
        
        $result = $resultSet && is_object($resultSet) ? $resultSet->result() : false;
        if($result && $limit == 1 && array_key_exists(0, $result)){
            return $result[0];
        }
        return $result;
    }
    //--------------------------------------------------------------------------
    public static function selectsingle($sql){
        return lib_database::query($sql, 1);
    }
    //--------------------------------------------------------------------------
    public static function selectlist($sql, $field1, $field2){
        $return_arr = [];
        $result_arr = lib_database::query($sql);
        foreach ($result_arr as $key => $value) {
            $return_arr[$value->{$field1}] = $value->{$field2};
        }
        return $return_arr;
    }
    //--------------------------------------------------------------------------
}
