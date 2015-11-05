<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Timesheet extends MY_Controller
	{

		function __construct ()
		{
			parent::__construct ();
			$this->load->model ( 'timesheet_model', 'timesheet' );
			$this->load->model ( 'user_model', 'user' );
			$this->load->model ( 'variable_model', 'variable' );
		}

		public function index ()
		{
			$options = array (
					'day' => date ( 'Y-m-d' ) 
			);
			if ($this->input->get ( "show_all" )) {
				$options = array ();
			}
			$entries = $this->timesheet->get_for_user ( $this->ion_auth->get_user_id (), $options );
			$data ['entries'] = $entries;
			$data ['target'] = "timesheet/table";
			$data ['title'] = "Time Tracker";
			$this->load->view ( 'page/index', $data );
		}

		public function search (  )
		{
			if ($this->input->get ( "is_search" )) {
				$user_id = $this->input->get("user_id") || $user_id = $this->ion_auth->get_user_id ();
				$fields = array (
						"start_day",
						"end_day",
						"category" 
				);
				$options = array ();
				
				foreach ( $fields as $field ) {
					if ($value = $this->input->get ( $field )) {
						$options [$field] = $value;
					}
				}
				$user = $this->user->get_user ( $user_id );
				$data ['entries'] = $this->timesheet->get_for_user ( $user_id, $options );
				$data ['target'] = "timesheet/table";
				$data ['title'] = "Time Search Results for $user->first_name $user->last_name";
				$this->load->view ( 'page/index', $data );
				
			}
			else {
				$user_id = $this->ion_auth->get_user_id ();
				$data ['user_id'] = $user_id;
				// @TODO allow administrators to search other users' timesheet entries
				$users = array();
				if($this->ion_auth->is_admin()){
					
					$users = $this->ion_auth->users ()->result ();
				
				}
				$data['users'] = get_keyed_pairs($users, array("user_id","first_name"));
				$categories = $this->variable->get_pairs ( "time_category_$user_id", array (
						"field" => "var_key",
						"direction" => "ASC" 
				) );
				$data ['categories'] = get_keyed_pairs ( $categories, array (
						"var_key",
						"var_value" 
				), TRUE, TRUE );
				$data ['target'] = "timesheet/search";
				$data ['title'] = "Search for Timesheet Entries";
				if ($this->input->get ( "ajax" )) {
					$this->load->view ( 'page/modal', $data );
				}
				else {
					$this->load->view ( 'page/index', $data );
				}
			}
		}

		public function create ( $user_id = NULL )
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
			), TRUE, TRUE );
			$data ['action'] = 'insert';
			$data ['entry'] = NULL;
			if ($this->input->get ( 'ajax' )) {
				$this->load->view ( 'page/modal', $data );
			}
			else {
				$this->load->view ( 'page/index', $data );
			}
		}

		public function insert ()
		{
			$this->timesheet->insert ();
			redirect ( "timesheet" );
		}

		public function edit ( $id )
		{
			$entry = $this->timesheet->get ( $id );
			$data ['entry'] = $entry;
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
			), TRUE, TRUE );
			$data ['action'] = 'update';
			if ($this->input->get ( 'ajax' )) {
				$this->load->view ( 'page/modal', $data );
			}
			else {
				$this->load->view ( 'page/index', $data );
			}
		}

		public function update ()
		{
			$this->timesheet->update ( $this->input->post ( "id" ) );
			redirect ( "timesheet" );
		}
	}
