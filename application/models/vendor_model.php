<?php
defined('BASEPATH') or exit('No direct script access allowed');

// vendor_model.php Chris Dart Mar 9, 2015 4:10:58 PM
// chrisdart@cerebratorium.com
class Vendor_Model extends MY_Model
{
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

    function prepare_variables ()
    {
        $variables = array(
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
        foreach ($variables as $variable) {
            if ($value = $this->input->post($variable)) {
                $this->variable = $value;
            }
        }
        $this->rec_modifier = $this->ion_auth->get_user_id();
    }

    function get ($id)
    {
        return $this->_get("vendor", $id);
    }

    function get_all($type){
        $this->db->from("vendor");
        $this->db->like("type",$type);
        $this->db->order_by("name");
        $result = $this->db->get()->result();
        return $result;
    }
}