<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatingApp extends Model
{
    use HasFactory;

    protected $table = 'chating_apps';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','body'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
