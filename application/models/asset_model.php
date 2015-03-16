<?php
defined('BASEPATH') or exit('No direct script access allowed');

// asset_model.php Chris Dart Mar 9, 2015 3:26:08 PM chrisdart@cerebratorium.com
class Asset_model extends MY_Model
{

    var $developer_id;
    var $po;
    var $product;
    var $name;
    var $version;
    var $type;
    var $serial_number;
    var $status;
    var $source;
    var $year_acquired;
    var $year_removed;
    var $rec_modifier;
    var $rec_modified;

    function prepare_variables(){
        $variables = array("developer_id","po","product","name","version","type","serial_number","status","source","year_acquired","year_removed");

        foreach($variables as $variable){
            if($value = $this->input->post($variable)){
                $this->$variable = $value;
            }
        }

        $this->rec_modifier = $this->ion_auth->get_user_id();

    }

    function get ($id)
    {
        $this->db->from("asset");
        $this->db->where("id", $id);
        $this->db->join("vendor", "vendor.id=asset.vendor_id");
        $this->db->select("asset.*");
        $this->db->select("vendor.name vendor, vendor.type vendor_type,vendor.contact,vendor.address,vendor.locality,vendor.url,vendor.phone,vendor.fax,vendor.email,vendor.customer_id");
        $result = $this->db->get()->result();
        return $result;
    }

    function get_for_vendor($vendor_id){
        $this->db->from("asset");
        $this->db->where("vendor_id",$vendor_id);
        $this->db->order_by("asset.name");
        $result = $this->db->get()->result();
        return $result;
    }
}