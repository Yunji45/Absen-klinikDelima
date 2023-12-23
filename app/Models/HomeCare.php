<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCare extends Model
{
    use HasFactory;

    protected $table = 'home_cares';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'No_HC',
        'bulan',
        'foto',
        'nama_pasien',
        'jenis_layanan',
        'jenis_jasa',
        'tarif_jasa',
        'ceklis',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
