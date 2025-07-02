<?php

namespace App\Models\Dashboard\Membership;

use App\Models\Dashboard\Membership\Details\SocialLink;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Dashboard\Membership\Plan;
use Carbon\Carbon;

class Member extends Model
{
    
    use HasFactory;

    public $table = 'membership_members';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'member_id',
        'customer_id',
        'plan_id',
        'qr_size',
        'theme',
        'expiring_at',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    protected function expiringAt() : Attribute 
{ 
    return Attribute::make(
        get: fn () => Carbon::parse($this->attributes['expiring_at'])->format('d M, Y'),
        set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
    );
}
    
    protected function qrSize() : Attribute 
    { 
        return Attribute::make(
            get: fn ($value) => $value ?? 200,
        );
    }
    
    protected function theme() : Attribute 
    { 
        return Attribute::make(
            get: fn ($value) => $value ?? 'default',
        );
    }
    
}
