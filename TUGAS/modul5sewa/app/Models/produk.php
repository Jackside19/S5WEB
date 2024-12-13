<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
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

    /**
    * Get produk image URL
    *
    * @return Attribute
    */
    protected function produkImage(): Attribute
    {
        return Attribute::make(
            get: fn ($produk_image) => $produk_image 
                ? url('/storage/produk/' . $produk_image) 
                : null,
        );
    }
}
