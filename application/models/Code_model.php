<?php

class Code_model extends MY_Model{

	var $type;
	var $value;
	var $asset_id;

	function __construct()
	{
		parent::__construct();
	}

	function prepare_variables()
	{

	    $variables = array("type","value","asset_id");
	    //get the types of available code. 
	    $this->load->model("variable_model","variable");
	    $types = $this->variable->get_types("code_type");
	    
	    foreach($variables as $variable){
	        if($this->input->post($variable)){
	        	if($variable == "type" && !in_array($variable,$types)){
	        		$this->type = $this->variable->insert("code_type",$this->input->post($variable));
	        	}else{
	            	$this->$variable = $this->input->post($variable);
	        	}
	        }
	    }

	}

	function insert()
	{
		$this->prepare_variables();
		return $this->_insert("code");
	}

	function update($id,$values = NULL)
	{
		$this->_update("code", $id, $values);

	}

	function delete($id)
	{
	   return $this->_delete("code", $id);
	}

	function delete_for_asset( $asset_id )
	{
		$id_array = array('asset_id' => $asset_id );
		$this->db->delete('code', $id_array);
	}

	function get_for_asset($asset_id)
	{
		$this->db->where('asset_id', $asset_id);
		$this->db->from('code');
		$this->db->join('variable','code.type = variable.var_key');
		$this->db->select('code.*');
		$this->db->select('variable.var_value');
		$this->db->order_by('type');
		$result = $this->db->get()->result();
		return $result;
	}

	function get($id)
	{

	    return $this->_get("code",$id);
	}

}