<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperasionalJasa extends Model
{
    use HasFactory;
    protected $table = 'operasional_jasas';
    protected $primaryKey = 'id';
    protected $fillble = [
        'user_id',
        'layanan_id',
        'pasien_id',
        'bulan',
        'tarif_jasa',
        'ceklis'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriJasaMedis::class);
    }

    public function pasien()
    {
        return $this->belongsTo(DaftarPasien::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
