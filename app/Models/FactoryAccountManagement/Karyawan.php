<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel
    protected $table = 'karyawan';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_karyawan',
        'nomor_karyawan',
        'jabatan',
        'tanggal_bergabung',
    ];

    // Casting tipe data
    protected $casts = [
        'tanggal_bergabung' => 'date'
    ];

    // Relasi dengan Pabrik
    public function pabrik()
    {
        return $this->belongsTo(Pabrik::class, 'id_pabrik');
    }


    // Scope untuk mencari berdasarkan nomor karyawan
    public function scopeNomorKaryawan($query, $nomor)
    {
        return $query->where('nomor_karyawan', $nomor);
    }
}