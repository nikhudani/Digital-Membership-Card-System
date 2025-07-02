<?php

namespace App\Models\Dashboard\Vendor\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
        
    public $table = 'vendor_locations';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

}
