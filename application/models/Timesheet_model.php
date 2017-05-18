<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Timesheet_model extends MY_Model {
	var $user_id;
	var $day;
	var $start_time;
	var $end_time;
	var $category;
	var $details;

	function prepare_variables()
	{
		$variables = array (
				'user_id',
				'day',
				'start_time',
				'end_time',
				'category',
				'details' 
		);
		
		foreach ( $variables as $variable ) {
			if ($this->input->post ( $variable )) {
				if (strpos ( $variable, "time" )) {
					$this->$variable = $this->input->post ( $variable );
				} else {
					$this->$variable = $this->input->post ( $variable );
				}
			}
		}
	}

	function get($id)
	{
		return $this->_get ( 'timesheet', $id );
	}

	function get_for_user($user_id, $options = array())
	{
		$this->db->from ( 'timesheet' );
		$this->db->where ( 'user_id', $user_id );
		if (array_key_exists ( 'day', $options )) {
			$this->db->where ( 'day', $options ['day'] );
		}
		if (array_key_exists ( 'start_time', $options )) {
			$this->db->where ( 'start_time >=', $options ['start_time'] );
		}
		if (array_key_exists ( 'end_time', $options )) {
			$this->db->where ( 'end_time <=', $options ['end_time'] );
		}
		if (array_key_exists ( 'start_day', $options )) {
			$this->db->where ( 'day >=', $options ['start_day'] );
		}
		if (array_key_exists ( 'end_day', $options )) {
			$this->db->where ( 'day <=', $options ['end_day'] );
		}
		if (array_key_exists ( 'category', $options )) {
			$this->db->where ( 'timesheet.category', $options ['category'] );
		}
		$this->db->join ( "variable", "variable.category='time_category_$user_id' AND var_key = timesheet.category", "LEFT" );
		$this->db->order_by ( 'day' );
		$this->db->order_by ( 'start_time' );
		$this->db->order_by ( 'end_time' );
		$this->db->select ( "timesheet.*,variable.var_value" );
		$result = $this->db->get ()->result ();
		return $result;
	}

	function insert($values = array())
	{
		if (empty ( $values )) {
			$this->prepare_variables ();
			$this->category = $this->variable->insert ( "time_category_$this->user_id", $this->category );
		} else {
			foreach ( $values as $key => $value ) {
				$this->$key = $value;
			}
		}
		
		return $this->_insert ( 'timesheet' );
	}

	function update($id, $values = array())
	{
		if (empty ( $values )) {
			$this->prepare_variables ();
			$this->category = $this->variable->insert ( "time_category_$this->user_id", $this->category );
			$values = ( array ) $this;
		}
		return $this->_update ( 'timesheet', $id, $values );
	}

	function delete($id)
	{
		$this->_delete ( 'timesheet', $id );
	}
}