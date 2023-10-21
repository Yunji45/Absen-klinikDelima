<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetKpi extends Model
{
    use HasFactory;
    protected $table = 'target_kpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'target_id',
        'bulan',
        'r_daftar',
        'c_daftar',
        'r_poli',
        'c_poli',
        'r_farmasi',
        'c_farmasi',
        'r_kasir',
        'c_kasir',
        'r_care',
        'c_care',
        'r_khitan',
        'c_khitan',
        'r_rawat',
        'c_rawat',
        'r_bpjs',
        'c_bpjs',
        'r_salin',
        'c_salin',
        'r_lab',
        'c_lab',
        'r_umum',
        'c_umum',
        'r_visit',
        'c_visit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ach()
    {
        return $this->belongsTo(AchKpi::class);
    }
}
