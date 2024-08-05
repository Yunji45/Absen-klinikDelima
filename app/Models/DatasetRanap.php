<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetRanap extends Model
{
    use HasFactory;
    protected $table = 'ranaps';
    protected $primaryKey = 'id';
    protected $fillable = ['tgl_kunjungan', 'no_rm', 'name', 'poli', 'jenis_kelamin' ,'alamat'];


    public function wilayah()
    {
        return $this->belongsTo(KodeWilayah::class);
    }
}
