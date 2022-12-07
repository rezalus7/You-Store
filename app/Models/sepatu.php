<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sepatu extends Model
{
    use HasFactory;
    protected $fillable = ['nama_sepatu', 'ukuran', 'warna', 'deskripsi', 'harga'];
}
