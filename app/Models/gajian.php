<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gajian extends Model
{
    use HasFactory;
    protected $table = 'gajians';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'pendidikan',
        'umr_id',
        'index',
        'THP',
        'Gaji',
        'Bonus',
        'Ach',
        'Masa_kerja',
        'Gaji_akhir',
        'Potongan',
        'status_admin',
        'status_penerima',
        'penyesuaian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function umr()
    {
        return $this->belongsTo(UMKaryawan::class);
    }
}
