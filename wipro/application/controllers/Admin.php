<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Common_model');
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->helper('file');
		$this->load->helper(array('form'));	
	}


	public function index()
	{
		$data['record'] = $this->Common_model->router_details_listing();
		$this->load->view('index',$data);
	}
	
	public function add_router_details()
	{
		$this->form_validation->set_rules('hostname', 'Host Name', 'trim|required|is_unique[router_details.hostname]'); 
	    $this->form_validation->set_rules('loopback', 'Loopback', 'trim|required|is_unique[router_details.loopback]|valid_ip'); 
	    $this->form_validation->set_rules('mac_address', 'MAC Address', 'trim|required|is_unique[router_details.mac_address]|exact_length[17]'); 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			//$this->index();
			$errors = validation_errors();
            echo json_encode(['error'=>$errors]);
		}
		else
		{ 	
			$data['hostname'] = $this->input->post('hostname');
			$data['loopback'] = $this->input->post('loopback');
			$data['mac_address'] = $this->input->post('mac_address');
			$data['created_dt'] = date('Y-m-d H:i:s');
			$data['updated_dt'] = date('Y-m-d H:i:s');
			$this->db->insert('router_details',$data);
			echo 1;
		}
	}
	
	public function delete_router()
	{
		$sapid = $this->input->post('sapid');
		$data['deleted'] = '1';
		$data['updated_dt'] = date('Y-m-d H:i:s');
		$this->db->where('sapid',$sapid);
		$this->db->update('router_details',$data);
		return $this->db->affected_rows();
	} 
	
	public function edit_router()
	{
		$sapid = $this->input->post('sapid');		
		$result = $this->db->get_where("router_details", array('sapid' => $sapid))->result_array();
		echo json_encode($result);		               
	} 

	public function update_router_details()
	{
		$this->form_validation->set_rules('hostname', 'Host Name', 'trim|required'); 
	    $this->form_validation->set_rules('loopback', 'Loopback', 'trim|required|valid_ip'); 
	    $this->form_validation->set_rules('mac_address', 'MAC Address', 'trim|required|exact_length[17]'); 
		
		if ($this->form_validation->run() == FALSE)
		{ 
			$errors = validation_errors();
            echo json_encode(['error'=>$errors]);
		}
		else
		{ 	
			$sapid = $this->input->post('sapid');
			$data['hostname'] = $this->input->post('hostname');
			$data['loopback'] = $this->input->post('loopback');
			$data['mac_address'] = $this->input->post('mac_address');
			$data['updated_dt'] = date('Y-m-d H:i:s');
			$this->db->where('sapid',$sapid);
			$this->db->update('router_details',$data);
			echo 1;
		}
	}
	
	
}
?>