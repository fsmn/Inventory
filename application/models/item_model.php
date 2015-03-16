<?php

defined('BASEPATH') or exit('No direct script access allowed');

// item_model.php Chris Dart Mar 6, 2015 7:17:15 PM chrisdart@cerebratorium.com
class Item_Model extends MY_Model
{

    function get_by_po ($po_id)
    {
        $this->db->from("item");
        $this->db->where("po_id", $po_id);
        $result = $this->db->get()->result();
        return $result;
    }
}