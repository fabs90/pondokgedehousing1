<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;

    protected $table = "traffic";

    protected $fillable = ['type', 'counter', 'created_at', 'updated_at'];
}
