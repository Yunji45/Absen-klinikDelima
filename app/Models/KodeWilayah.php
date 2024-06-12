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

    public function rajal()
    {
        return $this->hasMany(DatasetRajal::class);
    }
    public function ranap()
    {
        return $this->hasMany(DatasetRanap::class);
    }
    public function khitan()
    {
        return $this->hasMany(DatasetKhitan::class);
    }
    public function estetik()
    {
        return $this->hasMany(DatasetEstetika::class);
    }
    public function usg()
    {
        return $this->hasMany(DatasetUsg::class);
    }
    public function lab()
    {
        return $this->hasMany(DatasetLab::class);
    }


}
