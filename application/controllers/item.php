<?php

defined('BASEPATH') or exit('No direct script access allowed');

// item.php Chris Dart Mar 19, 2015 4:53:07 PM chrisdart@cerebratorium.com
class Item extends MY_Controller
{

    function __construct ()
    {
        parent::__construct();
        $this->load->model("item_model", "item");
        $this->load->model("po_model", "po");
    }

    function create ($po, $po_id)
    {
        $categories = $this->po->get_distinct("category");
        $data["categories"] = get_keyed_pairs($categories, array(
                "category",
                "category"
        ));
        $data["item"] = NULL;
        $data["po"] = $po;
        $data["po_id"] = $po_id;
        $data["action"] = "insert";
        $data["target"] = "item/edit";
        if ($this->input->get("ajax")) {
            $this->load->view($data["target"], $data);
        } else {
            $data["title"] = sprintf("Add Item to PO#%s", $po);
            $this->load->view("page/index", $data);
        }
    }

    function insert(){
        $id = $this->item->insert();
        $po = $this->item->get($id)->po;
        redirect("po/view/$po");
    }
}