<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsentifKpi extends Model
{
    use HasFactory;
    protected $table = 'insentif_kpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'bulan',
        'omset',
        'total_poin',
        'total_insentif',
        'index_rupiah',
        'insentif_final',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
