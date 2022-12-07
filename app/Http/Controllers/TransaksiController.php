<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $transaksi = Transaksi::all();

        if($transaksi){
            return response()->json([
                'status' => 'success',
                'message' => "data transaksi berhasil ditampilkan",
                'data' => $transaksi
            ], 200);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'data transaksi tidak ditemukan'
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
        //
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

        if($user->role == 'user'){
            $transaksi = Transaksi::create([
                'nama_sepatu' => $request->nama_sepatu,
                'ukuran' => $request->ukuran,
                'warna' => $request->warna,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
                'total_harga' => $request->total_harga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'alamat' => $request->alamat
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'pembayaran hanya dilakukan oleh customer dan admin tidak bisa'
            ], 404);
        }
        
        return response()->json([
            'success' => 201,
            'data' => $transaksi
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
        $transaksi = transaksi::find($id);
        if($transaksi){
            return response()->json([
                'status' => 200,
                'data' => $transaksi
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
