<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice',
        'total',
        'profit',
        'user_id',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    // di model Transaksi
    public function items()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function kasir()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
