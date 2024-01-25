<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    use HasFactory;
    protected $table = 'berandas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sub_judul_1',
        'sub_judul_2',
        'sub_judul_3',
        'content_1',
        'content_2',
        'content_3',
        'foto_1',
        'foto_2',
        'foto_3',
    ];

    public function idea()
    {
        return $this->belongsTo(User::class);
    }
}
