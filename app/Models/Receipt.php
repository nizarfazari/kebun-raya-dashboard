<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $guard = [];


    protected $fillable = [
        'image',
        'no_receipt',
        'transaction_id'
    ];



    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/category/' . $image),
        );
    }
}
