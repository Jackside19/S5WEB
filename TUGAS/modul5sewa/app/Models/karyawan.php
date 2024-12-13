<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class karyawan extends Model
{
    use HasFactory;

    /**
    * Fillable attributes
    *
    * @var array
    */
    protected $fillable = [
        'karyawan_name','deskripsi','karyawan_photo',    
    ];

    /**
    * Get karyawan image URL
    *
    * @return Attribute
    */
    protected function karyawanImage(): Attribute
    {
        return Attribute::make(
            get: fn ($karyawan_photo) => $karyawan_photo 
                ? url('/storage/karyawan/' . $karyawan_photo) 
                : null,
        );
    }
}
