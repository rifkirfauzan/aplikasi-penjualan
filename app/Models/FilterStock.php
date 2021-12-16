<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterStock extends Model
{
    protected $guarded =[];

    public function Stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
