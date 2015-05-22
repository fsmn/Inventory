<?php
class File extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( 'file_model' );
		$this->load->helper ( 'general_helper' );
		$this->load->helper ( 'file' );
	}

	function index()
	{
		$this->load->view ( 'upload_form', array (
				'error' => ' ' 
		) );
	}

	function view()
	{
		$id = $this->input->post ( 'id' );
		$data ['file'] = $this->file_model->fetch_file ( $id );
		$this->load->view ( 'file/view', $data );
	}

	function create($asset_id)
	{
		$data ['asset_id'] = $asset_id;
		$data ['action'] = "attach";
		$data ['target'] = "file/edit";
		$data ['title'] = "Attach a file";
		$data ['file'] = array ();
		if ($this->input->get ( "ajax" )) {
			$this->load->view ( 'page/modal', $data );
		} elseif ($this->input->get ( "inline" )) {
			$this->load->view ( 'file/edit', $data );
		} else {
			$this->load->view ( 'page/index', $data );
		}
	}

	function edit()
	{
		if ($id = $this->input->post ( 'id' )) {
			$data ['id'] = $id;
			$file = $this->file_model->fetch_file ( $id );
			$data ['file'] = $file;
			$data ['error'] = '';
			$data ['asset_id'] = $file->asset_id;
			$this->load->view ( 'barf', $data );
		}
	}

	function delete()
	{
		if ($id = $this->input->post ( 'id' )) {
			$this->file_model->delete_file ( $id );
		}
	}

	function attach()
	{
		$config ['upload_path'] = './uploads';
		$config ['allowed_types'] = 'gif|jpg|png|pdf|rtf|docx|doc|xlsx|xls';
		$config ['max_size'] = '1000';
		$asset_id = $this->input->post ( 'asset_id' );
		$this->load->library ( 'upload', $config );
		if (! $this->upload->do_upload ()) {
			$this->session->set_flashdata ( "danger", $this->upload->display_errors () );
		} else {
			$file_data = $this->upload->data ();
			$data ['filename'] = $file_data ['file_name'];
			$data ['description'] = $this->input->post ( 'description' );
			$data ['asset_id'] = $asset_id;
			$id = $this->file_model->insert ( $data );
		}
		redirect ( "asset/view/$asset_id" );
	}
}
?>