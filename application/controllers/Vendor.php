<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// vendor.php Chris Dart Mar 24, 2015 3:59:08 PM chrisdart@cerebratorium.com
class Vendor extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( "vendor_model", "vendor" );
	}

	function index()
	{
		$this->load->model ( "asset_model", "asset" );
		$vendors = $this->vendor->get_all ();
		foreach ( $vendors as $vendor ) {
			$vendor->assets = $this->asset->get_for_vendor ( $vendor->id );
		}
		$data ["vendors"] = $vendors;
		$data ["target"] = "vendor/list";
		$data ["title"] = "Vendor List";
		$this->load->view ( "page/index", $data );
	}

	function view($id)
	{
		$vendor = $this->vendor->get ( $id );
		$this->load->model ( "po_model", "po" );
		$this->load->model ( "asset_model", "asset" );
		$this->load->model ( "item_model", "item" );
		
		$vendor->pos = $this->po->get_for_vendor ( $id );
// 		foreach($vendor->pos as $po){
// 			$po->items[] = $this->item->get_by_po($po->id);
// 		}
		$vendor->assets = $this->asset->get_for_vendor ( $id );
		$data ["vendor"] = $vendor;
		$data ["target"] = "vendor/view";
		$data ["title"] = sprintf ( "Viewing %s", $data ["vendor"]->name );
		
		$this->load->view ( "page/index", $data );
	}

	function edit($id)
	{
		$data ["action"] = "update";
		$vendor = $this->vendor->get ( $id );
		$data ["vendor"] = $vendor;
		$data ["title"] = sprintf ( "Editing %s", $vendor->name );
		$data ["target"] = "vendor/edit";
		if ($this->input->get ( "ajax" ) == 1) {
			$this->load->view ( "page/modal", $data );
		} else {
			$this->load->view ( "page/index", $data );
		}
	}

	function update()
	{
		$id = $this->input->post ( "id" );
		$this->vendor->update ( $id );
		redirect ( "vendor/view/$id" );
	}
}