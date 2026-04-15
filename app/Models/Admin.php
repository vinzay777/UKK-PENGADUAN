<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'admin';
    protected $fillable = [
        'username', 'nama', 'kata_sandi'
    ];
    protected $hidden = ['kata_sandi', 'remember_token'];
    protected $casts = ['kata_sandi' => 'hashed'];
    public function getAuthPassword() { return $this->kata_sandi; }
}
