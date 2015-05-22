<?php
class File_model extends MY_Model {
	var $asset_id = '';
	var $filename = '';
	var $description = '';

	function __construct()
	{
		parent::__construct ();
	}

	function prepare_variables()
	{
		$variables = array (
				"asset_id",
				"filename",
				"description" 
		);
		foreach ( $variables as $variable ) {
			if ($this->input->post ( $variable )) {
				$this->$variable = $this->input->post ( $variable );
			}
		}
	}

	function insert($data)
	{
		$this->db->insert ( "file", $data );
	}

	function get($id)
	{
		return $this->_get ( "file", $id );
	}

	function get_for_asset($asset_id)
	{
		$this->db->where ( 'asset_id', $asset_id );
		$this->db->from ( 'file' );
		$this->db->order_by ( 'filename' );
		$result = $this->db->get ()->result ();
		return $result;
	}

	function delete_file($id)
	{
		$file = $this->get ( $id );
		$this->load->helper("directory");
		$file_path = dirname ( "./uploads/$file->filename");
		unlink ( $file_path );
		$this->_delete ( "file", $id );
	}
}