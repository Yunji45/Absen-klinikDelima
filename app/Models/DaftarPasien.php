<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPasien extends Model
{
    use HasFactory;
    protected $table = 'daftar_pasiens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pasien',
        'No_RM',
        'jenis_kelamin',
        'alamat',
        'bulan',
    ];

    public function OprJasa()
    {
        return $this->hasMany(OperasionalJasa::class);
    }
}
