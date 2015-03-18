<?php
defined('BASEPATH') or exit('No direct script access allowed');

// po_model.php Chris Dart Mar 6, 2015 6:35:01 PM chrisdart@cerebratorium.com
class PO_Model extends MY_Model
{
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

    function prepare_variables ()
    {
        $variables = array(
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
        foreach ($variables as $variable) {
            if ($this->input->post($variable)) {
                $this->$variable = $this->input->post($variable);
            }
        }

        $this->rec_modifier = $this->ion_auth->get_user_id();
    }

    function get ($id)
    {
        // $this->_get("po", $id);
        $this->db->from("po");
        $this->db->where("po.id", $id);
        $this->db->join("vendor", "po.vendor_id = vendor.id", "LEFT");
        $this->db->select("po.*");
        $this->db->select(
                "vendor.name as vendor,vendor.contact,vendor.address,vendor.locality,vendor.url,vendor.phone,vendor.fax,vendor.email,vendor.customer_id");
        $result = $this->db->get()->row();
        return $result;
    }

    function get_by_po ($po)
    {
        $this->db->where("po", $po);
        $this->db->from("po");
        $this->db->select("id");
        $id = $this->db->get()->row()->id;
        return $this->get($id);
    }

    function update ($id, $values = FALSE)
    {
        $this->_update("po", $id, $values);
    }

    function insert ()
    {
        $this->prepare_variables();
        return $this->_insert("po");
        echo $this->db->last_query();
    }

    function get_distinct ($field)
    {
        $this->db->distinct($field);
        $this->db->select($field);
        $this->db->from("po");
        $this->db->order_by($field);
        $result = $this->db->get()->result();
        return $result;
    }
}