<?php

namespace App\Models;

use CodeIgniter\Model;

class BagianModel extends Model
{
    protected $table = 'master_bagian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
