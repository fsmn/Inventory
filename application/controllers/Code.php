<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Code extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model("code_model","code");
		$this->load->model("variable_model","variable");
	}
	
	function index(){
		$data["target"] = "code/test";
		$data["title"] = "Test";
		$this->load->view("page/index",$data);
	}
	
	function view($id){
		$code = $this->input->get($id);
		
	}
	function create($asset_id){
		$types = $this->variable->get_types("code_type");
		$data["types"] = get_keyed_pairs($types,array("var_key","var_value"),TRUE, TRUE);
		$data["code"] = FALSE;
		$data["asset_id"] = $asset_id;
		$data["title"] = "Create a New Asset Code";
		$data["target"]= "code/edit";
		$data["action"] = "insert";
		if($this->input->get("ajax")){
			$this->load->view("page/modal",$data);
		}elseif($this->input->get("inline")){
			$this->load->view($data["target"],$data);
		}else{
			$this->load->view("page/index",$data);//we're almost never going to use this. 
		}
	}
	
	function edit($id){
		$types = $this->variable->get_types("code_type");
		$data["types"] = get_keyed_pairs($types,array("var_key","var_value"),TRUE, TRUE);
		$data["title"] = "Edit an Asset Code";
		$data["target"]= "code/edit";
		$data["action"] = "update";
		$data["code"]= $this->code->get($id);
		$data["asset_id"] = $data["code"]->asset_id;
		if($this->input->get("ajax")){
			$this->load->view("page/modal",$data);
		}elseif($this->input->get("inline")){
			$this->load->view($data["target"],$data);
		}else{
			$this->load->view("page/index",$data);
		}
		
	}
	
	function insert(){
		if($asset_id = $this->input->post("asset_id")){
			$id = $this->code->insert();
			$data['code'] = $this->code->get($id);
			if($this->input->post("inline")){
				$this->load->view("code/row",$data);
			}else{
				redirect("asset/view/$asset_id");
			}
		}
	}
	
	function update(){
		print_r($this->input->post("id"));
		if($id = $this->input->post("id")){
			$values = array("asset_id"=>$this->input->post("asset_id"),
					"type"=>$this->input->post("type"),
					"value"=>$this->input->post("value"),
			);
			
			$this->code->update($id,$values);
			redirect("asset/view/" . $this->input->post("asset_id"));
		}
	}
	
	function delete($id){
		$asset_id = $this->code->get($id)->asset_id;
		$this->code->delete($id);
		if($this->input->post("ajax")){
			echo TRUE;
		}else{
			redirect("asset/view/$asset_id");
		}
	}
	
}