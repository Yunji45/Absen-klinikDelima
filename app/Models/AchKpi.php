<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchKpi extends Model
{
    use HasFactory;

    protected $table= 'ach_kpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'daftar',
        'poli',
        'farmasi',
        'kasir',
        'care',
        'bpjs',
        'khitan',
        'rawat',
        'salin',
        'lab',
        'umum',
        'visit',
        'tambah1',
        'tambah2',
        'tambah3',
        'tambah4',
        'tambah5',
    ];

    public function targetkpi()
    {
        return $this->hasMany(TargetKpi::class);
    }
}
