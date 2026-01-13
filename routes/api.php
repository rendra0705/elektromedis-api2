<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'API Sistem Informasi Manajemen Alat Elektromedis',
        'version' => '1.0.0',
        'author' => [
            'nama' => 'Muhammad Faiq Syarifun Najih',
            'nim' => '1202305007'
        ]
    ]);
});
