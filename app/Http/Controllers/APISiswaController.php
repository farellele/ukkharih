<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class ApiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Siswa = Siswa::get();
        return response()->json([
            'status' => 'success',
            'data' => $Siswa,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Siswa = new Siswa();
        $Siswa->nama = $request->nama;
        $Siswa->nis = $request->nis;
        $Siswa->gender = $request->gender;
        $Siswa->alamat = $request->alamat;
        $Siswa->kontak = $request->kontak;
        $Siswa->email = $request->email;
        $Siswa->status_pkl = $request->status_pkl;
        $Siswa->save();
        return response()->json([
            'status' => 'success',
            'data' => $Siswa,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Siswa = Siswa::find($id);
        if (!$Siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa not found',
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $Siswa,
        ], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Siswa = Siswa::find($id);
        $Siswa->nama = $request->nama;
        $Siswa->nis = $request->nis;
        $Siswa->gender = $request->gender;
        $Siswa->alamat = $request->alamat;
        $Siswa->kontak = $request->kontak;
        $Siswa->email = $request->email;
        $Siswa->status_pkl = $request->status_pkl;
        $Siswa->save();
        return response()->json([
            'status' => 'success',
            'data' => $Siswa,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Siswa::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Siswa deleted successfully',
        ], 200);
    }
}