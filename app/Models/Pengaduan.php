<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'lokasi',
        'status',
        'tanggal_lapor',
        'tanggal_selesai',
        'foto',
    ];

    protected $casts = [
        'foto' => 'array',
        'tanggal_lapor' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
