<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function categeryMaster()
    {
        return $this->belongsTo(categeryMaster::class);
    }
}
