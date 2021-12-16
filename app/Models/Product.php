<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $guarded = [];

   public function stock()
   {
       return $this->hasMany(stock::class);
   }
}
