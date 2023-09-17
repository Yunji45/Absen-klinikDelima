<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\presensi;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'no_hp',
        'nik',
        'email',
        'password',
        'role',
        'foto',
        'saldo_cuti',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function presensi()
    {
        return $this->hasMany(presensi::class);
    }

    public function cuti ()
    {
        return $this->hasMany(cuti::class);
    }

    public function detailpegawai ()
    {
        return $this->hasOne(DetailPegawai::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenUser::class);
    }

    public function sertifikat()
    {
        return $this->hasMany(SertifikatUser::class);
    }

    public function jadwal()
    {
        return $this->hasMany(jadwal::class);
    }
    public function jadwalterbaru()
    {
        return $this->hasMany(jadwalterbaru::class);
    }

    public function permohonan()
    {
        return $this->hasMany(rubahjadwal::class);
    }
}
