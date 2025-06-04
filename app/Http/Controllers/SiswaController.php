<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil data siswa dengan pagination dan urutan berdasarkan nama
        $siswas = Siswa::orderBy('nama', 'asc')->paginate(10);

        return view('siswas.index', compact('siswas')); // Pastikan view sesuai folder
    }
}