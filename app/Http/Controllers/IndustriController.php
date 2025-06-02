<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    public function index()
    {
        $industris = Industri::all(); // Ambil semua data industri dari database
        return view('industris', compact('industris')); // Kirimkan ke view
    }

    public function create()
    {
        return view('create_industri'); // Sesuaikan dengan lokasi dan nama file
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:industris,nama',
            'bidang' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:50',
            'email' => 'nullable|string|email|max:255',
        ]);

        Industri::create($validated);

        return redirect()->route('industris')->with('success', 'Industri berhasil ditambahkan.');
    }
}
