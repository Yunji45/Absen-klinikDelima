<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaMedis extends Model
{
    use HasFactory;
    protected $table = 'jasa_medis';
    protected $primaryKey = 'id';
    protected $fillable= [
        'nama_standar_opr',
        'start_date',
        'end_date',
        'jenis_layanan',
        'jenis_jasa',
        'tarif_jasa',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function opr()
    {
        return $this->hasMany(OprJasaMedis::class);
    }
}
