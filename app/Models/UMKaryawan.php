<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKaryawan extends Model
{
    use HasFactory;
    protected $table = 'u_m_karyawans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'UMK',
        'Rp',
    ];

    public function gaji()
    {
        return $this->hasMany(gajian::class);
    }
}
