<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;
    protected $table = 'job_vacancies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category',
        'position',
        'deskripsi',
        'kualifikasi_1',
        'kualifikasi_2',
        'kualifikasi_3',
        'kualifikasi_4',
        'kualifikasi_5',
        'kualifikasi_6',
        'kualifikasi_7',
        'kualifikasi_8',
        'kualifikasi_9',
        'kualifikasi_10',
        'bulan',
    ];

    public function pelamar()
    {
        return $this->hasMany(JobApplication::class);
    }
}
