<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employees';
    protected $primaryKey = 'id';

    // FIELD YANG BENAR (lowercase semua)
    protected $allowedFields = [
        'nik',
        'name',
        'email',
        'phone',
        'cabang',
        'divisi',
        'bagian',
        'tentang',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
