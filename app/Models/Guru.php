<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'nip',
        'gender',
        'alamat',
        'kontak',
        'email',
    ];

    protected static function booted()
    {
    static::updating(function ($guru) {
            if ($guru->isDirty('email')) {
                $oldEmail = $guru->getOriginal('email');

                // Cek User dengan email lama
                $user = \App\Models\User::where('email', $oldEmail)->first();

                if ($guru) {
                    $guru->email = $guru->email;
                    $guru->save();
                }
            }
        });
    }
}