<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('merk_model');
		$this->breadcrumb_menu['Merk'] = base_url('/merk');
	}

	/**
	 * Show Merk list
	 * @return void
	 */
	public function index()
	{
		$data['breadcrumb'] = $this->render_breadcrumb($this->breadcrumb_menu);
		$sort = strtolower($this->input->get('sort')) == 'desc' ? 'desc' : 'asc';
		$data['merks'] = $this->merk_model->get_all($sort);
		$this->load->view('global/header', $data);
		$this->load->view('merk/list');
		$this->load->view('global/footer');
	}

	/**
	 * [tambah description]
	 * @return [type] [description]
	 */
	public function tambah()
	{
		$this->breadcrumb_menu['Tambah Merk'] = base_url('/merk/tambah');
		$data['breadcrumb'] = $this->render_breadcrumb($this->breadcrumb_menu);
		$this->form_validation->set_rules($this->merk_model->get_rules());

		if($this->form_validation->run())
		{
			$nama = $this->input->post('nama');
			$kode = $this->input->post('kode');
			$inserted = $this->merk_model->insert($nama, $kode);
			if($inserted > 0)
			{
				redirect('merk/?sort=desc');
			}
			else
			{
				$data['error_message'] = 'insert data gagal';
				$view = 'global/error';
			}
		}
		else 
		{
			$view = 'merk/form';
		}

		$this->load->view('global/header', $data);
		$this->load->view($view);
		$this->load->view('global/footer');
	}

	/**
	 * [edit description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function ubah($id)
	{
		$this->breadcrumb_menu['Ubah Merk'] = base_url('/merk/ubah');
		$data['breadcrumb'] = $this->render_breadcrumb($this->breadcrumb_menu);
		$this->form_validation->set_rules($this->merk_model->get_rules());

		if($this->form_validation->run())
		{
			$id = intval($this->input->post('id'));
			$nama = $this->input->post('nama');
			$kode = $this->input->post('kode');
			$updated = $this->merk_model->update($id, $nama, $kode);
			
			if($updated > 0)
			{
				redirect('merk/?sort=desc');
			}
			else
			{
				$data['error_message'] = 'data gagal diupdate';
				$view = 'global/error';
			}
		}
		else
		{
			$data['id'] = $id;
			$data['merk'] = $this->merk_model->get_by_id($id);

			if(count($data['merk']) < 1)
			{
				$data['error_message'] = 'data tidak ditemukan';
				$view = 'global/error';
			}
			else
			{
				$view = 'merk/form';
			}
		}
		
		$this->load->view('global/header', $data);
		$this->load->view($view);
		$this->load->view('global/footer');
	}

	/**
	 * [delete description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function hapus($id)
	{
		$deleted = $this->merk_model->delete($id);

		if($deleted > 0)
		{
			redirect('merk/?sort=desc');
		}
		else
		{
			$data['error_message'] = 'data tidak ditemukan';
			$this->load->view('global/header', $data);
			$this->load->view('global/error');
			$this->load->view('global/footer');
		}
	}
}
