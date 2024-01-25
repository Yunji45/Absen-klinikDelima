<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;
    protected $table = 'tentangs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sub_judul_1',
        'sub_judul_2',
        'content_1',
        'content_2',
        'foto_1',
    ];

    public function idea()
    {
        return $this->belongsTo(User::class);
    }
}
