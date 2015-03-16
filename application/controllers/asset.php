<?php
defined('BASEPATH') or exit('No direct script access allowed');

// asset.php Chris Dart Mar 9, 2015 3:24:59 PM chrisdart@cerebratorium.com
class Asset extends MY_Controller
{

    function __construct ()
    {
        parent::__construct();
        $this->load->model("asset_model", "asset");
    }

    function index ()
    {
        $this->load->model("vendor_model", "vendor");
        $vendors = $this->vendor->get_all("developer");
        foreach ($vendors as $vendor) {
            $vendor->assets = $this->asset->get_for_vendor($vendor->id);
        }
        $data["vendors"] = $vendors;
        $data["target"] = "asset/list";
        $data["title"] = "Asset List";
        $this->load->view("page/index", $data);
    }

    function view($asset_id){
echo $asset_id;
    }
}