<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// asset.php Chris Dart Mar 9, 2015 3:24:59 PM chrisdart@cerebratorium.com
class Asset extends MY_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "asset_model", "asset" );
	}
	function index() {
		redirect("vendor");
	}
	function view($asset_id) {
		$this->load->model ( "code_model", "code" );
		$this->load->model ( "file_model", "file" );
		
		$asset = $this->asset->get ( $asset_id );
		$asset->codes = $this->code->get_for_asset ( $asset_id );
		$asset->files = $this->file->get_for_asset ( $asset_id );
		$data ["asset"] = $asset;
		$this->load->view ( "asset/view", $data );
	}
	function create($vendor_id = NULL) {
		$data ["asset"] = NULL;
		$data ["action"] = "insert";
		$data ["vendor_id"] = $vendor_id;
		$data ["target"] = "asset/edit";
		$data ["title"] = "Create an Asset";
		$data ["types"] = array (
				"Hardware" => "Hardware",
				"Software" => "Software",
				"Website" => "Website" 
		);
		$statuses = $this->asset->get_distinct ( "status" );
		$data ["statuses"] = get_keyed_pairs ( $statuses, array (
				"status",
				"status" 
		), TRUE );
		$this->load->model ( "vendor_model", "vendor" );
		
		$developers = $this->vendor->get_all ( "developer" );
		$data ["developers"] = get_keyed_pairs ( $developers, array (
				"id",
				"name" 
		) );
		
		if ($this->input->get ( "ajax" ) == 1) {
			$this->load->view ( "page/modal", $data );
		}
	}
	function insert() {
		$id = $this->asset->insert ();
		redirect ( "asset/view/$id" );
	}
}