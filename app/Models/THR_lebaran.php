<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class THR_lebaran extends Model
{
    use HasFactory;
    protected $table='t_h_r_lebarans';
    protected $primaryKey= 'id';
    protected $fillable = [
        'user_id',
        'bulan',
        'pendidikan',
        'gaji_terakhir',
        'masuk',
        'keluar',
        'masa_kerja',
        'index',
        'THR',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
