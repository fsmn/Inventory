<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Timesheet extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( 'timesheet_model', 'timesheet' );
		$this->load->model ( 'user_model', 'user' );
		$this->load->model ( 'variable_model', 'variable' );
	}

	public function index()
	{
		$options = array (
				'day' => date('Y-m-d'));
		if($this->input->get("show_all")){
			$options = array();
		}
		$entries = $this->timesheet->get_for_user ( '1', $options);
		$data ['entries'] = $entries;
		$data ['target'] = "timesheet/table";
		$data ['title'] = "Time Tracker";
		$this->load->view ( 'page/index', $data );
	}

	public function create($user_id = NULL)
	{
		// @TODO Make sure that unauthorized users cannot see other users' timesheets.
		$user_id || $user_id = $this->ion_auth->get_user_id ();
		$user = $this->user->get_user ( $user_id );
		$data ['user'] = $user;
		$data ['title'] = sprintf ( 'Create a Timesheet entry for %s %s', $user->first_name, $user->last_name );
		$data ['target'] = 'timesheet/edit';
		$categories = $this->variable->get_pairs ( "time_category_$user_id", array (
				"field" => "var_key",
				"direction" => "ASC" 
		) );
		$data ['categories'] = get_keyed_pairs ( $categories, array (
				"var_key",
				"var_value" 
		), TRUE,TRUE );
		$data ['action'] = 'insert';
		$data ['entry'] = NULL;
		if ($this->input->get ( 'ajax' )) {
			$this->load->view ( 'page/modal', $data );
		} else {
			$this->load->view ( 'page/index', $data );
		}
	}
	
	public function insert(){
		 $this->timesheet->insert();
		 redirect("timesheet");
	}
	
	public function edit($id){
		$entry = $this->timesheet->get($id);
		$data['entry'] = $entry;
		$user_id = $entry->user_id;
		$user = $this->user->get_user ( $user_id );
		$data ['user'] = $user;
		$data ['title'] = sprintf ( 'Edit a Timesheet entry for %s %s', $user->first_name, $user->last_name );
		$data ['target'] = 'timesheet/edit';
		$categories = $this->variable->get_pairs ( "time_category_$user_id", array (
				"field" => "var_key",
				"direction" => "ASC"
		) );
		$data ['categories'] = get_keyed_pairs ( $categories, array (
				"var_key",
				"var_value"
		), TRUE,TRUE );
		$data ['action'] = 'update';
		if ($this->input->get ( 'ajax' )) {
			$this->load->view ( 'page/modal', $data );
		} else {
			$this->load->view ( 'page/index', $data );
		}
	}
	
	public function update(){
		$this->timesheet->update($this->input->post("id"));
		redirect("timesheet");
	}
}
