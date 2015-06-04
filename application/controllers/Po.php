<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// po.php Chris Dart Mar 6, 2015 7:12:38 PM chrisdart@cerebratorium.com
class PO extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( "po_model", "po" );
		$this->load->model ( "item_model", "item" );
	}

	function index()
	{
		$this->search ();
	}

	function search()
	{
		$this->load->model ( "vendor_model", "vendor" );
		$vendors = $this->vendor->get_all ( "vendor" );
		$data ["vendors"] = get_keyed_pairs ( $vendors, array (
				"id",
				"name" 
		), TRUE );
		$methods = $this->po->get_distinct ( "method" );
		$data ["methods"] = get_keyed_pairs ( $methods, array (
				"method",
				"method" 
		) );
		$payment_types = $this->po->get_distinct ( "payment_type" );
		$data ["payment_types"] = get_keyed_pairs ( $payment_types, array (
				"payment_type",
				"payment_type" 
		) );
		$categories = $this->po->get_distinct ( "category" );
		$data ["categories"] = get_keyed_pairs ( $categories, array (
				"category",
				"category" 
		) );
		$users = $this->ion_auth->users ()->result ();
		$data ["users"] = get_keyed_pairs ( $users, array (
				"id",
				"first_name" 
		), TRUE );
		$data ["target"] = "po/search";
		$data ["title"] = "Search Purchase Orders";
		$data ["po"] = FALSE;
		$variables = array (
				"vendor_id",
				"po",
				"method",
				"po_date",
				"payment_type",
				"category",
				"orderer_id",
				"billing_contact",
				"description",
				"sku",
				"quote" 
		);
		
		$where = NULL;
		foreach ( $variables as $variable ) {
			if ($my_variable = $this->input->get ( $variable )) {
				$where [$variable] = $my_variable;
				bake_cookie ( $variable, $my_variable );
			} else {
				burn_cookie ( $variable, $my_variable );
			}
		}
		$date_range = array ();
		if ($start_date = $this->input->get ( "start_date" )) {
			$date_range ["start_date"] = $start_date;
		}
		if ($end_date = $this->input->get ( "end_date" )) {
			$date_range ["end_date"] = $end_date;
		}
		$data ["refine"] = FALSE;
		$pos = array ();
		if ($this->input->get ( "is_search" )) { // active search has been submitted
			
			$pos = $this->po->search ( $where, $date_range );
			$this->load->model ( "item_model", "item" );
			foreach ( $pos as $po ) {
				$po->items = $this->item->get_for_po ( $po->id );
			}
			$data ["refine"] = TRUE;
		}
		$data ['pos'] = NULL;
		if (count ( $pos ) > 0) {
			$data ['pos'] = $pos;
		}
		
		if ($this->input->get ( "ajax" ) == 1) {
			$this->load->view ( "page/modal", $data );
		} else {
			$this->load->view ( "page/index", $data );
		}
	}

	function view($po)
	{
		$order = $this->po->get_by_po ( $po );
		if ($order) {
			$order->items = $this->item->get_for_po ( $order->id );
			$data ["order"] = $order;
			if ($this->input->get ( "print" ) == 1) {
				$data ["target"] = "po/print";
			} else {
				$data ["target"] = "po/view";
			}
			$this->load->model ( "asset_model", "asset" );
			$data ["assets"] = $this->asset->get_by_po ( $po );
			$data ["title"] = "FSMN PO# $po";
			$this->load->view ( "page/index", $data );
		} else {
			show_error ( "No such page" );
		}
	}

	function create($vendor_id = FALSE)
	{
		$this->load->model ( "vendor_model", "vendor" );
		$vendors = $this->vendor->get_all ("vendor");
		$data ["vendors"] = get_keyed_pairs ( $vendors, array (
				"id",
				"name" 
		) );
		$methods = $this->po->get_distinct ( "method" );
		$data ["methods"] = get_keyed_pairs ( $methods, array (
				"method",
				"method" 
		) );
		$payment_types = $this->po->get_distinct ( "payment_type" );
		$data ["payment_types"] = get_keyed_pairs ( $payment_types, array (
				"payment_type",
				"payment_type" 
		) );
		$categories = $this->po->get_distinct ( "category" );
		$data ["categories"] = get_keyed_pairs ( $categories, array (
				"category",
				"category" 
		) );
		$data ["target"] = "po/edit";
		$data ["action"] = "insert";
		$data ["title"] = "Create a Purchase Order";
		$data ["po"] = FALSE;
		$data ["vendor_id"] = $vendor_id;
		
		if ($this->input->get ( "ajax" ) == 1) {
			$this->load->view ( "page/modal", $data );
		} else {
			$this->load->view ( "page/index", $data );
		}
	}

	function insert()
	{
		$id = $this->po->insert ();
		$po = $this->po->get ( $id )->po;
		
		redirect ( "po/view/$po" );
	}

	function edit($id)
	{
		$this->load->model ( "vendor_model", "vendor" );
		$vendors = $this->vendor->get_all ( "vendor" );
		$data ["vendors"] = get_keyed_pairs ( $vendors, array (
				"id",
				"name" 
		) );
		$methods = $this->po->get_distinct ( "method" );
		$data ["methods"] = get_keyed_pairs ( $methods, array (
				"method",
				"method" 
		) );
		$payment_types = $this->po->get_distinct ( "payment_type" );
		$data ["payment_types"] = get_keyed_pairs ( $payment_types, array (
				"payment_type",
				"payment_type" 
		) );
		$categories = $this->po->get_distinct ( "category" );
		$data ["categories"] = get_keyed_pairs ( $categories, array (
				"category",
				"category" 
		) );
		$order = $this->po->get ( $id );
		$data ["po"] = $order;
		
		$data ["target"] = "po/edit";
		$data ["title"] = sprintf ( "Editing PO #%s", $order->po );
		$data ["action"] = "update";
		$data ["vendor_id"] = NULL;
		if ($this->input->get ( "ajax" ) == 1) {
			$this->load->view ( "page/modal", $data );
		} else {
			$this->load->view ( "page/index", $data );
		}
	}

	function update()
	{
		$id = $this->input->post("id");
		$this->po->update ($id);
		$po = $this->po->get ( $this->input->post ( "id" ) )->po;
		redirect ( "po/view/$po" );
	}
	
	function update_value()
	{
		$id = $this->input->post ( "id" );
		$value = $this->input->post ( "value" );
		if (is_array ( $value )) {
			$value = implode ( ",", $value );
		}
		$values = array (
				$this->input->post ( "field" ) => $value
		);
		$this->po->update ( $id, $values );
		echo $value;
	}
	
	function request_approval($id = FALSE){
		$this->load->model("user_model","user");
		$approvers = $this->user->get_group_members(4);
		//approvers cannot approve their own POs.
		foreach($approvers as $key=>$approver){
			if($approver->id == $this->ion_auth->get_user_id()){
				unset($approvers[$key]);
			}
		}
		if($id){
			$data["target"] = "po/approval";
			$data["title"] = "Request Approval";
			$data["id"] = $id;
			$data['approvers'] = get_keyed_pairs($approvers, array("id","user"));
			if($this->input->get("ajax")){
				$this->load->view("page/modal",$data);
			}else{
				$this->load->view("page/index",$data);
			}
		}elseif($id = $this->input->post("id")){
				$approver_id = $this->input->post("approver_id");
				$this->po->update($id,array("approver_id"=>$approver_id));
				$po = $this->po->get($id);
				$this->_notify("approval_request",$po);
				$this->session->set_flashdata("warning",sprintf("The approval request has been sent to %s at %s",$po->approver,  $po->approver_email));
				redirect("po/view/$po->po");
		}
		
	}
	
	function grant_approval($id){
		$po = $this->po->get($id);
		//user must be an approver and they must be the requested approver on this PO. 
		if($this->ion_auth->get_user_id() == $po->approver_id && $this->ion_auth->in_group(4) ){
			$this->po->update($id,array("approved"=>1));
			$this->_notify("approval_granted",$po);
			$this->_notify("business_office",$po);
			$this->session->set_flashdata("warning","This PO has been approved and the requester and business office have both been notified");
		}else{
			$this->session->set_flashdata("warning","You are not authorized to approve this purchase order.");
		}
		redirect("po/view/$po->po");
		
	}

	function po_exists($po)
	{
		if ($this->po->get_by_po ( $po )) {
			$output = TRUE;
		} else {
			$output = FALSE;
		}
		echo $output;
	}
	
	function _notify($target,$po){
		switch($target){
			case "business_office":
				$this->email->to("bookkeeper@fsmn.org");
				$this->email->from($po->user_email);
				$subject = "A Purchase Order Has Been Approved";
				break;
			case "approval_request":
				$subject = "A Purchase Order Needs Your Approval";
				$this->email->from(sprintf("%s %s <%s>",$po->first_name, $po->last_name, $po->user_email));
				$this->email->to($po->approver);
				$this->email->cc($po->user_email);
				
				break;
			case "approval_granted":
				$subject = sprintf("Purchase Order %s Approval Has Been Granted.",$po->po);
				$this->email->from($po->approver_email);
				$this->email->to($po->user_email);
				$this->email->cc($po->approver_email);
				break;
		}
		$message = $this->load->view("po/email/$target",array("po"=>$po), TRUE);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		
	}

	function delete()
	{
		if ($id = $this->input->post ( "id" )) {
			
			$po = $this->po->get ( $id );
			$this->po->delete ( $id );
			$data ["target"] = "po/delete";
			$data ["title"] = "PO $po->po Deleted";
			$data ["po"] = $po;
			$this->load->view ( "page/modal", $data );
		}
		
		
	}
}