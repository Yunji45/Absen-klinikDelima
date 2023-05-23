<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class presensi extends Model
{
    use HasFactory;
    protected $table= 'presensis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'keterangan',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
