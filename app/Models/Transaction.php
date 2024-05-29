<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guard = [];


    protected $fillable = [
        'user_id',
        'status',
        'total_biaya_product',
        'biaya_pengiriman',
    ];



    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function transaction_buyer()
    {
        return $this->hasOne(TransactionBuyer::class);
    }
}
