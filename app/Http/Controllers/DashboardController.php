<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalIndustri = Industri::count();

        return view('dashboard', compact('totalSiswa', 'totalGuru', 'totalIndustri'));
    }
}
