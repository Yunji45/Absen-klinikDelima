<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $table = 'job_applications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'vacancy_id',
        'nama_lengkap',
        'email',
        'foto',
        'file_cv',
        'file_pendukung',
        'cover_letter',
    ];

    public function vacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }
}
