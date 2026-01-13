<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Model AlatElektromedis
 * 
 * Sistem Informasi Manajemen Alat Elektromedis
 * 
 * @author Muhammad Faiq Syarifun Najih
 * @nim 1202305007
 * @package App\Models
 */
class AlatElektromedis extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'alat_elektromedis';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'nama_alat',
        'merk',
        'tahun_pembuatan',
        'nomor_seri',
        'kondisi',
        'status',
        'lokasi',
        'tanggal_kalibrasi',
    ];

    /**
     * Field yang harus di-cast ke tipe data tertentu
     */
    protected $casts = [
        'tahun_pembuatan' => 'integer',
        'tanggal_kalibrasi' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Validasi rules
     */
    public static function validationRules($id = null): array
    {
        return [
            'nama_alat' => 'required|string|max:100',
            'merk' => 'required|string|max:100',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nomor_seri' => 'required|string|max:50|unique:alat_elektromedis,nomor_seri,' . $id,
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'status' => 'required|in:Aktif,Nonaktif,Maintenance',
            'lokasi' => 'required|string|max:150',
            'tanggal_kalibrasi' => 'nullable|date|before_or_equal:today',
        ];
    }

    /**
     * Custom error messages
     */
    public static function validationMessages(): array
    {
        return [
            'nama_alat.required' => 'Nama alat harus diisi',
            'nama_alat.max' => 'Nama alat maksimal 100 karakter',
            'merk.required' => 'Merk alat harus diisi',
            'merk.max' => 'Merk maksimal 100 karakter',
            'tahun_pembuatan.required' => 'Tahun pembuatan harus diisi',
            'tahun_pembuatan.integer' => 'Tahun pembuatan harus berupa angka',
            'tahun_pembuatan.min' => 'Tahun pembuatan minimal 1900',
            'tahun_pembuatan.max' => 'Tahun pembuatan tidak boleh melebihi tahun ini',
            'nomor_seri.required' => 'Nomor seri harus diisi',
            'nomor_seri.unique' => 'Nomor seri sudah terdaftar',
            'nomor_seri.max' => 'Nomor seri maksimal 50 karakter',
            'kondisi.required' => 'Kondisi alat harus dipilih',
            'kondisi.in' => 'Kondisi harus: Baik, Rusak Ringan, atau Rusak Berat',
            'status.required' => 'Status alat harus dipilih',
            'status.in' => 'Status harus: Aktif, Nonaktif, atau Maintenance',
            'lokasi.required' => 'Lokasi alat harus diisi',
            'lokasi.max' => 'Lokasi maksimal 150 karakter',
            'tanggal_kalibrasi.date' => 'Format tanggal kalibrasi tidak valid',
            'tanggal_kalibrasi.before_or_equal' => 'Tanggal kalibrasi tidak boleh di masa depan',
        ];
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Scope untuk filter berdasarkan kondisi
     */
    public function scopeKondisiBaik($query)
    {
        return $query->where('kondisi', 'Baik');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('nama_alat', 'LIKE', "%{$keyword}%")
              ->orWhere('merk', 'LIKE', "%{$keyword}%")
              ->orWhere('nomor_seri', 'LIKE', "%{$keyword}%")
              ->orWhere('lokasi', 'LIKE', "%{$keyword}%");
        });
    }

    /**
     * Accessor untuk format tanggal kalibrasi
     */
    public function getTanggalKalibrasiFormattedAttribute(): ?string
    {
        if ($this->tanggal_kalibrasi) {
            return $this->tanggal_kalibrasi->format('d/m/Y');
        }
        return null;
    }

    /**
     * Method untuk cek apakah alat perlu kalibrasi (1 tahun sekali)
     */
    public function perluKalibrasi(): bool
    {
        if (!$this->tanggal_kalibrasi) {
            return true;
        }
        
        $selisihBulan = now()->diffInMonths($this->tanggal_kalibrasi);
        return $selisihBulan >= 12;
    }
}