<?php

namespace App\Controllers;

use App\Models\CabangModel;

class MasterCabang extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CabangModel();
    }

    public function index()
    {
        $data['cabangs'] = $this->model->orderBy('nama', 'ASC')->findAll();
        return view('master/cabang_index', $data);
    }

    public function create()
    {
        return view('master/cabang_create');
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[master_cabang.nama]',
                'errors' => [
                    'required' => 'Nama cabang wajib diisi.',
                    'is_unique' => 'Nama cabang sudah ada.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert(['nama' => $this->request->getPost('nama')]);
        return redirect()->to('/master/cabang')->with('success', 'Cabang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) return redirect()->to('/master/cabang')->with('error', 'Data tidak ditemukan');

        return view('master/cabang_edit', ['row' => $row]);
    }

    public function update($id)
    {
        // allow same name for current record
        $rules = [
            'nama' => [
                'rules' => "required|is_unique[master_cabang.nama,id,{$id}]",
                'errors' => [
                    'required' => 'Nama cabang wajib diisi.',
                    'is_unique' => 'Nama cabang sudah ada.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, ['nama' => $this->request->getPost('nama')]);
        return redirect()->to('/master/cabang')->with('success', 'Cabang berhasil diupdate');
    }

    public function delete($id)
    {
        $this->model->delete($id); // soft delete if model uses soft deletes
        return redirect()->to('/master/cabang')->with('success', 'Cabang berhasil dihapus');
    }
}
