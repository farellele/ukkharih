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
    // Halaman Index PKL
    public function index()
    {
        $siswa = Siswa::where('email', Auth::user()->email)->firstOrFail();

        $pkls = PKL::where('siswa_id', $siswa->id)->get();

        return view('pkl', compact('siswa', 'pkls'));
    }

    // Halaman Buat PKL
    public function create()
    {
        $siswa = Siswa::where('email', Auth::user()->email)->firstOrFail();

        $industris = Industri::all();
        $gurus = Guru::all();

        return view('create', compact('siswa', 'industris', 'gurus'));
    }

    // Simpan Data PKL
    public function store(Request $request)
    {
        $request->validate([
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        // Ambil data siswa yang sedang login
        $siswa = Siswa::where('email', Auth::user()->email)->firstOrFail();

        // Cegah siswa yang sudah memiliki PKL
        if (PKL::where('siswa_id', $siswa->id)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memiliki data PKL dan tidak bisa mendaftar ulang.');
        }

        // Validasi durasi minimal 90 hari
        $waktuMulai = Carbon::parse($request->waktu_mulai);
        $waktuSelesai = Carbon::parse($request->waktu_selesai);
        if ($waktuMulai->diffInDays($waktuSelesai) < 90) {
            return redirect()->back()->with('error', 'PKL minimal harus berlangsung selama 90 hari.');
        }

        // Simpan data PKL ke database
        PKL::create([
            'siswa_id' => $siswa->id,
            'industri_id' => $request->industri_id,
            'guru_id' => $request->guru_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        // Update status PKL siswa ke "Sedang PKL"
        $siswa->status_pkl = 'Sedang PKL';
        $siswa->save();

        return redirect()->route('pkl')->with('success', 'Data PKL berhasil ditambahkan! Status PKL telah diperbarui.');
    }
}