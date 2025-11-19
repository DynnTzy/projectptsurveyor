<?php

namespace App\Controllers;

use App\Models\BagianModel;

class MasterBagian extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BagianModel();
    }

    public function index()
    {
        $data['bagians'] = $this->model->orderBy('nama', 'ASC')->findAll();
        return view('master/bagian_index', $data);
    }

    public function create()
    {
        return view('master/bagian_create');
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[master_bagian.nama]',
                'errors' => [
                    'required' => 'Nama bagian wajib diisi.',
                    'is_unique' => 'Nama bagian sudah ada.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert(['nama' => $this->request->getPost('nama')]);
        return redirect()->to('/master/bagian')->with('success', 'Bagian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) return redirect()->to('/master/bagian')->with('error', 'Data tidak ditemukan');

        return view('master/bagian_edit', ['row' => $row]);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => "required|is_unique[master_bagian.nama,id,{$id}]",
                'errors' => [
                    'required' => 'Nama bagian wajib diisi.',
                    'is_unique' => 'Nama bagian sudah ada.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, ['nama' => $this->request->getPost('nama')]);
        return redirect()->to('/master/bagian')->with('success', 'Bagian berhasil diupdate');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/master/bagian')->with('success', 'Bagian berhasil dihapus');
    }
}
