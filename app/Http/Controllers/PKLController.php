<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\Industri;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PKLController extends Controller
{
    public function index()
    {
        $pkls = PKL::with(['siswa', 'industri', 'guru'])->get(); // Optimisasi query dengan eager loading
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
        // Validasi input
        $validated = $request->validate([
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        // Cari siswa berdasarkan email dari pengguna yang login
        $siswa = Siswa::where('email', auth()->user()->email)->first();

        if (!$siswa) {
            return back()->with('error', 'Anda belum terdaftar sebagai siswa.');
        }

        // Cek apakah siswa sudah memiliki PKL
        if (PKL::where('siswa_id', $siswa->id)->exists()) {
            return back()->with('error', 'Anda sudah memiliki data PKL dan tidak bisa mendaftar ulang.');
        }

        // Validasi apakah PKL berlangsung minimal 90 hari
        $waktuMulai = Carbon::parse($validated['waktu_mulai']);
        $waktuSelesai = Carbon::parse($validated['waktu_selesai']);
        $selisihHari = $waktuMulai->diffInDays($waktuSelesai);

        if ($selisihHari < 90) {
            return back()->with('error', 'PKL minimal harus berlangsung selama 90 hari.');
        }

        // Simpan data jika validasi berhasil
        PKL::create([
            'siswa_id' => $siswa->id,
            'industri_id' => $validated['industri_id'],
            'guru_id' => $validated['guru_id'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
        ]);

        return redirect()->route('pkl')->with('success', 'Data PKL berhasil ditambahkan.');
    }
}
