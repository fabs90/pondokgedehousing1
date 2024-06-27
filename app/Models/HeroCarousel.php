<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroCarousel extends Model
{
    use HasFactory;

    protected $table = "hero_carousels";
    protected $fillable = ['gambar', 'keterangan', 'slug'];

}