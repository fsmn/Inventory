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

	function create($entity_type,$id)
	{
		$data ['entity_id'] = $id;
		$data ['action'] = "attach";
		$data['entity_type'] = $entity_type;//the entity/table to which this file should be attached
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
			$data['entity_type'] = $file->entity_type;
			$data ['entity_id'] = $file->entity_id;
			$this->load->view ( 'barf', $data );
		}
	}

	function delete()
	{
		if ($id = $this->input->post ( 'id' )) {
			$this->file_model->delete_file ( $id );
		}
	}

	/**
	 *
	 * @param int $entity
	 */
	function attach($entity_type)
	{
		$config ['upload_path'] = './uploads';
		$config ['allowed_types'] = 'gif|jpg|png|pdf|rtf|docx|doc|xlsx|xls';
		$config ['max_size'] = '1000';
		$entity_id = $this->input->post ( 'entity_id' );
		$this->load->library ( 'upload', $config );
		if (! $this->upload->do_upload ()) {
			$this->session->set_flashdata ( "danger", $this->upload->display_errors () );
		} else {
			$file_data = $this->upload->data ();
			$data ['filename'] = $file_data ['file_name'];
			$data['entity_type'] = $entity_type;
			$data ['description'] = $this->input->post ( 'description' );
			$data ['entity_id'] = $entity_id;
			$id = $this->file_model->insert ( $data );
		}
		if($entity_type == "po"){
			$this->load->model("po_model","po");
			$entity_id = $this->po->get($entity_id)->po;
		}
		redirect ( "$entity_type/view/$entity_id" );
	}
}
?>