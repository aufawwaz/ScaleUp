<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kontak',
        'nomor_handphone',
        'image_kontak',
        'email_kontak',
        'alamat_kontak',
        'jumlah_transaksi',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
