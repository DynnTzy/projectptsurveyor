<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        // === CABANG ===
        $cabangs = [
            ['nama' => 'Jakarta'],
            ['nama' => 'Bandung'],
            ['nama' => 'Surabaya'],
            ['nama' => 'Medan'],
            ['nama' => 'Makassar'],
        ];
        $this->db->table('master_cabang')->insertBatch($cabangs);

        // === DIVISI ===
        $divisis = [
            ['nama' => 'Keuangan'],
            ['nama' => 'Sumber Daya Manusia'],
            ['nama' => 'Pemasaran'],
            ['nama' => 'Operasional'],
            ['nama' => 'IT Development'],
        ];
        $this->db->table('master_divisi')->insertBatch($divisis);

        // === BAGIAN ===
        $bagians = [
            ['nama' => 'Staff'],
            ['nama' => 'Supervisor'],
            ['nama' => 'Manager'],
            ['nama' => 'Admin'],
            ['nama' => 'Quality Assurance'],
        ];
        $this->db->table('master_bagian')->insertBatch($bagians);
    }
}
