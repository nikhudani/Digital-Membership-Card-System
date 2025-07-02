<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class UserDetail extends Model
{

    use HasFactory;
    
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 'ic_number', 'image', 'gender', 'organization', 'phone_number', 'address', 'city', 'state', 'zip', 'country'
    ];

    // protected $attributes = [
    //     'image' => 'default.svg',
    // ];

    // public function image()
    // {
    //     return $this->belongsTo(User::class)->withDefault(['image' => 'default.svg']);
    // }

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class)->withDefault([
    //         'image' => 'default.svg'
    //     ]);
    // }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value) ? $value:'default.svg',
            // get: fn ($value) => $value,
        );
    }
    
}
