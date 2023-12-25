<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJasaMedis extends Model
{
    use HasFactory;
    protected $table = 'kategori_jasa_medis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_layanan',
        'jenis_jasa',
        'tarif_jasa',
    ];
}
