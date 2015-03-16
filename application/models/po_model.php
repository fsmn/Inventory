<?php
defined('BASEPATH') or exit('No direct script access allowed');

// po_model.php Chris Dart Mar 6, 2015 6:35:01 PM chrisdart@cerebratorium.com
class PO_Model extends MY_Model
{
    var $vendor_id;
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

    function update_variables ()
    {
    }

    function get ($id)
    {
        //$this->_get("po", $id);
        $this->db->from("po");
        $this->db->where("id",$id);
        $this->db->join("vendor","po.vendor_id = vendor.id","LEFT");
        $result = $this->db->get()->result();
        return $result;
    }

    function get_by_po ($po)
    {
        $this->db->where("po", $po);
        $this->db->from("po");
        $result = $this->db->get()->row();
        return $result;
    }

    function update ($id, $values = FALSE)
    {
        $this->_update("po", $id, $values);
    }

    function insert ()
    {
        $this->_insert("po");
    }
}