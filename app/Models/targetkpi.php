<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class targetkpi extends Model
{
    use HasFactory;
    protected $table = 'targetkpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
    ];
    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
