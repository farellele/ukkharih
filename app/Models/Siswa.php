<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PKL;


class Siswa extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nis',
        'gender',
        'alamat',
        'kontak',
        'email',
        'status_pkl',
    ];

    public function pkl()
    {
        return $this->hasOne(PKL::class, 'siswa_id');
    }
    
    protected static function booted()
    {
    static::updating(function ($siswa) {
            if ($siswa->isDirty('email')) {
                $oldEmail = $siswa->getOriginal('email');

                // Cek User dengan email lama
                $user = \App\Models\User::where('email', $oldEmail)->first();

                if ($user) {
                    $user->email = $siswa->email;
                    $user->save();
                }
            }
        });
    }

    public function canDelete(): bool
    {
        return $this->status_pkl !== 'Sedang PKL';
    }

}