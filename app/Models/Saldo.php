<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $fillable = ['jenis', 'saldo', 'nama', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
