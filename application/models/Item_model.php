<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// item_model.php Chris Dart Mar 6, 2015 7:17:15 PM chrisdart@cerebratorium.com
class Item_Model extends MY_Model {
	var $po_id;
	var $po;
	var $item_count;
	var $sku;
	var $description;
	var $price;
	var $category;

	function prepare_variables()
	{
		$variables = array (
				"po_id",
				"po",
				"item_count",
				"sku",
				"description",
				"price",
				"category" 
		);
		foreach ( $variables as $variable ) {
			$this->$variable = urldecode ( $this->input->post ( $variable ) );
		}
	}

	function get($id)
	{
		return $this->_get ( "item", $id );
	}

	function get_for_po($po_id)
	{
		$this->db->from ( "item" );
		$this->db->where ( "po_id", $po_id );
		$this->db->select ( "item.*" );
		$this->db->select ( "(`item`.`price` * `item`.`item_count`) as `total`", FALSE );
		$result = $this->db->get ()->result ();
		return $result;
	}

	/**
	 * DEPRECATED FOR get_for_po()
	 */
	function get_by_po($po_id)
	{
		return $this->get_for_po ( $po_id );
	}

	function insert()
	{
		$this->prepare_variables ();
		$id = $this->_insert ( "item" );
		return $id;
	}

	function update($id, $values = NULL)
	{
		$this->_update ( "item", $id, $values );
	}

	function delete($id)
	{
		$this->_delete ( "item", $id );
	}
}