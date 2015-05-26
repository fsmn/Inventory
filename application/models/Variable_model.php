<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Variable_model extends MY_Model{
	
	var $category;
	var $var_key;
	var $var_value;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_types($category){
		$this->db->from("variable");
		$this->db->where("category",$category);
		$this->db->order_by("var_value");
		$result = $this->db->get()->result();
		return $result;
	}
	
	function insert($category, $value){
		$this->var_key = preg_replace("/[a-z]\_]/",'',str_replace(" ","_",strtolower($value)));
		$this->var_value = $value;
		$this->category = $category;
		$this->_insert("variable");
		return $this->var_key;
	}
	
	function get_pairs ($category, $order_by = array())
	{
		 
		$this->db->where('category', $category);
		$this->db->select('var_key');
		$this->db->select('var_value');
		$direction = "ASC";
		$order_field = "key";
	
		if (!empty($order_by)) {
			if (array_key_exists('direction', $order_by)) {
				$direction = $order_by['direction'];
			}
			if (array_key_exists('field', $order_by)) {
				$order_field = $order_by['field'];
			}
		}
	
		$this->db->order_by($order_field, $direction);
		$this->db->from('variable');
		$result = $this->db->get()->result();
		return $result;
	}
	
}