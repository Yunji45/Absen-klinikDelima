<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetKhitan extends Model
{
    use HasFactory;

    protected $table = 'sunat';
    protected $primaryKey = 'id';
    protected $fillable = ['tgl_kunjungan', 'no_rm', 'name', 'poli', 'jenis_kelamin' ,'kode_wilayah'];


    public function wilayah()
    {
        return $this->belongsTo(KodeWilayah::class);
    }
}
