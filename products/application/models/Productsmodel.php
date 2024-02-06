<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Productsmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_details()
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->order_by('products.id', 'ASC');
		$res = $this->db->get()->result_array();
		return $res;
	}


	function save_details($data)
	{
		return $this->db->insert('products', $data);
	}


	function get_product_info($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('id', $id);
		$res = $this->db->get()->result_array();
		return $res;
	}


	function update_details($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('products', $data);
	}


	function delete_details($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('products');
	}
}
