<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenUser extends Model
{
    use HasFactory;
    protected $table = 'dokumen_users';
    protected $primaryKey = 'id';
    protected $fillable = array(
        'user_id',
        'filename',
        'created_at',
        'update_at',
    );
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
