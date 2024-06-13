<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeWilayah extends Model
{
    use HasFactory;
    protected $table = 'kode_wilayahs';
    protected $primaryKey = 'id';
    protected $fillable= ['kode','wilayah','longitude','latitude'];

    public function rajal()
    {
        return $this->hasMany(DatasetRajal::class,'kode_wilayah');
    }
    public function ranap()
    {
        return $this->hasMany(DatasetRanap::class,'kode_wilayah');
    }
    public function khitan()
    {
        return $this->hasMany(DatasetKhitan::class,'kode_wilayah');
    }
    public function estetik()
    {
        return $this->hasMany(DatasetEstetika::class,'kode_wilayah');
    }
    public function usg()
    {
        return $this->hasMany(DatasetUsg::class,'kode_wilayah');
    }
    public function lab()
    {
        return $this->hasMany(DatasetLab::class,'kode_wilayah');
    }


}
