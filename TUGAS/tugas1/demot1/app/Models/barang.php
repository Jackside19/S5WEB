<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barang extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
    * Fillable attributes
    *
    * @var array
    */
    protected $fillable = [
        'name','deskripsi','price','produk_image',
        
    ];
}