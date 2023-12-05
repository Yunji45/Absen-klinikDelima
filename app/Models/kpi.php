<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kpi extends Model
{
    use HasFactory;
    protected $table = 'kpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'target',
        'jabatan',
        'nama_atasan',
        'div_atasan',
        'jabatan_atasan',
        'div',
        'daftar',
        'poli',
        'farmasi',
        'kasir',
        'care',
        'bpjs',
        'khitan',
        'rawat',
        'persalinan',
        'lab',
        'umum',
        'visit',
        'layanan',
        'akuntan',
        'kompeten',
        'harmonis',
        'loyal',
        'adaptif',
        'kolaboratif',
        'absen',
        'total',
        'total_kinerja',
        'ket',
        'bulan',
        'usg'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
