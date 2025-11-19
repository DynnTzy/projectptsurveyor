<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\CabangModel;
use App\Models\DivisiModel;
use App\Models\BagianModel;

class EmployeeController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new EmployeeModel();
    }

    // ===============================
    // LIST + SEARCH
    // ===============================
    public function index()
    {
        $perPage = 10; // jumlah data per halaman
        $q = $this->request->getGet('q');

        // ambil nomor halaman sekarang (CI default: ?page=2)
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // hitung offset nomor baris
        $start = ($page - 1) * $perPage;

        if ($q) {
            $employees = $this->model
                ->like('name', $q)
                ->orLike('nik', $q)
                ->orLike('cabang', $q)
                ->orLike('divisi', $q)
                ->orLike('bagian', $q)
                ->paginate($perPage);
        } else {
            $employees = $this->model->paginate($perPage);
        }

        return view('employees/index', [
            'employees' => $employees,
            'pager'     => $this->model->pager,
            'q'         => $q,
            'start'     => $start,  // KIRIM START KE VIEW
            'perPage'   => $perPage,
        ]);
    }


    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        // ambil data master (hanya yg tidak di-soft-delete)
        $cabangModel = new CabangModel();
        $divisiModel = new DivisiModel();
        $bagianModel = new BagianModel();

        $cabang = $cabangModel->orderBy('nama', 'ASC')->findAll();
        $divisi = $divisiModel->orderBy('nama', 'ASC')->findAll();
        $bagian = $bagianModel->orderBy('nama', 'ASC')->findAll();

        return view('employees/create', [
            'cabang' => $cabang,
            'divisi' => $divisi,
            'bagian' => $bagian,
        ]);
    }

    public function store()
    {
        $rules = [
            'nik' => [
                'rules' => 'required|numeric|min_length[8]|max_length[20]|is_unique[employees.nik]',
                'errors' => [
                    'required' => 'NIK wajib diisi.',
                    'numeric' => 'NIK harus berupa angka.',
                    'min_length' => 'NIK minimal 8 digit.',
                    'max_length' => 'NIK maksimal 20 digit.',
                    'is_unique' => 'NIK sudah terdaftar.'
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal 2 karakter.',
                    'max_length' => 'Nama maksimal 100 karakter.',
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Format email tidak valid.'
                ]
            ],
            'phone' => [
                'rules' => 'permit_empty|numeric|min_length[10]|max_length[14]',
                'errors' => [
                    'numeric' => 'No Handphone harus angka.',
                    'min_length' => 'No Handphone minimal 10 digit.',
                    'max_length' => 'No Handphone maksimal 14 digit.',
                ]
            ],
            'cabang' => [
                'rules' => 'required',
                'errors' => ['required' => 'Cabang wajib diisi.']
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => ['required' => 'Divisi wajib diisi.']
            ],
            'bagian' => [
                'rules' => 'required',
                'errors' => ['required' => 'Bagian wajib diisi.']
            ],
            'tentang' => [
                'rules' => 'permit_empty|max_length[1000]',
                'errors' => ['max_length' => 'Tentang pegawai maksimal 1000 karakter.']
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost([
            'nik',
            'name',
            'email',
            'phone',
            'cabang',
            'divisi',
            'bagian',
            'tentang',
        ]);

        $this->model->insert($data);

        return redirect()->to('/employees')->with('success', 'Data berhasil ditambahkan');
    }


    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        $employee = $this->model->find($id);
        if (! $employee) return redirect()->to('/employees');

        // ambil data master
        $cabangModel = new CabangModel();
        $divisiModel = new DivisiModel();
        $bagianModel = new BagianModel();

        $cabang = $cabangModel->orderBy('nama', 'ASC')->findAll();
        $divisi = $divisiModel->orderBy('nama', 'ASC')->findAll();
        $bagian = $bagianModel->orderBy('nama', 'ASC')->findAll();

        return view('employees/edit', [
            'employee' => $employee,
            'cabang'   => $cabang,
            'divisi'   => $divisi,
            'bagian'   => $bagian,
        ]);
    }

    public function update($id)
    {
        $rules = [
            'nik' => [
                'rules' => "required|numeric|min_length[8]|max_length[20]|is_unique[employees.nik,id,{$id}]",
                'errors' => [
                    'required' => 'NIK wajib diisi.',
                    'numeric' => 'NIK harus berupa angka.',
                    'min_length' => 'NIK minimal 8 digit.',
                    'max_length' => 'NIK maksimal 20 digit.',
                    'is_unique' => 'NIK sudah terdaftar.'
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email',
            ],
            'phone' => [
                'rules' => 'permit_empty|numeric|min_length[10]|max_length[14]',
            ],
            'cabang' => 'required',
            'divisi' => 'required',
            'bagian' => 'required',
            'tentang' => 'permit_empty|max_length[1000]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost([
            'nik',
            'name',
            'email',
            'phone',
            'cabang',
            'divisi',
            'bagian',
            'tentang',
        ]);

        $this->model->update($id, $data);

        return redirect()->to('/employees')->with('success', 'Data berhasil diupdate');
    }


    // ===============================
    // DELETE
    // ===============================
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/employees')->with('success', 'Data berhasil dihapus');
    }

    // ===============================
    // DETAIL
    // ===============================
    public function show($id)
    {
        $employee = $this->model->find($id);
        if (! $employee) return redirect()->to('/employees');

        return view('employees/show', [
            'employee' => $employee
        ]);
    }

    // ===============================
    // EXPORT CSV
    // ===============================
    public function exportCsv()
    {
        $employees = $this->model->findAll();

        $filename = 'employees_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        // CSV HEADER
        fputcsv($output, [
            'ID',
            'NIK',
            'Nama',
            'Email',
            'Phone',
            'Cabang',
            'Divisi',
            'Bagian',
            'Tentang',
            'Created At'
        ]);

        // CSV BODY
        foreach ($employees as $e) {
            fputcsv($output, [
                $e['id'],
                $e['nik'],
                $e['name'],
                $e['email'],
                $e['phone'],
                $e['cabang'],
                $e['divisi'],
                $e['bagian'],
                $e['tentang'],
                $e['created_at']
            ]);
        }

        fclose($output);
        exit;
    }
}
