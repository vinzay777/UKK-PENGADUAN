<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'siswa';
    protected $fillable = [
        'nisn', 'nama', 'email', 'kata_sandi', 'kelas'
    ];
    protected $hidden = ['kata_sandi', 'remember_token'];
    protected $casts = ['kata_sandi' => 'hashed'];
    public function getAuthIdentifierName() { return 'nisn'; }
    public function getAuthPassword() { return $this->kata_sandi; }
}
