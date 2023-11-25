<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprJasaMedis extends Model
{
    use HasFactory;
    protected $table ='opr_jasa_medis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'No_RM',
        'target_id',
        'nama_pasien',
        'jenis_layanan',
        'jenis_jasa',
        'tarif_jasa',
        'nama_petugas',
        'ceklis_tindakan',
    ];

    public function jasamedis()
    {
        return $this->belongsTo(JasaMedis::class);
    }
}
