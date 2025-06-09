<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'nama_usaha',
        'nomor_handphone',
        'tipe usaha',
        'npwp',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kode_pos',
        'desa',
        'dusun',
        'rt_rw'
    ];
}
