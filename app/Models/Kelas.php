<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jurusan(): BelongsTo{
        return $this->belongsTo(Jurusan::class);
    }

    public function jadwals(): hasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
