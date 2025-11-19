<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik'        => '3174096501010001',
                'name'       => 'Aldi Pratama',
                'email'      => 'aldi@example.com',
                'phone'      => '081234567890',
                'cabang'     => 'Jakarta',
                'divisi'     => 'IT Development',
                'bagian'     => 'Staff',
                'tentang'    => 'Pegawai divisi IT.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nik'        => '3578024407990002',
                'name'       => 'Siti Aminah',
                'email'      => 'siti@example.com',
                'phone'      => '081298765432',
                'cabang'     => 'Bandung',
                'divisi'     => 'Sumber Daya Manusia',
                'bagian'     => 'Admin',
                'tentang'    => 'Pegawai bagian administrasi HR.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nik'        => '3275102302010003',
                'name'       => 'Rizky Hidayat',
                'email'      => 'rizky@example.com',
                'phone'      => '081377788899',
                'cabang'     => 'Surabaya',
                'divisi'     => 'Keuangan',
                'bagian'     => 'Staff',
                'tentang'    => 'Pegawai bagian finance.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nik'        => '1171026905010004',
                'name'       => 'Dewi Lestari',
                'email'      => 'dewi@example.com',
                'phone'      => '081345678901',
                'cabang'     => 'Medan',
                'divisi'     => 'Operasional',
                'bagian'     => 'Supervisor',
                'tentang'    => 'Supervisor bagian operasional.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nik'        => '6471034201910005',
                'name'       => 'Budi Santoso',
                'email'      => 'budi@example.com',
                'phone'      => '081567890123',
                'cabang'     => 'Makassar',
                'divisi'     => 'Pemasaran',
                'bagian'     => 'Manager',
                'tentang'    => 'Manager pemasaran.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('employees')->insertBatch($data);
    }
}
