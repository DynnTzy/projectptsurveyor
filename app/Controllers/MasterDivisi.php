<?php

namespace App\Controllers;

use App\Models\DivisiModel;

class MasterDivisi extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new DivisiModel();
    }

    public function index()
    {
        $data['divisis'] = $this->model->orderBy('nama', 'ASC')->findAll();
        return view('master/divisi_index', $data);
    }

    public function create()
    {
        return view('master/divisi_create');
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|is_unique[master_divisi.nama]',
                'errors' => [
                    'required' => 'Nama divisi wajib diisi.',
                    'is_unique' => 'Nama divisi sudah ada.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert(['nama' => $this->request->getPost('nama')]);
        return redirect()->to('/master/divisi')->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) return redirect()->to('/master/divisi')->with('error', 'Data tidak ditemukan');

        return view('master/divisi_edit', ['row' => $row]);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => "required|is_unique[master_divisi.nama,id,{$id}]",
                'errors' => [
                    'required' => 'Nama divisi wajib diisi.',
                    'is_unique' => 'Nama divisi sudah ada.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, ['nama' => $this->request->getPost('nama')]);
        return redirect()->to('/master/divisi')->with('success', 'Divisi berhasil diupdate');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/master/divisi')->with('success', 'Divisi berhasil dihapus');
    }
}
