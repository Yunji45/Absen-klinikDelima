<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_shift',
    ];

    public function jadwal()
    {
        return $this->hasMany(jadwal::class);
    }
}
