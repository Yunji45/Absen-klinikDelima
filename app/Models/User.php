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

    //presensi
    public function presensi()
    {
        return $this->hasMany(presensi::class);
    }
    //cuti
    public function cuti ()
    {
        return $this->hasMany(cuti::class);
    }
    //detail pegawai
    public function detailpegawai ()
    {
        return $this->hasOne(DetailPegawai::class);
    }
    //dokumen pegawai
    public function dokumen()
    {
        return $this->hasMany(DokumenUser::class);
    }
    //sertifikat pegawai
    public function sertifikat()
    {
        return $this->hasMany(SertifikatUser::class);
    }
    //jadwal pegawai
    public function jadwal()
    {
        return $this->hasMany(jadwal::class);
    }
    //jadwal pegawai yang di pakai
    public function jadwalterbaru()
    {
        return $this->hasMany(jadwalterbaru::class);
    }
    //perubahan jadwal
    public function permohonan()
    {
        return $this->hasMany(rubahjadwal::class);
    }
    //jumlah anak pegawai
    public function jumlahanak()
    {
        return $this->hasMany(JumlahAnak::class);
    }
    //gaji pegawai
    public function gaji()
    {
        return $this->hasMany(gajian::class);
    }
    //key performance indikator pegawai
    public function kpi()
    {
        return $this->hasMany(kpi::class);
    }
    //target key performace indikator pegawai
    public function targetkpi()
    {
        return $this->hasMany(TargetKpi::class);
    }
    //insentif KPI
    public function InsentifKpi()
    {
        return $this->hasMany(InsentifKpi::class);
    }

    //opr jasa medis
    public function JasaMedis()
    {
        return $this->hasMany(OprJasaMedis::class);
    }

    //Home Care
    public function care()
    {
        return $this->hasMany(HomeCare::class);
    }

    //daftar tugas
    public function tugas()
    {
        return $this->hasMany(OperasionalJasa::class,'user_id');
    }

    //note karyawan
    public function notekarwayan()
    {
        return $this->hasMany(NoteKaryawan::class);
    }
}
