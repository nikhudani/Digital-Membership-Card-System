<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleGroup extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'role_id'
    ];
    
}
