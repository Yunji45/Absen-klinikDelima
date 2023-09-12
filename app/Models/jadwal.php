<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'bulan',
        'masa_aktif',
        'masa_akhir',
        'j1','j2','j3','j4','j5','j6','j7','j8','j9','j10',
        'j11','j12','j13','j14','j15','j16','j17','j18','j19','j20',
        'j20','j22','j23','j24','j25','j26','j27','j28','j29','j30','j31',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function shift()
    {
        return $this->belongsTo(shift::class);
    }
}
