<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlatElektromedis;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

/**
 * Controller AlatElektromedisController
 * 
 * Sistem Informasi Manajemen Alat Elektromedis
 * 
 * @author Muhammad Faiq Syarifun Najih
 * @nim 1202305007
 */
class AlatElektromedisController extends Controller
{
    /**
     * GET /api/alat-elektromedis
     * Menampilkan semua data alat elektromedis
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = AlatElektromedis::query();

            // Search
            if ($request->has('search')) {
                $query->search($request->search);
            }

            // Filter status
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Filter kondisi
            if ($request->has('kondisi')) {
                $query->where('kondisi', $request->kondisi);
            }

            // Sorting
            $query->orderBy('created_at', 'desc');

            $alat = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data alat elektromedis berhasil diambil',
                'total' => $alat->count(),
                'data' => $alat,
                'author' => [
                    'nama' => 'Muhammad Faiq Syarifun Najih',
                    'nim' => '1202305007'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/alat-elektromedis
     * Menambah data alat baru
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            AlatElektromedis::validationRules(),
            AlatElektromedis::validationMessages()
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $alat = AlatElektromedis::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data alat berhasil ditambahkan',
                'data' => $alat
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/alat-elektromedis/{id}
     * Menampilkan detail satu alat
     */
    public function show(string $id): JsonResponse
    {
        try {
            $alat = AlatElektromedis::find($id);

            if (!$alat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data alat tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data alat berhasil ditemukan',
                'data' => $alat
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/alat-elektromedis/{id}
     * Mengupdate data alat
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $alat = AlatElektromedis::find($id);

            if (!$alat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data alat tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make(
                $request->all(),
                AlatElektromedis::validationRules($id),
                AlatElektromedis::validationMessages()
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $alat->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data alat berhasil diupdate',
                'data' => $alat
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/alat-elektromedis/{id}
     * Menghapus data alat
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $alat = AlatElektromedis::find($id);

            if (!$alat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data alat tidak ditemukan'
                ], 404);
            }

            $deletedData = $alat->toArray();
            $alat->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data alat berhasil dihapus',
                'deleted_data' => $deletedData
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/statistik
     * Menampilkan statistik dashboard
     */
    public function statistik(): JsonResponse
    {
        try {
            $stats = [
                'total_alat' => AlatElektromedis::count(),
                'alat_aktif' => AlatElektromedis::where('status', 'Aktif')->count(),
                'alat_maintenance' => AlatElektromedis::where('status', 'Maintenance')->count(),
                'alat_nonaktif' => AlatElektromedis::where('status', 'Nonaktif')->count(),
                'kondisi_baik' => AlatElektromedis::where('kondisi', 'Baik')->count(),
                'kondisi_rusak_ringan' => AlatElektromedis::where('kondisi', 'Rusak Ringan')->count(),
                'kondisi_rusak_berat' => AlatElektromedis::where('kondisi', 'Rusak Berat')->count(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Statistik berhasil diambil',
                'data' => $stats
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}