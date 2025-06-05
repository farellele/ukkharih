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

    public function setKontakAttribute($value)
    {
        // Hapus spasi dan karakter selain angka dan +
        $value = preg_replace('/[^0-9+]/', '', $value);

        // Ubah +62 ke 0
        if (strpos($value, '+62') === 0) {
            $value = '0' . substr($value, 3);
        }

        // Ubah jika dimulai dari angka 8 (misal 8123456789) menjadi 08...
        if (preg_match('/^[1-9]/', $value)) {
            $value = '0' . $value;
        }

        $this->attributes['kontak'] = $value;
    }

    public function delete()
    {
        if ($this->status_pkl === 'Sedang PKL') {
            throw new \Exception("Tidak bisa dihapus karena siswa sedang PKL");
        }

        parent::delete();
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