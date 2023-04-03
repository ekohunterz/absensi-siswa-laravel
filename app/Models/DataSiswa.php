<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function absen(){
        return $this->hasMany(Absen::class);
    }
}
