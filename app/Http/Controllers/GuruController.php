<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all(); // Ambil semua data guru dari database
        return view('gurus', compact('gurus')); // Kirimkan ke view
    }
}