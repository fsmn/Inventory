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

    function view ($asset_id)
    {
        $this->load->model("code_model","code");
        $this->load->model("file_model","file");

        $asset = $this->asset->get($asset_id);
        $asset->codes = $this->code->get_for_asset($asset_id);
        $asset->files = $this->file->get_for_asset($asset_id);
        $data["asset"] = $asset;
        $this->load->view("asset/view", $data);
    }

    function create($vendor_id = NULL){

    }
}