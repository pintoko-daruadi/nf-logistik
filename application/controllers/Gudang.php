<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('gudang_model');
		$this->breadcrumb_menu['Gudang'] = base_url('/gudang');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$data['breadcrumb'] = $this->render_breadcrumb($this->breadcrumb_menu);
		$sort = strtolower($this->input->get('sort')) == 'desc' ? 'desc' : 'asc';
		$data['gudangs'] = $this->gudang_model->get_all($sort);
		$this->load->view('global/header', $data);
		$this->load->view('gudang/list');
		$this->load->view('global/footer');
	}

	/**
	 * [tambah description]
	 * @return [type] [description]
	 */
	public function tambah()
	{
		$this->breadcrumb_menu['Tambah Gudang'] = base_url('/gudang/tambah');
		$data['breadcrumb'] = $this->render_breadcrumb($this->breadcrumb_menu);
		$this->form_validation->set_rules($this->gudang_model->get_rules());

		if($this->form_validation->run())
		{
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$kode = $this->input->post('kode');
			$inserted = $this->gudang_model->insert($nama, $alamat, $kode);
			if($inserted > 0)
			{
				redirect('gudang/?sort=desc');
			}
			else
			{
				$data['error_message'] = 'insert data gagal';
				$view = 'global/error';
			}
		}
		else 
		{
			$view = 'gudang/form';
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
		$this->breadcrumb_menu['Ubah Gudang'] = base_url('/gudang/ubah');
		$data['breadcrumb'] = $this->render_breadcrumb($this->breadcrumb_menu);
		$this->form_validation->set_rules($this->gudang_model->get_rules());

		if($this->form_validation->run())
		{
			$id = intval($this->input->post('id'));
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$kode = $this->input->post('kode');
			$updated = $this->gudang_model->update($id, $nama, $alamat, $kode);

			if($updated > 0)
			{
				redirect('gudang/?sort=desc');
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
			$data['gudang'] = $this->gudang_model->get_by_id($id);

			if(count($data['gudang']) < 1)
			{
				$data['error_message'] = 'data tidak ditemukan';
				$view = 'global/error';
			}
			else
			{
				$view = 'gudang/form';
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
		$deleted = $this->gudang_model->delete($id);

		if($deleted > 0)
		{
			redirect('gudang/?sort=desc');
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
