<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_id",
        "product_id",
        "description",
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
