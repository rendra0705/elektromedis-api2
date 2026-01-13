<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatElektromedis;
use Illuminate\Support\Facades\DB;

/**
 * Seeder AlatElektromedisSeeder
 * 
 * @author Muhammad Faiq Syarifun Najih
 * @nim 1202305007
 */
class AlatElektromedisSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('alat_elektromedis')->truncate();

        // Data sample alat elektromedis
        $alatList = [
            [
                'nama_alat' => 'Ventilator',
                'merk' => 'Philips Respironics V60',
                'tahun_pembuatan' => 2022,
                'nomor_seri' => 'VNT-2022-001',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'ICU Lantai 3 Ruang A',
                'tanggal_kalibrasi' => '2024-01-15',
            ],
            [
                'nama_alat' => 'ECG Monitor',
                'merk' => 'GE Healthcare CARESCAPE B450',
                'tahun_pembuatan' => 2023,
                'nomor_seri' => 'ECG-2023-005',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ruang Emergency Lantai 1',
                'tanggal_kalibrasi' => '2024-01-20',
            ],
            [
                'nama_alat' => 'Infusion Pump',
                'merk' => 'B. Braun Infusomat Space',
                'tahun_pembuatan' => 2021,
                'nomor_seri' => 'INF-2021-010',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ruang Rawat Inap Lantai 2',
                'tanggal_kalibrasi' => '2023-12-10',
            ],
            [
                'nama_alat' => 'Defibrillator',
                'merk' => 'Zoll M Series',
                'tahun_pembuatan' => 2020,
                'nomor_seri' => 'DEF-2020-003',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ambulans Unit 1',
                'tanggal_kalibrasi' => '2023-11-25',
            ],
            [
                'nama_alat' => 'Syringe Pump',
                'merk' => 'Terumo TE-331',
                'tahun_pembuatan' => 2022,
                'nomor_seri' => 'SYR-2022-015',
                'kondisi' => 'Rusak Ringan',
                'status' => 'Maintenance',
                'lokasi' => 'Ruang Operasi Lantai 4',
                'tanggal_kalibrasi' => '2024-01-05',
            ],
            [
                'nama_alat' => 'Ultrasound',
                'merk' => 'Mindray DC-70',
                'tahun_pembuatan' => 2023,
                'nomor_seri' => 'USG-2023-007',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Poliklinik Radiologi',
                'tanggal_kalibrasi' => '2024-01-18',
            ],
            [
                'nama_alat' => 'Patient Monitor',
                'merk' => 'Nihon Kohden BSM-6501',
                'tahun_pembuatan' => 2021,
                'nomor_seri' => 'MON-2021-012',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'ICU Lantai 3 Ruang B',
                'tanggal_kalibrasi' => '2023-12-20',
            ],
            [
                'nama_alat' => 'Anesthesia Machine',
                'merk' => 'Drager Fabius GS Premium',
                'tahun_pembuatan' => 2022,
                'nomor_seri' => 'ANE-2022-004',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ruang Operasi 1 Lantai 4',
                'tanggal_kalibrasi' => '2024-01-10',
            ],
            [
                'nama_alat' => 'X-Ray Mobile',
                'merk' => 'Siemens Mobilett Mira',
                'tahun_pembuatan' => 2020,
                'nomor_seri' => 'XRY-2020-002',
                'kondisi' => 'Rusak Berat',
                'status' => 'Nonaktif',
                'lokasi' => 'Gudang Peralatan Medis',
                'tanggal_kalibrasi' => '2023-06-15',
            ],
            [
                'nama_alat' => 'Suction Pump',
                'merk' => 'Laerdal LCSU4',
                'tahun_pembuatan' => 2023,
                'nomor_seri' => 'SUC-2023-020',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ruang Emergency Lantai 1',
                'tanggal_kalibrasi' => '2024-01-22',
            ],
            [
                'nama_alat' => 'Pulse Oximeter',
                'merk' => 'Masimo Radical-7',
                'tahun_pembuatan' => 2022,
                'nomor_seri' => 'OXI-2022-018',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ruang Rawat Intensif',
                'tanggal_kalibrasi' => '2024-01-12',
            ],
            [
                'nama_alat' => 'Nebulizer',
                'merk' => 'Omron CompAir NE-C28',
                'tahun_pembuatan' => 2021,
                'nomor_seri' => 'NEB-2021-025',
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'lokasi' => 'Ruang Perawatan Anak Lantai 2',
                'tanggal_kalibrasi' => '2023-11-30',
            ],
        ];

        // Insert ke database
        foreach ($alatList as $alat) {
            AlatElektromedis::create($alat);
        }

        // Pesan sukses
        $this->command->info('✅ Data alat elektromedis berhasil di-seed!');
        $this->command->info('📊 Total data: ' . count($alatList) . ' alat');
        $this->command->line('');
        $this->command->line('📝 Author: Muhammad Faiq Syarifun Najih');
        $this->command->line('🎓 NIM: 1202305007');
    }
}