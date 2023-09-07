<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPegawai extends Model
{
    use HasFactory;

    protected $table = 'detail_pegawais';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'name',
        'place_birth',
        'date_birth',
        'gender',
        'religion',
        'education',
        'program_study',
        'address',
        'position',
        'phone',
        'email',
        'hire_date',
        'length_of_service',
        'exit_date',
        'exit_reason',
        'marital_status',
        'spouse_name',
        'number_of_children',
        'hobbies',
        'skills',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
