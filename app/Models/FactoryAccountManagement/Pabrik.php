<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pabrik extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel
    protected $table = 'pabrik';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_perusahaan',
        'kode_perusahaan',
        'alamat',
        'kota',
        'provinsi',
        'nomor_telepon',
        'email',
        'npwp',
        'pabrik_id'
        
    ];

    // Relasi dengan Departemen
   