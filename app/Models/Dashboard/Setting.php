<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    // public $id = false;
    // protected $primaryKey = 'name';
    protected $primaryKey = 'name';
    public $incrementing = false;
    
    public $timestamps = false;
    
    protected $fillable = [
        'name', 'value'
    ];

}
