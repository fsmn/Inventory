<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends MY_Controller {

	public function index()
	{
		if ($this->ion_auth->in_group ( 1 )) {
			$data ["body_classes"] = array (
					"is_front" 
			);
			$data ["is_front"] = TRUE;
			$data ["title"] = "Friends School Inventory System";
			$data ["target"] = "dashboard";
			$this->load->view ( 'page/index', $data );
		} else {
			redirect ( "timesheet" );
		}
	}
}
