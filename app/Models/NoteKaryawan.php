<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteKaryawan extends Model
{
    use HasFactory;

    protected $table = 'note_karyawans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'bulan',
        'keteranagan',
        'deskripsi',
        'resume',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
