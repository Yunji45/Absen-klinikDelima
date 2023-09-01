<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model
{
    use HasFactory;

    protected $table = 'cutis';
    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_berakhir',
        'alasan',
        'status'
    ];
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
