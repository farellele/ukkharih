<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKL extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pkls";

    protected $fillable = [
        'siswa_id',
        'industri_id',
        'guru_id',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    // Definisi relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'industri_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Booted untuk trigger otomatis di Laravel
    protected static function booted()
    {
        static::creating(function (PKL $pkl) {
            if (!isset($pkl->siswa_id) || PKL::where('siswa_id', $pkl->siswa_id)->first()) {
                throw new \Exception('Siswa ini sudah memiliki PKL.');
            }
        });

        static::created(function (PKL $pkl) {
            if ($pkl->siswa) {
                $pkl->siswa->forceFill(['status_pkl' => 1])->save();
            }
        });

        static::deleted(function (PKL $pkl) {
            if ($pkl->siswa) {
                $pkl->siswa->forceFill(['status_pkl' => 0])->save();
            }
        });
    }
}
