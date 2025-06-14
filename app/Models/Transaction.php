<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'id',
        'tanggal',
        'jenis',
        'kontak_id',
        'saldo_id',
        'nominal',
        'pembayaran',
        'status',
        'jatuh_tempo',
        'dibayar'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
    public function kontak()
    {
        return $this->belongsTo(Contact::class, 'kontak_id');
    }
    public function saldo()
    {
        return $this->belongsTo(Saldo::class, 'saldo_id');
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'kontak_id');
    }
}
