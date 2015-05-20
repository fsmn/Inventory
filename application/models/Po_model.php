<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// po_model.php Chris Dart Mar 6, 2015 6:35:01 PM chrisdart@cerebratorium.com
class PO_Model extends MY_Model {
	var $vendor_id;
	var $user_id;
	var $po;
	var $po_date;
	var $method;
	var $payment_type;
	var $ordered_by;
	var $billing_contact;
	var $category;
	var $shipping;
	var $quote;
	var $rec_modified;
	var $rec_modifier;

	function prepare_variables()
	{
		$variables = array (
				"vendor_id",
				"user_id",
				"po",
				"po_date",
				"method",
				"payment_type",
				"billing_contact",
				"category",
				"quote" 
		);
		foreach ( $variables as $variable ) {
			if ($this->input->post ( $variable )) {
				$this->$variable = urldecode ( $this->input->post ( $variable ) );
			}
		}
		
		$this->rec_modifier = $this->ion_auth->get_user_id ();
	}

	function get($id)
	{
		// $this->_get("po", $id);
		$this->db->from ( "po" );
		$this->db->where ( "po.id", $id );
		$this->db->join ( "vendor", "po.vendor_id = vendor.id", "LEFT" );
		$this->db->select ( "po.*" );
		$this->db->select ( "vendor.name as vendor,vendor.contact,vendor.address,vendor.locality,vendor.url,vendor.phone,vendor.fax,vendor.email,vendor.customer_id" );
		$result = $this->db->get ()->row ();
		return $result;
	}

	function get_by_po($po)
	{
		$this->db->where ( "po", $po );
		$this->db->from ( "po" );
		$this->db->select ( "id" );
		$result = $this->db->get ()->row ();
		if ($result) {
			$output = $this->get ( $result->id );
		} else {
			$output = FALSE;
		}
		return $output;
	}

	function get_for_vendor($vendor_id)
	{
		// $query = "SELECT `po`.*,`vendor`.`name` AS `vendor`,`i`.`total`
		// FROM `po` JOIN
		// (SELECT `item`.`po_id`, `item`.`item_count` * `item`.`price` AS `total`
		// FROM `item`,`po` WHERE `item`.`po_id` = `po`.`id` AND `po`.`vendor_id` = $vendor_id) AS `i` ON `i`.`po_id` = `po`.`id`
		// JOIN `vendor` ON `po`.`vendor_id` = `vendor`.`id`
		// WHERE `vendor_id` = $vendor_id ORDER BY `po`.`po_date` DESC ";
		
		// $result = $this->db->query ( $query )->result ();
		$this->db->from ( "po" );
		$this->db->join ( "vendor", "po.vendor_id=vendor.id" );
		$this->db->select ( "po.*" );
		$this->db->select ( "vendor.name as vendor" );
		$this->db->where ( "vendor_id", $vendor_id );
		$this->db->order_by ( "po.po_date", "DESC" );
		$result = $this->db->get ()->result ();
		$this->load->model ( "item_model", "item" );
		foreach ( $result as $po ) {
			$po->items = $this->item->get_by_po ( $po->id );
		}
		return $result;
	}

	function search($where = array(),$date_range = array())
	{
		$this->db->from ( "po" );
		$this->db->join ( "item", "po.id = item.po_id" );
		$this->db->join ( "vendor", "po.vendor_id = vendor.id" );
		if (! empty ( $where )) {
			if (is_array ( $where )) {
				foreach ( $where as $key => $value ) {
					switch ($key) {
						case "description" :
						case "sku" :
							$this->db->like ( "item." . $key, "$value" );
							break;
						default :
							$this->db->where ( "po." . $key, $value );
							break;
					}
				}
			}
		}
		if(array_key_exists("start_date",$date_range) && array_key_exists("end_date",$date_range)){
			$this->db->where(sprintf("po.po_date BETWEEN '%s' AND '%s'",$date_range["start_date"] , $date_range["end_date"
			]));
		}
		$this->db->select ( "item.description,item.sku" );
		$this->db->select ( "po.*" );
		$this->db->select ( "vendor.name as vendor" );
		$this->db->order_by ( "po.po_date", "desc" );
		$result = $this->db->get ()->result ();
		return $result;
	}

	function update($id, $values = FALSE)
	{
		$this->_update ( "po", $id, $values );
	}

	function delete($id)
	{
		$this->_delete ( "po", $id );
	}

	function insert()
	{
		$this->prepare_variables ();
		return $this->_insert ( "po" );
		echo $this->db->last_query ();
	}

	function get_distinct($field)
	{
		$this->db->distinct ( $field );
		$this->db->select ( $field );
		$this->db->from ( "po" );
		$this->db->order_by ( $field );
		$result = $this->db->get ()->result ();
		return $result;
	}
}