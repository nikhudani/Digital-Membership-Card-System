<?php

namespace App\Models\Dashboard\Customer;

use App\Models\Dashboard\Membership\Details\SocialLink;
use App\Models\Dashboard\Membership\Member;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VirtualCard extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'name',
        'slugurl',
        'customer_id',
        'is_active',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id')->with(['details']);
    }

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Member::class, 'customer_id', 'customer_id')->with(['plan']);
    }

    public function social() : BelongsTo
    {
        return $this->belongsTo(SocialLink::class, 'customer_id', 'customer_id');
    }

}
