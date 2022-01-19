<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model
{
	
	public function router_details_listing()
	{
		$this->db->select('*'); 
		$this->db->from('router_details');
		$this->db->where('deleted','0');
		$data = $this->db->get()->result_array();
		return $data;
	}
	

	
}
?>