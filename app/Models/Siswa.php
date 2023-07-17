<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'nis';
    }

    public function pondok()
    {
        return $this->belongsTo(Pondok::class);
    }
    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }
    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}
