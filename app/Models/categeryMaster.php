<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categeryMaster extends Model
{
    use HasFactory;
    protected $table = 'categery_master';
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
