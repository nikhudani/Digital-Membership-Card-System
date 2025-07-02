<?php

namespace App\Models\Dashboard\Vendor\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    
    public $table = 'vendor_types';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

}
