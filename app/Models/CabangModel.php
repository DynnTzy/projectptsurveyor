<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = 'master_cabang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
