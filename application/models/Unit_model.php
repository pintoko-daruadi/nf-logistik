<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {
	const MAX_NAME_LENGTH = 100;

	public function get_rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'required|min_length[3]|max_length['.self::MAX_NAME_LENGTH.']',
			]
		];
	}

	public function get_by_id($id)
	{
		$query = $this->db->where('id', intval($id))->get('unit');
		return $query->result();
	}

	public function get_all($sort)
	{
		$query = $this->db->order_by('id', $sort)->get('unit');
		return $query->result();
	}

	public function insert($name)
	{
		$data = [
			'nama' => $name,
		];

		$this->db->insert('unit', $data);

		return $this->db->affected_rows();
	}

	public function delete($id='')
	{
		$data = [
			'id' => intval($id),
		];
		
		$this->db->delete('unit', $data);

		return $this->db->affected_rows();
	}

	public function update($id, $name)
	{
		$this->db->set('nama', $name);
		$this->db->where('id', intval($id));
		$this->db->update('unit');

		return $this->db->affected_rows();
	}

	public function get_list_dropdown()
	{
		$result = $this->db->get('unit')->result();
		$data = [];
		foreach($result as $key => $value)
		{
			$data[$value->id] = $value->nama;
		}

		return $data;
	}
}