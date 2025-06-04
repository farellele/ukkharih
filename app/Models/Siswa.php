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
        'status_pkl' => 'Belum PKL',
    ];

    public function pkl()
    {
        return $this->hasOne(PKL::class, 'siswa_id');
    }
}