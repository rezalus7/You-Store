<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sepatu;

class SepatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sepatu = Sepatu::all();

        if($sepatu){
            return response()->json([
                'status' => 'success',
                'message' => "data sepatu berhasil ditampilkan",
                'data' => $sepatu
            ], 200);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'data sepatu tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if($user->role == 'admin'){
            $sepatu = Sepatu::create([
                'nama_sepatu' => $request->nama_sepatu,
                'ukuran' => $request->ukuran,
                'warna' => $request->warna,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga                
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'maaf anda tidak bisa mengakses karena anda bukan admin'
            ], 404);
        }        

        return response()->json([
            'success' => 201,
            'message' => "data sepatu berhasil ditambahkan karena anda adalah admin",
            'data' => $sepatu
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sepatu = sepatu::find($id);
        if($sepatu){
            return response()->json([
                'status' => 200,
                'data' => $sepatu
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id diatas' . $id . 'tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        $user = auth()->user();

        $sepatu = sepatu::find($id);
        if($user->role == 'admin'){
            $sepatu->update([
                'nama_sepatu' => $request->nama_sepatu ?? $sepatu->nama_sepatu,
                'ukuran' => $request->ukuran ?? $sepatu->ukuran,
                'warna' => $request->warna ?? $sepatu->warna,
                'deskripsi' => $request->deskripsi ?? $sepatu->deskripsi,
                'harga' => $request->harga ?? $sepatu->harga
            ]);            
            
        } else {
            return response()->json([
                'status' => 'error',
                'message' =>  'anda sebagai user tidak bisa akses ini'
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'data' => $sepatu
        ], 200);
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $sepatu = sepatu::where('id', $id)->first();
        if($user->role == 'admin'){
            $sepatu->delete();
            return response()->json([
                'status' => "berhasil dihapus",                
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'anda sebagai user tidak bisa akses ini'
            ], 404);
        }
    }
}
