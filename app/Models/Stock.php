<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    
    protected $guarded =[];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
  
    public function Transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
