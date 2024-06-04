<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeWilayah extends Model
{
    use HasFactory;
    protected $table = 'kode_wilayahs';
    protected $primaryKey = 'id';
    protected $fillable= ['kode','wilayah'];
}
