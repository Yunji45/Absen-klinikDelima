<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_divisi',
        'deskripsi_singkat',
        'deskripsi_divisi',
        'foto_divisi'
    ];
}
