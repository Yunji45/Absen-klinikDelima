<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OmsetKlinik extends Model
{
    use HasFactory;
    protected $table = 'omset_kliniks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'bulan',
        'omset',
        'skor',
        'index',
        'index_rupiah',
        'total_insentif',
    ];
}
