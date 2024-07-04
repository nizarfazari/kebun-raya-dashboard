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
        'no_transaction',
        'order_id_midtrans',
    ];



    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function detail()
    {
        return $this->hasMany(TransactionProduct::class, 'transaction_id');
    }

    public function transaction_buyer()
    {
        return $this->hasOne(TransactionBuyer::class);
    }

      
  
}
