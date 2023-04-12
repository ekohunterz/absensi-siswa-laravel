<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jurusan(){
        return $this->belongsTo(Jurusan::class);
    }

    public function jadwals(){
        return $this->hasMany(Jadwal::class);
    }
}
