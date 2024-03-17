<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatasetKhitan extends Model
{
    use HasFactory;

    protected $table = 'dataset_khitans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl_kunjungan',
        'name',
        'no_rm',
        'poli',
        'jenis_kelamin',
    ];
}
