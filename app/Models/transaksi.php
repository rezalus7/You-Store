<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $fillable = ['nama_sepatu', 'ukuran', 'warna', 'harga', 'jumlah', 'total_harga','metode_pembayaran','alamat'];
}
