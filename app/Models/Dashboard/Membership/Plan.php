<?php

namespace App\Models\Dashboard\Membership;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public $table = 'membership_plans';
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'color',
        'price',
        'is_active',
    ];

}
