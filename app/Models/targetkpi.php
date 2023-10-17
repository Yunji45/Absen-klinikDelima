<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class targetkpi extends Model
{
    use HasFactory;
    protected $table = 'targetkpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'bulan',
        't_daftar',
        'r_daftar',
        'c_daftar',
        't_poli',
        'r_poli',
        'c_poli',
        't_farmasi',
        'r_farmasi',
        'c_farmasi',
        't_kasir',
        'r_kasir',
        'c_kasir',
        't_care',
        'r_care',
        'c_care',
        't_khitan',
        'r_khitan',
        'c_khitan',
        't_rawat',
        'r_rawat',
        'c_rawat',
        't_salin',
        'r_salin',
        'c_salin',
        't_lab',
        'r_lab',
        'c_lab',
        't_umum',
        'r_umum',
        'c_umum',
        't_visit',
        'r_visit',
        'c_visit',
        't_absen',
        'r_absen',
        'c_absen',
    ];
    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
