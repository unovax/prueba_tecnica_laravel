<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepService extends Model
{
    use HasFactory;
    protected $fillable = [
        "client_product_id",
        "price",
        "notes",
        "status"
    ];
    public function client_product(){
        return $this->belongsTo(ClientProduct::class);
    }
}
