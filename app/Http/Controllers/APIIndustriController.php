<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use Illuminate\Http\Request;

class ApiIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Industri = Industri::get();
        return response()->json([
            'status' => 'success',
            'data' => $Industri,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Industri = new Industri();
        $Industri->nama = $request->nama;
        $Industri->bidang = $request->bidang;
        $Industri->alamat = $request->alamat;
        $Industri->kontak = $request->kontak;
        $Industri->email = $request->email;
        $Industri->save();
        return response()->json([
            'status' => 'success',
            'data' => $Industri,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Industri = Industri::find($id);
        if (!$Industri) {
            return response()->json([
                'status' => 'error',
                'message' => 'Industri not found',
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $Industri,
        ], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Industri = Industri::find($id);
        $Industri->nama = $request->nama;
        $Industri->bidang = $request->bidang;
        $Industri->alamat = $request->alamat;
        $Industri->kontak = $request->kontak;
        $Industri->email = $request->email;
        $Industri->save();
        return response()->json([
            'status' => 'success',
            'data' => $Industri,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Industri::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Industri deleted successfully',
        ], 200);
    }
}