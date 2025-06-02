<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\Industri;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PKLController extends Controller
{
    public function index()
    {
        $pkls = PKL::all();
        return view('pkl', compact('pkls'));
    }

    public function create()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        $industris = Industri::all(); // Mengambil daftar industri
        $gurus = Guru::all(); // Mengambil daftar guru pembimbing

        return view('create', compact('user', 'industris', 'gurus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        // Cari ID siswa berdasarkan email dari pengguna yang login
        $siswa = Siswa::where('email', auth()->user()->email)->first();
        
        if (!$siswa) {
            return back()->withErrors(['siswa_id' => 'Anda belum terdaftar sebagai siswa.']);
        }

        PKL::create([
            'siswa_id' => $siswa->id, // Gunakan ID dari tabel siswas, bukan tabel users
            'industri_id' => $validated['industri_id'],
            'guru_id' => $validated['guru_id'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
        ]);

        return redirect()->route('pkl')->with('success', 'Data PKL berhasil ditambahkan.');
    }
}