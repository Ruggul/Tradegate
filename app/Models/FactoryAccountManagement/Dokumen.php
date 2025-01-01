<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
    use HasFactory, SoftDeletes;

    // Nama tabel
    protected $table = 'dokumen';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_perusahaan',
        'nama_dokumen',
        'jenis_dokumen',
        'tanggal_terbit',
        'status_aktif'
    ];

    // Casting tipe data
    protected $casts = [
        'tanggal_terbit' => 'date',
        'status_aktif' => 'boolean'
    ];

    // Relasi dengan Perusahaan
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }

    // Scope untuk mencari berdasarkan jenis dokumen
    public function scopeJenisDokumen($query, $jenis)
    {
        return $query->where('jenis_dokumen', $jenis);
    }
}