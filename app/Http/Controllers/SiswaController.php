<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all(); // Ambil semua data siswa dari database
        return view('siswas', compact('siswas')); // Kirimkan ke view
    }
}