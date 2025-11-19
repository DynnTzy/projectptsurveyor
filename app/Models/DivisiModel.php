<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table = 'master_divisi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
