<?php
defined('BASEPATH') or exit('No direct script access allowed');

// po.php Chris Dart Mar 6, 2015 7:12:38 PM chrisdart@cerebratorium.com
class PO extends MY_Controller
{

    function __construct ()
    {
        parent::__construct();
        $this->load->model("po_model", "po");
        $this->load->model("item_model", "item");
    }

    function index ()
    {
    }

    function view ($po)
    {
        $order = $this->po->get_by_po($po);
        $order->items = $this->item->get_by_po($order->id);
        $data["order"] = $order;
        if ($this->input->get("print") == 1) {
            $data["target"] = "po/print";
        } else {
            $data["target"] = "po/view";
        }
        $data["title"] = "FSMN PO# $po";
        $this->load->view("page/index", $data);
    }

    function create ($vendor_id = FALSE)
    {
        $this->load->model("vendor_model", "vendor");
        $vendors = $this->vendor->get_all();
        $data["vendors"] = get_keyed_pairs($vendors, array(
                "id",
                "name"
        ));
        $methods = $this->po->get_distinct("method");
        $data["methods"] = get_keyed_pairs($methods, array(
                "method",
                "method"
        ));
        $payment_types = $this->po->get_distinct("payment_type");
        $data["payment_types"] = get_keyed_pairs($payment_types, array(
                "payment_type",
                "payment_type"
        ));
        $categories = $this->po->get_distinct("category");
        $data["categories"] = get_keyed_pairs($categories, array(
                "category",
                "category"
        ));
        $data["target"] = "po/edit";
        $data["action"] = "insert";
        $data["title"] = "Create a Purchase Order";
        $data["po"] = FALSE;
        $data["vendor_id"] = $vendor_id;

        if ($this->input->get("ajax") == 1) {
            $this->load->view("page/modal", $data);
        } else {
            $this->load->view("page/index", $data);
        }
    }

    function insert ()
    {
        $id = $this->po->insert();
        $po = $this->po->get($id)->po;

        redirect("po/view/$po");
    }

    function edit ($id)
    {
        $this->load->model("vendor_model", "vendor");
        $vendors = $this->vendor->get_all("vendor");
        $data["vendors"] = get_keyed_pairs($vendors, array(
                "id",
                "name"
        ));
        $methods = $this->po->get_distinct("method");
        $data["methods"] = get_keyed_pairs($methods, array(
                "method",
                "method"
        ));
        $payment_types = $this->po->get_distinct("payment_type");
        $data["payment_types"] = get_keyed_pairs($payment_types, array(
                "payment_type",
                "payment_type"
        ));
        $categories = $this->po->get_distinct("category");
        $data["categories"] = get_keyed_pairs($categories, array(
                "category",
                "category"
        ));
        $order = $this->po->get($id);
        $data["po"] = $order;

        $data["target"] = "po/edit";
        $data["title"] = sprintf("Editing PO #%s", $order->po);
        $data["action"] = "update";
        $data["vendor_id"] = NULL;
        if ($this->input->get("ajax") == 1) {
            $this->load->view("page/modal", $data);
        } else {
            $this->load->view("page/index", $data);
        }
    }

    function update ()
    {
        $this->po->update();
        $po = $this->po->get($this->input->post("id"))->po;
        redirect("po/view/$po");
    }

    function delete ()
    {
        if ($id = $this->input->post("id")) {

            $po = $this->po->get($id);
            $this->po->delete($id);
            $data["target"] = "po/delete";
            $data["title"] = "PO $po->po Deleted";
            $data["po"] = $po;
            $this->load->view("page/modal",$data);
        }
    }
}