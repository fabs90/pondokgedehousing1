<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactService extends Model
{
    use HasFactory;

    protected $table = "contact_services";
    protected $fillable = ["nama", "no_telp", "role_id"];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
