<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// vendor_model.php Chris Dart Mar 9, 2015 4:10:58 PM
// chrisdart@cerebratorium.com
class Vendor_Model extends MY_Model {
	var $type;
	var $name;
	var $contact;
	var $address;
	var $locality;
	var $url;
	var $phone;
	var $fax;
	var $email;
	var $customer_id;
	var $rec_modifier;
	var $rec_modified;

	function prepare_variables()
	{
		$variables = array (
				"type",
				"name",
				"contact",
				"address",
				"locality",
				"url",
				"phone",
				"fax",
				"email",
				"customer_id" 
		);
		foreach ( $variables as $variable ) {
			if ($value = $this->input->post ( $variable )) {
				$this->$variable = $value;
			}
		}
		if ($type = $this->input->post ( "type[]" )) {
			$this->type = implode ( ",", $type );
		}
		$this->rec_modifier = $this->ion_auth->get_user_id ();
	}

	function get($id)
	{
		return $this->_get ( "vendor", $id );
	}

	/**
	 * get a list of vendors by frequency of use if commonly used (10 or more items), then alphabetical
	 *
	 * @param unknown $type        	
	 */
	function get_all($type = NULL)
	{
		if ($type) {
			$this->db->like ( "vendor.type", $type );
			if ($type == "vendor") {
				$this->db->from ( "po" );
				$this->db->join ( "vendor", "po.vendor_id = vendor.id","RIGHT" );
				//if the number of pos by the vendor are greater than 10, then use that count as the count, otherwise just use 1
				$this->db->select("if(count(po.vendor_id) > 10, count(po.vendor_id),1) as c");
			} elseif ($type == "developer") {
				$this->db->from ( "asset" );
				$this->db->join ( "vendor", "asset.vendor_id = vendor.id" , "RIGHT");
				//if the number of assets by the developer are greater than 10, then use that count as the count, otherwise just use 1
				$this->db->select("if(count(asset.vendor_id) > 10, count(asset.vendor_id),1) as c");
				
			}
			$this->db->order_by ( "c", "DESC" );
		} else {
			$this->db->from ( "vendor" );
		}
		$this->db->select ( "vendor.*" );
		$this->db->group_by ( "vendor.name" );
		$this->db->order_by ( "name", "ASC" );
		$result = $this->db->get ()->result ();
		$this->_log ();
		return $result;
	}

	function get_distinct($field)
	{
		return $this->_get_distinct ( "vendor", $field );
	}

	function insert()
	{
		$this->prepare_variables ();
		return $this->_insert ( "vendor" );
	}

	function update($id)
	{
		$this->_update ( "vendor", $id );
	}
}