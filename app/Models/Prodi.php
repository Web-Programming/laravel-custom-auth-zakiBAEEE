<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    // Cara menghubungkan tabel prodis dengan mahasisswas
    public function mahasiswa(){
        return $this->hasMany('App\Models\Mahasiswa');
    }
}
