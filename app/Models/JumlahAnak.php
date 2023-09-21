<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahAnak extends Model
{
    use HasFactory;
    protected $table = 'jumlah_anaks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'nama_anak',
        'umur',
        'tanggal_lahir',
        'anak_ke',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
