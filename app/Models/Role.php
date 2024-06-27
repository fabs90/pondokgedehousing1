<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";

    protected $fillable = ['nama'];

    public $timestamps = false;

    public function contact_service()
    {
        return $this->hasMany(ContactService::class);
    }
}
