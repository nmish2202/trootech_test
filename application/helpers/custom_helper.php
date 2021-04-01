<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function getData($table , $condition) {
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->where($condition);
    $ci->db->from($table);
    $query = $ci->db->get();
    return $query->row_array();
    
}
?>

