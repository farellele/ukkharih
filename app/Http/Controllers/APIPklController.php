<?php

namespace App\Http\Controllers;

use App\Models\Pkl;
use Illuminate\Http\Request;

class ApiPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Pkl = Pkl::get();
        return response()->json([
            'status' => 'success',
            'data' => $Pkl,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Pkl = new Pkl();
        $Pkl->siswa_id = $request->siswa_id;
        $Pkl->industri_id = $request->industri_id;
        $Pkl->guru_id = $request->guru_id;
        $Pkl->waktu_mulai = $request->waktu_mulai;
        $Pkl->waktu_selesai = $request->waktu_selesai;
        $Pkl->save();
        return response()->json([
            'status' => 'success',
            'data' => $Pkl,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Pkl = Pkl::find($id);
        if (!$Pkl) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pkl not found',
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $Pkl,
        ], 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Pkl = Pkl::find($id);
        $Pkl->siswa_id = $request->siswa_id;
        $Pkl->industri_id = $request->industri_id;
        $Pkl->guru_id = $request->guru_id;
        $Pkl->waktu_mulai = $request->waktu_mulai;
        $Pkl->waktu_selesai = $request->waktu_selesai;
        $Pkl->save();
        return response()->json([
            'status' => 'success',
            'data' => $Pkl,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pkl::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Pkl deleted successfully',
        ], 200);
    }
}