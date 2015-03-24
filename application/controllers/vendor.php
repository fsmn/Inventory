<?php
defined('BASEPATH') or exit('No direct script access allowed');

// vendor.php Chris Dart Mar 24, 2015 3:59:08 PM chrisdart@cerebratorium.com
class Vendor extends MY_Controller
{

    function __construct ()
    {
        parent::__construct();
        $this->load->model("vendor_model", "vendor");
    }

    function view ($id)
    {
        $vendor = $this->vendor->get($id);
        $this->load->model("po_model","po");
        $vendor->pos = $this->po->get_for_vendor($id);
        $data["vendor"] = $vendor;
        $data["target"] = "vendor/view";
        $data["title"] = sprintf("Viewing %s", $data["vendor"]->name);

        $this->load->view("page/index", $data);
    }

    function edit ($id)
    {
        $data["action"] = "update";
        $vendor = $this->vendor->get($id);
        $data["vendor"] = $vendor;
        $data["title"] = sprintf("Editing %s", $vendor->name);
        $data["target"] = "vendor/edit";
        if ($this->input->get("ajax") == 1) {
            $this->load->view("page/modal", $data);
        } else {
            $this->load->view("page/index", $data);
        }
    }
}