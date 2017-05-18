<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// item.php Chris Dart Mar 19, 2015 4:53:07 PM chrisdart@cerebratorium.com
class Item extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( "item_model", "item" );
		$this->load->model ( "po_model", "po" );
	}

	function create($po, $po_id)
	{
		$categories = $this->po->get_distinct ( "category" );
		$data ["categories"] = get_keyed_pairs ( $categories, array (
				"category",
				"category" 
		) );
		$data ["item"] = NULL;
		$data ["po"] = $po;
		$data ["po_id"] = $po_id;
		$data ["action"] = "insert";
		$data ["target"] = "item/edit";
		$data ["title"] = sprintf ( "Add Item to PO#%s", $po );
		
		if ($this->input->get ( "ajax" ) == 1) {
			$this->load->view ( "page/modal", $data );
		} else {
			$this->load->view ( "page/index", $data );
		}
	}

	function insert()
	{
		$id = $this->item->insert ();
		$po = $this->item->get ( $id )->po;
		redirect ( "po/view/$po" );
	}

	function edit($id)
	{
		$categories = $this->po->get_distinct ( "category" );
		$data ["categories"] = get_keyed_pairs ( $categories, array (
				"category",
				"category" 
		) );
		$data ["item"] = $this->item->get ( $id );
		$data ["po"] = $data ["item"]->po;
		$data ["po_id"] = $data ["item"]->po_id;
		$data ["action"] = "update";
		$data ["target"] = "item/edit";
		$data ["title"] = sprintf ( "Editing an order item" );
		
		if ($this->input->get ( "ajax" )) {
			$this->load->view ( "page/modal", $data );
		} else {
			$this->load->view ( "page/index", $data );
		}
	}

	function update()
	{
		$id = $this->input->post ( "id" );
		$this->item->update ( $id );
		$po = $this->input->post ( "po" );
		redirect ( "po/view/$po" );
	}

	function delete()
	{
		if ($id = $this->input->post ( "id" )) {
			$item = $this->item->get ( $id );
			$this->item->delete ( $id );
			$data ["target"] = "item/delete";
			$data ["title"] = sprintf ( "Item %s Deleted", $item->description );
			$data ["item"] = $item;
			$this->load->view ( "page/modal", $data );
		}
	}
}